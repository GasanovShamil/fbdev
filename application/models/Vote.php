<?php

	class Vote {
		public $user;
		public $photo;
		public $createdAt;

		public function __construct($user, $photo, $createdAt) {
			$this->user = $user;
			$this->photo = $photo;
			$this->createdAt = $createdAt;
		}
	}

?>