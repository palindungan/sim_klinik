<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Penjualan_obat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('akses') == "") {
            redirect('login');
        } else if ($this->session->userdata('akses') == 'Apotek' || $this->session->userdata('akses') == 'Administrasi' || $this->session->userdata('akses') == 'Rawat Inap') {
        } else {
            show_404();
        }
        $this->load->model('apotek/M_penjualan_obat');
        $this->load->model('administrasi/M_tagihan');
    }
    public function index()
    {
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/apotek/penjualan_obat/tambah');
    }

    public function tampil_daftar_obat()
    {
        $data_tbl['tbl_data'] = $this->M_penjualan_obat->tampil_data('data_obat')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    function tampil_select()
    {
        $no_ref = $this->input->get('no_ref');
        $nama = $this->input->get('nama');
        $query = $this->M_penjualan_obat->get_select($no_ref, $nama, 'no_ref_pelayanan');
        echo json_encode($query);
    }

    public function tampil_daftar_penjualan_obat()
    {
        $data['record'] = $this->db->order_by('no_penjualan_obat_a', 'DESC')->get('daftar_penjualan_obat_apotek')->result();

        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/apotek/history/penjualan/tampil', $data);
    }

    public function tampil_detail_daftar_penjualan_obat()
    {
        $no_penjualan_obat_a = $this->input->get('no_penjualan_obat_a');

        $where = array(
            'no_penjualan_obat_a' => $no_penjualan_obat_a
        );

        $data['record'] = $this->M_penjualan_obat->get_data('daftar_penjualan_obat_apotek', $where)->result();

        $data['detail_record'] = $this->M_penjualan_obat->get_data('daftar_penjualan_obat_apotek_detail', $where)->result();

        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/apotek/history/penjualan/detail', $data);
    }

    public function input_transaksi_form()
    {

        $no_ref_pelayanan = $this->input->post('no_ref_pelayanan');

        $where_no_ref_pelayanan = array(
            'no_ref_pelayanan' => $no_ref_pelayanan
        );

        // cek apakah ada no ref pelayanan didalam semua tabel transaksi
        $cek_penjualan_obat_apotik = $this->M_tagihan->get_data('penjualan_obat_apotik', $where_no_ref_pelayanan);

        // Start of cek di setiap transaksi //// untuk penjualan_obat_apotik
        if ($cek_penjualan_obat_apotik->num_rows() > 0) {

            // Start of hapus semua detail transaksi lama
            // ambil kode transaksi
            $no_penjualan_obat_a = "kosong";
            foreach ($cek_penjualan_obat_apotik->result() as $data) {
                $no_penjualan_obat_a = $data->no_penjualan_obat_a;
            }

            $where_no_penjualan_obat_a = array(
                'no_penjualan_obat_a' => $no_penjualan_obat_a
            );

            $hapus = $this->M_tagihan->hapus_data($where_no_penjualan_obat_a, 'detail_penjualan_obat_apotik');
            // End of hapus semua detail transaksi lama

            // Start of Cek apakah ada data detail post masuk ? kode_obat harga_apotek_obat qty_apotek_obat
            if (isset($_POST['kode_obat']) && isset($_POST['harga_apotek_obat']) && isset($_POST['qty_apotek_obat'])) {

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('kode_obat')); $i++) {

                    $kode_obat = $this->input->post('kode_obat')[$i];

                    $status_paket_tmp = isset($this->input->post('status_paket_apotek_obat')[$i]) ? $this->input->post('status_paket_apotek_obat')[$i] : "Tidak";
                    $status_paket = "Tidak";
                    if ($status_paket_tmp == "Ya") {
                        $status_paket = "Ya";
                    }

                    $harga_jual_temp = $this->input->post('harga_apotek_obat')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_apotek_obat')[$i];
                    $qty = (int) $qty_temp;

                    $data = array(
                        'no_penjualan_obat_a' => $no_penjualan_obat_a,
                        'kode_obat' => $kode_obat,
                        'qty' => $qty,
                        'harga_jual' => $harga_jual,
                        'status_paket' => $status_paket
                    );

                    $tambah = $this->M_tagihan->input_data('detail_penjualan_obat_apotik', $data);

                    // update qty obat lama dibawah ini
                    // $where_kode_obat = array(
                    //     'kode_obat' => $kode_obat
                    // );

                    // $ambil_data = $this->M_tagihan->get_data('obat', $where_kode_obat);
                    // $qty_lama = "kosong";
                    // foreach ($ambil_data->result() as $data) {
                    //     $qty_lama = $data->qty;
                    // }

                    // $qty_sekarang = $qty_lama - $qty;

                    // if ($qty_sekarang < 0) {
                    //     $qty_sekarang = 0;
                    // }

                    // $data = array(
                    //     'qty' => $qty_sekarang
                    // );
                    // $update = $this->M_tagihan->update_data($where_kode_obat, 'obat', $data);
                }

                // update transaksi lama
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_apotek_obat');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'tanggal_penjualan' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );
                $update = $this->M_tagihan->update_data($where_no_penjualan_obat_a, 'penjualan_obat_apotik', $data);
            } else {

                // Hapus transaksi Utama
                $hapus = $this->M_tagihan->hapus_data($where_no_penjualan_obat_a, 'penjualan_obat_apotik');
            }
            // End of Cek apakah ada data detail post masuk ?

        } else {

            // Start of Cek apakah ada data detail post masuk ? kode_obat harga_apotek_obat qty_apotek_obat
            if (isset($_POST['kode_obat']) && isset($_POST['harga_apotek_obat']) && isset($_POST['qty_apotek_obat'])) {

                // menambah transaksi utama
                $no_penjualan_obat_a = $this->M_tagihan->get_no_penjualan_obat_a(); // generate
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_apotek_obat');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'no_penjualan_obat_a' => $no_penjualan_obat_a,
                    'no_ref_pelayanan' => $no_ref_pelayanan,
                    'tanggal_penjualan' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );

                $tambah = $this->M_tagihan->input_data('penjualan_obat_apotik', $data);

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('kode_obat')); $i++) {

                    $kode_obat = $this->input->post('kode_obat')[$i];

                    $status_paket_tmp = isset($this->input->post('status_paket_apotek_obat')[$i]) ? $this->input->post('status_paket_apotek_obat')[$i] : "Tidak";
                    $status_paket = "Tidak";
                    if ($status_paket_tmp == "Ya") {
                        $status_paket = "Ya";
                    }

                    $harga_jual_temp = $this->input->post('harga_apotek_obat')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_apotek_obat')[$i];
                    $qty = (int) $qty_temp;

                    $data = array(
                        'no_penjualan_obat_a' => $no_penjualan_obat_a,
                        'kode_obat' => $kode_obat,
                        'qty' => $qty,
                        'harga_jual' => $harga_jual,
                        'status_paket' => $status_paket
                    );

                    $tambah = $this->M_tagihan->input_data('detail_penjualan_obat_apotik', $data);

                    // update qty obat lama dibawah ini
                    // $where_kode_obat = array(
                    //     'kode_obat' => $kode_obat
                    // );

                    // $ambil_data = $this->M_tagihan->get_data('obat', $where_kode_obat);
                    // $qty_lama = "kosong";
                    // foreach ($ambil_data->result() as $data) {
                    //     $qty_lama = $data->qty;
                    // }

                    // $qty_sekarang = $qty_lama - $qty;

                    // if ($qty_sekarang < 0) {
                    //     $qty_sekarang = 0;
                    // }

                    // $data = array(
                    //     'qty' => $qty_sekarang
                    // );
                    // $update = $this->M_tagihan->update_data($where_kode_obat, 'obat', $data);
                }
            }
            // End of Cek apakah ada data detail post masuk ?

        }
        // End Of cek di setiap transaksi

        // validasi pelayanan start
        $grand_total = preg_replace("/[^0-9]/", "", $this->input->post('grand_total'));
        $grand_total_lainnya = preg_replace("/[^0-9]/", "", $this->input->post('grand_total_lainnya'));

        $data_update_status_pelayanan = array(
            'tipe_pelayanan' =>  $this->input->post('tipe_pelayanan'),
            'grand_total' =>  $grand_total + $grand_total_lainnya
        );

        $this->M_tagihan->update_data($where_no_ref_pelayanan, 'pelayanan', $data_update_status_pelayanan);
        // validasi pelayanan end

        $this->session->set_flashdata('success', 'Ditambahkan');
    }

    public function daftar_obat_terjual()
    {
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/apotek/history/daftar_obat_terjual/tampil');
        
    }

    public function cetak_custom()
    {
        $tgl_1 = $this->input->post('tgl_mulai');
        $tgl_2 = $this->input->post('tgl_akhir');
        $tgl_temp_mulai = date('Y-m-d',strtotime($tgl_1));
        $tgl_temp_akhir = date('Y-m-d',strtotime($tgl_2));
        $tgl_mulai = $tgl_temp_mulai." 00:00:01";
        $tgl_akhir = $tgl_temp_akhir." 23:59:59";
        $judul_mulai = tgl_indo($tgl_temp_mulai);
        $judul_akhir = tgl_indo($tgl_temp_akhir);
        $obat_semua = $this->M_penjualan_obat->daftar_rekap_penjualan_obat_semua($tgl_mulai,$tgl_akhir)->result();

        $spreadsheet = new Spreadsheet();
        $spreadsheet = new Spreadsheet;
        // Mengatur Lebar Kolom
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(10);

        $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);
        // Atur Judul
        $spreadsheet->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle("A1:C1")->getFont()->setSize(13);
        $spreadsheet->getActiveSheet()->getStyle('A1:C1')
        ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        $spreadsheet->getActiveSheet()->mergeCells("A1:C1");
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', $judul_mulai." sampai ".$judul_akhir);
        $spreadsheet->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle('A1:C1')->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle('A1:C1')
        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A1:C1')
        ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        // tutup

        $spreadsheet->getActiveSheet()->getStyle('A2:C2')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $spreadsheet->getActiveSheet()->getStyle('A2:C2')->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB('006400');
        $spreadsheet->getActiveSheet()->getStyle('A2:C2')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle('A2:C2')->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle('A2:C2')
        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A2:C2')
        ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        // Border
        $spreadsheet->getActiveSheet()->getStyle('A2:C2')->getBorders()->getallBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);;

        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A2', 'Nomor')
        ->setCellValue('B2', 'Nama Obat')
        ->setCellValue('C2', 'Qty');

            $kolom = 3;
            $nomor = 1;
            foreach ($obat_semua as $data) {

            $spreadsheet->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal('left');
            $spreadsheet->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal('center');


            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A' . $kolom, $nomor)
            ->setCellValue('B' . $kolom,$data->nama)
            ->setCellValue('C' . $kolom,$data->qty);
            $kolom++;
            $nomor++;
            }


            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Laporan-Obat-'.$judul_mulai." sampai ".$judul_akhir.'.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');

    }
}
