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
        $cp = str_replace("-", "", $this->input->post('cp'));
        $data = array(
            'no_supplier' => $id,
            'nama' => $this->input->post('nama'),
            'cp' => $cp,
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat')
        );
        $this->M_supplier->input_data('supplier',$data);
        $this->session->set_flashdata('success','Ditambahkan');
        redirect('admin/supplier');
    }
    public function update()
    {
        $where = array(
            'no_supplier' => $this->input->post('no_supplier')
        );
        $cp = str_replace("-", "", $this->input->post('cp'));
        $data = array(
            'nama' => $this->input->post('nama'),
            'cp' => $cp,
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat')
        );
        $this->M_supplier->update_data($where,'supplier',$data);
        $this->session->set_flashdata('update','Diubah');
        redirect('admin/supplier');
    }
    public function delete($id)
    {
        $where = array('no_supplier' => $id);
        $this->M_supplier->hapus_data($where, 'supplier');
        $this->session->set_flashdata('hapus','Dihapus');
        redirect('admin/supplier');
    }
    

}
