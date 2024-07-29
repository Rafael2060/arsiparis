<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuratKeluar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        if ($this->session->userdata('role_id') == '1') {
            redirect('Admin');
        }

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
        $id_tahanan                     = $this->input->get('id_tahanan');
        $tolak                          = $this->input->get('tolak');
        $status                         = $this->input->get('status');

        $config['base_url']             = base_url('SuratKeluar/?') . 'no_surat=' . $no_surat . '&no_agenda=' . $no_agenda . '&tanggal_dikirim_awal=' . $tanggal_dikirim_awal . '&tanggal_dikirim_akhir=' . $tanggal_dikirim_akhir . '&id_jenissurat=' . $id_jenissurat;
        $config['total_rows']           = $this->SuratKeluar_model->total($no_surat, $no_agenda, $tanggal_dikirim_awal, $tanggal_dikirim_akhir, $id_jenissurat);
        // dd($config['total_rows']);
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

        $data['suratkeluars']       = $this->SuratKeluar_model->suratkeluar($no_surat, $no_agenda, $tanggal_dikirim_awal, $tanggal_dikirim_akhir, $id_jenissurat, $id_tahanan, '0', $tolak, $config['per_page'], $offset);
        $data['jenissurats']        = $this->JenisSurat_model->jenissurat('keluar');
        $data['offset']             = $offset;
        $data['parameter']          = array(
            'no_surat' => $no_surat,
            'no_agenda' => $no_agenda,
            'tanggal_dikirim_awal'  => $tanggal_dikirim_awal,
            'tanggal_dikirim_akhir' => $tanggal_dikirim_akhir,
            'id_jenissurat' => $id_jenissurat,
        );
        // dd($data['suratkeluars']);
        $data['title']              = 'Surat Keluar';
        $data['total']              = $config['total_rows'];
        $data['role_id']            = $this->session->userdata('role_id');

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

    public function editTTE()
    {
        $id                     = $this->uri->segment(3);
        $data['suratkeluar']    = $this->SuratKeluar_model->show($id);
        $data['jenissurats']    = $this->JenisSurat_model->jenissurat('keluar');

        $data['title']          = 'Edit Data Surat Keluar';

        // dd($data['user']);

        $this->load->view('admin/header', $data);
        $this->load->view('suratkeluar/editTTE');
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
            $id                     = $id_suratkeluar;
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
                $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
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

    public function updateTTE()
    {
        $id_suratkeluar     = $this->input->post('id_suratkeluar');

        if (!empty($_FILES['user_file'])) {
            $config['upload_path']          = './uploads/keluar/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
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

        $pesan      = "Data TTE Surat Keluar sudah diperbarui." . ' ' . $pesanUpload;
        // $this->session->set_flashdata('message', '<div style="width:100%" class="alert alert-success alert-dismissible fade show" role="alert">' . $pesan . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

        pesan($pesan, 'message', 'success');

        redirect(base_url('SuratKeluar'));
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

        $role_id            = $this->session->userdata('role_id');
        $user_id            = $this->session->userdata('id');

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

            $data2 = array(
                'tanggal_verifikasi' => date('Y-m-d', time()),
                'id_suratkeluar' => $lastId,
                'dibaca' => '1',
                'role_id' => $role_id,
                'target_role_id' => $role_id,
                'user_id' => $user_id,
            );

            $this->Verifikasi_model->store($data2);

            if ($_FILES['user_file']) {
                $config['upload_path']          = './uploads/keluar/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
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
        $id                     = $this->input->get('id');
        $data['suratkeluar']    = $this->SuratKeluar_model->show($id);
        // dd($data['suratkeluar']);
        $data['verifikasis']    = $this->SuratKeluar_model->showVerifikasi($id);
        $data['tahanans']       = $this->SuratKeluar_model->showTahanan($id);
        $data['roles']          = $this->Role_model->role();
        $id_verifikasi          = $this->input->get('id_verifikasi');
        $id_suratkeluar         = $this->input->get('id_suratkeluar');
        $data['role_id']            = $this->session->userdata('role_id');


        $data['title']          = 'Tampil Data Surat Keluar';

        $role_id                = $this->session->userdata('role_id');
        // dd($role_id);
        $data2 = array('dibaca' => '1');
        $this->Verifikasi_model->updateStatusBaca($id_suratkeluar, $data2, $role_id);


        $this->load->view('admin/header', $data);
        $this->load->view('suratkeluar/show');
        $this->load->view('admin/footer');
    }

    public function delete()
    {
        $id_suratkeluar      = $this->input->post('idHapus');
        $this->db->where('id_suratkeluar', $id_suratkeluar)->delete('suratkeluar');
        $this->db->where('id_suratkeluar', $id_suratkeluar)->delete('suratkeluar_tahanan');
        $this->db->where('id_suratkeluar', $id_suratkeluar)->delete('verifikasi');

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

    public function export()
    {
        $id_tahanan                     = $this->input->get('id_tahanan');
        $no_surat                       = $this->input->get('no_surat');
        $no_agenda                      = $this->input->get('no_agenda');
        $tanggal_dikirim_awal           = $this->input->get('tanggal_dikirim_awal');
        $tanggal_dikirim_akhir          = $this->input->get('tanggal_dikirim_akhir');
        $id_jenissurat                  = $this->input->get('id_jenissurat');
        $status                         = $this->input->get('status');
        $tolak                          = $this->input->get('tolak');
        // Load plugin PHPExcel nya
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('My Notes Code')
            ->setLastModifiedBy('My Notes Code')
            ->setTitle("Rekap Surat Keluar")
            ->setSubject("Surat Keluar")
            ->setDescription("Laporan Semua Rekap Surat Keluar")
            ->setKeywords("Rekap Surat Keluar");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "REKAP SURAT KELUAR"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:I1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NO SURAT"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "NO AGENDA"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "TUJUAN SURAT"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "TANGGAL SURAT"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "TANGGAL DIKIRIM"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "JENIS SURAT"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "PERIHAL"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "LAMPIRAN"); // Set kolom E3 dengan tulisan "ALAMAT"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $suratkeluars = $this->SuratKeluar_model->suratkeluar($no_surat, $no_agenda, $tanggal_dikirim_awal, $tanggal_dikirim_akhir, $id_jenissurat, $id_tahanan, '0', $tolak);
        // dd($suratkeluars);
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($suratkeluars as $data) { // Lakukan looping pada variabel siswa
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data['no_surat']);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data['no_agenda']);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data['tujuan_surat']);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data['tanggal_surat']);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data['tanggal_dikirim']);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data['nama_jenissurat']);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data['perihal']);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data['lampiran']);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15); // Set width kolom E
        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Rekap Surat Keluar");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Rekap Surat Keluar.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    public function cetakNotaDinas()
    {
        $this->load->view('suratkeluar/cetakNotaDinas');
    }

    public function cetakSuratPerintah()
    {

        $namafile   = time();
        $this->cetakQRCode($namafile);

        $this->load->view('suratkeluar/cetakSuratPerintah');
    }

    public function cetakSuratPengantar()
    {


        $this->load->view('suratkeluar/cetakSuratPengantar');
    }

    public function cetakQRCode($namafile)
    {
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $namafile . '.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $namafile; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
    }
}
