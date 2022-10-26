<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
    function __construct() {
       parent::__construct();
    }

    public function index() {
		
        $this->data['temp'] = 'frontend/home/index';
		$this->load->view('frontend/index', $this->data);

    }
    
}
