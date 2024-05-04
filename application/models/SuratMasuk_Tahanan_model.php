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

    public function total($no_surat = null, $no_agenda = null, $tanggal_diterima_awal = null, $tanggal_diterima_akhir = null, $id_jenissurat = null)
    {
        if ($tanggal_diterima_awal == '' || $tanggal_diterima_akhir == '') {
            $rangeTanggal = array();
        } else {
            $tanggal_awal           = date("Y-m-d", strtotime($tanggal_diterima_awal));
            $tanggal_akhir          = date("Y-m-d", strtotime($tanggal_diterima_akhir));
            $rangeTanggal           = 'tanggal_diterima BETWEEN "' . $tanggal_awal . '" and "' . $tanggal_akhir . '"';
        }

        if ($id_jenissurat == '' || $id_jenissurat == null) {
            $queryIdJenis = array();
        } else {
            $queryIdJenis = array('suratmasuk.id_jenissurat' => $id_jenissurat);
        }

        $this->db->select('suratmasuk.*, jenissurat.nama_jenissurat, jenissurat.tipe');
        $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratmasuk.id_jenissurat');
        $this->db->like('no_surat', $no_surat);
        $this->db->like('no_agenda', $no_agenda);
        $this->db->where($queryIdJenis);
        $this->db->where($rangeTanggal);

        return $this->db->get('suratmasuk')->num_rows();
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
