<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Warranty extends MY_Controller{
    public $data;
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
		$this->checkCookies();
		
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
		
        $this->load->model('warrantymodel');
        $this->load->model('adminsmodel');
		$user_group = $this->adminsmodel->read(array('id'=>$this->session->userdata('adminid')),array(),true)->group;
        if ($user_group !== 'admin') {
			redirect(base_url()."admin/access_denied");
		}
	}
	
    public function index(){
        redirect(base_url()."admin/access_denied");
    }

}
