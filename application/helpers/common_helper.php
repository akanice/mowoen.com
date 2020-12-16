<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class common_helper 
    {
        public static function front_end($url = '')
        {
            return base_url('public/frontend/'.$url);
        }
        
        public static function back_end($url = '')
        {
            return base_url('public/backend/'.$url);
        }
        
        public static function tinymce_url()
        {
            return base_url('public/tinymce/');
        }
        
        public static function user_url($url = '')
        {
            return base_url($url);
        }
        
        public static function pre($list, $exist = true)
        {
            echo "<pre>";
            print_r($list);
            if($exist){
                die();
            }
        }
    }