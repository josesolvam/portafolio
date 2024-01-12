<?php

namespace Models;

use http\Cookie;

class Admin extends ModeloBase
{
  // Base DE DATOS
  protected static string $tabla = "usuarios";
  protected static array $columnasDB = ["id", "email", "password"];

  public $id;
  public $email;
  public $password;

  public function __construct($args = [])
  {
    $this->id = $args["id"] ?? null;
    $this->email = $args["email"] ?? "";
    $this->password = $args["password"] ?? "";
  }

  public function validar()
  {
    if (!$this->email) {
      self::$errores[] = "El Email del usuario es obligatorio";
    }
    if (!$this->password) {
      self::$errores[] = "El Password del usuario es obligatorio";
    }
    return self::$errores;
  }

  public function existeUsuario()
  {
    // Revisar si el usuario existe.
    $query =
      "SELECT * FROM " .
      self::$tabla .
      " WHERE email = '" .
      $this->email .
      "' LIMIT 1";
    $resultado = self::$db->query($query);

    if (!$resultado->num_rows) {
      self::$errores[] = "El Usuario No Existe";
      return null;
    }

    return $resultado;
  }

  public function comprobarPassword($resultado)
  {
    $usuario = $resultado->fetch_object();

    $autenticado = password_verify($this->password, $usuario->password);

    if (!$autenticado) {
      self::$errores[] = "El Password es Incorrecto";
      return false;
    } else {
      return true;
    }
  }

  public function abrirSesionAuth()
  {
    // El usuario esta autenticado
    session_start();

    // Llenar el arreglo de la sesión
    $_SESSION["usuario"] = $this->email;
    $_SESSION["login"] = true;

    return session_id();
  }

  public static function sesionAuthAbierta()
  {
    session_start();
    if (isset($_SESSION["login"])) {
      return true;
    }
    return false;
  }

  public static function cerrarSesionAuth()
  {
    session_start();
    $_SESSION = [];
  }
}
