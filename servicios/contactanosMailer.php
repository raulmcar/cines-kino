<?php
    require_once(__DIR__ . '/../vendor/autoload.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    function enviarCorreoContacto($nombre, $correo, $mensaje){
        $mail = new PHPMailer(true);

        try{
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'cineskino@gmail.com';
            $mail->Password   = 'gzaw xipa yohb vvpr';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('cineskino@gmail.com', 'Cines Kino');
            $mail->addAddress('cineskino@gmail.com', 'Cines Kino');

            $mail->isHTML(true);
            $mail->Subject = "Nuevo mensaje de contacto de $nombre";
            $mail->Body    = "<strong>Correo:</strong> $correo<br><strong>Mensaje:</strong><br>$mensaje";

            $mail->send();
            return true;
        } 
        catch (Exception $e) {
            echo "Error el mail " . $e->getMessage();
            return false;
        }
    }
?>