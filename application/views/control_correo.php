<?php 

include ("*/application/helpers/PHPMailer/src/PHPMailer.php");
include ("*/application/helpers/PHPMailer/src/SMTP.php");
include ("*/application/helpers/PHPMailer/src/Exception.php");

try {

    $emailTo = $_POST["correo"];
    $subject = $_POST["asunto"];
    $bodyEmail = $_POST["datos"];


    $fromemail = "arturo.cardenasg@outlook.com";
    $fromname = "MarioOO";
    /* $host= "smtp-mail.outlook.com"; */
    $host = "smtp.office365.com";
    $port = "587";
    $SMTPAuth = "login";
    $_SMTPSecure = "STARTTLS";
    $password = "EnchiladasSuizas";

    $mail = new PHPMailer\PHPMailer\PHPMailer();

    //Indicar a la aplicacion que use el SMTP
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = $host;
    $mail->Port = $port;
    $mail->SMTPAuth = $SMTPAuth;
    $mail->Username = $fromemail;
    $mail->Password = $password;

    $mail->setFrom($fromemail, $fromname);
    $mail->addAddress($emailTo);

    $mail->isHTML(true);
    $mail->Subject = $subject;

    $mail->Body = $bodyEmail;

    if (!$mail->send()) {
        echo "No se envio correo"; die();

    }
        echo "Correo enviado con exito"; die();

} catch (Exception $e){

}
?>  