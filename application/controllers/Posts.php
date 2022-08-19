<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends MY_Controller {
    public $data;

    function __construct() {
        parent::__construct();  
		$this->load->model('adminsmodel');
		$this->load->model('postsmodel');
        $this->load->model('postscategorymodel');

		$this->data['newest_articles'] = $this->postsmodel->read(array(),array('id'=>false),false,5);
		$this->data['categories'] = $this->postscategorymodel->read(array('parent_id'=>0),array(),false,10);
		$this->data['news_sidebar'] = $this->postsmodel->read(array(),array('id'=>true),false,3);
        $this->data['adminid'] = $this->session->userdata('adminid');
        $this->data['user_data'] = $this->adminsmodel->read(array('id'=>$this->data['adminid']),array(),true);
    }
	
	public function index() {
		$total = count($this->postsmodel->read(array('post_type'=>'post')));
        $per_page = 12;
        list($this->data['page_links'],$start)	= $this->postsmodel->pagination('blog/','',$total,$per_page,2);
		$posts = $this->data['posts'] = $this->postsmodel->read(array('post_type'=>'post'),array('id'=>false),false,$per_page,$start);
        foreach ($posts as $k=>$v) {
            $temp[$k] = $v;
            $cat_id = json_decode($v->categoryid);
            $temp[$k]->cat_data = $this->postscategorymodel->read(array('id'=>$cat_id[0]),array(),true);
            $temp[$k]->meta_data = $this->postsmodel->loadMetaData($v->id);
        }
        // die();
        $this->data['posts'] = $temp;

        // print_r($this->data['posts']);die();
		$this->data['title'] = 'Blog';
        $this->data['meta_title'] = 'Mowoen Blog';
		$this->data['meta_description'] = @$temp->meta_data['meta_description'];
		$this->data['meta_keywords'] = @$temp->meta_data['meta_keywords'];
		$this->data['meta_images'] = @$temp->meta_data['meta_images'];
		
        $this->data['temp'] = 'frontend/blog/index';
		$this->load->view('frontend/index', $this->data);
    }
	
    public function view($alias) {
		$this->data['post_type'] = 'post';
        $this->data['post_data'] = $this->postsmodel->read(array('alias'=>$alias),array(),true);
		$this->add_count($alias);
		if (isset($this->data['post_data']) && ($this->data['post_data'] != '')) {
			// Extract categories what post in it 
			// $this->output->cache(3600);
			$categoryid = json_decode($this->data['post_data']->categoryid);
			foreach ($categoryid as $n => $value) {
				$this->data['category'][$n] = $cat_data = $this->postscategorymodel->read(array('id' => $value), array(), true);
				//print_r($cat_data);
				if ($cat_data->parent_id == null or $cat_data->parent_id == 0) {
					$cat_chosen = $value;
				}
			}
            
            $nextRowID = $this->postsmodel->getAdjacentRow('post','next',$this->data['post_data']->id,$cat_chosen);
            $prevRowID = $this->postsmodel->getAdjacentRow('post','prev',$this->data['post_data']->id,$cat_chosen);
            $this->data['nextRow'] = $this->postsmodel->read(array('id'=>$nextRowID),array(),true);
            $this->data['prevRow'] = $this->postsmodel->read(array('id'=>$prevRowID),array(),true);
			$this->data['related'] = $this->postsmodel->getRelatedPosts('post',$this->data['post_data']->id,$cat_chosen, 5,'');
            foreach ($this->data['related'] as $k=>$v) {
                $temp[$k] = $v;
                $cat_id = json_decode($v->categoryid);
                $temp[$k]->cat_data = $this->postscategorymodel->read(array('id'=>$cat_id[0]),array(),true);
            }
            $this->data['related'] = $temp;
			$this->data['title'] = $this->data['post_data']->title;
            $meta_data = $this->postsmodel->loadMetaData($this->data['post_data']->id);
			if (@$meta_data['meta_title'] != '') {
				$this->data['meta_title'] = @$meta_data['meta_title'];
			} else {
				$this->data['meta_title'] = $this->data['post_data']->title;
			}
			$this->data['meta_description'] = @$meta_data['meta_description'];
            $this->data['meta_keywords'] = @$meta_data['meta_keywords'];
            $this->data['meta_images'] = @$meta_data['meta_images'];

			// Breadcrumbs
			$this->data['cat'] = $cat = $this->postscategorymodel->read(array('id'=>$cat_chosen),array(),true);
			$arr_link = array(
				$cat->title => base_url('chuyen-muc/'.$cat->alias),
				$this->data['post_data']->title	=> '#',
			);

			$this->data['breadcrumb'] = $this->setBreadcrumbs($arr_link);
			
			$this->data['temp'] = 'frontend/blog/view';
			$this->load->view('frontend/index', $this->data);
        } else {
            redirect('404_override');
        }
    }
	
    function add_count($alias) {
        // load cookie helper
        $this->load->helper('cookie');
        // this line will return the cookie which has alias name
        $check_visitor = $this->input->cookie(urldecode($alias), FALSE);
        // this line will return the visitor ip address
        $ip = $this->input->ip_address();
        // if the visitor visit this article for first time then //
        //set new cookie and update article_views column  ..
        //you might be notice we used alias for cookie name and ip
        //address for value to distinguish between articles  views
        if ($check_visitor == false) {
            $cookie = array(
                "name"   => urldecode($alias),
                "value"  => "$ip",
                "expire" => time() + 7200,
                "secure" => false
            );
            $this->input->set_cookie($cookie);
            $this->postsmodel->update_counter(urldecode($alias));
        }
    }

    public function cat($alias) {
        $this->data['posts_category'] = $posts_category = $this->postscategorymodel->read(array('alias' => $alias), array(), true);
        $total = count($this->postsmodel->getPostsByCategoryId('post','',$posts_category->id,'','','',''));
        $per_page = 12;
        // list($this->data['page_links'],$start)	= $this->postsmodel->pagination('blog/','',$total,$per_page,2);
        list($this->data['page_links'],$start)	= $this->postsmodel->pagination('chuyen-muc/'.$posts_category->alias.'/','',$total,$per_page,3);
        //print_r($this->data['page_links']);die();
		//$this->data['list_articles'] = $this->postsmodel->read(array('type'=>'post',''), array(), false, $per_page,$start);
		$posts = $this->postsmodel->getPostsByCategoryId('post','',$posts_category->id,'','', $per_page, $start);
        foreach ($posts as $k=>$v) {
            $temp[$k] = $v;
            $cat_id = json_decode($v->categoryid);
            $temp[$k]->cat_data = $this->postscategorymodel->read(array('id'=>$cat_id[0]),array(),true);
        }
        $this->data['posts'] = $temp;

        $this->data['title'] = 'Chuyên mục- ' . $posts_category->title;
		if ($this->data['posts_category']->meta_title != '') {
			$this->data['meta_title'] = $this->data['posts_category']->meta_title;
		} else {
			$this->data['meta_title'] = $this->data['posts_category']->title;
		}
		$this->data['meta_description'] = $this->data['posts_category']->meta_description;
		$this->data['meta_keywords'] = $this->data['posts_category']->meta_keywords;
		$this->data['meta_images'] = $this->data['posts_category']->image;
		
		// Breadcrumbs
		$arr_link = array(
			$this->data['posts_category']->title	=> '#',
		);

		$this->data['breadcrumb'] = $this->setBreadcrumbs($arr_link);
        $this->data['temp'] = 'frontend/blog/category';
		$this->load->view('frontend/index', $this->data);
    }

    public function configPagination($slug, $per_page = 9, $alias, $total) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . $slug . '/' . $alias;
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $config['per_page'] = $per_page;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config["num_tag_open"] = "<li class='page-item'>";
        $config["num_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active page-item'><a href='#' class='page-link'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["first_link"] = "Đầu";
        $config["first_tag_open"] = "<li class='first'>";
        $config["first_tag_close"] = "</li>";
        $config["last_link"] = "Cuối";
        $config["last_tag_open"] = "<li class='last'>";
        $config["last_tag_close"] = "</li>";
        // $config["next_link"] = "Tiếp → ";
        // $config["next_tag_open"] = "<li class='next'>";
        // $config["next_tag_close"] = "</li>";
        // $config["prev_link"] = "← Trước";
        // $config["prev_tag_open"] = "<li class='prev'>";
        // $config["prev_tag_close"] = "</li>";
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
    }

    public function news_search() {
        //$this->data['prod_cat'] = $this->productcategorymodel->read();
        $this->data['name'] = $this->input->get('s_keyword');
        $total = $this->postsmodel->getCountNew($this->data['name'], '', '', '');
        $per_page = 6;
        if ($this->data['name'] != "") {
            $config['suffix'] = '?keyword=' . urlencode($this->data['name']);
        }
        //Pagination
        $this->configPagination($slug = 'search', $per_page, $alias = 'page', $total);
        $page_number = $this->uri->segment(3);
        if (empty($page_number)) $page_number = 1;
        $start = ($page_number - 1) * $per_page;
        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['result'] = $this->postsmodel->getNewsSearch($this->data['name'], '', $per_page, $start);
        //print_r($this->data['result']);die();
        $this->data['title'] = 'Search: ' . $this->input->get('s_keyword');

        $this->load->view('blog/common/header', $this->data);
        $this->load->view('blog/news_search');
        $this->load->view('blog/common/footer');
    }
	
}
