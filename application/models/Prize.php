<?php

	class Prize {
		public $prizeId;
		public $description;
		public $image;
		public $createdAt;
		public $createdBy;
		public $updatedAt;
		public $updatedBy;

		public function __construct($prizeId, $description, $image, $createdAt, $createdBy, $updatedAt, $updatedBy) {
			$this->prizeId = $prizeId;
			$this->description = $description;
			$this->image = $image;
			$this->createdAt = $createdAt;
			$this->createdBy = $createdBy;
			$this->updatedAt = $updatedAt;
			$this->updatedBy = $updatedBy;
		}
	}

?>