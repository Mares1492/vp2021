<?php
    $author_name = "Mares Sumarok";
	//echo $author_name; //print
	//vaatan praegust ajahetke
	$timezone = date_default_timezone_set("Europe/Helsinki");
	$full_time_now = date("d.m.Y H:i:s");
	//vaatan nädalapäeva
	$weekday_now = date("N");
	//echo $weekday_now;
	$weekday_names_et = ["esmaspäev","teisipäev","kolmapäev","neljapäev","reede","laupäev","pühapäev"];
	//echo $weekday_names_et [$weekday_now - 1]
	$hour_now = date("H");
	$day_category = "tavaline päev";
	$day_share = "imeline päeva osa";
	if ($weekday_now <= 5) {
		$day_category = "koolipäev";
		if ($hour_now < 8 and hour_now >= 3) { 
			$day_share = "uneaeg •••";
		}
		if ($hour_now >= 8 and $hour_now < 16) {
			$day_share = "tundide aeg ♥";
		}
		if ($hour_now >= 16 or $hour_now < 1) {
			$day_share = "tööaeg ♠";
		}
		if ($hour_now >= 1  and $hour_now < 3) {
			$day_share = "vaba aeg ☺";
		}
	}else{
		$day_category = "puhkepäev";
		if ($hour_now < 10 and hour_now >= 1) { 
			$day_share = "uneaeg •••";
		}
		if ($hour_now >= 10 or $hour_now < 20) {
			$day_share = "tööaeg ♠";
		}
		if ($hour_now >= 20 or hour_now < 1) { 
			$day_share = "vaba aeg ☺";
		}
	}
	$photo_dir = "photos/";
	//$all_files =scandir($photo_dir);
	$all_files = array_slice(scandir($photo_dir), 2);
	//$ver_dump = $all_real_files;
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

    //if($hour_now >=8 and $hour_now >=18)
	//if($hour_now >=8 and $hour_now >=18)
	
?>
<!doctype html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title><?php echo $author_name;?>, Random webpage</title>
</head>
<body>
  <div>
    <h1>Gambling is bad for you but YOLO anyway</h1>
	<img src="http://evoplay.games/wp-content/uploads/2021/03/BLACKJACK-LUCKY-SEVENS.jpg" alt="Blackjack Table" width="450" height="250">
  </div>
  <div>
	<p>If you want to start a new life click here: <br>
	<a href="https://www.tlu.ee/dt"><h3>University</h3></a></p>
	<p>Could help, I guess</p>
  </div>
  
  <p> I will add one more pic with no reason at all...</p>
  <img src="https://th.bing.com/th/id/OIP.ACzsQDYkEl3jTNKWGd437wHaEK?pid=ImgDet&rs=1" alt=Cool gaming set" width="450" height="250">
  <p>Page was opened on: <span><?php echo $weekday_names_et[$weekday_now - 1].",".$full_time_now.", täna on ".$day_category.", ning hetkel on ".$day_share; ?> </span></p>
  <?php echo $photo_html ?>
</body>
</html>