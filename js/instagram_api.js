jQuery(document).ready(function($) {

	var tag = 'hambredelolla';
	var client_id = "9e99de3624344c628270c59edc199930";
	var redirect_url = 'http://desarrollo.inflamable.cl/hambredelolla';

	var hola = hello.init({
		instagram : '9e99de3624344c628270c59edc199930'
	},{
		scope : 'photos',
		redirect_uri:'http://desarrollo.inflamable.cl/hambredelolla'
	});

	var user_id, user_name, user_pic;

	function profileHandler( r ){
		var profile = document.getElementById( 'profile' );
		profile.innerHTML = "<img src='"+ r.thumbnail + "' width=150/>Connected to instagram as " + r.name;
		user_id = r.id;
		user_name = r.name;
		user_pic = r.thumbnail;

		console.log('URL ->' + url);
		console.log('User_id ->' + user_id);
	}


	function errorHandler(e){
		console.log("Failed making API request " + e.error.message );
	}

	function photosHandler( r ){
		console.log("FOTOS");
		console.log(r);
	}

	var access_token, url;
	var tag = 'hambredelolla';

	$('#ig-on').click(function() {

		var instagram = hello( 'instagram' );
		// Trigger login to instagram
		instagram.login().then( function(x){

			access_token = x.authResponse.access_token;
			url = 'https://api.instagram.com/v1/tags/' + tag +'?access_token=' + access_token;

			// Get Profile
			instagram.api('me').then( profileHandler, errorHandler);

		},errorHandler);
	});
});