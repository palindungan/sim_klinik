<?php
class Akomodasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // if ($this->session->userdata('akses') == "") {
        //     redirect('login');
        // } else if ($this->session->userdata('akses') == 'Rawat Inap' || $this->session->userdata('akses') == 'Administrasi') {
        // } else {
        //     show_404();
        // }
        $this->load->model('rawat_inap/M_akomodasi');
    }

    public function index()
    {
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/rawat_inap/akomodasi/tambah');
    }

    public function tampil_daftar_obat()
    {
        $data_tbl['tbl_data'] = $this->M_akomodasi->tampil_data('data_obat')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function tampil_lain()
    {
        $where = array(
            'no_lain <>' => '1'
        );
        $data_tbl['tbl_data'] = $this->M_akomodasi->get_data('lain',$where)->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function ambil_total_obat()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['kode_obat']) && isset($_POST['harga_apotek_obat']) && isset($_POST['qty_apotek_obat'])) {

            for ($i = 0; $i < count($this->input->post('kode_obat')); $i++) {

                $harga_jual_temp = $this->input->post('harga_apotek_obat')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $qty_temp = $this->input->post('qty_apotek_obat')[$i];
                $qty = (int) $qty_temp;

                $perhitungan = $harga_jual * $qty;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_lain()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_lain']) && isset($_POST['harga_lain']) && isset($_POST['qty_lain'])) {

            for ($i = 0; $i < count($this->input->post('no_lain')); $i++) {

                $harga_jual_temp = $this->input->post('harga_lain')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $qty_temp = $this->input->post('qty_lain')[$i];
                $qty = (int) $qty_temp;

                $perhitungan = $harga_jual * $qty;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function input_transaksi_form()
    {
        $tgl_transaksi = date('Y-m-d H:i:s');
        $no_akomodasi_rawat_i = $this->M_akomodasi->get_no_akomodasi_rawat_inap();
        $data = array(
            'no_akomodasi_rawat_i' => $no_akomodasi_rawat_i,
            'tgl_transaksi' => $tgl_transaksi,
            'grand_total' => (int) preg_replace("/[^0-9]/", "", $this->input->post('grand_total'))
        );
        $insert_akomodasi = $this->M_akomodasi->input_data('akomodasi_rawat_inap',$data);
        
        if($insert_akomodasi)
        {
            // Update Saldo
            $count_transaction = $this->M_akomodasi->countRecordWithTglKeluarParam();
            $temp_saldo = "";
            if ($count_transaction == 0) {
                $temp_saldo = 0;
            } else if ($count_transaction > 0) {
                foreach ($this->M_akomodasi->getLastRecordWithTglKeluarParam() as $i) {
                    $temp_saldo = $i->temp_saldo;
                }
            }
            $grand_total = (int) preg_replace("/[^0-9]/", "", $this->input->post('grand_total'));
            $new_saldo = $temp_saldo - $grand_total;

            $where_no_akomodasi_rawat_i = array(
                'no_akomodasi_rawat_i' => $no_akomodasi_rawat_i
            );

            $data_update_status_akomodasi = array(
                'temp_saldo' => $new_saldo,
                'saldo' => $new_saldo
            );
            $this->M_akomodasi->update_data($where_no_akomodasi_rawat_i, 'akomodasi_rawat_inap', $data_update_status_akomodasi);
            
            if (isset($_POST['no_lain']) && isset($_POST['harga_lain']) && isset($_POST['qty_lain'])) {

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_lain')); $i++) {

                    $no_lain = $this->input->post('no_lain')[$i];
                    $nama_lain = $this->input->post('nama_lain')[$i];

                    $harga_jual_temp = $this->input->post('harga_lain')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_lain')[$i];
                    $qty = (int) $qty_temp;

                    $data = array(
                        'no_akomodasi_rawat_i' => $no_akomodasi_rawat_i,
                        'no_lain' => $no_lain,
                        'nama' => $nama_lain,
                        'qty' => $qty,
                        'harga' => $harga_jual
                    );

                    $tambah = $this->M_akomodasi->input_data('detail_akomodasi_rawat_inap_lain', $data);
                }

            }
            for ($i = 0; $i < count($this->input->post('kode_obat')); $i++) {

                $kode_obat = $this->input->post('kode_obat')[$i];

                $harga_jual_temp = $this->input->post('harga_apotek_obat')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $qty_temp = $this->input->post('qty_apotek_obat')[$i];
                $qty = (int) $qty_temp;

                $data = array(
                    'no_akomodasi_rawat_i' => $no_akomodasi_rawat_i,
                    'kode_obat' => $kode_obat,
                    'qty' => $qty,
                    'harga' => $harga_jual
                );

                $tambah = $this->M_akomodasi->input_data('detail_akomodasi_rawat_inap_logistik', $data);
            }

        }
        $this->session->set_flashdata('success', 'Ditambahkan');
    }


    
}