<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PostsMetaModel extends MY_Model {
    protected $tableName = 'posts_meta';
    
    protected $table = array(
        'id' =>  array(
            'isIndex'   => true,
            'nullable'  => false,
            'type'      => 'integer'
        ),
		'post_id' =>  array(
            'isIndex'   => true,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'meta_key' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
        'meta_value' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }

}