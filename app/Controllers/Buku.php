<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BukuModel;
use App\Models\KategoriModel;

class Buku extends BaseController
{
    protected $buku;
    protected $kategori;
    protected $validation;

    public function __construct()
    {
        $this->buku = new BukuModel();
        $this->kategori = new KategoriModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        if (session()->get('role') != 1) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        $data = [
            'kategori' => $this->kategori->findAll(),
        ];
        return view("admin/buku", $data);
    }

    public function getAll()
    {
        $data['data'] = array();
        $result = $this->buku->select()->tampilBuku();
        $no = 1;
        foreach ($result as $key => $value) {
            $ops = '<tr>';
            $ops .= '<a class="btn btn-success text-white" onclick="Edit(' . $value['id_buku'] . ')"><i class="fa fa-pencil"></i></a>';
            $ops .= '<a class="btn btn-danger text-white" onclick="Delete(' . $value['id_buku'] . ')"><i class="fa fa-trash"></i></a>';
            $ops .= '</tr>';
            $img = '<img src="/gambar/' . $value['cover_buku'] . '" style="width: 100px;" />';
            $data['data'][$key] = array(
                $no,
                $value['judul'],
                $value['kategori'],
                $value['penulis'],
                $value['penerbit'],
                $value['tahun_terbit'],
                $img,
                $ops
            );
            $no++;
        }
        return $this->response->setJSON($data);
    }

    public function create()
    {
        $valid = $this->validate([
            'en_judul' => [
                'label' => 'Judul Buku',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!!'
                ]
            ],

            'en_penulis' => [
                'label' => 'Penulis Buku',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!!'
                ]
            ],

            'en_penerbit' => [
                'label' => 'Penerbit Buku',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!!'
                ]
            ],

