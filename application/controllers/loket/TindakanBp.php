<?php
class TindakanBp extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('loket/M_tindakanBp');
    }
    public function index()
    {
        $data['record'] = $this->M_tindakanBp->tampil_data('bp_tindakan')->result();
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/loket/tindakan_bp/tampil',$data);
    }
    public function store()
    {
        $id = $this->M_tindakanBp->get_no(); // generate
        $data = array(
            'no_bp_t' => $id,
            'nama' => $this->input->post('nama'),
            'harga' => $this->input->post('harga')
        );
        $this->M_tindakanBp->input_data('bp_tindakan',$data);
        redirect('loket/tindakanBp');
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
        $this->M_tindakanBp->update_data($where,'bp_tindakan',$data);
        redirect('loket/tindakanBp');
    }
    public function delete($id)
    {
        $where = array('no_bp_t' => $id);
        $this->M_tindakanBp->hapus_data($where, 'bp_tindakan');
        redirect('loket/tindakanBp');
    }
    

}
