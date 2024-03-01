<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pengguna extends BaseController
{
    public function pengguna()
    {
        if (session()->get('level') != 'Admin') {
            return redirect()->back();
            exit;
        }

        $data = [
            'chartData' => $this->detail->getMonthlyIncome(),
            'akses' => session()->get('level'),
            'listPengguna' => $this->pengguna->findAll()
        ];
        return view('Pengguna/list-pengguna', $data);
    }

    public function tambahPengguna()
    {
        if (session()->get('level') != 'Admin') {
            return redirect()->back();
            exit;
        }

        $data = [
            'chartData' => $this->detail->getMonthlyIncome(),
            'akses' => session()->get('level')
        ];
        return view('Pengguna/tambah-pengguna', $data);
    }

    public function simpanPengguna()
    {

        $validation = \Config\Services::validation();

        $rules = [
            'email' => 'required|is_unique[tbl_user.email]',
            'username' => 'required|is_unique[tbl_user.username]',
            'nama_user' => 'required',
            'password' => 'required',
        ];

        $messages = [
            'email' => [
                'required' => 'Tidak boleh kosong!',
                'is_unique' => 'Email sudah ada, silahkan gunakan yang lain',
            ],
            'username' => [
                'required' => 'Tidak boleh kosong!',
                'is_unique' => 'Username sudah ada, silahkan gunakan yang lain',
            ],
            'nama_user' => [
                'required' => 'Tidak boleh kosong!',
            ],
            'password' => [
                'required' => 'Tidak boleh kosong!',
            ],
        ];

        // set validasi
        $validation->setRules($rules, $messages);

        // cek validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'nama_user' => $this->request->getVar('nama_user'),
            'password' => md5($this->request->getVar('password')),
            'level' => $this->request->getVar('level')
        ];
        $this->pengguna->save($data);
        session()->setFlashdata('tambah', 'Data berhasil ditambahkan');
        return redirect()->to('/data-pengguna');
    }

    public function editPengguna($username)
    {
        if (session()->get('level') != 'Admin') {
            return redirect()->back();
            exit;
        }

        $syarat = [
            'email' => $username
        ];

        $data = [
            'chartData' => $this->detail->getMonthlyIncome(),
            'akses' => session()->get('level'),
            'detailUser' => $this->pengguna->where($syarat)->findAll()
        ];
        return view('Pengguna/edit-pengguna', $data);
    }

    public function simpanEditPengguna()
    {

        $email = $this->request->getVar('email');

        $validation = \Config\Services::validation();

        $rules = [
            'email' => 'required|is_unique[tbl_user.email,email,' . $email . ']',
            'username' => 'required|is_unique[tbl_user.username,email,' . $email . ']',
            'nama_user' => 'required'
        ];

        $message = [
            'email' => [
                'required' => 'Tidak boleh kosong',
                'is_unique' => 'email sudah ada, silahkan gunakan yang lain'
            ],
            'username' => [
                'required' => 'Tidak boleh kosong',
                // 'is_unique' => 'username sudah ada, silahkan gunakan yang lain'
            ],
            'nama_user' => [
                'required' => 'Tidak boleh kosong',
            ],
        ];

        $validation->setRules($rules, $message);


        $datavalid = [
            'email' => $email,
            'username' => $this->request->getPost('username'),
            'nama_user' => $this->request->getPost('nama_user'),
        ];
        if (!$validation->run($datavalid)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'nama_user' => $this->request->getVar('nama_user'),
            'level' => $this->request->getVar('level')
        ];
        $this->pengguna->update($email, $data);
        session()->setFlashdata('edit', 'Data berhasil diupdate');
        return redirect()->to('/data-pengguna');
    }

    public function hapusPengguna($email)
    {
        $syarat = [
            'email' => $email
        ];
        $this->pengguna->where($syarat)->delete();
        session()->setFlashdata('hapus', 'Data berhasil dihapus');
        return redirect()->to('/data-pengguna');
    }
}
