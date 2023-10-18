<?php
class Todo_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Todo_model');
    }

    public function index() {
        $this->load->view('todo');
    }

    public function showData() {
        $data = $this->Todo_model->fatchall();
        echo json_encode($data);
    }
    public function addnewTask(){
   
     $data = array(
          'title' => $this->input->post("task"),
          'discription' => $this->input->post('discription'),
          'status'=> $this->input->post('status')

     );
     $result=$this->Todo_model->addInfo($data);
     if($result){
        echo 1;
     }
     else{
          echo 0;
     }
    }
    public function deleteTask()
    {
     $id=$this->input->post('id');
        $data=$this->Todo_model->deleteInfo($id);
        if ($data) {
            echo json_encode(1);
        } else {
          echo json_encode(0);
        }
    }
    public function editTask(){
    
    // $data=array(
    //     'title'=> $this->input->post('title'),
    //     'discription'=> $this->input->post('discription')
    // );
      $data = $this->input->post();
      $data=$this->Todo_model->updateInfo($data);
        if($data == 1){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function editStatus($id,$status){
        $updatestat = $status == 1 ? 0 : 1;
        $this->db->where('id', $id);
        $this->db->set('status', $updatestat);
        $data = $this->db->update('to_do_list');
        if($data==1){
            echo 1;
        } else{
            echo 0;
        }
    }
}
