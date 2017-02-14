<?php

	class Photo {
		public $id;
		public $contest;
		public $author;
		public $url;
		public $nbVotes;
		public $hasVoted;

		public function __construct($id, $contest, $author, $url, $nbVotes, $hasVoted) {
			$this->id = $id;
			$this->contest = $contest;
			$this->author = $author;
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
	}

?>