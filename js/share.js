jQuery(document).ready(function($) {
    $('#facebook_share').click(function() {
        net = $(this).attr('data-net');
        type = $(this).attr('data-type');
        net_id = $(this).attr('net_id');
        if(net == 'facebook') {
            thumb = 'http://hambredelolla.cl/server/php/files/thumbs/' + net_id + '.jpg';
        } else {
            thumb = $(this).attr('data-thumb');    
        }
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                FB.api(
                    "/me?fields=id,name,email,age_range,first_name,last_name",
                    function (response) {
                        if (response && !response.error) {
                            console.log(response);
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
                        console.log("All Permissions Granted");
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
    
    function facebook_share (net_id, net, type, user_full_name) {
        nombre = user_full_name + 'quiere compartir este vídeo.'
        FB.ui({
            method: 'feed',
            link: 'http://hambredelolla.cl/',
            caption: 'La Crianza - Demuestra tu Hambre de Lolla',
            picture: thumb,
            name: 'Mira este vídeo y particípa!',
            description: 'Hambre de Lolla Description, cambiar en share.js'
        }, function(response){
            console.log(response);
        });
    }
});