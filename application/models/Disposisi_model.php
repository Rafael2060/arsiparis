<?php

/**
 * summary
 */
class Disposisi_Model extends CI_Model
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

    public function disposisi($id_suratmasuk = null, $tanggal_disposisi_awal = null, $tanggal_disposisi_akhir = null, $limit = null, $offset = null)
    {

        if ($tanggal_disposisi_awal == '' || $tanggal_disposisi_akhir == '') {
            $rangeTanggal = array();
        } else {
            $tanggal_awal           = date("Y-m-d", strtotime($tanggal_disposisi_awal));
            $tanggal_akhir          = date("Y-m-d", strtotime($tanggal_disposisi_akhir));
            $rangeTanggal           = 'tanggal_disposisi BETWEEN "' . $tanggal_awal . '" and "' . $tanggal_akhir . '"';
        }

        if ($id_suratmasuk == '' || $id_suratmasuk == null) {
            $queryIdSuratMasuk = array();
        } else {
            $queryIdSuratMasuk = array('disposisi.id_suratmasuk' => $id_suratmasuk);
        }


        //dd($tanggal_awal);
        $this->db->select('disposisi.*, suratmasuk.no_surat, user.username, user.id as user_id, user_role.role, user_role.id as role_id');
        $this->db->join('suratmasuk', 'on suratmasuk.id_suratmasuk = disposisi.id_suratmasuk');
        $this->db->join('user', 'on disposisi.user_id = user.id');
        $this->db->join('user_role', 'on user.role_id = user_role.id');
        // $this->db->join('jenissurat', 'on jenissurat.id_jenissurat = suratmasuk.id_jenissurat');
        // $this->db->join('suratmasuk_tahanan', 'on suratmasuk_tahanan.id_suratmasuk = suratmasuk.id_suratmasuk');
        // $this->db->where($queryIdTahanan);

        $this->db->where($queryIdSuratMasuk);
        $this->db->where($rangeTanggal);
        $this->db->order_by('disposisi.created', 'desc');
        // $this->db->group_by('suratmasuk.id_suratmasuk');
        $this->db->limit($limit);
        $this->db->offset($offset);
        return $this->db->get('disposisi')->result_array();
    }

    public function store($data)
    {
        $this->db->insert('disposisi', $data);
        return $this->db->insert_id('id_disposisi');
    }

    public function update($id, $data)
    {
        $this->db->where('id_disposisi', $id);
        return $this->db->update('disposisi', $data);
    }


    public function updateStatusBaca($id, $data, $role)
    {
        $this->db->where('id_disposisi', $id)->where('target_role_id', $role);
        return $this->db->update('disposisi', $data);
    }

    public function unique($formData, $oldFormData, $tableField, $table)
    {
        $this->db->where($tableField, $formData);
        $this->db->where_not_in('nama_jenissurat', $oldFormData);
        return $this->db->get($table)->result_array();
    }

    public function disposisi1()
    {
        $this->db->select('suratmasuk.*, disposisi.*');
        $this->db->join('disposisi', 'on disposisi.id_suratmasuk = suratmasuk.id_suratmasuk');
        $hasil = $this->db->get('suratmasuk')->result_array();
        dd($hasil);
    }
}
