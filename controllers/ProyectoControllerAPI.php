<?php
declare(strict_types=1);

namespace Controllers;

use Models\Proyecto;
use Models\Admin;

class ProyectoControllerAPI
{
  public static function getAll()
  {
    //    habilitarCorsZonaPublica();
    $proyectos = Proyecto::all();
    jsonResponse(["proyectos" => $proyectos]);
  }

  public static function get(string $id)
  {
    //    habilitarCorsZonaPublica();
    // $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id) {
      jsonResponse(["Id no enviado o no válido"], 400, true);
    }

    // Obtener los datos del proyecto
    $proyecto = Proyecto::find($id);
    if (!$proyecto) {
      jsonResponse(["Proyecto no encontrado"], 400, true);
    }
    jsonResponse(["proyecto" => $proyecto]);
  }

  public static function crear()
  {
    if (!Admin::sesionAuthAbierta()) {
      jsonResponse(["Forbidden"], 403, true);
    }
    // Ejecutar el código después de que el usuario envia el formulario
    /** Crea una nueva instancia */
    // $proyecto = new Proyecto($_POST);
    $arrData = json_decode(file_get_contents("php://input"), true) ?? null;
    if (is_null($arrData)) {
      jsonResponse(["Debe enviar argumentos"], 400, true);
    }
    $proyecto = new Proyecto($arrData);
    // Validar
    $errores = $proyecto->validar();
    if (empty($errores)) {
      if (isset($arrData["imagen"])) {
        $imagen = $arrData["imagen"];
        $nombreImagen = handleImagen($imagen);
        $proyecto->setImagen($nombreImagen);
      }

      $resultado = $proyecto->guardar();

      if ($resultado) {
        jsonResponse(["proyecto-creado" => $proyecto]);
      } else {
        jsonResponse(["Error server"], 500, true);
      }
    } else {
      jsonResponse($errores, 400, true);
    }
  }

  public static function actualizar(string $id)
  {
    if (!Admin::sesionAuthAbierta()) {
      jsonResponse(["Forbidden"], 403, true);
    }
    // $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id) {
      jsonResponse(["Id no enviado o no válido"], 400, true);
    }
    $proyecto = Proyecto::find($id);
    if (!$proyecto) {
      jsonResponse(["Proyecto no encontrado"], 400, true);
    }

    //    $args = $_POST;
    $arrData = json_decode(file_get_contents("php://input"), true) ?? null;
    //    debuguear($arrData["imagen"]);
    if (is_null($arrData)) {
      jsonResponse(["Debe enviar argumentos"], 400, true);
    }

    $proyecto->sincronizar($arrData);

    // Validación
    $errores = $proyecto->validar();
    //    debuguear($errores);

    if (empty($errores)) {
      if (isset($arrData["imagen"])) {
        $imagen = $arrData["imagen"];
        $nombreImagen = handleImagen($imagen);
        $proyecto->setImagen($nombreImagen);
      }
      $resultado = $proyecto->guardar();

      if ($resultado) {
        jsonResponse(["proyecto-actualizado" => $proyecto]);
      } else {
        jsonResponse(["Error server"], 500, true);
      }
    } else {
      jsonResponse($errores, 400, true);
    }
  }

  public static function eliminar(string $id)
  {
    if (!Admin::sesionAuthAbierta()) {
      jsonResponse(["Forbidden"], 403, true);
    }
    // $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id) {
      jsonResponse(["Id no enviado o no válido"], 400, true);
    }
    $proyecto = Proyecto::find($id);
    if (!$proyecto) {
      jsonResponse(["Proyecto no encontrado"], 400, true);
    }
    $resultado = $proyecto->eliminar();

    if ($resultado) {
      jsonResponse(["proyecto-eliminado" => $proyecto]);
    } else {
      jsonResponse(["Error server"], 500, true);
    }
  }
}
