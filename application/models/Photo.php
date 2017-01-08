<?php

	class Photo {
		public $photoId;
		public $competition;
		public $facebookUrl;
		public $createdAt;
		public $createdBy;

		public function __construct($photoId, $competition, $facebookUrl, $createdAt, $createdBy) {
			$this->photoId = $photoId;
			$this->competition = $competition;
			$this->facebookUrl = $facebookUrl;
			$this->createdAt = $createdAt;
			$this->createdBy = $createdBy;
		}
	}

?>