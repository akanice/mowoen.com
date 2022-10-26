<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends MY_Controller {
    function __construct() {
        parent::__construct();
		$this->load->model('commentsmodel');
    }
	
	public $data;
	
    public function display_comments() {
		// $data['query']=$this->commentsmodel->get_article();
		$data['comments']=$this->commentsmodel->getSortedCategories();
		$this->load->view('frontend/comments', $data);
    }
    public function insert_comments() {
		// Post data
		$name=$this->input->post('name');
		$phone=$this->input->post('phone');
		$post_id=$this->input->post('post_id');
		$type=$this->input->post('type');
		$comment=$this->input->post('comment');
		
		// Upload attachment from comment
		$this->load->library('upload_file');
		$upload_path = 'assets/attachment-image/';
		$attachment = array();
		$p_attach1 = $this->upload_file->upload($upload_path, 'attachment1');
		if(isset($p_attach1['file_name'])){
			$attachment1 = $upload_path.$p_attach1['file_name'];
			array_push($attachment, $attachment1);
		}
		$p_attach2 = $this->upload_file->upload($upload_path, 'attachment2');
		if(isset($p_attach2['file_name'])){
			$attachment2 = $upload_path.$p_attach2['file_name'];
			array_push($attachment, $attachment2);
		}
		// $attachment = array($attachment1,$attachment2);
		$attachment = json_encode($attachment);


		
		$insertinfo=$this->commentsmodel->insertcomments_article($name,$phone,$post_id,$type,$comment,$attachment);
		//$data['comments']=$this->commentsmodel->get_latestcomment();
		$data['comments']=$this->commentsmodel->getSortedCategories();
		echo $this->load->view('frontend/commentdisplay',$data);
    }
    public function displaycomments() {
		$data['comments'] = $this->commentsmodel->getSortedCategories();
		$this->load->model('adminsmodel');
		echo $this->load->view('frontend/commentdisplay',$data);

    }
}
