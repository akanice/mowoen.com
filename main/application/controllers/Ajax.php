<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->data = array();
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

    public function contact() {
        $result = new stdClass();
        $result->ok = false;
        $result->msg = '';

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $content = $this->input->post('content');

        if (!$name) {
            $result->msg = 'Bạn chưa điền tên!';
            echo json_encode($result);
            die();
        }
        if (!$email) {
            $result->msg = 'Bạn chưa điền email!';
            echo json_encode($result);
            die();
        }
        if (!$content) {
            $result->msg = 'Bạn chưa điền nội dung!';
            echo json_encode($result);
            die();
        }

        //Send mail

        $this->load->config('a4r_mail', TRUE);
        $this->load->library('email');
        $config['protocol'] = $this->config->item('protocol', 'a4r_mail');
        $config['smtp_host'] = $this->config->item('smtp_host', 'a4r_mail');
        $config['smtp_port'] = $this->config->item('smtp_port', 'a4r_mail');
        $config['smtp_user'] = $this->config->item('smtp_user', 'a4r_mail');
        $config['smtp_pass'] = $this->config->item('smtp_pass', 'a4r_mail');
        $config['mailtype'] = $this->config->item('mailtype', 'a4r_mail');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($this->config->item('admin_email', 'a4r_mail'), $this->config->item('site_title', 'a4r_mail'));
        $datamail = array(
            'name'    => $name,
            'email'   => $email,
            'content' => $content);
        $list = array(
            'admin@nhatminhdev.com',
            'sales@nhatminhdev.com');
        $this->email->to($list);
        $this->email->subject($this->config->item('email_contact_subject', 'a4r_mail'));
        $message = $this->load->view($this->config->item('email_templates', 'a4r_mail') . $this->config->item('email_contact', 'a4r_mail'), $datamail, true);
        $this->email->message($message);
        if ($this->email->send()) {
            $result->ok = true;
        } else {
            echo $this->email->print_debugger();
            $result->msg = 'Không gửi được mail!';
        };


        echo json_encode($result);
        die();
    }

    public function subscribe() {
        $this->load->helper('url');
        $result = new stdClass();
        $result->ok = false;
        $result->msg = '';

        $email = $this->input->post('email');

        $this->load->model('subscribermodel');
        $subscribe = array();
        $subscribe['email'] = $email;
        $subscribe['active'] = 1;
        $subscribe['create_time'] = time();

        $r = $this->subscribermodel->create($subscribe);
        if (!$r) {
            $result->msg = 'Có lỗi xảy ra';
            echo json_encode($result);
            die();
        }

        $result->ok = true;
        echo json_encode($result);
        die();
    }

    public function createOrder() {
        $this->load->model('ordersmodel');
        $this->load->model('customersmodel');
        $this->load->model('affiliatesmodel');
        $affiliateUserId = isset($_COOKIE['affiliate_user_id']) ? intval($_COOKIE['affiliate_user_id']) : null;
        $landingpageId = $_COOKIE['landing_page_id'];
        $orderData = (array)$_POST['order'];
        $customerData = (array)$_POST['customer'];
        $customer = $this->customersmodel->createNewCustomer($customerData);
        if (!$customer) die(json_encode(array(
            'success' => false,
            'code'    => 'customer_fail',
            'message' => 'Error when create customer'
        )));
        $affiliateTransaction = null;
        if ($affiliateUserId) {
            $affiliateTransaction = $this->affiliatesmodel->createAffiliateTransaction($landingpageId, $affiliateUserId, $orderData['total_price']);
            $this->affiliatesmodel->updateAffiliatestatistic($affiliateUserId, 'order');
            if (!$affiliateTransaction) die(json_encode(array(
                'success' => false,
                'code'    => 'affiliate_transaction_fail',
                'message' => 'Error when create affiliate transaction'
            )));
        }

        $orderData['sale_id'] = null;
        $orderData['customer_id'] = $customer['id'];
        $orderData['affiliate_transaction_id'] = $affiliateTransaction ? $affiliateTransaction['id'] : null;
        $order = $this->ordersmodel->createNewOrder($orderData);
        if (!$order) die(json_encode(array(
            'success' => false,
            'code'    => 'order_fail',
            'message' => 'Error when create order'
        )));
        die(json_encode(array(
            'success' => true,
            'code'    => '',
            'message' => 'Order created'
        )));
    }

	public function sendmail($name,$phone,$email,$pre_birth,$address,$message,$poh_affiliate,$package_price_value) {
		$this->load->config('a4r_mail', TRUE);
        $this->load->library('email');
        $config['protocol'] = $this->config->item('protocol', 'a4r_mail');
        $config['smtp_host'] = $this->config->item('smtp_host', 'a4r_mail');
        $config['smtp_port'] = $this->config->item('smtp_port', 'a4r_mail');
        $config['smtp_user'] = $this->config->item('smtp_user', 'a4r_mail');
        $config['smtp_pass'] = $this->config->item('smtp_pass', 'a4r_mail');
        $config['mailtype'] = $this->config->item('mailtype', 'a4r_mail');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($this->config->item('admin_email', 'a4r_mail'), $this->config->item('site_title', 'a4r_mail'));
        $datamail = array(
            'name'    => $name,
            'phone'    => $phone,
            'email'   => $email,
            'pre_birth'   => $pre_birth,
            'address'   => $address,
            'message'   => $message,
            'poh_affiliate' => $poh_affiliate,
            'package_price_value' => $package_price_value
		);
        $list = array(
            'hoangviet11088@gmail',
        );
        $this->email->to($list);
        $this->email->subject($this->config->item('email_register_subject', 'a4r_mail'));
        $message = $this->load->view($this->config->item('email_templates', 'a4r_mail') . $this->config->item('email_contact', 'a4r_mail'), $datamail, true);
        $this->email->message($message);
        if ($this->email->send()) {
            return true;
        }
		return false;
	}
	
	public function add_to_cart() {
		$this->cart->destroy();
		$name = $this->input->post('product_name');
		$name = preg_replace('~[\\\\/:*?"<>|]~', ' ', $name);
		$data = array(
			array(
				'id' => $this->input->post('product_id'),
				'name' => $name,
				'extra_des' => $this->input->post('product_extra_des'),
				'price' => $this->input->post('product_price'),
				'thumb' => $this->input->post('product_thumb'),
				'qty' => $this->input->post('quantity'),
			),
		);
		$this->cart->insert($data);
		print_r($data);
		echo $this->show_cart();
	}
	
	public function bulk_add_to_cart() {
		$product_id = $this->input->post('product_id');
		$product_name = $this->input->post('product_name');
		$product_price = $this->input->post('product_price');
		$product_quantity = $this->input->post('product_quantity');
		for($count = 0; $count < count($product_id); $count++) {
			$array[] = array(
				'id'		=> $product_id[$count],  
				'name'	=> $product_name[$count],
				'price'	=> $product_price[$count],
				'qty'		=> $product_quantity[$count]
			);
		}
		$data = $array;
		//print_r($data);die();
		$this->cart->insert($data);
		echo $this->show_cart();
	}
	
	function show_cart(){
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			$output .='
			<tr>
				<td>'.$items['name'].'</td>
				<td>'.$items['qty'].'</td>
				<td><button type="button" id="'.$items['rowid'].'" class="remove_cart btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i> Xóa</button></td>
			</tr>
			';
		}
		$output .= '
						<tr>
							<th colspan="2">Tổng cộng</th>
							<th>'.number_format($this->cart->total()).' đ</th>
						</tr>';
		return $output;
	}
	
	function delete_cart(){
		$data = array(
			'rowid' => $this->input->post('row_id'),
			'qty' => 0,
		);
		$this->cart->update($data);
		echo $this->show_cart();
	}
}
