<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUsers;
use App\Models\ModelUserValidasi;
use Config\Services;

class Auth extends BaseController
{
    public function index()
    {
        return view('login/index');
    }


    //form Login
    function login()
    {
        if ($this->request->isAJAX()) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $validation = \Config\Services::validation();



            $valid = $this->validate([
                'email'    => [
                    'label'     => 'Email',
                    'rules'     => 'required',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ],
                'password'    => [
                    'label'     => 'Kata Sandi',
                    'rules'     => 'required',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ]
            ]);

            if (!$valid) {
                $json = [
                    'error' => [
                        'errEmail'     => $validation->getError('email'),
                        'errPassword'   => $validation->getError('password'),
                    ]
                ];
            } else {
                $modelUser  = new ModelUsers();

                $cekUser = $modelUser->find($email);

                if ($cekUser == null) {
                    $json = [
                        'error' => [
                            'errEmail'     => 'Maaf user tidak terdaftar',
                        ]
                    ];
                } else if ($cekUser['userlevel'] == '2') {
                    $json = [
                        'error' => [
                            'errEmail'     => 'Maaf user tidak terdaftar',
                        ]
                    ];
                } else {
                    $passwordUser = $cekUser['userpassword'];
                    if (sha1($password) == $passwordUser) {

                        // simpan session
                        $simpan_session = [
                            'iduser'    => $email,
                            'namauser'  => $cekUser['usernama'],
                            'userlevel'  => $cekUser['userlevel'],
                        ];
                        session()->set($simpan_session);

                        $json = [
                            'sukses' => 'Anda berhasil login...'
                        ];
                    } else {
                        $json = [
                            'error' => [
                                'errPassword'     => 'Maaf passwordword anda salah !!',
                            ]
                        ];
                    }
                }
            }

            return json_encode($json);
        }
    }

    // fungsi Logout
    public function keluar()
    {
        if ($this->request->isAJAX()) {
            session()->destroy();

            $json = [
                'sukses' => 'Anda berhasil logout...'
            ];

            echo json_encode($json);
        }
    }


    // untuk lupa kata sandi
    public function lupasandi()
    {
        if ($this->request->isAJAX()) {
            $emailuser      = $this->request->getPost('emailuser');

            $validation = \Config\Services::validation();



            $valid = $this->validate([
                'emailuser'    => [
                    'label'     => 'Email',
                    'rules'     => 'required',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ],
            ]);

            if (!$valid) {
                $json = [
                    'error' => [
                        'errEmail'     => $validation->getError('emailuser'),
                    ]
                ];
            } else {

                $modelUserValidasi = new ModelUserValidasi();

                $cekUser = $modelUserValidasi->find($emailuser);

                if ($cekUser == null) {
                    $json = [
                        'error' => [
                            'errEmail'         => 'Email belum terdaftar...',
                        ]
                    ];
                } else if ($cekUser['valuserstatus'] == "Progress") {
                    $json = [
                        'error' => [
                            'errEmail'         => 'Email belum terverifikasi...',
                        ]
                    ];
                } else {
                    $modelUser = new ModelUsers();
                    $rowUser = $modelUser->find($emailuser);

                    $userid      = $rowUser['userid'];
                    $usernama      = $rowUser['usernama'];

                    $useranda = sha1($userid);

                    $isiemail = "<h1>HI " . $usernama . " ...</h1><p>Ganti Password Anda<br><br>Kamu bisa klik tautan dibawah ini untuk mengganti Sandi Anda : <br>
                        http://192.168.1.99/toko-online/public/auth/ubahsandi/" . $useranda . "</p>";


                    $email = service('email');
                    $email->setTo($userid);
                    $email->setFrom('sutino.skom@gmail.com', 'Sutino');

                    $email->setSubject('Lupa Kata Sandi');

                    $email->setMessage($isiemail);


                    if ($email->send()) {
                        $json = [
                            'berhasil'        => 'Tautan berhasil dikirimkan ke email Anda, silahkan buka email Anda...'
                        ];
                    }
                }
            }
            echo json_encode($json);
        }
    }

    // form ganti sandi
    public function ubahsandi($user)
    {
        $modelUser = new ModelUsers();
        $rowUser = $modelUser->cekUser($user)->getRowArray();

        $data = [
            'userid' => $rowUser['userid'],
            'usernama' => $rowUser['usernama'],
        ];


        return view('login/gantisandi', $data);
    }
}
