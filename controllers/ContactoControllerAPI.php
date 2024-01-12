<?php
declare(strict_types=1);

namespace Controllers;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class ContactoControllerAPI
{
  public static function contactar()
  {
    //    jsonResponse(["mensaje" => "enviado correctamente"]);
    //    jsonResponse(["pr"], 400, true);
    // Ejecutar el código después de que el usuario envia el formulario

    $arrData = json_decode(file_get_contents("php://input"), true) ?? null;
    if (is_null($arrData)) {
      jsonResponse(["Debe enviar argumentos"], 400, true);
    }
    $userName = "";
    $password = "";
    switch ($_ENV["MODE"]) {
      case "dev":
        $userName = $_ENV["DEV_MAILER_USERNAME"];
        $password = $_ENV["DEV_MAILER_PASSWORD"];

        break;
      default:
        $userName = $_ENV["PROD_MAILER_USERNAME"];
        $password = $_ENV["PROD_MAILER_PASSWORD"];
    }
    $mail = new PHPMailer(true);
    try {
      $mail->isSMTP();
      $mail->Host = "smtp.mailtrap.io";
      $mail->SMTPAuth = true;
      $mail->Username = $userName;
      $mail->Password = $password;
      $mail->SMTPSecure = "tls";
      $mail->Port = 2525;

      $mail->setFrom("josesolvam@mailtrap.com", $arrData["nombre"]);
      $mail->addAddress("josesolvam@mailtrap.com", "josesolvam");
      $mail->Subject = "Tienes un Nuevo Email";
      // Set HTML
      $mail->isHTML(true);
      $mail->CharSet = "UTF-8";

      $contenido = "<html>";
      $contenido .= "<p><strong>Has Recibido un correo:</strong></p>";
      $contenido .= "<p>Nombre: " . $arrData["nombre"] . "</p>";
      $contenido .= "<p>Mensaje: " . $arrData["mensaje"] . "</p>";
      if (!empty($arrData["telefono"])) {
        $contenido .= "<p>Su teléfono es: " . $arrData["telefono"] . " </p>";
      }
      if (!empty($arrData["correo"])) {
        $contenido .= "<p>Su email es: " . $arrData["correo"] . " </p>";
      }
      $contenido .= "</html>";
      $mail->Body = $contenido;
      $mail->Send();
      //  $mail->AltBody = "Esto es texto alternativo";
      jsonResponse(["mensaje" => "enviado correctamente"]);
    } catch (Exception $exep) {
      jsonResponse(["Error server"], 500, true);
    }
  }
}
