<?php
class AdminModel extends CI_Model
{
    public function insert()
    {
        $department_id = $this->input->post('department_id');
        $staff_id = $this->input->post('staff_id');
        $status = $this->input->post('status');
        $salary = $this->input->post('salary');
        
        $data = array(
            'department_id' => $department_id,
            'staff_id' => $staff_id,
            'status' => $status,
            'salary' => $salary
        );
        $query = $this->db->insert('admin', $data);
        if($query){
            return 'data added successfully';
        }
        else {
            return 'there is an error during isnert the data';
        }
    }
    public function get()
    {
        $this->db->select('admin.*, departments.department_name, staffs.staff_name, staffs.address, staffs.mobile_number');
        $this->db->from('admin');
        $this->db->join('staffs', 'admin.staff_id = staffs.id');
        $this->db->join('departments', 'admin.department_id = departments.id');
        // $this->db->where('id', $id);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();

    }
    public function getSingle()
    {
        $id = $this->input->post('id');
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from('admin');
        $query = $this->db->get()->row();
        // echo $this->db->last_query();
        if($query)
        {
            return $query;
        }
        else{
            return 'there is no data available';
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        return $this->db->where('id', $id)->delete('admin');

    }
}