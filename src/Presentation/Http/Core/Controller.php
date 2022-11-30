<?php

declare(strict_types=1);

namespace Presentation\Http\Core;

class Controller
{
  public function request(
    array $request
  ): array
  {
    return (array) json_decode(file_get_contents("php://input"));
  }

  public function render(
    string $name,
    array $data = []
  )
  {

  }
}