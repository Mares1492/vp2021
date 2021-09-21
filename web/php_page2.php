<?php
    $author_name = "Mares Sumarok";
	//vaatan, mida POST meetodil saadeti
	//var_dump($_POST);
	$today_html = null; //$today_html = "";
	$today_adjective_error = null;
	$todays_adjective = null;
	//kontrollin, kas klikiti submit↓
	if(isset($_POST["submit_todays_adjective"])){
		//echo "Klikis nupu";
		if(!empty($_POST["todays_adjective_input"])){
			$today_html = "<p>Tänane päev on: ".$_POST["todays_adjective_input"]. ".</p>";
			$todays_adjective = $_POST["todays_adjective_input"];
		}else{
			$today_adjective_error = "Palun kirjutage tänase kohta omadussõna";
		}
	}	
	
	//$all_files =scandir($photo_dir);
	$photo_dir = "photos/";
	$all_files = array_slice(scandir($photo_dir), 2);
	//$ver_dump = ($_POST);
	$allowed_photo_types = ["image/jpeg", "image/png"];
	$all_photos = [];
	foreach($all_files as $file){
		$file_info = getimagesize($photo_dir .$file);
		if(isset($file_info["mime"])){
			if(in_array($file_info["mime"], $allowed_photo_types)){
				array_push($all_photos, $file);
			}
	    }
	}	
	
	$file_count = count($all_photos);
	$photo_num = mt_rand(0, $file_count -1);
	$photo_html = '<img src="' .$photo_dir .$all_photos[$photo_num] .'"alt="Tallinna Ülikool">';
	$photo_list_html = "\n <ul> \n";
	
	echo "Dunno what am I doing...";
	
	
	//for($i = algväärtus; $i > 0; $i++) 
		
	for($i = 0; $i < $file_count; $i ++) {
		$photo_list_html .= "<li>".$all_photos[$i] . "</li> \n";
	}
	$photo_list_html .= "</ul> \n";
	$photo_html_extra = "<li>".$all_photos[$photo_num] ."</li> \n";
	
	//SIIIIIN
	
/* 	<select name="photo_select">
		<option value="0">tlu_astra_600x400_1.jpg</option> 
		<option value="1">tlu_astra_600x400_2.jpg</option> 
		<option value="2">tlu_hoov_600x400_1.jpg</option> 
		<option value="3">tlu_mare_600x400_1.jpg</option> 
		<option value="4">tlu_mare_600x400_2.jpg</option> 
		<option value="5">tlu_terra_600x400_1.jpg</option> 
		<option value="6">tlu_terra_600x400_2.jpg</option> 
		<option value="7">tlu_terra_600x400_3.jpg</option> 
	</select>  */
	if(isset($_POST["submit_photo_select"])){
		$photo_html= '<img src="' .$photo_dir .$all_photos[$_POST["photo_select"]] .'"alt="Tallinna Ülikool">';
		$photo_html_extra = "<li>".$all_photos[$_POST["photo_select"]] ."</li> \n";
	}else{
		$photo_html= '<img src="' .$photo_dir .$all_photos[$photo_num] .'"alt="Tallinna Ülikool">';
	}
	$photo_select_html = '<select name="photo_select">'."\n";
	for($i = 0; $i < $file_count; $i++){
		if ($i == $photo_num ) {
			$photo_select_html .= '<option value="' .$i .'"selected>' .$all_photos[$i] ."</option> \n";
			if (isset($_POST["submit_photo_select"])){
				$photo_select_html .= '<option value="' .$i .'"selected>' .$all_photos[$_POST["photo_select"]] ."</option> \n";
			}
		}else{
			$photo_select_html .= '<option value="' .$i .'">' .$all_photos[$i] ."</option> \n";
		}
		
	}
	$photo_select_html .= "</select> \n";
	
?>
<!doctype html>
<html lang="et">
 <head>
   <meta charset="utf-8">
   <title><?php echo $author_name;?>, veebiprogrameerimine</title>
 </head>
 <body>
  <h1><?php echo $author_name ?>  ---Veebileht---</h1>
   <div>
	<p>If you want to start a new life click here: <br>
	<a href="https://www.tlu.ee/dt"><h3>University</h3></a></p>
   </div>
  <hr>
  <!--ekraanivorm-->
  <form method = "POST">
    <input type="text" name="todays_adjective_input" placeholder="Tänase päeva ilma omadus" value="<?php echo $todays_adjective; ?>">
	<input type="submit" name="submit_todays_adjective" value="Saada ära">
	<span><?php echo $today_adjective_error; ?></span>
  </form>
  <?php echo $today_html; ?> 
  <hr>
  
	<form method = "POST">
		<?php echo $photo_select_html;?>
		<input type="submit" name="submit_photo_select">
	</form>
	
	<?php
		echo $photo_html;
		echo $photo_html_extra;
		echo $photo_list_html; 
	?>

 </body>
</html>