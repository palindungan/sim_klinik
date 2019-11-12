<?php
class TindakanUgd extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('loket/M_tindakanUgd');
    }
    public function index()
    {
        $data['record'] = $this->M_tindakanUgd->tampil_data('ugd_tindakan')->result();
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/loket/tindakan_ugd/tampil',$data);
    }
    public function store()
    {
        $id = $this->M_tindakanUgd->get_no(); // generate
        $data = array(
            'no_ugd_t' => $id,
            'nama' => $this->input->post('nama'),
            'harga' => $this->input->post('harga')
        );
        $this->M_tindakanUgd->input_data('ugd_tindakan',$data);
        redirect('loket/tindakanUgd');
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
        $this->M_tindakanUgd->update_data($where,'ugd_tindakan',$data);
        redirect('loket/tindakanUgd');
    }
    public function delete($id)
    {
        $where = array('no_ugd_t' => $id);
        $this->M_tindakanUgd->hapus_data($where, 'ugd_tindakan');
        redirect('loket/tindakanUgd');
    }
    

}
