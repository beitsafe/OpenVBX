<?php

/* DIAL OUT VIA BROWSER PHONE BY POSTING 'calltonum', 'callfromnum' to /dialbrowser 
 * creating a callable controller to scoop data and input into view :)
 * by: 	Kyle Burkett
 * FILES CONFIGURED:
 * 		This file of course
 * 		views/dialnow.php
 * 		config/routes.php (107)
 * 		layout/template.php (58)
 * 		layout/content/content_sidebar
 */
require_once(APPPATH.'libraries/twilio.php');

class Dialbrowser extends User_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->template->write('title', 'Auto-Dialer');			
	}
	public function index()
	{
		return $this->dosomethingplease();
	}
	public function dosomethingplease()
	{
		//would be a temporary fix if no issues with call/dialog/etc
		echo "<script type='text/javascript'' src='//static.twilio.com/libs/twiliojs/1.2/twilio.min.js'></script>";
		echo "<script   src='https://code.jquery.com/jquery-2.2.3.min.js'   integrity='sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo='   crossorigin='anonymous'></script>";
		$data = array('calltonum' => $this->input->post('calltonum'), 'callfromnum' => $this->input->post('callfromnum'));
		//where the first param below appends to title
		$this->respond('','dialnow', $data);
		
		if ($data[calltonum] != null && $data[callfromnum] != null){
			try{
				$this->load->model('vbx_call');
				$json['error'] = false;
				$json['message'] = '';
				$rest_access = $this->make_rest_access();
				$this->vbx_call->make_call($data[callfromnum], $data[calltonum], $data[callfromnum], $rest_access);			
			}
			catch(Exception $e)
			{
				$json['message'] = $e->getMessage();
				$json['error'] = true;
			}
			$data['json'] = $json;
		
			$this->respond('Dialer', 'call', $data, '', 'layout/dialer');
		}
	}	 
}

 
//dont completely understand why/if this extension is nessisary yet
//class DialbrowserException extends Exception {}

//ITEMS TRIED IN CONSTRUCTOR
	//$this->template->add_js('assets/j/frameworks/jquery-1.6.2.min.js');
	//$this->template->add_js('assets/j/frameworks/jquery-1.6.2.min.js');
	/*$data = $this->init_view_data();
	$this->section = 'messages';
	$this->template->add_js('assets/j/client.js');
	
	$this->load->view('js-init');
	$this->template->add_js('assets/j/accounts.js');
	$this->template->add_js('assets/j/devices.js');
	

	$this->template->add_js('assets/j/plugins/call-and-sms-dialogs.js');
	
	//to make sure messages option pops on left NOTWORKING!
	$this->load->model('vbx_user');
	$groups = VBX_User::get_group_ids($this->user_id);
	$counts = $this->vbx_message->get_folders($this->user_id, $groups);
	*/

?>		