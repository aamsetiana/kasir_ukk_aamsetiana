<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class KategoriProduk extends BaseController
{
    public function kategori()
    {
        if (session()->get('level') != 'Admin') {
            return redirect()->back();
            exit;
        }

        $data = [
            'chartData' => $this->detail->getMonthlyIncome(),
            'akses' => session()->get('level'),
            'listKategori' => $this->kategori_produk->findAll()
        ];

        return view('Kategori/list-kategori', $data);
    }

    public function tambahKategori()
    {
        if (session()->get('level') != 'Admin') {
            return redirect()->back();
            exit;
        }

        $data = [
            'chartData' => $this->detail->getMonthlyIncome(),
            'akses' => session()->get('level')
        ];
        return view('Kategori/tambah-kategori', $data);
    }

    public function simpanKategori()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'nama_kategori' => 'required|is_unique[tbl_kategori.nama_kategori]'
        ];

        $messages = [
            'nama_kategori' => [
                'required' => 'Tidak boleh kosong!',
                'is_unique' => 'Nama kategori sudah ada silahkan gunakan yang lain'
            ],
        ];

        // set validasi
        $validation->setRules($rules, $messages);

        // cek validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ];
        // var_dump($data);
        $this->kategori_produk->save($data);
        session()->setFlashdata('tambah1', 'Data berhasil ditambahkan');
        return redirect()->to('/kategori-produk');
    }

    public function editKategori($idkategori)
    {
        if (session()->get('level') != 'Admin') {
            return redirect()->back();
            exit;
        }

        $syarat = [
            'id_kategori' => $idkategori
        ];

        $data = [
            'chartData' => $this->detail->getMonthlyIncome(),
            'akses' => session()->get('level'),
            'detailKategori' => $this->kategori_produk->where($syarat)->findAll()
        ];
        return view('Kategori/edit-kategori', $data);
    }

    public function simpanEditKategori()
    {

        $idkategori = $this->request->getVar('id_kategori');

        $validation = \Config\Services::validation();

        $rules = [
            'nama_kategori' => 'required|is_unique[tbl_kategori.nama_kategori,id_kategori,' . $idkategori . ']'
        ];

        $message = [
            'nama_kategori' => [
                'required' => 'Tidak boleh kosong',
                'is_unique' => 'Nama kategori sudah ada'
            ],
        ];

        $validation->setRules($rules, $message);


        $datavalid = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'id_kategori' => $idkategori,
        ];
        if (!$validation->run($datavalid)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ];
        $this->kategori_produk->update($idkategori, $data);
        session()->setFlashdata('edit1', 'Data berhasil diupdate');
        return redirect()->to('kategori-produk');
    }

    public function hapusKategori($idKategori)
    {
        $syarat = [
            'id_kategori' => $idKategori
        ];
        $this->kategori_produk->where($syarat)->delete();
        session()->setFlashdata('hapus1', 'Data berhasil dihapus');
        return redirect()->to('/kategori-produk');
    }

    //new
    public function cekRelasii($idkategori)
    {
        $relasi = $this->kategori_produk->cekRelasi($idkategori);

        return $this->response->setJSON(['has_relasi' => $relasi]);
    }
}
