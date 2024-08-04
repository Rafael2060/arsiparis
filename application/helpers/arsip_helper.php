<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect(base_url('Auth'));
    }

    $role_id = $ci->session->userdata('role_id');
    $menu = $ci->uri->segment(1);

    $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
    $menuId = $queryMenu['id'];

    $userAccess = $ci->db->get_where(
        'user_access_menu',
        ['role_id' => $role_id, 'menu_id' => $menuId]
    );



    //$ci->db->where('role_id =', $role_id);
    //$ci->db->where('menu_id =', $menuId);
    //$userAccess = $ci->db->get('user_access_menu');

    //echo $userAccess['role_id'];
    //var_dump($userAccess);

    if ($userAccess->num_rows() < 1) {
        redirect('Auth/blocked');
    } else {
        is_token_in();
    }
}

function is_token_in()
{
    $ci = get_instance();
    if ($ci->session->userdata('token')) {
        $ci->db->select('*');
        $ci->db->from('user_token');
        $ci->db->where('username', $ci->session->userdata('username'));
        $query = $ci->db->get()->result_array();

        //echo "<script>console.log('Debug proses " . var_dump($query) . "')</script>";


        if ($ci->session->userdata('token') == $query[0]['token']) {
        } else {
            $ci->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Sesi anda telah habis, silahkan login ulang.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            redirect('Auth');
        };
    } else {
        redirect('Auth');
    }
}

function checkUserAcces()
{
    $ci = get_instance();
    $role_id = $ci->session->userdata('role_id');
    //$menu = $ci->uri->segment(1);
    $menu = 'Arsip';

    $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
    $menuId = $queryMenu['id'];

    $userAccess = $ci->db->get_where(
        'user_access_menu',
        ['role_id' => $role_id, 'menu_id' => $menuId]
    )->result_array();

    return $userAccess;
}

function connect_oracle()
{

    //$conn = oci_connect('USERNAME', 'PASSWORD', 'IP:PORT/SERVICENAME');
    $conn = oci_connect('siakoff', 'Or4_Off_05', '10.13.2.24:1521/siakdb');

    try {
        //check if
        if (!$conn) {
            //throw exception if email is not valid
            $errOci = oci_error();
            throw new Exception('Error');
        } else {
            return 'Oracle Tersambung';
        }
    } catch (Exception $e) {
        //display custom message
        return htmlentities($e);
    }



    //if (!$conn) {
    //    $e = oci_error();
    //    return htmlentities($e['message']);
    //} else {
    //    return 'Oracle Connected';
    //}
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    //var_dump($result);

    if ($result->num_rows() > 0) {
        return 'checked="checked"';
    }
}

function dd($data)
{
    var_dump($data);
    die();
}

function pesan($pesan, $messageorerror, $tipe)
{
    $ci = get_instance();

    $ci->session->set_flashdata($messageorerror, '<div style="width:100%" class="alert alert-' . $tipe . ' alert-dismissible fade show" role="alert">' . $pesan . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
}

function cek_administrator($cekId)
{
    $ci         = get_instance();
    $role_id    = $ci->session->userdata('role_id');
    $id         = $ci->session->userdata('id');

    // var_dump($role_id . '-' . $id . '-' . $cekId);
    if ($role_id == 1) {
        if ($cekId == $id) {
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}
function cek_staff()
{
    $ci         = get_instance();
    $role_id    = $ci->session->userdata('role_id');


    // var_dump($role_id . '-' . $id . '-' . $cekId);
    if ($role_id == 1 || $role_id == 2) {
        return true;
    } else {
        return false;
    }
}

function cek_kaurmintu()
{
    $ci         = get_instance();
    $role_id    = $ci->session->userdata('role_id');


    // var_dump($role_id . '-' . $id . '-' . $cekId);
    if ($role_id == 1 || $role_id == 3) {
        return true;
    } else {
        return false;
    }
}

function cek_kasattahti()
{
    $ci         = get_instance();
    $role_id    = $ci->session->userdata('role_id');


    // var_dump($role_id . '-' . $id . '-' . $cekId);
    if ($role_id == 1 || $role_id == 4) {
        return true;
    } else {
        return false;
    }
}

function cek_kapolres()
{
    $ci         = get_instance();
    $role_id    = $ci->session->userdata('role_id');


    // var_dump($role_id . '-' . $id . '-' . $cekId);
    if ($role_id == 1 || $role_id == 6) {
        return true;
    } else {
        return false;
    }
}

function cek_self($cekId)
{
    $ci         = get_instance();
    $id         = $ci->session->userdata('id');
    $role_id    = $ci->session->userdata('role_id');


    // var_dump($role_id . '-' . $id . '-' . $cekId);
    if ($id == $cekId || $role_id == 1) {
        return true;
    } else {
        return false;
    }
}
