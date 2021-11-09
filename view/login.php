<?php 
session_start();
if(!isset($_SESSION["authentication"])) {
	$_SESSION["authentication"] = "";
} 
?>
<!DOCTYPE html>
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
	<?php
		if($_SESSION["authentication"] == true) {
			?>
			<h1 class="pageName">Logout Page</h1>
		<?php 
		} else { 
			?>
			<h1 class="pageName">Login Page</h1>
		<?php	
		}
		?>
		<ul>
			<li><a href="../index.php">Post</a></li>
			<li><a href="./get.php">Get</a></li>
			<?php
		if($_SESSION["authentication"] == true) {
			?>
			<li><a href="./login.php">Logout</a></li>

		<?php 
		} else { 
			?>
			<li><a href="./login.php">Login</a></li>
		<?php	
		}
		?>
		</ul>
				
	</nav>
	<h1 style="text-align: center; margin-top: 50px;">Das ist eine Testeseite für Cross-Site-Scripting</h1>
	<?php
	$userdatabase = file("../database/users.txt"); // my data
	$counter = 0; // counter of speration of email and password
	$emails = array(); // initializing array
	$passwords = array(); // initializing array
	foreach($userdatabase as $user) { 
		$user_details = explode('|', $user); // This splits the string via a defined character. Such as this one: |
		foreach($user_details as $individual_data) {
			if(($counter % 2) == 0) {
				$emails[] = $individual_data;
			} else {
				$passwords[] = $individual_data;
			}
			$counter++;
		}
	}
	if(isset($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && isset($_POST["login"])) {
		$userInputEmail = $_POST["email"];
		$userInputPassword = $_POST["password"];
		$arrayLength = count($emails);
		for($i = 0; $i < $arrayLength; $i++) {
			if($userInputEmail == $emails[$i] && $userInputPassword == $passwords[$i]) {
				$_SESSION["authentication"] = true;
				break;
			} else {
				$_SESSION["authentication"] = false;
			}
		}
			
	}
	if($_SESSION["authentication"] == true) {
		echo "<p style='color: black; text-align: center;'>Authentication status: <span style='color: green'>true</span></p>";
	} else if($_SESSION["authentication"] == false && $_SESSION["authentication"] !="") {
		echo "<p style='color: black; text-align: center;'>Authentication status: <span style='color: red'>false</span></p>";
	}
	
	?>
	<?php if($_SESSION["authentication"] == false) {?>
	<form action="./login.php" method="post" id="form_id">
		<h1 class="formHeader">Login</h1>
        <p>E-Mail: </p><input class="textInput" type="text" name="email" placeholder="Enter you e-mail here">
        <p>Password: </p><input class="textInput" type="password" name="password" placeholder="Enter you password here">
		<?php if(empty($_POST["email"]) || empty($_POST["password"])) {?>
			<p style="color: red; text-align: center;">Please fill in both fields correctly!</p>
		<?php }?>
        <input type="submit" name="login" value="Login">
	</form>
	<h3 style="text-align: center;">Login Daten:</h3>
	<p style="color: black; margin-left: 35%">
		Email: <b>SethoEhrmann@email.de</b> Passwort: <b>123456</b> <br>
		Email: <b>TobiasSchaefer@email.de</b> Passwort: <b>123456</b> <br>
		Email: <b>ManuelAmbros@email.de</b> Passwort: <b>123456</b> <br>
		Email: <b>TestUser@email.de</b> Passwort: <b>password</b>
		</p>
	<?php 
	

} else {
	?>
	<form action="./login.php" method="post" id="form_id">
     <input type="submit" name="button" value="Logout">
	 </form>
	 <?php }
	 if(isset($_POST["button"])) {
		$_SESSION["authentication"] = false;
		header("Refresh:0");
	}
	 ?>
</body>
</html>