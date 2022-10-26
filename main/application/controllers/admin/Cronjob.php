<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cronjob extends MY_Controller{
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
	}
    public function index(){
		// $this->load->model('newsmodel');
		// $this->load->model('newscategorymodel');
		// $this->load->model('newsordermodel');
		// $this->load->model('configsmodel');
		$this->load->model('productsmodel');
		$this->load->model('videosmodel');
		$video_data = $this->videosmodel->read(array(),array(),false);
				
		//Chỉ được chạy 1 lần duy nhất
		// foreach ($product_data as $item) {
			// $alias = $item->alias;
			// //$alias = ltrim($alias, $alias[0]);
			// $alias = str_replace("/","",$alias);
			// $this->productsmodel->update(array('alias'=>$alias),array('id'=>$item->id));
			// echo $item->id.' đã ok';
		// }
		
		//Re-order for table: news
		// $i=1;
		// foreach ($news_data as $item) {
			// $this->newsmodel->update(array('order'=>$i),array('id'=>$item->id));
			// $i++;
			// echo $item->id.'---';
		// }
		
		//phpinfo();
		// foreach ($cats_data as $item) {
			// $data = array(
				// 'categoryid' => $item->id,
				// 'news_array' => '["0"]',
			// );
			// $this->newsordermodel->create($data);
		// }
		
		// foreach ($video_data as $item) {
			// // print_r($item);
			// $id_youtube = $item->id_youtube;
			// $thumb = 'https://img.youtube.com/vi/'.$id_youtube.'/0.jpg';
			// // print_r($id_youtube);
			// echo 'UPDATE `videos` SET `thumb`= \''.$thumb .'\' WHERE `id`='.$item->id.';';
			// echo '<br>';
		// }
		
		
		echo '<br>';
		echo 'Hiện giờ là: '.date('Y-m-d H:i:s', time());
		echo '<hr>';
		
        $this->load->view('admin/cronjob/index');
    }
	
    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->newsmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/news");
            exit();
        }
    }
	
}