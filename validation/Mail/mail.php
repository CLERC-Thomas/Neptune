<?php

require "factures/facture.php";
require ("vendor/phpmailer/phpmailer/src/SMTP.php");
require ("vendor/phpmailer/phpmailer/src/Exception.php");
require ("vendor/phpmailer/phpmailer/src/PHPMailer.php");

$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->IsSMTP();

$mail->CharSet="UTF-8";
$mail->Host = "smtp.free.fr";
$mail->Port = 465 ; //465 or 587

$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->IsHTML(true);

//Authentication
$mail->Username = "neptune.contacte";
$mail->Password = "neptune123";

//Set Params
$mail->SetFrom("neptune.contacte@free.fr");
$mail->AddAddress($_SESSION['mail']);
$mail->Subject = "Reservation Hôtel Neptune";
$file='https://cdn.discordapp.com/attachments/386539558214434818/684473275417362432/mail.html';
$mail->Body = file_get_contents($file);
$mail->addStringAttachment ($content_PDF, 'Reservation: '.$client['firstname']."_".$client['lastname'].'.pdf', 'base64', 'application/pdf');



$mail->Send();

$mail->SmtpClose();
unset($mail);
?>