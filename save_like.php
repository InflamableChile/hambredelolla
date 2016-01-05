<?php

date_default_timezone_set('America/Santiago');
header('Content-Type: application/json');
ini_set('display_errors', 1);

function save_like() {

	$db_host="localhost";
	$db_user="hambrede_lolla";
	$db_password="inflamable2015";
	$db_name="hambrede_lolla_db";
	$db_table_name = 'likes';
	$db_media_table = 'media';
	$net_id = utf8_decode($_POST["net_id"]);
	$user_id = utf8_decode($_POST["user_id"]);   

	$db_connection = mysql_connect($db_host, $db_user, $db_password);
	if (!$db_connection) {
	    die('No se pudo conectar: ' . mysql_error($db_connection));
	}  

	mysql_select_db('hambrede_lolla_db', $db_connection);

	$net_id = mysql_real_escape_string($net_id);
	$user_id = mysql_real_escape_string($user_id);
	$sql = "SELECT * FROM ". $db_table_name . " WHERE net_id = '$net_id' AND user_id = '$user_id'";
	$rsd = mysql_query($sql,$db_connection);  

	if(mysql_num_rows($rsd) == 0) {

	    $sql_count = "SELECT * FROM ". $db_media_table . " WHERE net_id = '$net_id'";
	    $count_value = mysql_query($sql_count, $db_connection);
		
		if(mysql_num_rows($count_value) == 0) {

			echo json_encode("net_id_error");		
			
		} else {
			while($row = mysql_fetch_array($count_value)) {

				$prev_likes = $row['likes'];
				$new_likes = $prev_likes + 1;

				$sql_update = "UPDATE ". $db_media_table . " SET likes='". $new_likes ."' WHERE net_id = '$net_id'";
				$rsd_update = mysql_query($sql_update,$db_connection); 
				if (!$rsd_update) {
			        die('Error: ' . mysql_error());
			    }

				$sql_insert = 'INSERT INTO `' . $db_name . '`.`'.$db_table_name.'` (`user_id`,`net_id` ) VALUES ("' . $user_id . '", "' . $net_id . '")';
				$rsd_insert = mysql_query($sql_insert , $db_connection); 
				if (!$rsd_insert) {
			        die('Error: ' . mysql_error());
			    } else {
			    	echo json_encode("like_saved");	
			    }
			}	
		}
	}
	else {
		echo json_encode('already_liked');
	}

}

function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

if (is_ajax()) {
    save_like();
}


?>