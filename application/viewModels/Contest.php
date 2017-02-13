<?php

	class Contest {
		public $contestId;
		public $name;
		public $startDate;
		public $endDate;
		public $prize;
		public $status;
		public $createdAt;
		public $createdBy;

		public function __construct($contestId, $name, $startDate, $endDate, $prize, $status, $createdAt, $createdBy) {
			$this->contestId = $contestId;
			$this->name = $name;
			$this->startDate = $startDate;
			$this->endDate = $endDate;
			$this->prize = $prize;
			$this->status = $status;
			$this->createdAt = $createdAt;
			$this->createdBy = $createdBy;
		}
	}

?>