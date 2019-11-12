<?php
class Antrian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('loket/M_antrian');
    }
    public function index()
    {
        $data['antrian_bp'] = $this->M_antrian->tampil_data('antrian_balai_pengobatan_tersisa')->result();
        $data['antrian_kia'] = $this->M_antrian->tampil_data('antrian_kesehatan_ibu_dan_anak_tersisa')->result();
        $data['antrian_lab'] = $this->M_antrian->tampil_data('antrian_laboratorium_tersisa')->result();
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/loket/antrian/tampil', $data);
    }
    public function click_prioritas_balai_pengobatan()
    { }
    public function click_prioritas_laboratorium()
    { }
    public function refresh_antrian_sekarang_bp()
    {
        $query = $this->M_antrian->get_data_antrian_sekarang("antrian_balai_pengobatan_prioritas");

        if ($query->num_rows() >= 1) {

            $data_result['result_data'] = $query->result();
            $data = json_encode($data_result);
            echo $data;
        } else {

            $query2 = $this->M_antrian->get_data_antrian_sekarang("antrian_balai_pengobatan_tersisa");

            if ($query2->num_rows() >= 1) {

                $data_result['result_data'] = $query2->result();
                $data = json_encode($data_result);
                echo $data;
            } else {
                echo 'Antrian Kosong';
            }
        }
    }
    public function refresh_antrian_sekarang_kia()
    {
        $query2 = $this->M_antrian->get_data_antrian_sekarang("antrian_kesehatan_ibu_dan_anak_tersisa");

        if ($query2->num_rows() >= 1) {

            $data_result['result_data'] = $query2->result();
            $data = json_encode($data_result);
            echo $data;
        } else {
            echo 'Antrian Kosong';
        }
    }
    public function refresh_antrian_sekarang_lab()
    {
        $query = $this->M_antrian->get_data_antrian_sekarang("antrian_laboratorium_prioritas");

        if ($query->num_rows() >= 1) {

            $data_result['result_data'] = $query->result();
            $data = json_encode($data_result);
            echo $data;
        } else {

            $query2 = $this->M_antrian->get_data_antrian_sekarang("antrian_laboratorium_tersisa");

            if ($query2->num_rows() >= 1) {

                $data_result['result_data'] = $query2->result();
                $data = json_encode($data_result);
                echo $data;
            } else {
                echo 'Antrian Kosong';
            }
        }
    }
}
