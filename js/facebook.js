$(document).ready(function() {

	var neededScopes = ['public_profile','email'];
	var maxRequest = 1;
	var numRequest = 0;

	// Load the SDK asynchronously
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/fr_FR/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

	window.fbAsyncInit = function() {
		FB.init({
			appId      : '1158724760874896',
			cookie     : true,
			xfbml      : true,
			version    : 'v2.8'
		});

		FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		});

		function onLogin(response) {
			if (response.status == 'connected') {
				FB.api('/me?fields=first_name', function(data) {
					var welcomeBlock = document.getElementById('fb-welcome');
					welcomeBlock.innerHTML = 'Hello, ' + data.first_name + '!';
				});
			}
		}

		FB.getLoginStatus(function(response) {
			// Check login status on load, and if the user is
			// already logged in, go directly to the welcome message.
			if (response.status == 'connected') {
				onLogin(response);
			} else {
				// Otherwise, show Login dialog first.
				FB.login(function(response) {
					onLogin(response);
				}, {scope: 'user_friends, email'});
			}
		});
	};

	function checkLoginState() {
		FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		});
	}

	function statusChangeCallback(response) {
		if (response.status === 'connected') {
			verifyScope(testAPI, response);
		} else if (response.status === 'not_authorized') {
			document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
			$("#login").show();
			$("#logout").hide();
		} else {
			// The person is not logged into Facebook, so we're not sure if they are logged into this app or not.
			document.getElementById('status').innerHTML = 'Please log ' + 'into Facebook.';
			$("#login").show();
			$("#logout").hide();
		}
	}

	function verifyScope(callback, values) {
		var scopesGranted = [];
		var error = false;

		FB.api('/me/permissions', function(response) {
			response.data.forEach(function(permission) {
				if (permission.status == "granted") {
					scopesGranted.push(permission.permission);
				}
			});

			neededScopes.forEach(function(permissionAsking) {
				if ($.inArray(permissionAsking, scopesGranted) == -1 ) {
					console.log("Il manque des permissions : " + permissionAsking);
					error = true;
				}
			})

			if (error) {
				$("#login").show();
				$("#logout").hide();
				askScopeAgain();
			} else {
				$("#login").hide();
				$("#logout").show();
				callback(values);
			}

			return !error;
		});
	}

	function askScopeAgain() {
		if (numRequest < maxRequest) {
			FB.login(function(response) {
				verifyScope(testAPI, response);
			}, {scope: neededScopes.join(), auth_type: 'rerequest'});

			numRequest++;
		}
	}

	function testAPI(response) {
		console.log(response);
		console.log('Welcome!  Fetching your information.... ');
		console.log("Access token : "+response.authResponse.accessToken);
		console.log("User id : "+response.authResponse.userID);

		FB.api('/me', function(response) {
			console.log('Successful login for: ' + response.name);
			document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + ' !';
		});
	}

	$("#login").click(function() {
		numRequest = 0;
		FB.login(function(response) {
			statusChangeCallback(response);
		}, {scope: neededScopes.join()});
	});

	$("#logout").click(function() {
		FB.logout(function(response) {
			statusChangeCallback(response);
		});
	});

});