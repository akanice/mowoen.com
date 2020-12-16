<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CombosModel extends MY_Model {
    protected $tableName = 'product_combo';
    
    protected $table = array(
        'id' =>  array(
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
		'sku' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'product_id' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'rate' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'sale_price' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'integer'
        ),
		'description' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'image' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'thumb' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'featured' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'integer'
        ),
		'count_view' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'integer'
        ),
		'meta_title' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'meta_description' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'meta_keywords' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
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

    public function getListCombo($title,$category,$limit=20,$offset) {
        $this->db->select('product_combo.*');

		if ($title) {
			$this->db->like('product_combo.title', $title);
		}
		$this->db->order_by("id","DESC");
		$query = $this->db->get('product_combo', $limit, $offset);

        if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
    }
	
	public function getRelatedproduct_combo($alias,$limit){
		if (isset($alias)) {
			$this->db->where('alias',$alias);
			$query = $this->db->get('product_combo');
			if($query->num_rows()==0) return false;
			else {
				$r = $query->first_row();
				if($r->tour_cat_id){
					$this->db->like("product_combo.tour_cat_id", $r->tour_cat_id);
					$this->db->where("product_combo.alias !=", $r->alias);
					$query2 = $this->db->get("product_combo",$limit);
					if ($query2->num_rows()>0) return $query2->result();
				}
				return false;
			}
		}
	}
	
	public function getFeaturedproduct_comboHome($non_show,$limit){
		if (isset($non_show)) {
			$this->db->where('show',1);
			$this->db->where('featured',1);
			$this->db->where('id !=', $non_show);
			$this->db->order_by("id","DESC");
			$query = $this->db->get("product_combo",$limit);
			if ($query->num_rows()>0) return $query->result();
		}
	}
		
	public function getSearchProduct($name,$category,$limit=10,$offset){
		$this->db->select('product_combo.*');
		$this->db->like('product_combo.title', $name);
		$this->db->or_like('product_combo.sku', $name);
		$this->db->or_like('product_combo.description', $name);
		$this->db->order_by("id","DESC");
		if($category != ""){
			$this->db->like('categoryid','"'.$category_id.'"');
		}
		$query= $this->db->get('product_combo',$limit,$offset);
		if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
    }	
}