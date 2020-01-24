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

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('kode_obat')); $i++) {

                    $kode_obat = $this->input->post('kode_obat')[$i];

                    $qty_temp = $this->input->post('qty_apotek_obat')[$i];
                    $qty = (int) $qty_temp;

                    // update qty obat lama dibawah ini
                    $where_kode_obat = array(
                        'kode_obat' => $kode_obat
                    );

                    $ambil_data = $this->M_return_obat->get_data('obat', $where_kode_obat);
                    $qty_lama = "kosong";
                    foreach ($ambil_data->result() as $data) {
                        $qty_lama = $data->qty;
                    }

                    $data = array(
                        'qty' => $qty_lama - $qty
                    );
                    $update = $this->M_return_obat->update_data($where_kode_obat, 'obat', $data);
                }
                
            }
            redirect('apotek/return_obat');
    }
}