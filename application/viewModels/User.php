<?php

	class User {
		public $facebookId;
		public $firstName;
		public $lastName;
		public $email;
		public $birth;
		public $gender;
		public $token;

		public function __construct($facebookId, $firstName, $lastName, $email, $birth, $gender, $token) {
			$this->facebookId = $facebookId;
			$this->firstName = $firstName;
			$this->lastName = $lastName;
			$this->email = $email;
			$this->birth = $birth;
			$this->gender = $gender;
			$this->token = $token;
		}

		public function getFullName() {
			return $this->firstName.' '.$this->lastName;
		}
	}

?>