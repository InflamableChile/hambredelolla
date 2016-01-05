jQuery(document).ready(function ($) {

    var fb_flag = false;

    var online = function(session) {
        var currentTime = (new Date()).getTime() / 1000;
        return session && session.access_token && session.expires > currentTime;
    };

    $('#logout-fb').click(function (e) {
        e.preventDefault();
        FB.logout(function(response) {
            fb_flag = false;
            $('#myModal').modal('hide');
        });
    });

    $('#fb-on').click(function(event) {
        $('#connects-modal-div').hide();
        event.preventDefault();
        var twitter = hello( 'twitter' );
        var tw_auth = twitter.getAuthResponse();
        var fb_bug_flag = false;
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected')
                fb_bug_flag = true;
        });
        if(online(tw_auth) && !fb_bug_flag) {
            $('#user-connected-fb-div').hide();
            $('#user-connected-tw-div').show();
            twitter.api('me').then( twitterModalHandler, errorHandler);
            $("#myModal").modal('show');
        } else {
            
            $('#user-connected-tw-div').hide();
            FB.getLoginStatus(function(response) {
                if (response.status === 'connected') {
                    if(fb_flag) {
                        $('#user-connected-tw-div').hide();
                        $('#user-connected-fb-div').hide();
                        $("#myModal").modal('show');
                    } else {
                        facebook_functions();
                        fb_flag = true;
                    }
                }
                else {
                    FB.login(function(response){
                        if (response.authResponse) {
                            if(fb_flag) {
                                $('#user-connected-tw-div').hide();
                                $('#user-connected-fb-div').hide();
                                $("#myModal").modal('show');
                            } else {
                                facebook_functions();
                                fb_flag = true;
                            }
                        }
                        else {
                            console.log("Dont Got Permissions");
                        }
                    }, {scope: 'email,public_profile,user_friends'});
                }
            });
}   

});

var net = 'facebook';
var user_full_name = '';
var user_net_username = '';
var user_id = '';
var media_link = '';
var thumbnail_link = '';
var user_profile_picture = '';

var d = new Date();
var month = d.getMonth() + 1;
var day = d.getDate();
var uploaded_time = d.getFullYear() + '/' +
((''+month).length<2 ? '0' : '') + month + '/' +
((''+day).length<2 ? '0' : '') + day;

function twitterModalHandler( r ) {
    net_id = r['id'];
    user_full_name = r['name'];
    user_net_username = r['screen_name'];
    user_profile_picture = r['profile_image_url'];
    show_modal();

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

function show_modal() {
    $('#user-connected-fb-div').hide();
    $("#myModal").modal('show');
    $('#fb-user_full_name').text(user_full_name.toUpperCase());
    'use strict';
    var validates_return = validates_user_video();
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
                    return 0;
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
                    
                    $('.btn-finalizar').on("click", function() {
                     location.reload(); 
                 });
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

$('#end-upload-button').click(function(){
 location.reload(); 
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

function errorHandler(e){
    console.log(e);
    console.log("Failed making API request " + e.error.message );
}
});
