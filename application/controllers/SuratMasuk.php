<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuratMasuk extends CI_Controller
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
        $id_tahanan                     = $this->input->get('id_tahanan');
        $no_surat                       = $this->input->get('no_surat');
        $no_agenda                      = $this->input->get('no_agenda');
        $tanggal_diterima_awal          = $this->input->get('tanggal_diterima_awal');
        $tanggal_diterima_akhir         = $this->input->get('tanggal_diterima_akhir');
        $id_jenissurat                  = $this->input->get('id_jenissurat');
        $status                         = $this->input->get('status');
        $tolak                          = $this->input->get('tolak');

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

        $data['suratmasuks']        = $this->SuratMasuk_model->suratmasuk($no_surat, $no_agenda, $tanggal_diterima_awal, $tanggal_diterima_akhir, $id_jenissurat, $id_tahanan, '0', $tolak, $config['per_page'], $offset);
        $data['jenissurats']        = $this->JenisSurat_model->jenissurat('masuk');
        $data['offset']             = $offset;
        $data['parameter']          = array(
            'no_surat' => $no_surat,
            'no_agenda' => $no_agenda,
            'tanggal_diterima_awal' => $tanggal_diterima_awal,
            'tanggal_diterima_akhir' => $tanggal_diterima_akhir,
            'id_jenissurat' => $id_jenissurat,
        );
        // dd($data['suratmasuks']);
        $data['title']              = 'Surat Masuk';
        $data['total']              = $config['total_rows'];
        $data['role_id']            = $this->session->userdata('role_id');


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
            $id                     = $this->input->post('id_suratmasuk');
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
                $config['upload_path']          = './uploads/masuk/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
                $config['max_size']             = 2200;
                $config['max_width']            = 5000;
                $config['max_height']           = 5000;
                $config['file_name']            = $id_suratmasuk;
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

        $no_surat           = $this->input->post('no_surat');
        $no_agenda          = $this->input->post('no_agenda');
        $tanggal_surat      = date('Y-m-d', strtotime($this->input->post('tanggal_surat')));
        $tanggal_diterima   = date('Y-m-d', strtotime($this->input->post('tanggal_diterima')));
        $id_jenissurat      = $this->input->post('id_jenissurat');
        $asal_surat         = $this->input->post('asal_surat');
        $perihal            = $this->input->post('perihal');
        $lampiran           = $this->input->post('lampiran');

        $role_id            = $this->session->userdata('role_id');
        $user_id            = $this->session->userdata('id');

        $this->form_validation->set_rules('no_surat', 'Nomor Surat', 'required', array('required' => 'Kolom Nomor Surat Masuk tidak boleh kosong.'));

        if ($this->form_validation->run() == FALSE) {
            $data['title']          = 'Tambah Data Surat Masuk';

            $this->load->view('admin/header', $data);
            $this->load->view('suratmasuk/create');
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

            $lastId = $this->SuratMasuk_model->store($data);

            $data2 = array(
                'tanggal_disposisi' => date('Y-m-d', time()),
                'id_suratmasuk' => $lastId,
                'dibaca' => '1',
                'role_id' => $role_id,
                'target_role_id' => $role_id,
                'user_id' => $user_id,
            );

            $this->Disposisi_model->store($data2);

            if ($_FILES['user_file']) {
                $config['upload_path']          = './uploads/masuk/';
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

                    $this->SuratMasuk_model->update($lastId, $data);
                    $pesanUpload = 'File berhasil di-upload.';
                }
            } else {
                $pesanUpload = 'Tidak ada file yang di upload.';
            }

            $pesan      = "Data Surat Masuk sudah disimpan." . ' ' . $pesanUpload;
            // $this->session->set_flashdata('message', '<div style="width:100%" class="alert alert-success alert-dismissible fade show" role="alert">' . $pesan . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

            pesan($pesan, 'message', 'success');

            redirect(base_url('SuratMasuk'));
        }
    }

    public function show()
    {
        $id                   = $this->input->get('id');
        $data['suratmasuk']   = $this->SuratMasuk_model->show($id);
        // $data['suratmasuk']   = $this->SuratMasuk_model->suratmasukId($id, '0');

        $data['disposisis']   = $this->SuratMasuk_model->showDisposisi($id);
        $data['tahanans']     = $this->SuratMasuk_model->showTahanan($id);
        $data['roles']        = $this->Role_model->role();
        $id_disposisi         = $this->input->get('id_disposisi');
        $data['title']        = 'Tampil Data Surat Masuk';
        $data['role_id']            = $this->session->userdata('role_id');

        // dd($data['suratmasuk']);

        $role_id                = $this->session->userdata('role_id');

        $data2 = array('dibaca' => '1');
        $this->Disposisi_model->updateStatusBaca($id_disposisi, $data2, $role_id);

        $this->load->view('admin/header', $data);
        $this->load->view('suratmasuk/show');
        $this->load->view('admin/footer');
    }

    public function delete()
    {
        $id_suratmasuk      = $this->input->post('idHapus');
        $this->db->where('id_suratmasuk', $id_suratmasuk)->delete('suratmasuk');
        $this->db->where('id_suratmasuk', $id_suratmasuk)->delete('suratmasuk_tahanan');
        $this->db->where('id_suratmasuk', $id_suratmasuk)->delete('disposisi');

        pesan("Data Surat Masuk sudah dihapus.", 'message', 'success');

        redirect(base_url('SuratMasuk'));
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
        $config['base_url']             = base_url('SuratMasuk/tahanan/' . $id);
        $config['total_rows']           = $this->SuratMasuk_Tahanan_model->total($id);
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

        $data['suratmasuk']             = $this->SuratMasuk_model->show($id);
        // $data['tahanans']               = $this->Tahanan_model->tahanan($cari, $config['per_page'], $offset);
        $data['suratmasuk_tahanans']    = $this->SuratMasuk_Tahanan_model->suratmasuk_tahanan($id, $config['per_page'], $offset);
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
        $tanggal_diterima_awal          = $this->input->get('tanggal_diterima_awal');
        $tanggal_diterima_akhir         = $this->input->get('tanggal_diterima_akhir');
        $id_jenissurat                  = $this->input->get('id_jenissurat');
        $tolak                          = $this->input->get('tolak');
        // Load plugin PHPExcel nya
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('My Notes Code')
            ->setLastModifiedBy('My Notes Code')
            ->setTitle("Rekap Surat Masuk")
            ->setSubject("Surat Masuk")
            ->setDescription("Laporan Semua Data Surat Masuk")
            ->setKeywords("Rekap Surat Masuk");
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
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "REKAP SURAT MASUK"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:I1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NO SURAT"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "NO AGENDA"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "ASAL SURAT"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "TANGGAL SURAT"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "TANGGAL DITERIMA"); // Set kolom E3 dengan tulisan "ALAMAT"
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
        $suratmasuks = $this->SuratMasuk_model->suratmasuk($no_surat, $no_agenda, $tanggal_diterima_awal, $tanggal_diterima_akhir, $id_jenissurat, $id_tahanan, '0', $tolak);
        // dd($suratmasuks);
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($suratmasuks as $data) { // Lakukan looping pada variabel siswa
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data['no_surat']);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data['no_agenda']);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data['asal_surat']);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data['tanggal_surat']);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data['tanggal_diterima']);
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
        $excel->getActiveSheet(0)->setTitle("Rekap Data Surat Masuk");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Rekap Surat Masuk.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
}
