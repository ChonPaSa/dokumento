<?php
$headline = "Dokumente hochladen";
$connect = mysqli_connect("localhost", "ChangeMe", "ChangeMe", "ChangeMe");
if (mysqli_connect_errno())
  {
  echo "Fehler: " . mysqli_connect_error();
  }
mysqli_query($connect, "SET NAMES utf8"); //Die Übertragung auf UTf-8 umstellen
$sql = "select * from schlagworte ORDER BY Name";
$result = mysqli_query($connect,$sql);
$sql2 = "select * from kategorien ORDER BY Name";
$result_kat = mysqli_query($connect,$sql2);

$docnameErr = $docdateiErr = "";
$Err = $docnameErrBool = $docdateiErrBool = 0;

if(!isset($_POST["docname"]))
{
	if ($_FILES["docdatei"]["error"] == UPLOAD_ERR_NO_FILE)
	{
		 // Setting error message
		 $_SESSION['error'] = "<span class='error'>Sie mussen erst eine Datei hochladen</span>";
		 header("location: index.php?page=hochladen"); // Redirecting to first page 
	} 
	else
	{
		$datei_original = $_FILES["docdatei"]["name"];  //name of the file
		$datei_tempname = $_FILES["docdatei"]["tmp_name"];  // file name in the server
		$ext = pathinfo($datei_original, PATHINFO_EXTENSION);
		$neuer_dateiname = uniqid("doc_").".".$ext; 
		move_uploaded_file($datei_tempname, "uploads/".$neuer_dateiname);
		$_SESSION["url"] = "uploads/$neuer_dateiname";
		$text.= '<input type="hidden" value= "'.$_SESSION["url"].'" name = "url"/>';
	}
}

if(isset($_POST["docname"]))
{	
	if (empty($_POST["docname"]))
	{
		$docnameErr ="Geben Sie bitte ein Titel an";
		$Err++;
		$docnameErrBool = 1;
	}
	else{
		$docname = clean_string($_POST["docname"]);
	}
	if ($Err == 0)
	{
		$sql = "insert into docs (Name,url)	values ('$docname','".$_SESSION["url"]."')";
		mysqli_query($connect, $sql);
		$DokNr = $connect->insert_id;
		$text.= '<form action="" method="post">
		 <fieldset>
		   <legend>Ihre Dokument wurde hochgeladen</legend>
			<label for="docname">Title</label><br>
		<input type="text" name="docname" value="'.$docname.'" disabled />';
		if (!empty($_POST["schlagworte"]))
		{
			$text.='<p>Schlachworte:</p>';
			while($worte = mysqli_fetch_array($result))
			{
				$text.='<input type="checkbox" name="schlagworte[]" value="'.$worte["Nr"].'" ';
				if (in_array($worte["Nr"], $_POST["schlagworte"]))
				{
					$text.=' checked ';
					$sql = 'INSERT INTO zwischentabelle (DokNr, SchlagwortNr)	
									VALUES ('.$DokNr.','.$worte["Nr"].')';
							mysqli_query($connect, $sql);
				}
				$text.=' disabled/>';
				$text.=' '.$worte["Name"].'<br>';
			}		
		}
		if (!empty($_POST["kategorie"]))
		{
			$kategorie = $_POST["kategorie"];
			$sql_kat = 'SELECT name FROM kategorien WHERE katNr = '.$kategorie;
			$result = mysqli_query($connect, $sql_kat);
			$datensatz = mysqli_fetch_array($result);
			$text .= '<p>Kategorie:</p>
			<select name="kategorie" class="half" disabled>
			<option value="'.$kategorie.'">'.$datensatz[0].'</option></select><br />';
			$sql = 'UPDATE docs SET kategorie = "'.$kategorie.'" WHERE Nr = '.$DokNr;
			mysqli_query($connect, $sql);
		}
		if (!empty($_POST["abs_emp"]))
		{
			$abs_emp  = clean_string($_POST["abs_emp"]);
			$text .= '<label for="abs_emp">Absender / Empfänger: </label><textarea name="abs_emp" disabled>'.$abs_emp.'</textarea><br />';
			$sql = 'UPDATE docs SET absender = "'.$abs_emp.'" WHERE Nr = '.$DokNr;
			mysqli_query($connect, $sql);
		}
		if (!empty($_POST["ablage"]))
		{	
			$ablage =  clean_string($_POST["ablage"]);
			$text .='<label for="ablage">Ablageort: </label><input type="text" name="ablage" value ="'.$ablage.'" disabled /><br />';
			$sql = 'UPDATE docs SET ablageort = "'.$ablage.'" WHERE Nr = '.$DokNr;
			mysqli_query($connect, $sql);
		}
		$text.='<object data="'.$_SESSION["url"].'" type="text/plain" width="500" style="height: 300px">
				<a href="'.$_SESSION["url"].'">Vorschau nicht verfügbar</a></object></fieldset></form>';
		$_SESSION["url"] = "";
	}

}
//Style Error
$docnameErr = "<span class='error'>$docnameErr</span>";
$docdateiErr = "<span class='error'>$docdateiErr</span>";

if(!isset($_POST["docname"])|| $Err > 0)
	{	
		$text .= '<form action="" method="post" enctype="multipart/form-data">
		  <fieldset>
		   <legend>Dokument Daten Eingeben</legend>
			<label for="docname">Titel <sup> *</sup>: '.@$docnameErr.'</label><br />
			<input class="';
				$text.= ($docnameErrBool? ' errorBox ': '');
				$text.='" type="text" name="docname" value = "'.@$docname.'" /><br />
			<p>Schlachworte auswählen:</p>';
			while ($datensatz = mysqli_fetch_array($result))
			{
				$text.='<input type="checkbox" name="schlagworte[]" value="'.$datensatz["Nr"].'" ';
				if (isset($_POST["schlagworte"]))
				{
					if (in_array($datensatz["Nr"], $_POST["schlagworte"]))
					{
						$text.= ' checked ';
					}
				}
				$text.= '>';
				$text.=' '.$datensatz["Name"].'<br>';
			}
			$text .= '<p>Kategorie auswählen:</p>
			<select name="kategorie" class="half">
			<option value ="0">--</option>';
			while ($datensatz = mysqli_fetch_array($result_kat))
			{
				$text.='<option value="'.$datensatz["katNr"].'"';
				if (@$_POST["kategorie"] == $datensatz["katNr"])
				{
					$text.= " selected ";
				}
				$text .= '>';
				$text.=' '.$datensatz["Name"].'</option>';
			}		
		  $text.='</select><br />
			<label for="abs_emp">Absender / Empfänger: </label><textarea name="abs_emp">'.@$_POST["abs_emp"].'</textarea><br />		
			<label for="ablage">Ablageort: </label><input type="text" name="ablage" value ="'.@$_POST["ablage"].'" /><br />
		  </fieldset>
		 <input type="submit">
		 <input type="reset">
		  </form>';
	}


$text.='<a href="?page=startseite"><i class="fas fa-caret-square-left"></i></a>';	

mysqli_close($connect);
?>	






















	