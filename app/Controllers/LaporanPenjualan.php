<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Mdetail;
use CodeIgniter\HTTP\ResponseInterface;

class LaporanPenjualan extends BaseController
{
    public function index()
    {
        if (session()->get('level') != 'Admin') {
            return redirect()->back();
            exit;
        }

        $data = [
            'chartData' => $this->detail->getMonthlyIncome(),
            'akses' => session()->get('level')
        ];

        return view('Laporan/laporan-penjualan', $data);
    }

    public function generate_laporan_penjualan()
    {
        // Ambil data bulan dan tahun dari form
        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');
        $jenis_laporan = $this->request->getPost('jenis_laporan'); // Tambahkan jenis laporan

        // Instance PenjualanModel
        $detail = new Mdetail();

        // Mendapatkan data penjualan
        $result = $detail->getLaporanPenjualan($bulan, $tahun, $jenis_laporan);

        // Mendapatkan detail penjualan
        $detailResult = $detail->getDetailJual($bulan, $tahun, $jenis_laporan);
        $data = [
            'akses' => session()->get('level'),
            'chartData' => $this->detail->getMonthlyIncome(),
            'detail_penjualan' => $detailResult,
            // 'title' => 'LaporanPenjualan',
            // 'judulHalaman' => 'Laporan Penjualan',
            'bulan' => $bulan,
            'tahun' => $tahun,
            'jenis_laporan' => $jenis_laporan,
            'total_penjualan' => isset($result->total_penjualan) ? $result->total_penjualan : null,
            'total_keuntungan' => isset($result->total_keuntungan) ? $result->total_keuntungan : null
        ];

        // Mengirim data ke view laporan
        return view('laporan/laporan-bulanan-tahunan', $data);
    }
}