<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ProductsModel extends MY_Model {
    protected $tableName = 'products';
    
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
		'categoryid' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'price' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'sale_price' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
		 'listed_price' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'description' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'short_description' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'specifications' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'extra_des' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'made_in' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'guarantee' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
		'brand' => array(
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
		'gallery' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'featured' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
		'type' => array(
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

    public function getListProducts($type,$title,$category,$limit,$offset) {
        $this->db->select('products.*,products_category.title as cat_name');
		$this->db->join('products_category','products_category.id = products.categoryid', 'left');

		if ($type) {
			$this->db->like('products.type', $type);
		}
		if ($title) {
			$this->db->like('products.title', $title);
		}
		if($category != ""){
			$this->db->like('categoryid','"'.$category.'"');
		}
		$this->db->order_by("id","DESC");
        if ($limit != "") {
            $query = $this->db->get('products', $limit, $offset);
        } else {
			$query = $this->db->get('products');
		}
		
        if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
    }
	
	public function getRelatedProducts($category,$limit,$offset){
		$this->db->where('products.featured',1);
		$this->db->where('products.extra_des!=','');
		$this->db->order_by('id','RANDOM');
		
		if($category != ""){
			$this->db->like('categoryid','"'.$category.'"');
		}
		if ($limit != "") {
            $query = $this->db->get('products', $limit, $offset);
        } else {
			$query = $this->db->get('products');
		}
		
		if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
	}
	
	public function getRelatedProducts2($category,$price,$limit,$offset){
		$this->db->select('products.*');
		$this->db->order_by('id','RANDOM');
		
		if($category != ""){
			$this->db->like('categoryid','"'.$category.'"');
		}
		if($price != ""){
			$this->db->where('products.price >=', $price-2000000);
			$this->db->where('products.price <=', $price+2000000);
		}
		if ($limit != "") {
            $query = $this->db->get('products', $limit, $offset);
        } else {
			$query = $this->db->get('products');
		}
		
		if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
	}
	
	public function getFeaturedproductsHome($non_show,$limit){
		if (isset($non_show)) {
			$this->db->where('show',1);
			$this->db->where('featured',1);
			$this->db->where('id !=', $non_show);
			$this->db->order_by("id","DESC");
			$query = $this->db->get("products",$limit);
			if ($query->num_rows()>0) return $query->result();
		}
	}
	
	public function getProductsByCategoryId($title='',$category_id,$featured=0,$term_order='',$per_page,$start){
        $this->db->select('products.*');
		if ($featured) {
			$this->db->where('products.featured',$featured);
		}
		if ($title) {
			$this->db->like('products.title',$title);
		}
		if ($category_id) {
			$this->db->like('categoryid','"'.$category_id.'"');
		}
		$this->db->where('type','product');
		if ($term_order == '') {
			$this->db->order_by('products.id','desc');
		} else {
			$this->db->order_by('products.price',$term_order);
		}
		
		$query = $this->db->get("products",$per_page,$start);
		// print_r($this->db->last_query());    
        if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
    }
	
	public function getProductsByBrands($title='',$brand_id,$term_order='',$per_page,$start){
        $this->db->select('products.*');
		if ($brand_id) {
			$this->db->where('products.brand',$brand_id);
		}
		if ($title) {
			$this->db->like('products.title',$title);
		}
		$this->db->where('type','product');
		if ($term_order == '') {
			$this->db->order_by('products.id','desc');
		} else {
			$this->db->order_by('products.price',$term_order);
		}
		
		$query = $this->db->get("products",$per_page,$start);
		// print_r($this->db->last_query());    
        if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
    }
	
	public function getSearchProduct($title,$categoryid,$limit=10,$offset){
		$this->db->select('products.*');
		if ($title) {
			$this->db->like('products.title', $title);
		}
		$this->db->like('products.type', 'product');
		$this->db->or_like('products.sku', $title);
		$this->db->or_like('products.description', $title);
		if($categoryid != ""){
			$this->db->like('categoryid','"'.$categoryid.'"');
		}
		$this->db->order_by("id","DESC");
        if ($limit != "") {
            $query = $this->db->get('products', $limit, $offset);
        } else {
			$query = $this->db->get('products');
		}
		
        if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
    }
	
	// vietth
	public function FilterProducts($categoryid,$brand,$country,$year,$range_price,$price_order,$custom_field,$custom_data,$limit,$offset) {
		//$categoryid = '"'.$categoryid.'"';
		if($custom_data!='') {
			$this->db->select('products.*,products_attachdata.*');
			$this->db->join('products_attachdata','products_attachdata.product_id = products.id', 'left');
		} else {
			$this->db->select('products.*');
		}
        if($categoryid != ""){
			$this->db->like('categoryid','"'.$categoryid.'"');
		}
		
		// Filter by brand
        if (($brand != '') && ($brand != 'all')) {
			$this->db->where('products.brand', $brand);
		}
		// Filter by country
        if (($country != '') && ($country != 'all')) {
			$this->db->like('products.made_in', $country);
		}
		// Filter by country
        if (($year != '') && ($year != 'all')) {
			$this->db->where('products.guarantee', $year);
		}
		// Filter by price-range
		if ($range_price != '') {
			if ($range_price == 'all') {
				$this->db->where('products.sale_price >=', 0);
			} elseif ($range_price == 'tu-0-den-2') {
				$this->db->where('products.sale_price <=', 2000000);
			} elseif ($range_price == 'tu-2-den-4') {
				$this->db->where("products.sale_price BETWEEN 2000000 AND 4000000");
			} elseif ($range_price == 'tu-4-den-6') {
				$this->db->where("products.sale_price BETWEEN 4000000 AND 6000000");
			} elseif ($range_price == 'tu-6-den-10'){
				$this->db->where("products.sale_price BETWEEN 6000000 AND 10000000");
			} elseif ($range_price == 'tu-10') {
				$this->db->where('products.sale_price >=', 10000000);
			} else {
				$this->db->where('products.sale_price >=', 0);
			}
		}

		// Filter by Custom Field
		if($custom_data != ""){
			// $i=0;
			foreach ($custom_data as $v) {
				foreach ($v as $x) {
					if(!$x or $x=='' or $x=='all') {break;} else {$this->db->like('products_attachdata.value', $x);}
				}
			}
		}
		
		if ($limit){
			if ($offset){
				$this->db->limit($limit,$offset);
			}else{
				$this->db->limit($limit);
			}
		}
		if ($price_order) {
			if ($price_order == 'asc') {
				$this->db->order_by('products.sale_price', 'asc');
			} elseif ($price_order == 'desc') {
				$this->db->order_by('products.sale_price', 'desc');
			} else {
				$this->db->order_by("products.id","DESC");
			}
		}
		$this->db->order_by("products.id","DESC");
		$query = $this->db->get('products',$limit,$offset);;
		// print_r($this->db->last_query());    
		// die();
		if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
		
	}
		
	public function ElementFilterBrand($categoryid='') {
		$this->db->select('products.id,products.brand,brands.*');
		$this->db->join('brands','brands.id = products.brand', 'left');
		$this->db->group_by('products.brand');
        if($categoryid != ""){
			$this->db->like('categoryid','"'.$categoryid.'"');
		}
		$query = $this->db->get('products');
		if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
	}
		
	public function ElementFilterMadein($categoryid='') {
		$this->db->select('products.made_in');
		$this->db->group_by('products.made_in');
        if($categoryid != ""){
			$this->db->like('categoryid','"'.$categoryid.'"');
		}
		$query = $this->db->get('products');
		if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
	}
	
	public function getProductsByCatIDBrand($title,$cat_id,$brand_id,$limit=8,$offset) {
		$this->db->select('products.*');
        if($cat_id != ""){
			$this->db->like('categoryid','"'.$cat_id.'"');
		}
		if($brand_id != ""){
			$this->db->where('products.brand',$brand_id);
		}
		
		$query = $this->db->get('products',$limit,$offset);
		// print_r($this->db->last_query());    
		// die();
		if($query->num_rows() > 0)  {
			$data = $query->result();
			return $data;
		} else {
			return false;
		}
	}
}