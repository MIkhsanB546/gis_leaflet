<?php

namespace App\Controllers;

use App\Models\ModelLokasi;

class Lokasi extends BaseController
{   
    // biarin aja error ModelLokasi, itu tidak akan mengganggu
    public function __construct()
    {
        $this->ModelLokasi = new ModelLokasi();
    }

    public function index()
    {
        $data = [
            'judul' => 'Data Lokasi',
            'page' => 'lokasi/v_data_lokasi',
            'lokasi' => $this->ModelLokasi->getAllData(),
        ];
        return view('v_template', $data);
    }
    
    public function inputLokasi()
    {
        $data = [
            'judul' => 'Input Lokasi',
            'page' => 'lokasi/v_input_lokasi',
        ];
        return view('v_template', $data);
    }
    
    public function insertData()
    {
        if ($this->validate([
            'nama_lokasi' => [
                'label' => 'Nama Lokasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong !!!'
                ]
            ],
            'alamat_lokasi' => [
                'label' => 'Alamat Lokasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong !!!'
                ]
            ],
            'latitude' => [
                'label' => 'Latitude',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong !!!'
                ]
            ],
            'longitude' => [
                'label' => 'Longitude',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong !!!'
                ]
            ],
            'foto_lokasi' => [
                'label' => 'Foto Lokasi',
                'rules' => 'uploaded[foto_lokasi]|max_size[foto_lokasi,4096]|mime_in[foto_lokasi,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => '{field} Tidak Boleh Kosong !!!',
                    'max_size' => 'Unkuran {field} Maksimal 4 MB !!!',
                    'mime_in' => 'Format {field} Harus .jpg, .jpeg, .png !!!',
                ]
            ],
        ])) {
            $foto_lokasi = $this->request->getFile('foto_lokasi');
            $nama_file_foto = $foto_lokasi->getRandomName();
            //jika berhasil validasi
            $data = [
                'nama_lokasi' => $this->request->getPost('nama_lokasi'),
                'alamat_lokasi' => $this->request->getPost('alamat_lokasi'),
                'latitude' => $this->request->getPost('latitude'),
                'longitude' => $this->request->getPost('longitude'),
                'foto_lokasi' => $nama_file_foto,
            ];
            $foto_lokasi->move('foto', $nama_file_foto);
            //kirim data ke function insert data di model lokasi
            $this->ModelLokasi->insertData($data);
            //notifikasi data berhasil di simpan
            session()->setFlashdata('pesan', 'Data Lokasi Berhasil Di Tambahkan !!!');
            return redirect()->to('Lokasi/inputLokasi');
        } else {
            //jika gagal validasi
            return redirect()->to('Lokasi/inputLokasi')->withInput();
        }
    }
    
    public function pemetaanLokasi()
    {
        $data = [
            'judul' => 'Lokasi',
            'page' => 'lokasi/v_pemetaan_lokasi',
            'lokasi' => $this->ModelLokasi->getAllData(),
        ];
        return view('v_template', $data);
    }
    
    public function editLokasi($id_lokasi)
    {
        $data = [
            'judul' => 'Edit Lokasi',
            'page' => 'lokasi/v_edit_lokasi',
            'lokasi' => $this->ModelLokasi->getDataById($id_lokasi),
        ];
        return view('v_template', $data);
    }

    public function updateData($id_lokasi)
    {
        if ($this->validate([
            'nama_lokasi' => [
                'label' => 'Nama Lokasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong !!!'
                ]
            ],
            'alamat_lokasi' => [
                'label' => 'Alamat Lokasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong !!!'
                ]
            ],
            'latitude' => [
                'label' => 'Latitude',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong !!!'
                ]
            ],
            'longitude' => [
                'label' => 'Longitude',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong !!!'
                ]
            ],
            'foto_lokasi' => [
                'label' => 'Foto Lokasi',
                'rules' => 'max_size[foto_lokasi,4096]|mime_in[foto_lokasi,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Unkuran {field} Maksimal 4 MB !!!',
                    'mime_in' => 'Format {field} Harus .jpg, .jpeg, .png !!!',
                ]
            ],
        ])) {
            $foto_lokasi = $this->request->getFile('foto_lokasi');

            $lokasi = $this->ModelLokasi->getDataById($id_lokasi);
            if ($foto_lokasi->getError() == 4) {
                $nama_file_foto = $lokasi['foto_lokasi'];
            } else {
                $nama_file_foto = $foto_lokasi->getRandomName();
                $foto_lokasi->move('foto', $nama_file_foto);
            }

            //jika berhasil validasi
            $data = [
                'id_lokasi' => $id_lokasi,
                'nama_lokasi' => $this->request->getPost('nama_lokasi'),
                'alamat_lokasi' => $this->request->getPost('alamat_lokasi'),
                'latitude' => $this->request->getPost('latitude'),
                'longitude' => $this->request->getPost('longitude'),
                'foto_lokasi' => $nama_file_foto,
            ];
            
            //kirim data ke function update data di model lokasi
            $this->ModelLokasi->updateData($data);
            //notifikasi data berhasil di simpan
            session()->setFlashdata('pesan', 'Data Lokasi Berhasil Di Update !!!');
            return redirect()->to('Lokasi/index');
        } else {
            //jika gagal validasi
            return redirect()->to('Lokasi/updateLokasi/' . $id_lokasi)->withInput();
        }
    }

    public function deleteLokasi($id_lokasi)
    {
        $data = [
            'id_lokasi' => $id_lokasi,
        ];
        
        //kirim data ke function delete data model lokasi
        $this->ModelLokasi->deleteData($data);
        //notifikasi data berhasil di simpan
        session()->setFlashdata('pesan', 'Data Lokasi Berhasil Di Delete !!!');
        return redirect()->to('Lokasi/index');
    }
}