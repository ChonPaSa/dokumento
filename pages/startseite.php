<?php
$text .= "<div class='landing'><img src='img/documents.png'/>";
$Err = 0;
$loginErr = $passErr = "";

if(isset($_POST["login"]))
{

	$passwort = clean_string($_POST["passwort"]);
	if (empty($_POST["login"]))
	{
		$Err++;
		$loginErr = "Benutzername kann nicht leer sein";
	}
	else
	{
		$login = clean_string($_POST["login"]);
	}
	if (empty($_POST["passwort"]))
	{
		$Err++;
		$passErr = "Passwort kann nicht leer sein";
	}
	else
	{
		$passwort = clean_string($_POST["passwort"]);
	}
	if ($Err == 0)
	{
$connect = mysqli_connect("localhost", "ChangeMe", "ChangeMe", "ChangeMe");
		mysqli_query($connect, "SET NAMES utf8");
		$sql= "SELECT * FROM mitarbeiter 
				WHERE login = '".$login."' 
				AND passwort = sha1('".$passwort."') AND access = 1";
		$antwort = mysqli_query($connect, $sql);
		if ($antwort->num_rows == 1)
		{
			$_SESSION["erfolgreich_eingeloggt"] = true;
			$_SESSION["user_name"] = $login;
		}
		else
		{
			$Err++;
			$loginErr = "Zugangsdaten nicht gültig";
		}
	}
}

$passErr = '<span class= "error">'.$passErr.'</span>';
$loginErr = '<span class= "error">'.$loginErr.'</span>';

if (isset($_SESSION["user_name"]))
{
	$headline =  "Herzlich willkommen ".$_SESSION["user_name"];
	//########check zugangsdaten
	$links="";
	if(!isset($_SESSION["erfolgreich_eingeloggt"]))
	{
		$links.= '';
	}	
	if(isset($_SESSION["erfolgreich_eingeloggt"]))
	{
		$links.='<li><a href="?page=hochladen">Hochladen</a></li>
			<li><a href="?page=suchen">Suchen</a></li>
			<li><a href="?page=verwalten">Verwalten</a></li>		
			<li><a href="?page=logout">Logout</a></li>';
	}
}
else
{
$headline="Bitte melden Sie sich an";

$text.='<form action="?page=startseite" method="post">
Login: '.@$loginErr.'<br/>
<input class="quarter" type="text" name="login" /><br/>
Passwort: '.@$passErr.'<br/>
<input class="quarter" type="password" name="passwort" /><br/>
<input type="submit" value="Anmelden" /><br/>
<a href="?page=register">Registrieren</a><a href="?page=forgotten">Passwort vergessen?</a>
</form>
</div>';
}
?>