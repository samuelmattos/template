<?php

define("PATH", '/CodDev/');
require_once '../lib/php/template/Template.php';
Template::__autoload();
// Check for empty fields
if (empty($_POST['name']) ||
        empty($_POST['email']) ||
        empty($_POST['phone']) ||
        empty($_POST['message']) ||
        !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo "Não há argumentos apresentados!";
    return false;
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// Create the email and send the message
$to = 'yourname@yourdomain.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Website Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n" . "Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
$headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";
//mail($to, $email_subject, $email_body, $headers);
//envia a notificacao por email
$mail = new PHPMailer();
$mail->IsHTML(true);

//Informa que será utilizado o SMTP para envio do e-mail
$mail->IsSMTP();
$mail->Body = utf8_decode($email_body);
$mail->Subject = 'Contato do portal';
$mail->AddReplyTo('appdevcog@gmail.com', "Dev Cog");
$mail->FromName = "Contato portal Dev Cog";
$mail->SetFrom($email_address, $name);
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
//debugar
$mail->SMTPDebug = 1;

$mail->Host = 'smtp.gmail.com';      // sets GMAIL as the SMTP server
$mail->Port = '587';     // set the SMTP port for the GMAIL server
$mail->Username = 'appdevcog@gmail.com'; // username
$mail->Password = '230888muk@'; // password
//        die(
//                $primeiroEmail . ' - ' .
//                $this->getSsl() . ' - ' .
//                $this->getHost() . ' - ' .
//                $this->getPorta() . ' - ' .
//                $this->getLogin() . ' - ' .
//                $this->getSenha()
//        );

$mail->AddAddress('samuel@devcog.com.br');
if (!$mail->Send()) {
    $error = 'Mail error: ' . $mail->ErrorInfo;
    return false;
} else {
    return true;
}
?>