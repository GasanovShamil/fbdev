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
		$this->load->model('ContestService');
		$this->load->model('PhotoService');
		$this->load->model('PrizeService');
		$this->load->model('VoteService');
	}

	public function index(){
			echo 'Bienvenue dans console admin';
	}



	}