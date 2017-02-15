<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require_once(dirname(__FILE__).'/../viewModels/Photo.php');
	require_once(dirname(__FILE__).'/../viewModels/Participant.php');

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

		public function hasParticipated($user, $contest) {
			$result = $this->db->select('COUNT(photoId) AS hasParticipated')
								->from($this->table)
								->where('createdBy ='.$user.' AND contest = '.$contest)
								->get()
								->row();

			return $result->hasParticipated > 0;
		}

		public function getParticipants($contest) {
			$this->load->model('VoteService');

			$result = $this->db->select('Photos.photoId, Photos.createdBy, Users.firstName, Users.lastName, Users.email, Users.birth, Users.gender')
					->from($this->table)
					->join('Users', 'Users.facebookId = Photos.createdBy', 'inner')
					->where('Photos.contest ='.$contest)
					->order_by('Photos.createdAt')
					->get()
					->result();

			$participants = array();

			foreach ($result as $row) {
				$photo = $row->photoId;

				$id = $row->createdBy;
				$firstName = $row->firstName;
				$lastName = $row->lastName;
				$email = $row->email;
				$birth = $row->birth;
				$gender = $row->gender;
				$nbVotes = $this->VoteService->getNbVotes($photo);

				$participants[] = new Participant($id, $firstName, $lastName, $email, $birth, $gender, $nbVotes);
			}

			return $participants;
		}

		public function getParticipantsResult($contest) {
			$this->load->model('VoteService');

			$result = $this->db->select('Photos.photoId, Photos.createdBy, Users.firstName, Users.lastName, Users.email, Users.birth, Users.gender')
					->from($this->table)
					->join('Users', 'Users.facebookId = Photos.createdBy', 'inner')
					->where('Photos.contest ='.$contest)
					->order_by('Photos.createdAt')
					->get()
					->result();

			return $result;
		}
	}
?>