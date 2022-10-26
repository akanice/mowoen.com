<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller{
    public $data;
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
		$this->checkCookies();
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
        $this->load->model('pagesmodel');
        $this->load->model('newsmodel');
    }
    public function index(){
        $this->data['title']    = 'Quản lý trang tĩnh';
        $total = $this->newsmodel->readCount(array('title'=>'%'.$this->input->get('title')));
        $this->data['title'] = $this->input->get('title');
        if($this->data['title'] != ""){
            $config['suffix'] = '?title='.urlencode($this->data['title']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/pages/';
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $config['per_page'] = 10;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        $page_number = $this->uri->segment(3);
        if (empty($page_number)) $page_number = 1;
        $start = ($page_number - 1) * $config['per_page'];
        $this->data['page_links'] = $this->pagination->create_links();
        if($this->data['title'] != ""){
            $this->data['list'] = $this->newsmodel->read(array('type'=>'page','title'=>'%'.$this->data['title'].'%'),array('id'=>false),false,$config['per_page'],$start);
        }else{
            $this->data['list'] = $this->newsmodel->read(array('type'=>'page'),array('id'=>false),false,$config['per_page'],$start);
        }
        $this->data['base'] = site_url('admin/pages/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/pages/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
		$this->data['title']    = 'Thêm mới trang';
		if($this->input->post('submit') != null){
            $uploaddir = '/assets/uploads/images/articles';

            if (!file_exists($uploaddir) || !is_dir($uploaddir)) mkdir($uploaddir,0777,true);
            $this->load->library("upload");
            if (move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$uploaddir . '/' . basename($_FILES['image']['name']))) {
                $image = $uploaddir . '/' . $_FILES['image']['name'];
            }
            else{
                $image = '';
            }
			//Create thumb
			if ($image != '') {
				$dir_thumb = '/assets/uploads/images/thumb';
				if (!file_exists($dir_thumb) || !is_dir($dir_thumb)) mkdir($dir_thumb,0777,true);
				$this->load->library('image_lib');
				$config2 = array();
				$config2['image_library'] = 'gd2';
				$config2['source_image'] = $_SERVER['DOCUMENT_ROOT'].$image;
				$config2['new_image'] = $_SERVER['DOCUMENT_ROOT'].$dir_thumb;
				$config2['create_thumb'] = TRUE;
				$config2['maintain_ratio'] = TRUE;
				$config2['width'] = 300;
				$config2['height'] = 300;$this->image_lib->clear();
				$this->image_lib->initialize($config2);
				
				if(!$this->image_lib->resize()){
					print $this->image_lib->display_errors();
					$image_thumb = $image;
				}else{
					$image_thumb = $dir_thumb . '/' . basename($_FILES['image']['name'], '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)) . '_thumb.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				}
			} else {
				$image = '/assets/uploads/sample_thumb.png';
				$image_thumb = '/assets/uploads/sample_thumb.png';
			}
			$categories = json_encode($this->input->post("category"));
			if ((!$this->input->post("category")) or ($this->input->post("category")=='')) {$categories = '["0"]';}
            $data = array(
				"title" => $this->input->post("title"),
				"alias" => make_alias($this->input->post("title")),
				"categoryid" => $categories,
				"content" => $this->input->post("content"),
                "image" => $image,
				"thumb" => $image_thumb,
				"author_id" => $this->session->userdata('adminid'),
				"description" => '',
				"meta_title" => $this->input->post("meta_title"),
				"meta_description" => $this->input->post("meta_description"),
				"meta_keywords" => $this->input->post("meta_keywords"),
				"type" => 'page',
				"create_time" => date('Y-m-d H:i:s', time()),
			);

			$news_id = $this->newsmodel->create($data);
			$this->newsmodel->update(array('order'=>$news_id),array('id'=>$news_id));
			
			redirect(base_url() . "admin/pages/edit/".$news_id);
			exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/pages/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id) {
		$this->data['title']    = 'Sửa nội dung trang';
        $this->data['news'] = $this->newsmodel->read(array('id'=>$id),array(),true);
		$this->data['news']->categoryid = json_decode($this->data['news']->categoryid);
        if($this->input->post('submit') != null){
			$uploaddir = '/assets/uploads/images/articles';
			if (!file_exists($uploaddir) || !is_dir($uploaddir)) mkdir($uploaddir,0777,true);
			$this->load->library("upload");
			if(isset($_FILES['image']) && count($_FILES['image']) > 0 && $_FILES['image']['name'] != "") {
				if (move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$uploaddir . '/' . basename($_FILES['image']['name']))) {
					$image = $uploaddir . '/' . $_FILES['image']['name'];
					
				} else{
					$image = $this->data['news']->image;
					$image_thumb = $this->data['news']->thumb;
				}
			}	
			
			//Create thumb
			if ($image != '') {
				$dir_thumb = '/assets/uploads/images/thumb';
				if (!file_exists($dir_thumb) || !is_dir($dir_thumb)) mkdir($dir_thumb,0777,true);
				$this->load->library('image_lib');
				$config2 = array();
				$config2['image_library'] = 'gd2';
				$config2['source_image'] = $_SERVER['DOCUMENT_ROOT'].$image;
				$config2['new_image'] = $_SERVER['DOCUMENT_ROOT'].$dir_thumb;
				$config2['create_thumb'] = TRUE;
				$config2['maintain_ratio'] = TRUE;
				$config2['width'] = 300;
				$config2['height'] = 300;
				$this->image_lib->clear();
				$this->image_lib->initialize($config2);
			
				if(!$this->image_lib->resize()){
					print $this->image_lib->display_errors();
					$image_thumb = $image;
				}else{
					$image_thumb = $dir_thumb . '/' . basename($_FILES['image']['name'], '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)) . '_thumb.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				}
			} else {
				$image = $this->data['news']->image;
				$image_thumb = $this->data['news']->thumb;
			}
			
			$categories = json_encode($this->input->post("category"));
			if ((!$this->input->post("category")) or ($this->input->post("category")=='')) {$categories = '["0"]';}
            $data = array(
				"title" => $this->input->post("title"),
				"alias" => make_alias($this->input->post("title")),
				"categoryid" => $categories,
				"content" => $this->input->post("content"),
                "image" => $image,
				"thumb" => $image_thumb,
				"description" => '',
				"meta_title" => $this->input->post("meta_title"),
				"meta_description" => $this->input->post("meta_description"),
				"meta_keywords" => $this->input->post("meta_keywords"),
				"type" => 'page',
				"create_time" => date('Y-m-d H:i:s', time()),
			);
            $this->newsmodel->update($data,array('id'=>$id));
			
			//Re-data
			redirect(base_url() . "admin/pages/edit/".$id);
			exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/pages/edit');
            $this->load->view('admin/common/footer');
        }
    }

    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->newsmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/pages");
            exit();
        }
    }
}