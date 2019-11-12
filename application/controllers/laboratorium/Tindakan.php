<?php
class Tindakan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('laboratorium/M_tindakan');
    }
    public function index()
    {
        $data['record'] = $this->M_tindakan->tampil_data('lab_checkup')->result();
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/laboratorium/tindakan/tampil',$data);
    }
    public function store()
    {
        $id = $this->M_tindakan->get_no(); // generate
        $data = array(
            'no_lab_c' => $id,
            'nama' => $this->input->post('nama'),
            'harga' => $this->input->post('harga')
        );
        $this->M_tindakan->input_data('lab_checkup',$data);
        redirect('laboratorium/tindakan');
    }
    public function update()
    {
        $where = array(
            'no_lab_c' => $this->input->post('no_lab_c')
        );
        $data = array(
            'nama' => $this->input->post('nama'),
            'harga' => $this->input->post('harga')
        );
        $this->M_tindakan->update_data($where,'lab_checkup',$data);
        redirect('laboratorium/tindakan');
    }
    public function delete($id)
    {
        $where = array('no_lab_c' => $id);
        $this->M_tindakan->hapus_data($where, 'lab_checkup');
        redirect('laboratorium/tindakan');
    }
    

}
