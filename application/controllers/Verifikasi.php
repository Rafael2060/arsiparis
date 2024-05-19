<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi extends CI_Controller
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
        $id_tahanan                     = $this->input->get('id_tahanan');
        $no_surat                       = $this->input->get('no_surat');
        $no_agenda                      = $this->input->get('no_agenda');
        $tanggal_verifikasi_awal        = $this->input->get('tanggal_verifikasi_awal');
        $tanggal_verifikasi_akhir       = $this->input->get('tanggal_verifikasi_akhir');
        $id_jenissurat                  = $this->input->get('id_jenissurat');

        $config['base_url']             = base_url('Verifikasi/?') . 'no_surat=' . $no_surat . '&no_agenda=' . $no_agenda . '&tanggal_verifikasi_awal=' . $tanggal_verifikasi_awal . '&tanggal_verifikasi_akhir=' . $tanggal_verifikasi_akhir . '&id_jenissurat=' . $id_jenissurat;
        $config['total_rows']           = $this->Verifikasi_model->total($no_surat, $no_agenda, $tanggal_verifikasi_awal, $tanggal_verifikasi_akhir, $id_jenissurat);
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

        $data['verifikasis']        = $this->Verifikasi_model->verifikasi($no_surat, $no_agenda, $tanggal_verifikasi_awal, $tanggal_verifikasi_akhir, $id_jenissurat, $id_tahanan, $config['per_page'], $offset);

        $data['offset']             = $offset;
        $data['parameter']          = array(
            'no_surat' => $no_surat,
            'no_agenda' => $no_agenda,
            'tanggal_verifikasi_awal' => $tanggal_verifikasi_awal,
            'tanggal_verifikasi_akhir' => $tanggal_verifikasi_akhir,

        );
        // dd($data['verifikasis']);
        $data['title']              = 'Verifikasi Surat';
        $data['total']              = $config['total_rows'];

        $this->load->view('admin/header', $data);
        $this->load->view('verifikasi/verifikasi');
        $this->load->view('admin/footer');
    }

    public function create()
    {
        $id                     = $this->input->get('id');
        $data['id_suratkeluar'] = $this->input->get('id_suratkeluar');
        $data['title']          = 'Verifikasi Surat Keluar';
        $data['suratkeluar']    = $this->SuratKeluar_model->show($id);
        $data['roles']          = $this->Role_model->role();
        $data['tahanans']       = $this->SuratKeluar_model->showTahanan($id);
        $data['role_id']        = $this->session->userdata('role_id');


        $this->load->view('admin/header', $data);
        if ($this->session->userdata('role_id') == '6') {
            $this->load->view('verifikasi/createFinal');
        } else {
            $this->load->view('verifikasi/create');
        }
        $this->load->view('admin/footer');
    }

    public function edit()
    {
        $id                     = $this->uri->segment(3);
        $data['suratkeluar']     = $this->Verifikasi_model->show($id);
        $data['jenissurats']    =  $this->JenisSurat_model->jenissurat('masuk');

        $data['title']          = 'Edit Data Surat Keluar';

        // dd($data['user']);

        $this->load->view('admin/header', $data);
        $this->load->view('verifikasi/edit');
        $this->load->view('admin/footer');
    }

    public function update()
    {
        $id_suratkeluar     = $this->input->post('id_suratkeluar');
        $no_surat           = $this->input->post('no_surat');
        $no_agenda          = $this->input->post('no_agenda');
        $tanggal_surat      = date('Y-m-d', strtotime($this->input->post('tanggal_surat')));
        $tanggal_verifikasi = date('Y-m-d', strtotime($this->input->post('tanggal_verifikasi')));
        $id_jenissurat      = $this->input->post('id_jenissurat');
        $asal_surat         = $this->input->post('asal_surat');
        $perihal            = $this->input->post('perihal');
        $lampiran           = $this->input->post('lampiran');

        $this->form_validation->set_rules('no_surat', 'Nomor Surat', 'required', array('required' => 'Kolom Nomor Surat Keluar tidak boleh kosong.'));

        if ($this->form_validation->run() == FALSE) {
            $data['title']          = 'Edit Data Surat Keluar';
            $id                     =  $this->input->post('id_suratkeluar');
            $data['suratkeluar']     =  $this->Verifikasi_model->show($id);
            $data['jenissurats']    =  $this->JenisSurat_model->jenissurat('keluar');

            $this->load->view('admin/header', $data);
            $this->load->view('verifikasi/edit');
            $this->load->view('admin/footer');
        } else {

            $data = array(
                'no_surat' => $no_surat,
                'no_agenda' => $no_agenda,
                'tanggal_surat' => $tanggal_surat,
                'tanggal_verifikasi' => $tanggal_verifikasi,
                'id_jenissurat' => $id_jenissurat,
                'asal_surat' => $asal_surat,
                'perihal' => $perihal,
                'lampiran' => $lampiran,

            );

            $this->Verifikasi_model->update($id_suratkeluar, $data);


            if (!empty($_FILES['user_file'])) {
                $config['upload_path']          = './uploads/masuk/';
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

                    $this->Verifikasi_model->update($id_suratkeluar, $data);
                    $pesanUpload = 'File berhasil di-upload.';
                }
            } else {
                $pesanUpload = 'Tidak ada file yang di upload.';
            }

            $pesan      = "Data Surat Masuk sudah diperbarui." . ' ' . $pesanUpload;
            // $this->session->set_flashdata('message', '<div style="width:100%" class="alert alert-success alert-dismissible fade show" role="alert">' . $pesan . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

            pesan($pesan, 'message', 'success');

            redirect(base_url('suratkeluar'));
        }
    }

    public function store()
    {

        $id_suratkeluar     = $this->input->post('id_suratkeluar');

        $target_role_id     = $this->input->post('target_role_id');
        $catatan            = $this->input->post('catatan');
        $target             = $this->input->post('target');
        $user_id            = $this->session->userdata('id');
        $role_id            = $this->session->userdata('role_id');
        $tolak              = $this->input->post('tolak');

        if ($tolak == '1') {
            $statusSelesai = '1';
        } else {
            $statusSelesai = '0';
        }


        $tanggal_verifikasi  = date('Y-m-d', strtotime($this->input->post('tanggal_verifikasi')));
        if ($tanggal_verifikasi == '1970-01-01') {
            $tanggal_verifikasi = date('Y-m-d', time());
        }
        // dd($this->input->post('tanggal_verifikasi'));

        $this->form_validation->set_rules('tanggal_verifikasi', 'Tanggal verifikasi', 'required', array('required' => 'Kolom tanggal verifikasi tidak boleh kosong.'));

        if ($this->form_validation->run() == FALSE) {
            $id                     = $this->input->post('id_suratkeluar');
            $data['id_suratkeluar'] = $this->input->get('id_suratkeluar');
            $data['title']          = 'Verifikasi Surat Keluar';
            $data['suratkeluar']    = $this->SuratKeluar_model->show($id);
            $data['roles']          = $this->Role_model->role();
            $data['tahanans']       = $this->SuratKeluar_model->showTahanan($id);

            $this->load->view('admin/header', $data);
            if ($this->session->userdata('role_id') == '6') {
                $this->load->view('verifikasi/createFinal');
            } else {
                $this->load->view('verifikasi/create');
            }
            $this->load->view('admin/footer');
        } else {

            if ($role_id == '6') {
                $data = array(
                    'id_suratkeluar' => $id_suratkeluar,
                    'tanggal_verifikasi' => $tanggal_verifikasi,
                    'catatan' => $catatan,
                    'target_role_id' => $target_role_id,
                    'user_id' => $user_id,
                    'role_id' => $role_id,
                    'tolak' => $tolak,
                    'dibaca' => '1',
                    'status' => '1',
                );
            } else {

                $data = array(
                    'id_suratkeluar' => $id_suratkeluar,
                    'tanggal_verifikasi' => $tanggal_verifikasi,
                    'catatan' => $catatan,
                    'target_role_id' => $target_role_id,
                    'user_id' => $user_id,
                    'role_id' => $role_id,
                    'tolak' => $tolak,
                    'dibaca' => '1',
                    'status' => $statusSelesai,
                );
            }
            $this->Verifikasi_model->store($data);

            $data2 = array(
                'dibaca' => '1',
                'status' => '1',
            );
            $this->Verifikasi_model->update($id_suratkeluar, $data2);

            if ($tolak == '1') {
                $statusTolak = 'Ditolak';
            } else {
                $statusTolak = 'Diterima';
            }
            if ($role_id == '6') {
                $pesan      = "Proses Data Surat Keluar sudah selesai dengan status " . $statusTolak . ".";
            } else {
                $pesan      = "Data Surat Keluar sudah diteruskan ke " . $target;
            }
            $this->session->set_flashdata('message', '<div style="width:100%" class="alert alert-success alert-dismissible fade show" role="alert">' . $pesan . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

            pesan($pesan, 'message', 'success');

            redirect(base_url('suratkeluar'));
        }
    }

    public function show()
    {
        $id                 = $this->uri->segment(3);
        $data['suratkeluar'] = $this->Verifikasi_model->show($id);

        $data['title']      = 'Tampil Data Surat Keluar';

        // dd($data['user']);

        $this->load->view('admin/header', $data);
        $this->load->view('verifikasi/show');
        $this->load->view('admin/footer');
    }

    public function delete()
    {
        $id_suratkeluar      = $this->input->post('idHapus');
        $this->db->where('id_suratkeluar', $id_suratkeluar)->delete('suratkeluar');
        $this->db->where('id_suratkeluar', $id_suratkeluar)->delete('suratkeluar_tahanan');

        pesan("Data Surat Keluar sudah dihapus.", 'message', 'success');

        redirect(base_url('suratkeluar'));
    }

    public function unique2($data1, $data2)
    {
        $data3 = explode(",", $data2);
        $result = $this->Verifikasi_model->unique($data1, $data3[0], $data3[1], $data3[2]);
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
        $config['base_url']             = base_url('verifikasi/tahanan/' . $id);
        $config['total_rows']           = $this->verifikasi_Tahanan_model->total($id);
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

        $data['suratkeluar']             = $this->Verifikasi_model->show($id);
        // $data['tahanans']               = $this->Tahanan_model->tahanan($cari, $config['per_page'], $offset);
        $data['suratmasuk_tahanans']    = $this->verifikasi_Tahanan_model->verifikasi_tahanan($id, $config['per_page'], $offset);
        $data['offset']                 = $offset;
        // dd($data['tahanans']);
        $data['title']                  = 'Surat Masuk > Tambah Data Tahanan';
        $data['total']                  = $config['total_rows'];

        $this->load->view('admin/header', $data);
        $this->load->view('suratmasuk_tahanan/suratmasuk_tahanan');
        $this->load->view('admin/footer');
    }

    public function export()
    {
        $id_tahanan                     = $this->input->get('id_tahanan');
        $no_surat                       = $this->input->get('no_surat');
        $no_agenda                      = $this->input->get('no_agenda');
        $tanggal_verifikasi_awal        = $this->input->get('tanggal_verifikasi_awal');
        $tanggal_verifikasi_akhir       = $this->input->get('tanggal_verifikasi_akhir');
        $id_jenissurat                  = $this->input->get('id_jenissurat');
        // Load plugin PHPExcel nya
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('My Notes Code')
            ->setLastModifiedBy('My Notes Code')
            ->setTitle("Data Siswa")
            ->setSubject("Siswa")
            ->setDescription("Laporan Semua Data Siswa")
            ->setKeywords("Data Siswa");
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
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA SISWA"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NIS"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "JENIS KELAMIN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "ALAMAT"); // Set kolom E3 dengan tulisan "ALAMAT"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $verfikasis = $this->Verifikasi_model->verifikasi($no_surat, $no_agenda, $tanggal_verifikasi_awal, $tanggal_verifikasi_akhir, $id_jenissurat);
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($verfikasis as $data) { // Lakukan looping pada variabel siswa
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data['no_surat']);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data['no_agenda']);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data['tanggal_surat']);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data['tanggal_verfikasi']);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Laporan Data Surat Keluar");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Surat Keluar.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
}
