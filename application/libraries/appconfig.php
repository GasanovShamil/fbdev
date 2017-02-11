<?php
	class appconfig {
		public static function app_id() {
			return '1158724760874896';
		}

		public static function app_secret() {
			return '2a7b383ebccb6b0df49dc991e0aaf23e';
		}

		public static function app_token() {
			return self::app_id().'|'.self::app_secret();
		}

		public static function app_permissions() {
			return ['email', 'user_likes', 'user_photos', 'user_birthday', 'user_friends'];
		}
?>