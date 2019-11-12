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
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/loket/antrian/tampil');
    }
    public function click_prioritas_balai_pengobatan()
    {
        $kode_antrian_bp = $this->input->post('id');

        $where = array(
            'kode_antrian_bp' => $kode_antrian_bp
        );
        $query = $this->M_antrian->get_data("antrian_bp", $where);
        foreach ($query->result_array() as $row) {
            $status = $row["status"];
            if ($status == "Prioritas") {
                $data = array(
                    'status' => 'Antri'
                );
                $this->M_antrian->update_data($where, 'antrian_bp', $data);
            } else {
                $data = array(
                    'status' => 'Prioritas'
                );
                $this->M_antrian->update_data($where, 'antrian_bp', $data);
            }
        }
    }
    public function click_prioritas_laboratorium()
    {
        $kode_antrian_lab = $this->input->post('id');

        $where = array(
            'kode_antrian_lab' => $kode_antrian_lab
        );
        $query = $this->M_antrian->get_data("antrian_lab", $where);
        foreach ($query->result_array() as $row) {
            $status = $row["status"];
            if ($status == "Prioritas") {
                $data = array(
                    'status' => 'Antri'
                );
                $this->M_antrian->update_data($where, 'antrian_lab', $data);
            } else {
                $data = array(
                    'status' => 'Prioritas'
                );
                $this->M_antrian->update_data($where, 'antrian_lab', $data);
            }
        }
    }
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

    public function tampil_daftar_antrian_bp()
    {
        $data_tbl['tbl_data'] = $this->M_antrian->tampil_data('antrian_balai_pengobatan_tersisa')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function tampil_daftar_antrian_kia()
    {
        $data_tbl['tbl_data'] = $this->M_antrian->tampil_data('antrian_kesehatan_ibu_dan_anak_tersisa')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function tampil_daftar_antrian_lab()
    {
        $data_tbl['tbl_data'] = $this->M_antrian->tampil_data('antrian_laboratorium_tersisa')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function click_lanjut_balai_pengobatan()
    {
        $kode_antrian_bp = $this->input->post('id');

        $where = array(
            'kode_antrian_bp' => $kode_antrian_bp
        );

        $data = array(
            'status' => 'Selesai'
        );

        $this->M_antrian->update_data($where, 'antrian_bp', $data);
    }

    public function click_lanjut_kesehatan_ibu_dan_anak()
    {
        $kode_antrian_kia = $this->input->post('id');

        $where = array(
            'kode_antrian_kia' => $kode_antrian_kia
        );

        $data = array(
            'status' => 'Selesai'
        );

        $this->M_antrian->update_data($where, 'antrian_kia', $data);
    }

    public function click_lanjut_laboratorium()
    {
        $kode_antrian_lab = $this->input->post('id');

        $where = array(
            'kode_antrian_lab' => $kode_antrian_lab
        );

        $data = array(
            'status' => 'Selesai'
        );

        $this->M_antrian->update_data($where, 'antrian_lab', $data);
    }
}
