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
			$query = $this->db->get_where($this->table, 'contest = '.$contest);
			$photos = array();

			foreach ($query->result() as $row)
			{
				$id = $row->photoId;
				$contest;
				$author;
				$url;
				$nbVotes;
				$hasVoted;

				$photo = new Photo(
					$row->photoId,
					$row->contest,
					$row->firstName.' '.$row->lastName,
					$row->facebookUrl,
					0,
					false
				);

				$photos[] = $photo;
			}

			return $photos;

$select = 'Photos.photoId, ';
$select .= 'Users.firstName, ';
$select .= 'Users.lastName, ';
$select .= 'Photos.facebookUrl';

$this->db->select($select);
$this->db->from($this->table);
$this->db->join('Users', 'Users.facebookId = Photos.createdBy', 'inner');
$this->db->where('Photos.contest', $contest);
$result = $this->db->get()->result();
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