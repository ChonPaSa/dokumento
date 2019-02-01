<?php
session_start();
//function to remove empty spaces and special characters from strings
function clean_string($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
$text="";
//#########abmelden####
if(isset($_POST["Bestaetigen"]) && $_POST["Bestaetigen"] == "Bestaetigen")
{
	if ($_SESSION["url"]!="")
	{
		unlink($_SESSION["url"]);
	}
	session_destroy();  //datei zerstören
	unset($_SESSION);  //variable löschen
}
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

//############Navigation
$page = $_GET["page"] ?? "startseite"; 
switch($page)
{
	case "startseite":
		include("pages/startseite.php"); 
	break;
	case "hochladen":
		include("pages/hochladen.php");
	break;
	case "hochladen2":
		include("pages/hochladen2.php");
	break;	
	case "suchen":
//########################################bearbeiten
	if(isset($_POST["bearbeitung_speichern"]) && $_POST["bearbeitung_speichern"] == "Änderungen speichern")
	{	
		$connect = mysqli_connect("localhost","libreto","kurs","dokumente");
		mysqli_query($connect, "SET NAMES utf8");
		$Err=0;
		if (!empty($_POST["docname"]))
		{
			$docname = clean_string($_POST["docname"]);
			$sql= 'UPDATE docs SET name = "'.$docname.'" 
					WHERE Nr = "'.$_POST["dokNr"].'"';
			mysqli_query($connect, $sql);
			//prüfen ob die Änderung erfolgreich warning
			if($connect->affected_rows == 1)
			{
				//$text.='<span class="warning">Der name wurde erfolgreich geändert</span>';
			}
			else
			{
				//$text.='<span class="warning">Der Name wurde nicht geändert</span>';
				if($connect->error || $connect->affected_rows == -1)
					$text.= '<span class="warning">Fehler. Versuchen Sie später noch ein mal...</span>';
					$text.= $connect->error;
			}
		}
		//remove Schlagworte
		$sql ='DELETE FROM zwischentabelle WHERE DokNr = "'.$_POST["dokNr"].'"';
		mysqli_query($connect, $sql);
		//add Schlagworte
		if (isset($_POST["schlagworte"]))
		{
			for ($i=0; $i < count($_POST["schlagworte"]); $i++)
			{
				$sql= "INSERT INTO zwischentabelle (DokNr, SchlagwortNr) 
				 VALUES (".$_POST["dokNr"].", ".$_POST["schlagworte"][$i].")";
				mysqli_query($connect, $sql);
			}
		}
		if(isset($_POST["kategorie"]))
		{
			$sql= 'UPDATE docs SET kategorie = "'.$_POST["kategorie"].'" 
				WHERE Nr = "'.$_POST["dokNr"].'"';
			mysqli_query($connect, $sql);
		}
		if(isset($_POST["abs_emp"]))
		{
			$sql= 'UPDATE docs SET absender = "'.clean_string($_POST["abs_emp"]).'" 
				WHERE Nr = "'.$_POST["dokNr"].'"';
			mysqli_query($connect, $sql);
		}
		if(isset($_POST["ablage"]))
		{
			$sql= 'UPDATE docs SET ablageort = "'.clean_string($_POST["ablage"]).'" 
				WHERE Nr = "'.$_POST["dokNr"].'"';
			mysqli_query($connect, $sql);
		}
		if(isset($_POST["datum"]))
		{
			$sql= 'UPDATE docs SET datum = "'.$_POST["datum"].'" 
				WHERE Nr = "'.$_POST["dokNr"].'"';
			mysqli_query($connect, $sql);
		}			
		mysqli_close($connect);
	}
		if(isset($_POST["dokument_loeschen"]) && $_POST["dokument_loeschen"] == "Bestätigen")
		{
			$connect = mysqli_connect("localhost","libreto","kurs","dokumente");
			mysqli_query($connect, "SET NAMES utf8");
			$sql = 'SELECT url FROM docs WHERE Nr = "'.$_POST["dokNr"].'"';
			$result = mysqli_query($connect, $sql);
			$url = mysqli_fetch_array($result)[0];
			unlink ($url);
			$sql= 'DELETE FROM docs WHERE Nr = "'.$_POST["dokNr"].'"';
			mysqli_query($connect, $sql);
			$sql= 'DELETE FROM zwischentabelle WHERE DokNr = "'.$_POST["dokNr"].'"';
			mysqli_query($connect, $sql);
			mysqli_close($connect);
		}
 	if(isset($_GET["dokNr"]))
		{
			if(isset($_GET["bearbeiten"]))
			{
				include("pages/suchen_bearbeitung.php");
			}
			if(isset($_GET["loeschen"]))
			{
				include("pages/suchen_loeschen.php");
			}
		}
		else
		{
			include("pages/suchen.php");	
		}
	break;
	case "verwalten":
		include("pages/verwalten.php");
		break;
	case "register":
		include("pages/register.php");
		break;
	case "reset":
		include("pages/reset.php");
		break;	
	case "forgotten":
		include("pages/forgotten.php");
		break;	
	case "logout":
		include("pages/logout.php");
		break;
	default:
		include("pages/404.php");
}
require("main.php"); 
echo $html;
?>