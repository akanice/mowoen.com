<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends MY_Controller{
    public $data;
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
		$this->checkCookies();
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
        $this->load->model('postscategorymodel');
        $this->load->model('postsmodel');
        $this->load->model('postsmetamodel');
    }
    public function index(){
        $this->data['title']    = 'Blog';
		$this->data['postscategory'] = $this->postscategorymodel->read(array('post_type'=>'post'));
        $total = $this->postsmodel->readCount(array('title'=>'%'.$this->input->get('title')));
        $this->data['title'] = $this->input->get('title');
        if($this->data['title'] != ""){
            $config['suffix'] = '?title='.urlencode($this->data['title']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/posts/';
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
            $this->data['list'] = $this->postsmodel->read(array('post_type'=>'post','title'=>'%'.$this->data['title'].'%'),array('id'=>false),false,$config['per_page'],$start);
        }else{
            $this->data['list'] = $this->postsmodel->read(array('post_type'=>'post'),array('id'=>false),false,$config['per_page'],$start);
        }
        $this->data['base'] = site_url('admin/posts/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/posts/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
		$this->data['title']    = 'Thêm mới bài viết';
		$this->data['list_cat_id'] = $this->postscategorymodel->getSortedCategories('post');
		if($this->input->post('submit') != null){
            $this->load->library('upload_file');
			if ($this->input->post("image")) {$image  = 'assets/uploads/'.substr(parse_url($this->input->post("image"), PHP_URL_PATH),0);} else {$image ='';}
			$data = pathinfo($image);
			
			//Create cover thumb
			$dir_thumb = 'assets/uploads/thumb/images/news/';
			$thumb = $this->postsmodel->createThumb($image, $dir_thumb);

			$categories = json_encode($this->input->post("category"));
			if ((!$this->input->post("category")) or ($this->input->post("category")=='')) {$categories = '["0"]';}
            $data = array(
				"title" => $this->input->post("title"),
				"alias" => make_alias($this->input->post("title")),
				"categoryid" => $categories,
				"excerpt" => $this->input->post("excerpt"),
				"description" => $this->input->post("description"),
                "image" => $image,
				"thumb" => $thumb,
				"author_id" => $this->session->userdata('adminid'),
				"post_type" => 'post',
			);
			$post_id = $this->postsmodel->create($data);
			$this->postsmodel->update(array('alias'=>make_alias($this->input->post("title").'-'.$post_id)),array('id'=>$post_id));
			
			// Post Meta Data
			$meta_data = array(
				'meta_title' => @$this->input->post('meta_title'),
				'meta_description' => @$this->input->post('meta_description'),
				'meta_keywords' => @$this->input->post('meta_keywords'),
				'likes' => @$this->input->post('likes'),
			);
			$this->meta_data($post_id, $meta_data);
			
			redirect(base_url() . "admin/posts/edit/".$post_id);
			exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/posts/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id) {
		$this->data['title']    = 'Sửa nội dung bài viết';
        $this->data['posts'] = $this->loadPostData($id,'post');
		$this->data['posts']->image = str_replace('assets/uploads/', '', $this->data['posts']->image);

        if($this->input->post('submit') != null){
			$this->load->library('upload_file');
			if ($this->input->post("image")) {
				$image  = 'assets/uploads/'.substr(parse_url($this->input->post("image"), PHP_URL_PATH),0);
				$data = pathinfo($image);
				//Create cover thumb
				$dir_thumb = 'assets/uploads/thumb/images/news/';
				$thumb = $this->postsmodel->createThumb($image, $dir_thumb);
			} else {
				$image = $this->data['news']->image;
				$thumb = $this->data['news']->thumb;
			}
			
			$categories = json_encode($this->input->post("category"));
			if ((!$this->input->post("category")) or ($this->input->post("category")=='')) {$categories = '["0"]';}
            $data = array(
				"title" => $this->input->post("title"),
				"alias" => make_alias($this->input->post("title")),
				"categoryid" => $categories,
				"excerpt" => $this->input->post("excerpt"),
				"description" => $this->input->post("description"),
                "image" => $image,
				"thumb" => $thumb,
				"author_id" => $this->session->userdata('adminid'),
				"post_type" => 'post',
			);
            $this->postsmodel->update($data,array('id'=>$id));
			
			// Post Meta Data
			$meta_data = array(
				'meta_title' => @$this->input->post('meta_title'),
				'meta_description' => @$this->input->post('meta_description'),
				'meta_keywords' => @$this->input->post('meta_keywords'),
				'likes' => @$this->input->post('likes'),
			);
			$this->meta_data($id, $meta_data);
			
			redirect(base_url() . "admin/posts/edit/".$id);
			exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/posts/edit');
            $this->load->view('admin/common/footer');
        }
    }

    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->postsmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/posts");
            exit();
        }
    }

	private function meta_data($post_id, $array_data) {
		if ($array_data) {foreach ($array_data as $meta_key=>$meta_value) {
			$temp = $this->postsmetamodel->read(array('post_id'=>$post_id,'meta_key'=>@$meta_key),array(),true);
			if ($temp && $temp != '') {
				$this->postsmetamodel->update(array('meta_key'=>@$meta_key, 'meta_value'=>@$meta_value),array('id'=>$temp->id));
			} else {
				$this->postsmetamodel->create(array('meta_key'=>@$meta_key, 'meta_value'=>@$meta_value,'post_id'=>$post_id));
			}
		}}
	}
}