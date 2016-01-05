jQuery(document).ready(function($) {

    $('.cropped-images img').each(function() {
        if ($(this).width() > $(this).height()) {
            $(this).addClass('landscape');        
        }
    });

    var hola = hello.init({
        instagram : '95fbe86df67e4878874af1eefc56dce3',
        twitter: 'mzSWD2So3kNcPUMgacL5aYJcF'
    },{
        scope : 'photos',
        redirect_uri:'http://hambredelolla.cl/redirect.html',
    });

    var user_id, user_name, user_pic;


    function profileHandler( r ){
        var profile = document.getElementById( 'profile' );
        profile.innerHTML = "<img src='"+ r.thumbnail + "' width=150/>Connected to instagram as " + r.name;
        user_id = r.id;
        user_name = r.name;
        user_pic = r.thumbnail;
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "user_query.php",
            data: {
                'net_id' : r.data.id,
                'full_name' : r.data.full_name,
                'net_username' : r.data.username,
                'net' : 'instagram'
            },
            success: function(data) {
            },
            error: function(xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
        });
    }

    function mediaHandler (r) {

        var tag_flag = false;
        for(var i=0;i<r.data.length;i++) {
            var media = r.data[i];
            tag_flag = false;
            for(var j=0; j<media["tags"].length; j++) {
                if(media["tags"][j] == 'hambredelolla') {
                    tag_flag = true;
                }
            }
            if(tag_flag) {
                tag_flag = false;
                var uploaded_time = new Date(parseInt(media.created_time) * 1000);

                if (media.type == "video") {

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "media_query.php",
                        data: {
                            'user_full_name' : media.user.full_name,
                            'user_net_username' : media.user.username,
                            'user_profile_picture' : media.user.profile_picture,
                            'net': 'instagram',
                            'net_id' : media.id,
                            'user_id' : media.user.id,
                            'media_link' : media.videos.standard_resolution.url,
                            'thumbnail_link' : media.images.standard_resolution.url,
                            'uploaded_time' : uploaded_time,
                            'caption' : media.caption.text,
                            'type' : media.type
                        },
                        success: function(data) {
                            console.log('video');
                        },
                        error: function(xhr, desc, err) {
                            console.log(xhr);
                            console.log("Details: " + desc + "\nError:" + err);
                        }
                    });
                }
                if (media.type == "image") {
                    console.log(tag_flag);
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "media_query.php",
                        data: {
                            'user_full_name' : media.user.full_name,
                            'user_net_username' : media.user.username,
                            'user_profile_picture' : media.user.profile_picture,
                            'net': 'instagram',
                            'net_id' : media.id,
                            'user_id' : media.user.id,
                            'media_link' : media.images.standard_resolution.url,
                            'thumbnail_link' : media.images.standard_resolution.url,
                            'uploaded_time' : uploaded_time,
                            'caption' : media.caption.text,
                            'type' : media.type
                        },
                        success: function(data) {
                            console.log('image');
                        },
                        error: function(xhr, desc, err) {
                            console.log(xhr);
                            console.log("Details: " + desc + "\nError:" + err);
                        }
                    });
                }
            }
        }
    }

    function errorHandler(e){
        console.log(e);
        console.log("Failed making API request " + e.error.message );
    }


    var access_token, url;
    var tag = 'hambredelolla';

    $('#ig-on').click(function(e) {
        e.preventDefault();
        $('#result').empty();
        var instagram = hello( 'instagram' );
        // Trigger login to instagram
        instagram.login({scope: 'basic'}).then( function(x){

            access_token = x.authResponse.access_token;

            // Get Profile
            instagram.api('me').then( profileHandler, errorHandler);

            instagram.api('users/self/media/recent/').then(mediaHandler, errorHandler);

        },errorHandler);
    });

    var tw_flag = false;



    $('#tw-on').click(function(e) {
        e.preventDefault();
        $('#connects-modal-div').hide();
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                $('#user-connected-fb-div').show();
                $('#user-connected-tw-div').hide();
                facebook_functions();
                $("#myModal").modal('show');
            } else {
                $('#user-connected-fb-div').hide();
                var twitter = hello( 'twitter' );
                var tw_auth = twitter.getAuthResponse();
                if(online(tw_auth)) {
                    twitter.api('me').then( twitterModalHandler, errorHandler);
                } else {
                    // Trigger login to instagram
                    twitter.login().then( function(x){

                        twitter.api('me').then( twitterModalHandler, errorHandler);
                    },errorHandler);
                }
            }
        });


    });

    var net = 'twitter';
    var user_full_name = '';
    var user_net_username = '';
    var user_id = '';
    var media_link = '';
    var thumbnail_link = '';
    var user_profile_picture = '';
    var validates_return = false;
    var net_id = '';
    var d = new Date();
    var month = d.getMonth() + 1;
    var day = d.getDate();
    var uploaded_time = d.getFullYear() + '/' +
        ((''+month).length<2 ? '0' : '') + month + '/' +
        ((''+day).length<2 ? '0' : '') + day;

    function show_modal() {
        $("#myModal").modal('show');
        $('#fb-user-thumbail').attr('src', user_profile_picture);
        $('#fb-user_full_name').text(user_full_name.toUpperCase());
        validates_return = validates_user_video();
        if( validates_return == true) {
            var url = '//hambredelolla.cl/server/php/index.php';
            var jqXHR = null;
            $('#fileupload').fileupload({
                add: function(e, data) {
                    jqXHR = data.submit();
                    var uploadErrors = [];
                    var acceptFileTypes = /^video\/(mp4)$/i;
                    if(data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['type'])) {
                        uploadErrors.push('Formato de Archivo no aceptado, el video debe ser de formato mp4');
                    }
                    if(data.originalFiles[0]['size'].length && data.originalFiles[0]['size'] > 12800000) {
                        uploadErrors.push('Archivo demasiado grande, el tamaño máximo son 128 M');
                    }
                    if(uploadErrors.length > 0) {
                        alert(uploadErrors.join("\n"));
                    } else {
                        data.submit();
                    }
                },
                url: url,
                dataType: 'json',
                autoUpload: true,
                formData: {net_id: net_id, net: net, user_full_name: user_full_name, user_id: user_id, user_profile_picture: user_profile_picture, uploaded_time: uploaded_time},
                //maxFileSize: '12800000',
                //acceptFileTypes:'/(\.|\/)(mp4)$/i',
                done: function (e, data) {

                    $('#file-upload').hide();
                    $('#after-video-uploaded').show();
                    $.each(data.result.files, function (index, file) {
                        $('#thumbnail-video-uploaded').attr('src', 'server/php/files/thumbs/' + file.name + '.jpg');
                    });
                    $('<p/>').text('Has subido tu video, ya estas participando!').appendTo('#after-video-uploaded');

                    /*$.each(data.result.files, function (index, file) {
                        $('<p/>').text(file.name).appendTo('#files');
                    });*/
                },
                fail: function(e, data) {
                    console.log(data);
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css(
                        'width',
                        progress + '%'
                    );
                }
            }).prop('disabled', !$.support.fileInput)
                .parent().addClass($.support.fileInput ? undefined : 'disabled')
                .error(function (jqXHR, textStatus, errorThrown) {
                if (errorThrown === 'abort') {
                    console.log('File Upload has been canceled');
                }
            });

            $('button.cancel').click(function (e) {
                jqXHR.abort();
            });

        }   else {

        }
    }

    function facebook_functions() {
        FB.api(
            "/me/picture",
            function (response) {
                if (response && !response.error) {
                    user_profile_picture = response['data']['url'];
                    $('#fb-user-thumbail').attr('src', user_profile_picture);
                }
            }
        );
        FB.api(
            "/me?fields=id,name,email,age_range,first_name,last_name",
            function (response) {
                if (response && !response.error) {
                    user_full_name = (response['first_name'] + ' ' + response['last_name']);
                    user_id = response['id'];
                    net_id = user_id;
                    show_modal();
                }
            }
        );
    }

    $('#logout-tw').click( function (e) {

        e.preventDefault();
        hello('twitter').logout().then(function() {
            $('#user-connected-tw-div').hide();
            $('#myModal').modal('hide');
        });
    });

    function validates_user_video() {
        var return_validates = false;
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "check_user_upload.php",
            async: false,
            data: {
            'net_id' : net_id,
        },
               success: function(data) {
            if(data == 'true'){
                $('#fb-dashboard').hide();
                $('#file-upload').show();

                $('#fb-video-uploaded').find("source").src = ''
                return_validates = true;
            } else {
                $('#fb-dashboard').show();
                //$('#video_uploaded_fb').attr(src, 'http://hambredelolla.cl')
                $('#file-upload').hide();
                return_validates = false;
            }
        },
            error: function(xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
    });
    return return_validates;
}


                       function twitterModalHandler( r ) {
    net_id = r['id'];
    user_full_name = r['name'];
    user_net_username = r['screen_name'];
    user_profile_picture = r['profile_image_url'];
    show_modal();

}

var online = function(session) {
    var currentTime = (new Date()).getTime() / 1000;
    return session && session.access_token && session.expires > currentTime;
};

});