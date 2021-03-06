<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Hambre de Lolla</title>

        <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="HambreDeLolla Concurso de La Crianza" />
        <meta name="keywords" content="Lollapalooza Chile Santiago La Crianza HambreDeLolla LaCrianza" />
        <meta name="author" content="Inflamable SpA" />
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="css/jquery.fileupload.css">
        <link rel="stylesheet" type="text/css" href="css/full_width_grid/default.css">
        <link rel="stylesheet" type="text/css" href="css/full_width_grid/component.css">
        <link href="//cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/3.3.0/ekko-lightbox.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/hambredelolla.css">
        <!-- Rafa EDIT -->
        <link rel="stylesheet" href="css/animation.css"><!--[if IE 7]><link rel="stylesheet" href="css/fontello-ie7.css"><![endif]-->
        <link rel="stylesheet" href="css/style.css">
        <!-- /Rafa EDIT -->
        <link rel="stylesheet" href="css/player.css">
        <?php
        $db_host="localhost";
        $db_user="hambrede_lolla";
        $db_password="inflamable2015";
        $db_name="hambrede_lolla_db";
        ?>
    </head>

    <body>
        <?php /*

        $db_connection = mysql_connect($db_host, $db_user, $db_password);
        mysql_select_db('hambrede_lolla_db', $db_connection);

        if (!$db_connection) {
            die('No se pudo conectar: ' . mysql_error($db_connection));
        }

        $sql = "SELECT * FROM media";

        $rsd = mysql_query($sql,$db_connection);

        if(mysql_num_rows($rsd) > 0) { 
        ?>
        <div class="">
            <ul class="cbp-rfgrid cropped-images">
                <?php	
            while($row = mysql_fetch_array($rsd)) {
        ?>
                <li>			
                    <div class="fill">
                        <a href="#" class=<?php echo '"' . $row["type"] . ' item-modal"' ?>  id=<?php echo '"' . $row["net_id"] . '"' ?>>		
                            <?php 
                    if($row["type"] == "video") {
        ?>
                            <!--<video class="video-js vjs-default-skin vjs-big-play-centered  vjs-volume-bar" controls preload="auto" width="350" height="300" data-setup='{"playbackRates": [1, 1.5, 2],  "controls": true, "autoplay": false }'>
<source src=<?php echo '"' . $row["media_link"] . '"' ?> type='video/mp4'></source>
<p class="vjs-no-js">
Para ver este video por favor active el Javascript y considere actualizar su navegador a uno que soporte HTML5
</p>	
</video>-->
                            <img src=<?php echo '"' . $row["thumbnail_link"] . '"' ?>/>

                            <?php    	} else if($row["type"] != "texto")  { ?>

                            <img src=<?php echo '"' . $row["media_link"] . '"' ?>/>

                            <?php 		} else {

                    }
        ?>	
                            <!--<img src=<?php echo '"' . $row["user_profile_picture"] . '"' ?> style="width: 50px; heigth: 50px"/>
<b><?php echo ($row["user_full_name"]) ?></b> &nbsp;<a href=<?php echo '"http://wwww.instagram.com/' . $row["user_net_username"] . '"' ?> ><?php echo $row["user_net_username"] ?></a>
<p> <?php echo $row["caption"] ?> </p>-->
                        </a>
                    </div>		
                </li>
                <?php	} ?>
            </ul>
        </div>	
        <?php
        }
     */   ?>
        <!-- Rafa EDIT -->
        <section id="top">
            <div class="nav-header">
                <div class="col-md-5 nav-right">
                    <a href="#">CÓMO CONCURSAR</a>
                </div>
                <div class="col-md-2">
                    <div class="nav-logo"></div>
                </div>
                <div class="col-md-5 nav-left">
                    <a href="#">BASES DEL CONCURSO</a>
                </div>
            </div>
            <div class="campaign-call">
                <img src="img/campaing-logo.png" class="img-responsive" style="margin-bottom: 40px;">
                <p><span style="color: #FF3333; font-size: 28px; font-family: PraterSansOne-Bold;">¡La Crianza te desafía a demostrar tu #HAMBREDELOLLA!</span><br><span>Ingresa con tu red social, </span><span style="color: #00CC99; font-size: 23px; font-family: PraterSansOne-Bold;">SUBE TU VIDEO</span><span> y estarás participando por </span><span style="color: #00CC99; font-size: 23px; font-family: PraterSansOne-Bold;">ENTRADAS VIP</span><span> para</span><br><span style="color: #FF3333; font-size: 23px; font-family: PraterSansOne-Bold;">LOLLAPALOOZA 2016.</span></p>
            </div>
            <video autoplay id="bgvid" loop>
                <source src="videos/polina.webm" type="video/webm">
                <source src="videos/polina.mp4" type="video/mp4">
            </video>
        </section>
        <section id="bottom">
            <div class="row" style="margin-right: 0; margin-left: 0;">
                <div class="divider-stripe">
                    <div class="row">
                        <div class="col-md-12 conecta-text">
                            <p>CONECTA CON:</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 tw-left">
                            <a href="#" class="connect-tw" id="tw-on"><i class="demo-icon icon-hdl-tw" style="font-size: 20px;">&#xe800;</i>    Twitter</a> 
                        </div>
                        <div class="col-md-6 fb-right">
                            <a href="#" class="connect-fb" id="fb-on"><i class="demo-icon icon-hdl-fb" style="font-size: 20px;">&#xe802;</i>   Facebook</a> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 action-call">¡El #HambreDeLolla está invandiendo la ciudad<br>y nuestras redes sociales!</div>
            </div>
            <div class="row">
                <div class="col-md-12 sn-feed"></div>
            </div>
            <div class="row">
                <div class="col-md-12 load_more"><a href="#" class="load-more-bt" id="">Cargar más</a></div>
            </div>

        </section>
        <section class="footer">
            <div class="col-md-6">
                <a href="http://www.lacrianza.cl/" target="_blank"><img src="img/lc_logo.png" class="img-responsive lc-logo"></a>
            </div>

            <div class="col-md-6">
                <div class="line-foot"></div>
                <a href="http://www.lollapaloozacl.com/" target="_blank"><img src="img/lolla-logo.png" class="img-responsive lolla-logo"></a>
            </div>
            <div class="col-md-12 copyright">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </section>
        <!-- /Rafa EDIT -->
        <div id="instafeed"></div>

        <div class="fb-root" id="fb-root">

            <div id="instagram-div">

            </div>	

            <button href="#ig" id="ig-on" >Conectate a Instagram</button>

            <button href="#fb" id="fb-on" >Sube tu propio Video!</button>

            <br >

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

        <!-- CONTENT MODAL -->
        <div id="content_modal" class="modal fade " data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body" style="text-align: center;">
                        <i class="fa fa-spin fa-circle-o-notch fa-4x" id="loading-content" style="display:none;"></i>
                        <div class="" id="content-modal-container">
                        </div>
                    </div>
                    <!--<div class="modal-footer">
