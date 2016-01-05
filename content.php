<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<?php

date_default_timezone_set('America/Santiago');

function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function get_video() {
    $db_host="localhost";
    $db_user="hambrede_lolla";
    $db_password="inflamable2015";
    $db_name="hambrede_lolla_db";
    $db_table_name = 'media';
    $db_likes_table = 'likes';
    $net_id = utf8_decode($_POST["net_id"]);
    $user_id = utf8_decode($_POST["user_id"]);
    $like_class = 'like-button-open';

    $db_connection = mysql_connect($db_host, $db_user, $db_password);
    if (!$db_connection) {
        die('No se pudo conectar: ' . mysql_error($db_connection));
    }

    mysql_select_db('hambrede_lolla_db', $db_connection);

    $net_id = mysql_real_escape_string($net_id);
    $sql = "SELECT * FROM ". $db_table_name . " WHERE net_id = '$net_id'";
    $rsd = mysql_query($sql,$db_connection);

    if(mysql_num_rows($rsd) == 0) {  ?>

<p>
    <?php $net_id ?>
</p>

<?php }
    else { 

        if($user_id != '') {
            $sql_like = "SELECT * FROM ". $db_likes_table . " WHERE net_id = '$net_id' AND user_id = '$user_id'";
            $rsd_like = mysql_query($sql_like,$db_connection);  
            if(mysql_num_rows($rsd_like) != 0) { 
                $like_class = 'like-button-full';
            }
            else {
                $like_class = 'like-button-open';
            }	
        } else {
            $like_class = 'like-button-open';
        }

        while($row = mysql_fetch_array($rsd)) {


            $type = $row['type'];
?>

<div id="id-aux" style="display:none;" class=<?php echo '"' . $net_id . '"'?>> </div>
<div class="media-wrapper">
    <?php if($type == 'video') { ?>		
    <video class="video-modal video-js vjs-default-skin" controls preload="auto" width="550" height="450" data-setup='{"playbackRates": [1, 1.5, 2],  "controls": true, "autoplay": false }' style="" id="video-frame">
        <source src=<?php echo '"' . $row["media_link"] . '"' ?> type='video/mp4'></source>
    <p class="vjs-no-js">
        Para ver este video por favor active el Javascript y considere actualizar su navegador a uno que soporte HTML5
    </p>	
    </video>
<?php } else if($type == 'image') { ?>   	

<img class="img-rounded center-image img-responsive" src=<?php echo '"' . $row["media_link"] . '"' ?>></img>

<?php } else if($type == 'video_uploaded') { ?>
<video class="video-modal video-js vjs-default-skin" controls preload="auto" width="550" height="450" data-setup='{"playbackRates": [1, 1.5, 2],  "controls": true, "autoplay": false }' style="" id="video-frame">
    <source src=<?php echo '"server/php/files/' . $row["net_id"] . '.mp4"' ?> type='video/mp4'></source>
<p class="vjs-no-js">
    Para ver este video por favor active el Javascript y considere actualizar su navegador a uno que soporte HTML5
</p>	
</video>

<?php    } else if($type == 'texto') { ?>
<div class="tweet-div-content">
    <p class="tweet-text">
        <?php echo $row["caption"] ?>
    </p>

</div>     
<?php } ?>
</div>
<div class="item-cont">
    <div class="caption-table">
        <div class="caption-content">
            <?php if($type != 'texto') echo utf8_encode($row["caption"]); ?> 
        </div>
    </div>

    <div class="item-meta">
        <span class="userpic" style=<?php echo '"background : url(' . $row["user_profile_picture"] . '); "' ?>></span>
        <?php if($row["net"] == 'instagram') { ?>
        <?php if( $row["user_full_name"] != '' ) { ?>
        <a rel="nofollow" href=<?php echo '"https://www.instagram.com/'. $row["user_net_username"] .'"'?> class="user-name" target="_blank"><?php echo utf8_encode($row["user_full_name"]) ?></a>
        <?php } ?>
        <a rel="nofollow" href=<?php echo '"https://www.instagram.com/'. $row["user_net_username"] .'"'?> class="user-nickname" target="_blank"><?php echo '@' . $row["user_net_username"] ?></a>
        <?php } ?>

        <?php if($row["net"] == 'twitter' ) { ?>
        <?php if( $row["user_full_name"] != '' ) { ?>
        <a rel="nofollow" href=<?php echo '"https://twitter.com/'. $row["user_net_username"] .'"'?> class="user-name" target="_blank"><?php echo utf8_encode($row["user_full_name"]) ?></a>
        <?php } ?>
        <a rel="nofollow" href=<?php echo '"https://twitter.com/'. $row["user_net_username"] .'"'?> class="user-nickname" target="_blank"><?php echo '@' . $row["user_net_username"] ?></a>
        <?php } ?>

        <?php if($row["net"] == 'facebook' && $row["user_full_name"] != '' ) { ?>
        <a rel="nofollow" href=<?php echo '"https://www.facebook.com/'. $row["user_id"] .'"'?> class="user-name" target="_blank"><?php echo utf8_encode($row["user_full_name"]) ?></a>
        <?php } ?>
    </div>

    <div class="right-side-wrapper">
        <div class="like-wrapper">
            <a href="#" class=<?php echo '"' . $like_class . '"' ?> id="like-button" data-id=<?php echo '"' . $net_id . '"' ?>>  </a>
            <p class="num-likes" id="num_likes"><?php echo $row["likes"]  ?></p>      
        </div>
        <div class="share-wrapper" style='font-family: "fontello";'>
            
            <a href="#" class="facebook_share"><i id="facebook_share" class="demo-icon icon-hdl-fb" data-id=<?php echo '"' . $net_id . '"' ?> data-type=<?php echo '"' . $row["type"] . '"' ?> data-net=<?php echo '"' . $row["net"] . '"' ?> data-thumb=<?php echo '"' . $row["thumbnail_link"] . '"' ?>>&#xe802;</i></a>
            <a class="twitter-share-button twitter_share" href="https://twitter.com/share"{count} data-url=<?php echo "http://hambredelolla.cl?item=" . $net_id ?> data-text="Mira el vídeo donde demuestro mi hambre de lolla" data-via="lacrianza"><i id="twitter_share" class="demo-icon icon-hdl-tw" data-id=<?php echo '"' . $net_id . '"' ?> data-type=<?php echo '"' . $row["type"] . '"' ?> data-net=<?php echo '"' . $row["net"] . '"' ?> data-thumb=<?php echo '"' . $row["thumbnail_link"] . '"' ?>>&#xe800;</i></a>
            <p class="share-text">Compartir</p>
        </div>
    </div>
</div>		

<?php } 
    }

}

if (is_ajax()) {
    get_video();
}

?>

<script src="js/after_modal_loaded.js"></script>

<script src="js/share.js"></script>
