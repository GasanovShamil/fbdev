<?php
	require_once('appconfig.php');
	require_once(dirname(__FILE__).'/../helpers/PHPMailer/PHPMailerAutoload.php');

	class Maillib {

		private $mail;

		public function __construct() {
			$this->mail = new PHPMailer;
			$this->mail->isSMTP();
			$this->mail->Host = 'smtp.gmail.com';
			$this->mail->SMTPAuth = true;
			$this->mail->Username = appconfig::getAdminSenderLogin();
			$this->mail->Password = appconfig::getAdminSenderPassword();
			$this->mail->SMTPSecure = 'tls';
			$this->mail->Port = 587;
			$this->mail->setFrom(appconfig::getAdminSenderLogin(), 'Admin PhotoUp');
			$this->mail->isHTML(true);
			$this->mail->Subject = '[PhotoUp] Admin Notification';
		}

		public function sendMail($recipients, $message) {
			foreach ($recipients as $mail) {
				$this->mail->addAddress($mail);
			}

			$this->mail->Body = $message;
			$this->mail->send();
		}
	}
?>
