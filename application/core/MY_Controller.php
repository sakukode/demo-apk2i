<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	 protected $_PER_PAGE = 15;

        public function __construct()
        {
            parent::__construct();

            if (!$this->ion_auth->logged_in()) {
            	redirect('admin/login');
			}
        }


        public function generate_pagination($url, $total) {
        	$this->load->library('pagination');
	        $config['base_url'] = $url;
	        $config['total_rows'] = $total;
	        $config['per_page'] = $this->_PER_PAGE;
	        $config['use_page_numbers'] = TRUE;
	        //config for bootstrap pagination class integration
	        $config['full_tag_open'] = '<ul class="pagination">';
	        $config['full_tag_close'] = '</ul>';
	        $config['first_link'] = false;
	        $config['last_link'] = false;
	        $config['first_tag_open'] = '<li>';
	        $config['first_tag_close'] = '</li>';
	        $config['prev_link'] = '&laquo';
	        $config['prev_tag_open'] = '<li class="prev">';
	        $config['prev_tag_close'] = '</li>';
	        $config['next_link'] = '&raquo';
	        $config['next_tag_open'] = '<li>';
	        $config['next_tag_close'] = '</li>';
	        $config['last_tag_open'] = '<li>';
	        $config['last_tag_close'] = '</li>';
	        $config['cur_tag_open'] = '<li class="active"><a href="#">';
	        $config['cur_tag_close'] = '</a></li>';
	        $config['num_tag_open'] = '<li>';
	        $config['num_tag_close'] = '</li>';

	        $this->pagination->initialize($config);

	        return $this->pagination->create_links();
        }

     /**
     * Upload File Icon
     * @param  String $name   input[type file] name
     * @param  Object $file   file
     * @param  Object $config config library upload
     * @return Object         
     */
    protected function _upload_file($name, $file, $config) {
        //process upload picture
        $this->load->library('upload');
        $this->upload->initialize($config);
        //validation upload FALSE
        if(!$this->upload->do_upload($name))
        {
            $response = array(
                'status'  => FALSE,
                'error' => $this->upload->display_errors()
            );
            
            return $response;
        }
        else//validation upload TRUE/success
        {
            $upload    = $this->upload->data();
            $filename  = $upload['file_name'];

            $response = array(
                'status' => TRUE,
                'filename' => $filename,
                'error' => ''
            );
        
            return $response;
        }
    }

    protected function _generate_slug($name, $table, $id= null) {
        $this->load->model('base_model');

        $slug = url_title(strtolower($name));
        $result = $this->base_model->check_exist_slug($slug, $table, $id);

        if($result == FALSE) {
            return $slug;
        } else {
            $random_number = mt_rand();
            $slug .= "-".$random_number;
            return $slug;
        }
    }
}