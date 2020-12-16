<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class VideosModel extends MY_Model {
    protected $tableName = 'videos';

    protected $table = array(
        'id' =>  array(
            'isIndex'   => true,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'title' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'alias' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'url' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'id_youtube' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'thumb' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'create_time' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }
	
	public function getRelatedVideos($alias,$limit){
		$this->db->select("videos.*");
		$this->db->where("videos.alias != ",$alias);
		$this->db->order_by('id','desc');
		$query  =   $this->db->get('videos',$limit);
		if($query->num_rows()>0) return $query->result();
		else return false;
	}
	
	public function getRandomListVideos($alias,$limit){
		$this->db->select("videos.*");
		$this->db->where("videos.alias != ",$alias);
		$this->db->order_by('id','RANDOM');
		$query  =   $this->db->get('videos',$limit);
		if($query->num_rows()>0) return $query->result();
		else return false;
	}
}