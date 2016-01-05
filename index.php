<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Hambre de Lolla</title>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Demuestra tu Hambre de Lolla Concurso de La Crianza" />
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
        <script>
            window.twttr = (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0],
                    t = window.twttr || {};
                if (d.getElementById(id)) return t;
                js = d.createElement(s);
                js.id = id;
                js.src = "https://platform.twitter.com/widgets.js";
                fjs.parentNode.insertBefore(js, fjs);

                t._e = [];
                t.ready = function(f) {
                    t._e.push(f);
                };

                return t;
            }(document, "script", "twitter-wjs"));</script>

        <!-- If you'd like to support IE8 -->

        <link rel="stylesheet" href="css/hovereffects/set1.css" />
        <link rel="stylesheet" href="css/hovereffects/normalize.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="css/jquery.fileupload.css">
        <link rel="stylesheet" type="text/css" href="css/full_width_grid/default.css" />
        <link rel="stylesheet" type="text/css" href="css/full_width_grid/component.css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/3.3.0/ekko-lightbox.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/animation.css"><!--[if IE 7]><link rel="stylesheet" href="css/fontello-ie7.css"><![endif]-->
        <link rel="stylesheet" href="css/gridloading/component.css" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/hambredelolla.css" />
        <link rel="stylesheet" href="css/video-js.min.css" />
        <link rel="stylesheet" href="css/hambredelolla_querys.css" />

        <?php
        $db_host="localhost";
        $db_user="hambrede_lolla";
        $db_password="inflamable2015";
        $db_name="hambrede_lolla_db";
        ?>

    </head>

    <body>
        <section id="top">
            <div class="texture-div">

            </div>
            <div class="row nav-header">
                <div class="col-xs-5 col-sm-4 col-md-4 col-lg-5 nav-right">
                    <a href="#">CÓMO CONCURSAR</a>
                </div>
                <div class="col-xs-2 col-sm-4 col-md-4 col-lg-2">
                    <div class="nav-logo"></div>
                </div>
                <div class="col-xs-5 col-sm-4 col-md-4 col-lg-5 nav-left">
                    <a href="#">BASES DEL CONCURSO</a>
                </div>
            </div>
            <div class="row nav-header-movil">
                <div class="col-xs-8 col-sm-8">
                    <div class="nav-logo nav-logo-movil"></div>
                </div>
                <div class="col-xs-4 col-sm-4">
                    <div class="header-bars">
                        <a href="#" id="modal-bases-movil"><i class="fa fa-bars"></i></a>   
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 campaign-call">
                    <div class="campaing-logo-div">

                    </div>
                    <!--<img src="img/campaing-logo.png" class="img-responsive campaign-logo">-->
                    <p><span class="red-letters-logo">¡La Crianza te desafía a demostrar tu #HAMBREDELOLLA!</span><br><span class="white-letters-logo">Ingresa con tu red social, </span><span class="green-letters-logo" >SUBE TU VIDEO</span><span class="white-letters-logo"> y estarás participando por </span><span class="green-letters-logo">ENTRADAS VIP</span><span class="white-letters-logo"> para</span><br><span class="red-letters-logo">LOLLAPALOOZA 2016.</span></p>
                </div>
            </div>

            <div class="row row-campaing-logo-movil">
                <div class="col-xs-12 col-sm-12 campaing-call-movil">
                    <div class="campaing-logo-div-movil">
                        <img src="img/campaing-logo.png" class="img-responsive campaing-logo-movil"/>
                    </div>
                    <p style="text-align:center;"><span class="red-letters-logo">¡La Crianza te desafía a demostrar tu #HAMBREDELOLLA!</span><br><span class="white-letters-logo">Ingresa con tu red social, </span><span class="green-letters-logo" >SUBE TU VIDEO</span><span class="white-letters-logo"> y estarás participando por </span><span class="green-letters-logo">ENTRADAS VIP</span><span class="white-letters-logo"> para</span><br><span class="red-letters-logo">LOLLAPALOOZA 2016.</span></p>
                </div>
            </div>
            <video autoplay id="bgvid" loop>
                <source src="videos/polina.webm" type="video/webm">
                <source src="videos/polina.mp4" type="video/mp4">
            </video>
        </section>
        <section id="bottom" class="bottom">
            <div class="row" style="margin-right: 0; margin-left: 0;">
                <div class="divider-stripe">
                    <div class="row">
                        <div class="col-md-12 conecta-text">
                            <p>CONECTA CON:</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 connect-buttons">
                            <a href="#" class="connect-tw" id="tw-on"><i class="demo-icon icon-hdl-tw" style="font-size: 20px;">&#xe800;</i>    Twitter</a> 
                            <a href="#" class="connect-fb" id="fb-on"><i class="demo-icon icon-hdl-fb" style="font-size: 20px;">&#xe802;</i>   Facebook</a> 
                            <a href="#" class="connect-ig" id="ig-on"><i style="font-size: 20px" class="demo-icon icon-hdl-fb">&#xe801;</i> Instagram</a>
                        </div>
                    </div>
                    <!--<div class="row">
<div class="col-md-12 instagram-text">
Si subiste tu video en instagram con el hashtag #HambreDeLolla, haz click acá para subirlo a nuestro sitio.
</div>
</div>
<div class="row">
<div class="col-md-12 instagram-button">

