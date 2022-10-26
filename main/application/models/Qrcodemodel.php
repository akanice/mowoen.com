<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class QrcodeModel extends MY_Model {
    protected $tableName = 'product_qrcode';

    protected $table = array(
        'id' =>  array(
            'isIndex'   => true,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'product_id' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'qrcode' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'qrcode_images' => array(
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

    public function getList($product_name,$product_sku,$limit,$offset) {
        $this->db->select('product_qrcode.*,products.title as product_name,products.sku as product_sku');
		$this->db->join('products','products.id = product_qrcode.product_id', 'left');

		if ($product_name) {
			$this->db->like('products.title', $product_name);
		}
		if ($product_sku) {
			$this->db->like('products.sku', $product_sku);
		}
        
		$this->db->order_by("id","DESC");
        if ($limit != "") {
            $query = $this->db->get('product_qrcode', $limit, $offset);
        } else {
			$query = $this->db->get('product_qrcode');
		}
		// print_r($this->db->last_query());    die();
        if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
    }

}