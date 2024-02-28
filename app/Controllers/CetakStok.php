<?php

namespace App\Controllers;

use App\Controllers\BaseController;
// use App\Models\Mproduk;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;

class CetakStok extends BaseController
{
    public function generate()
    {
        // $produk = new Mproduk();
        // $data['listProduk'] = $produk->getListProduk();
        $data = [
            'listProduk' => $this->produk->getAllProduk(),
            'listProduk' => $this->produk->getProdukOrderByStokAscInStock(),
        ];

        // Load library Dompdf
        $dompdf = new Dompdf();

        // Set HTML content untuk laporan
        $html = view('Cetak/pdf-cetak', $data);

        // Convert HTML ke PDF
        $dompdf->loadHtml($html);

        // Setting ukuran dan orientasi kertas
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF ke browser
        $dompdf->render();

        // Tampilkan PDF dalam browser
        $dompdf->stream('laporan_stok.pdf', ['Attachment' => true]);
    }
}
