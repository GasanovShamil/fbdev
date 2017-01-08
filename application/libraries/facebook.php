<?php
	require_once(dirname(__FILE__).'/../views/vendor/autoload.php');

	function getFacebook() {
		$fb = new Facebook\Facebook([
			'app_id' => '1158724760874896',
			'app_secret' => '2a7b383ebccb6b0df49dc991e0aaf23e',
			'default_graph_version' => 'v2.8',
		]);

		if (!empty($_SESSION['facebook-access-token'])) $fb->setDefaultAccessToken($_SESSION['facebook-access-token']);

		return $fb;
	}

	function checkAccessToken() {
		$fb = getFacebook();

		if (empty($_SESSION['facebook-access-token'])) return false;

		try {
			$response = $fb->get('/debug_token?input_token='.$_SESSION['facebook-access-token']);
			$graphObject = $response->getGraphObject();
		} catch (Exception $e) {
			return false;
		}

		return true;
	}

	function checkPermissions() {
		$fb = getFacebook();

		$response = $fb->get("/me/permissions");
		$userPermissions = $response->getDecodedBody();

		foreach ($userPermissions['data'] as $value) {
			if ($value['status'] == 'declined') {
				$missingPermissions[] = $value['permission'];
			}
		}

		if (!empty($missingPermissions)) {
			$rerequestUrl = $helper->getReRequestUrl(base_url().'callback', $permissions);
			$_SESSION['rerequest-url'] = $rerequestUrl;
			return false;
		}

		return true;
	}

	function getUserName(){
		$fb = getFacebook();
		try{
			$response = $fb->get("/me?fields=name");
		}
		catch(Facebook\Exceptions\FacebookResponseException $e) {
  			echo 'Graph returned an error: ' . $e->getMessage();
  			exit;
		} 
		catch(Facebook\Exceptions\FacebookSDKException $e) {
  			echo 'Facebook SDK returned an error: ' . $e->getMessage();
  			exit;
		}
		
		$userName = $response->getGraphUser();
		return $userName['name'];
	}

	function getUserId(){
		$fb = getFacebook();
		try{
			$response = $fb->get("/me?fields=id");
		}
		catch(Facebook\Exceptions\FacebookResponseException $e) {
  			echo 'Graph returned an error: ' . $e->getMessage();
  			exit;
		} 
		catch(Facebook\Exceptions\FacebookSDKException $e) {
  			echo 'Facebook SDK returned an error: ' . $e->getMessage();
  			exit;
		}
		
		$userName = $response->getGraphUser();
		return $userName['id'];
	}	

?>