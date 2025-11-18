<?php  ?>
<h1 class="title">
	Login
</h1>

<form action="login.php" method="post">
	<div class="input-container">
		<label for="username">Username</label>
		<input type="text" name="username" id="username">
	</div>

	<div class="input-container">
		<label for="password">Password</label>
		<input type="password" name="password" id="password">
	</div>

	<button type="submit">Login</button>

	<p>
		Belum memiliki akun? <a href="register.php">Register</a>
	</p>
</form>