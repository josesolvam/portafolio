<?php
declare(strict_types=1);

namespace Controllers;

use Models\Admin;

class LoginControllerAPI
{
  public static function login()
  {
    $arrData = json_decode(file_get_contents("php://input"), true);
    if (is_null($arrData)) {
      jsonResponse(["Debe enviar argumentos"], 400, true);
    }
    $auth = new Admin($arrData);
    $errores = $auth->validar();

    if (empty($errores)) {
      $resultado = $auth->existeUsuario();

      if (!$resultado) {
        $errores = Admin::getErrores();
        jsonResponse($errores, 400, true);
      } else {
        $autenticado = $auth->comprobarPassword($resultado);

        if ($autenticado) {
          //          if (Admin::sesionAuthAbierta()) {
          //            jsonResponse(["email-sesion" => $_SESSION["usuario"]]);
          //          }
          $idSesion = $auth->abrirSesionAuth();
          // jsonResponse(["id-sesion" => $idSesion]);
          jsonResponse(["autenticado" => true]);
        } else {
          $errores = Admin::getErrores();
          jsonResponse($errores, 400, true);
        }
      }
    } else {
      jsonResponse($errores, 400, true);
    }
  }

  public static function logout()
  {
    //  if (Admin::sesionAuthAbierta()) {
    //    jsonResponse(["email-sesion" => $_SESSION["usuario"]]);
    //  }
    Admin::cerrarSesionAuth();
    jsonResponse(["session" => "closed"]);
  }
}
