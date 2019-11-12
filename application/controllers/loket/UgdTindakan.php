<?php
class UgdTindakan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('loket/M_ugdTindakan');
    }
    public function index()
    {
        $data['record'] = $this->M_ugdTindakan->tampil_data('ugd_tindakan')->result();
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/loket/ugd_tindakan/tampil',$data);
    }
    public function store()
    {
        $id = $this->M_ugdTindakan->get_no(); // generate
        $data = array(
            'no_ugd_t' => $id,
            'nama' => $this->input->post('nama'),
            'harga' => $this->input->post('harga')
        );
        $this->M_ugdTindakan->input_data('ugd_tindakan',$data);
        redirect('loket/ugdTindakan');
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
        $this->M_ugdTindakan->update_data($where,'ugd_tindakan',$data);
        redirect('loket/ugdTindakan');
    }
    public function delete($id)
    {
        $where = array('no_ugd_t' => $id);
        $this->M_ugdTindakan->hapus_data($where, 'ugd_tindakan');
        redirect('loket/ugdTindakan');
    }
    

}
