jQuery(document).ready(function($) {    
    var net_id = '';
    $('#like-button').click(function(event) {
        event.preventDefault();
        net_id = $(this).attr('data-id');
        if($(this).hasClass('like-button-open')) {
            $(this).removeClass();
            $(this).addClass('like-button-full');   
            $('#num_likes').text(parseInt($('#num_likes').text()) + 1);
            open = true;

        } else {
            $(this).removeClass();
            $(this).addClass('like-button-open');    
            $('#num_likes').text(parseInt($('#num_likes').text()) - 1);
            open = false;
        }
        
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                if(open) {
                    liked();
                } else {
                    unliked();
                }
            }
            else {
                FB.login(function(response){
                    if (response.authResponse) {
                        console.log("All Permissions Granted");
                        if(open) {
                            liked();
                        } else {
                            unliked();
                        }
                    }
                    else {
                        console.log("Dont Got Permissions");
                    }
                }, {scope: 'email,public_profile,user_friends'});
            }
        });
    }); 


    function unliked() {
        FB.api(
            "/me?fields=id,name,email,age_range,first_name,last_name",
            function (response) {
                if (response && !response.error) {
                    user_id = response['id'];
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "remove_like.php",
                        data: {
                            'user_id' : user_id,
                            'net_id' : net_id
                        },
                        success: function(data) {
                        },
                        error: function(xhr, desc, err) {
                            console.log(xhr);
                            console.log("Details: " + desc + "\nError:" + err);
                        }
                    });
                }
            }
        );
    }

    function liked() {
        FB.api(
            "/me?fields=id,name,email,age_range,first_name,last_name",
            function (response) {
                if (response && !response.error) {
                    user_id = response['id'];
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "save_like.php",
                        data: {
                            'user_id' : user_id,
                            'net_id' : net_id
                        },
                        success: function(data) {
                        },
                        error: function(xhr, desc, err) {
                            console.log(xhr);
                            console.log("Details: " + desc + "\nError:" + err);
                        }
                    });
                }
            }
        );
    }
    
});