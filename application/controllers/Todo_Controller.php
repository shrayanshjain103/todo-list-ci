<?php
class Todo_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Todo_model');
        $this->load->helper('form');
        $this->load->library('form_validation'); // Load the Form Validation library

    }

    public function index()
    {
        $this->load->view('todo');
    }

    public function showData()
    {
        $data = $this->Todo_model->fatchall();
        echo json_encode($data);
    }

    //Used to delete Task 
    public function addnewTask()
    {
        $this->form_validation->set_rules('task', 'task', 'required');
        $this->form_validation->set_rules('discription', 'discription', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');
        if ($this->form_validation->run() === FALSE)
        {  
            echo 0;die;
        }

        $data = array(
            'title' => $this->input->post("task"),
            'discription' => $this->input->post('discription'),
            'status' => $this->input->post('status')
        );
        $this->Todo_model->addInfo($data);
        $result = $this->db->affected_rows();
        if ($result > 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

    //Used to delete Task 
    public function deleteTask()
    {
        $id = $this->input->post('id');
        $this->Todo_model->deleteInfo($id);
        $data = $this->db->affected_rows();
        if ($data > 0) {
            echo (1);
        } else {
            echo (0);
        }
    }

    //Used to edit the Task
    public function editTask()
    {
       
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('discription', 'discription', 'required');
        if ($this->form_validation->run() === FALSE)
        {  
           // echo"jefwndkiw";die;
            echo 0;die;
        }
        $data = $this->input->post();
        $this->Todo_model->updateInfo($data);
        $data = $this->db->affected_rows();
        if ($data > 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

    //Used to edit Status 
    public function editStatus($id, $status)
    {
        $updatestat = $status == 1 ? 0 : 1;
        $this->db->where('id', $id);
        $this->db->set('status', $updatestat);
        $this->db->update('to_do_list');
        $data = $this->db->affected_rows();
        if ($data > 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

    //Used to append data in edit modal
    public function showInfo()
    {
        $id = $_POST['id'];
        $data = $this->db->get_where('to_do_list', ['id' => $id])->row_array();
        echo json_encode($data);
    }
}
