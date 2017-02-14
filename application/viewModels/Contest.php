<?php

	class Contest {
		public $id;
		public $name;
		public $start;
		public $end;
		public $prize;

		public function __construct($id, $name, $start, $end, $prize) {
			$this->id = $id;
			$this->name = $name;
			$this->start = $start;
			$this->end = $end;
			$this->prize = $prize;
		}

		public function getDateRange() {
			return 'Du '.$this->start.' au '.$this->end;
		}
	}

?>