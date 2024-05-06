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

    public function suratmasuk($no_surat = null, $no_agenda = null, $tanggal_diterima_awal = null, $tanggal_diterima_akhir = null, $id_jenissurat = null, $id_tahanan = null, $limit = null, $offset = null)
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

        if ($id_tahanan == '' || $id_tahanan == null) {
            $queryIdTahanan = array();
        } else {
            $queryIdTahanan = array('suratmasuk_tahanan.id_tahanan' => $id_tahanan);
        }

        //dd($tanggal_awal);
        $this->db->select('suratmasuk.*, jenissurat.nama_jenissurat, jenissurat.tipe');
        $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratmasuk.id_jenissurat');
        // $this->db->join('suratmasuk_tahanan', 'on suratmasuk_tahanan.id_suratmasuk = suratmasuk.id_suratmasuk');
        $this->db->like('no_surat', $no_surat);
        $this->db->like('no_agenda', $no_agenda);
        $this->db->where($queryIdJenis);
        $this->db->where($rangeTanggal);
        $this->db->where($queryIdTahanan);
        $this->db->order_by('suratmasuk.created', 'desc');
        // $this->db->group_by('suratmasuk.id_suratmasuk');
        $this->db->limit($limit);
        $this->db->offset($offset);
        return $this->db->get('suratmasuk')->result_array();
    }

    public function store($data)
    {
        $this->db->insert('suratmasuk', $data);
        return $this->db->insert_id('id_suratmasuk');
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
