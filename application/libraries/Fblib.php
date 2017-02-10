<?php
	// require_once('appconfig.php');

	class Fblib {

		private $fb;

		public function __construct() {
			$this->fb = new Facebook\Facebook([
				'app_id' => '1158724760874896',
				'app_secret' => '2a7b383ebccb6b0df49dc991e0aaf23e',
				'default_graph_version' => 'v2.8'
			]);

			if (!empty($_SESSION['facebook-access-token']))
				$this->fb->setDefaultAccessToken($_SESSION['facebook-access-token']);
		}

		public function getFacebook() {
			return $this->fb;
		}

		public function checkAccessToken() {
			if (empty($_SESSION['facebook-access-token']))
				return false;

			try {
				$response = $this->fb->get('/debug_token?input_token='.$_SESSION['facebook-access-token'],'1158724760874896|2a7b383ebccb6b0df49dc991e0aaf23e');
				$result = $response->getGraphObject();

				if (!empty($_SESSION['facebook-access-token']))
					$this->fb->setDefaultAccessToken($_SESSION['facebook-access-token']);

        		return $result['is_valid'];
			} catch (Exception $e) {
				return false;
			}
		}

		public function checkPermissions($permissions) {
			$helper = $this->fb->getRedirectLoginHelper();
			$response = $this->fb->get("/me/permissions");
			$userPermissions = $response->getDecodedBody();

			foreach ($userPermissions['data'] as $value) {
				if ($value['status'] == 'declined') {
					$missingPermissions[] = $value['permission'];
				}
			}

			if (!empty($missingPermissions)) {
				$rerequestUrl = $helper->getReRequestUrl('https://www.facebook.com/projetconcourphoto/app/1158724760874896/', $missingPermissions);
				$_SESSION['rerequest-url'] = $rerequestUrl;
				return false;
			}

			return true;
		}

		public function getUserId(){
			try{
				$response = $this->fb->get("/me?fields=id");
			}
			catch(Facebook\Exceptions\FacebookResponseException $e) {
				echo 'Graph returned an error bizzare1: ' . $e->getMessage();
				exit;
			} 
			catch(Facebook\Exceptions\FacebookSDKException $e) {
				echo 'Facebook SDK returned an error bizzare2: ' . $e->getMessage();
				exit;
			}

			$user = $response->getGraphUser();

			return $user['id'];
		}	

		public function isAdmin() {
			$appAccessToken = '1158724760874896|2a7b383ebccb6b0df49dc991e0aaf23e';
			$response = $this->fb-> get('/1158724760874896/roles?fields=role,user', $appAccessToken);
			$admins = $response->getDecodedBody();
			$userId = $this->getUserId();

			foreach ($admins['data'] as $value) {
				if ($value['user'] == $userId && $value['role'] == 'administrators') {
					return true;
				}
			}

			return false;
		}

		public function jsRedirect($url) {
			?> <script>top.location = '<?php echo $url; ?>';</script> <?php
		}
	}
?>
