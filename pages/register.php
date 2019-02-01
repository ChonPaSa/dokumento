<?php
$headline = "Konto anlegen";
$connect = mysqli_connect("localhost", "ChangeMe", "ChangeMe", "ChangeMe");
if (mysqli_connect_errno())
  {
  echo "Fehler: " . mysqli_connect_error();
  }
mysqli_query($connect, "SET NAMES utf8"); //Die Übertragung auf UTf-8 umstellen
$Err = $vornameErrBool = $nameErrBool = $emailErrBool = $usernameErrBool = $passwordErrBool= $password2ErrBool = 0;
$vornameErr = $nameErr = $emailErr = $usernameErr = $passwordErr = $password2Err = "";

if(isset($_POST["username"]))
{
	if (!empty($_POST['vorname']))
	{
		$vorname = clean_string($_POST['vorname']);
	}
	else
	{
		$Err++;
		$vornameErr= "Vorname kann nicht leer sein";
		$vornameErrBool = 1;
	}
	if (!empty($_POST['name']))
	{
		$name = clean_string($_POST['name']);
	}
	else
	{
		$Err++;
		$nameErr= "Name kann nicht leer sein";
		$nameErrBool = 1;
	}	
	if (!empty($_POST['username']))
	{
		$username = clean_string($_POST['username']);
	}
	else
	{
		$Err++;
		$usernameErr= "Benutzername kann nicht leer sein";
		$usernameErrBool = 1;
	}	

	if (!empty($_POST['passwort']))
	{
		$passwort = clean_string($_POST['passwort']);
		if (strlen($passwort) < 8)
		{
			$Err++;
			$passwordErr = "Das Passwort must midenstens 8 Zeichen lang sein";
			$passwordErrBool = 1;
		}
		elseif (!preg_match("#[A-Z]+#", $passwort))
		{
			$Err++;
			$passwordErr = "Das Passwort muss mindestens einen Großbuchstabe umfassen";
			$passwordErrBool = 1;
		}
		elseif (!preg_match("#[a-z]+#", $passwort))
		{
			$Err++;
			$passwordErr = "Das Passwort muss mindestens einen Kleinbuchstabe umfassen";
			$passwordErrBool = 1;
		}	
		elseif (!preg_match("#[0-9]+#", $passwort))
		{
			$Err++;
			$passwordErr = "Das Passwort muss mindestens eine Ziffern umfassen";
			$passwordErrBool = 1;
		}
	}
	else
	{
		$Err++;
		$passwordErr= "Password kann nicht leer sein";
		$passwordErrBool = 1;
	}	
	if (!empty($_POST['passwort2']))
	{
		$passwort2 = clean_string($_POST['passwort2']);
		if ($passwort != $passwort2)
		{
			$Err++;
			$password2Err= "Passworter nicht identisch";
			$password2ErrBool = 1;
		}
	}
	else
	{
		$Err++;
		$password2Err= "Passwort kann nicht leer sein";
		$password2ErrBool = 1;
	}	
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
		$passwort = sha1($passwort);
		$sql = 'SELECT * FROM mitarbeiter WHERE login = "'.$username.'"';
		$result = mysqli_query($connect, $sql);
		if($connect->affected_rows > 0)
		{
			$Err++;
			$usernameErr = "Benutzer ist schon vorhanden";
			$usernameErrBool = 1;
		}
		else
		{
			$sql = "insert into mitarbeiter (login, vorname, name, email, passwort, access)
					values ('$username','$vorname','$name','$email','$passwort', 1)";	
			mysqli_query($connect, $sql);
			$text = "<h2>Ihre Konto wurde angelegt...</h2> <p>Deine Konto wird vom Admin geprüft...</p>";
		}
	}

}

$passwordErr = '<span class= "error">'.$passwordErr.'</span>';
$password2Err = '<span class= "error">'.$password2Err.'</span>';
$nameErr = '<span class= "error">'.$nameErr.'</span>';
$vornameErr = '<span class= "error">'.$vornameErr.'</span>';
$usernameErr = '<span class= "error">'.$usernameErr.'</span>';
$emailErr = '<span class= "error">'.$emailErr.'</span>';


if(!isset($_POST["username"]) || $Err > 0 )
{	
	$text .= '<form action="" method="post">
	  <fieldset>
	   <legend>Daten eingeben</legend>
	   <label for="username">Benutzername <sup>*</sup>: '.@$usernameErr.'</label><br />
			<input type="text" class="half';
			$text.= ($usernameErrBool? ' errorBox ': '');
			$text.='" name="username" value="'.@$username.'" /><br />
		<label for="vorname">Vorname <sup>*</sup>: '.@$vornameErr.'</label><br />
			<input type="text" class="half';
			$text.= ($vornameErrBool? ' errorBox ': '');
			$text.='" name="vorname" value="'.@$vorname.'" /><br />
		<label for="name">Name <sup>*</sup>: '.@$nameErr.'</label><br />
			<input type="text" class="half';
			$text.= ($nameErrBool? ' errorBox ': '');
			$text.='" name="name" value="'.@$name.'" /><br />
	   <label for="email">Email <sup>*</sup>: '.@$emailErr.'</label><br />
			<input type="text" class="half';
			$text.= ($emailErrBool? ' errorBox ': '');
			$text.='" name="email" value="'.@$email.'" /><br />
		<label for="passwort">Passwort <sup>*</sup> <i class="fas fa-info-circle small" title="mindestens 8 Ziechen. Kleinbuchstabe, Großbuchstabe und Ziffern"></i>: '.@$passwordErr.'</label><br />
			<input type="password" class="half';
			$text.= ($passwordErrBool? ' errorBox ': '');
			$text.='" name="passwort" /> <br />
		<label for="passwort2">Passwort wiederholen <sup>*</sup>: '.@$password2Err.'</label><br />
			<input type="password" class="half';
			$text.= ($password2ErrBool? ' errorBox ': '');
			$text.='" name="passwort2" /><br />				
	  </fieldset>
	 <input type="submit" value="Registrieren">
	 <input type="reset">
	  </form>
	';
}
$text.='<a href="?page=startseite"><i class="fas fa-caret-square-left"></i></a>';	
mysqli_close($connect);
?>	






















	