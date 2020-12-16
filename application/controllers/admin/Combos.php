<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Combos extends MY_Controller{
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
        $this->load->model('productsmodel');
        $this->load->model('productscategorymodel');
        $this->load->model('productsattachmodel');
        $this->load->model('combosmodel');
	}
	
    public function index(){
        $this->data['title']    = 'Quản lý Combo sản phẩm';
        //$this->data['combos']    = $this->combosmodel->read();
		$this->data['name'] = $this->input->get('name');
		$this->data['category'] = $this->input->get('category');
        $total = count($this->combosmodel->getListCombo($this->input->get('name'),'','',''));
		
        //Pagination
		$config['suffix'] = '';
		$per_page = 25;
        
        if($this->data['name'] != ""){
			$config['suffix'] = '?name='.urlencode($this->data['name']);
			list($this->data['page_links'],$start) = $this->combosmodel->pagination('admin/combos',$config['suffix'],$total,$per_page,3);
            $this->data['list'] = $this->combosmodel->getListCombo($this->input->get('name'),$this->data['category'],$per_page,$start);
        }else{
			list($this->data['page_links'],$start) = $this->combosmodel->pagination('admin/combos','',$total,$per_page,3);
            $this->data['list'] = $this->combosmodel->getListCombo('','',$per_page,$start);
        }
        $this->data['base'] = site_url('admin/combos/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/combos/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
		$this->data['categories'] = $this->productscategorymodel->getSortedCategories();
		// $this->data['alltags'] = $this->tagsmodel->read();
		//$this->data['allproducts'] = $this->productsmodel->read();
		$this->data['brands'] = $this->brandsmodel->read();
		
		if($this->input->post('submit') != null){			
			$image  = 'assets/uploads/'.substr(parse_url($this->input->post("image"), PHP_URL_PATH),0);
			$data = pathinfo($image);
			
			//Create cover thumb
			$this->load->library('upload_file');
			$thumb = '';
            if ($image != '') {
				$dir_thumb = 'assets/uploads/images/thumb/combo/';
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
			
			$product_id = json_encode($this->input->post("product_id"));
			$data = array(
				"title"							=> $this->input->post("title"),
				"alias" 							=> make_alias($this->input->post("title")),
				"image" 	    				=> @$image,
				"thumb" 						=> @$thumb,
				"sku" 							=> $this->input->post("sku"),
				"description" 				=> $this->input->post("description"),
				"product_id" 				=> $product_id,
				"rate" 							=> $this->input->post("rate"),
				"sale_price" 				=> $this->input->post("sale_price"),
				"count_view" 				=> 0,
				"featured" 					=> $this->input->post("featured"),
				"meta_title" 				=> @$this->input->post("meta_title"),
				"meta_description" 	=> @$this->input->post("meta_description"),
				"meta_keywords" 		=> @$this->input->post("meta_keywords"),
				"create_time" 				=> date('Y-m-d H:i:s', time()),
			);
			
			
			// Create new product
			$combo_id = $this->combosmodel->create($data);
			//echo $this->db->last_query();
			$this->combosmodel->update(array('alias'=>make_alias($this->input->post("title").'-'.$combo_id)),array('id'=>$combo_id));

			// redirect(base_url() . "admin/products");
			redirect(base_url() . "admin/combos/edit/".$combo_id);
			exit();
		} else {
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/combos/add');
			$this->load->view('admin/common/footer');
		}
    }

    public function edit($id) {
		$this->data['categories'] = $this->productscategorymodel->getSortedCategories();
		$this->data['brands'] = $this->brandsmodel->read();
		$this->data['combo'] = $this->combosmodel->read(array('id'=>$id),array(),true);
		$product_id = json_decode($this->data['combo']->product_id);
		foreach ($product_id as $i) {
			$this->data['product_array'][] = $this->productsmodel->read(array('id'=>$i),array(),true);
		}
		
		if($this->input->post('submit') != null){
			$image  = 'assets/uploads/'.substr(parse_url($this->input->post("image"), PHP_URL_PATH),0);
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
			
			$product_id = json_encode($this->input->post("product_id"));
			$data = array(
				"title"							=> $this->input->post("title"),
				"alias" 							=> make_alias($this->input->post("title")),
				"image" 	    				=> @$image,
				"thumb" 						=> @$thumb,
				"sku" 							=> $this->input->post("sku"),
				"description" 				=> $this->input->post("description"),
				"product_id" 				=> $product_id,
				"rate" 							=> $this->input->post("rate"),
				"sale_price" 				=> $this->input->post("sale_price"),
				"count_view" 				=> 0,
				"featured" 					=> $this->input->post("featured"),
				"meta_title" 				=> @$this->input->post("meta_title"),
				"meta_description" 	=> @$this->input->post("meta_description"),
				"meta_keywords" 		=> @$this->input->post("meta_keywords"),
				"create_time" 				=> date('Y-m-d H:i:s', time()),
			);
			
			$this->combosmodel->update($data,array('id'=>$id));
			$this->combosmodel->update(array('alias'=>make_alias($this->input->post("title").'-'.$combo_id)),array('id'=>$combo_id));

			redirect(base_url() . "admin/combos/edit/".$id);
			exit();
		} else {
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/combos/edit');
			$this->load->view('admin/common/footer');
		}
    }
	
	public function detail($id) {
		$this->data['products'] = $products = $this->productsmodel->read(array('id'=>$id),array(),true);
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/combos/detail');
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