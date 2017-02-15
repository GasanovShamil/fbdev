<?php

	class Contest {
		public $id;
		public $name;
		public $start;
		public $end;
		public $prize;
		public $status;
		public $multiple;

		public function __construct($id, $name, $start, $end, $prize, $status, $multiple) {
			$this->id = $id;
			$this->name = $name;
			$this->start = $start;
			$this->end = $end;
			$this->prize = $prize;
			$this->status = $status;
			$this->multiple = $multiple;
		}

		public function getDateRange() {
			return 'Du '.$this->start.' au '.$this->end;
		}
	}

?>