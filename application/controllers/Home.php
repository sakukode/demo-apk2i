<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
 
    function __construct()
    {
        parent::__construct();
        $this->load->library('template');
        $this->template->set_platform('public');
        $this->template->set_theme('default');        
    }

    public function index()
    {       
        $this->load->model(array('article_model', 'event_model', 'gallery_model'));

        $this->template->set_title('Asosiasi Pengusaha Kesehatan Dan Kecantikan Indonesia');
        $this->template->set_meta('author','Apk2i');
        $this->template->set_meta('keyword','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
        $this->template->set_meta('description','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
            
        $this->_loadcss();
        $this->_loadjs();
        $this->_loadpart();

        //newest article
        $data['articles'] = $this->article_model->limit(2)->order_by('created_at', 'DESC')->get_all();
        //latest event
        $data['latest_event'] = $this->event_model->fields('filename')->limit(1)->order_by('created_at', 'DESC')->get();
        //newest gallery
        $data['galleries'] = $this->gallery_model->fields('name, thumbnail, slug')->limit(3)->order_by('created_at', 'DESC')->get_all();

        $this->template->set_layout('layouts/main');
        $this->template->set_content('pages/home', $data);
        $this->template->render();
    }

   
    protected function _loadpart() {
        $this->template->set_part('header', 'parts/header');  
        $this->template->set_part('banner', 'parts/banner');       
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