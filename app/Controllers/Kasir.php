<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Kasir extends BaseController
{
    public function halamanKasir()
    {
        if (session()->get('level') != 'Kasir') {
            return redirect()->back();
            exit;
        }

        $data  = [
            'akses' => session()->get('level'),
            'total_stok' => $this->produk->getJumlahStok(),
            'jumlah_stok_kosong' => $this->produk->getJumlahStokKosong(),
            'chartData' => $this->detail->getMonthlyIncome(),
        ];
        return view('Kasir/dashboard-kasir', $data);
    }

}
