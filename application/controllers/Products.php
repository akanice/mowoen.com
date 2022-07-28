<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MY_Controller {
    function __construct() {
        parent::__construct();
		$this->load->model('productsmodel');
		$this->load->model('productscategorymodel');
		$this->load->model('productsattachmodel');
		$this->load->model('brandsmodel');
		$this->load->model('newsmodel');
    }

    public function index() {		
		$type = $this->uri->segment(1); 
		if ($type && $type != '') {
			$this->data['list_cat'] = $this->productscategorymodel->read(array('type'=>$type),array(),false);
		}
		if ($type == 'bathroom') {
			$this->data['title'] = 'Nhà tắm';
			$this->data['meta_title'] = $this->data['title'];
			$this->data['meta_description'] = '';
			$this->data['meta_keywords'] = '';
			$this->data['meta_images'] = '';
		} elseif ($type == 'kitchen') {
			$this->data['title'] = 'Nhà Bếp';
			$this->data['meta_title'] = $this->data['title'];
			$this->data['meta_description'] = '';
			$this->data['meta_keywords'] = '';
			$this->data['meta_images'] = '';
		}
		
		$this->data['newest_products'] = $this->productsmodel->read(array('type'=>$type),array('id'=>false),false,3);
        $this->data['temp'] = 'frontend/template/'.$type;
		$this->load->view('frontend/index', $this->data);
    }
	
	// URL: abc.com/bathroom
	public function get_post_type($post_type) {
        $type = $this->uri->segment(1); 
		$post_type = $this->uri->segment(2); 
		$param_cat_id = $this->input->get('cat_id', TRUE);
		if (@$post_type != '') {
			$this->go_post_type_func($type,$post_type,$param_cat_id);
		} else {
			redirect(base_url($type));
		}
		
		$this->load->view('frontend/index', $this->data);
    }
	
	// URL: abc.com/bathroom/{products - inspiration - guide}
	private function go_post_type_func($type,$post_type,$param_cat_id) {
		$this->data['type'] = $type;
		if (isset($post_type) && $post_type !== '') {
			if ($post_type == 'products') {
				$this->data['categories'] = $this->productscategorymodel->read(array('type'=>$type,'parent_id'=>0),array(),false,10);
				if (isset($param_cat_id) && $param_cat_id != '' && is_numeric($param_cat_id)) {
					$this->data['related_cat'] = $this->productscategorymodel->read(array('type'=>$type),array(),false);
					$this->viewProductCategory($type,$post_type,$param_cat_id);
				} else {
					$total = $this->data['total'] = count($this->productsmodel->read(array('type'=>$type)));
					$per_page = 20;
					list($this->data['page_links'],$start)	= $this->productsmodel->pagination($type.'/'.$post_type.'/','',$total,$per_page,3);
					$this->data['page_links'] 					= $this->pagination->create_links();
					$this->data['products'] 						= $this->productsmodel->read(array('type'=>$type),array(),false,$per_page,$start);

					$arr_link = array(
						$type				=> base_url($type),
						$post_type	=> base_url($type.'/'.$post_type),
						'All Products'	=> '#',
					);
					$this->data['breadcrumb'] = $this->setBreadcrumbs($arr_link);

					$this->data['title'] = 'Sản phẩm - '.$type;
					$this->data['meta_title'] = $this->data['title'];
					$this->data['meta_description'] = '';
					$this->data['meta_keywords'] = '';
					$this->data['meta_images'] = '';
					$this->data['temp'] = 'frontend/products/category';
				}
			} elseif (($post_type == 'inspiration') or ($post_type == 'guide')) {
				$total = $this->data['total'] = count($this->newsmodel->read(array('type'=>$type,'post_type'=>$post_type)));
				$per_page = 20;
				list($this->data['page_links'],$start)	= $this->newsmodel->pagination($type.'/'.$post_type.'/','',$total,$per_page,3);
				$this->data['page_links'] 					= $this->pagination->create_links();
				$this->data['inspiration'] 						= $this->newsmodel->read(array('type'=>$type,'post_type'=>$post_type),array(),false,$per_page,$start);
				
				$this->data['title'] = 'Chuyên mục - '.$type;
				$this->data['meta_title'] = $this->data['title'];
				$this->data['meta_description'] = '';
				$this->data['meta_keywords'] = '';
				$this->data['meta_images'] = '';
				$this->data['temp'] = 'frontend/template/'.$post_type;
			} else {
				redirect(base_url($type));
			}
		}
	}
	
	// URL: abc.com/bathroom/products/{data}
	public function get_post_data($alias,$item) {
		if (isset($alias) && $alias !== '') {
			if ($alias == 'products') {
				$this->viewProduct($item);
			} elseif (($alias == 'inspiration') or ($alias == 'guide')) {
				$this->viewPage($item);
			} else {
				redirect(base_url('404_override'));
			}
		}
	}
	
	// URL: abc.com/bathroom/products?cat_id={numeric}
	public function viewProductCategory($type,$post_type,$param_cat_id) {
		@$dimension = $this->input->get('dimension', TRUE);
		$this->data['category_data'] = $this->productscategorymodel->read(array('type'=>$type,'id'=>$param_cat_id),array(),true);
		$this->data['list_dimension'] = $this->productsmodel->listMetaKey('dimension',$this->data['category_data']->id);
		$this->data['type'] = $type;
		
		if ($this->data['category_data']) {
			@$array_products = $this->productsmodel->getProductsByCategoryId($type,'',$this->data['category_data']->id,$dimension,'','','','');
			if (empty($array_products)) {
				$total = $this->data['total'] = 0;
			} else {
				$total = $this->data['total'] = count($array_products);
			}
			$per_page = 20;
			$config['suffix'] = '?cat_id='.$param_cat_id;
			if (@$dimension) {$config['suffix'] = $config['suffix'].'&dimension='.urlencode(@$dimension);}
			list($this->data['page_links'],$start) = $this->productsmodel->pagination($type.'/'.$post_type,$config['suffix'],$total,$per_page,3);
			$this->data['products'] = $this->productsmodel->getProductsByCategoryId($type,'',$this->data['category_data']->id,$dimension,'','',$per_page,$start);
			
			$arr_link = array(
				$type				=> base_url($type),
				$post_type	=> base_url($type.'/'.$post_type),
				$this->data['category_data']->title	=> '#',
			);			
			$this->data['breadcrumb'] = $this->setBreadcrumbs($arr_link);
			
			$this->data['title'] = $this->data['category_data']->title;
			if ($this->data['category_data']->meta_title != '') {
				$this->data['meta_title'] = $this->data['category_data']->meta_title;
			} else {
				$this->data['meta_title'] = $this->data['category_data']->title;
			}
			$this->data['meta_description'] = $this->data['category_data']->meta_description;
			$this->data['meta_keywords'] = $this->data['category_data']->meta_keyword;
			$this->data['meta_images'] = $this->data['category_data']->image;
			$this->data['temp'] = 'frontend/products/category';
		} else {
			redirect(base_url($type.'/products'));
		}
	}
	
	// URL: abc.com/bath/products/{index}
	public function viewProduct($item) {
		$type				= $this->uri->segment(1);
		$post_type	= $this->uri->segment(2);
		$this->load->model('videosmodel');
		
		if (isset($item) and ($item) != '') {
			$this->data['product_data'] = $this->productsmodel->read(array('alias'=>$item),array(),true);
			if ($this->data['product_data']) {
				$cat_array = json_decode($this->data['product_data']->categoryid);
				
				// Extract categories what post in it 
				$categoryid = json_decode($this->data['product_data']->categoryid);
				foreach ($categoryid as $n => $value) {
					$this->data['category'][$n] = $cat_data = $this->productscategorymodel->read(array('id' => $value), array(), true);
					if ($cat_data->parent_id == null or $cat_data->parent_id == 0) {
						$cat_chosen = $value;
					}
				}
				
				// Load file_attach
				$this->data['file_attach'] 		= @$this->productsattachmodel->read(array('product_id'=>$this->data['product_data']->id,'attachdata'=>'file_attach'),array(),true)->value;
				$this->data['file_attach'] = json_decode($this->data['file_attach']);
				$this->data['actual_image']	= json_decode(@$this->productsattachmodel->read(array('product_id'=>$this->data['product_data']->id,'attachdata'=>'actual_image'),array(),true)->value);
				@$this->data['circleview']			= array_reverse(json_decode(@$this->productsattachmodel->read(array('product_id'=>$this->data['product_data']->id,'attachdata'=>'circleview'),array(),true)->value));
				$this->data['video_attach']	= @$this->productsattachmodel->read(array('product_id'=>$this->data['product_data']->id,'attachdata'=>'video_attach'),array(),true)->value;

				// Display video youtube
				if ($this->data['video_attach']) {
					$arr_video = explode(",",$this->data['video_attach']);
					foreach ($arr_video as $url) {
						parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
						$this->data['id_youtube'][] = $my_array_of_vars['v'];
					}
				}
				
				// Load related products
				$this->data['related_products'] = $this->productsmodel->getRelatedProducts($cat_chosen,8,'');
				
				$this->data['title'] 							= $this->data['product_data']->title;
				$this->data['meta_title']				= $this->data['product_data']->meta_title;
				$this->data['meta_description']	= $this->data['product_data']->meta_description;
				$this->data['meta_keywords']		= $this->data['product_data']->meta_keywords;
				$this->data['meta_images']			= $this->data['product_data']->image;
				
				$arr_link = array(
					$type				=> base_url($type),
					$post_type	=> base_url($type.'/'.$post_type),
					$this->data['product_data']->title	=> base_url($type.'/'.$post_type.'/'.$this->data['product_data']->alias),
				);

				$this->data['breadcrumb'] = $this->setBreadcrumbs($arr_link);
				$this->data['temp'] = 'frontend/products/view';
				$this->load->view('frontend/index', $this->data);
			} else {
				redirect(base_url());
			}
		}
	}
	
	public function viewPage($item) {
		$type				= $this->data['type'] = $this->uri->segment(1);
		$post_type	= $this->data['post_type'] =$this->uri->segment(2);
		
		if (isset($item) and ($item) != '') {
			$this->data['new_data'] = $this->newsmodel->read(array('alias'=>$item),array(),true);
			if ($this->data['new_data']) {
				$cat_chosen = json_decode($this->data['new_data']->categoryid)[0];
				
				// Load related products
				$this->data['related_news'] = $this->newsmodel->getRelatedNews($type,$post_type,$this->data['new_data']->id,$cat_chosen,8);
				
				$this->data['title'] 							= $this->data['new_data']->title;
				$this->data['meta_title']				= $this->data['new_data']->meta_title;
				$this->data['meta_description']	= $this->data['new_data']->meta_description;
				$this->data['meta_keywords']		= $this->data['new_data']->meta_keywords;
				$this->data['meta_images']			= $this->data['new_data']->image;
				
				$arr_link = array(
					$type				=> base_url($type),
					$post_type	=> base_url($type.'/'.$post_type),
					$this->data['new_data']->title	=> base_url($type.'/'.$post_type.'/'.$this->data['new_data']->alias),
				);
				$this->data['breadcrumb'] = $this->setBreadcrumbs($arr_link);
				$this->data['temp'] = 'frontend/news/view';
				$this->load->view('frontend/index', $this->data);
			} else {
				redirect(base_url());
			}
		}
	}
	
	public function product_search() {
		$this->data['name'] = $this->input->get('name');
        $this->data['category'] = $this->input->get('category');
		$this->data['total'] = $total = count($this->productsmodel->getSearchProducts('',$this->data['name'],$this->data['category'],"",""));
		$config['suffix'] = '';
		if($this->data['name'] != "" || $this->data['category'] != ""){
            $config['suffix'] = '?category='.urlencode($this->data['category']).'&name='.urlencode($this->data['name']);
        }
        $per_page = 16;
        list($this->data['page_links'],$start) = $this->productsmodel->pagination('tim-kiem',$config['suffix'],$total,$per_page,2);
        $this->data['page_links'] = $this->pagination->create_links();
		$this->data['products'] = $this->productsmodel->getSearchProducts('',$this->data['name'],$this->data['category'],$per_page,$start);
        $this->data['title'] = 'Tìm kiếm: '.$this->data['name'];
		
		$this->data['temp'] = 'frontend/products/search';
		$this->load->view('frontend/index', $this->data);
    }

}
