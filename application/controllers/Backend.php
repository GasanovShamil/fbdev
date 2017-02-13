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
			$this->load->view('structure/admin_index.php');
			$this->load->view('structure/footer.php');
		}

		public function createContest(){
			$this->load->model('ContestService');
			if ($this->ContestService->getCurrentContest()!=null){
				$_SESSION['facebook-alert'] = true;
				$message = ""
			}
		}

		public function getStats(){

		}





	}