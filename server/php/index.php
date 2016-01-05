<?php
/*
 * jQuery File Upload Plugin PHP Example
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

error_reporting(false);
ini_set('display_errors', false);

require('UploadHandler.php');


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

$net_id = $_REQUEST['net_id'];

$net_id = mysql_real_escape_string($net_id);

$sql = "SELECT * FROM ". $db_table_name . " WHERE net_id = '$net_id'";
$rsd = mysql_query($sql,$db_connection);

if(mysql_num_rows($rsd) == 0) {
	$upload_handler = new UploadHandler();
}

