<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//required files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
if (isset($_POST['mail'])) {

  $email = $_POST['email'];
  
  $mail = new PHPMailer(true);

    //Server settings
    $mail->isSMTP();                              //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;             //Enable SMTP authentication
    $mail->Username   = 'noreplylegaldespositnln@gmail.com';   //SMTP write your email
    $mail->Password   = 'nmtvjehuqhuwmrnp';      //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
    $mail->Port       = 465;                                    

    //Recipients
    $mail->setFrom( 'donotreplylegaldepo@nln.com', 'NLN Legal Deposit Team'); // Sender Email and name
    $mail->addAddress($email);     //Add a recipient email  
    $mail->addReplyTo('noreplylegaldespositnln@gmail.com', 'NLN Legal Deposit Team'); // reply to sender email

    //Content
    $subM = "Reminder of Outstanding Legal Deposit Obligation";
    $e_body = "Dear . Please you have an outstanding amount of Legal deposit. Please do so to fulfill your obligations";
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject = $subM;   // email subject headings
    $mail->Body    = $e_body; //email message

    // Success sent message alert
    $mail->send();
    
    echo 'Successful';
}
else{
  echo 'FAILED';
}
?>