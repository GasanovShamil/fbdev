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

		public function getWinners($contest) {
			// $result = $this->db->select('Photos.photoId, Photos.createdBy, Users.firstName, Users.lastName, Users.email, Users.birth, Users.gender')
			// 		->from($this->table)
			// 		->join('Users', 'Users.facebookId = Photos.createdBy', 'inner')
			// 		->where('Photos.contest ='.$contest)
			// 		->order_by('Photos.createdAt')
			// 		->get()
			// 		->result();

			// $participants = array();

			// foreach ($result as $row) {
			// 	$photo = $row->photoId;

			// 	$id = $row->createdBy;
			// 	$firstName = $row->firstName;
			// 	$lastName = $row->lastName;
			// 	$email = $row->email;
			// 	$birth = $row->birth;
			// 	$gender = $row->gender;
			// 	$nbVotes = $this->VoteService->getNbVotes($photo);

			// 	$participants[] = new User($id, $firstName, $lastName, $email, $birth, $gender, $nbVotes);
			// }

			// return $participants;

			return null;
		}
	}
?>