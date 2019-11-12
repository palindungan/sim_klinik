<?php
class BpTindakan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('loket/M_bpTindakan');
    }
    public function index()
    {
        $data['record'] = $this->M_bpTindakan->tampil_data('bp_tindakan')->result();
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/loket/bp_tindakan/tampil',$data);
    }
    public function store()
    {
        $id = $this->M_bpTindakan->get_no(); // generate
        $data = array(
            'no_bp_t' => $id,
            'nama' => $this->input->post('nama'),
            'harga' => $this->input->post('harga')
        );
        $this->M_bpTindakan->input_data('bp_tindakan',$data);
        redirect('loket/bpTindakan');
    }
    public function update()
    {
        $where = array(
            'no_bp_t' => $this->input->post('no_bp_t')
        );
        $data = array(
            'nama' => $this->input->post('nama'),
            'harga' => $this->input->post('harga')
        );
        $this->M_bpTindakan->update_data($where,'bp_tindakan',$data);
        redirect('loket/bpTindakan');
    }
    public function delete($id)
    {
        $where = array('no_bp_t' => $id);
        $this->M_bpTindakan->hapus_data($where, 'bp_tindakan');
        redirect('loket/bpTindakan');
    }
    

}
