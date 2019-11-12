<?php
class Tindakan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('ugd/M_tindakan');
    }
    public function index()
    {
        $data['record'] = $this->M_tindakan->tampil_data('ugd_tindakan')->result();
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/ugd/tindakan/tampil',$data);
    }
    public function store()
    {
        $id = $this->M_tindakan->get_no(); // generate
        $data = array(
            'no_ugd_t' => $id,
            'nama' => $this->input->post('nama'),
            'harga' => $this->input->post('harga')
        );
        $this->M_tindakan->input_data('ugd_tindakan',$data);
        redirect('ugd/tindakan');
    }
    public function update()
    {
        $where = array(
            'no_ugd_t' => $this->input->post('no_ugd_t')
        );
        $data = array(
            'nama' => $this->input->post('nama'),
            'harga' => $this->input->post('harga')
        );
        $this->M_tindakan->update_data($where,'ugd_tindakan',$data);
        redirect('ugd/tindakan');
    }
    public function delete($id)
    {
        $where = array('no_ugd_t' => $id);
        $this->M_tindakan->hapus_data($where, 'ugd_tindakan');
        redirect('ugd/tindakan');
    }
    

}