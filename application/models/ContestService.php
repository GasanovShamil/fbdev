<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require_once(dirname(__FILE__).'/../popo/Contest.php');

	class ContestService extends CI_Model {

		protected $table = "Contests";

		public function getCurrentContest() {
			$query = $this->db->get_where($this->table, 'status = 1');
			$row = $query->row();

			if (isset($row)) {
				$contest = new Contest(
					$row->contestId,
					$row->startDate,
					$row->endDate,
					$row->prize,
					$row->status,
					$row->createdAt,
					$row->createdBy
				);

				return $contest;
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

		public function addContest($contest) {
			//TODO: trigger all contest status to 0
			$this->db->insert($this->table, $contest);
		}

		// public function updateContest($contest) {
		// 	$this->db->update($this->table, $contest, 'contestId = '.$contest->contestId);
		// }

		public function deleteContest($contestId) {
			$this->db->delete($this->table, 'contestId = '.$contestId);
		}
	}
?>