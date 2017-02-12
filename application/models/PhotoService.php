<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require_once(dirname(__FILE__).'/../popo/Photo.php');

	class PhotoService extends CI_Model {

		protected $table = "Photos";

		public function getPhotosOfContest($contest) {
			$query = $this->db->get_where($this->table, 'contest = '.$contest);
			$photos = array();

			foreach ($query->result() as $row)
			{
				$photo = new Photo(
					$row->photoId,
					$row->contest,
					$row->facebookUrl,
					$row->createdAt,
					$row->createdBy
				);

				$photos[] = $photo;
			}

			return $photos;
		}

		// public function getPhoto($photoId) {
		// 	$query = $this->db->get_where($this->table, 'photoId = '.$photoId);
		// 	$row = $query->row();

		// 	if (isset($row)) {
		// 		$user = new User(
		// 			$row->$facebookId, 
		// 			$row->$firstName, 
		// 			$row->$lastName, 
		// 			$row->$email, 
		// 			$row->$birth, 
		// 			$row->$gender, 
		// 			$row->$token
		// 		);

		// 		return $user;
		// 	}

		// 	return null;
		// }

		public function addPhoto($photo) {
			$this->db->insert($this->table, $photo);
		}

		// public function updatePhoto($photo) {
		// 	$this->db->update($this->table, $photo, 'photoId = '.$photo->photoId);
		// }

		public function deletePhoto($photoId) {
			$this->db->delete($this->table, 'photoId = '.$photoId);
		}
	}
?>