<?php

// Open a new connection to the MySQL server
$mysqli = new mysqli('localhost', 'root', '', 'perfectcup_db');

// Output any connection error
if ($mysqli->connect_error) {
  die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$fname    = mysqli_real_escape_string($mysqli, $_POST['fname']);
$email    = mysqli_real_escape_string($mysqli, $_POST['email']);
$message = mysqli_real_escape_string($mysqli, $_POST['message']);

$email2  = "admin@theperfectcup.com";
$subject = "test message"; 

// Validation

if (strlen($fname) > 50) {
  echo 'fname_long';

} elseif (strlen($fname) < 2) {
  echo 'fname_short';

} elseif (strlen($email) > 50) {
  echo 'email_long';

} elseif (strlen($email) < 2) {
  echo 'email_short';

} elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  echo 'eformat';

} elseif (strlen($message) > 500) {
  echo 'message_long';

} elseif (strlen($message) < 3) {
  echo 'message_short';

} else {

  require 'PHPMailer/get_oauth_token.php';

  $mail = new PHPMailer;

//Small->SMTPDebug = 3;                                       // Enable verbose debug output
$mail->isSMTP();                                              // Set mailer to use SMT
$mail->Host = 'smtp.gmail.com';                               // Specify main and backup АТТР servers
$mail->SMTPAuth = true;                                       // Enable SMTP authentic
$mail->Username = 'admin@theperfectcup.com';                  // SMTP username
$mail->Password = '';                                         // SMTP password
$mail->SMTPSecure = 'tls';                                    // Enable TLS encryption, 'ssl' also accepted
$mail->Port = 587;                                            // TCP port to connect to
$mail->AddReplyTo($email);
$mail->From = $email2;
$mail->FromName = $fname;
$mail->addAddress ('admin@theperfectcup.com', Admin);         // Add a recipient
$mail->isHTML (true);                                         // Set email format to H
$mail->subject = $subject;
$mail->Body = $message;
$mail->AltBody = 'this is the body in plain text for non-HTML mail clients';
if (!$mail->send()) {
  echo 'Message could not be sent.';
  echo 'Mailer Error:'. $mail->ErrorInfo;

} else {
  echo 'true';
  }
  
}
?>