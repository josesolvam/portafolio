<?php
declare(strict_types=1);

use Routers\Router;
use Controllers\ProyectoControllerAPI;
use Controllers\LoginControllerAPI;
use Controllers\ContactoControllerAPI;

function cargarRutas()
{
  // API
  //Proyectos
  Router::get("/api/proyectos", [ProyectoControllerAPI::class, "getAll"]);
  Router::get("/api/proyecto", [ProyectoControllerAPI::class, "get"]);
  Router::post("/api/proyecto", [ProyectoControllerAPI::class, "crear"]);
  Router::put("/api/proyecto", [ProyectoControllerAPI::class, "actualizar"]);
  Router::delete("/api/proyecto", [ProyectoControllerAPI::class, "eliminar"]);

  //Login
  Router::post("/api/login", [LoginControllerAPI::class, "login"]);
  Router::get("/api/logout", [LoginControllerAPI::class, "logout"]);

  //Contacto
  Router::post("/api/contacto", [ContactoControllerAPI::class, "contactar"]);
}
