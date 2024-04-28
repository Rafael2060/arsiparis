<?php

/**
 * summary
 */
class SuratMasuk_Model extends CI_Model
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
        return $this->db->where('id_suratmasuk', $id)->get('suratmasuk')->row_array();
    }

    public function total()
    {
        return $this->db->get('suratmasuk')->num_rows();
    }

    public function suratmasuk($cari, $limit = null, $offset = null)
    {
        $this->db->select('*');
        $this->db->like('no_surat', $cari);
        $this->db->order_by('no_surat', 'asc');
        $this->db->limit($limit);
        $this->db->offset($offset);
        return $this->db->get('suratmasuk')->result_array();
    }

    public function store($data)
    {
        return $this->db->insert('suratmasuk', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_suratmasuk', $id);
        return $this->db->update('suratmasuk', $data);
    }

    public function unique($formData, $oldFormData, $tableField, $table)
    {
        $this->db->where($tableField, $formData);
        $this->db->where_not_in('nama_jenissurat', $oldFormData);
        return $this->db->get($table)->result_array();
    }
}
