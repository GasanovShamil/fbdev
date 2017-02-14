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

		public function addPhoto($contest, $facebookUrl, $createdBy) {
			$this->contest = $contest;
			$this->facebookUrl = $facebookUrl;
			$this->createdAt = date('Y-m-d');
			$this->createdBy = $createdBy;

			$this->db->insert($this->table, $this);
		}

		public function getPhotosOfContest($contest) {
			$this->load->model('VoteService');

			$result = $this->db->select('Photos.photoId, Users.firstName, Users.lastName, Photos.facebookUrl')
								->from($this->table)
								->join('Users', 'Users.facebookId = Photos.createdBy', 'inner')
								->where('Photos.contest ='.$contest)
								->order_by('RAND()')
								->get()
								->result();

			$photos = array();

			foreach ($result as $row)
			{
				$id = $row->photoId;
				$label = $row->firstName.' '.$row->lastName;
				$url = $row->facebookUrl;
				$nbVotes = $this->VoteService->getNbVotes($id);
				$hasVoted = $this->VoteService->hasVoted($_SESSION['facebook-user-id'], $id);

				$photos[] = new Photo($id, $label, $url, $nbVotes, $hasVoted);
			}

			return $photos;
		}
	}
?>