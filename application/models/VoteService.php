<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class VoteService extends CI_Model {

		protected $table = "Votes";

		public $user;
		public $photo;
		public $createdAt;

		public function vote($user, $photo) {
			$this->user = $user;
			$this->photo = $photo;
			$this->createdAt = date('Y-m-d');

			$this->db->insert($this->table, $this);
		}

		public function unvote($user, $photo) {
			$this->db->delete($this->table, 'user = '.$user.' AND photo = '.$photo);
		}

		public function getNbVotes($photo) {
			$result = $this->db->select('COUNT(user) AS nbVotes')
								->from($this->table)
								->where('photo = '.$photo)
								->get()
								->row();

			return $result->nbVotes;
		}

		public function hasVoted($user, $photo) {
			$result = $this->db->select('COUNT(user) AS hasVoted')
								->from($this->table)
								->where('user ='.$user.' AND photo = '.$photo)
								->get()
								->row();

			return $result->hasVoted;
		}
	}
?>