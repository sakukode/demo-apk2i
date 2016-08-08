<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_model extends MY_Model
{
    public $table = 'events'; // you MUST mention the table name
    public $primary_key = 'id'; // you MUST mention the primary key
    public $soft_deletes = TRUE;
    
    public function __construct()
    {
        parent::__construct();
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
                    'filename' => array(
                            'field'=> 'file',
                            'label'=> 'Nama File',
                            'rules'=> 'required'
                    ),
                    
            )
    );
}