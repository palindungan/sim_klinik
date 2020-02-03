<?php
class Antrian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('akses') == "") {
            redirect('login');
        } else if ($this->session->userdata('akses') != 'Loket') {
            show_404();
        }
        $this->load->model('loket/M_antrian');
        $this->load->model('administrasi/M_tagihan');
    }

    public function index()
    {
        //Hapus Data Antrian - Calon Pasien Yang Hanya Daftar Tapi Tidak Periksa
        $this->M_antrian->delete_antrian_kemarin();
        $this->M_tagihan->deleteTrashData();
        //Load Data        
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/loket/antrian/tampil');
    }

    public function tampil_daftar_antrian_bp()
    {
        $data_tbl['tbl_data'] = $this->M_antrian->tampil_antrian_bp()->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function tampil_daftar_antrian_kia()
    {
        $data_tbl['tbl_data'] = $this->M_antrian->tampil_antrian_kia()->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function tampil_daftar_antrian_lab()
    {
        $data_tbl['tbl_data'] = $this->M_antrian->tampil_antrian_lab()->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function aksiPilihAntrianBP(){
        $id_antri_bp = $this->input->post('id');
        //Update Data Antrian
        $where  = array('id_antri_bp' => $id_antri_bp);
        $data = array('status_antrian' => '1');
        $this->M_antrian->update_data($where, 'antrian_bp',$data);
    }

    public function aksiPilihAntrianKIA(){
        $id_antri_kia = $this->input->post('id');
        //Update Data Antrian
        $where  = array('id_antri_kia' => $id_antri_kia);
        $data = array('status_antrian' => '1');
        $this->M_antrian->update_data($where, 'antrian_kia',$data);
    }

    public function aksiPilihAntrianLab(){
        $id_antri_lab = $this->input->post('id');
        //Update Data Antrian
        $where  = array('id_antri_lab' => $id_antri_lab);
        $this->M_antrian->update_data($where, 'antrian_lab',$data);
    }
}
