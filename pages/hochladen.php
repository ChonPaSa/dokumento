<?php	
$headline = "Dokumente hochladen";
$text .= '<form action="?page=hochladen2" method="post" enctype="multipart/form-data">
	  <fieldset>
	   <legend>Dokument Hochladen</legend>
	   <label for="docdatei">Datei <sup> *</sup>: ';
	   if (!empty($_SESSION['error'])) 
	   {
			$text.= $_SESSION['error'];
			unset($_SESSION['error']);
		}
		
	   $text.= '</label><br />
	   <input class="';
			$text.= (isset($_SESSION['error'])? ' errorBox ': '');
			$text.='" type="file" name="docdatei"/><br />
	  </fieldset>
	 <input type="submit">
	 <input type="reset">
	  </form>
	';

$text.='<a href="?page=startseite"><i class="fas fa-caret-square-left"></i></a>';	
?>	






















	