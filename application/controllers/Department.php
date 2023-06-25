<?php
class Department extends CI_Controller
{
    function index()
    {
        $this->load->view('departments/index');
    }

    function insert()
    {
        $data = $this->departments->store();
        echo json_encode($data);
    }
    function getDepartments()
    {
        $data = $this->departments->get();
        echo json_encode($data);
    }
    function editDepartment()
    {
        $data = $this->departments->edit();
        echo json_encode($data);
    }
    function updateDepartment()
    {
        $data = $this->departments->update();
        echo json_encode($data);
    }
    function destroy()
    {
        $data = $this->departments->delete();
        echo json_encode($data);
    }
}