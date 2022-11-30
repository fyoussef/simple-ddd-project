<?php

declare(strict_types=1);

namespace Domain\UseCase;

use Domain\Entity\UserEntity;
use Infra\Repository\UserRepository;

final class ListUser
{

  public function __construct(
    private UserRepository $userRepository
  )
  {

  }

  public function action(
    string $id
  ): object
  {
    return $this->userRepository->listUser($id);
  }
}