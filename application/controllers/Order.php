<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Order extends MY_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->model('usersmodel');
			$this->load->model('ordersmodel');
			$this->load->library('cart');
        }
        
        public function checkout() {
            $this->data['title'] = 'Thanh toán';
			
			$this->data['carts'] = $carts = $this->cart->contents();
            $this->data['total_items'] = $total_items = $this->cart->total_items();
            if($total_items <= 0){
                redirect();
            }
            $total_amount = 0;
            foreach($carts as $row) {
                $total_amount = $total_amount + $row['subtotal'];
            }
            $this->data['total_amount'] = $total_amount;
            // If user logged in
            $user_id = 0;
            if($this->session->userdata('userid')){
                $user_id = $this->session->userdata('userid');
                $user = $this->usersmodel->read(array('id'=>$user_id),array(),true);
            }
            if(isset($user)){
                $this->data['user'] = $user;
            } else{
                $this->data['user'] = NULL;
            }
            $this->load->library('form_validation');
            $this->load->helper('form');
            
            if($this->input->post()){                
				if(!isset($user)) {
					$data = array(
						'name' => $this->input->post('guest_name'),
						'user_code' => generateUserCode($length=10),
						'email' => $this->input->post('guest_email'),
						'phone' => $this->input->post('guest_phone'),
						'address' => $this->input->post('guest_address'),
						'role' => 'normal',
						'create_time' => time()
					);
					$this->load->model('usersmodel');
					$user_id = $this->usersmodel->create($data);
				}
				
				$user_code = $this->input->post('affiliate');
				if ($user_code && $user_code !='') {
					$affiliate_id = $this->usersmodel->read(array('user_code'=>$user_code,'role'=>'affiliate'),array(),true)->id;
				} else {
					$affiliate_id = null;
				}
				$data = array(
					"code" => generateUserCode($length=10),
					'status' => 'pending',
					'customer_id' =>$user_id, 
					'affiliate_id' =>$affiliate_id,
					'note' => $this->input->post('message'),
					'total_price' => $total_amount,
					'type' => 'product',
					'payment' => $this->input->post('payment'),
					'create_time' => time()
				);
				$data;
				$order_id = $this->ordersmodel->create($data);
				//Thêm vào bảng chi tiết đơn hàng
				$this->load->model('orderdetailsmodel');
				foreach ($carts as $row) {
					$data = array(
						'order_id' => $order_id, 
						'product_id' => $row['id'],
						'quantity' => $row['qty'],
						'total' => $row['subtotal'],
					);
					$this->orderdetailsmodel->create($data);
				}
				$this->cart->destroy();
				$this->session->set_flashdata('message', 'Bạn đã đặt hàng thành công, chúng tôi sẽ liên hệ để kiểm tra đặt hàng');
				redirect(base_url());
            }
            
            //lấy thông tin thành viên
            $user_id = $this->session->userdata('userid');
            $user = $this->usersmodel->read(array('id'=>$user_id),array(),true);
            
            $this->data['temp'] = 'frontend/order/checkout';
            $this->load->view('frontend/index', $this->data);
        }
    }
