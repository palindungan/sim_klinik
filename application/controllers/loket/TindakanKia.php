<?php
class TindakanKia extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('loket/M_tindakanKia');
    }
    public function index()
    {
        $data['record'] = $this->M_tindakanKia->tampil_data('kia_tindakan')->result();
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/loket/tindakan_kia/tampil',$data);
    }
    public function store()
    {
        $id = $this->M_tindakanKia->get_no(); // generate
        $data = array(
            'no_kia_t' => $id,
            'nama' => $this->input->post('nama'),
            'harga' => $this->input->post('harga')
        );
        $this->M_tindakanKia->input_data('kia_tindakan',$data);
        redirect('loket/tindakanKia');
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
        $this->M_tindakanKia->update_data($where,'kia_tindakan',$data);
        redirect('loket/tindakanKia');
    }
    public function delete($id)
    {
        $where = array('no_kia_t' => $id);
        $this->M_tindakanKia->hapus_data($where, 'kia_tindakan');
        redirect('loket/tindakanKia');
    }
    

}
