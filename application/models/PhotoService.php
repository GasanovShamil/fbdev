<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require_once(dirname(__FILE__).'/../viewModels/Photo.php');

	class PhotoService extends CI_Model {

		protected $table = "Photos";

		public $photoId;
		public $contest;
		public $facebookUrl;
		public $createdAt;
		public $createdBy;

		public function getPhotosOfContest($contest) {
			$this->load->model('VoteService');

			$result = $this->db->select('Photos.photoId, Users.firstName, Users.lastName, Photos.facebookUrl')
								->from($this->table)
								->join('Users', 'Users.facebookId = Photos.createdBy', 'inner')
								->where('Photos.contest ='.$contest)
								->get()
								->result();

			$photos = array();

			foreach ($result as $row)
			{
				$id = $row->photoId;
				$author = $row->firstName.' '.$row->lastName;
				$url = $row->facebookUrl;
				$nbVotes = $this->VoteService->getNbVotes($id);
				$hasVoted = $this->VoteService->hasVoted($_SESSION['facebook-user-id'], $id);

				$photos[] = new Photo($id, $contest, $author, $url, $nbVotes, $hasVoted);
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

		public function addPhoto($photoId, $contest, $facebookUrl, $createdAt, $createdBy) {
			$this->photoId = $photoId;
			$this->contest = $contest;
			$this->facebookUrl = $facebookUrl;
			$this->createdAt = $createdAt;
			$this->createdBy = $createdBy;

			$this->db->insert($this->table, $this);
		}

		// public function updatePhoto($photo) {
		// 	$this->db->update($this->table, $photo, 'photoId = '.$photo->photoId);
		// }

		public function deletePhoto($photoId) {
			$this->db->delete($this->table, 'photoId = '.$photoId);
		}
	}
?>