<?php
class Lain extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('akses') == "") {
            redirect('login');
        } else if ($this->session->userdata('akses') == 'Admin' || $this->session->userdata('akses') == 'Rawat Inap') {
        } else {
            show_404();
        }
        $this->load->model('admin/M_kamar');
    }
    public function index()
    {
        $data['record'] = $this->M_kamar->tampil_data('lain')->result();
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/admin/lain/tampil', $data);
    }
    public function store()
    {
        $harga = str_replace(".", "", $this->input->post('harga'));
        $data = array(
            'nama' => $this->input->post('nama'),
            'tipe' => $this->input->post('tipe'),
            'harga' => $harga
        );
        $this->M_kamar->input_data('lain', $data);
        $this->session->set_flashdata('success', 'Ditambahkan');
        redirect('admin/lain');
    }
    public function update()
    {
        $where = array(
            'no_lain' => $this->input->post('no_lain')
        );
        $harga = str_replace(".", "", $this->input->post('harga'));
        $data = array(
            'nama' => $this->input->post('nama'),
            'tipe' => $this->input->post('tipe'),
            'harga' => $harga
        );
        $this->M_kamar->update_data($where, 'lain', $data);
        $this->session->set_flashdata('update', 'Diubah');
        redirect('admin/lain');
    }
    public function delete($id)
    {
        $where = array('no_lain' => $id);
        $this->M_kamar->hapus_data($where, 'lain');
        $this->session->set_flashdata('hapus', 'Dihapus');
        redirect('admin/lain');
    }
}
