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
        $this->db->select('suratmasuk.*, 
        jenissurat.nama_jenissurat, jenissurat.tipe,
        disposisi.id_disposisi, disposisi.tanggal_disposisi, disposisi.dibaca, disposisi.role_id as disposisi_role_id, disposisi.target_role_id, disposisi.catatan, disposisi.tolak');
        $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratmasuk.id_jenissurat');
        $this->db->join('disposisi', 'on disposisi.id_suratmasuk = suratmasuk.id_suratmasuk and disposisi.status=0', 'left');

        return $this->db->where('suratmasuk.id_suratmasuk', $id)->get('suratmasuk')->row_array();
    }

    public function showDisposisi($id)
    {
        $this->db->select('disposisi.*,
        user.name, username, user.role_id,
        user_role.role');
        $this->db->join('user', 'on user.id = disposisi.user_id');
        $this->db->join('user_role', 'on user_role.id = user.role_id');

        return $this->db->where('id_suratmasuk', $id)->get('disposisi')->result_array();
    }

    public function showTahanan($id)
    {
        $this->db->select('suratmasuk.*,
        jenissurat.nama_jenissurat, jenissurat.tipe,
        suratmasuk_tahanan.id_tahanan,
        tahanan.nama_tahanan');
        $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratmasuk.id_jenissurat');
        $this->db->join('suratmasuk_tahanan', 'on suratmasuk_tahanan.id_suratmasuk = suratmasuk.id_suratmasuk');
        $this->db->join('tahanan', 'on tahanan.id_tahanan = suratmasuk_tahanan.id_tahanan');
        return $this->db->where('suratmasuk.id_suratmasuk', $id)->get('suratmasuk')->result_object();
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

    public function suratmasuk($no_surat = null, $no_agenda = null, $tanggal_diterima_awal = null, $tanggal_diterima_akhir = null, $id_jenissurat = null, $id_tahanan = null, $status = null, $tolak = null, $limit = null, $offset = null)
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

        if ($status == '' || $status == null) {
            $queryStatus = array();
        } else {
            $queryStatus = array('disposisi.status' => $status);
        }

        if ($tolak == '' || $tolak == null) {
            $queryTolak = array();
        } else {
            $queryTolak = array('disposisi.tolak' => $tolak);
        }

        //dd($tanggal_awal);
        $this->db->select('suratmasuk.*, 
        jenissurat.nama_jenissurat, jenissurat.tipe,
        disposisi.id_disposisi, disposisi.tanggal_disposisi, disposisi.dibaca, disposisi.role_id as disposisi_role_id, disposisi.target_role_id, disposisi.catatan, disposisi.tolak');
        $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratmasuk.id_jenissurat');
        $this->db->join('disposisi', 'on disposisi.id_suratmasuk = suratmasuk.id_suratmasuk and disposisi.status=' . $status, 'left');
        // $this->db->join('suratmasuk_tahanan', 'on suratmasuk_tahanan.id_suratmasuk = suratmasuk.id_suratmasuk');
        $this->db->like('no_surat', $no_surat);
        $this->db->like('no_agenda', $no_agenda);
        $this->db->where($queryIdJenis);
        $this->db->where($rangeTanggal);
        $this->db->where($queryIdTahanan);

        $this->db->where($queryTolak);
        $this->db->order_by('suratmasuk.created', 'desc');
        // $this->db->group_by('suratmasuk.id_suratmasuk');
        $this->db->limit($limit);
        $this->db->offset($offset);
        return $this->db->get('suratmasuk')->result_array();
    }

    public function suratmasukId($id, $status = null)
    {

        //dd($id);
        $this->db->select('suratmasuk.*, 
        jenissurat.nama_jenissurat, jenissurat.tipe,
        disposisi.id_disposisi, disposisi.tanggal_disposisi, disposisi.dibaca, disposisi.role_id as disposisi_role_id, disposisi.target_role_id, disposisi.catatan, disposisi.tolak');
        $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratmasuk.id_jenissurat');
        $this->db->join('disposisi', 'on disposisi.id_suratmasuk = suratmasuk.id_suratmasuk and disposisi.status=' . $status, 'left');
        $this->db->where('suratmasuk.id_suratmasuk', $id);
        $this->db->order_by('suratmasuk.created', 'desc');


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

    public function totalsuratmasuk()
    {
        return count($this->db->get('suratmasuk')->result_array());
    }
}
