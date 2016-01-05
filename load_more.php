<?php


// here i would like use foreach:

$db_host="localhost";
$db_user="hambrede_lolla";
$db_password="inflamable2015";
$db_name="hambrede_lolla_db";
$db_connection = mysql_connect($db_host, $db_user, $db_password);
mysql_select_db('hambrede_lolla_db', $db_connection);

if (!$db_connection) {
    die('No se pudo conectar: ' . mysql_error($db_connection));
}


$current_ids = implode(json_decode(stripslashes($_POST['json_ids'])),"','");

$sql = "SELECT * FROM media WHERE net_id NOT IN ('" . $current_ids . "') ORDER BY RAND() LIMIT 12";

$rsd = mysql_query($sql,$db_connection);
$i = 1;
if(mysql_num_rows($rsd) > 0) { 
    while($row = mysql_fetch_array($rsd)) {
?>
<li class=<?php echo '"animate-' . $i . '"' ?>>			
    <div class="fill effect-zoe">
        <a href="#" class=<?php echo '"' . $row["type"] . ' item-modal"' ?>  id=<?php echo '"' . $row["net_id"] . '"' ?>>		
            <?php 
        if($row["type"] == "video") {
            ?>

            <img src=<?php echo '"' . $row["thumbnail_link"] . '"' ?>/>

            <?php    	} else if($row["type"] == "image")  { ?>

            <img src=<?php echo '"' . $row["media_link"] . '"' ?>/>


            <?php 		} else if($row["type"] == "video_uploaded")  { ?>

            <img src=<?php echo '"http://elite865.inmotionhosting.com/~hambredelolla/server/php/files/thumbs/' . $row["net_id"] . '.mp4.jpg"' ?>/>

            <?php 		} else { ?>
            <div class="tweet-div">
                <div class="tweet-text-div">
                    <p class="tweet-text">
                        <?php echo $row["caption"] ?>
                    </p>
                </div>
            </div>     
            <?php }
            ?>	
            <div><?php if($row["net"] == "facebook") { ?>
                <i class="demo-icon icon-hdl-fb" style="font-size: 50px;">&#xe802;</i>
                <?php } else if($row["net"] == "twitter") { ?>
                <i class="demo-icon icon-hdl-tw" style="font-size: 50px;">&#xe800;</i>
                <?php } else if($row["net"] == "instagram") { ?>
                <i class="demo-icon icon-hdl-ig" style="font-size: 50px;">&#xe801;</i>
                <?php } ?>
            </div>
            <?php 
                                           if($row["type"] == "video" || $row["type"] == "video_uploaded")  {
            ?>
            <div class="play-div">
                <span class="play-span"><i class="fa fa-play-circle"></i></span>
            </div>
            <?php } ?>
        </a>
        <figcaption>
            <p class="icon-links">
                <span class="hover-userpic" style=<?php echo '"background : url(' . $row["user_profile_picture"] . '); "' ?>></span>
                <?php if($row["net"] == 'instagram') { ?>
                <?php if( $row["user_full_name"] != '' ) { ?>
                <span><?php echo utf8_encode($row["user_full_name"]) ?></span>
                <?php } ?>
                <span><?php echo '@' . $row["user_net_username"] ?></span>
                <?php } ?>

                <?php if($row["net"] == 'twitter' ) { ?>
                <?php if( $row["user_full_name"] != '' ) { ?>
                <span><?php echo utf8_encode($row["user_full_name"]) ?></span>
                <?php } ?>
                <span><?php echo '@' . $row["user_net_username"] ?></span>
                <?php } ?>

                <?php if($row["net"] == 'facebook' && $row["user_full_name"] != '' ) { ?>
                <span><?php echo utf8_encode($row["user_full_name"]) ?></span>
                <?php } ?>

            </p>
        </figcaption>

    </div>		
</li>
<?php	$i++;
                                          } 
} else {
    echo 'nada';
}

?>