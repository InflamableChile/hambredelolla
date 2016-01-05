jQuery(document).ready(function($) {


    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };


    var net_id = '';
    var user_id = '';

    if(getUrlParameter('item') != undefined) {
        net_id = getUrlParameter('item');
        $('#loading-content').show();
        $('#content-modal-container').empty();
        $("#content_modal").appendTo("body").modal('show');
        ajax_call();
    }

    $('body').on( 'click', '.item-modal', function(event) {
        event.preventDefault();
        net_id = $(this).attr('id');

        if($('#id-aux').hasClass(net_id)) {

            $("#content_modal").appendTo("body").modal('show');
        } else {
            $('#loading-content').show();
            $('#content-modal-container').empty();
            $("#content_modal").appendTo("body").modal('show');
            ajax_call();
        }

    });

    function ajax_call() {
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                FB.api(
                    "/me?fields=id,name,email,age_range,first_name,last_name",
                    function (response) {
                        if (response && !response.error) {
                            user_id = response['id'];
                        }
                    }
                    );
            }
            else {
                user_id = '';
            }
        });
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "content.php",
            data: {
                'net_id' : net_id,
                'user_id' : user_id,
            },
            success: function(data) {
                $.ajax({ url: 'http://platform.twitter.com/widgets.js', dataType: 'script', cache:true});
                $('#loading-content').hide();
                $('#content-modal-container').empty();
                $('#content-modal-container').append(data);
                if($('#content-modal-container').find("video").length) {
                    videojs(document.getElementsByClassName("video-js")[0], {}, function(){
                        var myPlayer = this;
                        myPlayer.on("pause", function () {
                            myPlayer.bigPlayButton.show();
                            $('.vjs-big-play-button').show();
                        });
                        myPlayer.on("play", function () {
                            myPlayer.bigPlayButton.hide();
                            $('.vjs-big-play-button').hide();
                        });
                    });    
                }

            },
            error: function(xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
        });
    }
});