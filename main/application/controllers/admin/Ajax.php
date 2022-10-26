<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ajax extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->data = array();
    }

    public function loadUrl() {
        if ($_POST['dataString']) {
            $type_url = $_POST['dataString'];
            switch ($type_url) {
                case "t_landing":
                    $this->load->model('newsmodel');
                    $data = $this->newsmodel->read(array("type" => 'landing'));
                    break;
                case "t_cat":
                    $this->load->model('newscategorymodel');
                    $data = $this->newscategorymodel->read(array());
                    break;
                case "t_page":
                    $this->load->model('pagesmodel');
                    $data = $this->pagesmodel->read(array());
                    break;
				case "t_link":
                    $data = null;
                    break;
                default:
                    $data = '';
            }
            if ($data && $data != '') {
                echo '<select name="slug" class="form-control">';
				foreach ($data as $item) {
                    $title = $item->title;
                    $id = $item->id;
                    echo '<option value="' . $id . '">' . $title . '</option>';
                }
				echo '</select>';
			} elseif ($data === null) {
				echo '<input type="text" class="form-control" value="" name="slug">';	
            } else {
				echo '<select name="slug" class="form-control">';
				echo '<option value="">--- Chọn ---</option>';
				echo '</select>';
            }
        }
    }
	
	public function load_categories() {
        if ($_POST['dataString']) {
            $type_url = $_POST['dataString'];
            switch ($type_url) {
                case "bath":
                    $this->load->model('productscategorymodel');
                    $data = $this->productscategorymodel->read(array("type" => 'bathroom'));
                    break;
                case "kitchen":
                    $this->load->model('productscategorymodel');
                    $data = $this->productscategorymodel->read(array("type" => 'kitchen'));
                    break;
                default:
                    $data = '';
            }
            if ($data && $data != '') {
				foreach ($data as $item) {
                    echo '<label class="checkbox">';
                    echo '<span class="icons"><span class="first-icon fa fa-square-o"></span><span class="second-icon fa fa-check-square-o"></span></span>';
					 $title = $item->title;
                    $id = $item->id;
                    echo '<input ype="checkbox" name="categoryid[]" data-toggle="checkbox" value="' . $id . '">' . $title;
					echo '</label>';
                }
			} elseif ($data === null) {
				echo 'Xin hãy chọn loại sản phẩm trước';	
            } else {
				echo 'Xin hãy chọn loại sản phẩm trước';	
            }
        }
    }

    public function searchUser() {
        $userName = $_POST['username'];
        $this->load->model('affiliatesmodel');
        $result = $this->affiliatesmodel->getListUserAvailForAffi($userName);
        echo json_encode($result);
    }
	
	public function delete_comment() {
		$this->load->model('commentsmodel');
		$id = $this->input->post('comment_id');
		if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->commentsmodel->delete(array('id'=>$id));
        }
		return false;
	}
}
