<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function login () {
		$data=json_decode(file_get_contents('php://input'));
		$username=$data->user->username;
		$password=$data->user->password;

		$user=array (
			'username'=>$username,
			'password'=>$password,
			);
		$this->db->select('fname,lname,user_id');
		$query=$this->db->get_where("users",$user);
		$query=$query->result_array();
		if (count($query)>0) {
			json_encode($query);

			$loginfo= array (
				"user_id"=>$query[0]['user_id'];
				);
			$this->db->insert('userlog',$loginfo);

		} else if (count($query)==0) {
			echo "user not found";
		}
	}

		
			
