<?php

declare(strict_types=1);

namespace Domain\ValueObject;

use Exception;

final class Password
{
  public function __construct(
    private string $password
  )
  {
    # Verifing is password have less than 8 caracters
    if (strlen($password) < 8) {
      throw new Exception("Password should have more than 8 caracters");
    }
    $this->password = password_hash($password, PASSWORD_BCRYPT);
  }

  public function value(): string
  {
    return $this->password;
  }

}