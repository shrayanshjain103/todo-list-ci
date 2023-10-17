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
}
