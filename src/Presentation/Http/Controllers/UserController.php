<?php

declare(strict_types=1);

namespace Presentation\Http\Controllers;

use Domain\UseCase\CreateUser;
use Domain\UseCase\DeleteUser;
use Domain\UseCase\ListUser;
use Domain\UseCase\ListUsers;
use Domain\ValueObject\Email;
use Domain\ValueObject\Password;
use Domain\ValueObject\Phone;
use Domain\ValueObject\Username;
use Exception;
use Infra\Adapter\MariadbAdapter;
use Infra\Repository\UserRepository;

final class UserController
{
  private UserRepository $userRepository;
  public function __construct()
  {
    $adapter = new MariadbAdapter(
      DB_HOST,
      DB_NAME,
      DB_USERNAME,
      DB_PASSWORD
    );
    $this->userRepository = new UserRepository($adapter->conn());
  }

  public function listUsers()
  {
    $users = new ListUsers($this->userRepository);
    $users = $users->action();
    echo json_encode($users);
  }

  public function listUser(
    array $request
  )
  {
    $id = $request['id'];
    $user = new ListUser($this->userRepository);
    $user = $user->action($id);
    echo json_encode($user);
  }

  public function save(
    array $request
  ): void
  {
    $request = json_decode(file_get_contents("php://input"));

    $id = uniqid();

    $createUser = new CreateUser($this->userRepository);

    try {
      $createUser->action(
        $id,
        new Username($request->username),
        new Email($request->email),
        new Password($request->password),
        new Phone($request->phone)
      );
    } catch (Exception $th) {
      http_response_code(400);
      echo json_encode(['msg' => $th->getMessage()]);
    }
  }

  public function delete(
    array $request
  ): void
  {
    $request = json_decode(file_get_contents("php://input"));

    $deleteUser = new DeleteUser($this->userRepository);

    try {
      $deleteUser->action($request->id);
    } catch (\Throwable $th) {
      http_response_code(400);
      echo json_encode(['msg' => $th->getMessage()]);
    }
  }
}