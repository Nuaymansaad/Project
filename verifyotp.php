<!DOCTYPE html>
<html>
<head>
	<title>Verify OTP and Reset Password</title>
	<style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
      }
      h2 {
        text-align: center;
        color: #555;
      }
      form {
        max-width: 400px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
      }
      label {
        display: block;
        margin-bottom: 10px;
        color: #555;
      }
      input[type="email"] {
        display: block;
        width: 93%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
      }
      input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
      }
      input[type="submit"]:hover {
        background-color: #45a049;
      }
      .otp-section {
        display: none;
      }
    </style>
	</style>
</head>
<body>
	<h2>Verify OTP and Reset Password</h2>
	<?php
	// Start the session
	session_start();

	// Check if the form has been submitted for verifying OTP
	if (isset($_POST["verify"])) {
		// Retrieve the OTP and email from the form data
		$otp = $_POST["otp"];
		
		if (isset($_SESSION["email"])) {
			$email = $_SESSION["email"];

			// Retrieve the OTP from the database for the email address
			$conn = mysqli_connect("localhost", "root", "", "rentit");
			$sql = "SELECT * FROM users WHERE email='$email'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);

			if ($row && $row["otp"] == $otp) {
				// The OTP is correct. Show the password reset form.
				echo "<form action='resetpassword.php' method='post'>";			
			} else {
				// The OTP is incorrect. Show an error message.
				echo "<div class='error'>Invalid OTP. Please try again.</div>";
			}
		} else {
			// The email key is not set in the session. Show an error message.
			echo "<div class='error'>Invalid email address.</div>";
		}
	}
	?>
	<form action="" method="post">
		<label for="otp">Enter OTP:</label>
		<input type="text" id="otp" name="otp" required><br><br>
		<input type="submit" name="verify" value="Verify OTP">
	</form>
</body>


</html>
