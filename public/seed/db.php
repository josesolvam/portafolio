<?php
declare(strict_types=1);

require_once __DIR__ . "/../../vendor/autoload.php";
require_once "./insert-usuario.php";

function conectarDB(): mysqli|bool
{
  try {
    $db = new mysqli("localhost", "root", "");
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
