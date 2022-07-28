<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videos extends MY_Controller{
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
        $this->load->model('videosmodel');
        $this->load->library('auth');
    }
    public function index(){
        $this->data['title']    = 'Quản lý Video';
        $total = $this->videosmodel->readCount(array('title'=>'%'.$this->input->get('title').'%'));
        $this->data['title'] = $this->input->get('title');
        if($this->data['title'] != ""){
            $config['suffix'] = '?title='.urlencode($this->data['title']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/videos/';
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
        if($this->data['title'] != ""){
            $this->data['list'] = $this->videosmodel->read(array('title'=>'%'.$this->data['title'].'%'),array(),false,$config['per_page'],$start);
        }else{
            $this->data['list'] = $this->videosmodel->read(array(),array('id'=>false),false,$config['per_page'],$start);
        }
        $this->data['base'] = site_url('admin/videos/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/videos/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
        if($this->input->post('submit') != null){
			$url = $this->input->post('url');
			parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
			$id_youtube = $my_array_of_vars['v'];
			
			//thumb youtube
			$thumb = 'https://img.youtube.com/vi/'.$id_youtube.'/0.jpg';
            $data = array(
                "title" 			=> $this->input->post("title"),
                "alias" 			=> make_alias($this->input->post("title")),
                "url" 				=> $url,
                "id_youtube" 		=> $id_youtube,
				"thumb"				=> $thumb,
            );
            $this->videosmodel->create($data);
            redirect(base_url() . "admin/videos");
            exit();
        }
        else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/videos/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id) {
        $this->data['video'] = $this->videosmodel->read(array('id'=>$id),array(),true);
        if($this->input->post('submit') != null){

            $url = $this->input->post('url');
			parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
			$id_youtube = $my_array_of_vars['v'];
			
			//thumb youtube
			$thumb = 'https://img.youtube.com/vi/'.$id_youtube.'/0.jpg';
            $data = array(
                "title" 			=> $this->input->post("title"),
                "alias" 			=> make_alias($this->input->post("title")),
                "url" 				=> $url,
                "id_youtube" 		=> $id_youtube,
				"thumb"				=> $thumb,
            );
            $this->videosmodel->update($data,array('id'=>$id));
            redirect(base_url() . "admin/videos");
            exit();
        }
        else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/videos/edit');
            $this->load->view('admin/common/footer');
        }
    }

    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->videosmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/videos");
            exit();
        }
    }

}