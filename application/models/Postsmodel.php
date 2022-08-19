<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PostsModel extends MY_Model {
    protected $tableName = 'posts';
    
    protected $table = array(
        'id' =>  array(
            'isIndex'   => true,
            'nullable'  => true,
            'type'      => 'integer'
        ),
		'parent_id' =>  array(
            'isIndex'   => true,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'title' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'alias' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'categoryid' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'description' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'excerpt' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'status' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
		 'image' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'thumb' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'post_type' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'author_id' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
		'view' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
		'create_time' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }

    public function getListPosts($type='post',$title,$category,$limit,$offset) {
        $this->db->select('posts.*');

		if ($type) {
			$this->db->like('posts.post_type', $type);
		}
		if ($title) {
			$this->db->like('posts.title', $title);
		}
		if($category != ""){
			$this->db->like('posts.categoryid','"'.$category.'"');
		}
		$this->db->order_by("posts.id","DESC");
        if ($limit != "") {
            $query = $this->db->get('posts', $limit, $offset);
        } else {
			$query = $this->db->get('posts');
		}
		// print_r($this->db->last_query());    
        if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
    }
	
	public function getRelatedPosts($post_type='post',$post_id,$category,$limit,$offset){
		$this->db->where('posts.id!=',$post_id);
		$this->db->where('posts.post_type',$post_type);
		$this->db->order_by('id','RANDOM');
		
		if($category != ""){
			$this->db->like('categoryid','"'.$category.'"');
		}
		if ($limit != "") {
            $query = $this->db->get('posts', $limit, $offset);
        } else {
			$query = $this->db->get('posts');
		}
		
		if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
	}
	
	public function getRelatedPost2($category,$price,$limit,$offset){
		$this->db->select('posts.*');
		$this->db->order_by('id','RANDOM');
		
		if($category != ""){
			$this->db->like('categoryid','"'.$category.'"');
		}
		if($price != ""){
			$this->db->where('posts.price >=', $price-2000000);
			$this->db->where('posts.price <=', $price+2000000);
		}
		if ($limit != "") {
            $query = $this->db->get('posts', $limit, $offset);
        } else {
			$query = $this->db->get('posts');
		}
		
		if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
	}
	
	public function getPostsByCategoryId($type='post',$title='',$category_id,$featured=0,$term_order='',$per_page,$start){
        $this->db->select('posts.*,posts_category.title as cat_title');
		$this->db->join('posts_category','posts_category.id = posts.categoryid', 'left');
		if ($featured) {
			$this->db->where('posts.featured',$featured);
		}
		if ($type) {
			$this->db->like('posts.post_type',$type);
		}
		if ($title) {
			$this->db->like('posts.title',$title);
		}
		if ($category_id) {
			$this->db->like('categoryid','"'.$category_id.'"');
		}
		$this->db->order_by("id","DESC");
		$query = $this->db->get("posts",$per_page,$start);
		// print_r($this->db->last_query());    
        if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
    }
	
	public function getSearchProduct($title,$categoryid,$limit=10,$offset){
		$this->db->select('posts.*');
		if ($title) {
			$this->db->like('posts.title', $title);
		}
		$this->db->like('posts.type', 'product');
		$this->db->or_like('posts.sku', $title);
		$this->db->or_like('posts.description', $title);
		if($categoryid != ""){
			$this->db->like('categoryid','"'.$categoryid.'"');
		}
		$this->db->order_by("id","DESC");
        if ($limit != "") {
            $query = $this->db->get('posts', $limit, $offset);
        } else {
			$query = $this->db->get('posts');
		}
		
        if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
    }
	
	// vietth
	public function FilterProducts($categoryid,$material,$limit,$offset) {
		if($material!='') {
			$this->db->select('posts.*,posts_meta.id as meta_id,posts_meta.meta_key as meta_key,posts_meta.meta_value as meta_value');
			$this->db->join('posts_meta','posts.id = posts_meta.post_id', 'left');
		} else {
			$this->db->select('posts.*');
		}
        if($categoryid != ""){
			$this->db->like('posts.categoryid','"'.$categoryid.'"');
		}
		
        if (($material != '')) {
			$this->db->where('posts_meta.meta_value', $material);
		}
		
		if ($limit){
			if ($offset){
				$this->db->limit($limit,$offset);
			}else{
				$this->db->limit($limit);
			}
		}
		
		$this->db->order_by("posts.id","DESC");
		$query = $this->db->get('posts',$limit,$offset);
		// print_r($this->db->last_query());    
		// die();
		if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
		
	}
		
	public function listMetaKey($meta_key='material') {
		$this->db->distinct();
		$this->db->select('posts_meta.meta_value');
		$this->db->group_by('posts_meta.meta_value');
        if($meta_key != ""){
			$this->db->like('meta_key',$meta_key);
		}
		$query = $this->db->get('posts_meta');
		if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
	}

	function update_counter($alias) {
        // return current article views
        $this->db->where('posts.alias', urldecode($alias));
        $this->db->select('posts.view');
        $count = $this->db->get('posts')->row();
        // then increase by one
        $this->db->where('posts.alias', urldecode($alias));
        $this->db->set('posts.view', ($count->view + 1));
        $this->db->update('posts');
    }

	public function getAdjacentRow($type='post',$act='next',$post_id,$categoryid) {
		$this->db->select('posts.id');
		// if ($post_id) {
		// 	$this->db->where('posts.id',$post_id);
		// }
		if ($type) {
			$this->db->like('posts.post_type',$type);
		}
		if ($categoryid) {
			$this->db->like('categoryid','"'.$categoryid.'"');
		}
		
		$query = $this->db->get("posts");
		$temp = $query->result();$data;
		foreach ($temp as $k=>$v) {
			$data[$k] = $v->id;
		}
		$index = array_search($post_id, $data);
		$result = "";
		if($index === false){
			return false;
		}else{
			if ($act=='next') {
				$result = ($index + 1) < count($temp) ? $temp[$index + 1] : "";
			} else {
				$result = $index > 0 ? $temp[$index - 1] : "";
			}
			if (@$result->id) {return $result->id;}
			return false;
		}
	}

	public function loadMetaData($post_id) {
		$this->db->select('posts_meta.meta_key,posts_meta.meta_value');
		if ($post_id) {
			$this->db->where('posts_meta.post_id',$post_id);
		}
		$query = $this->db->get('posts_meta');
		if($query->num_rows() > 0)  {
			$temp = $query->result();
			foreach ($temp as $k=>$v) {
				$data[$v->meta_key] = $v->meta_value;
			}
			return $data;
		} else {
			return false;
		}
	}

}