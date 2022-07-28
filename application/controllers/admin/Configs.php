<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Configs extends MY_Controller {
    public $data;

    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
        $this->checkCookies();
        if ($this->session->userdata('admingroup') == "mod") {
            show_404();
        }
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
        $this->load->model('configsmodel');
        $this->load->library('auth');
    }

    public function index() {
        $this->load->model('newscategorymodel');
        $this->load->model('newsmodel');
        $this->load->model('productscategorymodel');
        $this->data['title'] = 'Cài đặt hiển thị website';
        $total = $this->configsmodel->readCount(array('name' => '%' . $this->input->get('name') . '%'));
        $this->data['name'] = $this->input->get('name');
        $this->data['home_vertical_banner'] = $this->configsmodel->read(array(
            'term' => 'home',
            'name' => 'vertical_banner'), array(), true)->value;
        
		$this->data['home_horizontal_banner'] = $this->configsmodel->read(array(
            'term' => 'home',
            'name' => 'horizontal_banner'), array(), true)->value;
        
		$home_featured_article_id = $this->configsmodel->read(array(
            'term' => 'home',
            'name' => 'featured_article'), array(), true)->value;
		
		$home_cat_available = $this->configsmodel->read(array(
            'term' => 'home',
            'name' => 'cat_available'), array(), true)->value;
		foreach (json_decode($home_cat_available) as $cid) {
			$this->data['home_cat_available'][] = $this->productscategorymodel->read(array('id'=>$cid),array(),true);
		}
			
		$this->data['home_featured_article']	= $this->newsmodel->read(array('id'=>$home_featured_article_id),array(),true);
        $this->data['base'] = site_url('admin/configs/');
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/configs/list');
        $this->load->view('admin/common/footer');
    }


    public function editBannerv($slug='vertical_banner') {
		$this->data['slug'] = $slug = $this->input->get('slug');
	    $this->load->model('newsmodel');
        $this->data['data'] = $this->configsmodel->read(array(
            'term' => 'home',
            'name' => $slug), array(), false);

        if ($this->input->post('submit') != null) {
			// Upload banner
			$this->load->library('upload_file');
			$upload_path = 'assets/uploads/images/banners/';
			$upload_data = $this->upload_file->upload($upload_path, 'img_src');
			$image = '';
			
			if(isset($upload_data['file_name'])){
				$image = $upload_path.$upload_data['file_name'];
			}
			
			$data1 = array('value'=>$image);
			$data2 = array('value'=>$url = $this->input->post('img_url'));
			
			$this->configsmodel->update($data1, array(
				'term'    => 'home',
				'name'    => $slug,
				'term_id'    => 1));
            $this->configsmodel->update($data2, array(
				'term'    => 'home',
				'name'    => $slug,
				'term_id'    => 2));

            // Update new data
            $this->data['notice'] = 'Cập nhật thành công!';
            $this->data['data'] = $this->configsmodel->read(array(
				'term' => 'home',
				'name' => $slug), array(), false);

            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editBanner');
            $this->load->view('admin/common/footer');
        } else {
            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editBanner');
            $this->load->view('admin/common/footer');
        }
    }

    public function editCat($slug='home') {
        switch ($slug) {
			case 'home':
				$this->load->model('productscategorymodel');
				$this->data['categories'] = $this->productscategorymodel->read(array());
				break;
			case 'blog':
				$this->load->model('newscategorymodel');
				$this->data['categories'] = $this->newscategorymodel->read(array());
				break;
			default: null;
		}
		
		$this->data['cat_available'] = $this->configsmodel->read(array(
			'term' => $slug,
			'name' => 'cat_available'), array(), true);
		$this->data['cat_available'] = json_decode($this->data['cat_available']->value, true);
        if ($this->input->post('submit') != null) {
            $cat_available = $this->input->post("cat_available");
            $data = array(
                'value' => json_encode($cat_available),
            );
            $this->configsmodel->update($data, array(
                'term' => $slug,
                'name' => 'cat_available'));

            // Update new data
            $this->data['notice'] = 'Cập nhật thành công!';
            $this->data['cat_available'] = $this->configsmodel->read(array(
                'term' => $slug,
                'name' => 'cat_available'), array(), true);
            $this->data['cat_available'] = json_decode($this->data['cat_available']->value, true);

            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editCatHome');
            $this->load->view('admin/common/footer');
        } else {
            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editCatHome');
            $this->load->view('admin/common/footer');
        }
    }
	
    public function editCookieTime() {
        $this->data['cookie_time'] = $this->configsmodel->read(array(
            'term' => 'affiliate',
            'name' => 'cookie_time'), array(), true);
        $this->data['cookie_time'] = (int)$this->data['cookie_time']->value / (24 * 60 * 60);
        if ($this->input->post('submit') != null) {
            $cookie_time = $this->input->post("cookie_time") * (24 * 60 * 60);
            //print_r($cookie_time);die();
            $data = array(
                'value' => (string)$cookie_time,
            );
            //var_dump($data);die();
            $this->configsmodel->update($data, array(
                'term' => 'affiliate',
                'name' => 'cookie_time'));

            // Update new data
            $this->data['notice'] = 'Cập nhật thành cmn công!';
            $this->data['cookie_time'] = $this->configsmodel->read(array(
                'term' => 'affiliate',
                'name' => 'cookie_time'), array(), true);
            $this->data['cookie_time'] = $this->data['cookie_time']->value / (24 * 60 * 60);

            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editcookietime');
            $this->load->view('admin/common/footer');
        } else {
            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editcookietime');
            $this->load->view('admin/common/footer');
        }
    }

	public function ProductCatSlider() {
        $this->load->model('productsmodel');
        $this->load->model('productscategorymodel');
        $this->data['product_cat_slider'] = $this->configsmodel->read(array(
            'term' => 'product_cat',
            'name' => 'slider'), array(), true)->value;
		$this->data['product_cat_slider'] = json_decode($this->data['product_cat_slider'],true);	
		// print_r($this->data['product_cat_slider']);die();
        if ($this->input->post('submit') != null) {
			$packages = $this->input->post("packages");

			
			$packages = json_encode($packages);
			$data = array(
				"value" 					=> $packages,
			);
			$this->configsmodel->update($data,array(
				'term'    => 'product_cat',
				'name'    => 'slider',
			));
            $this->data['notice'] = 'Cập nhật thành công!';
			
			// Update data
            $this->data['product_cat_slider'] = $this->configsmodel->read(array(
				'term' => 'product_cat',
				'name' => 'slider'), array(), true)->value;
			$this->data['product_cat_slider'] = json_decode($this->data['product_cat_slider'],true);	
            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/ProductCatSlider');
            $this->load->view('admin/common/footer');
        } else {
            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/ProductCatSlider');
            $this->load->view('admin/common/footer');
        }
    }

    public function editFeaturedArticles() {
        $this->data['title'] = 'Chỉnh sửa bài viết nổi bật hiển thị tại trang chủ';
		$this->load->model('newsmodel');
        
		$this->data['news'] = $this->newsmodel->read(array('type'=>'post'),array(),false);
        $this->data['featured_article'] = $this->configsmodel->read(array(
            'term' => 'home',
            'name' => 'featured_article'), array(), true);

        if ($this->input->post('submit') != null) {
			$data = array(
				"value" => $this->input->post('news_id'),
			);
			$this->configsmodel->update($data,array(
				'term'    => 'home',
				'name'    => 'featured_article',
				'term_id' => 0,
			));
			
            // Update new data
            $this->data['notice'] = 'Cập nhật thành cmn công!';
            $this->data['featured_article'] = $this->configsmodel->read(array(
				'term' => 'home',
				'name' => 'featured_article'), array(), true);

            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editFeaturedArticles');
            $this->load->view('admin/common/footer');
        } else {
            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editFeaturedArticles');
            $this->load->view('admin/common/footer');
        }
    }

    public function editBannerCategory() {
        $this->load->model('newsmodel');
        $this->load->model('newscategorymodel');
        $this->data['home_cat_available'] = $this->configsmodel->read(array(
            'term' => 'home',
            'name' => 'cat_available'), array(), true);
        $this->data['home_cat_available'] = json_decode($this->data['home_cat_available']->value, true);
        foreach ($this->data['home_cat_available'] as $key => $cat_id) {
            $currentBanner = $this->configsmodel->read(array(
                'term'    => 'category',
                'name'    => 'banner',
                'term_id' => $cat_id), array(), true);
            $this->data['banner'][$key]['current_banner'] = $currentBanner ? $currentBanner->value : '';
            $catTitle = $this->newscategorymodel->read(array('id' => $cat_id), array(), true);
            $this->data['banner'][$key]['cat_title'] = $catTitle ? $catTitle->title : '';
            $catId = $this->newscategorymodel->read(array('id' => $cat_id), array(), true);
            $this->data['banner'][$key]['cat_id'] = $catId ? $catId->id : '';
        }

        if ($this->input->post('submit') != null) {
            foreach ($this->data['banner'] as $cid) {
                if (isset($_FILES['banner_' . $cid['cat_id']]) && $_FILES['banner_' . $cid['cat_id']]['size'] > 0) {
                    $uploaddir = '/assets/uploads/images/banners';
                    if (!file_exists($uploaddir) || !is_dir($uploaddir)) mkdir($uploaddir, 0777, true);
                    $this->load->library("upload");
                    $from = $_FILES['banner_' . $cid['cat_id']]['tmp_name'];
                    $to = $_SERVER['DOCUMENT_ROOT'] . $uploaddir . '/' . basename($_FILES['banner_' . $cid['cat_id']]['name']);
                    if (move_uploaded_file($from, $to)) {
                        $image = $uploaddir . '/' . $_FILES['banner_' . $cid['cat_id']]['name'];
                        $data[$cid['cat_id']] = array(
                            "value" => $image,
                        );
						if ( $this->configsmodel->read(array('term'=> 'category','name'=> 'banner','term_id' => $cid['cat_id'])) == null) {
							$data1 = array(
								'term'    => 'category',
								'name'    => 'banner',
								'term_id' => $cid['cat_id'],
								"value" => $image,
							);
							$this->configsmodel->create($data1);
						} else {
							$this->configsmodel->update($data[$cid['cat_id']], array(
								'term'    => 'category',
								'name'    => 'banner',
								'term_id' => $cid['cat_id'],
							));
						}
                    }
                }
            }

            $this->data['notice'] = 'Cập nhật thành cmn công!';
            foreach ($this->data['home_cat_available'] as $key => $cat_id) {
                $this->data['banner'][$key]['current_banner'] = $this->configsmodel->read(array(
                    'term'    => 'category',
                    'name'    => 'banner',
                    'term_id' => $cat_id), array(), true)->value;
                $this->data['banner'][$key]['cat_title'] = $this->newscategorymodel->read(array('id' => $cat_id), array(), true)->title;
                $this->data['banner'][$key]['cat_id'] = $this->newscategorymodel->read(array('id' => $cat_id), array(), true)->id;
            }

            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editBannerCategory');
            $this->load->view('admin/common/footer');
        } else {
            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editBannerCategory');
            $this->load->view('admin/common/footer');
        }
    }
	
	public function HomeGroupBanners() {
        $this->load->model('productsmodel');
        $this->load->model('productscategorymodel');
        $this->data['group_banners'] = $this->configsmodel->read(array(
            'term' => 'home',
            'name' => 'group_banners'), array(), true)->value;
		$this->data['group_banners'] = json_decode($this->data['group_banners'],true);	
		// print_r($this->data['product_cat_slider']);die();
        if ($this->input->post('submit') != null) {
			$packages = $this->input->post("packages");

			
			$packages = json_encode($packages);
			$data = array(
				"value" 					=> $packages,
			);
			$this->configsmodel->update($data,array(
				'term'    => 'home',
				'name'    => 'group_banners',
			));
            $this->data['notice'] = 'Cập nhật thành công!';
			
			// Update data
            $this->data['group_banners'] = $this->configsmodel->read(array(
				'term' => 'home',
				'name' => 'group_banners'), array(), true)->value;
			$this->data['group_banners'] = json_decode($this->data['group_banners'],true);	
            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/HomeGroupBanners');
            $this->load->view('admin/common/footer');
        } else {
            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/HomeGroupBanners');
            $this->load->view('admin/common/footer');
        }
    }
	
	public function HomePopupBanner() {
		$this->data['home_popup'] = $this->configsmodel->read(array(
			'term' => 'home',
			'name' => 'home_popup'), array(), true)->value;
		$this->data['home_popup'] = json_decode($this->data['home_popup'],true);	
        if ($this->input->post('submit') != null) {
			$data = array(
				'display' => @$this->input->post("display"),
				'delay_time' => @$this->input->post("delay_time"),
				'cookies' => @$this->input->post("cookies"),
				'content' => @$this->input->post("content"),
			);
            $data = array(
                'value' => json_encode($data),
            );
			
            $this->configsmodel->update($data, array(
                'term' => 'home',
                'name' => 'home_popup'));

            // Update new data
            $this->data['notice'] = 'Cập nhật thành công!';
            $this->data['home_popup'] = $this->configsmodel->read(array(
                'term' => 'home',
				'name' => 'home_popup'), array(), true)->value;
			$this->data['home_popup'] = json_decode($this->data['home_popup'],true);	
            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/HomePopupBanner');
            $this->load->view('admin/common/footer');
        } else {
            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/HomePopupBanner');
            $this->load->view('admin/common/footer');
        }
    }
	
    public function delete($id) {
        if (isset($id) && ($id > 0) && is_numeric($id)) {
            $this->configsmodel->delete(array('id' => $id));
            redirect(base_url() . "admin/sliders");
            exit();
        }
    }

}
