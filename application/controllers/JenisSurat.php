<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenisSurat extends CI_Controller
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
        $tipe                           = $this->input->get('tipe');
        $config['base_url']             = base_url('JenisSurat/?cari=') . $cari;
        $config['total_rows']           = $this->JenisSurat_model->total($cari, $tipe);
        $config['per_page']             = 3;
        $config['page_query_string']    = TRUE;
        // $config['enable_query_strings'] = TRUE;
        $config['reuse_query_string']   = FALSE;
        $offset = html_escape($this->input->get('per_page'));
        $config["uri_segment"] = 3;

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



        $data['jenissurats']        = $this->JenisSurat_model->jenissurat($cari, $tipe, $config['per_page'], $offset);
        $data['offset']             = $offset;
        // dd($data['users']);
        $data['title']              = 'Jenis Surat';
        $data['total']              = $config['total_rows'];

        $this->load->view('admin/header', $data);
        $this->load->view('jenissurat/jenissurat');
        $this->load->view('admin/footer');
    }

    public function create()
    {
        $data['title']  = 'Tambah Data Jenis Surat';

        $this->load->view('admin/header', $data);
        $this->load->view('jenissurat/create');
        $this->load->view('admin/footer');
    }

    public function edit()
    {
        $id                     = $this->uri->segment(3);
        $data['jenissurat']     = $this->JenisSurat_model->show($id);
        $data['title']          = 'Edit Data Jenis Surat';

        // dd($data['user']);

        $this->load->view('admin/header', $data);
        $this->load->view('jenissurat/edit');
        $this->load->view('admin/footer');
    }

    public function update()
    {
        $id_jenissurat      = $this->input->post('id_jenissurat');
        $nama_jenissurat    = $this->input->post('nama_jenissurat');
        $nama_jenissuratlama = $this->input->post('nama_jenissuratlama');
        $parameter          = array($nama_jenissuratlama, 'nama_jenissurat', 'jenissurat');
        $tipe               = $this->input->post('tipe');

        // $this->form_validation->set_rules('nama_jenissurat', 'Nama Jenis Surat', 'required|callback_unique[' . $nama_jenissuratlama . ',"nama_jenissurat","jenissurat"]', array('required' => 'Kolom nama jenis surat tidak boleh kosong.'));
        $this->form_validation->set_rules('nama_jenissurat', 'NamaJenisSurat', 'required|callback_unique2[' . $parameter[0] . ',' . $parameter[1] . ',' . $parameter[2] . ']', array('required' => 'Kolom nama jenis surat tidak boleh kosong.', 'unique2' => 'Nama ini sudah dipakai.'));

        if ($this->form_validation->run() === FALSE) {
            $data['jenissurat']     = $this->JenisSurat_model->show($id_jenissurat);
            $data['title']          = 'Edit Data Jenis Surat';

            $this->load->view('admin/header', $data);
            $this->load->view('jenissurat/edit');
            $this->load->view('admin/footer');
        } else {

            $data = array(
                'nama_jenissurat' => $nama_jenissurat,
                'tipe' => $tipe,
            );
            $this->JenisSurat_model->update($id_jenissurat, $data);

            $pesan      = "Data Jenis Surat sudah diperbarui.";
            pesan($pesan, 'message', 'success');
            redirect(base_url('JenisSurat'));
        }
    }

    public function store()
    {

        $nama_jenissurat    = $this->input->post('nama_jenissurat');
        $tipe               = $this->input->post('tipe');

        $this->form_validation->set_rules('nama_jenissurat', 'Nama Jenis Surat', 'required|is_unique[jenissurat.nama_jenissurat]', array('required' => 'Kolom nama jenis surat tidak boleh kosong.', 'is_unique' => 'Nama jenis surat ini sudah dipakai.'));

        if ($this->form_validation->run() == FALSE) {
            $data['title']          = 'Tambah Data Jenis Surat';

            $this->load->view('admin/header', $data);
            $this->load->view('jenissurat/create');
            $this->load->view('admin/footer');
        } else {

            $data = array(
                'nama_jenissurat' => $nama_jenissurat,
                'tipe' => $tipe,

            );
            $this->JenisSurat_model->store($data);

            $pesan      = "Data Jenis Surat sudah diperbarui.";
            // $this->session->set_flashdata('message', '<div style="width:100%" class="alert alert-success alert-dismissible fade show" role="alert">' . $pesan . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

            pesan($pesan, 'message', 'success');

            redirect(base_url('JenisSurat'));
        }
    }

    public function show()
    {
        $id                 = $this->uri->segment(3);
        $data['jenissurat'] = $this->JenisSurat_model->show($id);
        $data['title']      = 'Tampil Data Jenis Surat';

        // dd($data['user']);

        $this->load->view('admin/header', $data);
        $this->load->view('jenissurat/show');
        $this->load->view('admin/footer');
    }

    public function delete()
    {
        $id_jenissurat      = $this->input->post('idHapus');
        $this->db->where('id_jenissurat', $id_jenissurat)->delete('jenissurat');

        pesan("Data Jenis Surat sudah dihapus.", 'message', 'success');

        redirect(base_url('JenisSurat'));
    }

    public function unique2($data1, $data2)
    {
        $data3 = explode(",", $data2);
        $result = $this->JenisSurat_model->unique($data1, $data3[0], $data3[1], $data3[2]);
        if (count($result) == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}