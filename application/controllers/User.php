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
        if ($this->session->userdata('role_id') <> '1') {
            redirect('Admin');
        }

        $cari                           = $this->input->get('cari');
        $config['base_url']             = base_url('User/');
        $config['total_rows']           = $this->User_model->total();
        $config['per_page']             = 5;
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
        $data['total']          = $config['total_rows'];

        $this->load->view('admin/header', $data);
        $this->load->view('user/user');
        $this->load->view('admin/footer');
    }

    public function create()
    {
        if ($this->session->userdata('role_id') <> '1') {
            redirect('Admin');
        }

        $data['title']  = 'Tambah Data User';
        $data['role']   = $this->Role_model->role();
        // dd($data['user']);

        $this->load->view('admin/header', $data);
        $this->load->view('user/create');
        $this->load->view('admin/footer');
    }

    public function store()
    {
        if ($this->session->userdata('role_id') <> '1') {
            redirect('Admin');
        }

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
                'password' => password_hash('12345678', PASSWORD_DEFAULT),
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
        if (!cek_self($id)) {
            pesan('Maaf, anda tidak memiliki akses untuk fungsi ini', 'message', 'danger');
            redirect(base_url('User'));
        }

        $data['user']   = $this->User_model->show($id);
        $data['title']  = 'Edit Data User';
        $data['role']   = $this->Role_model->role();
        // dd($data['user']);

        $this->load->view('admin/header', $data);
        $this->load->view('user/edit');
        $this->load->view('admin/footer');
    }

    public function editPassword()
    {
        $id             = $this->uri->segment(3);

        if (!cek_self($id)) {
            pesan('Maaf, anda tidak memiliki akses untuk fungsi ini', 'message', 'danger');
            redirect(base_url('User'));
        }

        $data['user']   = $this->User_model->show($id);
        $data['title']  = 'Edit Password User';
        $data['role']   = $this->Role_model->role();
        // dd($data['user']);

        $this->load->view('admin/header', $data);
        $this->load->view('user/password');
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
        if (!cek_self($id)) {
            pesan('Maaf, anda tidak memiliki akses untuk fungsi ini', 'message', 'danger');
            redirect(base_url('User'));
        }

        $name   = $this->input->post('name');
        $email  = $this->input->post('email');
        $role_id = $this->input->post('role');

        $this->form_validation->set_rules('name', 'Nama', 'required', array('required' => 'Kolom nama tidak boleh kosong'));
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', array('required' => 'Kolom email tidak boleh kosong', 'valid_email' => 'Format email tidak tepat.'));

        if ($this->form_validation->run() == FALSE) {
            $data['user']   = $this->User_model->show($id);
            $data['title']  = 'Edit Data User';
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

            // $this->session->set_flashdata('message', '<div style="width:100%" class="alert alert-success alert-dismissible fade show" role="alert">Data user sudah diperbarui.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            pesan('Data user sudah diperbarui.', 'message', 'success');
            redirect(base_url('User'));
        }
    }

    public function updatePassword()
    {
        $id         = $this->input->post('id');

        if (!cek_self($id)) {
            pesan('Maaf, anda tidak memiliki akses untuk fungsi ini', 'message', 'danger');
            redirect(base_url('User'));
        }

        $this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Kolom password tidak boleh kosong'));
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password]', array('required' => 'Kolom Konfirmasi Password tidak boleh kosong', 'matches' => 'Kolom Konfirmasi Password tidak cocok dengan kolom Password.'));


        if ($this->form_validation->run() == FALSE) {
            $data['user']   = $this->User_model->show($id);
            $data['title']  = 'Edit Password User';
            $data['role']   = $this->Role_model->role();

            $this->load->view('admin/header', $data);
            $this->load->view('user/password');
            $this->load->view('admin/footer');
        } else {

            $data = array(
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),

            );
            $this->User_model->update($id, $data);

            $this->session->set_flashdata('message', '<div style="width:100%" class="alert alert-success alert-dismissible fade show" role="alert">Data password user sudah diperbarui.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
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
