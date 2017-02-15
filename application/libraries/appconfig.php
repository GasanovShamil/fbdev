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

		public static function getAppImage() {
			return 'https://scontent-mrs1-1.xx.fbcdn.net/v/t31.0-8/q86/s960x960/15000686_1707409426239398_8759567334221380658_o.jpg?oh=a6fe962f40310c1f4b345d6278242922&oe=59051A4C';
		}
	}
?>