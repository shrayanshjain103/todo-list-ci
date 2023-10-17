<?php
class Todo_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct(); {
        }
    }
    public function fatchall(){
        $query = $this->db->get('to_do_list');
        return  $query->result_array();
    }
}
