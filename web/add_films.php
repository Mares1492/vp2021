<?php
	require_once("../../../config.php");
	require_once("fnc_film.php");
	// $server_host;

	function filter($input) {
		$replace = array(0,1,2,3,4,5,6,7,8,9);
		if (ctype_alpha($input) === false){
			$input = str_replace($replace, "", $input);
			$input = trim($input);
			$input = stripslashes($input);
			$input = htmlspecialchars($input);
			if (empty($input)){
				$input = null;
				return $input;
			}
		}
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		return $input;
		
	}
    $author_name = "Mares Sumarok";
	$input_array = array();
	$input_error = array(null,null,null,null,null,null);
	//$input_error_str = array(null,null,null);
	$title_input = $genre_input = $studio_input = $director_input =  $film_store_notice = null;
	$year_input = date("Y");
	$i = 0;
	if(isset($_POST["film_submit"])){
		$i = 0;
		unset($input_array);
		$input_array = array();
		unset($input_error); 
		$input_error = array();
		foreach ($_POST as $value){
			if ($value === $_POST["genre_input"] or $value === $_POST["studio_input"] or $value === $_POST["director_input"]){
				$value = filter($value);
			}
			
			if (!empty($value)){
				$input_array[] = $value;
				$input_error[] = null;
				$i++;
			}else{
				$input_array[] = null;
				$input_error[] = " Andmed on puudu!";
				$i++;
			}
		}
		$title_input =$input_array[0];
		$genre_input = $input_array[3];
		$studio_input = $input_array[4];
		$director_input = $input_array[5];
		$year_input = $input_array[1];
		$duration_input = $input_array[2];	
	
		if(!empty($_POST["title_input"]) and !empty($_POST["genre_input"]) and !empty($_POST["studio_input"]) and !empty($_POST["director_input"])){
			$film_store_notice = store_film($_POST["title_input"], $_POST["year_input"], $_POST["duration_input"], $_POST["genre_input"], $_POST["studio_input"], $_POST["director_input"]);
		}else{
			$film_store_notice = "NB: Osa andmetest on vale või puudu!";
		}
	}
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
	<form method="POST">
		<label for="title_input">Filmi pealkiri: </label>
		<input type="text" name="title_input" id = "title_input" placeholder = "pealkiri" value = "<?php echo $title_input; ?>"><span><?php echo $input_error[0]  ?></span> 
		<br>
		<label for="year_input">Valmimisaasta: </label>
		<input type="number" name = "year_input" id = "year_input" min="1912" value = "<?php echo $year_input; ?>"><span><?php echo $input_error[1]?></span>
		<br>
		<label for="duration_input">Kestus minutites: </label>
		<input type="number" name = "duration_input" id = "duration_input" min="60" max="420" value = "<?php echo $duration_input; ?>"><span><?php echo $input_error[2]?></span>
		<br>
		<label for="genre_input">Žanr: </label>
		<input type="text" name = "genre_input" id = "genre_input" placeholder = "žanr" value = "<?php echo $genre_input; ?>"><span><?php echo $input_error[3]?></span>
		<br>
		<label for="studio_input">Tootja: </label>
		<input type="text" name = "studio_input" id = "studio_input" placeholder = "tootja" value = "<?php echo $studio_input; ?>"><span><?php echo $input_error[4] ?></span>
		<br>
		<label for="director_input">Lavastaja: </label>
		<input type="text" name = "director_input" id = "director_input" placeholder = "lavastaja" value = "<?php echo $director_input; ?>"><span><?php echo $input_error[5] ?></span>
		<br>
		<input type="submit" name ="film_submit" value = "Salvesta">
	</form>
	<h1><?php echo $film_store_notice; ?></h1>
	
	
 </body>
</html>