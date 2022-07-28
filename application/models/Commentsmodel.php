<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CommentsModel extends MY_Model {
    protected $tableName = 'comments';

    protected $table = array(
        'id'               => array(
            'isIndex'  => true,
            'nullable' => true,
            'type'     => 'integer'
        ),
        'name'            => array(
            'isIndex'  => true,
            'nullable' => true,
            'type'     => 'integer'
        ),
        'email'       => array(
            'isIndex'  => false,
            'nullable' => true,
            'type'     => 'string'
        ),
        'reply_admin_id'       => array(
            'isIndex'  => false,
            'nullable' => true,
            'type'     => 'integer'
        ),		
        'comment'            => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'string'
        ),
        'post_id'            => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'integer'
        ),
		'reply_id'            => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'integer'
        ),
        'type'      => array(
            'isIndex'  => false,
            'nullable' => true,
            'type'     => 'string'
        ),
		'phone'      => array(
            'isIndex'  => false,
            'nullable' => true,
            'type'     => 'string'
        ),
        'approved'          => array(
            'isIndex'  => false,
            'nullable' => true,
            'type'     => 'integer'
        ),
        'create_time'            => array(
            'isIndex'  => false,
            'nullable' => true,
            'type'     => 'string'
        ),
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }
	
	public function getListComments($type,$approved,$limit,$offset) {
		$this->db->select('comments.*');
		
		if ($approved !='') {
			$this->db->where('comments.approved', $approved);
		}
		
		if ($type !='') {
			$this->db->where('comments.type', $type);
		}

		$this->db->order_by("id","DESC");
        if ($limit != "") {
            $query = $this->db->get('comments', $limit, $offset);
        }
        return $query ? $query->result() : false;
	}
	
	//insert comments
	public function insertcomments_article($name,$phone,$post_id,$type,$comment,$attachment) {
		// $name=$this->input->post('name');
		// $phone=$this->input->post('phone');
		// $post_id=$this->input->post('post_id');
		// $type=$this->input->post('type');
		// $comment=$this->input->post('comment');
		$date= date('Y-m-d H:i:s', time());
		$insertcomment=$this->db->insert('comments',array(
			'name'=>$name,
			'phone'=>$phone,
			'comment'=>$comment,
			'attachment'=>$attachment,
			'approved'=>'0',
			'type'=>$type,
			'create_time'=>$date,
			'post_id'=>$post_id,
		));
		return $insertcomment;       
	}
	//retrive comments
	public function get_comments() {
		$post_id=$this->input->post('post_id');
		$this->db->select('*');
		$this->db->from('comments');
		$array = array('post_id' => $post_id, 'approved' => 1,'reply_id' => 0);
		$this->db->where($array);
		$comments =  $this->db->get();
		return $comments->result();
	}
	
	public function get_latestcomment() {
		$post_id=$this->input->post('post_id');
		$this->db->select('*');
		$this->db->from('comments');
		$this->db->where('post_id',$post_id);
		$this->db->order_by('comment_id', 'DESC');
		$this->db->limit('1');
		return $this->db->get();	
	}
	
	protected $_sortedCategories = array();
	protected function _nForLoop($data, $reply_id = "0", $level = 1) {
        foreach ($data as $key => $value) {
            if ($value["reply_id"] == $reply_id) {
                $this->_sortedCategories[] = array("id" => $value["id"], "name" => $value["name"], "reply_admin_id" => $value["reply_admin_id"], "attachment" => $value["attachment"], "phone" => $value["phone"], "reply_id" => $value["reply_id"],"post_id" => $value["post_id"],"comment" => $value["comment"], "create_time" => $value["create_time"], "level" => $level);
                // next loop
                $this->_nForLoop($data, $value["id"], $level + 1);
            }
        }
    }

    public function getSortedCategories() {
        $post_id	= $this->input->post('post_id');
        $type		= $this->input->post('type');
		$this->db->select('comments.*');
		$array = array('post_id' => $post_id, 'approved' => 1, 'type'=>$type);
		$this->db->where($array);
		$this->db->order_by('comments.id', 'DESC');
		$this->db->limit('10');
		$data =  $this->db->get('comments');
		$this->_nForLoop($data->result_array());
        return $this->_sortedCategories;
		
		// return $data->result_array();
    }
}