<?php
class Supplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_supplier');
    }
    public function index()
    {
        $data['record'] = $this->M_supplier->tampil_data('supplier')->result();
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/admin/supplier/tampil',$data);
    }
    public function store()
    {
        $id = $this->M_supplier->get_no(); // generate
        $data = array(
            'no_supplier' => $id,
            'nama' => $this->input->post('nama'),
            'cp' => $this->input->post('cp'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat')
        );
        $this->M_supplier->input_data('supplier',$data);
        redirect('admin/supplier');
    }
    public function update()
    {
        $where = array(
            'no_supplier' => $this->input->post('no_supplier')
        );
        $data = array(
            'nama' => $this->input->post('nama'),
            'cp' => $this->input->post('cp'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat')
        );
        $this->M_supplier->update_data($where,'supplier',$data);
        redirect('admin/supplier');
    }
    public function delete($id)
    {
        $where = array('no_supplier' => $id);
        $this->M_supplier->hapus_data($where, 'supplier');
        redirect('admin/supplier');
    }
    

}
