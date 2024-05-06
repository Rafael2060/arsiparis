<?php

/**
 * summary
 */
class SuratMasuk_Tahanan_Model extends CI_Model
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
        $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratmasuk.id_jenissurat');
        return $this->db->where('id_suratmasuk', $id)->get('suratmasuk')->row_array();
    }

    public function total($id_suratmasuk = null, $no_agenda = null, $tanggal_diterima_awal = null, $tanggal_diterima_akhir = null, $id_jenissurat = null)
    {
        $this->db->select(
            '*'
        );

        $this->db->where('id_suratmasuk', $id_suratmasuk);

        return $this->db->get('suratmasuk_tahanan')->num_rows();
    }

    public function tahanan_total($id_tahanan = null, $limit = null, $offset = null)
    {
        $this->db->select(
            '*'
        );

        $this->db->where('suratmasuk_tahanan.id_tahanan', $id_tahanan);

        return $this->db->get('suratmasuk_tahanan')->num_rows();
    }

    public function suratmasuk_tahanan($id_suratmasuk = null, $limit = null, $offset = null)
    {

        $this->db->select(
            'suratmasuk_tahanan.id, suratmasuk_tahanan.id_suratmasuk, suratmasuk_tahanan.id_tahanan, 
            tahanan.*, 
            suratmasuk.no_surat, suratmasuk.id_jenissurat,
            jenissurat.nama_jenissurat, jenissurat.tipe,
            kategoritahanan.nama_kategori'
        );
        $this->db->join('suratmasuk', 'on suratmasuk.id_suratmasuk = suratmasuk_tahanan.id_suratmasuk');
        $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratmasuk.id_jenissurat');
        $this->db->join('tahanan', 'on tahanan.id_tahanan = suratmasuk_tahanan.id_tahanan');
        $this->db->join('kategoritahanan', 'on kategoritahanan.id_kategori = tahanan.id_kategori');
        $this->db->where('suratmasuk.id_suratmasuk', $id_suratmasuk);
        $this->db->order_by('suratmasuk_tahanan.created', 'desc');
        $this->db->limit($limit);
        $this->db->offset($offset);
        return $this->db->get('suratmasuk_tahanan')->result_array();
    }
    public function tahanan_suratmasuk($id_tahanan = null, $limit = null, $offset = null)
    {

        $this->db->select(
            'suratmasuk_tahanan.id, suratmasuk_tahanan.id_suratmasuk, suratmasuk_tahanan.id_tahanan, 
            tahanan.*, 
            suratmasuk.no_surat, suratmasuk.no_agenda, suratmasuk.tanggal_surat, suratmasuk.tanggal_diterima, suratmasuk.id_jenissurat, suratmasuk.asal_surat, suratmasuk.perihal, suratmasuk.file, suratmasuk.lampiran,
            jenissurat.nama_jenissurat, jenissurat.tipe,
            kategoritahanan.nama_kategori'
        );
        $this->db->join('suratmasuk', 'on suratmasuk.id_suratmasuk = suratmasuk_tahanan.id_suratmasuk');
        $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratmasuk.id_jenissurat');
        $this->db->join('tahanan', 'on tahanan.id_tahanan = suratmasuk_tahanan.id_tahanan');
        $this->db->join('kategoritahanan', 'on kategoritahanan.id_kategori = tahanan.id_kategori');
        $this->db->where('suratmasuk_tahanan.id_tahanan', $id_tahanan);
        $this->db->order_by('suratmasuk_tahanan.created', 'desc');
        $this->db->limit($limit);
        $this->db->offset($offset);
        return $this->db->get('suratmasuk_tahanan')->result_array();
    }

    public function store($data)
    {
        return $this->db->insert('suratmasuk_tahanan', $data);
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
