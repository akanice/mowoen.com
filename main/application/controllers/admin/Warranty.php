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
		$this->data['title']    = 'Thông tin bảo hành sản phẩm';
		
		$this->data['name'] = $this->input->get('name');
		$this->data['phone'] = $this->input->get('phone');
		$this->data['uid'] = $this->input->get('uid');
        @$total = count($this->warrantymodel->getListResult($this->data['name'],$this->data['phone'],$this->data['uid'],'',''));

        //Pagination
		$config['suffix'] = '';
		$per_page = 25;
        
        if(($this->data['name'] != "") or ($this->data['phone'] != "") or ($this->data['uid'] != "")){
			$config['suffix'] = $config['suffix'].'?name='.urlencode(@$name).'&phone='.urlencode(@$phone).'&uid='.urlencode(@$uid);;
			list($this->data['page_links'],$start) = $this->warrantymodel->pagination('admin/warranty/',$config['suffix'],$total,$per_page,3);
            $this->data['list'] = $this->warrantymodel->getListResult($this->data['name'],$this->data['phone'],$this->data['uid'],'','');
        }else{
			list($this->data['page_links'],$start) = $this->warrantymodel->pagination('admin/warranty/',$config['suffix'],$total,$per_page,3);
            $this->data['list'] = $this->warrantymodel->getListResult('','','',$per_page,$start);
        }
        $this->data['base'] = site_url('admin/warranty/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/warranty/list');
        $this->load->view('admin/common/footer');
    }

}
