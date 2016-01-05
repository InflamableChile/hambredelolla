jQuery(document).ready(function($) {

    var current_ids = [];
    $('#load-more-btn').click( function (e) {
        $('#loading-more').show();
        e.preventDefault();
        $( ".item-modal" ).each(function() {
            current_ids.push($(this).attr('id'));
        });
        var json_ids = JSON.stringify(current_ids);
        $.ajax({
            type: "POST",
            dataType: "HTML",
            url: "load_more.php",
            data: {
                'json_ids' : json_ids,
            },
            success: function(data) {
                $('#loading-more').hide();
                if(data != 'nada') {
                    //.appendTo('.cbp-rfgrid');
                    //$('.cbp-rfgrid li').last().after($(data).html());
                    $(data).appendTo('.cbp-rfgrid');
                    //$('.cbp-rfgrid').append(data);
                    /*$('#.sn-feed').height(function (index, height) {
                        return (height + 1425);
                    });*/    
                }
                current_ids = [];
            },
            error: function(xhr, desc, err) {
                console.log(xhr);
                $('#loading-more').hide();
                console.log("Details: " + desc + "\nError:" + err);
            }
        });
    });

    /*function increase_height(num_elements) {
        if(num_elements >= 1 && num_elements <= 4) {

        } else if (num_elements >= 5 && num_elements <= 8 ) {

        } else if (num_elements >= 9 && num_elements <= 12 ) {

        }
    }*/
});
