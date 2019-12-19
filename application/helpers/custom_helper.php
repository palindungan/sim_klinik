<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('rupiah')) {
    function rupiah($angka){
        $hasil_rupiah = number_format($angka,0,'.','.');
        return $hasil_rupiah;
    }
    function noHp($str) {
        return implode("-", str_split($str, 4));
    }
    function selisihHari($CheckIn,$CheckOut){
        $CheckInX = explode("-", $CheckIn);
        $CheckOutX = explode("-", $CheckOut);
        $date1 = mktime(0, 0, 0, $CheckInX[1],$CheckInX[2],$CheckInX[0]);
        $date2 = mktime(0, 0, 0, $CheckOutX[1],$CheckOutX[2],$CheckOutX[0]);
        $interval =($date2 - $date1)/(3600*24);
        // returns numberofdays
        return $interval ;
    }
    function hari_ini(){
        $hari = date ("D");
        switch($hari){
            case 'Sun':
                $hari_ini = "Minggu";
            break;
    
            case 'Mon':			
                $hari_ini = "Senin";
            break;
    
            case 'Tue':
                $hari_ini = "Selasa";
            break;
    
            case 'Wed':
                $hari_ini = "Rabu";
            break;
    
            case 'Thu':
                $hari_ini = "Kamis";
            break;
    
            case 'Fri':
                $hari_ini = "Jumat";
            break;
    
            case 'Sat':
                $hari_ini = "Sabtu";
            break;
            
            default:
                $hari_ini = "Tidak di ketahui";		
            break;
        }
        return $hari_ini;
    }
    function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        
        // variabel pecahkan 0 = tahun
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tanggal
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
}
