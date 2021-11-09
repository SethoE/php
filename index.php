<?php 
session_start();
if(!isset($_SESSION["authentication"])) {
	$_SESSION["authentication"] = "";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Testen von XSS-Eingaben</title>
	<script src="./app.js" defer></script>
	<link rel="stylesheet" href="style.css">
	<?php include("search.php");?>
</head>
<body>
	<nav>
	<h1 class="header">XSS-Demo Site</h1>
	<h1 class="pageName">POST Page</h1>
		<ul>
			<li><a href="./index.php">Post</a></li>
			<li><a href="./view/get.php">Get</a></li>
			<?php
		if($_SESSION["authentication"] == true) {
			?>
			<li><a href="./view/login.php">Logout</a></li>

		<?php 
		} else { 
			?>
			<li><a href="./view/login.php">Login</a></li>
		<?php	
		}
		?>
		</ul>			
	</nav>
	<h1 style="text-align: center; margin-top: 50px;">Das ist eine Testeseite für Cross-Site-Scripting</h1>
	<?php
		if($_SESSION["authentication"] == true) {
			echo "<p style='color: black; text-align: center;'>Authentication status: <span style='color: green'>true</span></p>";
		} else {
			echo "<p style='color: black; text-align: center;'>Authentication status: <span style='color: red'>false</span></p>";
		}
		?>
	<form action="index.php" method="post" id="form_id">
		<div style="display: flex; justify-content: center; gap: 10px">
		<p>Eingabefeld: </p><input type="text" name="search" placeholder="Bitte füge hier dein XSS ein" value="">
		<input id="submit" type="submit">
		</div>
	</form>
	
	<?php
	if(isset($_POST["search"])) {
		$userinput = $_POST["search"];
		$string = filterPost($userinput);
		?>
		<h2 id="output" style="text-align: center; margin-top: 100px;">Sie haben folgendes eingegeben: <span style="color: green;"><?=$string?></span></h2>
		<?php
		}
	?>
</body>
</html>
<!--

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Testen von XSS-Eingaben</title>
</head>
<body>
	<form action="search.php" method="post">
		<input type="text" name="search" value="<?php
		if(isset($_POST["search"])) {
		echo $_POST["search"];
		}
	?>"
	>
		<input type="submit">
	</form>
	<?php
		if(isset($_POST["search"])) {
		echo "<p>Sie haben folgendes eingegeben</br> ".strip_tags($_POST["search"])."</p>";
		echo "<p>Sie haben folgendes eingegeben</br> ".$_POST["search"]."</p>";
		}
	?>
</body>
</html>
	-->
