<?php

namespace App\Models;

use CodeIgniter\Model;

class Msatuan extends Model
{
    protected $table            = 'tbl_satuan';
    protected $primaryKey       = 'id_satuan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_satuan', 'nama_satuan'];

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


    public function cekRelasiSatuan($idsatuan)
    {
        $builder = $this->db->table('tbl_produk');
        $builder->where('id_satuan', $idsatuan);
        $count = $builder->countAllResults();
        return ($count > 0);
    }
    // public function getErrors()
    // {
    //     $errors = $this->errors();

    //     if (isset($errors['nama_satuan'])) {
    //         if ($errors['nama_satuan'] === 'is_unique') {
    //             $errors['nama_satuan'] = 'Nama satuan sudah ada.';
    //         }
    //     }

    //     return $errors;
    // }
}
