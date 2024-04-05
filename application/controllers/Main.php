<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
    {
   	/*if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
      {
                // Whoops, we don't have a page for that!
                //show_404();
      }*/
		parent::__construct();
		$this->load->model('mainmodel');
		$this->load->helper('url_helper');
		$this->load->library('session'); 
		$this->load->helper('string');
		$this->load->library('encryption');
    }
	public function index()
	{
		$data['title'] = 'Announcement'; // Capitalize the first letter
		$data['msg'] = '';
		if(isset($_SESSION['login'])){
			//echo '1';
			$this->load->view('templates/header',array('title'=>'Announcement System'));
      		$this->load->view('pages/dashboard');
			$this->load->view('templates/footer');
			$data['msg']='';
			return;
		}
		$data['list'] = $this->mainmodel->getMyAnnouncement($this->input->post('user_id'));
		$data['msg']="";
		if(count($data['list']) >0){
			echo json_encode($data);
			return;
		}
		$data['msg']='Failed to fetch list of announcement.';
		$this->load->view('templates/header',$data);
      	$this->load->view('pages/public_announcement', $data);
		$this->load->view('templates/footer');
	}
	//login process
	public function login(){
		$data['login'] = $this->mainmodel->auth($this->input->post('username'),$this->input->post('password'));
		//print_r($data['login']);
		$data2['msg']="";
		if(count((array)$data['login']) >0){
			$_SESSION['login']=$data['login'];
			$_SESSION['first_name']=$data['login']->first_name;
			$_SESSION['user_id'] = $data['login']->id;
			//redirect('', 'refresh');
			echo json_encode($data2);
			return;
		}
		$data2['msg']='Invalid username or password.';
		//redirect('', 'refresh');
		echo json_encode($data2);
	}
	public function logout(){
		unset($_SESSION['login']);
		redirect('', 'refresh');
	}
	public function myAnnouncementList(){
		$data['list'] = $this->mainmodel->getMyAnnouncement($this->input->post('user_id'));
		$data['msg']="";
		if(count($data['list']) >0){
			echo json_encode($data);
			return;
		}
		$data['msg']='Your Announcement is Empty';
		echo json_encode($data);
	}
	public function saveMyAnnouncement(){
		$data = array(
			'user_id' => $this->input->post('user_id'),
			'title' =>  $this->input->post('title'),
			'content' => $this->input->post('content'),
			'start_date' => date('Y-m-d',strtotime($this->input->post('startdate'))),
			'end_date' => date('Y-m-d',strtotime($this->input->post('enddate'))),
		 );
		$isSave = $this->mainmodel->saveMyAnnouncement($data);
		$ret['msg']="";
		if($isSave){
			echo json_encode($ret);
			return;
		}
		$ret['msg']='Failed to save new announcement.';
		echo json_encode($ret);
	}
	public function deleteMyAnnouncement(){
		$isDelete = $this->mainmodel->deleteMyAnnouncement($this->input->post('id'));
		$ret['msg']="";
		if($isDelete){
			echo json_encode($ret);
			return;
		}
		$data['msg']='Failed to save new announcement.';
		echo $ret;
	}
	public function editMyAnnouncement(){
		$data['list'] = $this->mainmodel->getMyAnnouncementById($this->input->post('id'));
		$data['msg']="";
		if(count((array)$data['list']) >0){
			echo json_encode($data);
			return;
		}
		$data['msg']='Failed to get announcement details.';
		echo json_encode($data);
	}
	public function updateMyAnnouncement(){
		$data = array(
			'title' =>  $this->input->post('title'),
			'content' => $this->input->post('content'),
			'start_date' => date('Y-m-d',strtotime($this->input->post('startdate'))),
			'end_date' => date('Y-m-d',strtotime($this->input->post('enddate'))),
		 );
		$isSave = $this->mainmodel->updateAnnouncementById($data,$this->input->post('id'));
		$ret['msg']="";
		if($isSave){
			echo json_encode($ret);
			return;
		}
		$ret['msg']='Failed to save new announcement.';
		echo json_encode($ret);
	}
	public function getAllAnnouncement(){
		$data['list'] = $this->mainmodel->getAllAnnouncement();
		$this->mainmodel->updateAnnoucementIfActive();
		$data['msg']="";
		if(count((array)$data['list']) >0){
			echo json_encode($data);
			return;
		}
		$data['msg']='Failed to fetch list of announcement.';
	}
	public function register(){
		$data = array(
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
		 );
		$data2['msg']="";
		if($this->mainmodel->checkUserExist($this->input->post('username'))>0){
			$data2['msg']="Username already exist.";
			echo json_encode($data2);
			return;
		} 
		$isSave = $this->mainmodel->saveNewUser($data);
		if($isSave){
			$this->relogin($data['username'],$data['password']);
			//echo json_encode($data2); 
			return;
		}
		$data2['msg']='Failed to save new announcement.';
		echo json_encode($data2);
	}
	public function relogin($user,$pass){
		$data['login'] = $this->mainmodel->auth($this->input->post('username'),$this->input->post('password'));
		$data2['msg']="";
		if(count((array)$data['login']) >0){
			$_SESSION['login']=$data['login'];
			$_SESSION['first_name']=$data['login']->first_name;
			$_SESSION['user_id'] = $data['login']->id;
			echo json_encode($data2);
			return;
		}
		$data2['msg']='Invalid username or password.';
		echo json_encode($data2);
	}
	
	
}