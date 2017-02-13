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

		// public function getAge() {
		// 	$birth = explode('/', $this->birth);
		// 	$now = explode('/', date('d/m/Y'));
				
		// 	if (($birth[1] < $now[1]) || (($birth[1] == $now[1]) && ($birth[0] <= $now[0])))
		// 		return $now[2] - $birth[2];

		// 	return $now[2] - $birth[2] - 1;
		// }
	}

?>