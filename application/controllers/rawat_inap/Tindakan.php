<?php
class Tindakan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('rawat_inap/M_tindakan');
    }
    public function index()
    {
        $data['record'] = $this->M_tindakan->tampil_data('rawat_inap_tindakan')->result();
        $this->template->load('sim_klinik/template/admin', 'sim_klinik/konten/rawat_inap/tindakan/tampil', $data);
    }
    public function store()
    {
        $id = $this->M_tindakan->get_no(); // generate
        $harga = str_replace(".", "", $this->input->post('harga'));
        $data = array(
            'no_rawat_inap_t' => $id,
            'nama' => $this->input->post('nama'),
            'harga' => $harga
        );
        $this->M_tindakan->input_data('rawat_inap_tindakan', $data);
        $this->session->set_flashdata('success', 'Ditambahkan');
        redirect('rawat_inap/tindakan');
    }
    public function update()
    {
        $where = array(
            'no_rawat_inap_t' => $this->input->post('no_rawat_inap_t')
        );
        $harga = str_replace(".", "", $this->input->post('harga'));
        $data = array(
            'nama' => $this->input->post('nama'),
            'harga' => $harga
        );
        $this->M_tindakan->update_data($where, 'rawat_inap_tindakan', $data);
        $this->session->set_flashdata('update', 'Diubah');
        redirect('rawat_inap/tindakan');
    }
    public function delete($id)
    {
        $where = array('no_rawat_inap_t' => $id);
        $this->M_tindakan->hapus_data($where, 'rawat_inap_tindakan');
        $this->session->set_flashdata('hapus', 'Dihapus');
        redirect('rawat_inap/tindakan');
    }
}
