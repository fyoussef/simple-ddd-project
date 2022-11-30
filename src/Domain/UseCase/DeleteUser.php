<?php

declare(strict_types=1);

namespace Domain\UseCase;

use Domain\Repository\UserRepositoryInterface;

final class DeleteUser
{
  public function __construct(
    private UserRepositoryInterface $userRepository
  )
  {
  }

  public function action(
    string $id
  )
  {
    $this->userRepository->delete($id);
  }
}