<?php

declare(strict_types=1);

namespace Infra\Contract;

use PDO;

interface DbContractInterface
{
  public function conn(): PDO;
}