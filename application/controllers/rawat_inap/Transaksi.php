<?php
class Transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('rawat_inap/M_transaksi');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['record'] = $this->M_transaksi->tampil_data('data_pelayanan_pasien_default')->result();
        $this->template->load('sim_klinik/template/rawat_inap', 'sim_klinik/konten/rawat_inap/transaksi/tambah', $data);
    }

    public function tampil_daftar_kamar()
    {
        $data_tbl['tbl_data'] = $this->M_transaksi->tampil_data('kamar_rawat_inap')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function tampil_daftar_tindakan()
    {
        $data_tbl['tbl_data'] = $this->M_transaksi->tampil_data('rawat_inap_tindakan')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function tampil_daftar_obat()
    {
        $where_qty_obat = array(
            'qty >' => 0
        );  
        $data_tbl['tbl_data'] = $this->M_transaksi->get_data('daftar_obat_rawat_inap',$where_qty_obat)->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function ambil_sub_total_kamar()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_kamar_rawat_i']) && isset($_POST['harga_harian_kamar'])) {

            for ($i = 0; $i < count($this->input->post('no_kamar_rawat_i')); $i++) {

                $harga_temp = $this->input->post('harga_harian_kamar')[$i];
                $harga = (int) preg_replace("/[^0-9]/", "", $harga_temp);
                $sub_total = $sub_total + $harga;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_sub_total_tindakan()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_rawat_inap_t']) && isset($_POST['harga_tindakan'])) {

            for ($i = 0; $i < count($this->input->post('no_rawat_inap_t')); $i++) {

                $harga_temp = $this->input->post('harga_tindakan')[$i];
                $harga = (int) preg_replace("/[^0-9]/", "", $harga_temp);

                $perhitungan = $harga;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_sub_total_obat()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_stok_obat_rawat_i']) && isset($_POST['harga_obat']) && isset($_POST['qty'])) {

            for ($i = 0; $i < count($this->input->post('no_stok_obat_rawat_i')); $i++) {

                $harga_temp = $this->input->post('harga_obat')[$i];
                $harga = (int) preg_replace("/[^0-9]/", "", $harga_temp);

                $qty_temp = $this->input->post('qty')[$i];
                $qty = (int) preg_replace("/[^0-9]/", "", $qty_temp);

                $perhitungan = $harga * $qty;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function input_transaksi_form()
    {
        $no_transaksi_rawat_i = $this->M_transaksi->get_no_transaksi_rawat_inap(); // generate
        $no_ref_pelayanan = $this->input->post('no_ref_pelayanan');
        $tgl_transaksi = date('Y-m-d H:i:s');
        $total_temp = $this->input->post('total_harga');
        $total_harga = preg_replace("/[^0-9]/", "", $total_temp);

        $data = array(
            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
            'no_ref_pelayanan' => $no_ref_pelayanan,
            'tgl_transaksi' => $tgl_transaksi,
            'total_harga' => $total_harga
        );

        $where_no_ref = array(
            'no_ref_pelayanan' => $no_ref_pelayanan
        );

        $data_transaksi = $this->M_transaksi->get_data('transaksi_rawat_inap',$where_no_ref)->result();
        $cek_no_transaksi = $this->M_transaksi->get_data('transaksi_rawat_inap',$where_no_ref)->num_rows();
        $total_harga_lama = 0;
        foreach($data_transaksi as $transaksi_ri)
        {
            $no_transaksi_rawat_i = $transaksi_ri->no_transaksi_rawat_i;
            $total_harga_lama = $transaksi_ri->total_harga;
        }
        if($cek_no_transaksi > 0)
        {
            $data_update_transaksi_ri = array(
                'total_harga' => $total_harga_lama + $total_harga
            );
            $status = $this->M_transaksi->update_data($where_no_ref,'transaksi_rawat_inap',$data_update_transaksi_ri);

            $data_update_status = array(
                'tipe_pelayanan' => 'Rawat Inap'
            );
            $this->M_transaksi->update_data($where_no_ref,'pelayanan',$data_update_status);
        }
        else 
        {
            $status = $this->M_transaksi->input_data('transaksi_rawat_inap', $data);
            $data_update_status = array(
            'tipe_pelayanan' => 'Rawat Inap'
            );
            $this->M_transaksi->update_data($where_no_ref,'pelayanan',$data_update_status);
        }


        if ($status) {

            // start of insert Kamar //////////
            if (isset($_POST['no_kamar_rawat_i'])) {

                // tambah detail transaksi
                for ($i = 0; $i < count($this->input->post('no_kamar_rawat_i')); $i++) {

                    $no_kamar_rawat_i = $this->input->post('no_kamar_rawat_i')[$i];
                    $harga_temp = $this->input->post('harga_harian_kamar')[$i];
                    $harga_harian = preg_replace("/[^0-9]/", "", $harga_temp);
                    $tgl_cek_in = date('Y-m-d H:i:s');
                    $tgl_cek_out = "";
                    $sub_total_harga = $harga_harian;



                    // proses pemasukan ke dalam database detail
                    $data = array(
                        'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                        'no_kamar_rawat_i' => $no_kamar_rawat_i,
                        'harga_harian' => $harga_harian,
                        'tanggal_cek_in' => $tgl_cek_in,
                        'tanggal_cek_out' => $tgl_cek_out,
                        'sub_total_harga' => $sub_total_harga
                    );

                    $status = $this->M_transaksi->input_data('detail_transaksi_rawat_inap_kamar', $data);
                }

                if ($status) {
                    $this->session->set_flashdata('success', 'Ditambahkan');
                } else {
                    echo "Gagal input ke dalam data detail transaksi !!";
                }
            }
            // end of Kamar //////////

            // start of insert Tindakan //////////
            if (isset($_POST['no_rawat_inap_t'])) {

                // tambah detail transaksi
                for ($i = 0; $i < count($this->input->post('no_rawat_inap_t')); $i++) {

                    $no_rawat_inap_t = $this->input->post('no_rawat_inap_t')[$i];
                    $harga_temp = $this->input->post('harga_tindakan')[$i];
                    $harga = preg_replace("/[^0-9]/", "", $harga_temp);

                    // proses pemasukan ke dalam database detail

                    $data = array(
                        'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                        'no_rawat_inap_t' => $no_rawat_inap_t,
                        'harga' => $harga
                    );

                    $status = $this->M_transaksi->input_data('detail_transaksi_rawat_inap_tindakan', $data);
                }

                if ($status) {
                    $this->session->set_flashdata('success', 'Ditambahkan');
                } else {
                    echo "Gagal input ke dalam data detail transaksi !!";
                }
            }
            // start of Tindakan //////////

            // start of insert Obat //////////
            if (isset($_POST['no_stok_obat_rawat_i'])) {

                // tambah detail transaksi
                for ($i = 0; $i < count($this->input->post('no_stok_obat_rawat_i')); $i++) {

                    $no_stok_obat_rawat_i = $this->input->post('no_stok_obat_rawat_i')[$i];
                    $harga_temp = $this->input->post('harga_obat')[$i];
                    $harga_jual = preg_replace("/[^0-9]/", "", $harga_temp);
                    $qty = $this->input->post('qty')[$i];
                    $qty_sekarang = $this->input->post('qty_sekarang')[$i];

                    // proses pemasukan ke dalam database detail
                    $data = array(
                        'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                        'no_stok_obat_rawat_i' => $no_stok_obat_rawat_i,
                        'qty' => $qty,
                        'harga_jual' => $harga_jual
                    );

                    $status = $this->M_transaksi->input_data('detail_transaksi_rawat_inap_obat', $data);

                    $where_update_obat_ri = array(
                        'no_stok_obat_rawat_i' => $no_stok_obat_rawat_i
                    );
                    $data_obat_ri = array(
                        'qty' => $qty_sekarang - $qty
                    );
                    $status_update =
                    $this->M_transaksi->update_data($where_update_obat_ri,'stok_obat_rawat_inap',$data_obat_ri);
                }

                if ($status_update) {
                    $this->session->set_flashdata('success', 'Ditambahkan');
                } else {
                    echo "Gagal input ke dalam data detail transaksi !!";
                }
            }
            // start of Obat //////////

        } else {
            echo "Gagal input ke dalam data transaksi !!";
        }
    }
    function ambil_detail()
    {
        $no_ref_pelayanan = $this->input->post('no_ref_pelayanan');
        $where_no_ref = array(
            'no_ref_pelayanan' => $no_ref_pelayanan
        );
        $cek_data = $this->M_transaksi->get_data('transaksi_rawat_inap',$where_no_ref)->result();
        $no_transaksi_rawat_i = "";
        foreach($cek_data as $row)
        {
            $no_transaksi_rawat_i = $row->no_transaksi_rawat_i;
        }
        if($no_transaksi_rawat_i != "")
        {
            $where_no_ri = array(
                'no_transaksi_rawat_i' => $no_transaksi_rawat_i
            );

            // Cek Row Kamar
            $cek_kamar = $this->M_transaksi->get_data('detail_transaksi_rawat_inap_kamar',$where_no_ri)->result();
            $no_detail_kamar = "";
            foreach($cek_kamar as $row_kamar)
            {
                $no_detail_kamar = $row_kamar->no_detail_transaksi_rawat_inap_k;
            }
            // 

            // Cek Row Tindakan
            $cek_tindakan = $this->M_transaksi->get_data('detail_transaksi_rawat_inap_tindakan',$where_no_ri)->result();
            $no_detail_tindakan = "";
            foreach($cek_tindakan as $row_tindakan)
            {
                $no_detail_tindakan = $row_tindakan->no_detail_transaksi_rawat_inap_t;
            }

            // Cek Obat Rawat Inap
            $cek_obat = $this->M_transaksi->get_data('detail_transaksi_rawat_inap_obat',$where_no_ri)->result();
            $no_detail_obat = "";
            foreach($cek_obat as $row_obat)
            {
                $no_detail_obat = $row_obat->no_detail_transaksi_rawat_inap_o;
            }

            echo '
            <table class="table table-sm table-bordered" width="100%" cellspacing="0">';
            if($no_detail_kamar != "")
            {        
            echo '
                <tr>
                    <td colspan="3" class="text-center"><b>Daftar Kamar</b></td>
                </tr>
                <tr>
                    <td>Nama Kamar</td>
                    <td>Lama Hari</td>
                    <td class="text-center">Total Harga</td>
                </tr>';
                $data_kamar = $this->M_transaksi->get_data('daftar_detail_kamar_rawat_inap',$where_no_ri)->result();
                foreach($data_kamar as $detail_kamar)
                {
                echo '
                <tr>
                    <td>'.$detail_kamar->nama.'</td>
                    <td>2</td>
                    <td class="text-right">'.rupiah($detail_kamar->harga_harian).'</td>
                </tr>
                ';
                }
            }

            if($no_detail_tindakan != "")
            {
                echo '
                <tr>
                    <td colspan="3" class="text-center"><b>Daftar Tindakan</b></td>
                </tr>
                <tr>
                    <td>Nama Tindakan</td>
                    <td>Harga</td>
                    <td>Total Harga</td>
                </tr>';
                $data_tindakan = $this->M_transaksi->get_data('daftar_detail_tindakan_rawat_inap',$where_no_ri)->result();
                foreach($data_tindakan as $detail_tindakan)
                {
                echo '
                <tr>
                    <td>'.$detail_tindakan->nama.'</td>
                    <td>asd</td>
                    <td class="text-right">'.rupiah($detail_tindakan->harga).'</td>
                </tr>';
                }
            }

            if($no_detail_obat != "")
            {
                echo '
                <tr>
                    <td colspan="3" class="text-center"><b>Daftar Obat</b></td>
                </tr>';
                echo '
                <tr>
                    <td>Nama Obat</td>
                    <td>Qty</td>
                    <td>Total Harga</td>
                </tr>';

                $data_obat =
                $this->M_transaksi->get_data('daftar_penjualan_obat_rawat_inap_detail',$where_no_ri)->result();
                foreach($data_obat as $detail_obat)
                {
                echo '
                <tr>
                    <td>'.$detail_obat->nama_obat.'</td>
                    <td>'.$detail_obat->qty.'</td>
                    <td class="text-right">'.rupiah($detail_obat->harga_jual * $detail_obat->qty).'</td>
                </tr>';
                }
            }
                echo '
            </table>
            ';
        }
    }
}
