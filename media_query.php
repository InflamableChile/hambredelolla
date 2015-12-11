<?php

	date_default_timezone_set('America/Santiago');

	header('Content-Type: application/json');

	function is_ajax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

	function check_id() {

        $user_full_name = utf8_decode($_POST["user_full_name"]);
        $user_net_username = utf8_decode($_POST["user_net_username"]);
        $user_profile_picture = utf8_decode($_POST["user_profile_picture"]);
        $net = utf8_decode($_POST["net"]);
        $net_id = utf8_decode($_POST["net_id"]);
        $user_id = utf8_decode($_POST["user_id"]);
        $media_link = utf8_decode($_POST["media_link"]);
        $thumbnail_link = utf8_decode($_POST["thumbnail_link"]);
        $uploaded_time = utf8_decode($_POST["uploaded_time"]);
        $type = utf8_decode($_POST["type"]);
        $caption = utf8_decode($_POST["caption"]);
    	$db_host="localhost";
		$db_user="hambrede_lolla";
		$db_password="inflamable2015";
		$db_name="hambrede_lolla_db";
		$db_table_name = 'media';

		$db_connection = mysql_connect($db_host, $db_user, $db_password);
    	if (!$db_connection) {
            die('No se pudo conectar: ' . mysql_error($db_connection));
        }

        mysql_select_db('hambrede_lolla_db', $db_connection);

        $net_id = mysql_real_escape_string($net_id);
        $sql = "SELECT * FROM ". $db_table_name . " WHERE net_id = '$net_id'";
        $rsd = mysql_query($sql,$db_connection);

    	if(mysql_num_rows($rsd) == 0) {
            $insert_value = 'INSERT INTO `' . $db_name . '`.`'.$db_table_name.'` (`user_full_name`,`user_net_username`,`user_profile_picture`,`net`,`net_id`,`user_id`,`media_link`,`thumbnail_link`, `uploaded_time`, `type`, `caption` ) VALUES ("' . $user_full_name . '", "' . $user_net_username . '", "' . $user_profile_picture . '", "' . $net . '","' . $net_id . '", "' . $user_id . '", "' . $media_link . '", "' . $thumbnail_link . '", "' . $uploaded_time . '", "' . $type . '", "' . $caption . '")';
            $retry_value = mysql_query($insert_value, $db_connection);
            if (!$retry_value) {
                die('Error: ' . mysql_error());
            }
    		echo json_encode("saved");
    	}
    	else {
    		echo json_encode('already_in_db');
    	}
    }
    if (is_ajax()) {
        check_id();
    }
?>