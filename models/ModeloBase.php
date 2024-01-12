<?php
declare(strict_types=1);

namespace Models;

class ModeloBase
{
  // Base DE DATOS
  protected static $db;
  protected static string $tabla = "";
  protected static array $columnasDB = [];

  // Errores
  protected static array $errores = [];

  // Definir la conexión a la BD
  public static function setDB($database)
  {
    self::$db = $database;
  }

  // Validación
  public static function getErrores(): array
  {
    return static::$errores;
  }

  // Registros - CRUD
  public function guardar()
  {
    $resultado = "";
    if (!is_null($this->id)) {
      // actualizar
      $resultado = $this->actualizar();
    } else {
      // Creando un nuevo registro
      $resultado = $this->crear();
    }
    //    self::$db->close();
    return $resultado;
  }

  public static function all(): array
  {
    $query = "SELECT * FROM " . static::$tabla;
    $resultado = self::consultarSQL($query);
    //    self::$db->close();
    return $resultado;
  }

  // Busca un registro por su id
  public static function find($id)
  {
    $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";

    $resultado = self::consultarSQL($query);

    return array_shift($resultado); //devuelve el valor de la posición 0 del array
  }

  public static function get($limite)
  {
    $query = "SELECT * FROM " . static::$tabla . " LIMIT {$limite}";

    $resultado = self::consultarSQL($query);

    return $resultado;
  }

  // crea un nuevo registro
  public function crear()
  {
    // Sanitizar los datos
    $atributos = $this->sanitizarAtributos();

    // Insertar en la base de datos
    $query = " INSERT INTO " . static::$tabla . " ( ";
    $query .= join(", ", array_keys($atributos));
    $query .= " ) VALUES ('";
    $query .= join("', '", array_values($atributos));
    $query .= "') ";

    // Resultado de la consulta
    $resultado = self::$db->query($query);

    return $resultado;
  }

  public function actualizar()
  {
    // Sanitizar los datos
    $atributos = $this->sanitizarAtributos();

    $valores = [];
    foreach ($atributos as $key => $value) {
      $valores[] = "{$key}='{$value}'";
    }

    $query = "UPDATE " . static::$tabla . " SET ";
    $query .= join(", ", $valores);
    $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
    $query .= " LIMIT 1 ";

    $resultado = self::$db->query($query);

    return $resultado;
  }

  // Eliminar un registro
  public function eliminar()
  {
    // Eliminar el registro
    $query =
      "DELETE FROM " .
      static::$tabla .
      " WHERE id = " .
      self::$db->escape_string($this->id) .
      " LIMIT 1";
    $resultado = self::$db->query($query);

    if ($resultado) {
      $this->borrarImagen();
    }

    return $resultado;
  }

  public static function consultarSQL($query): array
  {
    // Consultar la base de datos
    $resultado = self::$db->query($query);

    // Iterar los resultados
    $array = [];
    while ($registro = $resultado->fetch_assoc()) {
      $array[] = static::crearObjeto($registro);
    }

    // liberar la memoria
    $resultado->free();

    // retornar los resultados
    return $array;
  }

  protected static function crearObjeto($registro): ModeloBase
  {
    $objeto = new static();

    foreach ($registro as $key => $value) {
      if (property_exists($objeto, $key)) {
        $objeto->$key = $value;
      }
    }

    return $objeto;
  }

  // Identificar y unir los atributos de la BD
  public function atributos(): array
  {
    $atributos = [];
    foreach (static::$columnasDB as $columna) {
      if ($columna === "id") {
        continue;
      }
      $atributos[$columna] = $this->$columna;
    }
    return $atributos;
  }

  public function sanitizarAtributos(): array
  {
    $atributos = $this->atributos();
    $sanitizado = [];
    foreach ($atributos as $key => $value) {
      if (isset($value)) {
        $sanitizado[$key] = self::$db->escape_string($value);
      }
    }
    return $sanitizado;
  }

  public function sincronizar($args = [])
  {
    $keysNoEvaluadas = ["id", "imagen"];
    foreach ($args as $key => $value) {
      if (property_exists($this, $key) && !in_array($key, $keysNoEvaluadas)) {
        $this->$key = $value ?? "";
      }
    }
  }

  // Subida de archivos
  public function setImagen($imagen)
  {
    // Elimina la imagen previa
    //    if (!is_null($this->id)) {
    //      $this->borrarImagen();
    //    }
    if (isset($this->id)) {
      $this->borrarImagen();
    }
    // Asignar al atributo de imagen el nombre de la imagen
    if (isset($imagen)) {
      $this->imagen = $imagen;
    }
  }

  // Elimina el archivo
  public function borrarImagen()
  {
    if (!empty($this->imagen)) {
      $existeArchivo = file_exists(CARPETA_IMAGENES . "/" . $this->imagen);
      if ($existeArchivo) {
        unlink(CARPETA_IMAGENES . "/" . $this->imagen);
      }
    }
  }
}
