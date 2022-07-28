<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
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
		
		$this->load->model('landingpagemodel');		
		$this->data['global_cart'] = $this->cart->contents();
    }

    public function index() {
        $this->load->model('slidersmodel');
        $this->load->model('newsmodel');
        $this->load->model('newscategorymodel');
        $this->load->model('productsmodel');
        $this->load->model('productscategorymodel');
        $this->load->model('brandsmodel');
        $this->load->model('configsmodel');
		
		// Load Slider
		$this->data['number_slider'] = $this->slidersmodel->readCount(array("show"=>1));
		$this->data['slider'] = $this->slidersmodel->read(array('show'=>1),array(),false,5);
		
		// Load featured categories
		$this->data['categories'] = $this->productscategorymodel->read(array('parent_id' => 0), array(), false);

		// Load featured/newest products
		$this->data['mostviewed'] = $this->productsmodel->read(array('featured'=>1,'type'=>'product'),array('id'=>false),false,12);
		
		// Load Featured Article from news
		$feature_article_id = $this->configsmodel->read(array(
				'term' => 'home',
				'name' => 'featured_article'), array(), true)->value;
		$this->data['article'] = $this->newsmodel->read(array('id'=>$feature_article_id),array(),true);

		// Load article from Technology Category
		$this->data['list_tech_articles'] = $this->newsmodel->getNewsByCategoryId(8, 3,'');
		
		// Load Group Banners
		$this->data['group_banners'] = json_decode($this->configsmodel->read(array('term'=>'home','name' => 'group_banners'), array(), true)->value);
		
        $this->data['title'] = $this->optionsmodel->read(array('name'=>'home_meta_title'), array(), true)->value;
		// $this->load->model('optionsmodel');
		$options = array_swap_index($this->optionsmodel->read(), 'name');
		$this->data['meta_title'] = @$options['home_meta_title']->value;
        $this->data['meta_description'] = @$options['home_meta_description']->value;
        $this->data['meta_keywords'] = @$options['home_meta_keywords']->value;
		
        $this->data['temp'] = 'frontend/home/index';
		$this->load->view('frontend/index', $this->data);

    }

    public function pages($alias) {
        $this->load->model('pagesmodel');
        $this->data['page_data'] = $this->pagesmodel->read(array('alias' => $alias), array(), true);
        $this->data['title'] = $this->data['page_data']->title;
        $this->data['meta_title'] = $this->data['page_data']->title;
        $this->data['meta_description'] = $this->data['page_data']->meta_description;
        $this->data['meta_keywords'] = $this->data['page_data']->meta_keywords;
		
        $this->load->view('home/common/header', $this->data);
        $this->load->view('home/pages');
        $this->load->view('home/common/footer');
    }

    public function affiliateUserInfo() {
        $this->auth = new auth();
        $this->auth->check();
        $this->data['title'] = 'Dashboard';
        $this->data['meta_title'] = '';
        $this->data['meta_description'] = '';
        $this->data['meta_keywords'] = '';
        $this->data['affiliate_user'] = $this->auth->getUser();
		print_r($this->data['affiliate_user']);die();
        //-------------page link
        $total = 100;
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/affiliate/';
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $config['per_page'] = 10;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config["num_tag_open"] = "<p class='paginationLink'>";
        $config["num_tag_close"] = '</p>';
        $config["cur_tag_open"] = "<p class='currentLink'>";
        $config["cur_tag_close"] = '</p>';
        $config["first_link"] = "First";
        $config["first_tag_open"] = "<p class='paginationLink'>";
        $config["first_tag_close"] = '</p>';
        $config["last_link"] = "Last";
        $config["last_tag_open"] = "<p class='paginationLink'>";
        $config["last_tag_close"] = '</p>';
        $config["next_link"] = "Next";
        $config["next_tag_open"] = "<p class='paginationLink'>";
        $config["next_tag_close"] = '</p>';
        $config["prev_link"] = "Back";
        $config["prev_tag_open"] = "<p class='paginationLink'>";
        $config["prev_tag_close"] = '</p>';
        $this->pagination->initialize($config);
        $page_number = $this->uri->segment(4);
        if (empty($page_number)) $page_number = 1;
        $start = ($page_number - 1) * $config['per_page'];
        $this->data['page_links'] = $this->pagination->create_links();
        $this->load->model('affiliatesmodel');
        $this->data['listAffiliates'] = $this->affiliatesmodel->getListAffiliateTransactionOfUser($this->data['affiliate_user'], $start, $config['per_page']);
        $this->data['statisticAffiliate'] = $this->affiliatesmodel->getStatisticAffiliateStatistic($this->data['affiliate_user']);
        $this->load->view('home/common/header', $this->data);
        $this->load->view('home/affiliate_user_dashboard');
        $this->load->view('home/common/footer');
    }
}
