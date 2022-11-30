<?php
declare(strict_types=1);

namespace Infra\Repository;

use Domain\Repository\UserRepositoryInterface;
use Domain\ValueObject\Username;
use Domain\ValueObject\Email;
use Domain\ValueObject\Password;
use Domain\ValueObject\Phone;
use Exception;
use PDO;

final class UserRepository implements UserRepositoryInterface
{

  public function __construct(
    private PDO $conn
  )
  {
    $this->conn = $conn;
  }

  /**
   * @return array
   */
  public function listUsers(): array
  {
    $sql = $this->conn->prepare(
      "SELECT 
        id,
        username,
        email,
        phone 
      FROM 
        user
      ORDER BY
        username"
    );
    $sql->execute();
    $users = $sql->fetchAll(PDO::FETCH_OBJ);
    return $users;
  }

  /**
   * Get will return an user by id
   * @return object
   */
  public function listUser(string $id): object
  {
    $sql = $this->conn->prepare(
      "SELECT 
        id,
        username,
        email,
        phone  
      FROM 
        user 
      WHERE 
        id = :id"
    );
    $sql->execute([
      ':id' => $id
    ]);
    $user = $sql->fetch(PDO::FETCH_OBJ);
    return $user;
  }
  /**
   * Save will save user in database
   * @param string $id
   * @param Username $username
   * @param Email $email
   * @param Password $password
   * @param Phone $phone
   */
  public function save(
    string $id,
    Username $username,
    Email $email,
    Password $password,
    Phone $phone
  ): void
  {
    $sql = $this->conn->prepare(
      "INSERT INTO
        user
        (id, username, email, password, phone)
      VALUES
        (:id, :username, :email, :password, :phone)"
    );
    $sql->execute([
      ':id' => $id,
      ':username' => $username->value(),
      ':email' => $email->value(),
      ':password' => $password->value(),
      ':phone' => $phone->value()
    ]);
  }

  /**
   * Update will update user data in database
   * @param string $id
   * @param Username $username
   * @param Email $email
   * @param Password $password
   * @param Phone $phone
   */
  public function update(
    string $id,
    Username $username = null,
    Email $email = null,
    Password $password = null,
    Phone $phone = null
  ): void
  {
    $fieldsUpdate = [];
    $fieldsUpdate[] = $username ? " username = :username " : "";
    $fieldsUpdate[] = $email ? " email = :email " : "";
    $fieldsUpdate[] = $password ? "password = :password" : "";
    $fieldsUpdate[] = $phone ? "phone = :phone" : "";

    $fields = join(',', $fieldsUpdate);

    $fieldsBind = array_merge(
      [':id' => $id],
      ($username ? [':username' => $username->value()] : []),
      ($email ? [':email' => $email->value()] : []),
      ($password ? [':password' => $password->value()] : []),
      ($phone ? [':phone' => $phone->value()] : [])
    );

    $sql = $this->conn->prepare(
      "UPDATE 
          user 
        SET
          {$fields}
        WHERE
          id = :id"
    );
    $sql->execute($fieldsBind);
  }

  /**
   * Delete will delete user of database
   * @param string $id
   */
  public function delete(string $id): void
  {
    try {
      $sql = $this->conn->prepare(
        "DELETE FROM user WHERE id = :id"
      );
      $sql->execute([
        ':id' => $id
      ]);
    } catch (Exception $th) {
      throw new Exception("Delete user error " . $th->getMessage());
    }
  }
}