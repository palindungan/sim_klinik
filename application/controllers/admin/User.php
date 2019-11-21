<?php
class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_user');
    }
    public function index()
    {
        $data['record'] = $this->M_user->tampil_data('user_pegawai')->result();
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/admin/user/tampil',$data);
    }
    public function store()
    {
        $id = $this->M_user->get_no(); // generate
        $password = $this->input->post('password', true);
        $username = $this->input->post('username');
        $data = array(
            'no_user_pegawai' => $id,
            'nama' => $this->input->post('nama'),
            'jenis_akses' => $this->input->post('jenis_akses'),
            'username' => $this->input->post('username'),
            'password' => password_hash($password, PASSWORD_BCRYPT)
        );
        $count_user = $this->db->query("SELECT COUNT(*) as jml_user FROM user_pegawai WHERE username='$username'")->row();
        $cek_username = $count_user->jml_user;
        if($cek_username > 0)
        {
            $this->session->set_flashdata('username','Diusername');
            redirect('admin/user');
        }
        else if($this->input->post('password') != $this->input->post('konfirmasi_password'))
        {
            $this->session->set_flashdata('password','Dipassword');
            redirect('admin/user');

        } else {
            $this->M_user->input_data('user_pegawai',$data);
            $this->session->set_flashdata('success','Ditambahkan');
            redirect('admin/user');
        }
        
    }
    public function update()
    {
        $id = $this->input->post('no_user_pegawai');
        $username = $this->input->post('username');
        $where = array(
            'no_user_pegawai' => $id
        );
        $data = array(
            'nama' => $this->input->post('nama'),
            'jenis_akses' => $this->input->post('jenis_akses'),
            'username' => $username
        );
        $ambil_username = $this->db->get_where('user_pegawai', array('no_user_pegawai' => $id))->row();
        $username_db = $ambil_username->username;
        $count_user = $this->db->query("SELECT COUNT(*) as jml_user FROM user_pegawai WHERE username='$username'")->row();
        $cek_username = $count_user->jml_user;

        // jika username db dan username post sama
        if($username_db == $username)
        {
            $this->M_user->update_data($where,'user_pegawai',$data);
            $this->session->set_flashdata('update','Diubah');
            redirect('admin/user');
        }
        else if($cek_username > 0){
            $this->session->set_flashdata('username','Diusername');
            redirect('admin/user');
        }
        else {
            $this->M_user->update_data($where,'user_pegawai',$data);
            $this->session->set_flashdata('update','Diubah');
            redirect('admin/user');
        }
        
    }
    public function update_password()
    {
        $id = $this->input->post('no_user_pegawai');
        $password_baru = $this->input->post('password_baru');
        $konfirmasi_password = $this->input->post('konfirmasi_password');
        $where = array(
            'no_user_pegawai' => $id
        );
        $data = array(
            'password' => $password_baru
        );
        if($password_baru != $konfirmasi_password)
        {
            $this->session->set_flashdata('password','Dipassword');
            redirect('admin/user');
        }
        else {
            $this->M_user->update_data($where,'user_pegawai',$data);
            $this->session->set_flashdata('update','Diubah');
            redirect('admin/user');
        }
        
    }
    public function delete($id)
    {
        $where = array('no_user_pegawai' => $id);
        $this->M_user->hapus_data($where, 'user_pegawai');
        $this->session->set_flashdata('hapus','Dihapus');
        redirect('admin/user');
    }
    

}
