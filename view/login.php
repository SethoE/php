<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Testen von XSS-Eingaben</title>
	<script src="../app.js" defer></script>
	<link rel="stylesheet" href="./style.css">
</head>
<body>
	<nav>
	<h1 class="header">XSS-Demo Site</h1>
	<h1 class="pageName">Login Page</h1>
		<ul>
			<li><a href="../index.php">Post</a></li>
			<li><a href="./get.php">Get</a></li>
			<li><a href="./login.php">Login</a></li>
		</ul>			
	</nav>
	<h1 style="text-align: center; margin-top: 50px;">Das ist eine Testeseite für Cross-Site-Scripting</h1>
	<form action="index.php" method="post" id="form_id">
		<h1 class="formHeader">Login</h1>
        <p>E-Mail: </p><input class="textInput" type="text" name="email" placeholder="Enter you e-mail here">
        <p>Password: </p><input class="textInput" type="password" name="password" placeholder="Enter you password here">
        <input type="submit" name="login" value="Login">
	</form>

</body>
</html>