<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MY_Controller {
    function __construct() {
        parent::__construct();
		$this->load->model('productsmodel');
		$this->load->model('warrantymodel');
		$this->load->model('productscategorymodel');
		$this->load->model('productsattachmodel');
    }

    public function index() {		
        // $this->data['temp'] = 'frontend/template/'.$type;
		$this->load->view('frontend/index', $this->data);
    }

	public function getQR($alias) {
		$uid = $this->input->get('uid');
		$this->data['product_data'] = $this->productsmodel->read(array('alias'=>$alias),array(),true);
		$this->data['warranty_data'] = $this->warrantymodel->read(array('unique_id'=>$uid),array(),true);
		$this->config->set_item('base_url',MEIDA_URL);
		if ($this->data['warranty_data'] && $this->data['warranty_data'] != '') {
			$this->data['title'] = $this->data['product_data']->title;
			$this->session->set_flashdata('status', 'ok');
			$this->session->set_flashdata('message', 'Qúy khách đã kích hoạt thông tin bảo hành thành công. Cảm ơn quý khách đã tin dùng sản phẩm của Mowoen!');
			$this->load->view('frontend/head', $this->data);
			$this->load->view('frontend/template/form_success');
		} else {
			$this->data['product_data'] = $this->productsmodel->read(array('alias'=>$alias),array(),true);

			// Load file_attach
			$this->data['file_attach'] = @$this->productsattachmodel->read(array('product_id'=>$this->data['product_data']->id,'attachdata'=>'file_attach'),array(),true)->value;
			$this->data['file_attach'] = json_decode($this->data['file_attach']);
			$this->data['actual_image']	= json_decode(@$this->productsattachmodel->read(array('product_id'=>$this->data['product_data']->id,'attachdata'=>'actual_image'),array(),true)->value);
			@$this->data['circleview'] = array_reverse(json_decode(@$this->productsattachmodel->read(array('product_id'=>$this->data['product_data']->id,'attachdata'=>'circleview'),array(),true)->value));
			$this->data['video_attach']	= @$this->productsattachmodel->read(array('product_id'=>$this->data['product_data']->id,'attachdata'=>'video_attach'),array(),true)->value;
			$this->data['video_attach_thumb']	= 'assets/uploads/'.@$this->productsattachmodel->read(array('product_id'=>$this->data['product_data']->id,'attachdata'=>'video_attach_thumb'),array(),true)->value;
			
			$this->data['title'] = $this->data['product_data']->title;
			$this->data['meta_title'] = $this->data['product_data']->meta_title;
			$this->data['meta_description']	= $this->data['product_data']->meta_description;
			$this->data['meta_keywords'] = $this->data['product_data']->meta_keywords;
			$this->data['meta_images'] = $this->data['product_data']->image;
			$arr_link = array(
				$this->data['product_data']->title	=> '#',
			);
			$this->data['breadcrumb'] = $this->setBreadcrumbs($arr_link);

			$this->data['temp'] = 'frontend/products/view';
			$this->load->view('frontend/index', $this->data);
		}
	}

	public function form_success() {
		if ($this->session->flashdata('product_id')) {
			@$pid = $this->session->flashdata('product_id');
		}
		if ($this->session->flashdata('w_id')) {
			@$wid = $this->session->flashdata('w_id');
		}
		$this->data['product_data'] = $this->productsmodel->read(array('id'=>@$pid),array(),true);
		$this->data['warranty_data'] = $this->warrantymodel->read(array('id'=>@$wid),array(),true);
		$this->data['title'] = 'Gửi thông tin thành công';
		
		$this->load->view('frontend/head', $this->data);
		$this->load->view('frontend/template/form_success');
	}
}