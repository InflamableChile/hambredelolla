
<?php
	$db_host="localhost";
	$db_user="desinfla_lolla";
	$db_password="inflamable2015";
	$db_name="desinfla_hambredelolla";
	$db_table_name = 'media';
	$net_id = $_POST['net_id'];

	$db_connection = mysql_connect($db_host, $db_user, $db_password);
	if (!$db_connection) {
        die('No se pudo conectar: ' . mysql_error($db_connection));
    }

    mysql_select_db('desinfla_hambredelolla', $db_connection);

    $net_id = mysql_real_escape_string($net_id);
    $sql = "SELECT * FROM ". $db_table_name . " WHERE net_id = '$net_id'";
    $rsd = mysql_query($sql,$db_connection);

    if(mysql_num_rows($rsd) == 0) {
    	echo json_encode('true');
    } else {
    	echo json_encode('false');
    }




?>