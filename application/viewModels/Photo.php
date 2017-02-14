<?php

	class Photo {
		public $id;
		public $label;
		public $url;
		public $nbVotes;
		public $hasVoted;

		public function __construct($id, $label, $url, $nbVotes, $hasVoted) {
			$this->id = $id;
			$this->label = $label;
			$this->url = $url;
			$this->nbVotes = $nbVotes;
			$this->hasVoted = $hasVoted;
		}

		public function getVoteUrl() {
			return 'vote/'.$this->id;
		}

		public function getUnvoteUrl() {
			return 'unvote/'.$this->id;
		}

		public function getParticipateUrl() {
			return 'participate/'.$this->id;
		}
	}

?>