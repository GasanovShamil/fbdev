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
		public $multipleParticipation;
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
					$row->prize,
					$row->multipleParticipation
				);
				return $contest;
			}

			return null;
		}

		public function getContests($isFuture = false, $isPast = false, $before = null, $after = null) {

			$this->db->select('*');
			$this->db->from($this->table);

			if ($isFuture) $this->db->where('state = 2');
			if ($isPast ) $this->db->where('status = 0');
			if ($before != null) $this->db->where('endDate <= '.$before);
			if ($after != null) $this->db->where('startDate >= '.$after);

			$result = $this->db->get()->result();
			$contest_array=array();
			foreach ($result as $row) {
				$contest = new Contest(
					$row->contestId,
					$row->name,
					$row->startDate,
					$row->endDate,
					$row->prize,
					$row->multipleParticipation
				);
				$contest_array[]=$contest;
			}
			return $contest_array;
		}

		public function getNextContest() {
			$query = $this->db->get_where($this->table, 'status = 2 AND startDate=MIN(startDate)');
			$row = $query->row();

			if (isset($row)) {
				$contest = new Contest(
					$row->contestId,
					$row->name,
					$row->startDate,
					$row->endDate,
					$row->prize,
					$row->multipleParticipation
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

		public function addContest($name, $startDate, $endDate, $prize, $multipleParticipation, $createdBy) {
			if (!$this->checkDates($startDate, $endDate, 1)){
				$this->db->update($this->table, array('status' => 0), 'status = 1');
				$this->status=1;
			} else {
				$this->status=2;
			}

			$this->name = $name;
			$this->startDate = $startDate;
			$this->endDate = $endDate;
			$this->prize = $prize;
			$this->multipleParticipation = $multipleParticipation;
			$this->createdAt = date('Y-m-d');
			$this->createdBy = $createdBy;

			$this->db->insert($this->table, $this);
		}

		public function updateContest($contestId, $name, $startDate, $endDate, $prize, $multipleParticipation, $createdBy) {
			$this->contestId = $contestId;
			$this->name = $name;
			$this->startDate = $startDate;
			$this->endDate = $endDate;
			$this->prize = $prize;
			$this->status = 1;
			$this->multipleParticipation = $multipleParticipation;
			$this->createdAt = date('Y-m-d');
			$this->createdBy = $createdBy;

			$this->db->update($this->table, $this, 'contestId = '.$contestId);
		}

		public function deleteContest($contestId) {
			$this->db->delete($this->table, 'contestId = '.$contestId);
		}

		public function checkDates($start, $end, $status){
			$query = $this->db->get_where($this->table, 'status ='.$status);
			$result = $query->result();
			foreach ($result as $row) {
			 	if (($start >= $row->startDate && $start <= $row->endDate) || ($end >= $row->startDate && $end <= $row->endDate)){
			 		return false;	
			 	} 
			}
			return true;
		}
	}
?>