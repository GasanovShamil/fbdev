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
			$response = $this->facebook->get('/me/permissions');
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

		public function getAdmins() {
			$response = $this->facebook-> get('/'.appconfig::getAppId().'/roles?fields=role,user', appconfig::getAppToken());
			return $response->getDecodedBody();
		}

		public function isAdmin() {
			$admins = $this->getAdmins();

			foreach ($admins['data'] as $value) {
				if ($value['user'] == $_SESSION['facebook-user-id'] && $value['role'] == 'administrators') {
					return true;
				}
			}

			return false;
		}

		public function publish($title, $description, $user, $photo, $self = false) {
			$id = $user->facebookId;
			$name = $user->getFullName();
			$token = $user->token;

			$data = array(
				'caption' => $title,
				'description' => $description,
				'from' => array('id' => $id, 'name' => $name),
				'link' => base_url(),
				'name' => 'PhotoUp - Concours PARDON MAMAN',
				'picture' => $photo
			);

			return $self ?
				$this->facebook->post('/me/feed', $data) :
				$this->facebook->post('/me/feed', $data, $token) ;
		}

		public function massPublish($title, $description, $users, $photo) {
			foreach ($users as $user) {
				$this->publish($title, $description, $user, $photo)
			}
		}

		public function jsRedirect($url) {
			?> <script>top.location = '<?php echo $url; ?>';</script> <?php
		}
	}
?>
