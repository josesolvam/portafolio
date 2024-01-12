<?php
declare(strict_types=1);

//define("CARPETA_IMAGENES", $_SERVER["DOCUMENT_ROOT"] . "/portafolio/imagenes/");
const CARPETA_IMAGENES = __DIR__ . "/../public/imagenes";
const EXTENSIONES_PERMITIDAS_IMG = [
  "image/jpeg" => "jpeg",
  "image/png" => "png",
];

function debuguear($variable)
{
  echo "<pre>";
  var_dump($variable);
  echo "</pre>";
  exit();
  //  jsonResponse([strval($variable)]);
}

// Escapa / Sanitizar el HTML
function s($html): string
{
  $s = htmlspecialchars($html);
  return $s;
}

//function validarORedireccionar(string $url)
//{
//  $id = $_GET["id"];
//  $id = filter_var($id, FILTER_VALIDATE_INT);
//
//  if (!$id) {
//    header("Location: {$url} ");
//  }
//
//  return $id;
//}

function getExtension($mime_type)
{
  if (array_key_exists($mime_type, EXTENSIONES_PERMITIDAS_IMG)) {
    return EXTENSIONES_PERMITIDAS_IMG[$mime_type];
  }
  return null;
}

function habilitarCors()
{
  $http_origin = $_SERVER["HTTP_ORIGIN"] ?? null;

  if (
    $http_origin == "http://localhost:3000" ||
    $http_origin == "http://localhost:3001"
  ) {
    header("Access-Control-Allow-Origin: $http_origin");
  } else {
    //    jsonResponse(["Forbidden"], 403, true); // para bloquear peticiones sin origen como de Postman
  }
  //  jsonResponse([$_SERVER["HTTP_ORIGIN"]]);
  //  header("Access-Control-Allow-Origin: *");

  header("Access-Control-Allow-Credentials: true"); //AÑADIDO PARA DEV DESDE CHROME
  header(
    "Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"
  );
  header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
}
function habilitarCorsZonaPublica()
{
  header("Access-Control-Allow-Origin: *");
  header(
    "Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"
  );
  header("Access-Control-Allow-Methods: GET");
}
