<?php
declare(strict_types=1);

namespace Infra\Repository;

use Domain\Entity\UserEntity;
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
        user"
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
    Username $username,
    Email $email,
    Password $password,
    Phone $phone
  ): void
  {
    $sql = $this->conn->prepare(
      "UPDATE 
          user 
        SET
          username = :username,
          email = :email,
          password = :password,
          phone = :phone
        WHERE
          id = :id"
    );
    $sql->execute([
      ':username' => $username->value(),
      ':email' => $email->value(),
      ':password' => $password->value(),
      ':phone' => $phone->value(),
      ':id' => $id
    ]);
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