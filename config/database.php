<?php
declare(strict_types=1);

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
      $dbTable = $_ENV["DEV_DB_TABLE"];
      break;
    default:
      $dbHost = $_ENV["PROD_DB_HOST"];
      $dbUser = $_ENV["PROD_DB_USER"];
      $dbPass = $_ENV["PROD_DB_PASSWORD"];
      $dbTable = $_ENV["PROD_DB_TABLE"];
  }

  try {
    $db = new mysqli($dbHost, $dbUser, $dbPass, $dbTable);
    $db->query("SET NAMES 'utf8'");
    if ($db->connect_error) {
      return false;
    }
    return $db;
  } catch (Exception $exception) {
    return false;
  }
}
