<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class News extends MY_Controller{
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
        $this->load->model('newsmodel');
        $this->load->model('newscategorymodel');
		//$this->load->library('auth');
	}
    public function index(){
        $this->data['title']    = 'Quản lý tin tức';
		$this->data['newscategory'] = $this->newscategorymodel->read();
		// $result = $this->newsmodel->getListNews($this->input->get('title'),"",$this->input->get('category'),"","");
		// print_r($result);
		// die();
		
		$total = count($this->newsmodel->getListNews($this->input->get('title'),"",$this->input->get('category'),"",""));
        $this->data['title'] = $this->input->get('title');
        $this->data['category'] = $this->input->get('category');
        if($this->data['title'] != "" || $this->data['category'] != ""){
            $config['suffix'] = '?title='.urlencode($this->data['title']).'&category='.urlencode($this->data['category']);
        }
        //Pagination
	
		$per_page = 15;
		list($this->data['page_links'],$start) = $this->newsmodel->pagination('admin/news/',$config['suffix'],$total,$per_page,3);
		
        if($this->data['title'] != "" || $this->data['category'] != ""){
            $this->data['list'] = $this->newsmodel->getListNews($this->input->get('title'),"",$this->input->get('category'),$per_page,$start,'post');
        }else{
            $this->data['list'] = $this->newsmodel->getListNews("","","",$per_page,$start,'post');
        }
		
        $this->data['base'] = site_url('admin/news/');
        $this->data['newscategory'] = $this->newscategorymodel->read(array(),array(),false);
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/news/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
		$this->data['title']    = 'Thêm mới bài viết';
		$this->data['list_cat_id'] = $this->newscategorymodel->getSortedCategories();
		if($this->input->post('submit') != null){
            $image  = 'assets/uploads/'.substr(parse_url($this->input->post("image"), PHP_URL_PATH),0);
			$data = pathinfo($image);

			//Create cover thumb
			$this->load->library('upload_file');
			$thumb = '';
            if ($image != '') {
				$dir_thumb = 'assets/uploads/images/thumb/';
				if (!file_exists($dir_thumb) || !is_dir($dir_thumb)) mkdir($dir_thumb,0777,true);
				$this->load->library('image_lib');
				$config2 = array();
				$config2['image_library'] = 'gd2';
				$config2['source_image'] = $image;
				$config2['new_image'] = $dir_thumb;
				$config2['create_thumb'] = TRUE;
				$config2['maintain_ratio'] = TRUE;
				$config2['quality'] = '80%';
				$config2['width'] = 400;
				$config2['height'] = 400;
				$this->image_lib->clear();
				$this->image_lib->initialize($config2);
				if(!$this->image_lib->resize()){
					print $this->image_lib->display_errors();
				}else{
					$thumb = $dir_thumb.$data['filename'].'_thumb.'.$data['extension'];
				}
			}
			
			$categories = json_encode($this->input->post("category"));
			if (!$categories) {$categories = '["0"]';}
            $data = array(
				"title" => $this->input->post("title"),
				"alias" => make_alias($this->input->post("title")),
				"categoryid" => $categories,
				"content" => $this->input->post("content"),
                "image" => @$image,
				"thumb" => @$thumb,
				"author_id" => $this->session->userdata('adminid'),
				"description" => $this->input->post("description"),
				"meta_title" => $this->input->post("meta_title"),
				"meta_description" => $this->input->post("meta_description"),
				"meta_keywords" => $this->input->post("meta_keywords"),
				"type" => $this->input->post("type"),
				"create_time" => date('Y-m-d H:i:s', time()),
			);

			$news_id = $this->newsmodel->create($data);
			$this->newsmodel->update(array('order'=>$news_id),array('id'=>$news_id));
			
			redirect(base_url() . "admin/news/edit/".$news_id);
			exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/news/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id) {
		$this->data['title']    = 'Sửa bài viết';
		$this->data['list_cat_id'] = $this->newscategorymodel->getSortedCategories();
        $this->data['news'] = $this->newsmodel->read(array('id'=>$id),array(),true);
		$this->data['news']->categoryid = json_decode($this->data['news']->categoryid);
		$this->data['news']->image = str_replace('assets/uploads/', '', $this->data['news']->image);
        if($this->input->post('submit') != null){
			$image  = 'assets/uploads/'.substr(parse_url($this->input->post("image"), PHP_URL_PATH),0);
			$data = pathinfo($image);
			
			//Create cover thumb
			$this->load->library('upload_file');
			$thumb = '';
            if ($image != '') {
				$dir_thumb = 'assets/uploads/images/thumb/';
				if (!file_exists($dir_thumb) || !is_dir($dir_thumb)) mkdir($dir_thumb,0777,true);
				$this->load->library('image_lib');
				$config2 = array();
				$config2['image_library'] = 'gd2';
				$config2['source_image'] = $image;
				$config2['new_image'] = $dir_thumb;
				$config2['create_thumb'] = TRUE;
				$config2['maintain_ratio'] = TRUE;
				$config2['quality'] = '80%';
				$config2['width'] = 400;
				$config2['height'] = 400;
				$this->image_lib->clear();
				$this->image_lib->initialize($config2);
				if(!$this->image_lib->resize()){
					print $this->image_lib->display_errors();
				}else{
					$thumb = $dir_thumb.$data['filename'].'_thumb.'.$data['extension'];
				}
			}
			
			$categories = json_encode($this->input->post("category"));
			if (!$categories) {$categories = '["0"]';}
            $data = array(
				"title" => $this->input->post("title"),
				"alias" => make_alias($this->input->post("title")),
				"categoryid" => $categories,
				"content" => $this->input->post("content"),
                "image" => @$image,
				"thumb" => @$thumb,
				"description" => $this->input->post("description"),
				"meta_title" => $this->input->post("meta_title"),
				"meta_description" => $this->input->post("meta_description"),
				"meta_keywords" => $this->input->post("meta_keywords"),
				"type" => $this->input->post("type"),
				"create_time" => date('Y-m-d H:i:s', time()),
			);
            $this->newsmodel->update($data,array('id'=>$id));
			
			//Re-data
			redirect(base_url() . "admin/news/edit/".$id);
			exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/news/edit');
            $this->load->view('admin/common/footer');
        }
    }

    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->newsmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/news");
            exit();
        }
    }

}