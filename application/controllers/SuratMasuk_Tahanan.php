<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuratMasuk_Tahanan extends CI_Controller
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
        $tanggal_diterima_awal          = $this->input->get('tanggal_diterima_awal');
        $tanggal_diterima_akhir         = $this->input->get('tanggal_diterima_akhir');
        $id_jenissurat                  = $this->input->get('id_jenissurat');

        $config['base_url']             = base_url('SuratMasuk/?') . 'no_surat=' . $no_surat . '&no_agenda=' . $no_agenda . '&tanggal_diterima_awal=' . $tanggal_diterima_awal . '&tanggal_diterima_akhir=' . $tanggal_diterima_akhir . '&id_jenissurat=' . $id_jenissurat;
        $config['total_rows']           = $this->SuratMasuk_model->total($no_surat, $no_agenda, $tanggal_diterima_awal, $tanggal_diterima_akhir, $id_jenissurat);
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

        $data['suratmasuks']        = $this->SuratMasuk_model->suratmasuk($no_surat, $no_agenda, $tanggal_diterima_awal, $tanggal_diterima_akhir, $id_jenissurat, $config['per_page'], $offset);
        $data['jenissurats']        = $this->JenisSurat_model->jenissurat('masuk');
        $data['offset']             = $offset;
        // dd($data['suratmasuks']);
        $data['title']              = 'Surat Masuk';
        $data['total']              = $config['total_rows'];

        $this->load->view('admin/header', $data);
        $this->load->view('suratmasuk/suratmasuk');
        $this->load->view('admin/footer');
    }

    public function create()
    {
        $data['title']              = 'Tambah Data Surat Masuk';
        $data['jenissurats']        =  $this->JenisSurat_model->jenissurat('masuk');


        $this->load->view('admin/header', $data);
        $this->load->view('suratmasuk/create');
        $this->load->view('admin/footer');
    }

    public function edit()
    {
        $id                     = $this->uri->segment(3);
        $data['suratmasuk']     = $this->SuratMasuk_model->show($id);
        $data['jenissurats']    =  $this->JenisSurat_model->jenissurat('masuk');

        $data['title']          = 'Edit Data Surat Masuk';

        // dd($data['user']);

        $this->load->view('admin/header', $data);
        $this->load->view('suratmasuk/edit');
        $this->load->view('admin/footer');
    }

    public function update()
    {
        $id_suratmasuk      = $this->input->post('id_suratmasuk');
        $no_surat           = $this->input->post('no_surat');
        $no_agenda          = $this->input->post('no_agenda');
        $tanggal_surat      = date('Y-m-d', strtotime($this->input->post('tanggal_surat')));
        $tanggal_diterima   = date('Y-m-d', strtotime($this->input->post('tanggal_diterima')));
        $id_jenissurat      = $this->input->post('id_jenissurat');
        $asal_surat         = $this->input->post('asal_surat');
        $perihal            = $this->input->post('perihal');
        $lampiran           = $this->input->post('lampiran');

        $this->form_validation->set_rules('no_surat', 'Nomor Surat', 'required', array('required' => 'Kolom Nomor Surat Masuk tidak boleh kosong.'));

        if ($this->form_validation->run() == FALSE) {
            $data['title']          = 'Edit Data Surat Masuk';
            $id                     = $this->uri->segment(3);
            $data['suratmasuk']     = $this->SuratMasuk_model->show($id);
            $data['jenissurats']    =  $this->JenisSurat_model->jenissurat('masuk');

            $this->load->view('admin/header', $data);
            $this->load->view('suratmasuk/edit');
            $this->load->view('admin/footer');
        } else {

            $data = array(
                'no_surat' => $no_surat,
                'no_agenda' => $no_agenda,
                'tanggal_surat' => $tanggal_surat,
                'tanggal_diterima' => $tanggal_diterima,
                'id_jenissurat' => $id_jenissurat,
                'asal_surat' => $asal_surat,
                'perihal' => $perihal,
                'lampiran' => $lampiran,

            );

            $this->SuratMasuk_model->update($id_suratmasuk, $data);


            if (!empty($_FILES['user_file'])) {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2200;
                $config['max_width']            = 5000;
                $config['max_height']           = 5000;
                $config['file_name']            = $id_suratmasuk;

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
                        'file' => $id_suratmasuk . '.' . $file_ext
                    );

                    $this->SuratMasuk_model->update($id_suratmasuk, $data);
                    $pesanUpload = 'File berhasil di-upload.';
                }
            } else {
                $pesanUpload = 'Tidak ada file yang di upload.';
            }

            $pesan      = "Data Surat Masuk sudah diperbarui." . ' ' . $pesanUpload;
            // $this->session->set_flashdata('message', '<div style="width:100%" class="alert alert-success alert-dismissible fade show" role="alert">' . $pesan . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

            pesan($pesan, 'message', 'success');

            redirect(base_url('SuratMasuk'));
        }
    }

    public function store()
    {

        $id_tahanan         = $this->input->post('id_tahanan');
        $id_suratmasuk      = $this->input->post('id_suratmasuk');

        // file_put_contents("Pesan SuratMasuk_Tahanan Controller = ", $id_suratmasuk . '-' . $id_tahanan);


        $data = array(
            'id_suratmasuk' => $id_suratmasuk,
            'id_tahanan' => $id_tahanan,
        );

        $this->SuratMasuk_Tahanan_model->store($data);
        echo  "Data Tahanan Surat Masuk sudah ditambahan.";
        // $pesan      = "Data Tahanan Surat Masuk sudah disimpan.";
        // $this->session->set_flashdata('message', '<div style="width:100%" class="alert alert-success alert-dismissible fade show" role="alert">' . $pesan . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

        // pesan($pesan, 'message', 'success');

        // redirect(base_url('SuratMasuk/tahanan/' . $id_suratmasuk));
    }



    public function show()
    {
        $id                 = $this->uri->segment(3);
        $data['suratmasuk'] = $this->SuratMasuk_model->show($id);

        $data['title']      = 'Tampil Data Surat Masuk';

        // dd($data['user']);

        $this->load->view('admin/header', $data);
        $this->load->view('suratmasuk/show');
        $this->load->view('admin/footer');
    }

    public function delete()
    {
        $idHapus        = $this->input->post('idHapus');
        $idSuratMasuk   = $this->input->post('idSuratMasuk');
        $this->db->where('id', $idHapus)->delete('suratmasuk_tahanan');

        pesan("Data Tahana Surat Masuk sudah dihapus.", 'message', 'success');

        redirect(base_url('SuratMasuk/tahanan') . '/' . $idSuratMasuk);
    }

    public function unique2($data1, $data2)
    {
        $data3 = explode(",", $data2);
        $result = $this->SuratMasuk_model->unique($data1, $data3[0], $data3[1], $data3[2]);
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
        $config['base_url']             = base_url('SuratMasuk/tahanan/');
        $config['total_rows']           = $this->Tahanan_model->total();
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

        $data['suratmasuk']         = $this->SuratMasuk_model->show($id);
        $data['tahanans']           = $this->Tahanan_model->tahanan($cari, $config['per_page'], $offset);
        $data['offset']             = $offset;
        // dd($data['tahanans']);
        $data['title']              = 'Surat Masuk > Tambah Data Tahanan';
        $data['total']              = $config['total_rows'];

        $this->load->view('admin/header', $data);
        $this->load->view('suratmasuk_tahanan/suratmasuk_tahanan');
        $this->load->view('admin/footer');
    }
}
