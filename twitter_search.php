<?php
    date_default_timezone_set('America/Santiago');
    header('Content-Type: application/json');
    ini_set('display_errors', 1);
    require_once('modules/TwitterAPIExchange.php');

    /** Set access tokens here - see: https://dev.twitter.com/apps/ **/

    $settings = array(
        'oauth_access_token' => "51871509-kmD2SOUIPpG36RTcN7naCnQlH6BsUVraqdPkt6qGc",
        'oauth_access_token_secret' => "niHfPJoOMOtBdBkos8RxFA2HMYlTywxT3JVjzY0KhhH1P",
        'consumer_key' => "mzSWD2So3kNcPUMgacL5aYJcF",
        'consumer_secret' => "BJXHqwWBH3OvWgkz4zG7ZT9YsNuvg3NA4QKFfjOHzHptiz9wBu"
    );

    

    $url = 'https://api.twitter.com/1.1/search/tweets.json';
    $getfield = '?f=videos&vertical=default&rc=typd&q=%23hambredelolla';
    $requestMethod = 'GET';

    $twitter = new TwitterAPIExchange($settings);
    $search =  $twitter->setGetfield($getfield)
        ->buildOauth($url, $requestMethod)
        ->performRequest();

    echo $search;   

    echo "\n\nJSON DECODE \n\n"; 

    $search =  json_decode($search, true);
    $statuses = $search['statuses'];

    
    $db_host="localhost";
    $db_user="hambrede_lolla";
    $db_password="inflamable2015";
    $db_name="hambrede_lolla_db";
    $db_table_name = 'media';   

    $db_connection = mysql_connect($db_host, $db_user, $db_password);
    if (!$db_connection) {
        die('No se pudo conectar: ' . mysql_error($db_connection));
    }    

    for($i=0; $i<sizeof($statuses); $i++) {
        echo nl2br ((string) $statuses[$i]['user']['id'] . " ");
        echo nl2br ((string) $statuses[$i]['user']['screen_name'] . " ");
        echo (string) $statuses[$i]['entities']['media'][0]['id'] . " DWADAW ";

        $user_full_name = utf8_decode($statuses[$i]['user']['name']);
        $user_net_username = utf8_decode($statuses[$i]['user']['screen_name']);
        $user_profile_picture = utf8_decode($statuses[$i]['user']['profile_image_url']);
        $net = utf8_decode('twitter');
        $user_id = utf8_decode($statuses[$i]['user']['id']);
        $net_id = utf8_decode($statuses[$i]['id']);
        $media_link = utf8_decode($statuses[$i]['entities']['media'][0]['media_url']);
        $thumbnail_link = utf8_decode($statuses[$i]['entities']['media'][0]['media_url']);
        $uploaded_time = utf8_decode($statuses[$i]['created_at']);
        $caption = utf8_decode($statuses[$i]['text']);
        $expanded_url = utf8_decode($statuses[$i]['entities']['media'][0]['expanded_url']);

        if(is_null($statuses[$i]['entities']['media'])) {
            $type = utf8_decode('texto');
        } else if (strpos($media_link,'video') !== false) {
            $type = utf8_decode('video_twitter');
        } else {
            $type = utf8_decode('imagen');
        }

        mysql_select_db('hambrede_lolla_db', $db_connection);

        $net_id = mysql_real_escape_string($net_id);
        $sql = "SELECT * FROM ". $db_table_name . " WHERE net_id = '$net_id'";
        $rsd = mysql_query($sql,$db_connection);

        if(mysql_num_rows($rsd) == 0) {
            $insert_value = 'INSERT INTO `' . $db_name . '`.`'.$db_table_name.'` (`user_full_name`,`user_net_username`,`user_profile_picture`,`net`,`net_id`,`user_id`,`media_link`,`thumbnail_link`, `uploaded_time`, `type`, `caption`, `expanded_url` ) VALUES ("' . $user_full_name . '", "' . $user_net_username . '", "' . $user_profile_picture . '", "' . $net . '","' . $net_id . '", "' . $user_id . '", "' . $media_link . '", "' . $thumbnail_link . '", "' . $uploaded_time . '", "' . $type . '", "' . $caption . '", "' . $expanded_url . '")';
            $retry_value = mysql_query($insert_value, $db_connection);
            if (!$retry_value) {
                die('Error: ' . mysql_error());
            }
            echo "saved";
        }
        else {
            echo 'already_in_db';
        }


    }
    
   
    
?>     