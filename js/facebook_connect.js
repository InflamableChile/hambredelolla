jQuery(document).ready(function($) {

    $('.item-modal').click(function() {


        $("#video_modal").modal('show');

        $.ajax({
            type: "GET",
            dataType: "html",
            url: "check_user_upload.php",
            async: false,
            data: {
                'net_id' : net_id,
            },
            success: function(data) {
                console.log(data);
                if(data == 'true'){
                    $('#fb-dashboard').hide();
                    $('#file-upload').show();

                    $('#fb-video-uploaded').find("source").src = ''
                    return_validates = true;
                } else {
                    $('#fb-dashboard').show();
                    $('#file-upload').hide();
                    return_validates = false;
                }
            },
            error: function(xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
        });

    });

    $('#fb-on').click(function() {
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                facebook_functions();
            }
            else {
                FB.login(function(response){
                    if (response.authResponse) {
                        console.log("All Permissions Granted");
                        facebook_functions();
                    }
                    else {
                        console.log("Dont Got Permissions");
                    }
                }, {scope: 'email,public_profile,user_friends'});
            }
        });
    });

    var net = 'facebook';
    var user_full_name = '';
    var user_net_username = '';
    var user_id = '';
    var media_link = '';
    var thumbnail_link = '';
    var user_profile_picture = '';

    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();
    var uploaded_time = d.getFullYear() + '/' +
        ((''+month).length<2 ? '0' : '') + month + '/' +
        ((''+day).length<2 ? '0' : '') + day;


    function facebook_functions() {
        FB.api(
            "/me/picture",
            function (response) {
                if (response && !response.error) {
                    console.log(response);
                    user_profile_picture = response['data']['url'];
                    console.log(user_profile_picture);
                }
            }
        );
        FB.api(
            "/me?fields=id,name,email,age_range,first_name,last_name",
            function (response) {
                if (response && !response.error) {
                    console.log(response);
                    user_full_name = (response['first_name'] + ' ' + response['last_name']);
                    user_id = response['id'];
                    net_id = user_id;
                    show_modal();
                }
            }
        );
    }

    function show_modal() {
        $("#myModal").modal('show');
        'use strict';
        var validates_return = validates_user_video();
        console.log("RETURN CTM " + validates_return)
        if( validates_return == true) {
            var url = '//elite865.inmotionhosting.com/~hambredelolla/server/php/index.php';
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
                    $.each(data.result.files, function (index, file) {
                        $('<p/>').text(file.name).appendTo('#files');
                    });
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

    function validates_user_video() {
        var return_validates = false;
        console.log("NET ID ->", net_id);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "check_user_upload.php",
            async: false,
            data: {
                'net_id' : net_id,
            },
            success: function(data) {
                console.log(data);
                if(data == 'true'){
                    $('#fb-dashboard').hide();
                    $('#file-upload').show();

                    $('#fb-video-uploaded').find("source").src = ''
                    return_validates = true;
                } else {
                    $('#fb-dashboard').show();
                    $('#file-upload').hide();
                    return_validates = false;
                }
            },
            error: function(xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
        });
        return return_validates
    }

});
