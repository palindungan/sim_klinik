<?php
class Transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('balai_pengobatan/M_transaksi');
    }
    public function index()
    {
        $data['record'] = $this->M_transaksi->tampil_join()->result();
        $this->template->load('sim_klinik/template/balai_pengobatan', 'sim_klinik/konten/balai_pengobatan/transaksi/tambah', $data);
    }
    public function tampil()
    {
        $select = $this->input->post('no_ref_pelayanan');
        $record = $this->M_transaksi->tampil_join()->result();
        $now = date('Y');
        if ($select == "") {
            echo '<table width="100%" class="responsive">
                <tr>
                    <td width="6%">
                        <h5>Nama</h5>
                    </td>
                    <td width="2%">
                        <h5>:</h5>
                    </td>
                    <td width="24%">
                        <h5>-</h5>
                    </td>
                    <td width="6%">
                        <h5>Umur</h5>
                    </td>
                    <td width="2%">
                        <h5>:</h5>
                    </td>
                    <td width="19%">
                        <h5>-</h5>
                    </td>
                    <td width="8%">
                        <h5>Alamat</h5>
                    </td>
                    <td width="2%">
                        <h5>:</h5>
                    </td>
                    <td width="22%">
                        <h5>-</h5>
                    </td>
                </tr>
            </table>';
        }
        foreach ($record as $data) {
            $tahun_lahir = date('Y', strtotime($data->tgl_lahir));
            $umur = $now - $tahun_lahir;

            if ($select == $data->no_ref_pelayanan) {
                echo '<table width="100%" class="responsive">
                    <tr>
                        <td width="6%">
                            <h5>Nama</h5>
                        </td>
                        <td width="2%">
                            <h5>:</h5>
                        </td>
                        <td width="24%">
                            <h5>' . $data->nama . '</h5>
                        </td>
                        <td width="6%">
                            <h5>Umur</h5>
                        </td>
                        <td width="2%">
                            <h5>:</h5>
                        </td>
                        <td width="19%">
                            <h5>' . $umur . ' Tahun</h5>
                        </td>
                        <td width="8%">
                            <h5>Alamat</h5>
                        </td>
                        <td width="2%">
                            <h5>:</h5>
                        </td>
                        <td width="22%">
                            <h5>' . $data->alamat . '</h5>
                        </td>
                    </tr>
                </table>';
            }
        }
    }

    public function tampil_daftar_tindakan()
    {
        $data_tbl['tbl_data'] = $this->M_transaksi->tampil_data('bp_tindakan')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function ambil_total()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_bp_t']) && isset($_POST['harga'])) {

            for ($i = 0; $i < count($this->input->post('no_bp_t')); $i++) {

                $harga_jual_temp = $this->input->post('harga')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $perhitungan = $harga_jual;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }
}
