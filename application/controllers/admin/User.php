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
        $ambil_db = $this->db->query("SELECT COUNT(*) as jml_user FROM user_pegawai WHERE username='$username'")->row();
        $cek_username = $ambil_db->jml_user;
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
        $where = array(
            'no_user_pegawai' => $this->input->post('no_user_pegawai')
        );
        $data = array(
            'nama' => $this->input->post('nama'),
            'jenis_akses' => $this->input->post('jenis_akses'),
            'username' => $this->input->post('username')
        );
        $this->M_user->update_data($where,'user_pegawai',$data);
        $this->session->set_flashdata('update','Diubah');
        redirect('admin/user');
    }
    public function delete($id)
    {
        $where = array('no_user_pegawai' => $id);
        $this->M_user->hapus_data($where, 'user_pegawai');
        $this->session->set_flashdata('hapus','Dihapus');
        redirect('admin/user');
    }
    

}
