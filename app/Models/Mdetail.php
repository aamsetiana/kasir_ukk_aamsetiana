<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdetail extends Model
{
    protected $table            = 'tbl_detail_penjualan';
    protected $primaryKey       = 'id_detail';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_detail', 'id_penjualan', 'id_produk', 'qty', 'total_harga'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // public function getBarangByKode($kode)
    // {
    //     return $this->where('kode_produk', $kode)->first();
    // }
    public function getDetailPenjualan($idPenjualan)
    {
        return $this->db->table('tbl_detail_penjualan')
            ->select('tbl_detail_penjualan.*, tbl_penjualan.no_faktur,tbl_produk.nama_produk')
            ->join('tbl_penjualan', 'tbl_penjualan.id_penjualan = tbl_detail_penjualan.id_penjualan')
            ->join('tbl_produk', 'tbl_produk.id_produk = tbl_detail_penjualan.id_produk')
            ->where('tbl_detail_penjualan.id_penjualan', $idPenjualan)
            ->get()
            ->getResultArray();
    }

    public function getMonthlyIncome()
    {
        $db = db_connect();

        $builder = $db->table($this->table);
        $builder->select('YEAR(tbl_penjualan.tgl_penjualan) AS tahun, MONTH(tbl_penjualan.tgl_penjualan) AS bulan, SUM((tbl_produk.harga_jual - tbl_produk.harga_beli) * tbl_detail_penjualan.qty) AS total_pendapatan_bulanan');
        $builder->join('tbl_penjualan', 'tbl_penjualan.id_penjualan = tbl_detail_penjualan.id_penjualan');
        $builder->join('tbl_produk', 'tbl_produk.id_produk = tbl_detail_penjualan.id_produk');
        $builder->groupBy('tahun, bulan'); // Mengelompokkan berdasarkan tahun dan bulan

        $query = $builder->get();
        $results = $query->getResultArray();

        // Inisialisasi array untuk menyimpan total pendapatan bulanan untuk setiap bulan
        $monthlyIncome = [];

        // Inisialisasi array untuk menyimpan label bulan
        $months = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // Mengisi array total pendapatan bulanan dengan nol untuk setiap bulan
        foreach ($months as $index => $month) {
            $monthlyIncome[$index + 1] = 0; // Bulan dimulai dari 1, bukan dari 0
        }

        // Mengisi array total pendapatan bulanan dengan nilai yang diperoleh dari hasil query
        foreach ($results as $row) {
            $monthlyIncome[$row['bulan']] = $row['total_pendapatan_bulanan'];
        }

        // Mengembalikan data total pendapatan bulanan untuk digunakan oleh chart
        return [
            'months' => $months,
            'monthlyIncome' => array_values($monthlyIncome) // Mengambil nilai dari array untuk memastikan urutan yang benar
        ];
    }

    public function pendapatanBulanan()
    {
        $db = \Config\Database::connect(); // Mengambil instance koneksi database

        $builder = $db->table('tbl_detail_penjualan');
        $builder->select('SUM((tbl_produk.harga_jual - tbl_produk.harga_beli) * tbl_detail_penjualan.qty) AS total_pendapatan_bulanan');
        $builder->join('tbl_penjualan', 'tbl_penjualan.id_penjualan = tbl_detail_penjualan.id_penjualan');
        $builder->join('tbl_produk', 'tbl_produk.id_produk = tbl_detail_penjualan.id_produk');
        // Filter data berdasarkan bulan dan tahun
        $builder->where('YEAR(tbl_penjualan.tgl_penjualan)', date('Y')); // Filter tahun ini
        $builder->where('MONTH(tbl_penjualan.tgl_penjualan)', date('m')); // Filter bulan ini

        $query = $builder->get();
        $result = $query->getRowArray(); // Mengambil hasil query sebagai array

        return $result['total_pendapatan_bulanan'];
    }


    public function getLaporanPenjualan($bulan, $tahun, $jenis_laporan)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('tbl_detail_penjualan.*, SUM(tbl_detail_penjualan.total_harga) AS total_penjualan, SUM((tbl_produk.harga_jual - tbl_produk.harga_beli) * tbl_detail_penjualan.qty) AS total_keuntungan, tbl_produk.nama_produk, tbl_produk.harga_jual, tbl_produk.harga_beli');
        $builder->join('tbl_penjualan', 'tbl_penjualan.id_penjualan = tbl_detail_penjualan.id_penjualan');
        $builder->join('tbl_produk', 'tbl_produk.id_produk = tbl_detail_penjualan.id_produk');

        if ($jenis_laporan == 'bulanan') {
            $builder->where('MONTH(tbl_penjualan.tgl_penjualan)', $bulan);
            $builder->where('YEAR(tbl_penjualan.tgl_penjualan)', $tahun);
        } else {
            $builder->where('YEAR(tbl_penjualan.tgl_penjualan)', $tahun);
        }

        $query = $builder->get();
        return $query->getRow();
    }

    public function getDetailJual($bulan, $tahun, $jenis_laporan)
    {
        $db = \Config\Database::connect();
        $detailQuery = $db->table($this->table)
            ->select('tbl_detail_penjualan.*, tbl_produk.nama_produk, tbl_produk.harga_jual, tbl_produk.harga_beli')
            ->join('tbl_produk', 'tbl_produk.id_produk = tbl_detail_penjualan.id_produk');

        if ($jenis_laporan == 'bulanan') {
            $detailQuery->join('tbl_penjualan', 'tbl_penjualan.id_penjualan = tbl_detail_penjualan.id_penjualan')
                ->where('MONTH(tbl_penjualan.tgl_penjualan)', $bulan)
                ->where('YEAR(tbl_penjualan.tgl_penjualan)', $tahun);
        } else {
            $detailQuery->join('tbl_penjualan', 'tbl_penjualan.id_penjualan = tbl_detail_penjualan.id_penjualan')
                ->where('YEAR(tbl_penjualan.tgl_penjualan)', $tahun);
        }

        $detailResult = $detailQuery->get()->getResultArray();
        return $detailResult;
    }
}
