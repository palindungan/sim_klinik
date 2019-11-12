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
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/loket/lab_checkup/tampil',$data);
    }
    public function store()
    {
        // $this->form_validation->set_rules('nama','nama','required');
        // $this->form_validation->set_rules('harga','harga','required');
        // if ($this->form_validation->run() == FALSE)
        // {
        //     $this->template->load('sim_klinik/template/loket','sim_klinik/konten/loket/labCheckup/tampil');
        // }
        // else
        // {   

        // }
        $id = $this->M_labCheckup->get_no(); // generate
        $data = array(
            'no_lab_c' => $id,
            'nama' => $this->input->post('nama'),
            'harga' => $this->input->post('harga')
        );
        $this->M_labCheckup->input_data('lab_checkup',$data);
        redirect('loket/labCheckup');
    }
    public function delete($id)
    {
        $where = array('no_lab_c' => $id);
        $this->M_labCheckup->hapus_data($where, 'lab_checkup');
        redirect('loket/labCheckup');
    }
    

}
