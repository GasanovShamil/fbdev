<?php
	class appconfig {
		public static function getAppId() {
			return '1158724760874896';
		}

		public static function getAppSecret() {
			return '2a7b383ebccb6b0df49dc991e0aaf23e';
		}

		public static function getAppToken() {
			return self::getAppId().'|'.self::getAppSecret();
		}

		public static function getAppPermissions() {
			return ['email', 'user_likes', 'user_photos', 'user_birthday', 'user_friends', 'publish_actions'];
		}

		public static function getAdminSenderLogin() {
			return 'flowerpower.fbdev@gmail.com';
		}

		public static function getAdminSenderPassword() {
			return 'flowerpower';
		}
	}
?>