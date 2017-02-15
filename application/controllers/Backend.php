<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once(dirname(__FILE__).'/../viewModels/Contest.php');
	require_once(dirname(__FILE__).'/../libraries/PHPMailer/PHPMailerAutoload.php');

	class Backend extends CI_Controller {

		private $facebook;

		public function __construct() {
			parent::__construct();
			if(!$_SESSION['facebook-is-admin']){ redirect('/'); }
			
			$this->load->library('fblib');
			$this->facebook = $this->fblib->getFacebook();
		}

		public function index() {
			$this->load->view('structure/admin_header_search.php');
			$this->load->view('admin/admin_index.php');
			$this->load->view('structure/footer.php');
		}

		public function listContests() {
			$this->load->model('ContestService');
			$this->load->view('structure/admin_header_search.php');
			$before = $this->input->post('before');
			$after = $this->input->post('after');
			$contests = $this->ContestService->getContests($before, $after);
			foreach ($contests as $contest) {
				$this->load->view('templates/admin-contest-infos.php', array('contest' => $contest));
			}
			$this->load->view('structure/footer.php');
		}

		public function createContest() {
			$this->load->model('ContestService');
			$this->load->helper('form');
			$this->load->library('form_validation');
			$contest = $this->ContestService->getCurrentContest();
			$data['title'] = 'Create contest';
			
			if ($contest != null) {
				$data['alert'] = 'Il y a un concours en cours ('.$contest->getDateRange().'). L\'ajout d\'un nouveau concours pour ces dates va désactiver l\'ancien !!!';
			}
			$this->form_validation->set_rules('name','Nom du concours', 'required');
			$this->form_validation->set_rules('startDate', 'Date de début', 'required|callback_verifDate');
			$this->form_validation->set_rules('endDate', 'Date de fin', 'required');
			$this->form_validation->set_rules('prize','Le prix', 'required');

			if ($this->form_validation->run() === false) {
				$this->load->view('structure/admin_header_search.php', $data);
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

				$this->load->view('structure/admin_header_search.php');
				$this->load->view('admin/form_success.php');
				$this->load->view('structure/footer.php');
			}
		}

		public function deleteContest($contestId){
			$this->load->model('ContestService');
			$this->ContestService->deleteContest($contestId);
			$this->load->view('structure/admin_header_search.php');
			$this->load->view('admin/form_success.php');
			$this->load->view('structure/footer.php');
		}

		public function stopContest($contestId){
			$this->load->model('ContestService');
			$this->ContestService->stopContest($contestId);
			$this->load->view('structure/admin_header_search.php');
			$this->load->view('admin/form_success.php');
			$this->load->view('structure/footer.php');
		}

		public function exportData($contestId){
			$this->load->model('PhotoService');
			$count = 0;
			$header = "";
			$data = "";
			//query
			$result = $this->PhotoService->getParticipantsResult($contestId);
			//count fields
			$count = $result->field_count;
			//columns names
			$names = $result->fetch_fields();
			//put column names into header
			foreach($names as $value) {
			    $header .= $value->name.";";
			    }
			}
			//put rows from your query
			while($row = $result->fetch_row())  {
			    $line = '';
			    foreach($row as $value)       {
			        if(!isset($value) || $value == "")  {
			            $value = ";"; //in this case, ";" separates columns
			    } else {
			            $value = str_replace('"', '""', $value);
			            $value = '"' . $value . '"' . ";"; //if you change the separator before, change this ";" too
			        }
			        $line .= $value;
			    } //end foreach
			    $data .= trim($line)."\n";
			} //end while
			//avoiding problems with data that includes "\r"
			$data = str_replace("\r", "", $data);
			//if empty query
			if ($data == "") {
			    $data = "\nno matching records found\n";
			}
			$count = $result->field_count;

			//Download csv file
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=FILENAME.csv");
			header("Pragma: no-cache");
			header("Expires: 0");
			echo $header."\n".$data."\n";

			
			// $this->load->model('PhotoService');
			// $this->load->dbutil();
			// $this->load->helper('file');
			
			// $result = $this->PhotoService->getParticipantsResult($contestId);
			// var_dump($result);
	  //       $delimiter = ";";
	  //       $newline = "\r\n";
	  //       $csv = $this->dbutil->csv_from_result($result, $delimiter, $newline);
	  //       if (!write_file('test.csv', $csv))
	  //       {
	  //       echo 'Un problème est survenu lors de la génération du fichier CSV';
	  //       }
	  //       else
	  //       {
	  //       echo 'La liste des concours a bien été exportée';
	  //       }
		}

		public function sendMail($to,$message){
			
			$mail = new PHPMailer;
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  					  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'flowerpower.fbdev@gmail.com';                 // SMTP username
			$mail->Password = 'flowerpower';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to
			$mail->setFrom('flowerpower.fbdev@gmail.com', 'Mailer');
			$mail->addAddress('leo.foltzrahem@gmail.com ');              
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Admin notification';
			$mail->Body    = $message;
			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent';
			}
		}

		public function getStats() {

		}

		public function verifDate() {
			$start = $this->input->post('startDate');
			$end = $this->input->post('endDate');

			if ($start < date("Y-m-d")) {
				$this->form_validation->set_message('verifDate', 'La date de début est dans le passé !');
				return false;
			} else if ($start > $end) {
				$this->form_validation->set_message('verifDate', 'La date de début est après la date de fin !');
				return false;
			} else {
				$this->load->model('ContestService');
				$checkDates = $this->ContestService->checkDates($start, $end, 2);

				if (!$checkDates) {
					$this->form_validation->set_message('verifDate', 'Vous avez un autre concours programmé pour ces dates!');
					return false;
			}
				return true;
			}
		}


	}