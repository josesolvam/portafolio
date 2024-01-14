<?php
declare(strict_types=1);

require_once __DIR__ . "/../../vendor/autoload.php";
require_once "./insert-usuario.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../config");
$dotenv->safeLoad();

function conectarDB(): mysqli|bool
{
    $dbHost = "";
    $dbUser = "";
    $dbPass = "";
    $dbTable = "";
    switch ($_ENV["MODE"]) {
        case "dev":
            $dbHost = $_ENV["DEV_DB_HOST"];
            $dbUser = $_ENV["DEV_DB_USER"];
            $dbPass = $_ENV["DEV_DB_PASSWORD"];
            break;
        default:
            $dbHost = $_ENV["PROD_DB_HOST"];
            $dbUser = $_ENV["PROD_DB_USER"];
            $dbPass = $_ENV["PROD_DB_PASSWORD"];
    }
  try {
    $db = new mysqli($dbHost, $dbUser, $dbPass);
    $db->query("SET NAMES 'utf8'");
    if ($db->connect_error) {
      return false;
    }
    return $db;
  } catch (Exception $exception) {
    return false;
  }
}

function ejecutarSQL($rutaArchivo, $db)
{
  $queries = explode(";", file_get_contents($rutaArchivo));
  foreach ($queries as $query) {
    if (empty($query)) {
      continue;
    }
    $db->query($query);
  }
}

$db = conectarDB();
if (!$db) {
  jsonResponse(["Error connection DB"], 500, true);
}

ejecutarSQL("./tabla-proyectos.sql", $db);
ejecutarSQL("./tabla-usuarios.sql", $db);
ejecutarSQL("./insert-proyectos-ejemplo.sql", $db);
$usuarioCreado = insertUsuario($db);
$db->close();

if ($usuarioCreado) {
  jsonResponse(["tablas-creadas" => "ok"]);
} else {
  jsonResponse(["Error server"], 500, true);
}
