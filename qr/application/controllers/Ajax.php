<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MY_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function updateLanguage() {
        $result = new stdClass();
        $result->ok = false;
        $result->msg = '';

        $language = $this->input->post('language');
        if ($language) {
            $this->session->set_userdata(array('language' => $language));
            $result->ok = true;
            $result->msg = 'Ok';
        }
        echo json_encode($result);
        die();
    }

    public function createRow() {
		$result = new stdClass();
		$result->status = false;
		$result->msg = 'Có lỗi xảy ra. Xin vui lòng thử lại!';
        
        if ($this->checkLegal($this->input->post('fpid'),$this->input->post('fuid')) === false) {
            $result->status = 'illegal';
            $result->msg = 'Mã bảo hành không tồn tại!';
            $this->session->set_flashdata('message', $result->msg);
            echo json_encode($result);die();
        }
        if ($this->checkExist($this->input->post('fuid')) === true) {
            $result->status = 'exist';
            $result->msg = 'Mã Bảo hành này đã được kích hoạt!';
            
            $this->load->model('warrantymodel');
            $w_id = $this->warrantymodel->read(array('unique_id'=>$this->input->post('fuid')),array(),true)->id;
            $this->session->set_flashdata('product_id', $this->input->post('fpid'));
            $this->session->set_flashdata('w_id', $w_id);
            $this->session->set_flashdata('message', $result->msg);
            echo json_encode($result);die();
        }

		$result_id = $this->saveData();

        $result->product_id = $this->input->post('fpid');
        $result->w_id = $this->input->post($result_id);
        $result->status = true;
        $result->msg = 'Qúy khách đã kích hoạt thông tin bảo hành thành công. Cảm ơn quý khách đã tin dùng sản phẩm của Mowoen';
        $this->session->set_flashdata('status', 'ok');
        $this->session->set_flashdata('message', $result->msg);

        echo json_encode($result);die();
	}
	
	private function saveData() {
        $this->load->model('warrantymodel');
        $this->load->model('productsmodel');
        $add_year = $this->productsmodel->read(array('id'=>$this->input->post('fpid')),array(),true)->guarantee;
        $date = @$this->input->post('fdate');
        $expired_date = date('Y-m-d', strtotime($date. ' + '.$add_year.' years'));
		$data=array(
			'name' => ($this->input->post('fname')? $this->input->post('fname'): ''),
			'phone' => ($this->input->post('fphone')? $this->input->post('fphone'): ''),
			'product_id' => ($this->input->post('fpid')? $this->input->post('fpid'): ''),
			'unique_id' => ($this->input->post('fuid')? $this->input->post('fuid'): ''),
			'address' => ($this->input->post('faddress')? $this->input->post('faddress'): ''),
			'agent_name' => ($this->input->post('fbranch')? $this->input->post('fbranch'): ''),
			'agent_address' => ($this->input->post('faddr')? $this->input->post('faddr'): ''),
			'purchase_date' => ($this->input->post('fdate')? $this->input->post('fdate'): ''),
			'expired_date' => ($this->input->post('fdate')? $expired_date: ''),
		);
        $w_id = $this->warrantymodel->create($data);
        $this->session->set_flashdata('product_id', $this->input->post('fpid'));
        $this->session->set_flashdata('w_id', $w_id);
        return $w_id;
	}

    public function checkLegal($product_id,$unique_id) {
        $this->load->model('productsmodel');
        $this->load->model('qrcodemodel');
        $array_qrcodes = @$this->qrcodemodel->read(array('product_id'=>$product_id),array(),false);
        foreach (@$array_qrcodes as $k=>$v) {
            $qr_data = json_decode($v->qrcode);
            if (in_array($unique_id, $qr_data)) {
                return true;
            }
        }
        return false;
    }

    public function checkExist($unique_id) {
        $this->load->model('warrantymodel');
        $rs = $this->warrantymodel->read(array('unique_id'=>$unique_id),array(),true);
        
        if ($rs && $rs != '') {
            return true;
        } else {
            return false;
        }
    }

}
