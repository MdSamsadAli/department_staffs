<?php
class StaffModel extends CI_Model
{
    function store()
    {
        $data = array(
            "staff_name" => $this->input->post('staff_name'),
            "address" => $this->input->post('address'),
            "mobile_number" => $this->input->post('mobile_number'),
            "department_id" => $this->input->post('department'),
        );
        $qeury = $this->db->insert('staffs', $data);
        return $qeury;
    }
    // function get()
    // {
    //     $qeury = $this->db->get('staffs');
    //     return $qeury->result_array();
    // }

    public function getStaffWithDepartment() {
        $this->db->select('staffs.*, departments.department_name');
        $this->db->from('staffs');
        $this->db->join('departments', 'staffs.department_id = departments.id');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }
    function edit()
    {
        $id = $this->input->post('id');
        $this->db->select("*");
        $this->db->from('staffs');
        $this->db->where('id', $id);
       $qeury = $this->db->get();
        return $qeury->row();

    }

    function update()
    {
        $id = $this->input->post('id');
        $data = array(
            "staff_name" => $this->input->post('staff_name'),
            "address" => $this->input->post('address'),
            "mobile_number" => $this->input->post('mobile_number'),
            "department_id" => $this->input->post('department'),
        );
        $qeury = $this->db->where('id', $id)->update('staffs', $data);
        return $qeury;
    }
    function delete()
    {
        $id = $this->input->post('id');
        $qeury = $this->db->where('id', $id)->delete('staffs');
        return $qeury;
    }
}