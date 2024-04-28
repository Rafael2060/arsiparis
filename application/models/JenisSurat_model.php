<?php

/**
 * summary
 */
class JenisSurat_Model extends CI_Model
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
        return $this->db->where('id_jenissurat', $id)->get('jenissurat')->row_array();
    }

    public function total()
    {
        return $this->db->get('jenissurat')->num_rows();
    }

    public function jenissurat($cari, $limit = null, $offset = null)
    {
        $this->db->select('*');
        $this->db->like('nama_jenissurat', $cari);

        $this->db->order_by('nama_jenissurat', 'asc');
        $this->db->limit($limit);
        $this->db->offset($offset);
        return $this->db->get('jenissurat')->result_array();
    }

    public function store($data)
    {
        return $this->db->insert('jenissurat', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_jenissurat', $id);
        return $this->db->update('jenissurat', $data);
    }

    public function unique($formData, $oldFormData, $tableField, $table)
    {
        $this->db->where($tableField, $formData);
        $this->db->where_not_in('nama_jenissurat', $oldFormData);
        return $this->db->get($table)->result_array();
    }
}
