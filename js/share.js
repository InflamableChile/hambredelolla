jQuery(document).ready(function($) {

    var online = function(session) {
        var currentTime = (new Date()).getTime() / 1000;
        return session && session.access_token && session.expires > currentTime;
    };

    function errorHandler(e){
        console.log(e);
        console.log("Failed making API request " + e.error.message );
    }

    $('#facebook_share').click(function(event) {
        event.preventDefault();
        net = $(this).attr('data-net');
        type = $(this).attr('data-type');
        net_id = $(this).attr('data-id');
        if(type == 'video_uploaded') {
            thumb = 'http://hambredelolla.cl/server/php/files/thumbs/' + net_id + '.mp4.jpg';
        } else {
            thumb = $(this).attr('data-thumb');    
        }
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                FB.api(
                    "/me?fields=id,name,email,age_range,first_name,last_name",
                    function (response) {
                        if (response && !response.error) {
                            user_full_name = (response['first_name'] + ' ' + response['last_name']);
                            facebook_share(net_id, net, type, thumb, user_full_name);
                        } else {
                            console.log(response);
                        }
                    }
                );
            }
            else {
                FB.login(function(response){
                    if (response.authResponse) {
                        user_full_name = (response['first_name'] + ' ' + response['last_name'])
                        facebook_share(net_id, net, type, thumb, user_full_name);
                    }
                    else {
                        console.log("Dont Got Permissions");
                    }
                }, {scope: 'email,public_profile,user_friends'});
            }
        });

    });

    /*$('#twitter_share').click(function(e) {
        e.preventDefault();
        net_id = $(this).attr('data-id');
        var twitter = hello( 'twitter' );

        if(online(twitter.getAuthResponse())) {
            twitter_share(twitter, net_id);
        } else {
            twitter.login().then(twitter_share(twitter, net_id), errorHandler);
        }

    });*/

    function twitter_share(twitter, net_id) {
        twitter.api('me/share', 'post', {
            status: 'Mira este vídeo donde demuestro mi Hambre de Lolla' + 'http://hambredelolla.cl?item=' + net_id
        }).then(function(response){
            console.log(response);
        });
    }

    function facebook_share (net_id, net, type, user_full_name) {
        nombre = user_full_name + 'quiere compartir este vídeo.'
        FB.ui({
            method: 'feed',
            link: 'http://hambredelolla.cl?item=' + net_id ,
            caption: 'La Crianza - Demuestra tu Hambre de Lolla',
            picture: thumb,
            name: 'Mira este vídeo y particípa!',
            description: 'Hambre de Lolla Description, cambiar en share.js'
        }, function(response){
        });
    }
});