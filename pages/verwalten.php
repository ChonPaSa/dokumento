<?php
$headline = "Daten Verwalten";
$connect = mysqli_connect("localhost", "ChangeMe", "ChangeMe", "ChangeMe");
if (mysqli_connect_errno())
  {
  echo "Fehler: " . mysqli_connect_error();
  }
mysqli_query($connect, "SET NAMES utf8"); //Die Übertragung auf UTf-8 umstellen
//########################EDIT##############################
//print_r($_POST);
if (isset($_POST["edit_kat"]) && $_POST["edit_kat"] != "" && isset($_POST["edit_kat_nr"]))
{
	$sql= 'UPDATE kategorien SET Name = "'.clean_string($_POST["edit_kat"]).'"WHERE katNr = '.$_POST["edit_kat_nr"];
		mysqli_query($connect, $sql);
}
if (isset($_POST["edit_wor"]) && $_POST["edit_wor"] != "" && isset($_POST["edit_wor_nr"]))
{
	$sql= 'UPDATE schlagworte SET Name = "'.clean_string($_POST["edit_wor"]).'"WHERE Nr = '.$_POST["edit_wor_nr"];
		mysqli_query($connect, $sql);
}
//########################DELETE##############################
if (isset($_GET["loeschen"]))
{
	if(isset($_GET["katNr"]))
	{
		$sql= 'DELETE FROM kategorien 
					WHERE katNr = '.$_GET["katNr"];
		mysqli_query($connect, $sql);
		$sql= 'UPDATE docs SET kategorie = 0
				WHERE kategorie = '.$_GET["katNr"];
		mysqli_query($connect, $sql);			
	}
	if(isset($_GET["worNr"]))
	{
		$sql= 'DELETE FROM schlagworte 
					WHERE Nr = '.$_GET["worNr"];
		mysqli_query($connect, $sql);
		$sql= 'DELETE FROM zwischentabelle 
					WHERE SchlagwortNr = '.$_GET["worNr"];
		mysqli_query($connect, $sql);		
	}	
}
//########################INSERT##############################
if (isset($_POST["kat_name"]) && $_POST["kat_name"]!="")
{
	$sql= 'INSERT INTO kategorien (Name) VALUES ("'.clean_string($_POST["kat_name"]).'")';

	mysqli_query($connect, $sql);	
}
if (isset($_POST["new_wor"])&& $_POST["new_wor"]!="")
{
	$sql= 'INSERT INTO schlagworte (Name) VALUES ("'.clean_string($_POST["new_wor"]).'")';
	mysqli_query($connect, $sql);		
}

//##############Kategorien			
$sql = "select * from kategorien ORDER BY Name";
$result = mysqli_query($connect,$sql);
$text.= '<form action="?page=verwalten" id="verwaltung_form" method="post">
			 <table>
				 <tr>
					<th>Kategorien</th>
					<th>Aktionen</th>
				 </tr>';
					while ($datensatz = mysqli_fetch_array($result))
					{
						if (isset($_GET["bearbeiten"]) && (isset($_GET["katNr"])) && $_GET["katNr"] == $datensatz["katNr"])
						{
							$text.='<tr><td><input type="text" name="edit_kat" value="'.$datensatz["Name"].'" /> </td>
							<td>
							<input type="hidden" name="edit_kat_nr" value="'.$datensatz["katNr"].'" />
							<button type="submit"><i class="far fa-check-square"></i></button>
							<a href="?page=verwalten"><i class="far fa-times-circle"></i></a>
						</td></tr>';
						}
						else
						{
							$text.='<tr><td>'.$datensatz["Name"].' </td>
							<td>
							<a href="?page=verwalten&katNr='.$datensatz["katNr"].'&bearbeiten=1" title="Bearbeiten..."><i class="far fa-edit"></i></a>
							<a href="?page=verwalten&katNr='.$datensatz["katNr"].'&loeschen=1" title="Löschen..."><i class="far fa-trash-alt"></i></a>
						</td></tr>';
						}
					}
			$text.='
			<tr><td><input type="text" name="kat_name" placeholder="Neue Kategorie"/></td>
			<td><button type="submit"><i class="far fa-plus-square"></i></button></td>
			</tr></table>';
			
//##############Schalgworte			
			$sql = "SELECT Nr, Name FROM  schlagworte ORDER BY Name";
			$result = mysqli_query($connect,$sql);			
			$text.='<table>
				 <tr>
					<th>Schlagworte</th>
					<th>Aktionen</th>
				 </tr>';
					while ($datensatz = mysqli_fetch_array($result))
					{
						if (isset($_GET["bearbeiten"]) && (isset($_GET["worNr"])) && $_GET["worNr"] == $datensatz["Nr"])
						{
							$text.='<tr><td><input type="text" name="edit_wor" value="'.$datensatz["Name"].'" /> </td>
							<td>
							<input type="hidden" name="edit_wor_nr" value="'.$datensatz["Nr"].'" />
							<button type="submit"><i class="far fa-check-square"></i></button>
							<a href="?page=verwalten"><i class="far fa-times-circle"></i></a>
						</td></tr>';
						}
						else
						{
							$text.='<tr><td>'.$datensatz["Name"].' </td>
							<td>
							<a href="?page=verwalten&worNr='.$datensatz["Nr"].'&bearbeiten=1" title="Bearbeiten..."><i class="far fa-edit"></i></a>
							<a href="?page=verwalten&worNr='.$datensatz["Nr"].'&loeschen=1" title="Löschen..."><i class="far fa-trash-alt"></i></a>
							</td></tr>';
						}						
					}
			$text.='
			<tr><td><input type="text" name="new_wor" placeholder="Neue Schlagworte"/></td>
			<td><button type="submit"><i class="far fa-plus-square"></i></button></td>
			</tr></table>		
	</form>';
$text.='<a href="?page=startseite"><i class="fas fa-caret-square-left"></i></a>';	
mysqli_close($connect);
?>