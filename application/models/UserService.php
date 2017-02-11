<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require_once(dirname(__FILE__).'/../popo/User.php');

	class UserService extends CI_Model {

		protected $table = "users";

		public function getUser($facebookId) {
			$query = $this->db->get_where($this->table, array('facebookId' => , $facebookId);
			$row = $query->row();

			if (isset($row)) {
				$user = new User(
					$row->$facebookId, 
					$row->$firstName, 
					$row->$lastName, 
					$row->$email, 
					$row->$birth, 
					$row->$gender, 
					$row->$token
				);

				return $user;
			}

			return null;
		}

		// public function addUser($facebookId, $firstName, $lastName, $email, $birth, $gender, $token) {
		// 	$data = array(
		// 		'facebookId' => $facebookId,
		// 		'firstName' => $firstName,
		// 		'lastName' => $lastName,
		// 		'email' => $email,
		// 		'birth' => $birth,
		// 		'gender' => $gender,
		// 		'token' => $token
		// 	);

		// 	$this->db->insert($this->table, $data);
		// }

		public function addUser($user) {
			$this->db->insert($this->table, $user);
		}

		public function updateUser($user) {
			$this->db->update($this->table, $user, 'facebookid = $user->facebookId');
		}

		public function deleteUser($facebookId) {
			$this->db->delete($this->table, 'facebookid = $facebookId');
		}
	}
?>