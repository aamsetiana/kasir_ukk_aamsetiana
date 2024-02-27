<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    public function halamanAdmin()
    {

        $data  = [
            'akses' => session()->get('level'),
            'total_stok' => $this->produk->getJumlahStok(),
            'jumlah_stok_kosong' => $this->produk->getJumlahStokKosong(),
            'pendapatan_harian' => $this->penjualan->getPendapatanHarian(),
            'penjualanBulanan' => $this->penjualan->getPenjualanBulanan(),
            'penjualanTahunan' => $this->penjualan->getPenjualanTahunan(),

            // 'dataPendapatan' => $this->penjualan->getPendapatanBulanan(),
            // $dataPendapatan = $pendapatanModel->getPendapatanBulanan($tahun);
        ];
        return view('admin/dashboard-admin', $data);
    }
}
