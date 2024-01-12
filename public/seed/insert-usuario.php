<?php
declare(strict_types=1);

function insertUsuario($db)
{
  // Crear un email y password
  $email = "correo@correo.com";
  $password = "123456";
  //  $passwordHash = password_hash($password, PASSWORD_BCRYPT);
  $passwordHash = password_hash($password, PASSWORD_DEFAULT);

  // Query para crear el usuario
  $query = " INSERT INTO usuarios (email, password) VALUES ( '{$email}', '{$passwordHash}'); ";

  // Agregarlo a la base de datos
  $resultado = $db->query($query);
  if ($resultado) {
    return true;
  } else {
    return false;
  }
}
