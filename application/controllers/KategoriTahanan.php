<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KategoriTahanan extends CI_Controller
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
        $config['base_url']             = base_url('KategoriTahanan/?cari=') . $cari;
        $config['total_rows']           = $this->KategoriTahanan_model->total($cari);
        $config['per_page']             = 10;
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

        $data['kategoritahanans']   = $this->KategoriTahanan_model->kategoritahanan($cari, $config['per_page'], $offset);
        $data['offset']             = $offset;
        // dd($data['users']);
        $data['title']              = 'Kategori Tahanan';
        $data['total']              = $config['total_rows'];

        $this->load->view('admin/header', $data);
        $this->load->view('kategoritahanan/kategoritahanan');
        $this->load->view('admin/footer');
    }

    public function create()
    {
        $data['title']  = 'Tambah Data Kategori Tahanan';

        $this->load->view('admin/header', $data);
        $this->load->view('kategoritahanan/create');
        $this->load->view('admin/footer');
    }

    public function edit()
    {
        $id                  = $this->uri->segment(3);
        $data['kategoritahanan']     = $this->KategoriTahanan_model->show($id);
        $data['title']       = 'Edit Data Tahanan';

        // dd($data['user']);

        $this->load->view('admin/header', $data);
        $this->load->view('kategoritahanan/edit');
        $this->load->view('admin/footer');
    }

    public function update()
    {
        $id_kategori      = $this->input->post('id_kategori');
        $nama_kategori    = $this->input->post('nama_kategori');
        $nama_kategorilama = $this->input->post('nama_kategorilama');
        $parameter          = array($nama_kategorilama, 'nama_kategori', 'kategoritahanan');

        // $this->form_validation->set_rules('nama_tahanan', 'Nama Tahanan', 'required|callback_unique[' . $nama_tahananlama . ',"nama_tahanan","tahanan"]', array('required' => 'Kolom nama Tahanan tidak boleh kosong.'));
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|callback_unique2[' . $parameter[0] . ',' . $parameter[1] . ',' . $parameter[2] . ']', array('required' => 'Kolom nama kategori tahanan tidak boleh kosong.', 'unique2' => 'Nama ini sudah dipakai.'));

        if ($this->form_validation->run() === FALSE) {
            $data['kategoritahanan']     = $this->KategoriTahanan_model->show($id_kategori);
            $data['title']          = 'Edit Data Kategori Tahanan';

            $this->load->view('admin/header', $data);
            $this->load->view('kategoritahanan/edit');
            $this->load->view('admin/footer');
        } else {

            $data = array(
                'nama_kategori' => $nama_kategori,

            );
            $this->KategoriTahanan_model->update($id_kategori, $data);

            $pesan      = "Data Kategori Tahanan sudah diperbarui.";
            pesan($pesan, 'message', 'success');
            redirect(base_url('KategoriTahanan'));
        }
    }

    public function store()
    {

        $nama_kategori    = $this->input->post('nama_kategori');

        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori Tahanan', 'required|is_unique[kategoritahanan.nama_kategori]', array('required' => 'Kolom nama Kategori Tahanan tidak boleh kosong.', 'is_unique' => 'Nama Kategori Tahanan ini sudah dipakai.'));

        if ($this->form_validation->run() == FALSE) {
            $data['title']          = 'Tambah Data Tahanan';

            $this->load->view('admin/header', $data);
            $this->load->view('kategoritahanan/create');
            $this->load->view('admin/footer');
        } else {

            $data = array(
                'nama_kategori' => $nama_kategori,

            );
            $this->KategoriTahanan_model->store($data);

            $pesan      = "Data Kategori Tahanan sudah disimpan.";
            // $this->session->set_flashdata('message', '<div style="width:100%" class="alert alert-success alert-dismissible fade show" role="alert">' . $pesan . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

            pesan($pesan, 'message', 'success');

            redirect(base_url('kategoritahanan'));
        }
    }

    public function show()
    {
        $id                 = $this->uri->segment(3);
        $data['kategoritahanan'] = $this->KategoriTahanan_model->show($id);
        $data['title']      = 'Tampil Data Tahanan';

        // dd($data['user']);

        $this->load->view('admin/header', $data);
        $this->load->view('kategoritahanan/show');
        $this->load->view('admin/footer');
    }

    public function delete()
    {
        $id_tahanan      = $this->input->post('idHapus');
        $this->db->where('id_kategori', $id_tahanan)->delete('kategoritahanan');

        pesan("Data Kategori Tahanan sudah dihapus.", 'message', 'success');

        redirect(base_url('kategoritahanan'));
    }

    public function unique2($data1, $data2)
    {
        $data3 = explode(",", $data2);
        $result = $this->KategoriTahanan_model->unique($data1, $data3[0], $data3[1], $data3[2]);
        if (count($result) == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
