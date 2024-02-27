<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Kasir extends BaseController
{
    public function halamanKasir()
    {
        $data  = [
            'akses' => session()->get('level'),
            'total_stok' => $this->produk->getJumlahStok(),
            'jumlah_stok_kosong' => $this->produk->getJumlahStokKosong()
        ];
        return view('Kasir/dashboard-kasir', $data);
    }

}
