<?php
declare(strict_types=1);

namespace Routers;

require_once __DIR__ . "/./routes.php";

use Controllers\LoginController;
use Controllers\ProyectoControllerAPI;

class Router
{
  public static array $getRoutes = [];
  public static array $postRoutes = [];
  public static array $putRoutes = [];
  public static array $deleteRoutes = [];
  public static string $currentUrl = "";
  public static string $idRecurso = "";
  public static array $fn;

  public static function get($url, $fn)
  {
    self::$getRoutes[$url] = $fn;
    //    debuguear(self::$getRoutes);
  }

  public static function post($url, $fn)
  {
    self::$postRoutes[$url] = $fn;
  }

  public static function put($url, $fn)
  {
    self::$putRoutes[$url] = $fn;
  }

  public static function delete($url, $fn)
  {
    self::$deleteRoutes[$url] = $fn;
  }

  public static function cargarRutas()
  {
    cargarRutas();
  }

  public static function procesarPeticion()
  {
    // habilitarCors();
    //$currentUrl = $_SERVER["PATH_INFO"] ?? "/";
    //    $currentUrl = $_GET["url"];
    $currentUrl = $_SERVER["QUERY_STRING"];
    //    debuguear($currentUrl);
    $currentUrl = explode("/", $currentUrl);
    //    debuguear(count($currentUrl));
    if (count($currentUrl) === 1 && strlen($currentUrl[0]) === 0) {
      //      debuguear("mostrando pagina principal");
      $baseUrl =
        $_ENV["MODE"] === "dev"
          ? $_ENV["DEV_BASE_URL"]
          : $_ENV["PROD_BASE_URL"];
      header("Location:" . $baseUrl);
      exit();
    }

    if (count($currentUrl) < 2 || count($currentUrl) > 3) {
      self::$fn = [];
    } else {
      if ($currentUrl[0] === "api") {
        self::$currentUrl = "/api/" . $currentUrl[1];
        //        debuguear(self::$currentUrl);
        if (isset($currentUrl[2]) && strlen($currentUrl[2]) > 0) {
          self::$idRecurso = $currentUrl[2];
        }
        //        debuguear(self::$idRecurso);
        $method = $_SERVER["REQUEST_METHOD"];
        if ($method === "GET") {
          self::$fn = self::$getRoutes[self::$currentUrl] ?? [];
          //          debuguear(self::$fn);
        } elseif ($method === "POST") {
          self::$fn = self::$postRoutes[self::$currentUrl] ?? [];
        } elseif ($method === "PUT") {
          self::$fn = self::$putRoutes[self::$currentUrl] ?? [];
        } elseif ($method === "DELETE") {
          self::$fn = self::$deleteRoutes[self::$currentUrl] ?? [];
        }
      } else {
        // !api
        self::$fn = [];
      }
    }

    if (count(self::$fn) > 0) {
      // Call user fn va a llamar una función cuando no sabemos cual sera
      call_user_func(self::$fn, self::$idRecurso); // Segundo parámetro de la función es para pasar argumentos
    } else {
      jsonResponse(["Página no encontrada o ruta no válida"], 404, true);
    }
  }
}
