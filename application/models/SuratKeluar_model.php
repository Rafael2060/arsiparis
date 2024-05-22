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

    public function showVerifikasi($id)
    {
        $this->db->select('verifikasi.*,
        user.name, username, user.role_id,
        user_role.role');
        $this->db->join('user', 'on user.id = verifikasi.user_id');
        $this->db->join('user_role', 'on user_role.id = user.role_id');

        return $this->db->where('id_suratkeluar', $id)->get('verifikasi')->result_array();
    }

    public function showTahanan($id)
    {
        $this->db->select('suratkeluar.*,
        jenissurat.nama_jenissurat, jenissurat.tipe,
        suratkeluar_tahanan.id_tahanan,
        tahanan.nama_tahanan');
        $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratkeluar.id_jenissurat');
        $this->db->join('suratkeluar_tahanan', 'on suratkeluar_tahanan.id_suratkeluar = suratkeluar.id_suratkeluar');
        $this->db->join('tahanan', 'on tahanan.id_tahanan = suratkeluar_tahanan.id_tahanan');
        return $this->db->where('suratkeluar.id_suratkeluar', $id)->get('suratkeluar')->result_object();
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

    public function suratkeluar($no_surat = null, $no_agenda = null, $tanggal_dikirim_awal = null, $tanggal_dikirim_akhir = null, $id_jenissurat = null, $id_tahanan = null, $status = null, $tolak = null, $limit = null, $offset = null)
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

        if ($id_tahanan == '' || $id_tahanan == null) {
            $queryIdTahanan = array();
        } else {
            $queryIdTahanan = array('suratmasuk_tahanan.id_tahanan' => $id_tahanan);
        }

        if ($status == '' || $status == null) {
            $queryStatus = array();
        } else {
            $queryStatus = array('verifikasi.status' => $status);
        }

        if ($tolak == '' || $tolak == null) {
            $queryTolak = array();
        } else {
            $queryTolak = array('verifikasi.tolak' => $tolak);
        }


        //dd($tanggal_awal);
        $this->db->select('suratkeluar.*, 
        jenissurat.nama_jenissurat, jenissurat.tipe,
        verifikasi.id_verifikasi, verifikasi.tanggal_verifikasi, verifikasi.dibaca, verifikasi.role_id as verifikasi_role_id, verifikasi.target_role_id, verifikasi.catatan, verifikasi.tolak');
        $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratkeluar.id_jenissurat');
        $this->db->join('verifikasi', 'on verifikasi.id_suratkeluar = suratkeluar.id_suratkeluar and verifikasi.status=' . $status, 'left');
        $this->db->like('no_surat', $no_surat);
        $this->db->like('no_agenda', $no_agenda);
        $this->db->where($queryIdJenis);
        $this->db->where($rangeTanggal);
        $this->db->where($queryTolak);
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
