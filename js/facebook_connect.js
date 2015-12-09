jQuery(document).ready(function($) {

    $(function () {

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
            var url = 'server/php/';
            $('#fileupload').fileupload({
                url: url,
                dataType: 'json',
                formData: {net_id: net_id, net: net, user_full_name: user_full_name, user_id: user_id, user_profile_picture: user_profile_picture, uploaded_time: uploaded_time},
                done: function (e, data) {
                    console.log("DWADWADWA");
                    console.log(data);
                    $.each(data.result.files, function (index, file) {
                        $('<p/>').text(file.name).appendTo('#files');
                    });
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css(
                        'width',
                        progress + '%'
                        );
                }
            }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
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
                    console.log("TRUE CTM");
                    return_validates = true;
                } else {
                    console.log("FALSE CTM");
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
