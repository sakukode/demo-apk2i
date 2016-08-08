<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends MY_Controller
{
    private $_modul_name = "Event";
 
    function __construct()
    {
        parent::__construct();
        $this->load->library('template');
        $this->template->set_platform('public');
        $this->template->set_theme('admin-lte');        
        $this->load->model('event_model');
    }

    public function index($page = 1)
    {       
        $total = $this->event_model->count_rows_without_trashed();

        $this->load->helper('dateindo');
        
        $this->template->set_title('APK2I | Event - List');
        $this->template->set_meta('author','Apk2i');
        $this->template->set_meta('keyword','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
        $this->template->set_meta('description','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
            
        $this->_loadcss();
        $this->_loadjs();
        $this->_loadpart();
        $this->template->set_part('scripts', 'scripts/admin/event-index');

        //get data
        //$this->post_model->paginate(10,$total_posts);
        $data['events'] = $this->event_model->fields('id, name, filename, status, created_at')->order_by('created_at', 'DESC')->paginate($this->_PER_PAGE, $total, $page);
        $data['pagination'] = $this->generate_pagination(site_url('admin/event'), $total);

        $this->template->set_layout('layouts/main_admin');
        $this->template->set_content('pages/admin/event-index', $data);
        $this->template->render();
    }

    public function search($search, $page = 1)
    {       
        $total = $this->event_model->where('name', 'LIKE', $search)->count_rows_without_trashed();
        $this->load->helper('dateindo');
        
        $this->template->set_title('APK2I | Event - List');
        $this->template->set_meta('author','Apk2i');
        $this->template->set_meta('keyword','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
        $this->template->set_meta('description','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
            
        $this->_loadcss();
        $this->_loadjs();
        $this->_loadpart();
        $this->template->set_part('scripts', 'scripts/admin/event-index');

        //get data
        //$this->post_model->paginate(10,$total_posts);
        $data['events'] = $this->event_model->fields('id, name, filename, status, created_at')->where('name', 'LIKE', $search)->order_by('created_at', 'DESC')->paginate($this->_PER_PAGE, $total, $page);
        $data['pagination'] = $this->generate_pagination(site_url('admin/event/search/'.$search.'/'), $total);
        $data['search'] = $search;

        $this->template->set_layout('layouts/main_admin');
        $this->template->set_content('pages/admin/event-index', $data);
        $this->template->render();
    }

    public function view($id)
    {       
        $this->load->helper('dateindo');
        //get data
        $data['event'] =$this->event_model->fields('id, name, filename, status, created_at, created_by')->get($id);

        if($id && $data['event']) {
            $this->template->set_title('APK2I | Event - View');
            $this->template->set_meta('author','Apk2i');
            $this->template->set_meta('keyword','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
            $this->template->set_meta('description','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
                
            $this->_loadcss();
            $this->_loadjs();
            $this->_loadpart();
            //$this->template->set_part('scripts', 'scripts/admin/event-view');

            $this->template->set_layout('layouts/main_admin');
            $this->template->set_content('pages/admin/event-view', $data);
            $this->template->render();
        } else {
            redirect('admin','refresh');
        }
    }

    public function add()
    {       
        $this->load->helper('form');

        $this->template->set_title('APK2I | Event - Add');
        $this->template->set_meta('author','Apk2i');
        $this->template->set_meta('keyword','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
        $this->template->set_meta('description','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
            
        $this->_loadcss();
        $this->_loadjs_form();
        $this->_loadpart();
        $this->template->set_part('scripts', 'scripts/admin/event-add');

        $this->template->set_layout('layouts/main_admin');
        $this->template->set_content('pages/admin/event-add');
        $this->template->render();
    }

    public function update($id)
    {       
        $this->load->helper('form');
        $this->load->helper('dateindo');
        //get data
        $data['event'] =$this->event_model->fields('id, name, status')->get($id);

        if($id && $data['event']) {
            $this->template->set_title('APK2I | Event - Update');
            $this->template->set_meta('author','Apk2i');
            $this->template->set_meta('keyword','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
            $this->template->set_meta('description','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
                
            $this->_loadcss();
            $this->_loadjs_form();
            $this->_loadpart();
            $this->template->set_part('scripts', 'scripts/admin/event-update');

            $this->template->set_layout('layouts/main_admin');
            $this->template->set_content('pages/admin/event-update', $data);
            $this->template->render();
        } else {
            redirect('admin','refresh');
        }
    }

    public function do_add() {
        if(!$this->input->is_ajax_request()) {
            redirect('admin','refresh');
        }        

        $input_file = 'file';
        $file = $_FILES[$input_file];

        if($file['name'] == '') {
            //if file not selected
            echo json_encode(array('status'=> FALSE, 'error' => 'File '.$this->_modul_name.' harap dipilih'));
        } else {

            $upload_path = $file['type'] == 'application/pdf' ? "./upload/pdf/" : "./upload/word/";

            /** UPLOAD FILE */
            $config = array(
                'upload_path' => $upload_path,
                'allowed_types' => 'pdf|doc|docx',
                //'max_size' => '2000',
                'encrypt_name' => TRUE
            );

            $result = $this->_upload_file($input_file, $file, $config);
            /** EOF UPLOAD FILE */

            if($result['status']) {
                /** INSERT DATA */                
                $name = $this->input->post('name', TRUE);
                $status = $this->input->post('status', TRUE);
                $filename = $result['filename'];

                //populate data
                $data = array(
                    'name' => $name,
                    'status' => $status,
                    'filename' => $filename,
                    'created_by' => user_login('id')
                );

                $id = $this->event_model->insert($data);

                if($id) {
                    $this->session->set_flashdata('success_message', 'Berhasil Menambah '.$this->_modul_name);
                    echo json_encode(array('status' => TRUE));
                } else {
                    echo json_encode(array('status' => FALSE, 'error' => 'Gagal Menambah '.$this->_modul_name));    
                }
                /** EOF INSERT DATA */
            } else {
                echo json_encode(array('status' => FALSE, 'error' => $result['error']));
            }
        }
    }

    public function do_update() {
        if(!$this->input->is_ajax_request()) {
            redirect('admin','refresh');
        }        

        $input_file = 'file';
        $file = $_FILES[$input_file];

        if($file['name'] != '') {
            $upload_path = $file['type'] == 'application/pdf' ? "./upload/pdf/" : "./upload/word/";
            /** UPLOAD FILE */
            $config = array(
                'upload_path' => $upload_path,
                'allowed_types' => 'pdf|doc|docx',
                //'max_size' => '2000',
                'encrypt_name' => TRUE
            );
            $result = $this->_upload_file($input_file, $file, $config);
        } else {
            $result = array('status' => TRUE, 'filename' => NULL);
        }
        /** EOF UPLOAD FILE */
        
        if($result['status']) {
            /** INSERT DATA */
            $id = $this->input->post('id', TRUE);
            $name = $this->input->post('name', TRUE);
            $status = $this->input->post('status', TRUE);
            $filename = $result['filename'];

            $event = $this->event_model->get($id);
            //populate data
            if($result['filename'] != NULL) {
                $data = array(
                    'name' => $name,
                    'status' => $status,
                    'filename' => $filename,
                    'updated_by' => user_login('id')
                );
            } else {
                $data = array(
                    'name' => $name,
                    'status' => $status,               
                    'updated_by' => user_login('id')
                );
            }

            $id = $this->event_model->update($data, $id);

            if($id) {
                //remove old file
                if($result['filename'] != null && $event->filename != null) {
                    $filename_arr = explode(".", $event->filename);
                    $folder_ext = $filename_arr[1] == 'pdf' ? 'pdf' : 'word';
                    unlink('./upload/'.$folder_ext.'/'.$event->filename);
                }

                $this->session->set_flashdata('success_message', 'Berhasil Mengubah '.$this->_modul_name);
                echo json_encode(array('status' => TRUE));
            } else {
                echo json_encode(array('status' => FALSE, 'error' => 'Gagal Mengubah '.$this->_modul_name));
            }
            /** EOF INSERT DATA */
        } else {
            echo json_encode(array('status' => FALSE, 'error' => $result['error']));
        }
    }

    public function delete() {
        if(!$this->input->is_ajax_request()) {
            redirect('admin', 'refresh');
        }

        $id = $this->input->post('id', TRUE);

        $result = $this->event_model->delete($id); 

        if($result) {
            $this->session->set_flashdata('success_message', 'Berhasil Menghapus '.$this->_modul_name);
            echo json_encode(array('status' => TRUE));
        } else {
            $this->session->set_flashdata('error_message', 'Gagal Menghapus '.$this->_modul_name);
            echo json_encode(array('status' => FALSE));
        }
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
        $this->template->set_css('sweetalert.min.css');
    }

    protected function _loadjs() {      
        $this->template->set_js('jquery-2.2.3.min.js','footer');
        $this->template->set_js('bootstrap.min.js','footer');
        $this->template->set_js('sweetalert.min.js','footer');      
        $this->template->set_js('app.min.js','footer');
    }

    protected function _loadjs_form() {      
        $this->template->set_js('jquery-2.2.3.min.js','footer');
        $this->template->set_js('bootstrap.min.js','footer');
        $this->template->set_js('jquery.validate.min.js','footer');    
        $this->template->set_js('additional-methods.min.js','footer');
        $this->template->set_js('bootstrap-filestyle.min.js','footer');        
        $this->template->set_js('app.min.js','footer');
    }
}