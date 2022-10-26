<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Upload extends MY_Controller {
        public function index($upload_path='./uploads/product',$name='image') {
            if($this->input->post('submit')) {
                $this->load->library('upload_file');
-               $upload_path = './uploads/post';
                $data = $this->upload_file->upload($upload_path, $name);
            }
            $this->data['temp'] = 'backend/upload/index';
            $this->load->view('backend/index', $this->data);
            
        }
        
        public function upload_file($upload_path='./uploads/product',$name='gallery') {
            if($this->input->post('submit')) {
                $this->load->library('upload_file');
                $data = $this->upload_file->upload_file($upload_path, $name);
            }
            $this->data['temp'] = 'backend/upload/upload_file';
            $this->load->view('backend/index', $this->data);
        }
    }

