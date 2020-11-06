<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($user_email, $user_name, $mailContent, $mailSubject, $emailAltBody = null){

    include 'app/notifications/mail_templates/mail_style.php';

    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPSecure = false;
        $mail->SMTPAutoTLS = false;
        $mail->Username = '3433a5a1de5b49';
        $mail->Password = '6f2b7bb8c5f8bd';
        $mail->Port = 25;

        $mail->setFrom('info@hostingname.de', 'Kundendienst');
        $mail->addAddress($user_email, $user_name);

        $mail->isHTML(true);
        $mail->Subject = $mailSubject;
        $mail->Body = $mailContent;
        $mail->AltBody = $emailAltBody;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
    }

}
