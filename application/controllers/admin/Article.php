<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends MY_Controller
{
    private $_modul_name = "Article";

    function __construct()
    {
        parent::__construct();
        $this->load->library('template');
        $this->template->set_platform('public');
        $this->template->set_theme('admin-lte');        
        $this->load->model('article_model');
    }

    public function index($page = 1)
    {       
        $total = $this->article_model->count_rows_without_trashed();

        $this->load->helper('dateindo');
        
        $this->template->set_title('APK2I | '.$this->_modul_name.' - List');
        $this->template->set_meta('author','Apk2i');
        $this->template->set_meta('keyword','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
        $this->template->set_meta('description','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
            
        $this->_loadcss();
        $this->_loadjs();
        $this->_loadpart();
        $this->template->set_part('scripts', 'scripts/admin/article-index');

        //get data
        //$this->post_model->paginate(10,$total_posts);
        $data['articles'] = $this->article_model->fields('id, name, filename, status, created_at')->order_by('created_at', 'DESC')->paginate($this->_PER_PAGE, $total, $page);
        $data['pagination'] = $this->generate_pagination(site_url('admin/article'), $total);

        $this->template->set_layout('layouts/main_admin');
        $this->template->set_content('pages/admin/article-index', $data);
        $this->template->render();
    }

    public function search($search, $page = 1)
    {       
        $total = $this->article_model->where('name', 'LIKE', $search)->count_rows_without_trashed();
        $this->load->helper('dateindo');
        
        $this->template->set_title('APK2I | '.$this->_modul_name.' - List');
        $this->template->set_meta('author','Apk2i');
        $this->template->set_meta('keyword','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
        $this->template->set_meta('description','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
            
        $this->_loadcss();
        $this->_loadjs();
        $this->_loadpart();
        $this->template->set_part('scripts', 'scripts/admin/article-index');

        //get data
        //$this->post_model->paginate(10,$total_posts);
        $data['articles'] = $this->article_model->fields('id, name, filename, status, created_at')->where('name', 'LIKE', $search)->order_by('created_at', 'DESC')->paginate($this->_PER_PAGE, $total, $page);
        $data['pagination'] = $this->generate_pagination(site_url('admin/article/search/'.$search.'/'), $total);
        $data['search'] = $search;

        $this->template->set_layout('layouts/main_admin');
        $this->template->set_content('pages/admin/article-index', $data);
        $this->template->render();
    }

    public function add()
    {       
        $this->load->helper('form');
        $this->template->set_title('APK2I | '.$this->_modul_name.' - Add');
        $this->template->set_meta('author','Apk2i');
        $this->template->set_meta('keyword','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
        $this->template->set_meta('description','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
            
        $this->_loadcss();
        $this->_loadjs_form();
        $this->_loadpart();
        $this->template->set_part('scripts', 'scripts/admin/article-add');

        $this->template->set_layout('layouts/main_admin');
        $this->template->set_content('pages/admin/article-add');
        $this->template->render();
    }

    public function update($id)
    {       
        $this->load->helper('form');
        $this->load->helper('dateindo');
        //get data
        $data['article'] =$this->article_model->fields('id, name, description')->get($id);

        if($id && $data['article']) {
            $this->load->helper('form');
            $this->template->set_title('APK2I | '.$this->_modul_name.' - Update');
            $this->template->set_meta('author','Apk2i');
            $this->template->set_meta('keyword','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
            $this->template->set_meta('description','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
                
            $this->_loadcss();
            $this->_loadjs_form();
            $this->_loadpart();
            $this->template->set_part('scripts', 'scripts/admin/article-update');

            $this->template->set_layout('layouts/main_admin');
            $this->template->set_content('pages/admin/article-update', $data);
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
        $input_image = 'image';
        $file = $_FILES[$input_file];
        $image = $_FILES[$input_image];

        if($file['name'] == '' || $image['name'] == '') {
            //if file not selected
            echo json_encode(array('status'=> FALSE, 'error' => 'File & Preview Image '.$this->_modul_name.' harap dipilih'));
        } else {
             /** UPLOAD FILE */
            $path_file = $file['type'] == 'application/pdf' ? "./upload/pdf/" : "./upload/word/";
            $config_file = array(
                'upload_path' => $path_file,
                'allowed_types' => 'pdf|doc|docx',
                //'max_size' => '2000',
                'encrypt_name' => TRUE
            );

            $result_file = $this->_upload_file($input_file, $file, $config_file);
            /** EOF UPLOAD FILE */

             /** UPLOAD IMAGE */
            $path_image = "./upload/images/";
            $config_image = array(
                'upload_path' => $path_image,
                'allowed_types' => 'jpg|jpeg|png',
                'max_size' => '2000',
                'encrypt_name' => TRUE
            );

            $result_image = $this->_upload_file($input_image, $image, $config_image);
            /** EOF UPLOAD IMAGE */

            if($result_file['status'] && $result_image['status']) {
                /** INSERT DATA */                
                $name = $this->input->post('name', TRUE);
                $description = $this->input->post('description', TRUE);
                $status = 'published';
                $filename = $result_file['filename'];
                $thumbnail = $result_image['filename'];

                //populate data
                $data = array(
                    'name' => $name,
                    'description' => $description,
                    'status' => $status,
                    'filename' => $filename,
                    'thumbnail' => $thumbnail,
                    'created_by' => user_login('id')
                );

                $id = $this->article_model->insert($data);

                if($id) {
                    $this->session->set_flashdata('success_message', 'Berhasil Menambah '.$this->_modul_name);
                    echo json_encode(array('status' => TRUE));
                } else {
                    echo json_encode(array('status' => FALSE, 'error' => 'Gagal Menambah '.$this->_modul_name));    
                }
                /** EOF INSERT DATA */
            } else {
                //if upload files failed or error
                    //set message rror
                    $message = "";

                    if($result_file['error'] != null) {
                        $message .= "File Error : ".$result_file['error']."<br />";
                    }
                    if($result_image['error'] != null) {
                        $message .= "Preview Image Error : ".$result_image['error']."<br />";
                    }
                    
                echo json_encode(array('status' => FALSE, 'error' => $message));
            }
        }
    }

    public function do_update() {
        if(!$this->input->is_ajax_request()) {
            redirect('admin','refresh');
        }        

        $input_file = 'file';
        $input_image = 'image';
        $file = $_FILES[$input_file];
        $image = $_FILES[$input_image];

        if($file['name'] != '') {
            /** UPLOAD FILE */
            $path_file = $file['type'] == 'application/pdf' ? "./upload/pdf/" : "./upload/word/";
            $config_file = array(
                'upload_path' => $path_file,
                'allowed_types' => 'pdf|doc|docx',
                //'max_size' => '2000',
                'encrypt_name' => TRUE
            );
            $result_file = $this->_upload_file($input_file, $file, $config_file);
        } else {
            $result_file = array('status' => TRUE, 'filename' => NULL);
        }
        /** EOF UPLOAD FILE */

        /** UPLOAD IMAGE */
        if($image['name'] != '') {
            $path_image = "./upload/images/";
            $config_image = array(
                'upload_path' => $path_image,
                'allowed_types' => 'jpg|jpeg|png',
                'max_size' => '2000',
                'encrypt_name' => TRUE
            );
            $result_image = $this->_upload_file($input_image, $image, $config_image);
        } else {
            $result_image = array('status' => TRUE, 'filename' => NULL);
        }
        /** EOF UPLOAD IMAGE */


        if($result_file['status'] && $result_image['status']) {
            /** INSERT DATA */
            $id = $this->input->post('id', TRUE);
            $article = $this->article_model->get($id);

            $name = $this->input->post('name', TRUE);
            $description = $this->input->post('description', TRUE);            
            $filename = $result_file['filename'] != null ? $result_file['filename'] : $article->filename;
            $thumbnail = $result_image['filename']!= null ? $result_image['filename'] : $article->thumbnail;
            
            //populate data
            $data = array(
                'name' => $name,
                'description' => $description,
                'filename' => $filename,
                'thumbnail' => $thumbnail,
                'updated_by' => user_login('id')
            );

            $id = $this->article_model->update($data, $id);

            if($id) {
                //remove old file
                if($result_file['filename'] != null && $article->filename != null) {
                    $filename_arr = explode(".", $article->filename);
                    $folder_ext = $filename_arr[1] == 'pdf' ? 'pdf' : 'word';
                    unlink('./upload/'.$folder_ext.'/'.$article->filename);
                }

                //remove old thumbnail
                if($result_image['filename'] != null && $article->thumbnail != null) {                
                    unlink('./upload/images/'.$article->thumbnail);
                }                

                $this->session->set_flashdata('success_message', 'Berhasil Mengubah '.$this->_modul_name);
                echo json_encode(array('status' => TRUE));
            } else {
                echo json_encode(array('status' => FALSE, 'error' => 'Gagal Mengubah '.$this->_modul_name));
            }
            /** EOF INSERT DATA */  
        } else {
            //if upload files failed or error
            //set message rror
            $message = "";
            
            if($result_image['error'] != null) {
                $message .= "File Error : ".$result_file['error']."<br />";
            }

            if($result_image['error'] != null) {
                $message .= "Preview Image Error : ".$result_image['error']."<br />";
            }

            echo json_encode(array('status' => FALSE, 'error' => $message));
        }
    }

    public function delete() {
        if(!$this->input->is_ajax_request()) {
            redirect('admin', 'refresh');
        }

        $id = $this->input->post('id', TRUE);

        $result = $this->article_model->delete($id); 

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
        $this->template->set_js('app.min.js','footer');
        $this->template->set_js('sweetalert.min.js','footer');
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