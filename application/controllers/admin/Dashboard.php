<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
 
    function __construct()
    {
        parent::__construct();
        $this->load->library('template');
        $this->template->set_platform('public');
        $this->template->set_theme('admin-lte');        
    }

    public function index()
    {       
        $this->load->helper('dateindo');
        $this->load->model(array('event_model', 'article_model', 'gallery_model', 'regulasi_model'));

        $data['total_event'] = $this->event_model->count_rows_without_trashed();
        $data['total_article'] = $this->article_model->count_rows_without_trashed();
        $data['total_gallery'] = $this->gallery_model->count_rows_without_trashed();
        $data['total_regulasi'] = $this->regulasi_model->count_rows_without_trashed();

        $data['current_event'] = $this->event_model->limit(3)->order_by('created_at', 'DESC')->get_all();
        $data['current_article'] = $this->article_model->limit(3)->order_by('created_at', 'DESC')->get_all();
        $data['current_gallery'] = $this->gallery_model->limit(3)->order_by('created_at', 'DESC')->get_all();
        $data['current_regulasi'] = $this->regulasi_model->limit(3)->order_by('created_at', 'DESC')->get_all();


        $this->template->set_title('APK2I | Dashboard');
        $this->template->set_meta('author','Apk2i');
        $this->template->set_meta('keyword','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
        $this->template->set_meta('description','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
            
        $this->_loadcss();
        $this->_loadjs();
        $this->_loadpart();

        $this->template->set_layout('layouts/main_admin');
        $this->template->set_content('pages/admin/dashboard', $data);
        $this->template->render();
    }

   
    protected function _loadpart() {
        $this->template->set_part('header', 'parts/header_admin');  
        $this->template->set_part('sidebar', 'parts/sidebar_admin');
        $this->template->set_part('notifications', 'parts/notifications_admin'); 
        $this->template->set_part('footer', 'parts/footer_admin');
        $this->template->set_part('control_sidebar', 'parts/control_sidebar_admin');
    }


    protected function _loadcss() {
        $this->template->set_css('bootstrap.min.css');        
        $this->template->set_css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css', 'remote');        
        $this->template->set_css('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css', 'remote');        
        $this->template->set_css('AdminLTE.min.css');
        $this->template->set_css('skin-blue.min.css');
    }

    protected function _loadjs() {      
        $this->template->set_js('jquery-2.2.3.min.js','footer');
        $this->template->set_js('bootstrap.min.js','footer');    
        $this->template->set_js('app.min.js','footer');
    }
}