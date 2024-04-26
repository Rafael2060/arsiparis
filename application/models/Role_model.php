<?php

/**
 * summary
 */
class Role_model extends CI_Model
{
    /**
     * summary
     */
    public function __construct()
    {
        $this->load->database();
    }

    public function show($id)
    {
        $this->db->select('*');
        return $this->db->where('id', $id)->get('user_role')->row_array();
    }

    public function total()
    {
        return $this->db->get('user_role')->num_rows();
    }

    public function role($cari = null, $limit = null, $offset = null)
    {
        $this->db->select('*');
        $this->db->order_by('role', 'asc');
        $this->db->limit($limit);
        $this->db->offset($offset);
        return $this->db->get('user_role')->result_array();
    }

    public function simpanUser($data)
    {
        return $this->db->insert('User', $data);
    }

    public function updateUser($username, $data)
    {
        $this->db->where('username', $username);
        return $this->db->update('User', $data);
    }

    public function updatePasswordUser($username, $data)
    {
        $this->db->where('username', $username);
        return $this->db->update('User', $data);
    }
}
