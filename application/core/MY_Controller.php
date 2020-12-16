<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of MY_Controller
 *
 * @author drkdra
 */
class MY_Controller extends MX_Controller {
	protected $pageTitle = '';
	protected $pageName = '';
	protected $pageIcon = 'home';
	protected $admin = '';
	public $data = array();
	
	public function __construct() {
		parent::__construct();
		$this->optionData();
		$this->_checkAdmin();
	}
	public function optionData() {
		// auth
		$this->load->library('auth');
        $this->auth = new Auth();
        if ($this->auth->isUserLogin()) {
            $this->data['affiliate_user'] = $this->auth->getUser();
            $this->load->model('usersmodel');
            $this->data['user_profile'] = $this->usersmodel->read(array('id' => $this->data['affiliate_user']['id']), array(), true);
        }
		
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
		
		$this->load->model('configsmodel');
		$this->data['home_popup'] = json_decode($this->configsmodel->read(array('term'=>'home','name'=>'home_popup'),array(),true)->value);

		// Menu 
		$this->data['nav_menu'] = $this->menusmodel->getSortedCategories(1);
		
		//Options
		$this->load->model('optionsmodel');
		$options = array_swap_index($this->optionsmodel->read(), 'name');
		$this->data['options'] = $options;
		$this->data['home_logo'] = @$options['home_logo']->value;
		$this->data['tour_banner'] = @$options['tour_banner']->value;
		$this->data['home_hotline'] = @$options['home_hotline']->value;
		$this->data['home_email'] = @$options['home_email']->value;
		$this->data['home_short_introduction'] = @$options['home_short_introduction']->value;
		$this->data['link_facebook'] = @$options['link_facebook']->value;
		$this->data['link_twitter'] = @$options['link_twitter']->value;
		$this->data['link_gplus'] = @$options['link_gplus']->value;
		$this->data['link_instagram'] = @$options['link_instagram']->value;
		$this->data['tour_banner'] = @$options['tour_banner']->value;
		$this->data['global_header_code'] = @$options['global_header_code']->value;
		$this->data['global_footer_code'] = @$options['global_footer_code']->value;
		$this->data['footer_block_1'] = @$options['footer_block_1']->value;
		$this->data['footer_block_2'] = @$options['footer_block_2']->value;
		$this->data['footer_block_3'] = @$options['footer_block_3']->value;
		
		$this->load->model('productscategorymodel');
		$this->data['listcategories'] = $this->productscategorymodel->read(array('parent_id'=>0),array('id'=>false),false);
		$this->data['global_cart'] = $this->cart->contents();
	}
	
	private function _checkAdmin(){
		$uri = $this->uri->uri_string();
		if ((strpos($uri,'admin') === 0) && ($uri != 'admin/login')){
			$this->load->model('adminsmodel','AdminModel');
			
			$admin = $this->AdminModel->getAdmin();

			if (!$admin){
				redirect(site_url('admin/login'));
			}else{
				$this->admin = $admin;
			}
		}
	}
	
	public function adminLoadHeader($data=array()){
		$data['pageTitle'] = $this->pageTitle;
		$data['pageName'] = $this->pageName;
		$data['pageIcon'] = $this->pageIcon;
		$data['admin'] = $this->admin;
		
		$this->load->view('admin/header',$data);
	}
	
	public function adminLoadLeftBar($alert=''){
		$data = array();
		$data['admin'] = $this->admin;
		if ($alert){
			$data['alert'] = $alert;
		}
		
		$this->load->view('admin/leftbar',$data);
	}
	
	public function adminLoadFooter(){
		$data = array();
		
		$this->load->view('admin/footer',$data);
	}
	
	public function homeLoadHeader($data=array()){
		$data['pageTitle'] = $this->pageTitle;
		$data['pageName'] = $this->pageName;
		$data['keywords'] = $this->keywords;
		$data['description'] = $this->description;
		$data['options'] = $this->options;
		
		$this->load->view('header',$data);
	}
	
	public function homeLoadFooter(){
		$data = array();
		$this->load->view('footer',$data);
	}
	
	public function checkCookies() {
		$email = $_COOKIE['siteAuth_username'];
		$pass = $_COOKIE['siteAuth_password'];
		$this->load->model('adminsmodel','AdminModel');
		$admin = $this->AdminModel->read(array('email'=>$email),array(),true);
		if($admin){
			if($pass === $admin->password){
				$this->auth->login($admin);
			}
		}
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
	
	public function convertYoutube($string) {
		return preg_replace(
			"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/embed\/|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
			"<div class='embed-responsive embed-responsive-16by9'><iframe  class='embed-responsive-item'  src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe></div>",
			$string
		);
	}
}

?>
