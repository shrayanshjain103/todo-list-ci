<?php
class Todo_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct(); {
        }
    }
    // public function fatchall()
    // {
    //     $query = $this->db->get('to_do_list');
    //     return  $query->result_array();
    // }

    public function fatchall()
    {
        $query = $this->db->get('to_do_list');
        $result = $query->result();
        return  $result;
    }
    public function addInfo($data)
    {
        return $this->db->insert('to_do_list', $data);
    }
    public function deleteInfo($id)
    {
        $this->db->where('id', $id);
        $data = $this->db->delete("to_do_list");
        return $data;
    }

    public function updateInfo($data)
    {
        $id = $data['id'];
        $dataa = array(
            'title' => $data['title'],
            'discription' => $data['discription']
        );
        $this->db->where('id', $id);
        $status = $this->db->update('to_do_list', $dataa);
        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    // used to count the data avilable in the database
    public function countAllData()
    {
        return $this->db->count_all('to_do_list');
    }
    // used to set the linit per page
    public function getPaginatedData($limit, $offset)
    {
        $this->db->limit($limit, $offset);
        $query = $this->db->get('to_do_list');
        return $query->result();
    }
}
