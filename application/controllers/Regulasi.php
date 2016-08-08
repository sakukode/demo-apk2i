<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regulasi extends CI_Controller
{
     protected $_PER_PAGE = 10;
 
    function __construct()
    {
        parent::__construct();
        $this->load->library('template');
        $this->template->set_platform('public');
        $this->template->set_theme('default');        
        $this->load->model('regulasi_model');
    }

    public function index($page = 1)
    {       
        $total = $this->regulasi_model->count_rows_without_trashed();
        $this->load->helper('dateindo');

        $this->template->set_title('Asosiasi Pengusaha Kesehatan Dan Kecantikan Indonesia');
        $this->template->set_meta('author','Apk2i');
        $this->template->set_meta('keyword','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
        $this->template->set_meta('description','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
            
        $this->_loadcss();
        $this->_loadjs();
        $this->_loadpart();

        //get data
        $data['regulations'] = $this->regulasi_model->fields('id, name, filename, status, created_at')->order_by('created_at', 'DESC')->paginate($this->_PER_PAGE, $total, $page);
        $data['pagination'] = $this->generate_pagination(site_url('regulasi'), $total);

        $this->template->set_layout('layouts/main');
        $this->template->set_content('pages/regulasi', $data);
        $this->template->render();
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


   
    protected function _loadpart() {
        $this->template->set_part('header', 'parts/header');  
        $this->template->set_part('footer', 'parts/footer');
    }


    protected function _loadcss() {
        $this->template->set_css('bootstrap.css');        
        $this->template->set_css('style.css');
        $this->template->set_css('https://fonts.googleapis.com/css?family=Voltaire', 'remote');
        $this->template->set_css('https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic', 'remote');
        $this->template->set_css('chocolat.css');        
    }

    protected function _loadjs() {      
        $this->template->set_js('jquery-1.11.1.min.js','header');
        $this->template->set_js('bootstrap.js','header');    
        $this->template->set_js('modernizr.custom.97074.js','header');
        $this->template->set_js('jquery.chocolat.js','header');
        $this->template->set_js('jquery.hoverdir.js','header');        
    }
}