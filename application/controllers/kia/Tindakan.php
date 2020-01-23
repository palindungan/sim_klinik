<?php
class Tindakan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('akses') != 'Admin'){
            show_404();
        }
        $this->load->model('kia/M_tindakan');
    }
    public function index()
    {
        $data['record'] = $this->M_tindakan->tampil_data('kia_tindakan')->result();
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/kia/tindakan/tampil', $data);
    }
    public function store()
    {
        $id = $this->M_tindakan->get_no(); // generate
        $harga = str_replace(".", "", $this->input->post('harga'));
        $data = array(
            'no_kia_t' => $id,
            'nama' => $this->input->post('nama'),
            'harga' => $harga
        );
        $this->M_tindakan->input_data('kia_tindakan', $data);
        $this->session->set_flashdata('success', 'Ditambahkan');
        redirect('kia/tindakan');
    }
    public function update()
    {
        $where = array(
            'no_kia_t' => $this->input->post('no_kia_t')
        );
        $harga = str_replace(".", "", $this->input->post('harga'));
        $data = array(
            'nama' => $this->input->post('nama'),
            'harga' => $harga
        );
        $this->M_tindakan->update_data($where, 'kia_tindakan', $data);
        $this->session->set_flashdata('update', 'Diubah');
        redirect('kia/tindakan');
    }
    public function delete($id)
    {
        $where = array('no_kia_t' => $id);
        $this->M_tindakan->hapus_data($where, 'kia_tindakan');
        $this->session->set_flashdata('hapus', 'Dihapus');
        redirect('kia/tindakan');
    }
}
