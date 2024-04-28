<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        //$this->output->cache(2);
    }

    public function index()
    {
        $cari                           = $this->input->get('cari');
        $config['base_url']             = base_url('Tahanan/');
        $config['total_rows']           = $this->Tahanan_model->total();
        $config['per_page']             = 2;
        $config['page_query_string']    = TRUE;
        $offset = html_escape($this->input->get('per_page'));

        $config['full_tag_open']    = '<ul class="pagination">';
        $config['full_tag_close']   = '</ul>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';

        $config['cur_tag_open']     = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close']    = '</a></li>';
        $config['prev_tag_open']    = '<li>';
        $config['prev_tag_close']   = '</li>';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';

        $this->pagination->initialize($config);

        $data['tahanans']           = $this->Tahanan_model->tahanan($cari, $config['per_page'], $offset);
        $data['offset']             = $offset;
        // dd($data['tahanans']);
        $data['title']              = 'Tahanan';
        $data['total']              = $config['total_rows'];

        $this->load->view('admin/header', $data);
        $this->load->view('tahanan/tahanan');
        $this->load->view('admin/footer');
    }

    public function create()
    {
        $data['kategoritahanans']   = $this->KategoriTahanan_model->kategoritahanan();
        $data['pekerjaans']         = $this->Pekerjaan_model->pekerjaan();
        $data['agamas']             = $this->Agama_model->agama();
        $data['title']  = 'Tambah Data Tahanan';

        $this->load->view('admin/header', $data);
        $this->load->view('tahanan/create');
        $this->load->view('admin/footer');
    }

    public function edit()
    {
        $id                         = $this->uri->segment(3);
        $data['tahanan']            = $this->Tahanan_model->show($id);

        $data['kategoritahanans']   = $this->KategoriTahanan_model->kategoritahanan();
        $data['pekerjaans']         = $this->Pekerjaan_model->pekerjaan();
        $data['agamas']             = $this->Agama_model->agama();
        $data['title']              = 'Edit Data Tahanan';
        $data['tanggal_masuk']      = date("d-m-Y", strtotime($data['tahanan']['tanggal_masuk']));
        $data['tanggal_lahir']      = date("d-m-Y", strtotime($data['tahanan']['tanggal_lahir']));

        // dd($data['pekerjaans']);

        $this->load->view('admin/header', $data);
        $this->load->view('tahanan/edit');
        $this->load->view('admin/footer');
    }

    public function update()
    {
        $id_tahanan         = $this->input->post('id_tahanan');
        $nama_tahanan       = $this->input->post('nama_tahanan');
        $ktp                = $this->input->post('ktp');
        $jk                 = $this->input->post('jk');
        $tanggal_masuk      = $this->input->post('tanggal_masuk');
        $tanggal_lahir      = $this->input->post('tanggal_lahir');
        $id_kategori        = $this->input->post('id_kategori');
        $alamat             = $this->input->post('alamat');
        $umur               = $this->input->post('umur');
        $id_pekerjaan       = $this->input->post('id_pekerjaan');
        $id_agama           = $this->input->post('id_agama');
        $nama_tahananlama   = $this->input->post('nama_tahananlama');
        $parameter          = array($nama_tahananlama, 'nama_tahanan', 'tahanan');

        // $this->form_validation->set_rules('nama_tahanan', 'Namatahanan', 'required|callback_unique2[' . $parameter[0] . ',' . $parameter[1] . ',' . $parameter[2] . ']', array('required' => 'Kolom nama Tahanan tidak boleh kosong.', 'unique2' => 'Nama ini sudah dipakai.'));
        $this->form_validation->set_rules('nama_tahanan', 'Namatahanan', 'required', array('required' => 'Kolom nama Tahanan tidak boleh kosong.'));
        // $this->form_validation->set_rules('ktp', 'KTP', 'required', array('required|is_unique[tahanan.ktp]' => 'Kolom KTP tidak boleh kosong.', 'is_unique' => 'Nomor KTP ini sudah dipakai.'));
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required', array('required' => 'Kolom tanggal masuk tidak boleh kosong.'));
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required', array('required' => 'Kolom tanggal lahir tidak boleh kosong.'));
        $this->form_validation->set_rules('alamat', 'Tanggal Masuk', 'required', array('required' => 'Kolom alamat masuk tidak boleh kosong.'));
        $this->form_validation->set_rules('umur', 'Umur', 'required', array('required' => 'Kolom umur masuk tidak boleh kosong.'));

        if ($this->form_validation->run() === FALSE) {
            $data['tahanan']     = $this->Tahanan_model->show($id_tahanan);
            $data['title']          = 'Edit Data Tahanan';

            $this->load->view('admin/header', $data);
            $this->load->view('tahanan/edit');
            $this->load->view('admin/footer');
        } else {

            $data = array(
                'nama_tahanan' => $nama_tahanan,
                'ktp' => $ktp,
                'jk' => $jk,
                'tanggal_lahir' => date("Y-m-d", strtotime($tanggal_lahir)),
                'tanggal_masuk' => date("Y-m-d", strtotime($tanggal_masuk)),
                'id_kategori' => $id_kategori,
                'alamat' => $alamat,
                'umur' => $umur,
                'id_pekerjaan' => $id_pekerjaan,
                'id_agama' => $id_agama,
            );
            $this->Tahanan_model->update($id_tahanan, $data);

            $pesan      = "Data Tahanan sudah diperbarui.";
            pesan($pesan, 'message', 'success');
            redirect(base_url('tahanan'));
        }
    }

    public function store()
    {
        $id_tahanan         = $this->input->post('id_tahanan');
        $nama_tahanan       = $this->input->post('nama_tahanan');
        $ktp                = $this->input->post('ktp');
        $jk                 = $this->input->post('jk');
        $tanggal_masuk      = $this->input->post('tanggal_masuk');
        $tanggal_lahir      = $this->input->post('tanggal_lahir');
        $id_kategori        = $this->input->post('id_kategori');
        $alamat             = $this->input->post('alamat');
        $umur               = $this->input->post('umur');
        $id_pekerjaan       = $this->input->post('id_pekerjaan');
        $id_agama           = $this->input->post('id_agama');
        $nama_tahananlama   = $this->input->post('nama_tahananlama');
        $parameter          = array($nama_tahananlama, 'nama_tahanan', 'tahanan');

        // $this->form_validation->set_rules('nama_tahanan', 'Namatahanan', 'required|callback_unique2[' . $parameter[0] . ',' . $parameter[1] . ',' . $parameter[2] . ']', array('required' => 'Kolom nama Tahanan tidak boleh kosong.', 'unique2' => 'Nama ini sudah dipakai.'));
        $this->form_validation->set_rules('nama_tahanan', 'Namatahanan', 'required', array('required' => 'Kolom nama Tahanan tidak boleh kosong.'));
        // $this->form_validation->set_rules('ktp', 'KTP', 'required', array('required|is_unique[tahanan.ktp]' => 'Kolom KTP tidak boleh kosong.', 'is_unique' => 'Nomor KTP ini sudah dipakai.'));
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required', array('required' => 'Kolom tanggal masuk tidak boleh kosong.'));
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required', array('required' => 'Kolom tanggal lahir tidak boleh kosong.'));
        $this->form_validation->set_rules('alamat', 'Tanggal Masuk', 'required', array('required' => 'Kolom alamat masuk tidak boleh kosong.'));
        $this->form_validation->set_rules('umur', 'Umur', 'required', array('required' => 'Kolom umur masuk tidak boleh kosong.'));

        if ($this->form_validation->run() == FALSE) {
            $data['title']          = 'Tambah Data Tahanan';
            $data['kategoritahanans']   = $this->KategoriTahanan_model->kategoritahanan();
            $data['pekerjaans']         = $this->Pekerjaan_model->pekerjaan();
            $data['agamas']             = $this->Agama_model->agama();

            $this->load->view('admin/header', $data);
            $this->load->view('tahanan/create');
            $this->load->view('admin/footer');
        } else {

            $data = array(
                'nama_tahanan' => $nama_tahanan,
                'ktp' => $ktp,
                'jk' => $jk,
                'tanggal_lahir' => date("Y-m-d", strtotime($tanggal_lahir)),
                'tanggal_masuk' => date("Y-m-d", strtotime($tanggal_masuk)),
                'id_kategori' => $id_kategori,
                'alamat' => $alamat,
                'umur' => $umur,
                'id_pekerjaan' => $id_pekerjaan,
                'id_agama' => $id_agama,
            );

            $this->Tahanan_model->store($data);

            $pesan      = "Data Tahanan sudah disimpan.";
            // $this->session->set_flashdata('message', '<div style="width:100%" class="alert alert-success alert-dismissible fade show" role="alert">' . $pesan . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

            pesan($pesan, 'message', 'success');

            redirect(base_url('tahanan'));
        }
    }

    public function show()
    {
        $id                 = $this->uri->segment(3);
        $data['tahanan']    = $this->Tahanan_model->show($id);
        $data['title']      = 'Tampil Data Tahanan';

        // dd($data['user']);

        $this->load->view('admin/header', $data);
        $this->load->view('tahanan/show');
        $this->load->view('admin/footer');
    }

    public function delete()
    {
        $id_tahanan      = $this->input->post('idHapus');
        $this->db->where('id_tahanan', $id_tahanan)->delete('tahanan');

        pesan("Data Tahanan sudah dihapus.", 'message', 'success');

        redirect(base_url('tahanan'));
    }

    public function unique2($data1, $data2)
    {
        $data3 = explode(",", $data2);
        $result = $this->Tahanan_model->unique($data1, $data3[0], $data3[1], $data3[2]);
        if (count($result) == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
