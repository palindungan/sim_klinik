<?php
class Return_obat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // if($this->session->userdata('akses') == ""){
        //     redirect('login');
        // }else if($this->session->userdata('akses') == 'Apotek' || $this->session->userdata('akses') == 'Administrasi'){ 

        // }else{
        //     show_404();
        // }
        $this->load->model('apotek/M_return_obat');
    }
    public function index()
    {
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/apotek/return_obat/tambah');
    }

    public function tampil_daftar_obat()
    {
        $data_tbl['tbl_data'] = $this->M_return_obat->tampil_data('data_obat')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function input_transaksi_form()
    {
        if (isset($_POST['kode_obat']) && isset($_POST['qty_apotek_obat'])) {
            $no_return_obat = $this->M_return_obat->get_no_transaksi();
            $tanggal = date('Y-m-d H:i:s');
            $data_transaksi = array(
                'no_return_obat' => $no_return_obat,
                'tanggal' => $tanggal
            );

            $input = $this->M_return_obat->input_data('return_obat', $data_transaksi);
            // menambah detail transaksi baru 
            for ($i = 0; $i < count($this->input->post('kode_obat')); $i++) {

                $kode_obat = $this->input->post('kode_obat')[$i];

                $qty_temp = $this->input->post('qty_apotek_obat')[$i];
                $qty = (int) $qty_temp;

                $data_detail = array(
                    'no_return_obat' => $no_return_obat,
                    'kode_obat' => $kode_obat,
                    'qty' => $qty
                );
                $input_detail = $this->M_return_obat->input_data('detail_return_obat', $data_detail);

                // update qty obat lama dibawah ini
                $where_kode_obat = array(
                    'kode_obat' => $kode_obat
                );

                $ambil_data = $this->M_return_obat->get_data('obat', $where_kode_obat);
                $qty_lama = "kosong";
                foreach ($ambil_data->result() as $data) {
                    $qty_lama = $data->qty;
                }

                $qty_sekarang = $qty_lama - $qty;

                if ($qty_sekarang < 0) {
                    $qty_sekarang = 0;
                }

                $data = array(
                    'qty' => $qty_sekarang
                );
                $update = $this->M_return_obat->update_data($where_kode_obat, 'obat', $data);
            }
        }
        $this->session->set_flashdata('success', 'Ditambahkan');
        redirect('apotek/return_obat');
    }
    public function tampil_daftar_return_obat()
    {
        $data['record'] = $this->db->order_by('no_return_obat', 'DESC')->get('return_obat')->result();
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/apotek/history/return_obat/tampil', $data);
    }
    public function tampil_detail_daftar_return_obat()
    {
        $no_return_obat = $this->input->get('no_return_obat');

        $where = array(
            'no_return_obat' => $no_return_obat
        );

        $data['record'] = $this->M_return_obat->get_data('return_obat', $where)->result();

        $data['detail_record'] = $this->M_return_obat->get_data('daftar_return_obat', $where)->result();

        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/apotek/history/return_obat/detail', $data);
    }
}
