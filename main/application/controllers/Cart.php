<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Cart extends MY_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->library('cart');
			$this->load->model('ordersmodel');
        }
        
        public function add() {
            //lấy ra sản phẩm muốn thêm vào giỏ hàng
            $this->load->model('productsmodel');
            $id = $this->uri->rsegment(3);
            $product = $this->productsmodel->read(array('id'=>$id),array(),true);
            if(!$product){
                redirect();
            }
            
            //tổng số sản phẩm
            $quantity = $this->input->post('quantity');
            $price = $product->price;
            if($product->sale_price > 0) {
                $price = $product->sale_price;
            }
            $data = array(
				'id' => $product->id,
				'qty' => $quantity,
				'name' => $product->title,
				'thumb' => $product->thumb,
				'price' => $price,
			);
			$this->cart->insert($data);
			$carts = $this->cart->contents();
            //Chuyển sang trang danh sách sản phẩm trong giỏ hàng
            redirect(base_url('cart'));
        }
        
        //Hiển thị danh sách sản phẩm trong giỏ hàng
        public function index() {
            $this->data['title'] = 'Giỏ hàng';
			// thông tin giỏ hàng
            $carts = $this->cart->contents();
            
			// print_r($carts);die();
            //Tổng số sản phẩm có trong giỏ hàng
            $total_items = $this->cart->total_items();
            $this->data['carts'] = $carts;
            $this->data['total_items'] = $total_items;
			
			if($this->input->post()) {
				$total_amount = 0;
				foreach($carts as $row) {
					$total_amount = $total_amount + $row['subtotal'];
				}
				$this->data['total_amount'] = $total_amount;
				
				$data = array(
					'status' => 'pending',
					'name' =>$this->input->post('f_name'), 
					'phone' =>$this->input->post('f_phone'), 
					'email' =>'', 
					'address' =>'', 
					'signature' => '',
					'note' => $this->input->post('f_note'),
					'total_price' => $total_amount,
					'type' => 'product',
					'code' => generateUserCode($length=10),
					'payment' => $this->input->post('f_payment'),
					'create_time' => time(),
				);
				//print_r($data);die();
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
				// redirect(base_url());
				redirect(base_url('success'));
				// $this->data['temp'] = 'frontend/cart/success';
				// $this->load->view('frontend/index', $this->data);
			}
			
			$this->data['meta_title'] = 'Đặt hàng';
			$this->data['meta_description'] = 'Đặt hàng';
			$this->data['meta_keywords'] = 'Đặt hàng';
			
			$this->data['temp'] = 'frontend/cart/index';
            $this->load->view('frontend/index', $this->data);
        }
        
		public function success() {
			if ($this->session->flashdata('message')) {
				$this->data['title']  = 'Đặt hàng thành công';
				$this->data['temp'] = 'frontend/cart/success';
				$this->load->view('frontend/index', $this->data);
			} else {
				redirect(base_url(''));
			}
		}
        public function update() {
            $carts = $this->cart->contents();
            foreach ($carts as $key => $row) {
                $total_qty = $this->input->post('qty_'.$row['id']);
                $data = array();
                $data['rowid'] = $key;
                $data['qty'] = $total_qty;
                $this->cart->update($data);
            }
            redirect(base_url('cart'));
        }
        
        public function del() {
            $id = $this->uri->rsegment(3);
            $id = intval($id);
            //Trường hợp xóa 1 sản phẩm nào đó trong giỏ hàng
            if($id > 0){
                $carts = $this->cart->contents();
                foreach ($carts as $key => $row) {
                    if($row['id'] == $id){
                        $data = array();
                        $data['rowid'] = $key;
                        $data['qty'] = 0;
                        $this->cart->update($data);
                    }
                }
            } else {
                //xóa toàn bộ giỏ hàng
                $this->cart->destroy();
            }
            redirect(base_url('cart'));
        }
		
		function delete_cart(){ 
			$this->cart->destroy();
		}
    }
    
    
    
    
    