<?php

	class Photo {
		public $photoId;
		public $contest;
		public $facebookUrl;
		public $createdAt;
		public $createdBy;
		public $nbVote;

		public function __construct($photoId, $contest, $facebookUrl, $createdAt, $createdBy, $nbVote) {
			$this->photoId = $photoId;
			$this->contest = $contest;
			$this->facebookUrl = $facebookUrl;
			$this->createdAt = $createdAt;
			$this->createdBy = $createdBy;
			$this->nbVote = $nbVote;
		}

		// public function getLikeDiv() {
		// 	$div = '<div class="fb-like" ';
		// 	$div .= 'data-href="'.$this->getVoteUrl().'" ';
		// 	$div .= 'data-layout="box_count" ';
		// 	$div .= 'data-action="like" ';
		// 	$div .= 'data-size="small" ';
		// 	$div .= 'data-show-faces="false" ';
		// 	$div .= 'data-share="false">';
		// 	$div .= '</div>';

		// 	return $div;
		// }

		public function getVoteUrl() {
			return $this->facebookUrl.'/contest-'.$this->contest.'/photo-'.$this->photoId;
		}
	}

?>