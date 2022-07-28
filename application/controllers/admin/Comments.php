<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends MY_Controller{
    public $data;
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
		$this->checkCookies();
		
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
		
        $this->load->model('commentsmodel');
        $this->load->model('productsmodel');
        $this->load->model('productscategorymodel');
        $this->load->model('newsmodel');
        $this->load->model('adminsmodel');
	}
	
    public function index(){
		$user_group = $this->adminsmodel->read(array('id'=>$this->session->userdata('adminid')),array(),true)->group;
        if ($user_group == 'admin') {
			$this->data['title']    = 'bepthanhvinh.vn - Quản lý bình luận';

			$total = count($this->commentsmodel->read(array(),array(),false));
			$this->data['type'] = $type = $this->input->get('type');
			$this->data['approved'] = $approved = $this->input->get('approved');
			$config['suffix'] = '';
			if($this->input->get('type') != "" || $this->input->get('approved') != ""){
				$config['suffix'] = '?phone='.urlencode($this->data['type']).'&name='.urlencode($this->data['approved']);
			}
			$per_page = 20;
			list($this->data['page_links'],$start) = $this->productsmodel->pagination('admin/comments/',$config['suffix'],$total,$per_page,3);
			
			$temp = $this->commentsmodel->read(array('reply_id'=>0,
																		'type'=>'%'.$this->input->get('type').'%',
																		'approved'=>'%'.$this->input->get('approved').'%',
																	   ),array('id'=>false),false,$per_page,$start);
			if (@$temp) foreach ($temp as $key=>$value) {
				$this->data['list'][$key] = $value;
				if ($value->type == 'product') {
					$d = $this->productsmodel->read(array('id'=>$value->post_id),array(),true);
					// $cat_data = json_decode($d->categoryid);
					// $this->data['cat_alias'] = $this->productscategorymodel->read(array('id'=>$cat_data[0]),array(),true)->alias;
				} elseif ($value->type == 'new') {
					$d = $this->newsmodel->read(array('id'=>$value->post_id),array(),true);
				} else {
				}
				$this->data['list'][$key]->title = $d->title;
				$this->data['list'][$key]->alias = $d->alias;
			}
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/comments/list');
			$this->load->view('admin/common/footer');
		} else {
			redirect(base_url()."admin/access_denied");
		}
    }

    public function edit($id) {
        $user = $this->adminsmodel->read(array('id'=>$this->session->userdata('adminid')),array(),true);
        $user_group = $user->group;
        $user_avatar = $user->avatar;
        if ($user_group == 'admin') {
			$this->data['title']    = 'bepthanhvinh.vn - Quản lý bình luận';
			$this->data['comments'] = $comments = $this->commentsmodel->read(array('id'=>$id),array(),true);
			$this->data['reply'] = $this->commentsmodel->read(array('reply_id'=>$comments->id),array(),false);
			if($this->input->post('submit') != null){
				if ($this->input->post("reply") != '') {
					$data = array(
						"name"					=> '',
						"email"					=> '',
						"comment" 			=> $this->input->post("reply"),
						"post_id"				=> $comments->post_id,
						"approved"			=> 1,
						"reply_id"				=> $comments->id,
						"reply_admin_id"	=> $this->session->userdata('adminid'),
						"type"					=> $comments->type,
						"create_time"		=> date('Y-m-d H:i:s', time()),
					);
					$this->commentsmodel->create($data);
				}
				
				$data2 = array(
					"approved"				=> $this->input->post("approved"),
				);
				$this->commentsmodel->update($data2,array('id'=>$comments->id));
				
				$this->data['notice'] = 'Cập nhật thành công!';
				$this->data['comments'] = $comments = $this->commentsmodel->read(array('id'=>$id),array(),true);
				$this->data['reply'] = $this->commentsmodel->read(array('reply_id'=>$comments->id),array(),false);
				$this->load->view('admin/common/header',$this->data);
				$this->load->view('admin/comments/edit');
				$this->load->view('admin/common/footer');
			} else {
				$this->load->view('admin/common/header',$this->data);
				$this->load->view('admin/comments/edit');
				$this->load->view('admin/common/footer');
			}
		} else {
			redirect(base_url()."admin/access_denied");
		}
    }

    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->commentsmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/comments");
            exit();
        }
    }
}
