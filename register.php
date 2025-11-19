<?php
if (isset($_POST["register-submit"])) {
	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$konfirmasiPassword = $_POST["konfirmasi_password"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<h1 class="title">
		Register
	</h1>

	<form action="register.php" method="post">
		<div class="input-container">
			<label for="username">Username</label>
			<input type="text" name="username" id="username">
		</div>

		<div class="input-container">
			<label for="email">Email</label>
			<input type="text" name="email" id="email">
		</div>

		<div class="input-container">
			<label for="password">Password</label>
			<input type="password" name="password" id="password">
		</div>

		<div class="input-container">
			<label for="konfirmasi-password">Konfirmasi Password</label>
			<input type="password" name="konfirmasi-password" id="konfirmasi-password">
		</div>

		<button type="submit" name="register-submit" value="register-submit">
			Register
		</button>

		<p>
			Sudah memiliki akun? <a href="login.php">Login</a>
		</p>
	</form>
</body>

</html>