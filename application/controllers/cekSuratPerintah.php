<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CekSuratPerintah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // is_logged_in();
        //$this->output->cache(2);
    }

    public function show()
    {
        $id                     = $this->input->get('id');
        $id                     = $id . '.png';
        $data['suratperintah']  = $this->SuratPerintah_model->showFromQRCode($id);

        if (count($data['suratperintah']) > 0) {
            $this->load->view('suratperintah/cetakSuratPerintah', $data);
        } else {
            echo "<h1><center>Surat tidak ditemukan</center></h1>";
        }
    }
}
