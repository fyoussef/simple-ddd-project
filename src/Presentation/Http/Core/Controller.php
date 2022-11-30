<?php

declare(strict_types=1);

namespace Presentation\Http\Core;

use League\Plates\Engine;

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
    $templates = new Engine(__DIR__ . '/../View');
    $templates->addData(['base_url' => DOMAIN]);
    echo $templates->render($name, $data);
  }
}