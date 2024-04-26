<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    private $usermodel;


    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $usermodel = new User_Model();
        //$this->output->cache(2);
    }

    public function index()
    {
        $cari                           = $this->input->get('cari');
        $config['base_url']             = base_url('User/');
        $config['total_rows']           = $this->User_model->total();
        $config['per_page']             = 2;
        $config['page_query_string']    = TRUE;
        $offset = html_escape($this->input->get('per_page'));

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $data['users']          = $this->User_model->user($cari, $config['per_page'], $offset);
        $data['offset']         = $offset;
        // dd($data['users']);
        $data['title']          = 'User';

        $this->load->view('admin/header', $data);
        $this->load->view('user/user');
        $this->load->view('admin/footer');
    }

    public function create()
    {
        $data['title']  = 'Tambah Data User';
        $data['role']   = $this->Role_model->role();
        // dd($data['user']);

        $this->load->view('admin/header', $data);
        $this->load->view('user/create');
        $this->load->view('admin/footer');
    }

    public function store()
    {
        $id         = $this->input->post('id');
        $name       = $this->input->post('name');
        $username   = $this->input->post('username');
        $email      = $this->input->post('email');
        $role_id    = $this->input->post('role');

        $this->form_validation->set_rules('name', 'Nama', 'required', array('required' => 'Kolom nama tidak boleh kosong'));
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', array('required' => 'Kolom email tidak boleh kosong', 'valid_email' => 'Format email tidak tepat.'));
        $this->form_validation->set_rules('username', 'Username', 'required', array('required' => 'Kolom username tidak boleh kosong'));

        if ($this->form_validation->run() == FALSE) {
            $data['user']   = $this->User_model->show($id);
            $data['title']  = 'Tambah Data User';
            $data['role']   = $this->Role_model->role();

            $this->load->view('admin/header', $data);
            $this->load->view('user/create');
            $this->load->view('admin/footer');
        } else {

            $data = array(
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'role_id' => $role_id
            );
            $this->User_model->store($data);

            $this->session->set_flashdata('message', '<div style="width:100%" class="alert alert-success alert-dismissible fade show" role="alert">Data user baru sudah disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            redirect(base_url('User'));
        }
    }

    public function edit()
    {
        $id             = $this->uri->segment(3);
        $data['user']   = $this->User_model->show($id);
        $data['title']  = 'Edit Data User';
        $data['role']   = $this->Role_model->role();
        // dd($data['user']);

        $this->load->view('admin/header', $data);
        $this->load->view('user/edit');
        $this->load->view('admin/footer');
    }

    public function show()
    {
        $id             = $this->uri->segment(3);
        $data['user']   = $this->User_model->show($id);
        $data['title']  = 'Tampil Data User';

        // dd($data['user']);

        $this->load->view('admin/header', $data);
        $this->load->view('user/show');
        $this->load->view('admin/footer');
    }

    public function update()
    {
        $id     = $this->input->post('id');
        $name   = $this->input->post('name');
        $email  = $this->input->post('email');
        $role_id = $this->input->post('role');

        $this->form_validation->set_rules('name', 'Nama', 'required', array('required' => 'Kolom nama tidak boleh kosong'));
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', array('required' => 'Kolom email tidak boleh kosong', 'valid_email' => 'Format email tidak tepat.'));

        if ($this->form_validation->run() == FALSE) {
            $data['user']   = $this->User_model->show($id);
            $data['title']  = 'Tampil Data User';
            $data['role']   = $this->Role_model->role();

            $this->load->view('admin/header', $data);
            $this->load->view('user/edit');
            $this->load->view('admin/footer');
        } else {

            $data = array(
                'name' => $name,
                'email' => $email,
                'role_id' => $role_id
            );
            $this->User_model->update($id, $data);

            $this->session->set_flashdata('message', '<div style="width:100%" class="alert alert-success alert-dismissible fade show" role="alert">Data user sudah diperbarui.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            redirect(base_url('User'));
        }
    }

    public function delete()
    {
        $id = $this->input->post('idHapus');
        $this->db->where('id', $id)->delete('user');
        $this->session->set_flashdata('message', '<div style="width:100%" class="alert alert-success alert-dismissible fade show" role="alert">Data user sudah dihapus.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        redirect(base_url('User'));
    }
}
