<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class override_404 extends MY_Controller{
    public $data;
    function __construct() {
        parent::__construct();
    }
    
	public function index() {
		$this->data['title'] = '404 - Không tìm thấy trang';
		$this->output->set_status_header('404'); 

		$this->load->model('productsmodel');
		$this->load->model('productscategorymodel');
		$this->load->model('productsattachmodel');		
		$this->data['newest'] 		= $this->productsmodel->read(array('type'=>'product'),array('id'=>false),false,8);
		$this->data['mostviewed'] = $this->productsmodel->read(array('featured'=>1,'type'=>'product'),array('id'=>false),false,8);

		$this->data['temp'] = 'frontend/404_page';
		$this->load->view('frontend/index', $this->data);
	}
}
