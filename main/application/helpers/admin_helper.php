<?php
    if (!defined('BASEPATH')) exit ('No direct script access allowed');
    
    class Admin_helper 
    {
        public static function admin_url($url = '')
        {
            return base_url('admin/'.$url);
        }
    }