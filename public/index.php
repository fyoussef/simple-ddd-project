<?php

require __DIR__ . "/../vendor/autoload.php";

use Presentation\Http\Routes;

define('DB_HOST', getenv('DB_HOST'));
define('DB_NAME', getenv('DB_NAME'));
define('DB_USERNAME', getenv('DB_USERNAME'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('DOMAIN', getenv('DOMAIN'));

$router = new Routes(DOMAIN);