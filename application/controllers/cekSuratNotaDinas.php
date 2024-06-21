<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CekSuratNotaDinas extends CI_Controller
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
        $data['suratnotadinas'] = $this->SuratNotaDinas_model->showFromQRCode($id);

        if (count($data['suratnotadinas']) > 0) {
            $this->load->view('suratnotadinas/cetakSuratNotaDinas', $data);
        } else {
            echo "<h1><center>Surat tidak ditemukan</center></h1>";
        }
    }
}
