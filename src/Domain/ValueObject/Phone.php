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
    if (strlen($phone) < 3) {
      throw new Exception("Phone should have more than 3 digits");
    }
    $this->phone = $phone;
  }

  public function value(): string
  {
    return $this->phone;
  }
}