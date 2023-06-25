<?php
class DepartmentModel extends CI_Model
{
    function store()
    {
        $department_name = $this->input->post('department_name');
        // var_dump($department_name);
        // die();
        $data = array(
            "department_name" => $department_name,
        );
        $qeury = $this->db->insert('departments', $data);
        return $qeury;
    }
    function get()
    {
        $qeury = $this->db->get('departments');
        return $qeury->result();
    }
    function edit()
    {
        $id = $this->input->post('id');
        $this->db->select("*");
        $this->db->from('departments');
        $this->db->where('id', $id);
       $qeury = $this->db->get();
        return $qeury->row();

    }

    function update()
    {
        $id = $this->input->post('id');
        $data = array(
            "department_name" => $this->input->post('department_name'),
        );
        $qeury = $this->db->where('id', $id)->update('departments', $data);
        return $qeury;
    }
    function delete()
    {
        $id = $this->input->post('id');
        $qeury = $this->db->where('id', $id)->delete('departments');
        return $qeury;
    }
}