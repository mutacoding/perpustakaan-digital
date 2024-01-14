<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContactModel;

class Contact extends BaseController
{
  protected $contact;
  protected $validation;

  public function __construct()
  {
    $this->contact = new ContactModel();
    $this->validation = \Config\Services::validation();
  }

  public function getAll()
  {
    $data['data'] = array();
    $result = $this->contact->select()->findAll();
    $no = 1;
    foreach ($result as $key => $value) {
      $data['data'][$key] = array(
        $no,
        $value['email'],
        $value['pesan'],
      );
      $no++;
    }
    return $this->response->setJSON($data);
  }

  public function pesan()
  {
    $valid = $this->validate([
      'en_pesan' => [
        'label' => 'Saran dan komentar',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong!!'
        ]
      ],
    ]);

    if (!$valid) {
      $msg = [
        'error' => [
          'en_pesan' => $this->validation->getError('en_pesan'),
        ]
      ];

      return $this->response->setJSON($msg);
    } else {

      $simpandata = [
        'email' => $this->request->getPost('en_email'),
        'pesan' => $this->request->getPost('en_pesan'),
      ];

      $status = $this->contact->TambahContact($simpandata);

      if ($status) {
        $respon = [
          'status' => true,
          'msg' => 'Saran dan komentar berhasil dikirim!!'
        ];
      } else {
        $respon = [
          'status' => false,
          'msg' => 'Saran dan komentar gagal dikirim!!'
        ];
      }

      return $this->response->setJSON($respon);
    }
  }
}