</div>
</div>-->
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 action-call">¡El #HambreDeLolla está invandiendo la ciudad<br>y nuestras redes sociales!</div>
            </div>
            <div class="row row-feed">
                <div class="col-md-12 sn-feed">
                    <?php 

                    $db_connection = mysql_connect($db_host, $db_user, $db_password);
                    mysql_select_db('hambrede_lolla_db', $db_connection);

                    if (!$db_connection) {
                        die('No se pudo conectar: ' . mysql_error($db_connection));
                    }

                    $sql = "SELECT * FROM media ORDER BY RAND() LIMIT 12";

                    $rsd = mysql_query($sql,$db_connection);

                    if(mysql_num_rows($rsd) > 0) { 
                    ?>


                    <div class="row feed" id="feed-div">
                        <ul class="cbp-rfgrid cropped-images grid effect-5" id="grid">
                            <?php	
                        while($row = mysql_fetch_array($rsd)) {
                            ?>
                            <li>	

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
                            <?php	} ?>
                        </ul>
                    </div>	
                    <?php

                    }

                    ?>
                    <div class="row loading-more" id="loading-more" style="display:none;">
                        <div class="col-md-12 loading-more">
                            <i class="fa fa-spin fa-spinner fa-4x"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 load_more"><a href="#" class="load-more-bt" id="load-more-btn">Cargar más</a></div>
                    </div>
                    <div class="row footer">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <a href="http://www.lacrianza.cl/" target="_blank"><img src="img/lc_logo.png" class="img-responsive lc-logo"></a>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="line-foot"></div>
                            <a href="http://www.lollapaloozacl.com/" target="_blank"><img src="img/lolla-logo.png" class="img-responsive lolla-logo"></a>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 copyright">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>	

        <div id="instafeed"></div>

        <div class="fb-root" id="fb-root">
            <div id="instagram-div">

            </div>	

            <!--<button href="#fb" id="fb-on" >Sube tu propio Video!</button>-->

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






        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>	

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

        <script src="http://vjs.zencdn.net/ie8/1.1.0/videojs-ie8.min.js"></script>
        <script src="http://vjs.zencdn.net/5.2.4/video.js"></script>

        <script src="js/vendor/jquery.ui.widget.js"></script>
        <script src="js/jquery.iframe-transport.js"></script>
        <script src="js/jquery.fileupload.js"></script>
        <script src="js/modernizr.custom.js"></script>
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <script src="js/hello.js"></script>	
        <script src="js/hello_module/instagram.js"></script>	
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.2.0/imagesloaded.pkgd.min.js"></script>
        <script src="js/gridloading/imagesloaded.js"></script>
        <script src="js/gridloading/classie.js"></script>
        <script src="js/gridloading/AnimOnScroll.js"></script>
        <script src="js/facebook_connect.js"></script>
        <script src="js/instagram_api.js"></script>
        <script src="js/modal_content.js"></script>
        <script src="js/share.js"></script>
        <script src="js/load_more.js"></script>

        <script>
            new AnimOnScroll( document.getElementById( 'grid' ), {
                minDuration : 0.4,
                maxDuration : 0.7,
                viewportFactor : 0.2
            } );
        </script>


        <!-- CONTENT MODAL -->
        <div id="content_modal" class="modal fade " data-keyboard="true" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body" style="">
                        <div id="loading-content"  style="display:none; text-align: center; vertical-align: middle;">
                            <i class="fa fa-spin fa-circle-o-notch fa-4x"></i>    
                        </div>

                        <div class="item-wrapper" id="content-modal-container">
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
                        <div class="banner-file-div">
                            <div class="nav-logo-file"></div>
                        </div>
                        <div id="already-logged">
                            <div class="user-connected-fb" style="display:none;" id="user-connected-fb-div">
                                Ya estás conectado con Facebook.
                                <a href="#" class="logout-fb btn btn-primary logout-btn" id="logout-fb"><i class="demo-icon icon-hdl-fb" style="font-size: 15px;">&#xe802;</i> Cerrar Sesión</a>
                            </div>

                            <div class="user-connected-fb" style="display:none;" id="user-connected-tw-div">
                                Ya estás conectado con Twitter.
                                <a href="#" class="logout-fb btn btn-twitter logout-btn" id="logout-tw"><i class="demo-icon icon-hdl-tw" style="font-size: 15px;">&#xe800;</i>     Cerrar Sesión</a>
                            </div>    
                        </div>

                        <div class="connects-modal" id="connects-modal-div" style="display:none;">
                            <a href="#" class="connect-tw" id="tw-on"><i class="demo-icon icon-hdl-tw" style="font-size: 20px;">&#xe800;</i>    Twitter</a>
                            <a href="#" class="connect-fb" id="fb-on"><i class="demo-icon icon-hdl-fb" style="font-size: 20px;">&#xe802;</i>   Facebook</a>
                        </div>
                        <!-- USER DETAILS DIV -->

                        <div id="logged">
                            <div class="file-user-details">
                                <img id="fb-user-thumbail" class="img-circle">
                                <div id="fb-user_full_name" class="fb-user_full_name"></div>
                            </div>

                            <!-- DIV PARA CUANDO EL USUARIO YA SUBIO ALGÚN VIDEO Y LO QUIERE BORRAR -->
                            <div id="fb-dashboard" style="text-align: center; display:none; font-size:20px;">
                                <img class="img-rounded" id="video_uploaded_fb">
                                Ya has subido un vídeo!
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
                                <div class="progress-cancel">
                                    <!-- The global progress bar -->
                                    <div id="progress" class="progress">
                                        <div class="progress-bar progress-bar-success"></div>
                                    </div>
                                    <button type="button" class="btn btn-danger cancel"><i class="fa fa-times"></i></button>        
                                </div>
                                <div id="files" class="files"></div>
                            </div>
                            <div class="thumbnail-uploaded" id="after-video-uploaded" style="display:none; text-align: center;">
                                <img id="thumbnail-video-uploaded" style="width: 500px;">
                                <p style="font-size:25px;"></p>
                                <button class="btn btn-success btn-finalizar" id="end-upload-button">Finalizar</button>
                            </div>    
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>