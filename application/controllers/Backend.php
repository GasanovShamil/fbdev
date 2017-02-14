<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Backend extends CI_Controller {

		private $facebook;

		public function __construct() {
			parent::__construct();
			if(!$_SESSION['facebook-is-admin']){ redirect('/'); }
			
			$this->load->library('fblib');
			$this->facebook = $this->fblib->getFacebook();
		}

		public function index() {
			$this->load->view('structure/admin_header.php');
			$this->load->view('admin/admin_index.php');
			$this->load->view('structure/footer.php');
		}

		public function listContests() {

			$this->load->view('structure/admin_header.php');

			$this->load->view('structure/footer.php');
		}

		public function createContest() {
			$this->load->model('ContestService');
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$data['title'] = 'Create contest';
			
			if ($this->ContestService->getCurrentContest() != null) {
				$data['alert'] = 'Il y a un autre concours en cours. L\'ajout d\'un nouveau concours va désactiver l\'ancien !!!';
			}
			$this->form_validation->set_rules('name','Nom du concours', 'required');
			$this->form_validation->set_rules('startDate', 'Date de debut', 'required|callback_verifDate');
			$this->form_validation->set_rules('endDate', 'Date de fin', 'required');
			$this->form_validation->set_rules('prize','Le pris', 'required');

			if ($this->form_validation->run() === false) {
				$this->load->view('structure/admin_header.php', $data);
				$this->load->view('admin/create_contest.php');
				$this->load->view('structure/footer.php');
			} else {
				$this->ContestService->addContest(
					$this->input->post('name'),
					$this->input->post('startDate'),
					$this->input->post('endDate'),
					$this->input->post('prize'),
					$this->input->post('multipleParticipation') != null,
					$_SESSION['facebook-user-id']
				);

				$this->load->view('structure/admin_header.php');
				$this->load->view('admin/form_success.php');
				$this->load->view('structure/footer.php');
			}
		}

		public function getStats() {

		}


		public function verifDate($start) {
			if ($start < date("Y-m-d"))
			{
				$this->form_validation->set_message('verifDate', 'La date de début est dans le passé !');
				return false;
			}
			else if ($start > $this->input->post('endDate')) 
			{
				$this->form_validation->set_message('verifDate', 'La date de début est après la date de fin !');
				return false;
			}
			//  else if () 
			// {
			//     $this->form_validation->set_message('verifDate', '');
			//     return FALSE;
			// }
			else
			{
				return true;
			}
		}


	}