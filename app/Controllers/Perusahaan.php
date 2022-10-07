<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPerusahaan;
use Config\Services;

class Perusahaan extends BaseController
{

    public function __construct()
    {
        helper('form');
    }


    public function index()
    {
        $modelPerusahaan = new ModelPerusahaan();

        $data = [
            'title'         => 'Data Perusahaan',
            'menu'          => 'master',
            'submenu'       => 'perusahaan',
            'actmenu'       => '',
            'tampildata'    => $modelPerusahaan->find(1)
        ];

        return view('perusahaan/viewdata', $data);
    }


    public function formedit($peruid)
    {
        $modelPerusahaan = new ModelPerusahaan();
        $cekData        = $modelPerusahaan->find($peruid);
        if ($cekData) {
            $data = [
                'peruid'            => $cekData['peruid'],
                'perunama'          => $cekData['perunama'],
                'perualamat'        => $cekData['perualamat'],
                'perualamatlink'    => $cekData['perualamatlink'],
                'peruwa'            => $cekData['peruwa'],
                'perutelp'          => $cekData['perutelp'],
                'perufax'           => $cekData['perufax'],
                'peruemail'         => $cekData['peruemail'],
                'peruicon'          => $cekData['peruicon'],
                'perufoto'          => $cekData['perufoto'],
            ];

            $json = [
                'data' => view('perusahaan/modaledit', $data)
            ];
        }
        echo json_encode($json);
    }

    public function updateperusahaan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'perunama' => [
                    'rules'     => 'required',
                    'label'     => 'Nama Perusahaan',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ],
                'perualamat' => [
                    'rules'     => 'required',
                    'label'     => 'Alamat Perusahaan',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ],
                'perutelp' => [
                    'rules'     => 'required',
                    'label'     => 'Telp Perusahaan',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ],
                'peruwa' => [
                    'rules'     => 'required',
                    'label'     => 'WhatsApp Perusahaan',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ],
                'peruemail' => [
                    'rules'     => 'required',
                    'label'     => 'Email Perusahaan',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ],
            ]);

            if (!$valid) {
                $json = [
                    'error' => [
                        'errPeruNama'        => $validation->getError('perunama'),
                        'errPeruAlamat'      => $validation->getError('perualamat'),
                        'errPeruTelp'        => $validation->getError('perutelp'),
                        'errPeruWa'          => $validation->getError('peruwa'),
                        'errPeruEmail'       => $validation->getError('peruemail'),
                    ]
                ];
            } else {


                $peruidlama             = $this->request->getVar('peruidlama');
                $perunama               = $this->request->getVar('perunama');
                $perualamat             = $this->request->getVar('perualamat');
                $perualamatlink         = $this->request->getVar('perualamatlink');
                $perutelp               = $this->request->getVar('perutelp');
                $peruwa                 = $this->request->getVar('peruwa');
                $perufax                = $this->request->getVar('perufax');
                $peruemail              = $this->request->getVar('peruemail');

                $modelPerusahaan = new ModelPerusahaan();

                $modelPerusahaan->update($peruidlama, [
                    'perunama'          => $perunama,
                    'perualamat'        => $perualamat,
                    'perualamatlink'    => $perualamatlink,
                    'perutelp'          => $perutelp,
                    'peruwa'            => $peruwa,
                    'perufax'           => $perufax,
                    'peruemail'         => $peruemail,
                ]);


                // $peruicon               = $this->request->getFile('peruicon');
                // $perufoto               = $this->request->getFile('perufoto');


                // $modelPerusahaanGambar = new ModelPerusahaan();
                // $cekGambar = $modelPerusahaanGambar->find($peruidlama);

                // $iconLama = $cekGambar['peruicon'];
                // $fotoLama = $cekGambar['perufoto'];

                // if ($iconLama != NULL) {
                //     unlink('upload/' . $iconLama);
                // }

                // if ($fotoLama != NULL) {
                //     unlink('upload/' . $fotoLama);
                // }

                // $fileIconGambar = $peruicon->getRandomName();
                // $fileFotoGambar = $perufoto->getRandomName();

                // $peruicon->move('upload', $fileIconGambar);
                // $perufoto->move('upload', $fileFotoGambar);


                // $modelPerusahaan->update($peruidlama, [
                //     'peruicon'           => $fileIconGambar,
                //     'perufoto'           => $fileFotoGambar,
                // ]);



                $json = [
                    'sukses'        => 'Data berhasil disimpan'
                ];
            }

            echo json_encode($json);
        }
    }

    public function formeditgambar($peruid)
    {
        $modelPerusahaan = new ModelPerusahaan();
        $cekData        = $modelPerusahaan->find($peruid);
        if ($cekData) {
            $data = [
                'peruid'            => $cekData['peruid'],
                'perunama'          => $cekData['perunama'],
                'perualamat'        => $cekData['perualamat'],
                'perualamatlink'    => $cekData['perualamatlink'],
                'peruwa'            => $cekData['peruwa'],
                'perutelp'          => $cekData['perutelp'],
                'perufax'           => $cekData['perufax'],
                'peruemail'         => $cekData['peruemail'],
                'peruicon'          => $cekData['peruicon'],
                'perufoto'          => $cekData['perufoto'],
            ];

            $json = [
                'data' => view('perusahaan/modaledit', $data)
            ];
        }
        echo json_encode($json);
    }


    public function updategambar()
    {
        $peruidlama          = $this->request->getVar('peruidlama');
        $peruicon         = $this->request->getFile('peruicon');
        $perufoto         = $this->request->getFile('perufoto');


        $modelPerusahaan = new ModelPerusahaan();

        $cekGambar = $modelPerusahaan->find($peruidlama);

        $fotoLamaIcon = $cekGambar['peruicon'];
        $fotoLamaFoto = $cekGambar['perufoto'];

        // update Icon
        if ($peruicon == "") {
            // jika kosong
        } else {
            $fileGambarIcon = $peruicon->getRandomName();

            $peruicon->move('upload', $fileGambarIcon);


            $modelPerusahaan->update($peruidlama, [
                'peruicon'           => $fileGambarIcon,
            ]);

            if ($modelPerusahaan) {

                if ($fotoLamaIcon != NULL) {
                    unlink('upload/' . $fotoLamaIcon);
                }
            }
        }


        // update Foto
        if ($perufoto == "") {
            // jika kosong
        } else {
            $fileGambarFoto = $perufoto->getRandomName();

            $perufoto->move('upload', $fileGambarFoto);


            $modelPerusahaan->update($peruidlama, [
                'perufoto'           => $fileGambarFoto,
            ]);

            if ($modelPerusahaan) {
                if ($fotoLamaFoto != NULL) {
                    unlink('upload/' . $fotoLamaFoto);
                }
            }
        }


        $data = [
            'title'         => 'Data Perusahaan',
            'menu'          => 'master',
            'submenu'       => 'perusahaan',
            'actmenu'       => '',
            'tampildata'    => $modelPerusahaan->find($peruidlama)
        ];

        return view('perusahaan/viewdata', $data);
    }
}
