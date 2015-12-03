jQuery(document).ready(function($) {

	var hola = hello.init({
		instagram : '9e99de3624344c628270c59edc199930'
	},{
		scope : 'photos',
		redirect_uri:'http://desarrollo.inflamable.cl/hambredelolla/redirect.html',
	});

	var user_id, user_name, user_pic;

 
    var $container = $('#container');
  
    $container.imagesLoaded( function(){
      $container.masonry({
        itemSelector : '.masonryImage'
      });
    });
 

	function profileHandler( r ){
		var profile = document.getElementById( 'profile' );
		profile.innerHTML = "<img src='"+ r.thumbnail + "' width=150/>Connected to instagram as " + r.name;
		user_id = r.id;
		user_name = r.name;
		user_pic = r.thumbnail;
		console.log(r);
		$.ajax({
					type: "POST",
		        	dataType: "json",
		        	url: "user_query.php",
		        	data: {
		        		'net_id' : r.data.id,
		            	'full_name' : r.data.full_name,
		            	'net_username' : r.data.username,
		            	'net' : 'instagram'
		         	},
		         	success: function(data) {
			         	console.log(data);
			         	console.log("USER SAVED");
		          	},
		          	error: function(xhr, desc, err) {
		            	console.log(xhr);
		            	console.log("Details: " + desc + "\nError:" + err);
		          	}
				});
	}

	function mediaHandler (r) {
		for(var i=0;i<r.data.length;i++) {
			var media = r.data[i];

			var uploaded_time = new Date(parseInt(media.created_time) * 1000);
			console.log(media);

			if (media.type == "video") {
				
				$.ajax({
					type: "POST",
		        	dataType: "json",
		        	url: "media_query.php",
		        	data: {
	        			'user_full_name' : media.user.full_name,
	        			'user_net_username' : media.user.username,
	        			'user_profile_picture' : media.user.profile_picture,
	        			'net': 'instagram',
		            	'net_id' : media.id,
		            	'user_id' : media.user.id,
		            	'media_link' : media.videos.standard_resolution.url,
		            	'thumbnail_link' : media.images.thumbnail.url,
		            	'uploaded_time' : uploaded_time,
		            	'caption' : media.caption.text,
		            	'type' : media.type
		         	},
		         	success: function(data) {
			         	console.log(data);
		          	},
		          	error: function(xhr, desc, err) {
		            	console.log(xhr);
		            	console.log("Details: " + desc + "\nError:" + err);
		          	}
				});

				/*var video = document.createElement('video');
				video.width = '600';
				video.height = '600';
				var source = document.createElement('source');
				source.src = media.videos.standard_resolution.url;
				source.type = 'video/mp4';
				video.appendChild(source);
				document.getElementById( 'result' ).appendChild( video );*/
			}
			if (media.type == "image") {

				$.ajax({
					type: "POST",
		        	dataType: "json",
		        	url: "media_query.php",
		        	data: {
		        		'user_full_name' : media.user.full_name,
	        			'user_net_username' : media.user.username,
	        			'user_profile_picture' : media.user.profile_picture,
	        			'net': 'instagram',
		            	'net_id' : media.id,
		            	'user_id' : media.user.id,
		            	'media_link' : media.images.standard_resolution.url,
		            	'thumbnail_link' : media.images.thumbnail.url,
		            	'uploaded_time' : uploaded_time,
		            	'caption' : media.caption.text,
		            	'type' : media.type
		         	},
		         	success: function(data) {
			         	console.log(data);
		          	},
		          	error: function(xhr, desc, err) {
		            	console.log(xhr);
		            	console.log("Details: " + desc + "\nError:" + err);
		          	}
				});
				
				/*var img = document.createElement('img');
				img.height = '600';
				img.width = '600';
				img.title = media.name;
				img.src = media.images.standard_resolution.url;
				document.getElementById( 'result' ).appendChild( img );*/
			}

			//var img = document.createElement('video');
			/*img.title = pic.name;
			img.src = pic.thumbnail;
			document.getElementById( 'result' ).appendChild( img );*/
		
		/*var next = r.paging && r.paging.next;
		more.style.display = next ? 'block' : 'none';
		more.onclick = function(){
			hello( 'instagram' ).api( next ).then( photosHandler, errorHandler );
		};*/

		}
	}

	function errorHandler(e){
		console.log("Failed making API request " + e.error.message );
	}


	var access_token, url;
	var tag = 'hambredelolla';

	$('#ig-on').click(function() {
		$('#result').empty();
		var instagram = hello( 'instagram' );
		// Trigger login to instagram
		instagram.login({scope: 'public_content'}).then( function(x){

			access_token = x.authResponse.access_token;

			// Get Profile
			instagram.api('me').then( profileHandler, errorHandler);

			instagram.api('tags/' + tag + '/media/recent').then(mediaHandler, errorHandler);

		},errorHandler);
	});

});