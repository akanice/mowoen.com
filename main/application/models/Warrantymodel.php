<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class WarrantyModel extends MY_Model {
    protected $tableName = 'warranty';

    protected $table = array(
        'id' =>  array(
            'isIndex'   => true,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'name' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'phone' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
        'product_id' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'unique_id' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'address' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'agent_name' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'agent_address' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'purchase_date' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'expired_date' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'create_time' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }

    public function getListResult($name,$phone,$uid,$limit,$offset) {
        $this->db->select('warranty.*,products.title as product_name,products.sku as product_sku');
		$this->db->join('products','products.id = warranty.product_id', 'left');

		if ($name) {
			$this->db->like('warranty.name', $name);
		}
		if ($phone) {
			$this->db->like('warranty.phone', $phone);
		}
		if($uid != ""){
			$this->db->like('warranty.unique_id', $uid);
		}
		$this->db->order_by("warranty.id","DESC");
        if ($limit != "") {
            $query = $this->db->get('warranty', $limit, $offset);
        } else {
			$query = $this->db->get('warranty');
		}
		// print_r($this->db->last_query());    
        if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
    }
}
