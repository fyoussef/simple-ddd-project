<?php
declare(strict_types=1);

namespace Infra\Repository;

use Domain\Entity\UserEntity;
use Domain\Repository\UserRepositoryInterface;
use Domain\ValueObject\Username;
use Domain\ValueObject\Email;
use Domain\ValueObject\Password;
use Domain\ValueObject\Phone;
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
   * Get will return an user by id
   * @return UserEntity
   */
  public function get(string $id): UserEntity
  {
    $sql = $this->conn->prepare(
      "SELECT * FROM user WHERE id = :id"
    );
    $sql->execute([
      ':id' => $id
    ]);
    $data = $sql->fetch(PDO::FETCH_OBJ);
    $username = new Username($data->username);
    $email = new Email($data->email);
    $password = new Password($data->password);
    $phone = new Phone($data->phone);
    $user = new UserEntity(
      $data->id,
      $username,
      $email,
      $password,
      $phone
    );
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
      ':email' => $username->value(),
      ':password' => $password->value(),
      ':phone' => $phone->value()
    ]);
  }

  /**
   * Update will update user data in database
   * @param string $id
   */
  public function update(string $id): void
  {
  }

  /**
   * Delete will delete user of database
   * @param string $id
   */
  public function delete(string $id): void
  {
  }
}