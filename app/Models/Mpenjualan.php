<?php

namespace App\Models;

use CodeIgniter\Model;

class Mpenjualan extends Model
{
    protected $table            = 'tbl_penjualan';
    protected $primaryKey       = 'id_penjualan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_penjualan', 'no_faktur', 'tgl_penjualan', 'email', 'total'];

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

    public function buatFaktur()
    {
        $tgl = date('Ymd');
        $query = $this->db->query("SELECT MAX(RIGHT(no_faktur,4)) as noFaktur FROM tbl_penjualan WHERE DATE(tgl_penjualan)='$tgl' ");
        $hasil = $query->getRowArray();
        if ($hasil['noFaktur'] > 0) {
            $tmp = $hasil['noFaktur'] + 1;
            $kd = sprintf("%04s", $tmp);
        } else {
            $kd = "0001";
        }
        $no_faktur = date('Ymd') . $kd;
        return $no_faktur;
    }

    public function getTotalHargaById($idPenjualan)
    {
        $query = $this->select('total')->where('id_penjualan', $idPenjualan)->first();
        // Periksa apakah hasil kueri tidak kosong sebelum mengakses indeks 'total'
        if ($query) {
            return $query['total'];
        } else {
            // Jika hasil kueri kosong, kembalikan nilai default, misalnya 0
            return 0;
        }
    }

    public function getPendapatanHarian()
    {
        $today = date('Y-m-d');
        return $this->where('DATE(tgl_penjualan)', $today)->select('SUM(total) AS pendapatan_harian')->get()->getRow()->pendapatan_harian;
    }

    // public function getPenjualanBulanan()
    // {
    //     $builder = $this->db->table('tbl_penjualan');
    //     $builder->select('MONTH(tgl_penjualan) AS bulan, SUM(total) AS total_penjualan');
    //     $builder->groupBy('MONTH(tgl_penjualan)');
    //     $builder->orderBy('bulan', 'asc');
    //     return $builder->get()->getResultArray();
    // }

    // public function getPenjualanTahunan()
    // {
    //     $builder = $this->db->table('tbl_penjualan');
    //     $builder->select('YEAR(tgl_penjualan) AS tahun, SUM(total) AS total_penjualan');
    //     $builder->groupBy('YEAR(tgl_penjualan)');
    //     $builder->orderBy('tahun', 'asc');
    //     return $builder->get()->getResultArray();
    // }



    // public function autocomplete($keyword)
    // {
    //     return $this->like('kode_barang', $keyword)
    //                 ->orLike('nama_barang', $keyword)
    //                 ->findAll();
    // }
}
