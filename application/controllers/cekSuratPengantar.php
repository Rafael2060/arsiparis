<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cekSuratPengantar extends CI_Controller
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
        $data['suratpengantar'] = $this->SuratPengantar_model->showFromQRCode($id);

        if (count($data['suratpengantar']) > 0) {
            $this->load->view('suratpengantar/cetakSuratPengantar', $data);
        } else {
            echo "<h1><center>Surat tidak ditemukan</center></h1>";
        }
    }
}
