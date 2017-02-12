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
			$this->createdAt = date('Y-m-d H:i:s').'.000';

			$this->db->insert($this->table, $this);
		}

		public function unvote($user, $photo) {
			$this->db->delete($this->table, 'user = '.$user.' AND photo = '.$photo);
		}
	}
?>