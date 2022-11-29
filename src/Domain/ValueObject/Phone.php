<?php

declare(strict_types=1);

namespace Domain\ValueObject;

use Exception;

final class Phone
{
  public function __construct(
    private string $phone
  )
  {
    # Validate if phone number contain only numbers
    if (!is_numeric($phone)) {
      throw new Exception("Phone should contain only numbers");
    }
    $this->phone = $phone;
  }

  public function value(): string
  {
    return $this->phone;
  }
}