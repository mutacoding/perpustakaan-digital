<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdiModel;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $prodi;
    protected $user;
    protected $validation;

    public function __construct()
    {
        $this->user = new UserModel();
        $this->prodi = new ProdiModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        return view('auth/index');
    }

    public function registrasi()
    {
        $data = [
            'prodi' => $this->prodi->findAll()
        ];
        return view('auth/register', $data);
    }

    public function create()
    {
        $valid = $this->validate([
            'en_nama' => [
                'label' => 'nama lengkap',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!!'
                ]
            ],

            'en_email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!!',
                    'valid_email' => '{field} tidak valid!!'
                ]
            ],

            'en_password' => [
                'label' => 'Password',
                'rules' => 'required|matches[con_password]|min_length[3]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!!',
                    'matches' => '{field} tidak sama!!',
                    'min_lenght' => '{field} minimal 3 karakter!!'
                ]
            ],

            'con_password' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[en_password]|min_length[3]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!!',
                    'matches' => '{field} tidak sama!!',
                    'min_lenght' => '{field} minimal 3 karakter!!'
                ]
            ],
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'en_nama' => $this->validation->getError('en_nama'),
                    'en_email' => $this->validation->getError('en_email'),
                    'en_password' => $this->validation->getError('en_password'),
                    'con_password' => $this->validation->getError('con_password'),
                ]
            ];

            return $this->response->setJSON($msg);
        } else {

            $status = $this->request->getPost('en_status');

            if ($status == 'mahasiswa' || $status == 'dosen') {
                $simpandata = [
                    'nama' => $this->request->getPost("en_nama"),
                    'email' => $this->request->getPost("en_email"),
                    'password' => $this->request->getPost("en_password"),
                    'status' => $status,
                    'foto' => 'default.jpg',
                    'prodi' => $this->request->getPost('en_prodi'),
                    'role_id' => 2,
                ];
            }

            $result = $this->user->TambahUser($simpandata);

            if ($result) {
                $respon = [
                    'status' => true,
                    'msg' => 'Registrasi berhasil',
                    'link' => base_url('')
                ];
            } else {
                $respon = [
                    'status' => false,
                    'msg' => 'Maaf, registrasi gagal',
                    'link' => base_url('registrasi')
                ];
            }

            return $this->response->setJSON($respon);
        }
    }

    public function login()
    {
        $valid = $this->validate([
            'en_email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'erros' => [
                    'required' => '{field} tidak boleh kosong',
                    'valid_email' => '{field} tidak valid'
                ]
            ],

            'en_password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]

        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'en_email' => $this->validation->getError('en_email'),
                    'en_password' => $this->validation->getError('en_password'),
                ]
            ];

            return $this->response->setJSON($msg);
        } else {
            $email = $this->request->getPost('en_email');
            $pass = $this->request->getPost('en_password');

            $cek_user = $this->user->cekuser($email);

            if ($cek_user) {
                if ($pass == $cek_user['password']) {
                    if ($cek_user['role_id'] == 1) {
                        $set_session = [
                            'id_user' => $cek_user['id_user'],
                            'nama' => $cek_user['nama'],
                            'foto' => $cek_user['foto'],
                            'role' => $cek_user['role_id'],
                            'login' => true,
                        ];

                        session()->set($set_session);

                        $respon = [
                            'status' => true,
                            'msg' => 'Anda berhasil login',
                            'link' => base_url('admin')
                        ];

                        return $this->response->setJSON($respon);
                    } else if ($cek_user['role_id'] == 2) {
                        $set_session = [
                            'id_user' => $cek_user['id_user'],
                            'nama' => $cek_user['nama'],
                            'email' => $cek_user['email'],
                            'foto' => $cek_user['foto'],
                            'role' => $cek_user['role_id'],
                            'login' => true,
                        ];

                        session()->set($set_session);

                        $respon = [
                            'status' => true,
                            'msg' => 'Anda berhasil login',
                            'link' => base_url('user')
                        ];

                        return $this->response->setJSON($respon);
                    }
                } else {
                    $respon = [
                        'status' => false,
                        'msg' => 'Password anda salah!'
                    ];
                }
            } else {
                $respon = [
                    'status' => false,
                    'msg' => 'Email anda tidak terdaftar silahkan registrasi!'
                ];
            }

            return $this->response->setJSON($respon);
        }
    }

    public function logout()
    {
        session()->destroy();

        $respon = [
            'status' => true,
            'msg' => 'Anda berhasil logout',
            'link' => base_url('')
        ];

        return $this->response->setJSON($respon);
    }

    public function profil()
    {
        $id = $this->request->getPost('en_id');

        $valid = $this->validate([
            'new_foto' => [
                'label' => 'Gambar',
                'rules' => 'max_size[new_foto,5120]|is_image[new_foto]',
                'errors' => [
                    'max_size' => 'ukuran {field} terlalu besar!!',
                    'is_image' => 'file {field} tidak sesuai!!'
                ],
            ],
        ]);

        if (!$valid) {
            $respon = [
                'error' => [
                    'new_foto' => $this->validation->getError('new_foto')
                ]
            ];
            return $this->response->setJSON($respon);
        } else {

            $data = $this->user->find($id);

            $status = $this->request->getPost('en_status');

            // ambil gambar
            $foto = $this->request->getFile('new_foto');

            // jika gambar tidak dimasukkan
            if ($foto->getError() == 4) {
                $namafoto = $this->request->getPost('en_foto');
            } else {
                // generate nama foto
                $namafoto = $foto->getRandomName();

                // pindahkan file gambar
                $foto->move('gambar', $namafoto);

                if ($data['foto'] != "default.jpg") {
                    // hapus file foto lama
                    unlink('gambar/' . $this->request->getPost('en_foto'));
                }
            }

            if ($status == "mahasiswa" || $status == "dosen") {
                $simpandata = [
                    'nama' => $this->request->getPost("en_nama"),
                    'no_induk' => $this->request->getPost("en_noin"),
                    'email' => $this->request->getPost("en_email"),
                    'jenkel' => $this->request->getPost("en_jenkel"),
                    'alamat' => $this->request->getPost("en_alamat"),
                    'telp' => $this->request->getPost("en_telp"),
                    'foto' => $namafoto,
                ];
            } else {
                $simpandata = [
                    'nama' => $this->request->getPost("en_nama"),
                    'email' => $this->request->getPost("en_email"),
                    'jenkel' => $this->request->getPost("en_jenkel"),
                    'alamat' => $this->request->getPost("en_alamat"),
                    'telp' => $this->request->getPost("en_telp"),
                    'foto' => $namafoto,
                ];
            }

            $result = $this->user->updateUser($id, $simpandata);

            session()->set($simpandata);

            if ($result) {
                $respon = [
                    'status' => true,
                    'msg' => 'Profil berhasil diubah!!'
                ];
            }

            return $this->response->setJSON($respon);
        }
    }
}
