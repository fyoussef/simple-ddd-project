<?php

declare(strict_types=1);

namespace Infra\Adapter;

use Exception;
use Infra\Contract\DbContractInterface;
use PDO;

final class MariadbAdapter implements DbContractInterface
{
  private PDO $conn;


  public function __construct()
  {
    $dbHost = DB_HOST;
    $dbName = DB_NAME;
    $dbUserName = DB_USERNAME;
    $dbPassword = DB_PASSWORD;
    try {
      $conn = new PDO(
        "mysql:host={$dbHost};dbname={$dbName}",
        $dbUserName,
        $dbPassword
      );
      $this->conn = $conn;
    } catch (Exception $th) {
      throw new Exception("Erro on connect to DB " . $th->getMessage());
    }
  }

  /**
   * This function will return connection with database
   */
  public function conn(): PDO
  {
    return $this->conn;
  }
}