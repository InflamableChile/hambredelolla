<!DOCTYPE html>
<head>
<title>Hambre de Lolla</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '510429509134369',
      xfbml      : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));	
</script>


<!-- If you'd like to support IE8 -->
<script src="http://vjs.zencdn.net/ie8/1.1.0/videojs-ie8.min.js"></script>

<link rel="stylesheet" href="css/hambredelolla.css" />
<link rel="stylesheet" href="css/player.css" />

<?php
	$db_host="localhost";
	$db_user="desinfla_lolla";
	$db_password="inflamable2015";
	$db_name="desinfla_hambredelolla";
?>

</head>

<body>

	<?php 

		$db_connection = mysql_connect($db_host, $db_user, $db_password);
		mysql_select_db('desinfla_hambredelolla', $db_connection);

		if (!$db_connection) {
            die('No se pudo conectar: ' . mysql_error($db_connection));
        }

        $sql = "SELECT * FROM media";

        $rsd = mysql_query($sql,$db_connection);

        if(mysql_num_rows($rsd) > 0) { 
        	?>
    	<div class="masonry">
        	<?php	
        	while($row = mysql_fetch_array($rsd)) {
    		?>
				<div class="item">
		    		<?php 
		        		if($row["type"] == "video") {
		        	?>
						   	<video class="video-js vjs-default-skin vjs-big-play-centered  vjs-volume-bar" controls preload="auto" width="350" height="300" data-setup='{"playbackRates": [1, 1.5, 2],  "controls": true, "autoplay": false }'>
						   		<source src=<?php echo '"' . $row["media_link"] . '"' ?> type='video/mp4'></source>
						   		<p class="vjs-no-js">
						      		Para ver este video por favor active el Javascript y considere actualizar su navegador a uno que soporte HTML5
					    		</p>	
						   	</video>
						   	
		    <?php    	} else if($row["type"] != "texto")  { ?>
						   	<img src=<?php echo '"' . $row["media_link"] . '"' ?>/>
		    <?php 		}

		    	$db_table_name = 'users';
		    	$user_net_id = $row["user_id"];
	   	 		$user_sql = "SELECT * FROM ". $db_table_name . " WHERE net_id = '$user_net_id'";
	   	 		$user = mysql_query($user_sql, $db_connection);
		    ?>	
		    		<br/>
		    		<img src=<?php echo '"' . $row["user_profile_picture"] . '"' ?> style="width: 50px; heigth: 50px"/>

		    		<b><?php echo ($row["user_full_name"]) ?></b> &nbsp;<a href=<?php echo '"http://wwww.instagram.com/' . $row["user_net_username"] . '"' ?> ><?php echo $row["user_net_username"] ?></a>
		    		<p> <?php echo $row["caption"] ?> </p>
				</div>
    	<?php	} ?>
    	</div>	
    <?php

		}

    ?>

	<div id="instafeed"></div>

	<div class="fb-root" id="fb-root">
		
		<div id="instagram-div">
			
		</div>	


		


		<button href="#ig" id="ig-on" >Conectate a Instagram</button>

		<br \>

		<div id="profile">
		</div>
		<br/>
		<div id="result">
		</div>

		<div id="upload-form" style="display:none;">
			<form enctype="multipart/form-data" action="upload_file.php" method="post">
			    <label for="file"><span>Archivo:</span></label>
			    <input type="file" name="video" id="video" /> 
			    <br />
				<input type="submit" name="submit" value="Submit" />
			</form>
		</div>	
	</div>	

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>		
	<script src="js/hello.js"></script>	
	<script src="js/hello_module/instagram.js"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.2.0/imagesloaded.pkgd.min.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script src="http://vjs.zencdn.net/5.2.4/video.js"></script>
	<script src="js/instagram_api.js"></script>	

</body>
</html>