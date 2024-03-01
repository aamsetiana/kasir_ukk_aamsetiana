<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Mdetail;
use App\Models\Mpenjualan;
use App\Models\Mproduk;
use CodeIgniter\HTTP\ResponseInterface;

class TransaksiPenjualan extends BaseController
{
    // protected $db;

    // public function __construct()
    // {
    //     $this->db = db_connect();
    // }

    public function transaksi()
    {
        if (session()->get('level') != 'Kasir') {
            return redirect()->back();
            exit;
        }

        $data = [
            'chartData' => $this->detail->getMonthlyIncome(),
            'akses' => session()->get('level'),
            // 'no_faktur' => $this->penjualan->buatFaktur(),
            'no_faktur' => $this->penjualan->generateNomerFaktur(),
            'produkList' => $this->produk->getProdukStokKosong(),
            // 'barang'   => $this->detail->findAll(),
            'produkList' => $this->produk->getSemuaProduk(),
            'detailPenjualan' => $this->detail->getDetailPenjualan(session()->get('IdPenjualan')),
            'totalHarga' => $this->penjualan->getTotalHargaById(session()->get('IdPenjualan')),

        ];
        return view('Transaksi/transaksi-penjualan', $data);
    }

    public function transaksiSimpan()
    {

        $validation = \Config\Services::validation();

        $rules = [
            'qty' => 'required|greater_than[0]',
            'id_produk' => 'required',
        ];

        $messages = [
            'qty' => [
                'required' => 'Tidak boleh kosong!',
                'greater_than' => 'Jumlah harus lebih besar dari 0!'
            ],
            'id_produk' => [
                'required' => 'Tidak boleh kosong!',
            ],
        ];

        // set validasi
        $validation->setRules($rules, $messages);

        // cek validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // ambil detail barang yang dijual
        $where = ['id_produk' => $this->request->getPost('id_produk')];

        $cekBarang = $this->produk->where($where)->findAll();
        $hargaJual = $cekBarang[0]['harga_jual'];


        if (session()->get('IdPenjualan') == null) {
            // 1. Menyiapkan data penjualan
            date_default_timezone_set('Asia/Jakarta');
            // Mendapatkan waktu saat ini dalam zona waktu yang telah diatur
            $tanggal_sekarang = date('Y-m-d H:i:s');
            // 1 nampung data penjualan
            $dataPenjualan = [
                'no_faktur' => $this->request->getPost('no_faktur'),
                'tgl_penjualan' => $tanggal_sekarang,
                'email' => session()->get('email'),
                'total' => 0
                // 'total' => ($this->request->getPost('qty') * $hargaJual)
            ];

            //2 simpan ke tabel penjualan
            $this->penjualan->insert($dataPenjualan);

            //3 nyiapin data baut nyimpen detail
            $idPenjualanBaru = $this->penjualan->insertID(); // Mendapatkan ID penjualan baru
            $dataDetailPenjualan = [
                'id_penjualan' => $this->penjualan->insertID(),
                'id_produk' => $this->request->getPost('id_produk'),
                'qty' => $this->request->getPost('qty'),
                'total_harga' => $hargaJual * $this->request->getPost('qty')
            ];

            //4 simpan ke detail penjualan
            $this->detail->insert($dataDetailPenjualan);
            // var_dump($dataDetailPenjualan);


            // 5. Membuat session untuk penjualan baru
            session()->set('IdPenjualan', $idPenjualanBaru);
        } else {
            // Jika ada ID penjualan yang sudah tersimpan di sesi, gunakan ID itu untuk menyimpan detail penjualan
            $idPenjualanSaatIni = session()->get('IdPenjualan');

            //3 nyiapin data baut nyimpen detail
            $dataDetailPenjualan = [
                'id_penjualan' => session()->get('IdPenjualan'),
                'id_produk' => $this->request->getPost('id_produk'),
                'qty' => $this->request->getPost('qty'),
                'total_harga' => $hargaJual * $this->request->getPost('qty')
            ];

            //4 simpan ke detail penjualan
            $this->detail->insert($dataDetailPenjualan);
        }
        return redirect()->to('transaksi-jual');
        // var_dump($dataDetailPenjualan);
    }

    public function simpanPembayaran()
    {
        // Mendapatkan ID penjualan yang selesai
        $idPenjualanSelesai = session()->get('IdPenjualan');

        // Menghapus ID penjualan dari sesi
        session()->remove('IdPenjualan');

        // Mengarahkan pengguna kembali ke halaman transaksi penjualan
        return redirect()->to('transaksi-jual');
    }

    // public function getProductName()
    // {
    //     $kode = $this->request->getVar('kode_produk');
    //     $detail = new Mdetail();
    //     $produk = $detail->getBarangByKode($kode);

    //     if ($produk) {
    //         return json_encode($produk);
    //     } else {
    //         return json_encode(['error' => 'Barang tidak ditemukan']);
    //     }
    // }
    // public function autocomplete()
    // {
    //     $keyword = $this->request->getPost('keyword');
    //     $penjualan = new Mpenjualan();
    //     $data = $penjualan->autocomplete($keyword);
    //     echo json_encode($data);
    // }

    // public function buatFaktur()
    // {
    //     $tgl = $this->request->getPost('tanggal');
    //     $query = $this->db->query("SELECT MAX(no_faktur) AS noFaktur FROM tbl_penjualan WHERE DATE_FORMAT(tgl_penjualan, '%Y-%m-%d) = '$tgl'");
    //     $hasil = $query->getRowArray();
    //     $data = $hasil['noFaktur'];

    //     $lastNoUrut = substr($data, -4);

    //     //nomor urut nambah 1
    //     $nextNoUrut = intval($lastNoUrut) + 1;

    //     //membuat format nomor transaksi berikutnya
    //     $fakturPenjualan = 'FK' . date('dmy', strtotime($tgl)) .  sprintf('%04s', $nextNoUrut);

    //     $msg = ['fakturpenjualan' => $fakturPenjualan];
    //     echo json_encode($msg);
    // }
}
