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
			if (!$this->checkDates1($startDate, $endDate)){
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

		public function checkDates1($start, $end){
			$query = $this->db->get_where($this->table, 'status = 1');
			
			if (!isset($query->row)) {
				return true;
			} else {
				foreach ($query->result() as $row) {
				 	if (($start <= $row->endDate) && ($end >= $row->startDate)){
				 		return false;	
				 	} 
				}
				return true;
			}
		}

		public function checkDates2($start, $end){
			$query = $this->db->get_where($this->table, 'status = 2');
			
			if (!isset($query->row)) {
				return true;
			} else {
				foreach ($query->result() as $row) {
				 	if (($start <= $row->endDate) && ($end >= $row->startDate)){
				 		return false;	
				 	} 
				}
				return true;
			}
		}
	}
?>