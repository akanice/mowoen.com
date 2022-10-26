<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Upload_file 
    {
        public $CI = '';
        
        public function __construct()
        {
            $this->CI = & get_instance();
        }
        
        public function upload($upload_path = '', $file_name) {
            $config = $this->config($upload_path);
            $this->CI->load->library('upload', $config);
            if($this->CI->upload->do_upload($file_name)){
                $data = $this->CI->upload->data();
            } else {
                /* var_dump($this->CI->upload);die; */
                $data = $this->CI->upload->error_msg;
            }
            
            return $data;
        }
        
        public function upload_file($upload_path = '', $file_name = '') {
            $config = $this->config($upload_path);
            $file = $_FILES['gallery'];
            $count = count($file['name']);
            $gallery = array();
            
            for ($i = 0; $i <= $count-1; $i++)
            {
                $_FILES['userfile']['name'] = $file['name'][$i];
                $_FILES['userfile']['type'] = $file['type'][$i];
                $_FILES['userfile']['tmp_name'] = $file['tmp_name'][$i];
                $_FILES['userfile']['error'] = $file['error'][$i];
                $_FILES['userfile']['size'] = $file['size'][$i];
                    
                $this->CI->load->library('upload', $config);
                if($this->CI->upload->do_upload()){
                    $data = $this->CI->upload->data();
                    $gallery[] = $upload_path.$data['file_name'];
                }
            }
            return $gallery;
        }
        
        public function config($upload_path = '')
        {
            $config = array();
            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'jpg|png|gif|jpeg';
			$config['remove_space'] = TRUE;
            $config['max_size']      = '4096';
            // $config['max_width']     = '500';
            // $config['max_height']    = '500';
            
            return $config;
        }
    }