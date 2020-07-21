<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: galeria.php');
		exit();
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Michał Barełkowski</title>	
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Lato:400,900&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>

<body>
	
	<div id="container">
	
		<div id="logo">
			Projekt zaliczeniowy - Aplikacje Internetowe
		</div>
		
		<div id="topbar">
			<div id="topbarL">
				<img src="politechnik.jpg" />
			</div>
			<div id="topbarR">
				<span class="bigtitle">Witaj na mojej stronie!</span>
				<div style="height: 15px;"></div>
				Strona zawiera elementy wymagane do zaliczenia przedmiotu takie jak: wzory matematyczne, galeria zdjęć, gra interaktywna, czy formularz logowania. Każdy z nich znajduje się na osobnej podstronie umieszczonej w nawigacji po lewej stronie ekranu. <br> Życzę miłego oglądania!
			</div>
			<div style="clear:both;"></div>
		</div>
		
		<div id="sidebar">
			<a href ='index.php' class = 'tilelink'><div class="optionL">Strona główna</div></a>
			<a href ='wzory.php' class = 'tilelink'><div class="optionL">Wzory</div></a>
			<a href ='galeria.php' class = 'tilelink'><div class="optionL">Galeria</div></a>
			<a href ='gra.php' class = 'tilelink'><div class="optionL">Gra</div></a>
			<a href ='logowanie.php' class = 'tilelink'><div class="optionL">Logowanie</div></a>
			<a href ='rejestracja.php' class = 'tilelink'><div class="optionL">Rejestracja</div></a>
		</div>
		
		<div id="content">
		<span class="bigtitle">Logowanie</span>
			
			<div class="dottedline"></div>
			<form action ="zaloguj.php" method="post">
				
				Login: <br /> <input type="text" name="login" /> <br />
				Hasło: <br /> <input type="password" name="haslo" /> <br /> <br />
				<input type="submit" value="Zaloguj się" />
			</form><br />
		<?php
		 if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
		?>
		
		</div>
		
	<footer>
	
		<div class="socials">
			<div class="socialdivs">
				<div class="fb">
					<br>
					<a href="http://facebook.com" class="img">
					<img src="facebook.png" alt="Facebook">
					</a>
				</div>
				<div class="yt">
					<br>
					<a href="http://youtube.com" class="img">
					<img src="youtube.jpg" alt="YouTube">
					</a>
				</div>
				<div class="tw">
				<br>
					<a href="http://twitter.com" class="img">
					<img src="twitter.png" alt="Twitter">
					</a>
				</div>
				<div class="ig">
					<br>
					<a href="http://instagram.com" class="img">
					<img src="instagram.jpg" alt="Instagram">
					</a>
				</div>
				<div style="clear:both"></div>
			</div>
		</div>
		
		<div id="footer">
			Wydział Informatyki Politechniki Poznańskiej - Automatyka i Robotyka  &copy Michał Barełkowski.
		</div>
	</footer>
	
	</div>
	
</body>
</html>