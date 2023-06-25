<?php
class Admin extends CI_Controller 
{
    function index()
    {
        $this->load->model('DepartmentModel');
        $this->load->model('StaffModel');
        $department = $this->DepartmentModel->get();
        $staffList = $this->StaffModel->get();
        // var_dump($staffList);

        $data['department'] = $department;
        $data['staffs'] = $staffList;

        $this->load->view('admin/index', $data);
    }

    function getstaffbydepartment()
    {
        // Assuming you have access to the selected department ID ($_POST['departmentId'])
        $selectedDepartmentId = $_POST['departmentId'];

        // Use the selected department ID to retrieve the corresponding staff from your model
        $this->load->model('StaffModel');
        $staffList = $this->StaffModel->getByDepartmentId($selectedDepartmentId);

        // Return the staff data as JSON
        echo json_encode($staffList);
    }

    function store()
    {
        $data = $this->admin->insert();
        echo json_encode($data);
    }
    function get()
    {
        $data = $this->admin->get();
        echo json_encode($data);
    }
    function edit()
    {
        $data = $this->admin->getSingle();
        echo json_encode($data);
    }
    function destroy()
    {
        $data = $this->admin->delete();
        echo json_encode($data);
    }
}