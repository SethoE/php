<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Testen von XSS-Eingaben</title>
	<script src="../app.js" defer></script>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<nav>
	<h1 class="header">XSS-Demo Site</h1>
	<h1 class="pageName">GET Page</h1>
		<ul>
			<li><a href="../index.php">Post</a></li>
			<li><a href="./get.php">Get</a></li>
			<li><a href="./login.php">Login</a></li>
		</ul>			
	</nav>
	<h1 style="text-align: center; margin-top: 50px;">Das ist eine Testeseite für Cross-Site-Scripting</h1>
	<form action="./get.php" method="get" id="form_id">

		<h1 class="formHeader">Eigabefelder</h1>
		<p>Vorname:<input class="textInput" name="fname" type="text" placeholder="Dein Vornamen eingeben"></p>
		<p>Nachname:<input class="textInput" name="lname" type="text" placeholder="Dein Nachnamen eingeben"></p>
        <p>Ich bin ein/e Programmierer/in : <input type="checkbox" name="programmer"></p>
        <p>Unter 18:<input type="radio" name="age" value="under18"></p>
        <p>Über 18:<input type="radio" name="age" value="offer18"></p>
        <div class="favFood">
			<p>Lieblingsessen:</p>
			<select name="favFood">
                <option disabled selected hidden> -- select an option --</option>
                <option value="pizza">Pizza</option>
                <option value="spaghetti">Spaghetti</option>
                <option value="kebab">Döner Kebab</option>
                <option value="sushi">Sushi</option>
                <option value="ramen">Ramen</option>
			</select>
		</div>
        <input type="submit" value="Submit">
	</form>
	<?php
	if(isset($_GET["fname"]) || isset($_GET["lname"]) || isset($_GET["programmer"]) || isset($_GET["age"]) || isset($_GET["favFood"])) {
		$firstname = $_GET["fname"];
		$lastname = $_GET["lname"];
		if(!isset($_GET["programmer"])) {
			$isProgrammer = "kein/e Programmierer/in";
		} else {
			$isProgrammer = "ein Programmierer";
		}
		$age = $_GET["age"];
		$favoriteFood = $_GET["favFood"];	
	?>
	<h2>Hallo <?=$firstname?> <?=$lastname?>, <br> Wie ich sehe bist du <?php?><?=$isProgrammer?> und <?=$age?>. Dazu ist dein Lieblingsessen <?=$favoriteFood?></h2>
	<?php }?>
</body>
</html>