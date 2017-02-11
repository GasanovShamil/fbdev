<?php
	class appconfig {
		public static $app_id;
		public static $app_secret;
		public static $app_token;
		public static $app_permissions;
	
		public static function init() {
			self::$app_id = '1158724760874896';
			self::$app_secret = '2a7b383ebccb6b0df49dc991e0aaf23e';
			self::$app_token = appconfig::$app_id.'|'.appconfig::$app_secret;
			self::$app_permissions = ['email', 'user_likes', 'user_photos', 'user_birthday', 'user_friends'];
		}
	}
?>