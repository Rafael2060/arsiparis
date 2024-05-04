<?php

/**
 * summary
 */
class KategoriTahanan_Model extends CI_Model
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
        return $this->db->where('id_kategori', $id)->get('kategoritahanan')->row_array();
    }

    public function total($cari = null)
    {
        $this->db->like('nama_kategori', $cari);
        return $this->db->get('kategoritahanan')->num_rows();
    }

    public function kategoritahanan($cari = null, $limit = null, $offset = null)
    {
        $this->db->select('*');
        $this->db->like('nama_kategori', $cari);

        $this->db->order_by('nama_kategori', 'asc');
        $this->db->limit($limit);
        $this->db->offset($offset);
        return $this->db->get('kategoritahanan')->result_array();
    }

    public function store($data)
    {
        return $this->db->insert('kategoritahanan', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_kategori', $id);
        return $this->db->update('kategoritahanan', $data);
    }

    public function unique($formData, $oldFormData, $tableField, $table)
    {
        $this->db->where($tableField, $formData);
        $this->db->where_not_in('nama_kategori', $oldFormData);
        return $this->db->get($table)->result_array();
    }
}
