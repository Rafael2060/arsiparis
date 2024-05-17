<?php

/**
 * summary
 */
class User_Model extends CI_Model
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
        $this->db->select('user.*, user_role.role');
        $this->db->join('user_role', 'user.role_id = user_role.id');
        return $this->db->where('user.id', $id)->get('user')->row_array();
    }

    public function total()
    {
        return $this->db->get('user')->num_rows();
    }

    public function user($cari, $limit = null, $offset = null)
    {
        $this->db->select('user.*, user_role.role');
        $this->db->like('username', $cari);
        $this->db->join('user_role', 'user.role_id = user_role.id');
        $this->db->order_by('username', 'asc');
        $this->db->limit($limit);
        $this->db->offset($offset);
        return $this->db->get('user')->result_array();
    }

    public function store($data)
    {
        return $this->db->insert('user', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('user', $data);
    }

    public function updatePasswordUser($username, $data)
    {
        $this->db->where('username', $username);
        return $this->db->update('user', $data);
    }

    public function role($id)
    {
        $this->db->select('user.*, user_role.role, user_role.id as role_id');
        $this->db->join('user_role', 'on user_role.id = user.role_id');
        return $this->db->where('user.id', $id)->get('user')->row_array();
    }
}
