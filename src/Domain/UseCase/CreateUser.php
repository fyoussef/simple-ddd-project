<?php

declare(strict_types=1);

namespace Domain\UseCase;

use Domain\Repository\UserRepositoryInterface;
use Domain\ValueObject\Email;
use Domain\ValueObject\Password;
use Domain\ValueObject\Phone;
use Domain\ValueObject\Username;
use Infra\Repository\UserRepository;

final class CreateUser
{
  public function __construct(
    private UserRepositoryInterface $userRepository
  )
  {
  }

  public function action(
    string $id,
    Username $username,
    Email $email,
    Password $password,
    Phone $phone
  ): void
  {
    $this->userRepository->save(
      $id,
      $username,
      $email,
      $password,
      $phone
    );
  }
}