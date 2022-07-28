<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MY_Controller{
    public $data;
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
		$this->checkCookies();
        // if($this->session->userdata('admingroup') == "mod"){
            // show_404();
        // }
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
        $this->load->model('tagsmodel');
        $this->load->model('tagstermmodel');
        $this->load->model('brandsmodel');
        $this->load->model('videosmodel');
        $this->load->model('productsmodel');
        $this->load->model('productscategorymodel');
        $this->load->model('productsattachmodel');
	}
	
    public function index(){
		$this->data['type'] = $type = $this->input->get('type');
        $this->data['title']    = 'Quản lý sản phẩm';
        $this->data['productcategory']    = $this->productscategorymodel->read(array('type'=>$type),array(),false);
		$this->data['name'] = $this->input->get('name');
		$this->data['cat'] = $this->input->get('cat');
		// $this->data['category'] = $this->input->get('category');
        @$total = count($this->productsmodel->getListProducts($type,$this->data['name'],$this->data['cat'],'',''));

        //Pagination
		$config['suffix'] = '?type='.$type;
		$per_page = 25;
        
        if(($this->data['name'] != "") or ($this->data['cat'] != "")){
			$config['suffix'] = $config['suffix']. '&name='.urlencode($this->data['name']).'&cat='.urlencode($this->data['cat']);
			list($this->data['page_links'],$start) = $this->productsmodel->pagination('admin/products/',$config['suffix'],$total,$per_page,3);
            $this->data['list'] = $this->productsmodel->getListProducts($type,$this->data['name'],$this->data['cat'],$per_page,$start);
        }else{
			list($this->data['page_links'],$start) = $this->productsmodel->pagination('admin/products/',$config['suffix'],$total,$per_page,3);
            $this->data['list'] = $this->productsmodel->getListProducts($type,'','',$per_page,$start);
        }
        $this->data['base'] = site_url('admin/products/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/products/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
		$this->data['type'] = $type = $this->input->get('type');
		$this->data['list_cat_id'] = $this->productscategorymodel->getSortedCategories($type);
		$this->data['allproducts'] = $this->productsmodel->read();
		if($this->input->post('submit') != null){
			if ($this->input->post("image")) {$image  = 'assets/uploads/'.substr(parse_url($this->input->post("image"), PHP_URL_PATH),0);} else {$image ='';}
			$data = pathinfo($image);
			
			//Create cover thumb
			$this->load->library('upload_file');
			$thumb = '';
            if (@$this->input->post("image") && @$image != '') {
				$dir_thumb = 'assets/uploads/thumb/images/products/';
				if (!file_exists($dir_thumb) || !is_dir($dir_thumb)) mkdir($dir_thumb,0777,true);
				$this->load->library('image_lib');
				$config2 = array();
				$config2['image_library'] = 'gd2';
				$config2['source_image'] = $image;
				$config2['new_image'] = $dir_thumb;
				$config2['create_thumb'] = TRUE;
				$config2['maintain_ratio'] = TRUE;
				$config2['quality'] = '80%';
				$config2['width'] = 400;
				$config2['height'] = 400;
				$this->image_lib->clear();
				$this->image_lib->initialize($config2);
				if(!$this->image_lib->resize()){
					print $this->image_lib->display_errors();
				}else{
					$thumb = $dir_thumb.$data['filename'].'_thumb.'.$data['extension'];
				}
			}
			
			// Thư viện ảnh
			$gallery = array();
			$gallery = json_encode($this->input->post("gallery"));
			
			$categories = json_encode($this->input->post("categoryid"));
			if (!$categories || $categories == '') {$categories = '["0"]';}
			
			$data = array(
				"title"								=> $this->input->post("title"),
				"alias" 							=> make_alias($this->input->post("title")),
				"categoryid"					=> $categories,
				"image" 	    					=> @$image,
				"thumb" 						=> @$thumb,
				"gallery" 						=> $gallery,
				"sku" 								=> $this->input->post("sku"),
				"description" 				=> $this->input->post("description"),
				"short_description" 	=> $this->input->post("short_description"),
				"specifications" 			=> $this->input->post("specifications"),
				"made_in" 					=> '',
				"guarantee" 					=> $this->input->post("guarantee"),
				"dimension" 					=> $this->input->post("dimension"),
				"price"							=> $this->input->post("price"),
				"sale_price" 					=> $this->input->post("sale_price"),
				"featured" 					=> $this->input->post("featured"),
				"type" 							=> $type,
				"meta_title" 				=> $this->input->post("meta_title"),
				"meta_description" 	=> $this->input->post("meta_description"),
				"meta_keywords" 		=> $this->input->post("meta_keywords"),
				"create_time" 				=> date('Y-m-d H:i:s', time()),
			);
			
			// Create new product
			$product_id = $this->productsmodel->create($data);
			$this->productsmodel->update(array('alias'=>make_alias($this->input->post("title").'-'.$product_id)),array('id'=>$product_id));
			
			// File attach
			$files = $this->input->post("pricingPackage");
			$files = array_values($files);
			$this->attachData($product_id, 'file_attach', json_encode($files));
			$this->attachData($product_id, 'video_attach', $this->input->post("videos"));
			$this->attachData($product_id, 'actual_image', json_encode($this->input->post("actual_image")));
			$this->attachData($product_id, 'circleview', json_encode($this->input->post("circleview")));
			
			// redirect(base_url() . "admin/products");
			redirect(base_url() . "admin/products/edit/".$product_id);
			exit();
		} else {
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/products/add');
			$this->load->view('admin/common/footer');
		}
    }

    public function edit($id) {
		$this->data['type'] = $type = $this->input->get('type');
		$this->loadData($id);
		
		if($this->input->post('submit') != null){
			if ($this->input->post("image")) {$image  = 'assets/uploads/'.substr(parse_url($this->input->post("image"), PHP_URL_PATH),0);} else {$image ='';}
			$data = pathinfo($image);
			
			//Create cover thumb
			$this->load->library('upload_file');
			$thumb = '';
            if ($image != '') {
				$dir_thumb = 'assets/uploads/thumb/images/products/';
				if (!file_exists($dir_thumb) || !is_dir($dir_thumb)) mkdir($dir_thumb,0777,true);
				$this->load->library('image_lib');
				$config2 = array();
				$config2['image_library'] = 'gd2';
				$config2['source_image'] = $image;
				$config2['new_image'] = $dir_thumb;
				$config2['create_thumb'] = TRUE;
				$config2['maintain_ratio'] = TRUE;
				$config2['quality'] = '80%';
				$config2['width'] = 400;
				$config2['height'] = 400;
				$this->image_lib->clear();
				$this->image_lib->initialize($config2);
				if(!$this->image_lib->resize()){
					print $this->image_lib->display_errors();
				}else{
					$thumb = $dir_thumb.$data['filename'].'_thumb.'.$data['extension'];
				}
			}
			
			// Gallery
			$gallery = array();
			$gallery = json_encode($this->input->post("gallery"));
			$actual_image = array();
			$actual_image = json_encode($this->input->post("actual_image"));
			$circleview = array();
			$circleview = json_encode($this->input->post("circleview"));

			$categories = json_encode($this->input->post("categoryid"));
			if (!$categories || $categories == '') {$categories = '["0"]';}
				
			$data = array(
				"title"								=> $this->input->post("title"),
				"alias" 							=> $this->input->post("alias"),
				"categoryid"					=> $categories,
				"image" 	    					=> @$image,
				"thumb" 						=> @$thumb,
				"gallery" 						=> $gallery,
				"sku" 								=> $this->input->post("sku"),
				"description" 				=> $this->input->post("description"),
				"short_description" 	=> $this->input->post("short_description"),
				"specifications" 			=> $this->input->post("specifications"),
				"made_in" 					=> '',
				"guarantee" 					=> $this->input->post("guarantee"),
				"dimension" 					=> $this->input->post("dimension"),
				"price"							=> $this->input->post("price"),
				"sale_price" 					=> $this->input->post("sale_price"),
				"featured" 					=> $this->input->post("featured"),
				"type" 							=> $this->data['products']->type,
				"meta_title" 				=> $this->input->post("meta_title"),
				"meta_description" 	=> $this->input->post("meta_description"),
				"meta_keywords" 		=> $this->input->post("meta_keywords"),
			);

			$this->productsmodel->update($data,array('id'=>$id));

			// File attach
			$files = $this->input->post("pricingPackage");
			$files = array_values($files);
			$this->attachData($id, 'file_attach', json_encode($files));
			$this->attachData($id, 'video_attach', $this->input->post("videos"));
			$this->attachData($id, 'actual_image', json_encode($this->input->post("actual_image")));
			$this->attachData($id, 'circleview', json_encode($this->input->post("circleview")));
			
			redirect(base_url() . "admin/products/edit/".$id);
			exit();
		} else {
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/products/edit');
			$this->load->view('admin/common/footer');
		}
    }
	
	public function duplicate($id) {
		$this->loadData($id);
		
		if($this->input->post('submit') != null){
			if ($this->input->post("image")) {$image  = 'assets/uploads/'.substr(parse_url($this->input->post("image"), PHP_URL_PATH),0);} else {$image ='';}
			$data = pathinfo($image);
			
			//Create cover thumb
			$this->load->library('upload_file');
			$thumb = '';
            if (@$this->input->post("image") && @$image != '') {				
				$thumb = $this->productsmodel->createThumb($image, 'assets/uploads/thumb/images/products/');
			}
			
			// Gallery
			$gallery = array();
			$gallery = json_encode($this->input->post("gallery"));
			$actual_image = array();
			$actual_image = json_encode($this->input->post("actual_image"));

			$categories = json_encode($this->input->post("categoryid"));
			if (!$categories || $categories == '') {$categories = '["0"]';}
				
			$data = array(
				"title"								=> $this->input->post("title"),
				"alias" 							=> make_alias($this->input->post("title")),
				"categoryid"					=> $categories,
				"image" 	    					=> @$image,
				"thumb" 						=> @$thumb,
				"gallery" 						=> $gallery,
				"sku" 								=> $this->input->post("sku"),
				"description" 				=> $this->input->post("description"),
				"short_description" 	=> $this->input->post("short_description"),
				"specifications" 			=> $this->input->post("specifications"),
				"made_in" 					=> $this->input->post("made_in"),
				"guarantee" 					=> $this->input->post("guarantee"),
				"dimension" 					=> $this->input->post("dimension"),
				"price"							=> $this->input->post("price"),
				"sale_price" 					=> $this->input->post("sale_price"),
				"featured" 					=> $this->input->post("featured"),
				"type" 							=> $products->type,
				"meta_title" 				=> $this->input->post("meta_title"),
				"meta_description" 	=> $this->input->post("meta_description"),
				"meta_keywords" 		=> $this->input->post("meta_keywords"),
			);

			// Create new product
			$product_id = $this->productsmodel->create($data);
			$this->productsmodel->update(array('alias'=>make_alias($this->input->post("title").'-'.$product_id)),array('id'=>$product_id));

			// Create new tag_term
			$tags = json_encode($this->input->post("tags"));
			if ($tags && $tags != '') {
				$this->tagstermmodel->create(array('type'=>'product','term_id'=>$product_id,'tag_id'=>$tags));
			}

			// File attach
			$files = $this->input->post("pricingPackage");
			$files = array_values($files);
			$this->attachData($product_id, 'file_attach', json_encode($files));
			$this->attachData($product_id, 'file_attach', $this->input->post("files"));
			$this->attachData($product_id, 'video_attach', $this->input->post("videos"));
			$this->attachData($product_id, 'actual_image', json_encode($this->input->post("actual_image")));
			
			redirect(base_url() . "admin/products/edit/".$product_id);
			exit();
		} else {
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/products/edit');
			$this->load->view('admin/common/footer');
		}
    }
	
	private function loadData($id) {
		$this->data['allproducts'] = $this->productsmodel->read();
		$this->data['alltags'] = $this->tagsmodel->read();
		$this->data['brands'] = $this->brandsmodel->read();
		$this->data['allvideos'] = $this->videosmodel->read();
		$this->data['allaccessories'] = $this->productsmodel->read(array('type'=>'accessory'));
		
		$this->data['product_combo'] = @json_decode($this->productsattachmodel->read(array('product_id'=>$id,'attachdata'=>'combo'),array(),true)->value);
		$this->data['product_tags'] = @json_decode($this->tagstermmodel->read(array('term_id'=>$id,'type'=>'product'),array(),true)->tag_id);
		$this->data['products'] = $products = $this->productsmodel->read(array('id'=>$id),array(),true);
		$this->data['list_cat_id'] = $this->productscategorymodel->getSortedCategories($this->data['products']->type);
		$cat_id = $this->data['products']->categoryid = json_decode($this->data['products']->categoryid);
		$this->data['products']->image = str_replace('assets/uploads/', '', $products->image);
		
		// Extra data for product
		$this->data['p_custom_data'] = @json_decode($this->productsattachmodel->read(array('product_id'=>$id,'attachdata'=>'custom_field'),array(),true)->value);
		$this->data['p_file_attach'] = @$this->productsattachmodel->read(array('product_id'=>$id,'attachdata'=>'file_attach'),array(),true)->value;
		$this->data['pricingPackage'] = json_decode($this->data['p_file_attach']);
		$this->data['p_video_attach'] = @$this->productsattachmodel->read(array('product_id'=>$id,'attachdata'=>'video_attach'),array(),true)->value;
		$this->data['actual_image'] = @($this->productsattachmodel->read(array('product_id'=>$id,'attachdata'=>'actual_image'),array(),true)->value);
		$this->data['circleview'] = @($this->productsattachmodel->read(array('product_id'=>$id,'attachdata'=>'circleview'),array(),true)->value);
		$this->data['cat_custom_field'] = @json_decode($this->productscategorymodel->read(array('id'=>$cat_id[0]),array(),true)->custom_field);
		
	}
	
	private function attachData($product_id, $type, $data) {
		$temp = $this->productsattachmodel->read(array('product_id'=>$product_id,'attachdata'=>$type),array(),true);
		if ($temp && $temp != '') {
			$this->productsattachmodel->update(array('attachdata'=>$type, 'value'=>$data),array('id'=>$temp->id));
		} else {
			$this->productsattachmodel->create(array('attachdata'=>$type, 'value'=>$data,'product_id'=>$product_id));
		}
	}
	
	public function detail($id) {
		$this->data['products'] = $products = $this->productsmodel->read(array('id'=>$id),array(),true);
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/products/detail');
		$this->load->view('admin/common/footer');
	}
    public function delete($id){
		if(isset($id)&&($id>0)&&is_numeric($id)){
			$this->productsmodel->delete(array('id'=>$id));
			redirect(base_url() . "admin/products");
			exit();
		}
    }

}