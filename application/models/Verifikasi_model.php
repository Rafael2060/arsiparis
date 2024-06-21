<?php

/**
 * summary
 */
class Verifikasi_Model extends CI_Model
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

    public function verifikasi($id_suratkeluar = null, $tanggal_verifikasi_awal = null, $tanggal_verifikasi_akhir = null, $limit = null, $offset = null)
    {

        if ($tanggal_verifikasi_awal == '' || $tanggal_verifikasi_akhir == '') {
            $rangeTanggal = array();
        } else {
            $tanggal_awal           = date("Y-m-d", strtotime($tanggal_verifikasi_awal));
            $tanggal_akhir          = date("Y-m-d", strtotime($tanggal_verifikasi_akhir));
            $rangeTanggal           = 'tanggal_verifikasi BETWEEN "' . $tanggal_awal . '" and "' . $tanggal_akhir . '"';
        }

        if ($id_suratkeluar == '' || $id_suratkeluar == null) {
            $queryIdsuratkeluar = array();
        } else {
            $queryIdsuratkeluar = array('verifikasi.id_suratkeluar' => $id_suratkeluar);
        }


        //dd($tanggal_awal);
        $this->db->select('verifikasi.*, suratkeluar.no_surat, user.username, user.id as user_id, user_role.role, user_role.id as role_id');
        $this->db->join('suratkeluar', 'on suratkeluar.id_suratkeluar = verifikasi.id_suratkeluar');
        $this->db->join('user', 'on verifikasi.user_id = user.id');
        $this->db->join('user_role', 'on user.role_id = user_role.id');
        // $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratkeluar.id_jenissurat');
        // $this->db->join('suratkeluar_tahanan', 'on suratkeluar_tahanan.id_suratkeluar = suratkeluar.id_suratkeluar');
        // $this->db->where($queryIdTahanan);

        $this->db->where($queryIdsuratkeluar);
        $this->db->where($rangeTanggal);
        $this->db->order_by('verifikasi.created', 'desc');
        // $this->db->group_by('suratkeluar.id_suratkeluar');
        $this->db->limit($limit);
        $this->db->offset($offset);
        return $this->db->get('verifikasi')->result_array();
    }

    public function store($data)
    {
        $this->db->insert('verifikasi', $data);
        return $this->db->insert_id('id_verifikasi');
    }

    public function update($id, $data)
    {
        $this->db->where('id_verifikasi', $id);
        return $this->db->update('verifikasi', $data);
    }

    public function updateStatusBaca($id, $data, $role)
    {
        $this->db->where('id_verifikasi', $id)->where('target_role_id', $role);
        return $this->db->update('verifikasi', $data);
    }

    public function unique($formData, $oldFormData, $tableField, $table)
    {
        $this->db->where($tableField, $formData);
        $this->db->where_not_in('nama_jenissurat', $oldFormData);
        return $this->db->get($table)->result_array();
    }
}
