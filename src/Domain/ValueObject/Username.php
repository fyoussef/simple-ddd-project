<?php

declare(strict_types=1);

namespace Domain\ValueObject;

use Exception;

final class Username
{
  public function __construct(
    private string $username
  )
  {
    # Varifing if username have less then 3 caracters
    if (strlen($username) < 3) {
      throw new Exception("Usernme should have 3 caracters");
    }
    $this->username = $username;
  }

  public function value(): string
  {
    return $this->username;
  }
}