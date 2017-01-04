<?php

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
			$rerequestUrl = $helper->getReRequestUrl('http://flowerpower.fbdev.fr/callback', $permissions);
			$_SESSION['rerequest-url'] = $rerequestUrl;
			return false;
		}

		return true;
	}

?>