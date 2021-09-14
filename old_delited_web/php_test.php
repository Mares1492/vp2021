<?php
    $author_name = "Mares Sumarok";
	$photo_dir = "photos/";
	//kontrollin, kas klikiti submit↓
	$today_html = null; //$today_html = " ";
	$today_adjective_error = null;
	$todays_adjective = null;
	if(isset($_POST["submit_todays_adjective"])){
		//echo "Klikis nupu";
		if(!empty($_POST["todays_adjective_input"])){
		$today_html = "<p>Tänane päev on " .$_POST["todays_adjective_input"] .".</p>";
		}else{
			$today_adjective_error = "Palun kirjutage tänase kohta omadussõna";
		}
	}	
	//$all_files =scandir($photo_dir);
	$all_files = array_slice(scandir($photo_dir), 2);
	//$ver_dump = ($_POST);
	$allowed_photo_types = ["image/jpeg", "image/png"];
	$all_photos = [];
	foreach($all_files as $file){
		$file_info = getimagesize($photo_dir .$file);
		if(isset($file_info["mime"])){
			if(in_array($file_info["mime"], $allowed_photo_types)){
				array_push($all_photos,$file);
			}
	    }
	}	
	$file_count = count($all_photos);
	$photo_num = mt_rand(0, $file_count -1);
	$photo_html = '<img src="' .$photo_dir .$all_photos[$photo_num] .'"alt="Tallinna Ülikool">';
	$photo_list_html = "<ul>";
	
	//for($i = algväärtus; $i > 0; $i++) {}
	for($i = 0; $i < $file_count; $i ++) {
		$photo_list_html = "<li>" . $all_photos[$i] ."<li>";
	}
	$photo_list_html .= "</ul> \n";
	$photo_select_html .= '<select name="photo_select">' ."\n"
	//for($i = 0; $i < $file_count; $i ++) {
		//$photo_dir
	//}
?>
<!doctype html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title><?php echo $author_name;?>, Random webpage</title>
</head>
<body>
<h1><?php echo $author_name ?>  ---Veebileht---</h1>
  <div>
	<p>If you want to start a new life click here: <br>
	<a href="https://www.tlu.ee/dt"><h3>University</h3></a></p>
	<p>Could help, I guess</p>
  </div>
  <hr>
  <!--ekraanivorm-->
  <form method = "POST">
      <input type = "text" name = "todays_adjective_input" placeholder = "Tänase päeva ilma omadus"  >
	  <button type = "submit" name = "todays_adjective_submit" >Saada ära</button>
	  <span><?php echo $today_adjective_error ?></span>
  </form>
  <?php echo $today_html ?> 
  <hr>
  <form method = "FORM">
  <?php echo $today_html ?>  
  
  <?php
  echo $photo_html ;
  echo $photo_list_html ?>
  
</body>
</html>