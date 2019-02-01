<?php
$headline = "Passwort vergessen";
$connect = mysqli_connect("localhost", "ChangeMe", "ChangeMe", "ChangeMe");
if (mysqli_connect_errno())
  {
  echo "Fehler: " . mysqli_connect_error();
  }
mysqli_query($connect, "SET NAMES utf8"); //Die Übertragung auf UTf-8 umstellen
$Err = $emailErrBool = 0;
$emailErr = "";

if(isset($_POST["email"]))
{	
	if (!empty($_POST['email']))
	{
		$email = clean_string($_POST['email']);
		if ((strlen($email) < 6) || (!filter_var($email, FILTER_VALIDATE_EMAIL)))
		{
			$Err++;
			$emailErr = "Email nicht gültig";
			$emailErrBool = 1;
		}
	}
	else
	{
		$Err++;
		$emailErr= "email kann nicht leer sein";
		$emailErrBool = 1;
	}	
	if ($Err == 0)
	{
		$sql = "SELECT * FROM mitarbeiter WHERE email = '$email'";	
		$result = mysqli_query($connect, $sql);
		if($connect->affected_rows == 1)
		{	
			$betreff = "Neue Password für Dokumento";
			$nachricht = "Um die Passwort neue zu setzen. Klicken Sie hier: ";
			$recoverid = uniqid();
			$datum = date('Y-m-d H:i:s', strtotime('+30 minutes'));
			$nachricht .= "<br>http://localhost/Projekt_Doks/?page=reset&recoverid=$recoverid";
			$nachricht .= " Dieser Link ist gültig nur für 30 minuten";
			$meta = "From:admin@dokumento.de\n";  // \n neue Zeile = beendet die Anweisung
			$meta .= "X-Mailer: PHP/".phpversion()."\n"; //X-Mailer: PHP/ 7.3
			$meta .= "X-Sender-IP: ".$_SERVER["REMOTE_ADDR"]."\n"; 
			$meta .= "MIME-Version: 1.0\r\n";
			$meta .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			mail($email, $betreff, $nachricht, $meta);
			$sql = "INSERT INTO recovery (email, recoverid, datum)
					VALUES ('$email','$recoverid','$datum')";
			mysqli_query($connect, $sql);
			$text = "<h2>Ein email wurde gesendet...</h2>";
		}
		else
		{
			$Err++;
			$emailErr= "email nicht in der Datenbank";
			$emailErrBool = 1;
			
		}
	}
}

$emailErr = '<span class= "error">'.$emailErr.'</span>';
if(!isset($_POST["email"]) || $Err > 0)
{	
	$text .= '<form action="" method="post">
	  <fieldset>
	   <legend>Email Adresse eingeben</legend>
	    <label for="email">Email: '.@$emailErr.'</label><br />
			<input type="text" class="half';
			$text.= ($emailErrBool? ' errorBox ': '');
			$text.='" name="email" /><br />
	  </fieldset>
	 <input type="submit" value="Reset Email senden">
  </form>
	';
}
$text.='<a href="?page=startseite"><i class="fas fa-caret-square-left"></i></a>';
mysqli_close($connect);
?>	






















	