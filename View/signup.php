<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Create Your Account</title>
</head>

<body>
	<div class="register" text-align: center>
		<h1>Create Your Account</h1>
		<form action="register.php" method="post" autocomplete="off">
			<label for="email">email: </label>
			<input type="text" name="email" placeholder="email" id="email" required><br>
			<label for="password">Password: </label>
			<input type="password" name="password" placeholder="Password" id="password" required><br><br>
			<input type="submit" value="Register">
			<button onclick="location.href='login.php'">Login</button><br><br>
		</form>
	</div>
</body>

</html>

<?php
// Require the PDO library to connect to the database
require_once('pdo.php');

// Sanitize the user input
// This prevents malicious users from injecting SQL code or other harmful data into the database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = trim(htmlentities(strip_tags($_POST['email'])));
	$password = trim(htmlentities(strip_tags($_POST['password'])));
		// Check if the email already exists in the database
		// This prevents users from creating accounts with duplicate emails
		$sql = "SELECT COUNT(*) FROM users WHERE email = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(1, $email, PDO::PARAM_STR);
		$stmt->execute();
		$count = $stmt->fetchColumn();

		if ($count > 0) {
			echo "email already exists, please choose another!";
			exit();
		}

		// Hash the password
		// This encrypts the password so that it cannot be read by anyone who gains access to the database		
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		// Save the registration information in the database
		$sql = "INSERT INTO users (email, password) VALUES (?, ?)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(1, $email, PDO::PARAM_STR);
		$stmt->bindParam(2, $hashedPassword, PDO::PARAM_STR);
		$stmt->execute();

		// Display a success message
		echo "You have successfully regestered! You can login!";
	} else {
		echo "Please enter a valid email!";
	}



