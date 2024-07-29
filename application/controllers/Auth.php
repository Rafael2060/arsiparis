<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        //if ($this->session->userdata('email')) {
        //    redirect('User');
        //}

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('auth/login');
        } else {
            $this->_login();
        }
    }

    // underscore pada _login hanya sebagai penanda untuk fucntion private
    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // $user = $this->db->get_where('user', ['username' => $username])->row_array();

        $this->db->select('a.id, a.name,a.username,a.role_id,a.password,a.is_active,a.image,b.role');
        $this->db->from('user as a');
        $this->db->from('user_role as b');
        $this->db->where('b.id=a.role_id');
        $this->db->where('a.username=', $username);
        $user = $this->db->get()->row_array();
        $token = $this->getToken();

        if ($user) {
            if ($user['is_active'] == '1') {
                if (password_verify($password, $user['password'])) {
                    $data = [

                        'id' => $user['id'],
                        'username' => $user['username'],
                        'name' => $user['name'],
                        'role_id' => $user['role_id'],
                        'role' => $user['role'],
                        'image' => $user['image'],
                        'token' => $token
                    ];

                    $this->db->where('username', $user['username']);
                    $this->db->delete('user_token');

                    $data1 = [
                        'username' => $user['username'],
                        'token' => $token,
                        'date_created' => time()
                    ];

                    $this->db->insert('user_token', $data1);
                    $this->session->set_userdata($data);

                    if ($user['role_id'] == 1) {
                        redirect(base_url('Admin'));
                    } else {
                        redirect(base_url('User'));
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password tidak cocok<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">User belum diaktivasi<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">User belum terdaftar<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            // var_dump($this->session->flashdata('message'));
            // die();
            redirect('Auth');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('User');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim', array('required' => '{field} tidak boleh kosong'));
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password2', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'WPU User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $username = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($username),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => '2',
                'is_active' => '0',
                'date_created' => time()
            ];

            //Siapkan token

            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $username,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);


            $this->_sendEmail($token, $this->verify);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Account anda sudah dibuat. Silahkan klik link aktivasi di email anda.</div>');
            redirect('auth');
        }
    }

    private function _sendEmail($token, $type)
    {

        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'wasbirrefli123@gmail.com',
            'smtp_pass' => 'Vario123',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"

        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->from('wasbirrefli123@gmail', 'Wasbir Refli');
        $username = htmlspecialchars($this->input->post('email'));
        $this->email->to(htmlspecialchars($this->input->post('email')));

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $message = 'Click this link to verify your account : <a href="' . base_url() . 'Auth/verify?email=' . $username . '&token=' . urlencode($token) . '">Activate</a>';
            $this->email->message($message);
        } else if ($type == 'forgot') {
            $this->email->subject('Reset password');
            $message = 'Click this link to reset your password : <a href="' . base_url() . 'Auth/resetpassword?email=' . $username . '&token=' . urlencode($token) . '">Reset Password</a>';
            $this->email->message($message);
        }


        if ($this->email->send()) {
            return true;
        } else {
            $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {

        $username = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $username])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $username);
                    $this->db->update('user');
                    $this->db->delete('user_token', ['email' => $username]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $username . ' activation success! Please login.</div>');
                    redirect(base_url());
                } else {
                }
            } else {

                $this->db->delete('user', ['email' => $username]);
                $this->db->delete('user_token', ['token' => $token]);
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Activation failed! Token expired.</div>');
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Activation failed! Wrong email.</div>');
            redirect(base_url());
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');
        // $this->session->session_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda sudah logout.</div>');
        redirect(base_url());
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('templates/auth_footer');
        } else {
            $username = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $username, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $username,
                    'token' => $token,
                    'date_created' => time()
                ];
                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">PLease check your email to reset password.</div>');
                redirect(base_url('Auth/forgotPassword'));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered or activated.</div>');
                redirect(base_url('Auth/forgotPassword'));
            }
        }
    }

    public function resetpassword()
    {
        $username = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $username])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $username);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong Token.</div>');
                redirect(base_url('Auth'));
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.</div>');
            redirect(base_url('Auth'));
        }
    }
    public function changePassword()
    {
        if (!$this->session->userdata('rerset_email')) {
            redirect('Auth');
        }
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|matches[password2]|min_length[3]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|matches[password1]|min_length[3]');

        if ($this->form_validation->run() == false) {

            $data['title'] = 'Change Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $username = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $username);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed Please login.</div>');

            $this->db->where('email', $username);
            $this->db->delete('user_token');

            redirect(base_url('Auth'));
        }
    }

    // Generate token
    function getToken($length = 10)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i = 0; $i < $length; $i++) {
            //$token .= $codeAlphabet[random_int(0, $max - 1)];
            $token .= $codeAlphabet[mt_rand(0, $max - 1)];
        }

        return $token;
    }
}
