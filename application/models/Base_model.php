<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_model extends CI_Model
{
	protected $_slug_label = "slug";

	function __construct() {
		parent::__construct();
	}

	public function check_exist_slug($slug, $table, $id) {

		if($id == null) {
			$result = $this->db->get_where($table, array($this->_slug_label => $slug))->row();
		} else {
			$where = "(".$this->_slug_label." = '".$slug."') AND (id != ".$id.")";
			$result = $this->db->where($where)							   
							   ->get($table)->row();
		}

		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}