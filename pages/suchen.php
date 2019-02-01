<?php
$headline = "Dokumente suchen";
$ergebnis =0;
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
$text .= '
	<form action="" method="post">
	 <fieldset>
	   <legend>Dokument Daten</legend>
			<label for="docname">Title</label><br>';
	$text.= '<input type="text" name="docname"  />';	
	$text.= '<p>Schlachworte auswählen:</p>';
		while ($datensatz = mysqli_fetch_array($result))
		{
			$text.='<input type="checkbox" name="schlagworte[]" value="'.$datensatz["Nr"].'">';
			$text.=' '.$datensatz["Name"].'<br>';
		}
	$text .= '<p>Kategorie auswählen:</p>
		<select name="kategorie" class="half">
		<option value="0">--</option>';
		while ($datensatz = mysqli_fetch_array($result_kat))
		{
			$text.='<option value="'.$datensatz["katNr"].'">';
			$text.=' '.$datensatz["Name"].'</option>';
		}		
	  $text.='</select><br />
	   <p>Jahr:</p>
		<select name="jahr" class="quarter">
		<option value="">--</option>';
		for ($i=0 ; $i<10 ; $i++)
		{
				$text.= '<option value="'.(date("Y")-$i).'">'.(date("Y")-$i).'</option>'; 
		}
		
	 $text.='</select><br />
		<label for="abs_emp">Absender / Empfänger: </label><textarea name="abs_emp"></textarea><br />		
		<label for="ablage">Ablageort: </label><input type="text" name="ablage" /><br />	
	<input type="submit" value ="Durchsuchen">
	</fieldset>
	</form>';
	$text .= '<table id ="results"> 
		<tr>
			<th>Nr</th>
			<th>Name<br /><button onclick="sortTable(1,true);return false;"><i class="small fas fa-sort-alpha-down"></i></button>
					 <button onclick="sortTable(1,false);return false;"><i class="small fas fa-sort-alpha-up"></i></button></th>
			<th>Schlagworte<br /><button onclick="sortTable(2,true);return false;"><i class="small fas fa-sort-alpha-down"></i></button>
					 <button onclick="sortTable(2,false);return false;"><i class="small fas fa-sort-alpha-up"></i></button></th>
			<th>Kategorie<br /><button onclick="sortTable(3,true);return false;"><i class="small fas fa-sort-alpha-down"></i></button>
					 <button onclick="sortTable(3,false);return false;"><i class="small fas fa-sort-alpha-up"></i></button></th>
			<th>Abs./Emp.<br /><button onclick="sortTable(4,true);return false;"><i class="small fas fa-sort-alpha-down"></i></button>
					 <button onclick="sortTable(4,false);return false;"><i class="small fas fa-sort-alpha-up"></i></button></th>
			<th>Ablageort<br /><button onclick="sortTable(5,true);return false;"><i class="small fas fa-sort-alpha-down"></i></button>
					 <button onclick="sortTable(5,false);return false;"><i class="small fas fa-sort-alpha-up"></i></button></th>
			<th>Jahr<br /><button onclick="sortTable(6,true);return false;"><i class="small fas fa-sort-numeric-down"></i></button>
					 <button onclick="sortTable(6,false);return false;"><i class="small fas fa-sort-numeric-up"></i></button></th>
			<th>Aktionen</th>
		</tr>'; //table header
	if(empty($_POST["schlagworte"]))
	{
		$sql = 'SELECT docs.Nr as dokNr, docs.Name as dok, docs.url as url, docs.kategorie as kategorie, docs.ablageort, docs.absender , docs.datum
				FROM docs
				LEFT JOIN kategorien ON kategorien.katNr = docs.kategorie
				WHERE  docs.Name LIKE "%'.@$_POST["docname"].'%" ';
	}
	else
	{
		$checked = implode(",",$_POST["schlagworte"]); //select documents with an schlagwort in the list $checked
		$sql = 'SELECT DISTINCT docs.Nr as dokNr, docs.Name as dok, docs.url as url, docs.kategorie as kategorie, docs.absender, docs.ablageort , docs.datum
			FROM docs INNER JOIN zwischentabelle ON zwischentabelle.DokNr = docs.Nr
			INNER JOIN schlagworte ON zwischentabelle.SchlagwortNr = schlagworte.Nr 
			LEFT JOIN kategorien ON kategorien.katNr = docs.kategorie
			WHERE docs.Name LIKE "%'.$_POST["docname"].'%" AND schlagworte.Nr IN ('.$checked.')';
	}
	if (isset($_POST["jahr"]) && $_POST["jahr"] != "")  //Jahr
	{
		$sql.= ' AND YEAR(docs.datum) = '.$_POST["jahr"];

	}
	if (isset($_POST["kategorie"]) && $_POST["kategorie"] != 0)  //Kategorie
	{
		$sql.= ' AND docs.kategorie = '.$_POST["kategorie"];		
	}	
	if (isset($_POST["abs_emp"]) && $_POST["abs_emp"] != "")	//absender /empfänger
	{
		$sql.= ' AND docs.absender LIKE "%'.$_POST["abs_emp"].'%"';		
	}
	if (isset($_POST["ablage"]) && $_POST["ablage"] != "")	//Ablageort
	{
		$sql.= ' AND docs.ablageort LIKE "%'.$_POST["ablage"].'%"';		
	}	
	$result = mysqli_query($connect,$sql);	
