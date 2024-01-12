<?php

namespace Models;

class Proyecto extends ModeloBase
{
  // Base DE DATOS
  protected static string $tabla = "proyectos";
  protected static array $columnasDB = [
    "id",
    "titulo",
    "descripcion",
    "imagen",
    "fechaProyecto",
  ];

  public $id;
  public $titulo;
  public $descripcion;
  public $imagen;
  public $fechaProyecto;

  public function __construct($args = [])
  {
    $this->id = null;
    $this->titulo = $args["titulo"] ?? "";
    $this->descripcion = $args["descripcion"] ?? "";
    $this->imagen = $args["imagen"] ?? "";
    $this->fechaProyecto = $args["fechaProyecto"] ?? "";
  }

  public function validar(): array
  {
    if (!$this->titulo) {
      self::$errores[] = "Debes añadir un titulo";
    }
    if (!$this->descripcion) {
      self::$errores[] = "La descripción es obligatoria";
    }
    if (!$this->fechaProyecto) {
      self::$errores[] = "La fecha del proyecto es obligatoria";
    }

    return self::$errores;
  }
}
