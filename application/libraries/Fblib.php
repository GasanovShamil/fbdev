<?php
	require_once('appconfig.php');

	class Fblib {

		private $facebook;

		public function __construct() {
			$this->facebook = new Facebook\Facebook([
				'app_id' => appconfig::getAppId(),
				'app_secret' => appconfig::getAppSecret(),
				'default_graph_version' => 'v2.8'
			]);

			if (!empty($_SESSION['facebook-access-token']))
				$this->facebook->setDefaultAccessToken($_SESSION['facebook-access-token']);
		}

		public function getFacebook() {
			return $this->facebook;
		}

		public function checkAccessToken() {
			if (empty($_SESSION['facebook-access-token']))
				return false;

			try {
				$response = $this->facebook->get('/debug_token?input_token='.$_SESSION['facebook-access-token'], appconfig::getAppToken());
				$result = $response->getGraphObject();

				if (!empty($_SESSION['facebook-access-token']))
					$this->facebook->setDefaultAccessToken($_SESSION['facebook-access-token']);

				return $result['is_valid'];
			} catch (Exception $e) {
				return false;
			}
		}

		public function checkPermissions() {
			$redirectHelper = $this->facebook->getRedirectLoginHelper();
			$response = $this->facebook->get("/me/permissions");
			$userPermissions = $response->getDecodedBody();

			foreach ($userPermissions['data'] as $value) {
				if ($value['status'] == 'declined') {
					$missingPermissions[] = $value['permission'];
				}
			}

			if (!empty($missingPermissions)) {
				$rerequestUrl = $redirectHelper->getReRequestUrl('https://www.facebook.com/projetconcourphoto/app/'.appconfig::getAppId().'/', $missingPermissions);
				$_SESSION['rerequest-url'] = $rerequestUrl;
				return false;
			}

			return true;
		}

		public function isAdmin() {
			$response = $this->facebook-> get('/'.appconfig::getAppId().'/roles?fields=role,user', appconfig::getAppToken());
			$admins = $response->getDecodedBody();
			$userId = $_SESSION['facebook-user-id'];

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
