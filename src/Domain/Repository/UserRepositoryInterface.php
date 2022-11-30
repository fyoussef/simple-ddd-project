<?php

declare(strict_types=1);

namespace Domain\Repository;

use Domain\Entity\UserEntity;
use Domain\ValueObject\Email;
use Domain\ValueObject\Password;
use Domain\ValueObject\Phone;
use Domain\ValueObject\Username;

interface UserRepositoryInterface
{
  public function listUsers(): array;
  public function listUser(string $id): object;
  public function save(
    string $id,
    Username $username,
    Email $email,
    Password $password,
    Phone $phone
  ): void;
  public function update(
    string $id,
    Username $username,
    Email $email,
    Password $password,
    Phone $phone
  ): void;
  public function delete(string $id): void;
}