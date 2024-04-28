<?php

/**
 * summary
 */
class Pekerjaan_Model extends CI_Model
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
        $this->db->select('tahanan.*, kategoritahanan.nama_kategori, pekerjaan.nama_pekerjaan, agama.nama_agama');
        $this->db->join('kategoritahanan', 'on kategoritahanan.id_kategori=tahanan.id_kategori');
        $this->db->join('pekerjaan', 'on pekerjaan.id_pekerjaan=tahanan.id_pekerjaan');
        $this->db->join('agama', 'on agama.id_agama=tahanan.id_agama');
        return $this->db->where('id_tahanan', $id)->get('tahanan')->row_array();
    }

    public function total()
    {
        return $this->db->get('tahanan')->num_rows();
    }

    public function pekerjaan($cari = null, $limit = null, $offset = null)
    {
        $this->db->like('nama_pekerjaan', $cari);
        $this->db->order_by('nama_pekerjaan', 'asc');
        $this->db->limit($limit);
        $this->db->offset($offset);

        return $this->db->get('pekerjaan')->result_array();
    }

    public function store($data)
    {
        return $this->db->insert('tahanan', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_tahanan', $id);
        return $this->db->update('tahanan', $data);
    }

    public function unique($formData, $oldFormData, $tableField, $table)
    {
        $this->db->where($tableField, $formData);
        $this->db->where_not_in('nama_tahanan', $oldFormData);
        return $this->db->get($table)->result_array();
    }
}
