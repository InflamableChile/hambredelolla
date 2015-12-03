jQuery(document).ready(function($){

	var hola = hello.init({
		twitter: 'lsSjNHzuBrcNKtQtgMSNDaoe7'
	},{
		redirect_uri:'http://desarrollo.inflamable.cl/hambredelolla/redirect.html',
		oauth_proxy: { 'desarrollo.inflamable.cl/hambredelolla/' : 'http://desarrollo.inflamable.cl/hambredelolla/'
			}[window.location.hostname] || 'https://auth-server.herokuapp.com/proxy'
	});

	$('#tw-on').click(function() {
		$('#result').empty();
		var twitter = hello( 'twitter' );
		// Trigger login to instagram
		twitter.login().then( function(x){

			access_token = x.authResponse.access_token;

			console.log(access_token);

			// Get Profile
			twitter.api('me').then( profileHandler, errorHandler);
		},errorHandler);
	});

	function profileHandler( r ) {
		console.log(r);
		var profile = document.getElementById( 'profile' );
		profile.innerHTML = "<img src='"+ p.thumbnail + "' width=24/>Connected to twitter as " + p.name;
		user_id = r.id;
		user_name = r.name;
		user_pic = r.thumbnail;
		console.log("PROFILE -> " + r);
	}

	function errorHandler(e){
		console.log("Failed making API request " + e.error.message );
	}

});