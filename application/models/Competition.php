<?php

	class Competition {
		public $competitionId;
		public $startDate;
		public $endDate;
		public $prize;
		public $status;
		public $createdAt;
		public $createdBy;

		public function __construct($competitionId, $startDate, $endDate, $prize, $status, $createdAt, $createdBy) {
			$this->competitionId = $competitionId;
			$this->startDate = $startDate;
			$this->endDate = $endDate;
			$this->prize = $prize;
			$this->status = $status;
			$this->createdAt = $createdAt;
			$this->createdBy = $createdBy;
		}
	}

?>