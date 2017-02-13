<?php

	class Prize {
		public $prizeId;
		public $description;
		public $image;
		public $createdAt;
		public $createdBy;

		public function __construct($prizeId, $description, $image, $createdAt, $createdBy) {
			$this->prizeId = $prizeId;
			$this->description = $description;
			$this->image = $image;
			$this->createdAt = $createdAt;
			$this->createdBy = $createdBy;
		}
	}

?>