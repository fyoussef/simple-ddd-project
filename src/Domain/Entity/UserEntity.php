<?php

declare(strict_types=1);

namespace Domain\Entity;

use Domain\ValueObject\Email;
use Domain\ValueObject\Password;
use Domain\ValueObject\Phone;
use Domain\ValueObject\Username;

final class UserEntity
{
  public function __construct(
    private string $id,
    private Username $username,
    private Email $email,
    private Password $password,
    private Phone $phone
  )
  {
    $this->id = $id;
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
    $this->phone = $phone;
  }

  public function value(): UserEntity
  {
    return $this;
  }
}