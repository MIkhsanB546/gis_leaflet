<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function __construct()
    {
        $this->model = new \App\Models\User();
    }

    public function registrasi()
    {
        
        $data = [
            'judul' => 'Registrasi',
            'page' => 'registrasi',
            'validation' => \Config\Services::validation(),

        ];
        return view('v_template', $data);
    }

    public function simpanRegistrasi()
    {
        //1. mengambil data dari input form
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'konfirmasi_password' => $this->request->getPost('kofirm_pass'),
        ];

        //2. validasi input form
        $validation =  \Config\Services::validation();

        $validation->setRules([
            'nama' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'konfirmasi_password' => 'required|matches[password]'
        ]);

        //3. cek validasi
        if ($validation->run($data)) {
            // jika berhasil, simpan data dan beri pesan berhasil
            $this->model->save([
                'name' => $data['nama'],
                'email' => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_BCRYPT),
                'role' => 'user'
            ]);

            return redirect()->to(base_url('login'))->with('sukses', 'Registrasi berhasil!');
        } else {
            // jika gagal, beri pesan gagal
            $errorMessages = $validation->getErrors();
            return redirect()->to(base_url('registrasi'))->with('gagal', $errorMessages);
        }
    }

    public function login()
    {
        $data = [
            'judul' => 'Login',
            'page' => 'auth/login',
            'validation' => \Config\Services::validation(),

        ];
        return view('v_template', $data);
    }

    public function prosesLogin()
    {
        if ($this->validate($this->rulesLogin())) {
         $query = $this->model->where('email', $this->request->getPost('email'));
         $count = $query->countAllResults(false);
         $data = $query->get()->getRow();

         if ($count > 0) {

                $hashPassword = $data->password;

                if (password_verify($this->request->getPost('password'), $hashPassword)) {

                    $session = [
                        'name' => $data->name,
                        'role' => $data->role,
                        'logged_in' => TRUE
                    ];
                    session()->set($session);

                    return redirect()->to(base_url('Lokasi/pemetaanLokasi'));
                } else {
                    return redirect()->to(base_url('login'))->with('login_failed', 'Email / password anda salah');
                } 
            } else {
                    return redirect()->to(base_url('login'))->with('login_failed', 'Email tidak ditemukan');
                } 
            } else {
                return redirect()->to(base_url('login'))->withInput();
            }
    }
    public function rulesLogin()
    {
        $setRules = [
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Email anda tidak valid',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi',
                ]
            ]
        ];
        return $setRules;
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
