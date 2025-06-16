<?php
    require_once(__DIR__ . '/../vendor/autoload.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    function enviarEntradaCorreoInvitado($ruta_pdf, $correo_invitado){
        $mail = new PHPMailer(true);

        try{
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; 
            $mail->SMTPAuth   = true;
            $mail->Username   = 'cineskino@gmail.com';    
            $mail->Password   = '';     
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->setFrom('cineskino@gmail.com', 'Cines Kino');
            $mail->addAddress($correo_invitado); 

            $mail->isHTML(true);
            $mail->Subject = 'Tu entrada de cine';
            $mail->Body    = 'Adjuntamos tu entrada de cine en PDF. ¡Que disfrutes la película!';
            $mail->AltBody = 'Adjuntamos tu entrada de cine en PDF.';

            $mail->addAttachment($ruta_pdf, 'entrada_cine.pdf');

            $mail->send();
        } 
        catch(Exception $e){
            echo "Error al enviar la entrada al destinatario " . $e->getMessage();
        }
    }
?>