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
    public function addInfo($data){
        return $this->db->insert('to_do_list',$data);

    }
    public function deleteInfo($id){
        $this->db->where('id', $id);
        $data = $this->db->delete("to_do_list");
        return $data;
    }
}
