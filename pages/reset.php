<?php

//Form Validation Vars
$passwort= $passwort2 = $passwortErr = $passwort2Err = "";
$Err = $passwortErrBool = $passwort2ErrBool = 0;

$headline = "Passwort Reset";
$connect = mysqli_connect("localhost", "ChangeMe", "ChangeMe", "ChangeMe");
if (mysqli_connect_errno())
  {
  echo "Fehler: " . mysqli_connect_error();
  }
mysqli_query($connect, "SET NAMES utf8"); //Die Übertragung auf UTf-8 umstellen

if((isset($_GET["recoverid"]) && $_GET["recoverid"] != ""))
{
	$sql = "SELECT * FROM recovery WHERE recoverid = '".$_GET["recoverid"]."'";	
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result);
	$email = $row["email"];
	if(($result -> num_rows == 1) &&($row["datum"] >= date("Y-m-d H:i:s")))
	{	
		$linkGultig = 1;
		if(isset($_POST["passwort"]))
		{	
			if(!empty($_POST['passwort']))
			{
				$passwort = clean_string($_POST['passwort']);
				if (strlen($passwort) < 8)
				{
					$Err++;
					$passwortErr = "Das Passwort must midenstens 8 Zeichen lang sein";
					$passwortErrBool = 1;
				}
				elseif (!preg_match("#[A-Z]+#", $passwort))
				{
					$Err++;
					$passwortErr = "Das Passwort muss mindestens einen Großbuchstabe umfassen";
					$passwortErrBool = 1;			
				}
				elseif (!preg_match("#[a-z]+#", $passwort))
				{
					$Err++;
					$passwortErr = "Das Passwort muss mindestens einen Kleinbuchstabe umfassen";
					$passwortErrBool = 1;		
				}	
				elseif (!preg_match("#[0-9]+#", $passwort))
				{
					$Err++;
					$passwortErr = "Das Passwort muss mindestens eine Ziffern umfassen";
					$passwortErrBool = 1;			
				}
			}
			else
			{
				$Err++;
				$passwortErr= "Passwort kann nicht leer sein";
				$passwortErrBool = 1;		
			}	
			if (!empty($_POST['passwort2']))
			{
				$passwort2 = clean_string($_POST['passwort2']);
				if ($passwort != $passwort2)
				{
					$Err++;
					$passwort2Err= "Passworter nicht identisch";
					$passwort2ErrBool = 1;			
				}
			}
			else
			{
				$Err++;
				$passwort2Err= "Passwort kann nicht leer sein";
				$passwort2ErrBool = 1;		
			}
		   if ($Err == 0)
			 {
				$passwort = sha1($passwort);
				$sql =  "UPDATE mitarbeiter SET passwort = '".$passwort."' WHERE email = '$email'";
				mysqli_query($connect, $sql);
				$text = "<h2>Ihre Passwort wurde geändert...</h2>";
			 }	
		}
			
	}
	else
	{
	   $text = "<h2>Link nicht gültig...</h2>";
	   $linkGultig = 0;
	}
}
$passwortErr ='<span class= "error">'.$passwortErr.'</span>';
$passwort2Err ='<span class= "error">'.$passwort2Err.'</span>';

if((!isset($_POST["passwort"]) || $Err > 0) && $linkGultig)
{
	$text.='<form action="" method="post"><fieldset><legend>Neue Passwort eingeben <i class="small fas fa-info-circle" title="mindestens 8 Ziechen. Kleinbuchstaben, Großbustaben und Ziffern"></i></legend><label for="passwort">Passwort: '.@$passwortErr.'</label><br />
						<input type="password" class="half ';
						$text.= ($passwortErrBool? ' errorBox ': '');
						$text.= '" name="passwort" /><br />
					<label for="passwort2">Passwort wiederholen: '.@$passwort2Err.'</label><br />
						<input type="password" class="half ';
						$text.= ($passwort2ErrBool? ' errorBox ': '');
						$text.= '" name="passwort2" /><br />				
				  </fieldset>
				 <input type="submit" value="Bestätigen">
			  </form>';
}
$text.='<a href="?page=startseite"><i class="fas fa-caret-square-left"></i></a>';	
mysqli_close($connect);
?>	






















	