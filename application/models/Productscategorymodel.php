<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ProductsCategoryModel extends MY_Model {
    protected $tableName = 'products_category';
	protected $_sortedCategories = array();
	
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
        'image' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'banner' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'thumb' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'custom_field' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ), 
		'banner' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
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
        'meta_keyword' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }
	public function getProductByCategory($cat_alias='') {
		if (isset($cat_alias)) {
			$this->db->select("product.*,products_category.title as cat_name, products_category.alias as cat_alias");
			$this->db->join('products_category','product.cat_id = products_category.id','left');
			$this->db->where('products_category.alias', $cat_alias);
			$query = $this->db->get('product');
			if($query->num_rows()>0) return $query->result();
			else return false;
		}
	}
	public function getChildCategories($id=null) {
		if (isset($id)) {
			$this->db->where('products_category.parent_id',$id);
			$query = $this->db->get('products_category');
			if ($query->num_rows() > 0) {
                return $query->result();
			} else {
				return false;
			}
		}
	}
	public function isRootCategory($id) {
		$this->db->where('products_category.id', $id);
		$query = $this->db->get('products_category');
		$r = $query->first_row();
		if ($r->parent_id == 0) {
			return true;
		} else {
			return false;
		}
	}
	public function get_list_cat(){
        $query = $this->db->get_where('products_category');
        $ret = array();
        foreach ($query->result() as $row) {
            $ret[$row->id] = $row;
        }
        return $ret;
    }

	protected function _nForLoop($data, $parent = "0", $level = 1)
    {
        foreach ($data as $key => $value) {
            if ($value["parent_id"] == $parent) {
                $this->_sortedCategories[] = array("id" => $value["id"], "title" => $value["title"], "alias" => $value["alias"], "parent_id" => $value["parent_id"], "level" => $level);
                // next loop
                $this->_nForLoop($data, $value["id"], $level + 1);
            }
        }
    }

    public function getSortedCategories()
    {
        $this->_nForLoop($this->db->get('products_category')->result_array());
        return $this->_sortedCategories;
    }

    public function getProductCategoryByParent($parent_id=null) {
        if (isset($parent_id)) {
            $this->db->select("*");
            $this->db->where('parent_id', $parent_id);
            $query = $this->db->get('products_category');
            if($query->num_rows()>0) return $query->result();
            else return false;
        }
    }
}