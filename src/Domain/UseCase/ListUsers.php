<?php

namespace Domain\UseCase;

use Infra\Repository\UserRepository;

final class ListUsers
{
  public function __construct(
    private UserRepository $userRepository
  )
  {
  }

  public function action(): array
  {
    return $this->userRepository->listUsers();
  }
}