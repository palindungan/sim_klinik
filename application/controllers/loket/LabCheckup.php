<?php
class LabCheckup extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('loket/M_labCheckup');
    }
    public function index()
    {
        $data['record'] = $this->M_labCheckup->tampil_data('lab_checkup')->result();
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/loket/tindakan_lab/tampil',$data);
    }
    public function store()
    {
        $id = $this->M_labCheckup->get_no(); // generate
        $data = array(
            'no_lab_c' => $id,
            'nama' => $this->input->post('nama'),
            'harga' => $this->input->post('harga')
        );
        $this->M_labCheckup->input_data('lab_checkup',$data);
        redirect('loket/labCheckup');
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
        $this->M_labCheckup->update_data($where,'lab_checkup',$data);
        redirect('loket/labCheckup');
    }
    public function delete($id)
    {
        $where = array('no_lab_c' => $id);
        $this->M_labCheckup->hapus_data($where, 'lab_checkup');
        redirect('loket/labCheckup');
    }
    

}
