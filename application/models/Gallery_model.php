<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_model extends MY_Model
{
    public $table = 'galleries'; // you MUST mention the table name
    public $primary_key = 'id'; // you MUST mention the primary key
    public $soft_deletes = TRUE;
    
    public function __construct()
    {
        parent::__construct();
        $this->after_create[] = 'insert_default';
        $this->has_many['videos'] = array('foreign_model'=> 'Gallery_videos_model','foreign_table'=> 'gallery_videos','foreign_key'=> 'gallery_id','local_key'=>'id');
        $this->has_many['images'] = array('foreign_model'=> 'Gallery_images_model','foreign_table'=> 'gallery_images','foreign_key'=> 'gallery_id','local_key'=>'id');
    }

    public $rules = array(
            'insert' => array(
                    'name' => array(
                            'field'=> 'name',
                            'label'=> 'Nama',
                            'rules'=> 'required'),

                    'status' => array(
                            'field'=> 'status',
                            'label'=> 'Status',
                            'rules'=> 'required'
                    ),
                    'description' => array(
                            'field'=> 'description',
                            'label'=> 'Cuplikan',
                            'rules'=> 'required|max_length[300]'
                    ),                   
                    'thumbnail' => array(
                            'field'=> 'image',
                            'label'=> 'Preview Image',
                            'rules'=> 'required'
                    ),
                    
            )
    );

    public function insert_default($id) {
        $user_id = user_login('id');
        $gallery_id = $id;
        $total_video = 5;
        $videos = array();

        for ($i=0; $i < $total_video; $i++) { 
            $videos[] = array(
                'gallery_id' => $gallery_id, 
                'url'=> '', 
                'created_by' => $user_id,
                'created_at' => date("Y-m-d h:i:s")
            );
        }

        $this->db->insert_batch('gallery_videos', $videos);

        $user_id = user_login('id');
        $gallery_id = $id;
        $total_image = 10;
        $images = array();

        for ($i=0; $i < $total_image; $i++) { 
            $images[] = array(
                'gallery_id' => $gallery_id, 
                'filename' => '', 
                'created_by' => $user_id,
                'created_at' => date("Y-m-d h:i:s")
            );
        }

        $this->db->insert_batch('gallery_images', $images);

        return $gallery_id;
    }
}