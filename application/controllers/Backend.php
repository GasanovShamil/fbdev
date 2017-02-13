<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Backend extends CI_Controller {

		private $facebook;

		public function __construct() {
			parent::__construct();
			if(!$_SESSION['facebook-is-admin']){ redirect('/'); }
			
			$this->load->library('fblib');
			$this->facebook = $this->fblib->getFacebook();

			$this->load->model('UserService');
			$this->load->model('PhotoService');
			$this->load->model('PrizeService');
			$this->load->model('VoteService');
		}

		public function index(){
			$this->load->view('structure/admin_header.php');
			$this->load->view('admin/admin_index.php');
			$this->load->view('structure/footer.php');
		}

		public function createContest(){
			$this->load->model('ContestService');
			$this->load->helper('form');
    		$this->load->library('form_validation');
			
			$data['title'] = 'Create contest';
			
			if ($this->ContestService->getCurrentContest()!=null){
				$data['alert'] = "Il y a un autre concours en cours. L'ajout d'un nouveau concours va desactiver l'ancien !!!";
			}
			$this->form_validation->set_rules('name','Nom du concours', 'required');
            $this->form_validation->set_rules('startDate', 'Date de debut', 'required|callback_verifDate');
			$this->form_validation->set_rules('endDate', 'Date de fin', 'required');
			$this->form_validation->set_rules('prize','Le pris', 'required');
			
			if ($this->form_validation->run() === FALSE)
            {                     
                        $this->load->view('structure/admin_header.php', $data);
                        $this->load->view('admin/create_contest.php');
                        $this->load->view('structure/footer.php');
            }
            else
            {
                		$this->ContestService->addContest($this->input->post('name'), $this->input->post('startDate'),$this->input->post('endDate'), $this->input->post('prize'), 1, date("Y-m-d"), 'Admin');
                		$this->load->view('structure/admin_header.php');
                        $this->load->view('admin/form_success.php');
                        $this->load->view('structure/footer.php');
            }
		}

		public function getStats(){

		}	


		public function verifDate($date_debut) 
	    {
	        if ($date_debut < date("Y-m-d") || $date_debut > $this->input->post('date_END'))
	        {
	            $this->form_validation->set_message('verifDate', 'Veuillez vérifier vos dates');
	            return FALSE;
	        }
	        else
	        {
	            return TRUE;
	        }
	    }	


	}