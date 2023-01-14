<?php
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// require  APPROOT. 'helper/libraries/PHPMailer/src/Exception.php';
// require 'helper/libraries/PHPMailer/src/PHPMailer.php';
// require 'helper/libraries/PHPMailer/src/SMTP.php';

// function send_mail(){

//     //Create an instance; passing `true` enables exceptions
//     $mail = new PHPMailer(true);

//     try {
//         //Server settings
//         $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
//         $mail->isSMTP();                                            //Send using SMTP
//         $mail->Host       = 'smtp.gamil.com';                     //Set the SMTP server to send through
//         $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//         $mail->Username   = 'whiteangle654123@gmail.com';                     //SMTP username
//         $mail->Password   = '0112729729';                               //SMTP password
//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
//         $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//         //Recipients
//         $mail->setFrom('whiteangle654123@gmail.com', 'Test Mail');
//         $mail->addAddress('hackdarkmi7@gmail.com');     //Add a recipient
//         $mail->addReplyTo('whiteangle654123@gmail.com');

//         //Attachments
//         // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//         // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

//         //Content
//         $mail->isHTML(true);                                  //Set email format to HTML
//         $mail->Subject = 'Here is the subject';
//         $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//         $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//         $mail->send();
//         echo 'Message has been sent';
//     } catch (Exception $e) {
//         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//     }

// }
