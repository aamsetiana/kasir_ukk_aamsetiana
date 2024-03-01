<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function index()
    {
        return view('halaman-login');
    }

    public function prosesLogin()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $messages = [
            'email' => [
                'required' => 'Masukan email anda!',
            ],
            'password' => [
                'required' => 'Masukan password anda!',
            ],
        ];

        // set validasi
        $validation->setRules($rules, $messages);

        // cek validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $validasiForm = [
            'email' => 'required',
            'password' => 'required'
        ];

        if ($this->validate($validasiForm)) {

            $pengguna = $this->pengguna->getPengguna(
                $this->request->getPost('email'),
                $this->request->getPost('password')
            );

            if (count($pengguna) == 1) {

                $dataSession = [
                    'email' => $pengguna[0]['email'],
                    'username' => $pengguna[0]['username'],
                    'nama_user' => $pengguna[0]['nama_user'],
                    'password' => $pengguna[0]['password'],
                    'level'    => $pengguna[0]['level'],
                    'sudahkahLogin' => true
                ];

                session()->set($dataSession);
            }
            if (session()->get('level') === 'Admin') {
                return redirect()->to('/halaman-admin');
            } else if (session()->get('level') === 'Kasir') {
                return redirect()->to('/halaman-kasir');
            } else {
                return redirect()->to('/')->with('pesan', '<div class="text-center mt-3 font-weight-bold`"><p class="text-danger fw-bold">Email atau Password salah harap cek kembali</p></div>');
            }
        }
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/');
    }
}
