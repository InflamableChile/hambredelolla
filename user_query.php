<?php

	date_default_timezone_set('America/Santiago');

	header('Content-Type: application/json');

	function is_ajax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

	function check_user() {
        $net_id = utf8_decode($_POST["net_id"]);
        if(empty($_POST["full_name"]))
            $full_name = utf8_decode($_POST["net_username"]);
        else
            $full_name = utf8_decode($_POST["full_name"]);

        $net_username = utf8_decode($_POST["net_username"]);
        $net = utf8_decode($_POST["net"]);

    	$db_host="localhost";
		$db_user="hambrede_lolla";
		$db_password="inflamable2015";
		$db_name="hambrede_lolla_db";
		$db_table_name = 'users';

		$db_connection = mysql_connect($db_host, $db_user, $db_password);
    	if (!$db_connection) {
            die('No se pudo conectar: ' . mysql_error($db_connection));
        }

        $db = mysql_select_db('hambrede_lolla_db', $db_connection);

        $net_id = mysql_real_escape_string($net_id);
        $sql = "SELECT * FROM ". $db_table_name . " WHERE net_id = '$net_id'";
        $rsd = mysql_query($sql,$db_connection);

    	if(mysql_num_rows($rsd) == 0) {
            $insert_value = 'INSERT INTO `' . $db_name . '`.`'.$db_table_name.'` (`net_id`,`full_name`,`net_username`,`net` ) VALUES ("' . $net_id . '", "' . $full_name . '", "' . $net_username . '", "' . $net . '")';
            $retry_value = mysql_query($insert_value, $db_connection);
            if (!$retry_value) {
                die('Error: ' . mysql_error());
            }
    		echo json_encode("USER_TRUE");
    	}
    	else {
    		echo json_encode('USER_FALSE');
    	}
    }
    if (is_ajax()) {
        check_user();
    }
?>