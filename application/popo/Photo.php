<?php

	class Photo {
		public $photoId;
		public $contest;
		public $facebookUrl;
		public $createdAt;
		public $createdBy;

		public function __construct($photoId, $contest, $facebookUrl, $createdAt, $createdBy) {
			$this->photoId = $photoId;
			$this->contest = $contest;
			$this->facebookUrl = $facebookUrl;
			$this->createdAt = $createdAt;
			$this->createdBy = $createdBy;
		}

		public function getVoteUrl() {
			return $this->facebookUrl.'/contest-'.$this->contest.'/photo-'.$this->photoId;
		}
	}

?>