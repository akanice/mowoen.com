<?php
class MenusModel extends MY_Model {
    protected $tableName = 'menus';
    
    protected $table = array(
        'id' =>  array(
            'isIndex'   => true,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'menu_id' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'integer'
        ),
		'parent' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'display_name' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'icon' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'slug' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'number' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'integer'
        ),
    );
	
	public function all() {
		return $this->db->get("menus")->result_array();
	}
	
	protected $_sortedCategories = array();
	protected $_sortResult = array();
	protected function _nForLoop($data, $parent = null, $level = 1) {
		foreach ($data as $key => $value) {
            if ($value["parent"] == $parent) {
				$this->_sortedCategories[] = array("id" => $value["id"], "display_name" => $value["display_name"], "slug" => $value["slug"], "number" => $value["number"],"parent" => $value["parent"], "level" => $level);
                // next loop
                $this->_nForLoop($data, $value["id"], $level + 1);
            }
        }
    }
	
	protected function _nLoop2($temp, $value, $key) {
		$array_temp = array();
		
		$this->db->select('menus.*');
		$this->db->where('menus.parent',$value['id']);
		$this->db->order_by('menus.number','asc');
		$array_temp =  $this->db->get('menus')->result_array();
		
		// foreach ($temp as $i) {
			// if ($i["parent"] == $value['id']) {
				// $array_temp[] = $i;
			// }
		// }
		return $array_temp;
    }
	
    public function getSortedCategories($menu_id=1) {
		$this->db->select('menus.*');
		$this->db->where('menus.menu_id',$menu_id);
		$this->db->order_by('menus.number','asc');
		$data =  $this->db->get('menus');
		$this->_nForLoop($data->result_array());
        //return $this->_sortedCategories;
		
		$temp = $this->_sortedCategories;
		
		foreach ($temp as $key=>$value) {
			if ($value['parent'] === null) {
				$last_data[$key] = $value;
				$last_data[$key]['child'] = $this->_nLoop2($temp,$value,$key);
			}
		}
		return $last_data;
    }

}