$ergebnis = $connect->affected_rows;	
	while ($datensatz = mysqli_fetch_array($result))
	{
		$text.='
		<tr>
			<td>'.$datensatz["dokNr"].'</td>
			<td>'.$datensatz["dok"].'</td>
			<td>';
			$sql2 = 'SELECT schlagworte.Name as schlag FROM schlagworte
			INNER JOIN zwischentabelle ON zwischentabelle.SchlagwortNr = schlagworte.Nr
			INNER JOIN docs ON  zwischentabelle.DokNr = docs.Nr
			WHERE docs.Nr = '.$datensatz["dokNr"];
			$worte = mysqli_query($connect,$sql2);
			$sql3 = 'SELECT name FROM Kategorien
					WHERE katNr = '.$datensatz["kategorie"];
			$kategorien = mysqli_query($connect,$sql3);	
			$kategorie = mysqli_fetch_array($kategorien);
			while ($wort = mysqli_fetch_array($worte))
			{
				$text.= $wort["schlag"].' <br />';
			}
			$text.='<td>'.$kategorie[0].'</td>';
			$text.='<td>'.$datensatz["absender"].'</td>';
			$text.='<td>'.$datensatz["ablageort"].'</td>';
			$text.='<td>'.date('Y', strtotime($datensatz["datum"])).'</td>';
			$text.='<td>
					<a href="'.$datensatz["url"].'" title="Zum Dokument..." target="_blank"><i class="far fa-file-alt"></i></a>
					<a href="?page=suchen&dokNr='.$datensatz["dokNr"].'&bearbeiten=1" title="Bearbeiten..."><i class="far fa-edit"></i></a>
					<a href="?page=suchen&dokNr='.$datensatz["dokNr"].'&loeschen=1" title="Löschen..."><i class="far fa-trash-alt"></i></a>
				</td>
		</tr>
		';
	}
	$text.= '<tfoot><tr><td colspan = 8>'.$ergebnis.' Ergebnisse</td></tr></tfoot></table>';
$text .= '<script>
function sortTable(column, direction) {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("results");
  switching = true;
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {

      shouldSwitch = false;
      x = rows[i].getElementsByTagName("td")[column];
      y = rows[i + 1].getElementsByTagName("td")[column];
	  if (direction){
		  if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
			shouldSwitch = true;
			break;
		  }		  
	  }else{
		    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
			shouldSwitch = true;
			break;
		  }	
	  }

    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
</script>';

?>
