<?php
	require_once("../../../config.php");
	require_once("fnc_film.php");
	//echo $server_host;
    $author_name = "Mares Sumarok";
	$film_html = null;
	$film_html = read_all_films();
	
?>
<!doctype html>
<html lang="et-EE">
 <head>
   <meta charset="utf-8">
   <title><?php echo $author_name;?>, veebiprogrameerimine</title>
 </head>
 <body>
  <h1><?php echo $author_name ?>  ---Veebileht---</h1>
	<p>If you want to start a new life click here: <br>
	<a href="https://www.tlu.ee/dt"><h3>University</h3></a></p>
  <hr>
  <h2>Eesti filmid</h2>
  <?php
  echo $film_html;
  ?>
  

 </body>
</html>