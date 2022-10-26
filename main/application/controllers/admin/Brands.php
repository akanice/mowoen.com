<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brands extends MY_Controller{
    public $data;
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
		$this->checkCookies();
        // if($this->session->userdata('admingroup') == "mod"){
            // show_404();
        // }
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
        $this->load->model('productsmodel');
        $this->load->model('productscategorymodel');
        $this->load->model('brandsmodel');
    }
    public function index(){
        $this->data['title']    = 'Quản lý nhãn hiệu';
        $total = $this->brandsmodel->readCount($this->input->get('name'),"","","");
        $this->data['name'] = $this->input->get('name');
        $this->data['category'] = $this->input->get('category');
        if($this->data['name'] != ""){
            $config['suffix'] = '?name='.urlencode($this->data['name']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/brands/';
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $config['per_page'] = 15;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config["num_tag_open"] = "<p class='paginationLink'>";
        $config["num_tag_close"] = '</p>';
        $config["cur_tag_open"] = "<p class='currentLink'>";
        $config["cur_tag_close"] = '</p>';
        $config["first_link"] = "First";
        $config["first_tag_open"] = "<p class='paginationLink'>";
        $config["first_tag_close"] = '</p>';
        $config["last_link"] = "Last";
        $config["last_tag_open"] = "<p class='paginationLink'>";
        $config["last_tag_close"] = '</p>';
        $config["next_link"] = "Next";
        $config["next_tag_open"] = "<p class='paginationLink'>";
        $config["next_tag_close"] = '</p>';
        $config["prev_link"] = "Back";
        $config["prev_tag_open"] = "<p class='paginationLink'>";
        $config["prev_tag_close"] = '</p>';
        $this->pagination->initialize($config);
        $page_number = $this->uri->segment(3);
        if (empty($page_number)) $page_number = 1;
        $start = ($page_number - 1) * $config['per_page'];
        $this->data['page_links'] = $this->pagination->create_links();
        if($this->data['name'] != "" || $this->data['category'] != ""){
            $this->data['list'] = $this->brandsmodel->read(array('name'=>$this->input->get('name')),array(),false,$config['per_page'],$start);
        }else{
            $this->data['list'] = $this->brandsmodel->read(array(),array(),false,$config['per_page'],$start);
        }
        $this->data['base'] = site_url('admin/brands/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/brands/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
        $this->data['brands'] = $this->brandsmodel->read();
        if($this->input->post('submit') != null){
            $uploaddir = 'assets/uploads/brands/';
            $this->load->library("upload");
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
                $image = $uploaddir . $_FILES['image']['name'];
            }
            else{
                $image = '';
            }
            //Create thumb
			// if ($image != '') {
				// $dir_thumb = 'assets/uploads/thumb/brands';
				// if (!file_exists($dir_thumb) || !is_dir($dir_thumb)) mkdir($dir_thumb,0777,true);
				// $this->load->library('image_lib');
				// $config2 = array();
				// $config2['image_library'] = 'gd2';
				// $config2['source_image'] = $image;
				// $config2['new_image'] = $dir_thumb;
				// $config2['create_thumb'] = TRUE;
				// $config2['maintain_ratio'] = TRUE;
				// $config2['width'] = 300;
				// $config2['height'] = 300;
				// $this->image_lib->clear();
				// $this->image_lib->initialize($config2);
				// if(!$this->image_lib->resize()){
					// print $this->image_lib->display_errors();
				// }else{
					// $image_thumb = $dir_thumb.basename($_FILES['image']['name'], '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)) . '_thumb.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				// // }
			// } else {
				// $image = 'assets/img/sample_thumb.png';
			// }
			
            $data = array(
                "name" => $this->input->post("name"),
                "alias" => make_alias($this->input->post("name")),
				"image" => $image,
            );
            $this->brandsmodel->create($data);
            redirect(base_url() . "admin/brands");
            exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/brands/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id){
        $this->data['brand'] = $this->brandsmodel->read(array('id'=>$id),array(),true);

        if($this->input->post('submit') != null){
            $uploaddir = 'assets/uploads/brands/';
            $this->load->library("upload");
            if(isset($_FILES['image']) && count($_FILES['image']) > 0 && $_FILES['image']['name'] != "") {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
                    $image = $uploaddir . $_FILES['image']['name'];
                    //@unlink($this->data['product']->image);
                    //@unlink($this->data['product']->thumb);
                } else {
                    $image = $this->data['brand']->image;
                }
                //Create thumb
                // $dir_thumb = 'assets/uploads/thumb/';
                // if (!file_exists($dir_thumb) || !is_dir($dir_thumb)) mkdir($dir_thumb,0777,true);
                // $this->load->library('image_lib');
                // $config2 = array();
                // $config2['image_library'] = 'gd2';
                // $config2['source_image'] = $image;
                // $config2['new_image'] = $dir_thumb;
                // $config2['create_thumb'] = TRUE;
                // $config2['maintain_ratio'] = TRUE;
                // $config2['width'] = 300;
                // $config2['height'] = 300;
                // $this->image_lib->clear();
                // $this->image_lib->initialize($config2);
                // if(!$this->image_lib->resize()){
                    // print $this->image_lib->display_errors();
                // }else{
                    // $image_thumb = $dir_thumb.basename($_FILES['image']['name'], '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)) . '_thumb.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                // }
            // }else{
                // $image = $this->data['product']->image;
                // $image_thumb = $this->data['product']->thumb;
            }
            $data = array(
                "name" => $this->input->post("name"),
                "alias" => make_alias($this->input->post("name")).'-'.$id,
            );
            $this->brandsmodel->update($data,array('id'=>$id));
            redirect(base_url() . "admin/brands");
            exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/brands/edit');
            $this->load->view('admin/common/footer');
        }
    }

    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $product = $this->brandsmodel->read(array('id'=>$id),array(),true);
            //@unlink($product->image);
            //@unlink($product->thumb);
            $this->brandsmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/brands");
            exit();
        }
    }

}