<button type="button" class="btn btn-danger cancel" data-dismiss="modal">Cancelar</button>
</div>-->
                </div>
            </div>
        </div>

        <div id="myModal" class="modal fade" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <!-- DIV PARA CUANDO EL USUARIO YA SUBIO ALGÚN VIDEO Y LO QUIERE BORRAR -->
                        <div id="fb-dashboard" style="display:none;">
                            <p>Ya has subido un video</p>
                            <img id="fb-user-thumbail" />
                            <h1 id="fb-user_full_name"></h1>
                        </div>

                        <!-- DIV DE FILE UPLOAD / EL USUARIO NO HA SUBIDO NINGUN VIDEO -->
                        <div id="file-upload" style="display:none;">
                            <span class="btn btn-success fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>Seleccionar Archivo</span>
                                <!-- The file input field used as target for the file upload widget -->
                                <input id="fileupload" type="file" name="files[]" accept="video/mp4" multiple>
                            </span>
                            <br>
                            <br>
                            <!-- The global progress bar -->
                            <div id="progress" class="progress">
                                <div class="progress-bar progress-bar-success"></div>
                            </div>
                            <div id="files" class="files"></div>
                        </div>    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger cancel" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

    </body>
    <!-- Rafa EDIT -->
    <script>
        var vid = document.getElementById("bgvid");

        function vidFade() {
            vid.classList.add("stopfade");
        }

        vid.addEventListener('ended', function()
                             {
            // only functional if "loop" is removed 
            vid.pause();
            // to capture IE10
            vidFade();
        }); 
    </script>
    <!-- /Rafa EDIT -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="js/vendor/jquery.ui.widget.js"></script>
    <script src="js/jquery.iframe-transport.js"></script>
    <script src="js/jquery.fileupload.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="js/hello.js"></script>	
    <script src="js/hello_module/instagram.js"></script>	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.2.0/imagesloaded.pkgd.min.js"></script>
    <script src="http://vjs.zencdn.net/5.2.4/video.js"></script>
    <script src="js/instagram_api.js"></script>
    <script src="js/facebook_connect.js"></script>
    <script src="js/modal_content.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/3.3.0/ekko-lightbox.min.js"></script>
</html>