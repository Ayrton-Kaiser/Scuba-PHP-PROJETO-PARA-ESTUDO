<?php

use PHPMailer\PHPMailer\PHPMailer;

function send_mail($recipient, $subject, $content)
{
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->SMTPSecure = '**tls**';
    $mail->IsSMTP(true);
    $mail->Host = "smtp.gmail.com"; //Endereço do servidor SMTP
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = EMAIL_ADDRESS; //Usuário do servidor SMTP
    $mail->Password = EMAIL_PASSWORD; //Senha do servidor SMTP
    $mail->From = EMAIL_ADDRESS; //Seu email
    $mail->FromName = "ScubaPHP"; //Seu nome
    $mail->AddAdress($recipient); //email que vai ser enviado
    $mail->Subject = $subject; //Assunto
    $mail->Body = $content; //Corpo/conteudo do email
    $mail->AltBody = $content; //Corpo/conteudo do email alternativo
    $enviado = $mail->Send(); //envia o email
}
