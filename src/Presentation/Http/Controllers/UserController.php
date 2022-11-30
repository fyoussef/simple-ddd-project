<?php

declare(strict_types=1);

namespace Presentation\Http\Controllers;

use Domain\UseCase\CreateUser;
use Domain\UseCase\DeleteUser;
use Domain\UseCase\ListUser;
use Domain\UseCase\ListUsers;
use Domain\UseCase\UpdateUser;
use Domain\ValueObject\Email;
use Domain\ValueObject\Password;
use Domain\ValueObject\Phone;
use Domain\ValueObject\Username;
use Exception;
use Infra\Adapter\MariadbAdapter;
use Infra\Repository\UserRepository;
use Presentation\Http\Core\Controller;


final class UserController extends Controller
{
  private UserRepository $userRepository;
  public function __construct()
  {
    $adapter = new MariadbAdapter();
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
    $request = self::request($request);
    $id = uniqid();

    $createUser = new CreateUser($this->userRepository);

    try {
      $createUser->action(
        $id,
        new Username($request['username']),
        new Email($request['email']),
        new Password($request['password']),
        new Phone($request['phone'])
      );
    } catch (Exception $th) {
      http_response_code(400);
      echo json_encode(['msg' => $th->getMessage()]);
    }
  }

  public function update(
    array $request
  ): void
  {

    $request = json_decode(file_get_contents("php://input"));

    $username = $request->username ? new Username($request->username) : null;
    $email = $request->email ? new Email($request->email) : null;
    $password = $request->password ? new Password($request->password) : null;
    $phone = $request->phone ? new Phone($request->phone) : null;

    $updateUser = new UpdateUser($this->userRepository);
    try {
      $updateUser->action(
        $request->id,
        $username,
        $email,
        $password,
        $phone
      );
    } catch (\Throwable $th) {
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

  public function viewUser()
  {
    $users = new ListUsers($this->userRepository);
    $users = $users->action();
    self::render(
      'user',
      [
        'users' => $users,
        'name' => 'fyoussef'
      ]
    );
  }
}