            'en_deskripsi' => [
                'label' => 'Deskripsi Buku',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!!',
                ]
            ],

            'en_cover' => [
                'label' => 'Gambar',
                'rules' => 'uploaded[en_cover]|max_size[en_cover,5120]|is_image[en_cover]',
                'errors' => [
                    'uploaded' => '{field} belum di upload',
                    'max_size' => 'Ukuran {field} terlalu besar!!',
                    'is_image' => 'Yang anda pilih bukan {field}!!',
                ],
            ],

            'en_doc' => [
                'label' => 'Document',
                'rules' => 'uploaded[en_doc]|mime_in[en_doc,application/pdf]|max_size[en_doc, 5000000]',
                'errors' => [
                    'uploaded' => '{field} belum di upload',
                    'is_image' => 'Yang anda pilih bukan {field}!!',
                    'mime_in' => 'Yang anda pilih bukan {field}!!',
                ],
            ],
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'en_judul' => $this->validation->getError('en_judul'),
                    'en_penulis' => $this->validation->getError('en_penulis'),
                    'en_penerbit' => $this->validation->getError('en_penerbit'),
                    'en_deskripsi' => $this->validation->getError('en_deskripsi'),
                    'en_cover' => $this->validation->getError('en_cover'),
                    'en_doc' => $this->validation->getError('en_doc'),
                ]
            ];

            return $this->response->setJSON($msg);
        } else {

            // ambil cover
            $cover = $this->request->getFile('en_cover');

            // generate nama cover
            $namacover = $cover->getRandomName();

            // pindahkan file cover
            $cover->move('gambar', $namacover);

            //ambil document
            $doc = $this->request->getFile('en_doc');

            //generate nama file
            $namadoc = $doc->getRandomName();

            //pindahkan file document
            $doc->move("document", $namadoc);


            $simpandata = [
                'judul' => $this->request->getPost("en_judul"),
                'kategori_id' => $this->request->getPost("en_kat"),
                'penulis' => $this->request->getPost("en_penulis"),
                'penerbit' => $this->request->getPost("en_penerbit"),
                'tahun_terbit' => $this->request->getPost("en_terbit"),
                'deskripsi' => $this->request->getPost("en_deskripsi"),
                'cover_buku' => $namacover,
                'file_buku' => $namadoc,
                'view' => 0
            ];

            $result = $this->buku->TambahBuku($simpandata);

            if ($result) {
                $respon = [
                    'status' => true,
                    'msg' => 'Buku berhasil ditambah!!'
                ];
            } else {
                $respon = [
                    'status' => false,
                    'msg' => 'Maaf, buku gagal ditambah!!'
                ];
            }

            return $this->response->setJSON($respon);
        }
    }

    public function getOne()
    {
        $id = $this->request->getPost('id');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->buku->where('id_buku', $id)->first();

            return $this->response->setJSON($data);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    public function update()
    {
        $id = $this->request->getPost('en_id');

        $valid = $this->validate([
            'new_cover' => [
                'label' => 'Gambar',
                'rules' => 'max_size[new_cover,5120]|is_image[new_cover]',
                'errors' => [
                    'max_size' => 'ukuran {field} terlalu besar!!',
                    'is_image' => 'file {field} tidak sesuai!!'
                ],
            ],

            'new_doc' => [
                'label' => 'Document',
                'rules' => 'max_size[new_doc,100000]|mime_in[new_doc,application/pdf]',
                'errors' => [
                    'max_size' => 'ukuran {field} terlalu besar!!',
                    'is_image' => 'file {field} tidak sesuai!!'
                ],
            ],
        ]);

        if (!$valid) {
            $respon = [
                'error' => [
                    'new_cover' => $this->validation->getError('new_cover'),
                    'new_doc' => $this->validation->getError('new_doc'),
                ]
            ];

            return $this->response->setJSON($respon);
        } else {

            // ambil gambar
            $cover = $this->request->getFile('new_cover');

            // jika gambar tidak dimasukkan
            if ($cover->getError() == 4) {
                $namacover = $this->request->getPost('en_cover');
            } else {
                // generate nama cover
                $namacover = $cover->getRandomName();

                // pindahkan file gambar
                $cover->move('gambar', $namacover);

                // hapus file document lama
                unlink('gambar/' . $this->request->getPost('en_cover'));
            }

            // ambil file document
            $doc = $this->request->getFile('new_doc');

            if ($doc->getError() == 4) {
                $namadoc = $this->request->getPost('en_doc');
            } else {
                // generate nama document
                $namadoc = $doc->getRandomName();

                // pindahkan file document
                $doc->move('document', $namadoc);

                // hapus file document lama
                unlink('document/' . $this->request->getPost('en_doc'));
            }

            $simpandata = [
                'judul' => $this->request->getPost("en_judul"),
                'kategori_id' => $this->request->getPost("en_kat"),
                'penulis' => $this->request->getPost("en_penulis"),
                'penerbit' => $this->request->getPost("en_penerbit"),
                'tahun_terbit' => $this->request->getPost("en_terbit"),
                'deskripsi' => $this->request->getPost("en_deskripsi"),
                'cover_buku' => $namacover,
                'file_buku' => $namadoc,
            ];

            $result = $this->buku->UpdateBuku($id, $simpandata);

            if ($result) {
                $respon = [
                    'status' => true,
                    'msg' => 'Data buku berhasil diubah!!'
                ];
            } else {
                $respon = [
                    'status' => false,
                    'msg' => 'Maaf, data buku gagal diubah!!'
                ];
            }

            return $this->response->setJSON($respon);
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('id');

        $data = $this->buku->find($id);

        // hapus file gambar
        unlink('gambar/' . $data['cover_buku']);

        // hapus file document
        unlink('document/' . $data['file_buku']);

        $result = $this->buku->DeleteBuku($id);

        if ($result) {
            $respon = [
                'status' => true,
                'msg' => 'Data buku berhasil dihapus!!'
            ];
        } else {
            $respon = [
                'status' => false,
                'msg' => 'Maaf, data buku gagal dihapus!!'
            ];
        }

        return $this->response->setJSON($respon);
    }

    public function View()
    {
        $id = $this->request->getPost('id');

        $data = $this->buku->find($id);

        $hasil = $data['view'] + 1;

        $updateview = [
            "view" => $hasil
        ];

        $result = $this->buku->updateView($id, $updateview);

        if ($result) {
            $respon = [
                'status' => true,
                'link' => base_url("user/view/$id")
            ];
        }

        return $this->response->setJSON($respon);
    }
}
