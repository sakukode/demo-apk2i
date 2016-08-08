<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends MY_Controller
{
    private $_modul_name = "Galeri";

    function __construct()
    {
        parent::__construct();
        $this->load->library('template');
        $this->template->set_platform('public');
        $this->template->set_theme('admin-lte');    
        $this->load->model('gallery_model');
    }

    public function index($page = 1)
    {       
        $total = $this->gallery_model->count_rows_without_trashed();

        $this->load->helper('dateindo');
        
        $this->template->set_title('APK2I | '.$this->_modul_name.' - List');
        $this->template->set_meta('author','Apk2i');
        $this->template->set_meta('keyword','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
        $this->template->set_meta('description','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
            
        $this->_loadcss();
        $this->_loadjs();
        $this->_loadpart();
        $this->template->set_part('scripts', 'scripts/admin/gallery-index');

        //get data
        $data['galleries'] = $this->gallery_model->fields('id, name, thumbnail, status, created_at')->order_by('created_at', 'DESC')->paginate($this->_PER_PAGE, $total, $page);
        $data['pagination'] = $this->generate_pagination(site_url('admin/gallery'), $total);

        $this->template->set_layout('layouts/main_admin');
        $this->template->set_content('pages/admin/gallery-index', $data);
        $this->template->render();
    }

    public function search($search, $page = 1)
    {       
        $total = $this->gallery_model->where('name', 'LIKE', $search)->count_rows_without_trashed();
        $this->load->helper('dateindo');
        
        $this->template->set_title('APK2I | '.$this->_modul_name.' - List');
        $this->template->set_meta('author','Apk2i');
        $this->template->set_meta('keyword','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
        $this->template->set_meta('description','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
            
        $this->_loadcss();
        $this->_loadjs();
        $this->_loadpart();
        $this->template->set_part('scripts', 'scripts/admin/gallery-index');

        //get data
        $data['galleries'] = $this->gallery_model->fields('id, name, thumbnail, status, created_at')->where('name', 'LIKE', $search)->order_by('created_at', 'DESC')->paginate($this->_PER_PAGE, $total, $page);
        $data['pagination'] = $this->generate_pagination(site_url('admin/gallery/search/'.$search.'/'), $total);
        $data['search'] = $search;

        $this->template->set_layout('layouts/main_admin');
        $this->template->set_content('pages/admin/gallery-index', $data);
        $this->template->render();
    }

    public function view($id)
    {       
        $this->load->helper(array('dateindo', 'form'));
        //get data
        $data['gallery'] =$this->gallery_model->fields('id, name, description, thumbnail, status, created_at, created_by')->with_videos()->with_images()->get($id);

        if($id && $data['gallery']) {
            $this->template->set_title('APK2I | '.$this->_modul_name.' - View');
            $this->template->set_meta('author','Apk2i');
            $this->template->set_meta('keyword','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
            $this->template->set_meta('description','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
                
            $this->_loadcss();
            $this->_loadjs_form();
            $this->_loadpart();
            $this->template->set_part('scripts', 'scripts/admin/gallery-view');

            $this->template->set_layout('layouts/main_admin');
            $this->template->set_content('pages/admin/gallery-view', $data);
            $this->template->render();
        } else {
            redirect('admin','refresh');
        }
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

        $this->template->set_part('scripts', 'scripts/admin/gallery-add');

        $this->template->set_layout('layouts/main_admin');
        $this->template->set_content('pages/admin/gallery-add');
        $this->template->render();
    }

    public function update($id)
    {       
        $this->load->helper('form');
        //get data
        $data['gallery'] =$this->gallery_model->fields('id, name, description')->get($id);

        if($id && $data['gallery']) {
            $this->template->set_title('APK2I | '.$this->_modul_name.' - Update');
            $this->template->set_meta('author','Apk2i');
            $this->template->set_meta('keyword','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
            $this->template->set_meta('description','Asosiasi Pengusaha Kecantikan & Kesehatan Indonesia');
                
            $this->_loadcss();
            $this->_loadjs_form();
            $this->_loadpart();

            $this->template->set_part('scripts', 'scripts/admin/gallery-update');

            $this->template->set_layout('layouts/main_admin');
            $this->template->set_content('pages/admin/gallery-update', $data);
            $this->template->render();
        } else {
            redirect('admin','refresh');
        }
    }

    public function do_add() {
        if(!$this->input->is_ajax_request()) {
            redirect('admin','refresh');
        }        

        $input_image = 'image';
        $image = $_FILES[$input_image];

        if($image['name'] == '') {
            //if file not selected
            echo json_encode(array('status'=> FALSE, 'error' => 'Preview Image '.$this->_modul_name.' harap dipilih'));
        } else {
             /** UPLOAD IMAGE */
            $path = "./upload/images/";
            $config = array(
                'upload_path' => $path,
                'allowed_types' => 'jpg|jpeg|png',
                'max_size' => '2000',
                'encrypt_name' => TRUE
            );

            $result = $this->_upload_file($input_image, $image, $config);
            /** EOF UPLOAD IMAGE */

            if($result['status']) {
                /** INSERT DATA */                
                $name = $this->input->post('name', TRUE);
                $slug = $this->_generate_slug($name, 'galleries');
                $description = $this->input->post('description', TRUE);
                $status = 'published';
                $thumbnail = $result['filename'];

                //populate data
                $data = array(
                    'name' => $name,
                    'description' => $description,
                    'status' => $status,
                    'slug' => $slug,
                    'thumbnail' => $thumbnail,
                    'created_by' => user_login('id')
                );

                $id = $this->gallery_model->insert($data);

                if($id) {
                    $this->session->set_flashdata('success_message', 'Berhasil Menambah '.$this->_modul_name);
                    echo json_encode(array('status' => TRUE));
                } else {
                    echo json_encode(array('status' => FALSE, 'error' => 'Gagal Menambah '.$this->_modul_name));    
                }
                /** EOF INSERT DATA */
            } else {
                //if upload files failed or error
                echo json_encode(array('status' => FALSE, 'error' => $result['error']));
            }
        }
    }

    public function do_update() {
        if(!$this->input->is_ajax_request()) {
            redirect('admin','refresh');
        }        

        $input_image = 'image';
        $image = $_FILES[$input_image];

        /** UPLOAD IMAGE */
        if($image['name'] != '') {
            $path = "./upload/images/";
            $config = array(
                'upload_path' => $path,
                'allowed_types' => 'jpg|jpeg|png',
                'max_size' => '2000',
                'encrypt_name' => TRUE
            );

            $result = $this->_upload_file($input_image, $image, $config);
        } else {
            $result = array('status'=> TRUE, 'filename'=> NULL);
        }
        /** EOF UPLOAD IMAGE */

        if($result['status']) {
            /** INSERT DATA */
            $id = $this->input->post('id', TRUE);
            $name = $this->input->post('name', TRUE);
            $slug = $this->_generate_slug($name, 'galleries', $id);
            $description = $this->input->post('description', TRUE);
            $status = 'published';
    
            if($result['filename'] == NULL) {
                //populate data
                $data = array(
                    'name' => $name,
                    'description' => $description,
                    'slug' => $slug,
                    'updated_by' => user_login('id')
                );
            } else {
                //populate data
                $data = array(
                    'name' => $name,
                    'description' => $description,           
                    'slug' => $slug,
                    'thumbnail' => $result['filename'],
                    'updated_by' => user_login('id')
                );                
            }

            $response = $this->gallery_model->update($data, $id);

            if($response) {
                $this->session->set_flashdata('success_message', 'Berhasil Mengubah '.$this->_modul_name);
                echo json_encode(array('status' => TRUE));
            } else {
                echo json_encode(array('status' => FALSE, 'error' => 'Gagal Mengubah '.$this->_modul_name));
            }
        /** EOF INSERT DATA */
        } else {
            //if upload files failed or error
            echo json_encode(array('status' => FALSE, 'error' => $result['error']));
        }
    }

    public function delete() {
        if(!$this->input->is_ajax_request()) {
            redirect('admin', 'refresh');
        }

        $id = $this->input->post('id', TRUE);

        $result = $this->gallery_model->delete($id); 

        if($result) {
            $this->session->set_flashdata('success_message', 'Berhasil Menghapus '.$this->_modul_name);
            echo json_encode(array('status' => TRUE));
        } else {
            $this->session->set_flashdata('error_message', 'Gagal Menghapus '.$this->_modul_name);
            echo json_encode(array('status' => FALSE));
        }
    }

    public function save_videos($id) {
        $this->load->model('gallery_videos_model');
        $video_ids = $this->input->post('video_id', TRUE);
        $video_urls = $this->input->post('video_url', TRUE);

        if($id) {
            for ($i=0; $i < count($video_ids); $i++) { 
                $data = array(
                    'url' => $video_urls[$i]
                );

                $result = $this->gallery_videos_model->update($data, $video_ids[$i]);

                if($result == FALSE) {
                    echo json_encode(array('status'=> FALSE, 'error'=> 'Gagal Mengupdate Video'));
                    break;
                }
            }

            echo json_encode(array('status'=> TRUE, 'message'=> 'Berhasil Mengupdate Video'));
        }
    }

    public function save_image($id) {
        $this->load->model('gallery_images_model');

        if(!$this->input->is_ajax_request()) {
            redirect('/');
        }  

        if($id) {
            //insert file image
            $image = 'image';
            $file = $_FILES[$image];
            $config = array(
                'upload_path' => './upload/images/',
                'allowed_types' => 'png|jpeg|jpg',
                'max_size' => '2000',
                'encrypt_name' => TRUE
            );

        
            $upload = $this->_upload_file($image, $file, $config);

            if($upload['status'] === TRUE) {
                $user_id = user_login('id');
                $image_id = $this->input->post('image_id', TRUE);
                $image = $this->gallery_images_model->get($image_id);
                
                $data = array(
                    'filename' => $upload['filename'],
                    'updated_by' => $user_id,
                );

                
                $result = $this->gallery_images_model->update($data, $image_id);

                if($result) {
                    if($image->filename != null) {
                        unlink('./upload/images/'.$image->filename);
                    }

                    $response = array('status' => TRUE, 'path' => base_url('upload/images')."/".$upload['filename']);
                } else {
                    $response = array('status' => FALSE, 'error' => 'Gagal Mengganti Foto Profil');
                }

                echo json_encode($response);
            } else {
                $response = array('status' => FALSE, 'error' => 'Gagal Upload Foto Profil');

                echo json_encode($response);
            }
        } else {
            $response = array('status' => FALSE, 'error' => 'Terjadi Kesalahan Pada Sistem');
            echo json_encode($response);
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
        $this->template->set_js('jquery.validate.js','footer');    
        $this->template->set_js('additional-methods.min.js','footer');
        $this->template->set_js('bootstrap-filestyle.min.js','footer');        
        $this->template->set_js('app.min.js','footer');
    }
}