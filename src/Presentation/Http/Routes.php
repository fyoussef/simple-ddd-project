<?php

declare(strict_types=1);

namespace Presentation\Http;

use CoffeeCode\Router\Router;

final class Routes
{
  public function __construct(
    private string $domain
  )
  {
    $router = new Router($domain);
    $router->namespace("Presentation\Http\Controllers");

    // users
    $router->group('/api/users');
    $router->get('/', 'UserController:listUsers');
    $router->get('/{id}', 'UserController:listUser');
    $router->post('/', 'UserController:save');
    $router->delete('/', 'UserController:delete');

    $router->dispatch();
  }
}