<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    public function halamanAdmin()
    {
        if (session()->get('level') != 'Admin') {
            return redirect()->back();
            exit;
        }
         

        $data  = [
            'akses' => session()->get('level'),
            'total_stok' => $this->produk->getJumlahStok(),
            'jumlah_stok_kosong' => $this->produk->getJumlahStokKosong(),
            'pendapatan_harian' => $this->penjualan->getPendapatanHarian(),
            'pendapatanHariIni' => $this->detail->pendapatanHarian(),
            'totalProduk' => $this->produk->getTotalProduk(),
            // 'pendapatan_harian' => $this->penjualan->getPendapatanHarian1(),
            'chartData' => $this->detail->getMonthlyIncome(),
            // 'dataPendapatan' => $this->penjualan->getPendapatanBulanan(),
            // $dataPendapatan = $pendapatanModel->getPendapatanBulanan($tahun);
        ];
        return view('admin/dashboard-admin', $data);
    }
}
