<?php

function jsonResponse(array $arrData, int $code = 200, $errores = false)
{
  if ($errores) {
    $tipoRespuesta = "errores";
  } else {
    $tipoRespuesta = "resultado";
  }
  header("HTTP/1.1 " . $code);
  header("Content-Type: application/json; charset=utf-8");
  echo json_encode([$tipoRespuesta => $arrData]);
  exit();
}
