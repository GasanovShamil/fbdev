<?php

	class Participant {
		public $facebookId;
		public $firstName;
		public $lastName;
		public $email;
		public $age;
		public $gender;
		public $nbVotes;
		public $token;

		public function __construct($facebookId, $firstName, $lastName, $email, $birth, $gender, $nbVotes, $token) {
			$this->facebookId = $facebookId;
			$this->firstName = $firstName;
			$this->lastName = $lastName;
			$this->email = $email;
			$this->age = isset($birth) ? $this->getAge($birth) : null;
			$this->gender = $gender;
			$this->nbVotes = $nbVotes;
			$this->token = $token;
		}

		private function getAge($birthday) {
			$birth = explode('/', $birthday);
			$now = explode('/', date('d/m/Y'));
				
			if (($birth[1] < $now[1]) || (($birth[1] == $now[1]) && ($birth[0] <= $now[0])))
				return $now[2] - $birth[2];

			return $now[2] - $birth[2] - 1;
		}
	}

?>