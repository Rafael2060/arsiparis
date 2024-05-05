<?php

/**
 * summary
 */
class SuratKeluar_Model extends CI_Model
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

    public function total($no_surat = null, $no_agenda = null, $tanggal_dikirim_awal = null, $tanggal_dikirim_akhir = null, $id_jenissurat = null)
    {
        if ($tanggal_dikirim_awal == '' || $tanggal_dikirim_akhir == '') {
            $rangeTanggal = array();
        } else {
            $tanggal_awal           = date("Y-m-d", strtotime($tanggal_dikirim_awal));
            $tanggal_akhir          = date("Y-m-d", strtotime($tanggal_dikirim_akhir));
            $rangeTanggal           = 'tanggal_dikirim BETWEEN "' . $tanggal_awal . '" and "' . $tanggal_akhir . '"';
        }

        if ($id_jenissurat == '' || $id_jenissurat == null) {
            $queryIdJenis = array();
        } else {
            $queryIdJenis = array('suratkeluar.id_jenissurat' => $id_jenissurat);
        }

        $this->db->select('suratkeluar.*, jenissurat.nama_jenissurat, jenissurat.tipe');
        $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratkeluar.id_jenissurat');
        $this->db->like('no_surat', $no_surat);
        $this->db->like('no_agenda', $no_agenda);
        $this->db->where($queryIdJenis);
        $this->db->where($rangeTanggal);

        return $this->db->get('suratkeluar')->num_rows();
    }

    public function suratkeluar($no_surat = null, $no_agenda = null, $tanggal_dikirim_awal = null, $tanggal_dikirim_akhir = null, $id_jenissurat = null, $limit = null, $offset = null)
    {

        if ($tanggal_dikirim_awal == '' || $tanggal_dikirim_akhir == '') {
            $rangeTanggal = array();
        } else {
            $tanggal_awal           = date("Y-m-d", strtotime($tanggal_dikirim_awal));
            $tanggal_akhir          = date("Y-m-d", strtotime($tanggal_dikirim_akhir));
            $rangeTanggal           = 'tanggal_dikirim BETWEEN "' . $tanggal_awal . '" and "' . $tanggal_akhir . '"';
        }

        if ($id_jenissurat == '' || $id_jenissurat == null) {
            $queryIdJenis = array();
        } else {
            $queryIdJenis = array('suratkeluar.id_jenissurat' => $id_jenissurat);
        }

        //dd($tanggal_awal);
        $this->db->select('suratkeluar.*, jenissurat.nama_jenissurat, jenissurat.tipe');
        $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratkeluar.id_jenissurat');
        $this->db->like('no_surat', $no_surat);
        $this->db->like('no_agenda', $no_agenda);
        $this->db->where($queryIdJenis);
        $this->db->where($rangeTanggal);
        $this->db->order_by('suratkeluar.created', 'desc');
        $this->db->limit($limit);
        $this->db->offset($offset);
        return $this->db->get('suratkeluar')->result_array();
    }

    public function store($data)
    {
        $this->db->insert('suratkeluar', $data);
        return $this->db->insert_id('id_suratkeluar');
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
