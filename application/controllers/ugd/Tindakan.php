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
        $harga = str_replace(".", "", $this->input->post('harga'));
        $data = array(
            'no_ugd_t' => $id,
            'nama' => $this->input->post('nama'),
            'harga' => $harga
        );
        $this->M_tindakan->input_data('ugd_tindakan',$data);
        $this->session->set_flashdata('success','Ditambahkan');
        redirect('ugd/tindakan');
    }
    public function update()
    {
        $where = array(
            'no_ugd_t' => $this->input->post('no_ugd_t')
        );
        $harga = str_replace(".", "", $this->input->post('harga'));
        $data = array(
            'nama' => $this->input->post('nama'),
            'harga' => $harga
        );
        $this->M_tindakan->update_data($where,'ugd_tindakan',$data);
        $this->session->set_flashdata('update','Diubah');
        redirect('ugd/tindakan');
    }
    public function delete($id)
    {
        $where = array('no_ugd_t' => $id);
        $this->M_tindakan->hapus_data($where, 'ugd_tindakan');
        $this->session->set_flashdata('hapus','Dihapus');
        redirect('ugd/tindakan');
    }
    

}
