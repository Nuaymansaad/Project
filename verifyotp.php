<?php
// Start the session
session_start();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Retrieve the user's email address from the form data
  $email = $_POST["email"];

  // Generate a random OTP and store it in the session
  $otp = rand(100000, 999999);
  $_SESSION["otp"] = $otp;
  $_SESSION["email"] = $email;

  // Send an email to the user with the OTP
  $to = $email;
  $subject = "Your OTP for password reset";
  $message = "Your OTP is: " . $otp;
  $headers = "From: noreply@example.com\r\n";
  $headers .= "Reply-To: noreply@example.com\r\n";
  $headers .= "Content-type: text/html\r\n";
  mail($to, $subject, $message, $headers);

  // Redirect the user to the OTP verification page
  header("Location: verifyotp.php");
  exit();
}
?>