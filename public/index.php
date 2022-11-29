<?php

require __DIR__ . "/../vendor/autoload.php";

use Domain\Entity\UserEntity;
use Domain\ValueObject\Email;
use Domain\ValueObject\Password;
use Domain\ValueObject\Phone;
use Domain\ValueObject\Username;
use Infra\Adapter\MariadbAdapter;
use Infra\Repository\UserRepository;

define('DB_HOST', getenv('DB_HOST'));
define('DB_NAME', getenv('DB_NAME'));
define('DB_USERNAME', getenv('DB_USERNAME'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));

$sql = new MariadbAdapter(
  DB_HOST,
  DB_NAME,
  DB_USERNAME,
  DB_PASSWORD
);

$username = new Username("filipi");
$email = new Email("filipi@gmail.com");
$password = new Password('123456789');
$phone = new Phone('1111111111');

$id = uniqid();

$user = new UserEntity(
  $id,
  $username,
  $email,
  $password,
  $phone
);

$teste = new UserRepository($sql->conn());
// $teste->save(
//   $user->id,
//   $username,
//   $email,
//   $password,
//   $phone
// );

var_dump($teste->get('63866eaa4e172'));