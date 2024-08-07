<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        //$this->output->cache(2);
    }

    public function index()
    {
        $data['title']              = 'Dasboard';
        $data['totalsuratmasuk']    = $this->SuratMasuk_model->totalsuratmasuk();
        $data['totalsuratkeluar']   = $this->SuratKeluar_model->totalsuratkeluar();
        $data['totaltahanan']       = $this->Tahanan_model->totaltahanan();


        $this->load->view('admin/headerAdmin', $data);
        $this->load->view('admin/index');
        $this->load->view('admin/footer');
    }
}
