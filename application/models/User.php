<?php

	class User {
		public $facebookId;
		public $firstName;
		public $lastName;
		public $email;
		public $age;
		public $gender;

		public function __construct($facebookId, $firstName, $lastName, $email, $age, $gender) {
			$this->facebookId = $facebookId;
			$this->firstName = $firstName;
			$this->lastName = $lastName;
			$this->email = $email;
			$this->age = $age;
			$this->gender = $gender;
		}
	}

?>