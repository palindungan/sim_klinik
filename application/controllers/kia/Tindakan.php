<?php
class Tindakan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('kia/M_tindakan');
    }
    public function index()
    {
        $data['record'] = $this->M_tindakan->tampil_data('kia_tindakan')->result();
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/kia/tindakan/tampil',$data);
    }
    public function store()
    {
        $id = $this->M_tindakan->get_no(); // generate
        $data = array(
            'no_kia_t' => $id,
            'nama' => $this->input->post('nama'),
            'harga' => $this->input->post('harga')
        );
        $this->M_tindakan->input_data('kia_tindakan',$data);
        redirect('kia/tindakan');
    }
    public function update()
    {
        $where = array(
            'no_kia_t' => $this->input->post('no_kia_t')
        );
        $data = array(
            'nama' => $this->input->post('nama'),
            'harga' => $this->input->post('harga')
        );
        $this->M_tindakan->update_data($where,'kia_tindakan',$data);
        redirect('kia/tindakan');
    }
    public function delete($id)
    {
        $where = array('no_kia_t' => $id);
        $this->M_tindakan->hapus_data($where, 'kia_tindakan');
        redirect('kia/tindakan');
    }
    

}
