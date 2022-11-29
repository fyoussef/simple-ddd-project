<?php

declare(strict_types=1);

namespace Domain\ValueObject;

use Exception;

final class Email
{
  public function __construct(
    private string $email
  )
  {
    # if email is no valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      throw new Exception("Email is invalid");
    }
    $this->email = $email;
  }

  public function value(): string
  {
    return $this->email;
  }
}