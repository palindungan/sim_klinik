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
        $data = array(
            'no_user_pegawai' => $id,
            'nama' => $this->input->post('nama'),
            'jenis_akses' => $this->input->post('jenis_akses'),
            'username' => $this->input->post('username'),
            'password' => password_hash($password, PASSWORD_BCRYPT)
        );
        $this->M_user->input_data('user_pegawai',$data);
        redirect('admin/user');
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
        redirect('admin/user');
    }
    public function delete($id)
    {
        $where = array('no_user_pegawai' => $id);
        $this->M_user->hapus_data($where, 'user_pegawai');
        redirect('admin/user');
    }
    

}
