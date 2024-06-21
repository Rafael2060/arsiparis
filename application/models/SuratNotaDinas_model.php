<?php

/**
 * summary
 */
class SuratNotaDinas_Model extends CI_Model
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
        $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratnotadinas.id_jenissurat');
        return $this->db->where('id_suratnotadinas', $id)->get('suratnotadinas')->row_array();
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

    public function total($no_surat = null, $no_agenda = null, $tanggal_awal = null, $tanggal_akhir = null, $id_jenissurat = null)
    {
        if ($tanggal_awal == '' || $tanggal_akhir == '') {
            $rangeTanggal = array();
        } else {
            $tanggal_awal           = date("Y-m-d", strtotime($tanggal_awal));
            $tanggal_akhir          = date("Y-m-d", strtotime($tanggal_akhir));
            $rangeTanggal           = 'tanggal BETWEEN "' . $tanggal_awal . '" and "' . $tanggal_akhir . '"';
        }

        if ($id_jenissurat == '' || $id_jenissurat == null) {
            $queryIdJenis = array();
        } else {
            $queryIdJenis = array('suratnotadinas.id_jenissurat' => $id_jenissurat);
        }

        $this->db->select('suratnotadinas.*, jenissurat.nama_jenissurat, jenissurat.tipe');
        $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratnotadinas.id_jenissurat');
        $this->db->like('no_surat', $no_surat);
        $this->db->where($queryIdJenis);
        $this->db->where($rangeTanggal);

        return $this->db->get('suratnotadinas')->num_rows();
    }

    public function suratnotadinas($no_surat = null, $tanggal_awal = null, $tanggal_akhir = null, $id_jenissurat = null, $limit = null, $offset = null)
    {

        if ($tanggal_awal == '' || $tanggal_akhir == '') {
            $rangeTanggal = array();
        } else {
            $tanggal_awal           = date("Y-m-d", strtotime($tanggal_awal));
            $tanggal_awal           = date("Y-m-d", strtotime($tanggal_akhir));
            $rangeTanggal           = 'tanggal BETWEEN "' . $tanggal_awal . '" and "' . $tanggal_akhir . '"';
        }

        if ($id_jenissurat == '' || $id_jenissurat == null) {
            $queryIdJenis = array();
        } else {
            $queryIdJenis = array('suratnotadinas.id_jenissurat' => $id_jenissurat);
        }

        //dd($tanggal_awal);
        $this->db->select('suratnotadinas.*, 
        jenissurat.nama_jenissurat, jenissurat.tipe');
        $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratnotadinas.id_jenissurat');
        $this->db->like('no_surat', $no_surat);
        $this->db->where($queryIdJenis);
        $this->db->where($rangeTanggal);

        $this->db->order_by('suratnotadinas.tanggal', 'desc');
        $this->db->limit($limit);
        $this->db->offset($offset);
        return $this->db->get('suratnotadinas')->result_array();
    }

    public function cetaksuratnotadinas($id)
    {
        $this->db->select('suratnotadinas.*, 
        jenissurat.nama_jenissurat, jenissurat.tipe');
        $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratnotadinas.id_jenissurat');
        $this->db->where('id_suratnotadinas', $id);

        return $this->db->get('suratnotadinas')->row_array();
    }

    public function store($data)
    {
        $this->db->insert('suratnotadinas', $data);
        return $this->db->insert_id('id_suratnotadinas');
    }

    public function update($id, $data)
    {
        $this->db->where('id_suratnotadinas', $id);
        return $this->db->update('suratnotadinas', $data);
    }

    public function unique($formData, $oldFormData, $tableField, $table)
    {
        $this->db->where($tableField, $formData);
        $this->db->where_not_in('nama_jenissurat', $oldFormData);
        return $this->db->get($table)->result_array();
    }
}
