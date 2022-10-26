<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Postscategory extends MY_Controller{
    public $data;
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
		$this->checkCookies();
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
        $this->load->model('postscategorymodel');
        $this->load->model('configsmodel');
		$this->load->library('auth');
	}
    public function index(){
        $this->data['title']    = 'Quản lý danh mục blog';
        $total = count($this->postscategorymodel->read(array('post_type'=>'post')));
        $this->data['post_type'] = $this->input->get('post_type');

        $this->data['title'] = $this->input->get('title');
        if($this->data['title'] != ""){
            $config['suffix'] = '?title='.urlencode($this->data['title']).'&post_type='.urlencode($this->data['post_type']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/postscategory/';
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $config['per_page'] = 10;
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
        // if($this->data['title'] != ""){
            // $this->data['list'] = $this->postscategorymodel->read(array('title'=>'%'.$this->data['title'].'%','type'=>'%'.$this->data['type'].'%'),array('id'=>true),false,$config['per_page'],$start);
        // }else{
            // $this->data['list'] = $this->postscategorymodel->read(array('type'=>'other'),array('id'=>true),false,$config['per_page'],$start);
        // }
		
		// $this->data['result'] = $this->postscategorymodel->get_categories($this->data['title'],$config['per_page'],$start);
		$this->data['result'] = $this->postscategorymodel->getSortedCategories('post');
		
        $this->data['base'] = site_url('admin/postscategory/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/postscategory/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
		$this->data['type'] = $this->input->get('type');
        $this->data['post_type'] = $this->input->get('post_type');
		if ($this->data['type'] && $this->data['type'] != '') {
			$type = $this->data['type'];
		} else {
			$type = 'other';
		}
		
		if ($this->data['post_type'] && $this->data['post_type'] != '') {
			$post_type = $this->data['post_type'];
		} else {
			$post_type = 'post';
		}
		
		$this->data['title'] = 'Thêm mới chuyên mục bài viết';
		$this->data['categories'] = $this->postscategorymodel->get_categories($type,'','','');
		if($this->input->post('submit') != null){
            $data = array(
                "title" => $this->input->post("title"),
                "alias" => make_alias($this->input->post("title")),
                "parent_id" => $this->input->post("parent_id"),
                "post_type" => 'post',
                "meta_title" => $this->input->post("meta_title"),
                "meta_description" => $this->input->post("meta_description"),
                "meta_keywords" => $this->input->post("meta_keywords"),
			);
            $id = $this->postscategorymodel->create($data);
			
            redirect(base_url() . "admin/postscategory");
            exit();
        }
        else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/postscategory/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id) {
		$this->data['type'] = $this->input->get('type');

		$this->data['title'] = 'Sửa danh mục bài viết';
		$this->data['categories'] = $this->postscategorymodel->get_categories('post','','','');
		$this->data['postscategory'] = $this->postscategorymodel->read(array('id'=>$id),array(),true);
		
        if($this->input->post('submit') != null){
            $data = array(
                "title" => $this->input->post("title"),
                "alias" => make_alias($this->input->post("title")),
                "parent_id" => $this->input->post("parent_id"),
                "post_type" => 'post',
                "meta_title" => $this->input->post("meta_title"),
                "meta_description" => $this->input->post("meta_description"),
                "meta_keywords" => $this->input->post("meta_keywords"),
			);
            $this->postscategorymodel->update($data,array('id'=>$id));
            redirect(base_url() . "admin/postscategory");
            exit();
        }
        else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/postscategory/edit');
            $this->load->view('admin/common/footer');
        }
    }
	
    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->postscategorymodel->delete(array('id'=>$id));
			// $data_array = array(
				// array(
					// "term" => 'category',
					// "name" => 'slogan',
					// "term_id" => $id,
					// "value" => '&nbsp;',
				// ),
				// array(
					// "term" => 'category',
					// "name" => 'banner',
					// "term_id" => $id,
					// "value" => '/assets/uploads/images/banners/3.jpg',
				// ),
				// array(
					// "term" => 'category',
					// "name" => 'featured_new',
					// "term_id" => $id,
					// "value" => '["0"]',
				// ),
			// );
			// $this->postscategorymodel->delete(array('term_id'=>$id,'term'=>'category));
            redirect(base_url() . "admin/postscategory");
            exit();
        }
    }

}
