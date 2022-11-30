<?php

declare(strict_types=1);

namespace Domain\UseCase;

use Domain\Repository\UserRepositoryInterface;
use Domain\ValueObject\Email;
use Domain\ValueObject\Password;
use Domain\ValueObject\Phone;
use Domain\ValueObject\Username;

final class UpdateUser
{
  public function __construct(
    private UserRepositoryInterface $userRepository
  )
  {
  }

  public function action(
    string $id,
    Username $username = null,
    Email $email = null,
    Password $password = null,
    Phone $phone = null
  ): void
  {
    $this->userRepository->update(
      $id,
      $username,
      $email,
      $password,
      $phone
    );
  }
}