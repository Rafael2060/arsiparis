<?php

/**
 * summary
 */
class SuratKeluar_Tahanan_Model extends CI_Model
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
        $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratkeluar.id_jenissurat');
        return $this->db->where('id_suratkeluar', $id)->get('suratkeluar')->row_array();
    }

    public function total($id_suratkeluar = null, $no_agenda = null, $tanggal_dikirim_awal = null, $tanggal_dikirim_akhir = null, $id_jenissurat = null)
    {
        $this->db->select(
            '*'
        );

        $this->db->where('id_suratkeluar', $id_suratkeluar);

        return $this->db->get('suratkeluar_tahanan')->num_rows();
    }

    public function tahanan_total($id_tahanan = null, $limit = null, $offset = null)
    {
        $this->db->select(
            '*'
        );

        $this->db->where('suratkeluar_tahanan.id_tahanan', $id_tahanan);

        return $this->db->get('suratkeluar_tahanan')->num_rows();
    }

    public function suratkeluar_tahanan($id_suratkeluar = null, $limit = null, $offset = null)
    {

        $this->db->select(
            'suratkeluar_tahanan.id, suratkeluar_tahanan.id_suratkeluar, suratkeluar_tahanan.id_tahanan, 
            tahanan.*, 
            suratkeluar.no_surat, suratkeluar.id_jenissurat,
            jenissurat.nama_jenissurat, jenissurat.tipe,
            kategoritahanan.nama_kategori'
        );
        $this->db->join('suratkeluar', 'on suratkeluar.id_suratkeluar = suratkeluar_tahanan.id_suratkeluar');
        $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratkeluar.id_jenissurat');
        $this->db->join('tahanan', 'on tahanan.id_tahanan = suratkeluar_tahanan.id_tahanan');
        $this->db->join('kategoritahanan', 'on kategoritahanan.id_kategori = tahanan.id_kategori');
        $this->db->where('suratkeluar.id_suratkeluar', $id_suratkeluar);
        $this->db->order_by('suratkeluar_tahanan.created', 'desc');
        $this->db->limit($limit);
        $this->db->offset($offset);
        return $this->db->get('suratkeluar_tahanan')->result_array();
    }

    public function tahanan_suratkeluar($id_tahanan = null, $limit = null, $offset = null)
    {

        $this->db->select(
            'suratkeluar_tahanan.id, suratkeluar_tahanan.id_suratkeluar, suratkeluar_tahanan.id_tahanan, 
            tahanan.*, 
            suratkeluar.no_surat, suratkeluar.no_agenda, suratkeluar.tanggal_surat, suratkeluar.tanggal_dikirim, suratkeluar.id_jenissurat, suratkeluar.tujuan_surat, suratkeluar.perihal, suratkeluar.file, suratkeluar.lampiran,
            jenissurat.nama_jenissurat, jenissurat.tipe,
            kategoritahanan.nama_kategori'
        );
        $this->db->join('suratkeluar', 'on suratkeluar.id_suratkeluar = suratkeluar_tahanan.id_suratkeluar');
        $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratkeluar.id_jenissurat');
        $this->db->join('tahanan', 'on tahanan.id_tahanan = suratkeluar_tahanan.id_tahanan');
        $this->db->join('kategoritahanan', 'on kategoritahanan.id_kategori = tahanan.id_kategori');
        $this->db->where('suratkeluar_tahanan.id_tahanan', $id_tahanan);
        $this->db->order_by('suratkeluar_tahanan.created', 'desc');
        $this->db->limit($limit);
        $this->db->offset($offset);
        return $this->db->get('suratkeluar_tahanan')->result_array();
    }

    public function store($data)
    {
        return $this->db->insert('suratkeluar_tahanan', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_suratkeluar', $id);
        return $this->db->update('suratkeluar', $data);
    }

    public function unique($formData, $oldFormData, $tableField, $table)
    {
        $this->db->where($tableField, $formData);
        $this->db->where_not_in('nama_jenissurat', $oldFormData);
        return $this->db->get($table)->result_array();
    }
}
