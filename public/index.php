<?php
declare(strict_types=1);

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../config/database.php";

use Routers\Router;
use Models\ModeloBase;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../config");
$dotenv->safeLoad();
// Conectarnos a la base de datos
conectarDB();
$db = conectarDB();
if (!$db) {
  jsonResponse(["Error connection DB"], 500, true);
}
ModeloBase::setDB($db);

Router::cargarRutas();
Router::procesarPeticion();
