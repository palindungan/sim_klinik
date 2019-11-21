<?php
class Tindakan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('balai_pengobatan/M_tindakan');
    }
    public function index()
    {
        $data['record'] = $this->M_tindakan->tampil_data('bp_tindakan')->result();
        $this->template->load('sim_klinik/template/balai_pengobatan', 'sim_klinik/konten/balai_pengobatan/tindakan/tampil', $data);
    }
    public function store()
    {
        $harga = str_replace(".", "", $this->input->post('harga'));
        $id = $this->M_tindakan->get_no(); // generate
        $data = array(
            'no_bp_t' => $id,
            'nama' => $this->input->post('nama'),
            'harga' => $harga
        );
        $this->M_tindakan->input_data('bp_tindakan', $data);
        $this->session->set_flashdata('success','Ditambahkan');
        redirect('balai_pengobatan/tindakan');
    }
    public function update()
    {
        $where = array(
            'no_bp_t' => $this->input->post('no_bp_t')
        );
        $harga = str_replace(".", "", $this->input->post('harga'));
        $data = array(
            'nama' => $this->input->post('nama'),
            'harga' => $harga
        );
        $this->M_tindakan->update_data($where, 'bp_tindakan', $data);
        $this->session->set_flashdata('update','Diubah');
        redirect('balai_pengobatan/tindakan');
    }
    public function delete($id)
    {
        $where = array('no_bp_t' => $id);
        $this->M_tindakan->hapus_data($where, 'bp_tindakan');
        $this->session->set_flashdata('hapus','Dihapus');
        redirect('balai_pengobatan/tindakan');
    }
}
