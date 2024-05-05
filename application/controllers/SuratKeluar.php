<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuratKeluar extends CI_Controller
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
        $no_surat                       = $this->input->get('no_surat');
        $no_agenda                      = $this->input->get('no_agenda');
        $tanggal_dikirim_awal           = $this->input->get('tanggal_dikirim_awal');
        $tanggal_dikirim_akhir          = $this->input->get('tanggal_dikirim_akhir');
        $id_jenissurat                  = $this->input->get('id_jenissurat');

        $config['base_url']             = base_url('SuratKeluar/?') . 'no_surat=' . $no_surat . '&no_agenda=' . $no_agenda . '&tanggal_dikirim_awal=' . $tanggal_dikirim_awal . '&tanggal_dikirim_akhir=' . $tanggal_dikirim_akhir . '&id_jenissurat=' . $id_jenissurat;
        $config['total_rows']           = $this->SuratKeluar_model->total($no_surat, $no_agenda, $tanggal_dikirim_awal, $tanggal_dikirim_akhir, $id_jenissurat);
        // dd($config['total_rows']);
        $config['per_page']             = 5;
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

        $data['suratkeluars']       = $this->SuratKeluar_model->suratkeluar($no_surat, $no_agenda, $tanggal_dikirim_awal, $tanggal_dikirim_akhir, $id_jenissurat, $config['per_page'], $offset);
        $data['jenissurats']        = $this->JenisSurat_model->jenissurat('keluar');
        $data['offset']             = $offset;
        // dd($data['suratkeluars']);
        $data['title']              = 'Surat Keluar';
        $data['total']              = $config['total_rows'];

        $this->load->view('admin/header', $data);
        $this->load->view('suratkeluar/suratkeluar');
        $this->load->view('admin/footer');
    }

    public function create()
    {
        $data['title']              = 'Tambah Data Surat Keluar';
        $data['jenissurats']        =  $this->JenisSurat_model->jenissurat('keluar');


        $this->load->view('admin/header', $data);
        $this->load->view('suratkeluar/create');
        $this->load->view('admin/footer');
    }

    public function edit()
    {
        $id                     = $this->uri->segment(3);
        $data['suratkeluar']     = $this->SuratKeluar_model->show($id);
        $data['jenissurats']    =  $this->JenisSurat_model->jenissurat('keluar');

        $data['title']          = 'Edit Data Surat Keluar';

        // dd($data['user']);

        $this->load->view('admin/header', $data);
        $this->load->view('suratkeluar/edit');
        $this->load->view('admin/footer');
    }

    public function update()
    {
        $id_suratkeluar     = $this->input->post('id_suratkeluar');
        $no_surat           = $this->input->post('no_surat');
        $no_agenda          = $this->input->post('no_agenda');
        $tanggal_surat      = date('Y-m-d', strtotime($this->input->post('tanggal_surat')));
        $tanggal_dikirim    = date('Y-m-d', strtotime($this->input->post('tanggal_dikirim')));
        $id_jenissurat      = $this->input->post('id_jenissurat');
        $tujuan_surat       = $this->input->post('tujuan_surat');
        $perihal            = $this->input->post('perihal');
        $lampiran           = $this->input->post('lampiran');

        $this->form_validation->set_rules('no_surat', 'Nomor Surat', 'required', array('required' => 'Kolom Nomor Surat Keluar tidak boleh kosong.'));

        if ($this->form_validation->run() == FALSE) {
            $data['title']          = 'Edit Data Surat Keluar';
            $id                     = $this->uri->segment(3);
            $data['suratkeluar']    = $this->SuratKeluar_model->show($id);
            $data['jenissurats']    =  $this->JenisSurat_model->jenissurat('keluar');

            $this->load->view('admin/header', $data);
            $this->load->view('suratkeluar/edit');
            $this->load->view('admin/footer');
        } else {

            $data = array(
                'no_surat' => $no_surat,
                'no_agenda' => $no_agenda,
                'tanggal_surat' => $tanggal_surat,
                'tanggal_dikirim' => $tanggal_dikirim,
                'id_jenissurat' => $id_jenissurat,
                'tujuan_surat' => $tujuan_surat,
                'perihal' => $perihal,
                'lampiran' => $lampiran,

            );

            $this->SuratKeluar_model->update($id_suratkeluar, $data);


            if (!empty($_FILES['user_file'])) {
                $config['upload_path']          = './uploads/keluar/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2200;
                $config['max_width']            = 5000;
                $config['max_height']           = 5000;
                $config['file_name']            = $id_suratkeluar;
                $config['overwrite']            = TRUE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('user_file')) {
                    // $pesanUpload = array('error' => $this->upload->display_errors());
                    $pesanUpload = $this->upload->display_errors();
                } else {
                    // $data = array('upload_data' => $this->upload->data());
                    $filename = $_FILES["user_file"]["name"];
                    $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $data = array(
                        'file' => $id_suratkeluar . '.' . $file_ext
                    );

                    $this->SuratKeluar_model->update($id_suratkeluar, $data);
                    $pesanUpload = 'File berhasil di-upload.';
                }
            } else {
                $pesanUpload = 'Tidak ada file yang di upload.';
            }

            $pesan      = "Data Surat Keluar sudah diperbarui." . ' ' . $pesanUpload;
            // $this->session->set_flashdata('message', '<div style="width:100%" class="alert alert-success alert-dismissible fade show" role="alert">' . $pesan . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

            pesan($pesan, 'message', 'success');

            redirect(base_url('SuratKeluar'));
        }
    }

    public function store()
    {

        $no_surat           = $this->input->post('no_surat');
        $no_agenda          = $this->input->post('no_agenda');
        $tanggal_surat      = date('Y-m-d', strtotime($this->input->post('tanggal_surat')));
        $tanggal_dikirim   = date('Y-m-d', strtotime($this->input->post('tanggal_dikirim')));
        $id_jenissurat      = $this->input->post('id_jenissurat');
        $tujuan_surat      = $this->input->post('tujuan_surat');

        $perihal            = $this->input->post('perihal');
        $lampiran           = $this->input->post('lampiran');

        $this->form_validation->set_rules('no_surat', 'Nomor Surat', 'required', array('required' => 'Kolom Nomor Surat Keluar tidak boleh kosong.'));

        if ($this->form_validation->run() == FALSE) {
            $data['title']          = 'Tambah Data Surat Keluar';
            $data['jenissurats']        =  $this->JenisSurat_model->jenissurat('keluar');

            $this->load->view('admin/header', $data);
            $this->load->view('suratkeluar/create');
            $this->load->view('admin/footer');
        } else {

            $data = array(
                'no_surat' => $no_surat,
                'no_agenda' => $no_agenda,
                'tanggal_surat' => $tanggal_surat,
                'tanggal_dikirim' => $tanggal_dikirim,
                'id_jenissurat' => $id_jenissurat,
                'tujuan_surat' => $tujuan_surat,

                'perihal' => $perihal,
                'lampiran' => $lampiran,

            );

            $lastId = $this->SuratKeluar_model->store($data);

            if ($_FILES['user_file']) {
                $config['upload_path']          = './uploads/keluar/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2200;
                $config['max_width']            = 5000;
                $config['max_height']           = 5000;
                $config['file_name']            = $lastId;
                $config['overwrite']            = TRUE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('user_file')) {
                    // $pesanUpload = array('error' => $this->upload->display_errors());
                    $pesanUpload = $this->upload->display_errors();
                } else {
                    // $data = array('upload_data' => $this->upload->data());
                    $filename = $_FILES["user_file"]["name"];
                    $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $data = array(
                        'file' => $lastId . '.' . $file_ext
                    );

                    $this->SuratKeluar_model->update($lastId, $data);
                    $pesanUpload = 'File berhasil di-upload.';
                }
            } else {
                $pesanUpload = 'Tidak ada file yang di upload.';
            }

            $pesan      = "Data Surat Keluar sudah disimpan." . ' ' . $pesanUpload;
            // $this->session->set_flashdata('message', '<div style="width:100%" class="alert alert-success alert-dismissible fade show" role="alert">' . $pesan . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

            pesan($pesan, 'message', 'success');

            redirect(base_url('SuratKeluar'));
        }
    }

    public function show()
    {
        $id                 = $this->uri->segment(3);
        $data['suratmasuk'] = $this->SuratKeluar_model->show($id);

        $data['title']      = 'Tampil Data Surat Masuk';

        // dd($data['user']);

        $this->load->view('admin/header', $data);
        $this->load->view('suratkeluar/show');
        $this->load->view('admin/footer');
    }

    public function delete()
    {
        $id_suratkeluar      = $this->input->post('idHapus');
        $this->db->where('id_suratkeluar', $id_suratkeluar)->delete('suratkeluar');
        $this->db->where('id_suratkeluar', $id_suratkeluar)->delete('suratkeluar_tahanan');

        pesan("Data Surat Keluar sudah dihapus.", 'message', 'success');

        redirect(base_url('SuratKeluar'));
    }

    public function unique2($data1, $data2)
    {
        $data3 = explode(",", $data2);
        $result = $this->SuratKeluar_model->unique($data1, $data3[0], $data3[1], $data3[2]);
        if (count($result) == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function tahanan()
    {
        $id                             = $this->uri->segment(3);
        $cari                           = $this->input->get('cari');
        $config['base_url']             = base_url('SuratKeluar/tahanan/' . $id);
        $config['total_rows']           = $this->SuratKeluar_Tahanan_model->total($id);
        $config['per_page']             = 5;
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
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';

        $this->pagination->initialize($config);

        $data['suratkeluar']            = $this->SuratKeluar_model->show($id);
        // $data['tahanans']               = $this->Tahanan_model->tahanan($cari, $config['per_page'], $offset);
        $data['suratkeluar_tahanans']   = $this->SuratKeluar_Tahanan_model->suratkeluar_tahanan($id, $config['per_page'], $offset);
        $data['offset']                 = $offset;
        // dd($data['tahanans']);
        $data['title']                  = 'Surat Keluar > Tambah Data Tahanan';
        $data['total']                  = $config['total_rows'];

        $this->load->view('admin/header', $data);
        $this->load->view('suratkeluar_tahanan/suratkeluar_tahanan');
        $this->load->view('admin/footer');
    }
}
