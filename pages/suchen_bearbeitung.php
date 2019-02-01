<?php
$headline = "Dokumente bearbeiten";
$connect = mysqli_connect("localhost", "ChangeMe", "ChangeMe", "ChangeMe");
if (mysqli_connect_errno())
  {
  echo "Fehler: " . mysqli_connect_error();
  }
mysqli_query($connect, "SET NAMES utf8"); //Die Übertragung auf UTf-8 umstellen
$sql = "select * from docs WHERE docs.Nr = ".$_GET["dokNr"];
$result = mysqli_query($connect,$sql);
$document =  mysqli_fetch_array($result);
if(!isset($_POST["docname"])|| $Err > 0)
{	
	$text.= '<form action="?page=suchen" method="post">
		 <fieldset>
		   <legend>Dokument Daten Eingeben</legend>
				<label for="docname">Title <sup>*</sup></label><br>
		<input type="text" name="docname" value="'.$document["Name"].'" />
		<p>Schlachworte auswählen:</p>';
		$sql = "SELECT schlagworte.Nr as Nr, schlagworte.Name as Name FROM zwischentabelle INNER JOIN schlagworte ON schlagworte.Nr = zwischentabelle.SchlagwortNr WHERE DokNr = ".$_GET["dokNr"];
		$result = mysqli_query($connect,$sql);
		$list = array();
		while ($datensatz = mysqli_fetch_array($result))
			{
			array_push($list, $datensatz["Name"]);
			}
		$sqlworte = "SELECT Name, Nr FROM schlagworte ORDER BY Name";
		$resultworte = mysqli_query($connect,$sqlworte);
		while($worte = mysqli_fetch_array($resultworte))
		{
			$text.='<input type="checkbox" name="schlagworte[]" value="'.$worte["Nr"].'" ';
			if (in_array($worte["Name"], $list))
			{
				$text.=' checked ';
			}
			$text.='/>';
			$text.=' '.$worte["Name"].'<br>';
		}
		$sql = "select kategorie from docs WHERE Nr = ".$_GET["dokNr"];
		$result_kat = mysqli_query($connect,$sql);
		$kat_array = mysqli_fetch_array($result_kat);
		$kat = $kat_array[0];
		$sql = "select katNr, Name from kategorien ORDER BY Name";
		$result_kat = mysqli_query($connect,$sql);
		$text .= '<p>Kategorie auswählen:</p>
		<select name="kategorie" class="half">
		<option value="0">--</option>';
		while ($datensatz = mysqli_fetch_array($result_kat))
		{
			$text.='<option value="'.$datensatz["katNr"].'"';
			if ($datensatz["katNr"] == $kat)
			{
				$text.=' selected ';
			}
			$text.=' >';
			$text.=' '.$datensatz["Name"].'</option>';
		}		
		$text.='</select><br />
		<label for="abs_emp">Absender / Empfänger: </label><textarea name="abs_emp">'.$document["absender"].'</textarea><br />		
		<label for="ablage">Ablageort: </label><input type="text" name="ablage" value ="'.$document["ablageort"].'" /><br />
		<label for="datum">Datum: </label><input type="date" name="datum" value ="'.date( "Y-m-d", strtotime($document["datum"])).'" /><br />
		';
		$text.='<input type="hidden" name="dokNr"  value="'.$_GET["dokNr"].'"/>';
		$text.='<input type="submit" name="bearbeitung_speichern" value="Änderungen speichern">
		<input type="submit" value="Abbrechen"> <br />
		<object data="'.$document["url"].'" type="text/plain" width="500" style="height: 300px">
				<a href="'.$document["url"].'">Vorschau nicht verfügbar</a></object>
		</fieldset>
		</form>';
}
$text.='<a href="?page=suchen"><i class="fas fa-caret-square-left"></i></a>';	
mysqli_close($connect);
?>