jQuery(document).ready(function($) {

    var net_id = '';
    var user_id = '';

    $('.item-modal').click(function() {

        net_id = $(this).attr('id');
        
        if($('#id-aux').hasClass(net_id)) {

            $("#content_modal").modal('show');

        } else {
            $('#loading-content').show();
            $('#content-modal-container').empty();
            $("#content_modal").modal('show');

            if( $(this).hasClass('video') ) {

                type = 'video'

            } else if($(this).hasClass('image')) {

                type = 'image'

            }
            FB.getLoginStatus(function(response) {
                if (response.status === 'connected') {
                    FB.api(
                        "/me?fields=id,name,email,age_range,first_name,last_name",
                        function (response) {
                            if (response && !response.error) {
                                user_id = response['id'];
                                $.ajax({
                                    type: "POST",
                                    dataType: "html",
                                    url: "content.php",
                                    data: {
                                        'net_id' : net_id,
                                        'user_id' : user_id,
                                        'type' : type
                                    },
                                    success: function(data) {
                                        $('#loading-content').hide();
                                        $('#content-modal-container').empty();
                                        $('#content-modal-container').append(data);
                                        console.log(user_id);
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
                else {
                    user_id = '';
                    $.ajax({
                        type: "POST",
                        dataType: "html",
                        url: "content.php",
                        data: {
                            'net_id' : net_id,
                            'user_id' : user_id,
                            'type' : type
                        },
                        success: function(data) {
                            $('#loading-content').hide();
                            $('#content-modal-container').empty();
                            $('#content-modal-container').append(data);
                        },
                        error: function(xhr, desc, err) {
                            console.log(xhr);
                            console.log("Details: " + desc + "\nError:" + err);
                        }
                    });
                }
            });
            console.log(user_id);
            
        }

    });

});