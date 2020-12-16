<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Controller {
    public $data;

    function __construct() {
        parent::__construct();  
		//Get Menu 
        $this->load->model('menusmodel');

		// nav menu
        $nav_data = $this->menusmodel->read(array('menu_id' => '1'));
        $this->data['navmenu'] = json_decode(json_encode($nav_data), true);
		// footer menu
		$footer_data = $this->menusmodel->read(array('menu_id' => '2'));
        $this->data['footer_menu'] = json_decode(json_encode($footer_data), true);		
        $this->data['footermenu'] = $this->menusmodel->read(array('menu_id' => 2));
		
        $this->data['config_navmenu'] = $this->menusmodel->setup_navmenu();
        $this->data['config_mobilemenu'] = $this->menusmodel->setup_mobilemenu();
		
		$this->load->model('newsmodel');
		$this->data['newest_articles'] = $this->newsmodel->read(array(),array('id'=>false),false,5);

        //print_r($this->data['config_navmenu']);die();
        $this->load->model('menustermmodel');
        $this->load->model('configsmodel');

        //Options
        $this->load->model('optionsmodel');
        $options = array_swap_index($this->optionsmodel->read(), 'name');
        $this->data['options'] = $options;
        $this->data['home_logo'] = @$options['home_logo']->value;
        $this->data['tour_banner'] = @$options['tour_banner']->value;
        $this->data['home_hotline'] = @$options['home_hotline']->value;
        $this->data['home_short_introduction'] = @$options['home_short_introduction']->value;
        $this->data['link_facebook'] = @$options['link_facebook']->value;
        $this->data['link_twitter'] = @$options['link_twitter']->value;
        $this->data['link_gplus'] = @$options['link_gplus']->value;
        $this->data['link_instagram'] = @$options['link_instagram']->value;
        $this->data['tour_banner'] = @$options['tour_banner']->value;
		$this->data['global_header_code'] = @$options['global_header_code']->value;
        $this->data['global_footer_code'] = @$options['global_footer_code']->value;

        $this->load->model('newsmodel');
        $this->load->model('newscategorymodel');
        $this->load->model('configsmodel');
		
		$this->load->model('landingpagemodel');
		$this->data['categories'] = $this->newscategorymodel->read(array('parent_id'=>0),array(),false,10);
		$this->data['news_sidebar'] = $this->newsmodel->read(array(),array('id'=>true),false,3);
    }

    public function index($alias) {
        $this->data['new_data'] = $this->newsmodel->read(array('alias'=>$alias),array(),true);
		$this->add_count($alias);
		if (isset($this->data['new_data']) && ($this->data['new_data'] != '')) {
			// Extract categories what post in it 
			// $this->output->cache(3600);
			$categoryid = json_decode($this->data['new_data']->categoryid);
			foreach ($categoryid as $n => $value) {
				$this->data['category'][$n] = $cat_data = $this->newscategorymodel->read(array('id' => $value), array(), true);
				//print_r($cat_data);
				if ($cat_data->parent_id == null or $cat_data->parent_id == 0) {
					$cat_chosen = $value;
				}
			}
			$this->data['related_news'] = $this->newsmodel->getRelatedNews($cat_chosen, 5);
			
			$this->data['title'] = $this->data['new_data']->title;
			$this->data['meta_title'] = $this->data['new_data']->meta_title;
			$this->data['meta_description'] = $this->data['new_data']->meta_description;
			$this->data['meta_keywords'] = $this->data['new_data']->meta_keywords;
			$this->data['meta_images'] = $this->data['new_data']->image;
			
			$this->data['temp'] = 'frontend/news/view';
			$this->load->view('frontend/index', $this->data);
        } else {
            redirect('404_override');
        }
    }

	public function home() {
		$this->data['title'] = 'Bếp Thành Vinh - Blog';
		$total = count($this->newsmodel->read());
        $per_page = 16;
        list($this->data['page_links'],$start)	= $this->newsmodel->pagination('blog/','',$total,$per_page,2);
        $this->data['page_links'] 					= $this->pagination->create_links();
		$this->data['news'] 							= $this->newsmodel->read(array(),array(),false,$per_page,$start);

        $this->data['temp'] = 'frontend/news/index';
		$this->load->view('frontend/index', $this->data);
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
            $this->newsmodel->update_counter(urldecode($alias));
        }
    }

    public function category($alias) {
        $this->data['news_category'] = $news_category = $this->newscategorymodel->read(array('alias' => $alias), array(), true);
        $total = $this->newsmodel->readCountNew($news_category->id);
        $per_page = 12;
        $this->configPagination($slug = 'category', $per_page, $alias, $total);
        $page_number = $this->uri->segment(4);
        if (empty($page_number)) $page_number = 1;
        $start = ($page_number - 1) * $per_page;
        $this->data['page_links'] = $this->pagination->create_links();
        if (empty($news_category->title)) {
            $this->data['title'] = 'Chuyên mục';
        } else {
            $this->data['title'] = 'Chuyên mục- ' . $news_category->title;
        }
		
		//$this->data['list_articles'] = $this->newsmodel->read(array('type'=>'post',''), array(), false, $per_page,$start);
		$this->data['list_articles'] = $this->newsmodel->getNewsByCategoryId($news_category->id, $per_page, $start);
        $this->data['most_viewed'] = $this->newsmodel->read(array('type'=>'post'), array('count_view' => false), false, 5);

        $this->data['meta_keywords'] = $news_category->meta_keywords;
        $this->data['meta_description'] = $news_category->meta_description;

       $this->data['temp'] = 'frontend/news/category';
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
        $total = $this->newsmodel->getCountNew($this->data['name'], '', '', '');
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
        $this->data['result'] = $this->newsmodel->getNewsSearch($this->data['name'], '', $per_page, $start);
        //print_r($this->data['result']);die();
        $this->data['title'] = 'Search: ' . $this->input->get('s_keyword');

        $this->load->view('blog/common/header', $this->data);
        $this->load->view('blog/news_search');
        $this->load->view('blog/common/footer');
    }
	
	public function videos_item($alias='') {
		$this->load->model('videosmodel');
		if(!isset($alias) || $alias=='' || is_numeric($alias)==true){
			// $this->datap['newest_video'] = $this->videosmodel->read(array(),array(),true,1);
			$total = count($this->videosmodel->read(array(),array(),false));
			$per_page = 24;
			$this->configPagination($slug = 'videos', $per_page, '', $total);
			$page_number = $this->uri->segment(2);
			if (empty($page_number)) $page_number = 1;
			$start = ($page_number - 1) * $per_page;
			$this->data['page_links'] = $this->pagination->create_links();
			
			
			$this->data['all_videos'] = $this->videosmodel->read(array(),array(),false,$per_page, $start);

			$this->data['title'] = 'Siêu thị khóa điện tử - Videos';
			$this->data['meta_title'] 				= 'Siêu thị khóa điện tử - Videos';
			$this->data['meta_description'] 		= 'Siêu thị khóa điện tử - Videos';
			$this->data['meta_keywords'] 			= 'Siêu thị khóa điện tử - Videos';
			
			$this->data['temp'] = 'frontend/videos/index';
			$this->load->view('frontend/index', $this->data);
		} else {
			$this->data['video'] = $this->videosmodel->read(array('alias'=>$alias),array(),true);
			$this->data['related_video'] = $this->videosmodel->getRelatedVideos($alias,24);
			$this->data['list_video'] = $this->videosmodel->getRandomListVideos($alias,8);
			$this->data['all_videos'] = $this->videosmodel->read(array(),array(),false,24);
			$this->data['title'] = 'Siêu thị khóa điện tử - Videos';
			$this->data['meta_title'] 				= 'Siêu thị khóa điện tử - Videos';
			$this->data['meta_description'] 		= 'Siêu thị khóa điện tử - Videos';
			$this->data['meta_keywords'] 			= 'Siêu thị khóa điện tử - Videos';
			
			$this->data['temp'] = 'frontend/videos/view';
			$this->load->view('frontend/index', $this->data);
		}
	}
	
    private function banner_bottom($post_id) {
        $cat_id = json_decode($this->newsmodel->read(array('id'=>$post_id),array(),true)->categoryid);
		$k = array_rand($cat_id);
		$category_id = $cat_id[$k];
		$html = $this->newscategorymodel->read(array('id'=>$category_id),array(),true)->banner_bottom_display;
		return $html;
    }
    private function banner_top($post_id) {
        $cat_id = json_decode($this->newsmodel->read(array('id'=>$post_id),array(),true)->categoryid);
		$k = array_rand($cat_id);
		$category_id = $cat_id[$k];
		$html = $this->newscategorymodel->read(array('id'=>$category_id),array(),true)->banner_top_display;
		return $html;
    }
	
}
