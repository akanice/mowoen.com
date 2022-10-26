<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Qrcodes extends MY_Controller{
    public $data;
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
		$this->checkCookies();
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
        $this->load->model('qrcodemodel');
        $this->load->model('productsmodel');
    }
    public function index(){
        $this->data['title']    = 'Quản lý qrcode';
        $total = @count($this->qrcodemodel->getList(@$this->data['product_name'],@$this->data['product_sku'],'',''));
        $this->data['product_name'] = $this->input->get('product_name');
        $this->data['product_sku'] = $this->input->get('product_sku');

        //Pagination
        $config['suffix'] = '';
		$per_page = 30;

        if(($this->data['product_name'] != "") or ($this->data['product_sku'] != "")){
			$config['suffix'] = $config['suffix']. '&product_name='.urlencode($this->data['product_name']).'&product_sku='.urlencode($this->data['product_sku']);
			list($this->data['page_links'],$start) = $this->qrcodemodel->pagination('admin/qrcodes/',$config['suffix'],$total,$per_page,3);
            $list = $this->qrcodemodel->getList(@$this->data['product_name'],@$this->data['product_sku'],$per_page,$start);
        }else{
			list($this->data['page_links'],$start) = $this->qrcodemodel->pagination('admin/qrcodes/',$config['suffix'],$total,$per_page,3);
            $list = $this->qrcodemodel->getList('','',$per_page,$start);
        }


		if ($list) {foreach ($list as $k=>$v) {
			$temp[$k] = $v;
			$temp[$k]->count = count(json_decode($v->qrcode));
		}}
		$this->data['list'] = @$temp;

        $this->data['base'] = site_url('admin/qrcode/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/qrcodes/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
		$this->data['title']    = 'Thêm mới qrcode';
		$this->data['products'] = $this->productsmodel->getProductName();
		$this->data['current_product'] = $this->input->get('current_product');

		if($this->input->post('submit') != null){
			// Get product sku & create String
			$p_data = $this->productsmodel->read(array('id'=>$this->input->post("product_id")),array(),true);
			$_p = $this->productsmodel->read(array('id'=>$this->input->post("product_id")),array(),true)->sku;
			$_p = preg_replace('/[-\@\.\;\" "]+/', '', $_p);
			
			// Generate QRCode
			for ($i = 0; $i < $this->input->post("number"); $i++) {
				$qrString[$i] = $this->generateRandomString($_p);
                $qr_url[$i] = QR_URL.'product/'.$p_data->alias.'?uid='.$qrString[$i];
				$return = $this->createQrcode($qrString[$i],$qr_url[$i],$p_data->sku);
                $qr_file_path[$i] = $return['file'];
			}

			$data = array(
				"product_id" => $this->input->post("product_id"),
				"qrcode" => json_encode($qrString),
				"qrcode_images" => json_encode($qr_file_path),
			);

			$row_id = $this->qrcodemodel->create($data);
			$this->session->set_flashdata('message', 'Đã tạo xong qr code cho sản phẩm: '.$p_data->sku);
			redirect(base_url() . "admin/qrcodes/add?current_product=".$this->input->post("product_id"));
			exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/qrcodes/add');
            $this->load->view('admin/common/footer');
        }
    }

	private function generateRandomString($sku) {
		$length = 5;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		$output = $sku.$randomString;
		return $output;
	}

	private function createQrcode($sku,$str,$folder) {
		/* Load QR Code Library */
        $this->load->library('ciqrcode');
        
        /* Data */
        $save_name  = $sku.'.png';

        /* QR Code File Directory Initialize */
        $dir = 'assets/qrcode/'.$folder.'_'.date('d-m-Y').'/';
        if (!file_exists($dir)) {
            mkdir($dir, 0775, true);
        }

        /* QR Configuration  */
        $config['cacheable']    = true;
        $config['imagedir']     = $dir;
        $config['quality']      = false;
        $config['size']         = '512';
        $config['black']        = array(255,255,255);
        $config['white']        = array(255,255,255);
        $this->ciqrcode->initialize($config);
  
        /* QR Data  */
        $params['data']     = $str;
        $params['level']    = 'L';
        $params['size']     = 10;
        $params['savename'] = FCPATH.$config['imagedir']. $save_name;
        
		$this->ciqrcode->generate($params);

        /* Return Data */
        $return = array(
            'content' => $data,
            'file'    => $dir. $save_name
        );
        return $return;
	}

    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->qrcodemodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/qrcodes");
            exit();
        }
    }

	public function view($id) {
		$this->data['qrcode'] = $this->qrcodemodel->read(array('id'=>$id),array(),true);
		$this->data['product'] = $this->productsmodel->read(array('id'=>$this->data['qrcode']->product_id),array(),true);

		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/qrcodes/view');
		$this->load->view('admin/common/footer');
	}

    public function downloadQR() {
        $result = new stdClass();
        $result->ok = false;
        $result->msg = '';

        $id = $this->input->post('qrcode_list_id');
        $this->data['qrcode'] = $this->qrcodemodel->read(array('id'=>$id),array(),true);
		$this->data['product'] = $this->productsmodel->read(array('id'=>$this->data['qrcode']->product_id),array(),true);
        
        foreach (json_decode($this->data['qrcode']->qrcode_images) as $item) {
            $url = base_url().'/'.$item;
            $img = basename($item);
            file_put_contents($img, file_get_contents($url));
        }
        $result->ok = true;
		$result->status = true;
		$result->msg = 'File downloaded';
		
		echo json_encode($result);die();
    }
	
}