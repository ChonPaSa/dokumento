<?php
$html = '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name = "viewport" content = "width = device-width, initial-scale=1"> 
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="robots" content="noindex">
<title>Dokumento</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link href="css/mainstyle.css" rel="stylesheet" type="text/css">
</head>
<body>
<nav id="topmenu">
  <h2><a href="#topmenu">&equiv;</a></h2>
  <h2><a href="#close">&times;</a></h2>
  <ul>
	<li><a href="?page=startseite">Startseite</a></li>
	'.$links.'
  </ul>
</nav>
<header>
<h1>'.$headline.'</h1>
</header>
<main>
'.$text.'
</main>
</body>
</html>';
?>