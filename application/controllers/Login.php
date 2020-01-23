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
                if($row->jenis_akses == 'Manager'){
                    redirect('laporan/rekap_tagihan');
                }
                else if($row->jenis_akses== 'Admin'){
                    redirect('admin/pasien');
                }
                else if ($row->jenis_akses == 'Loket') 
                {
                    redirect(base_url("loket/pendaftaran"));
                } 
                else if ($row->jenis_akses == 'Apotek') 
                {
                    redirect(base_url("apotek/penjualan_obat"));
                }
                else if ($row->jenis_akses == 'Administrasi')
                {
                    redirect(base_url("administrasi/tagihan"));
                }
                else if ($row->jenis_akses == 'Rawat Inap')
                {
                    redirect(base_url("rawat_inap/transaksi"));
                }
            } else {
                $this->session->set_flashdata('login','Dilogin');
                redirect('/');
            }
        } else {
            $this->session->set_flashdata('login','Dilogin');
            redirect('/');
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }

}
