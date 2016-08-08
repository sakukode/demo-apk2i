<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
 
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('template', 'form_validation'));
        $this->load->helper(array('form'));
        $this->template->set_platform('public');
        $this->template->set_theme('admin-lte');        
    }

    public function login()
    {       
        if($this->ion_auth->logged_in()) {
            redirect('admin','refresh');
        }

        $this->template->set_title('APK2I | Login');
        $this->template->set_meta('author','Apk2i');
        $this->template->set_meta('keyword','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
        $this->template->set_meta('description','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
            
        $this->_loadcss();
        $this->_loadjs();
        $this->template->set_part('notifications', 'parts/notifications_admin');
        $this->template->set_part('script', 'scripts/admin/login');

        $this->template->set_layout('layouts/login');
        $this->template->set_content('pages/admin/login');
        $this->template->render();
    }

    public function do_login() {

        if($this->ion_auth->logged_in()) {
            redirect('admin/dashboard', 'refresh');
        }

        //validate form input
        $this->form_validation->set_rules('identity', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        //set message
        $this->form_validation->set_message('required', '{field} harus diisi');

        if ($this->form_validation->run() === true)
        {
            // check to see if the user is logging in
            // check for "remember me"
            $remember = (bool) $this->input->post('remember');
            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
            {
                //if the login is successful
                //redirect them back to the home page
                $this->session->set_flashdata('success_message', $this->ion_auth->messages());
                echo json_encode(array('status' => true));
            }
            else
            {
                // if the login was un-successful                
                echo json_encode(array('status' => false, 'message' => $this->ion_auth->errors()));
            }
        }
        else
        {
            $message = validation_errors();
            
            echo json_encode(array('status' => false, 'message' => $message));
        }
    }

     // log the user out
    public function logout()
    {
        // log the user out
        $logout = $this->ion_auth->logout();

        // redirect them to the login page
        $this->session->set_flashdata('success_message', $this->ion_auth->messages());
        redirect('admin/login', 'refresh');
    }


    protected function _loadcss() {
        $this->template->set_css('bootstrap.min.css');        
        $this->template->set_css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css', 'remote');        
        $this->template->set_css('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css', 'remote');        
        $this->template->set_css('AdminLTE.min.css');
        $this->template->set_css('icheck-square-blue.css');
    }

    protected function _loadjs() {      
        $this->template->set_js('jquery-2.2.3.min.js','footer');
        $this->template->set_js('bootstrap.min.js','footer');           
        $this->template->set_js('icheck.min.js','footer');
    }
}