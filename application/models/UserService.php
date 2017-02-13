<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require_once(dirname(__FILE__).'/../viewModels/User.php');

	class UserService extends CI_Model {

		public $facebookId;
		public $firstName;
		public $lastName;
		public $email;
		public $birth;
		public $gender;
		public $token;

		protected $table = "Users";

		public function getUser($facebookId) {
			$query = $this->db->get_where($this->table, 'facebookId = '.$facebookId);
			$row = $query->row();

			if (isset($row)) {
				$user = new User(
					$row->facebookId,
					$row->firstName,
					$row->lastName,
					$row->email,
					$row->birth,
					$row->gender,
					$row->token
				);

				return $user;
			}

			return null;
		}

		public function addUser($facebookId, $firstName, $lastName, $email, $birth, $gender, $token) {
			$this->facebookId = $facebookId;
			$this->firstName = $firstName;
			$this->lastName = $lastName;
			$this->email = $email;
			$this->birth = $birth;
			$this->gender = $gender;
			$this->token = $token;

			$this->db->insert($this->table, $this);
		}

		public function updateUser($facebookId, $firstName, $lastName, $email, $birth, $gender, $token) {
			$this->facebookId = $facebookId;
			$this->firstName = $firstName;
			$this->lastName = $lastName;
			$this->email = $email;
			$this->birth = $birth;
			$this->gender = $gender;
			$this->token = $token;

			$this->db->update($this->table, $this, 'facebookid = '.$this->facebookId);
		}

		// public function deleteUser($facebookId) {
		// 	$this->db->delete($this->table, 'facebookid = '.$facebookId);
		// }
	}
?>