<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_images_model extends MY_Model
{
    public $table = 'gallery_images'; // you MUST mention the table name
    public $primary_key = 'id'; // you MUST mention the primary key
    
    public function __construct()
    {
        parent::__construct();
    }

    public $rules = array(
            'insert' => array(
                    'gallery_id' => array(
                            'field'=> 'gallery_id',
                            'label'=> 'Galleri Id',
                            'rules'=> 'required'),          
            )
    );
}