<?php
declare(strict_types=1);
function handleImagen($imagen)
{
  if (isset($imagen["name"])) {
    //  $extensionImagen = explode("/", $imagen["type"])[1];
    $extensionImagen = $imagen["type"];
    $extensionImagen = getExtension($extensionImagen);
    if (is_null($extensionImagen)) {
      jsonResponse(
        [
          "Extensión no válida. Extensiones permitidas: " .
          implode(", ", array_values(EXTENSIONES_PERMITIDAS_IMG)),
        ],

        400,
        true
      );
    }
    $sizeImagen = $imagen["size"];
    //  jsonResponse(["size" => $sizeImagen . "Bytes"]);
    //  jsonResponse(["size" => $sizeImagen / 1000 . "KB"]);
    if ($sizeImagen > 1000 * 300) {
      jsonResponse(
        [
          "Imagen demasiado pesada. Máximo permitido 300KB. Y esta imagen pesa: " .
          $sizeImagen / 1000 .
          "KB",
        ],

        400,
        true
      );
    }
    $nombreImagen = $imagen["name"];
    $nombreImagen = substr($nombreImagen, 0, strrpos($nombreImagen, "."));

    $contenidoImagen = $imagen["content"];
    if (!is_dir(CARPETA_IMAGENES)) {
      mkdir(CARPETA_IMAGENES);
    }
    $nombreImagen = $nombreImagen . "-" . uniqid() . "." . $extensionImagen;
    $file = fopen(CARPETA_IMAGENES . "/" . $nombreImagen, "w+");
    $bin = base64_decode($contenidoImagen);
    fwrite($file, $bin);
    fclose($file);
    return $nombreImagen;
    //  $proyecto->setImagen($nombreImagen);
  } else {
    // is_null($imagen["name"]
    //    $proyecto->setImagen("");
    return "";
  }
}
