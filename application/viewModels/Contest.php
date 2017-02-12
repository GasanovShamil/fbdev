<?php

	class Contest {
		public $contestId;
		public $startDate;
		public $endDate;
		public $prize;
		public $status;
		public $createdAt;
		public $createdBy;

		public function __construct($contestId, $startDate, $endDate, $prize, $status, $createdAt, $createdBy) {
			$this->contestId = $contestId;
			$this->startDate = $startDate;
			$this->endDate = $endDate;
			$this->prize = $prize;
			$this->status = $status;
			$this->createdAt = $createdAt;
			$this->createdBy = $createdBy;
		}
	}

?>