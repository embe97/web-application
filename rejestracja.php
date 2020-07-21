<?php

	session_start();
	
	if (isset($_POST['email']))
	{
		$wszystko_OK=true;
		
		$nick = $_POST['nick'];
		
		if ((strlen($nick)<3) || (strlen($nick)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nick musi posiadać od 3 do 20 znaków!";
		}
		
		if (ctype_alnum($nick)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
		

		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail!";
		}
		

		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		
		if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
		}
		
		if ($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Podane hasła nie są identyczne!";
		}	

		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
			
		

		$_SESSION['fr_nick'] = $nick;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_haslo1'] = $haslo1;
		$_SESSION['fr_haslo2'] = $haslo2;
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{

				$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$email'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				if($ile_takich_maili>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
				}		


				$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE user='$nick'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_nickow = $rezultat->num_rows;
				if($ile_takich_nickow>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_nick']="Istnieje już gracz o takim nicku! Wybierz inny.";
				}
				
				if ($wszystko_OK==true)
				{

					
					if ($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$nick', '$haslo1', '$email')"))
					{
						$_SESSION['udanarejestracja']=true;
						header('Location: logowanie.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
				}
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera!</span>';
			//echo '<br />Exception info: '.$e;
		}
		
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
			<span class="bigtitle">Rejestracja</span>
			
			<div class="dottedline"></div>
			
			<form method="post">
	
		Login: <br /> <input type="text" value="<?php
			if (isset($_SESSION['fr_nick']))
			{
				echo $_SESSION['fr_nick'];
				unset($_SESSION['fr_nick']);
			}
		?>" name="nick" /><br />
		
		<?php
			if (isset($_SESSION['e_nick']))
			{
				echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
				unset($_SESSION['e_nick']);
			}
		?>
		
		E-mail: <br /> <input type="text" value="<?php
			if (isset($_SESSION['fr_email']))
			{
				echo $_SESSION['fr_email'];
				unset($_SESSION['fr_email']);
			}
		?>" name="email" /><br />
		
		<?php
			if (isset($_SESSION['e_email']))
			{
				echo '<div class="error">'.$_SESSION['e_email'].'</div>';
				unset($_SESSION['e_email']);
			}
		?>
		
		Twoje hasło: <br /> <input type="password"  value="<?php
			if (isset($_SESSION['fr_haslo1']))
			{
				echo $_SESSION['fr_haslo1'];
				unset($_SESSION['fr_haslo1']);
			}
		?>" name="haslo1" /><br />
		
		<?php
			if (isset($_SESSION['e_haslo']))
			{
				echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
				unset($_SESSION['e_haslo']);
			}
		?>		
		
		Powtórz hasło: <br /> <input type="password" value="<?php
			if (isset($_SESSION['fr_haslo2']))
			{
				echo $_SESSION['fr_haslo2'];
				unset($_SESSION['fr_haslo2']);
			}
		?>" name="haslo2" /><br />
		
		
		<br />
		
		<input type="submit" value="Zarejestruj się" />
		
	</form>
			
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