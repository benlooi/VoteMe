<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	 public function __construct () {
	 parent::__construct();
	 }
	public function index()
	{
		$this->load->view('welcome_message');
	}

		public function login () {
		 header("Access-Control-Allow-Methods: GET, POST, OPTIONS");   
		

		$data=json_decode(file_get_contents('php://input'));
		//var_dump($data);
		$username=$data->user->username;
		$password=$data->user->password;
		
		$userinfo = array (
		"username" => $username,
		"password"=>$password
		);
				
				$this->db->select('username,level,user_id');
				$query=$this->db->get_where("users",$userinfo);
				$query=$query->result_array();
				if (count($query)>0) {
				$query[0]['result']="User found!";
					echo json_encode($query[0]);
		
				} else if (count($query)==0) {
					echo "User not found!";
				}
			}
	public function getUsers () {
		
		$this->db->select('username,level,user_id');
		$query=$this->db->get("users");
		$query=$query->result_array();
		if (count($query)>0) {
			echo json_encode($query);

		} else if (count($query)==0) {
			echo "No user found!";
		}
	}
	
	public function submitchoice () {
		$data=json_decode(file_get_contents('php://input'));
		var_dump($data);
		$user=$data->user->username;
		$choice=$data->choice;
		
		$poll = array (
		"user" => $user,
		"chair_choice"=>$choice->chair_choice->username,
		"chair_reason"=>$choice->chair_reason,
		"vchair_choice"=>$choice->vchair_choice->username,
		"vchair_reason"=>$choice->vchair_reason,
		"tl_choice1"=>$choice->tl_choice1,
		"tl_reason1"=>$choice->tl_reason1,
		"tl_choice2"=>$choice->tl_choice2,
		"tl_reason2"=>$choice->tl_reason2
		);
				
				$query=$this->db->insert("polls",$poll);
				$affectedrows=$this->db->affected_rows();
				if ($affectedrows>0) {
				echo "poll added";
				}else if ($affectedrows<1){
				echo "poll not added";
				}
				
			}
}

		
			