<?php
class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('login/M_login');
    }
    public function index()
    {
        $this->template->load('sim_klinik/template/login', 'sim_klinik/konten/login/tampil');
    }
    public function store()
    {

        $userpass = $this->input->post('password');
        $cek = $this->M_login->cek_login();
        if ($cek->num_rows() > 0) {
            foreach ($cek->result() as $row) {
                $id_user = $row->no_user_pegawai;
                $username = $row->username;
                $nama = $row->nama;
                $akses = $row->jenis_akses;
                $password = $row->password;
            }
            if (password_verify($userpass, $password)) {
                $data_session = array(
                    'id_user' => $id_user,
                    'username' => $username,
                    'nama' => $nama,
                    'akses' => $akses
                );
                $this->session->set_userdata($data_session);
                if ($row->jenis_akses == 'Loket') 
                {
                    redirect(base_url("loket/pendaftaran"));
                } 
                else if ($row->jenis_akses == 'Apotek') 
                {
                    redirect(base_url("loket/pendaftaran"));
                }
                else if ($row->jenis_akses == 'Administrasi')
                {
                    redirect(base_url("loket/pendaftaran"));
                }
                else if ($row->jenis_akses == 'Balai Pengobatan')
                {
                    redirect(base_url("loket/pendaftaran"));
                }
                else if ($row->jenis_akses == 'Laboratorium')
                {
                    redirect(base_url("loket/pendaftaran"));
                }
                else if ($row->jenis_akses == 'KIA')
                {
                    redirect(base_url("loket/pendaftaran"));
                }
                else if ($row->jenis_akses == 'Rawat Inap')
                {
                    redirect(base_url("loket/pendaftaran"));
                }
            }
        } else {
            echo "<script>
            	alert('Username Atau Password Anda Salah');
            	window.location = '" . base_url("/") . "';
            </script>";
        }
    }

}
