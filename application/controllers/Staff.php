<?php
class Staff extends CI_Controller
{
    function index()
    {
        $this->load->model('DepartmentModel');
        $data['departments'] = $this->DepartmentModel->get();
        $this->load->view('staffs/index', $data);
    }

    function insert()
    {
        $data = $this->staffs->store();
        echo json_encode($data);
    }
    function getStaff()
    {

        $data = $this->staffs->getStaffWithDepartment();
        echo json_encode($data);
    }

    
    function editStaff()
    {
        $data = $this->staffs->edit();
        echo json_encode($data);
    }
    function updateStaff()
    {
        $data = $this->staffs->update();
        echo json_encode($data);
    }
    function destroy()
    {
        $data = $this->staffs->delete();
        echo json_encode($data);
    }
}