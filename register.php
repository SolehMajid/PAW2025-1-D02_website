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

	<button type="submit">Register</button>

	<p>
		Sudah memiliki akun? <a href="login.php">Login</a>
	</p>
</form>