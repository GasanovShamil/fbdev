<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require_once(dirname(__FILE__).'/../viewModels/Contest.php');

	class ContestService extends CI_Model {

		protected $table = "Contests";

		public $contestId;
		public $name;
		public $startDate;
		public $endDate;
		public $prize;
		public $status;
		public $createdAt;
		public $createdBy;

		public function getCurrentContest() {
			$query = $this->db->get_where($this->table, 'status = 1');
			$row = $query->row();

			if (isset($row)) {
				$contest = new Contest(
					$row->contestId,
					$row->name,
					$row->startDate,
					$row->endDate,
					$row->prize
				);

				return $contest;
			}

			return null;
		}
		public function getNextContest() {
			$query = $this->db->get_where($this->table, 'status = 1');
			$row = $query->row();

			if (isset($row)) {
				$contest = new Contest(
					$row->contestId,
					$row->name,
					$row->startDate,
					$row->endDate,
					$row->prize
				);

				return $contest;
				return null;
			}

			return null;
		}

		// public function getContest($contestId) {
		// 	$query = $this->db->get_where($this->table, 'contestId = '.$contestId);
		// 	$row = $query->row();

		// 	if (isset($row)) {
		// 		$contest = new Contest(
		// 			$row->contestId,
		// 			$row->startDate,
		// 			$row->endDate,
		// 			$row->prize,
		// 			$row->status,
		// 			$row->createdAt,
		// 			$row->createdBy
		// 		);

		// 		return $contest;
		// 	}

		// 	return null;
		// }

		public function addContest($name, $startDate, $endDate, $prize, $status, $createdAt, $createdBy) {
			$this->db->update($this->table, array('status' => 0), 'status = 1');

			$this->name = $name;
			$this->startDate = $startDate;
			$this->endDate = $endDate;
			$this->prize = $prize;
			$this->status = $status;
			$this->createdAt = $createdAt;
			$this->createdBy = $createdBy;

			$this->db->insert($this->table, $this);
		}

		// public function updateContest($contest) {
		// 	$this->db->update($this->table, $contest, 'contestId = '.$contest->contestId);
		// }

		public function deleteContest($contestId) {
			$this->db->delete($this->table, 'contestId = '.$contestId);
		}
	}
?>