<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBranch;
use App\Models\ModelPerusahaan;
use App\Models\ModelUsers;
use App\Models\ModelWilayah;
use Config\Services;

class Profil extends BaseController
{

    public function __construct()
    {
        helper('form');
    }



    public function index($user)
    {
        $modelUser = new ModelUsers();
        $rowUser = $modelUser->cekUser($user)->getRowArray();

        // menampilkan data perusahaan
        $modelPerusahaan = new ModelPerusahaan();
        $rowPeru = $modelPerusahaan->find(1);

        // menampilkan branch
        $modelBranch = new ModelBranch();
        $cekBranch = $modelBranch->findAll();

        if ($rowPeru > 0) {
            $data = [
                'peruid'            => $rowPeru['peruid'],
                'perunama'          => $rowPeru['perunama'],
                'perualamat'        => $rowPeru['perualamat'],
                'perualamatlink'    => $rowPeru['perualamatlink'],
                'peruwa'            => $rowPeru['peruwa'],
                'perutelp'          => $rowPeru['perutelp'],
                'perufax'           => $rowPeru['perufax'],
                'peruemail'         => $rowPeru['peruemail'],
                'peruicon'          => $rowPeru['peruicon'],
                'perufoto'          => $rowPeru['perufoto'],
                'databranch'        => $cekBranch,

                'userid'            => $rowUser['userid'],
                'usernama'          => $rowUser['usernama'],
                'userpassword'      => $rowUser['userpassword'],
                'userlevel'         => $rowUser['userlevel'],
                'usergender'        => $rowUser['usergender'],
                'userlahir'         => $rowUser['userlahir'],
                'useralamat'        => $rowUser['useralamat'],
                'userrt'            => $rowUser['userrt'],
                'userrw'            => $rowUser['userrw'],
                'useralamatid'      => $rowUser['useralamatid'],
                'propinsi'          => $rowUser['propinsi'],
                'kota_kabupaten'    => $rowUser['kota_kabupaten'],
                'kecamatan'         => $rowUser['kecamatan'],
                'kelurahan'         => $rowUser['kelurahan'],
                'kodepos'           => $rowUser['kodepos'],
                'usertelp'          => $rowUser['usertelp'],
                'userfoto'          => $rowUser['userfoto'],
                'usernote'           => $rowUser['usernote'],

            ];
        } else {
            $data = [
                'peruid'            => 'Default',
                'perunama'          => 'Default',
                'perualamat'        => 'Default',
                'perualamatlink'    => 'Default',
                'peruwa'            => 'Default',
                'perutelp'          => 'Default',
                'perufax'           => 'Default',
                'peruemail'         => 'Default',
                'peruicon'          => '',
                'perufoto'          => 'Default',
                'databranch'        => 'Default',

                'userid'            => 'Default',
                'usernama'          => 'Default',
                'userpassword'      => 'Default',
                'userlevel'         => 'Default',
                'usergender'        => 'Default',
                'userlahir'         => 'Default',
                'useralamat'        => 'Default',
                'userrt'            => 'Default',
                'userrw'            => 'Default',
                'useralamatid'      => 'Default',
                'propinsi'          => 'Default',
                'kota_kabupaten'    => 'Default',
                'kecamatan'         => 'Default',
                'kelurahan'         => 'Default',
                'kodepos'           => 'Default',
                'usertelp'          => 'Default',
                'userfoto'          => 'Default',
                'usernote'           => 'Default',
            ];
        }

        return view('profil/lihat', $data);
    }


    public function editprofil($user)
    {
        $modelUser = new ModelUsers();
        $rowUser = $modelUser->cekUser($user)->getRowArray();

        // menampilkan data perusahaan
        $modelPerusahaan = new ModelPerusahaan();
        $rowPeru = $modelPerusahaan->find(1);

        // menampilkan branch
        $modelBranch = new ModelBranch();
        $cekBranch = $modelBranch->findAll();

        if ($rowUser['useralamatid'] == 0) {
            $id_wilayah = "";
        } else {
            $id_wilayah = $rowUser['useralamatid'];
        }

        if ($rowPeru > 0) {
            $data = [
                'peruid'            => $rowPeru['peruid'],
                'perunama'          => $rowPeru['perunama'],
                'perualamat'        => $rowPeru['perualamat'],
                'perualamatlink'    => $rowPeru['perualamatlink'],
                'peruwa'            => $rowPeru['peruwa'],
                'perutelp'          => $rowPeru['perutelp'],
                'perufax'           => $rowPeru['perufax'],
                'peruemail'         => $rowPeru['peruemail'],
                'peruicon'          => $rowPeru['peruicon'],
                'perufoto'          => $rowPeru['perufoto'],
                'databranch'        => $cekBranch,

                'userid'            => $rowUser['userid'],
                'usernama'          => $rowUser['usernama'],
                'userpassword'      => $rowUser['userpassword'],
                'userlevel'         => $rowUser['userlevel'],
                'usergender'        => $rowUser['usergender'],
                'userlahir'         => $rowUser['userlahir'],
                'useralamat'        => $rowUser['useralamat'],
                'userrt'            => $rowUser['userrt'],
                'userrw'            => $rowUser['userrw'],
                'useralamatid'      => $id_wilayah,
                'propinsi'          => $rowUser['propinsi'],
                'kota_kabupaten'    => $rowUser['kota_kabupaten'],
                'kecamatan'         => $rowUser['kecamatan'],
                'kelurahan'         => $rowUser['kelurahan'],
                'kodepos'           => $rowUser['kodepos'],
                'usertelp'          => $rowUser['usertelp'],
                'userfoto'          => $rowUser['userfoto'],
                'usernote'           => $rowUser['usernote'],

            ];
        } else {
            $data = [
                'peruid'            => 'Default',
                'perunama'          => 'Default',
                'perualamat'        => 'Default',
                'perualamatlink'    => 'Default',
                'peruwa'            => 'Default',
                'perutelp'          => 'Default',
                'perufax'           => 'Default',
                'peruemail'         => 'Default',
                'peruicon'          => '',
                'perufoto'          => 'Default',
                'databranch'        => 'Default',

                'userid'            => 'Default',
                'usernama'          => 'Default',
                'userpassword'      => 'Default',
                'userlevel'         => 'Default',
                'usergender'        => 'Default',
                'userlahir'         => 'Default',
                'useralamat'        => 'Default',
                'userrt'            => 'Default',
                'userrw'            => 'Default',
                'useralamatid'      => 'Default',
                'propinsi'          => 'Default',
                'kota_kabupaten'    => 'Default',
                'kecamatan'         => 'Default',
                'kelurahan'         => 'Default',
                'kodepos'           => 'Default',
                'usertelp'          => 'Default',
                'userfoto'          => 'Default',
                'usernote'           => 'Default',
            ];
        }

        return view('profil/editprofil', $data);
    }

    public function simpanfoto()
    {
        $userid          = $this->request->getVar('userid');
        $userfoto         = $this->request->getFile('userfoto');


        $modelUser = new ModelUsers();

        $cekGambar = $modelUser->find($userid);

        $fotoLama = $cekGambar['userfoto'];

        if ($fotoLama != NULL) {
            unlink('upload/' . $fotoLama);
        }

        $fileGambar = $userfoto->getRandomName();

        $userfoto->move('upload', $fileGambar);


        $modelUser->update($userid, [
            'userfoto'           => $fileGambar,
        ]);


        $user = sha1($userid);

        if ($modelUser) {
            $modelUser = new ModelUsers();
            $rowUser = $modelUser->cekUser($user)->getRowArray();

            // menampilkan data perusahaan
            $modelPerusahaan = new ModelPerusahaan();
            $rowPeru = $modelPerusahaan->find(1);

            // menampilkan branch
            $modelBranch = new ModelBranch();
            $cekBranch = $modelBranch->findAll();

            if ($rowPeru > 0) {
                $data = [
                    'peruid'            => $rowPeru['peruid'],
                    'perunama'          => $rowPeru['perunama'],
                    'perualamat'        => $rowPeru['perualamat'],
                    'perualamatlink'    => $rowPeru['perualamatlink'],
                    'peruwa'            => $rowPeru['peruwa'],
                    'perutelp'          => $rowPeru['perutelp'],
                    'perufax'           => $rowPeru['perufax'],
                    'peruemail'         => $rowPeru['peruemail'],
                    'peruicon'          => $rowPeru['peruicon'],
                    'perufoto'          => $rowPeru['perufoto'],
                    'databranch'        => $cekBranch,

                    'userid'            => $rowUser['userid'],
                    'usernama'          => $rowUser['usernama'],
                    'userpassword'      => $rowUser['userpassword'],
                    'userlevel'         => $rowUser['userlevel'],
                    'usergender'        => $rowUser['usergender'],
                    'userlahir'         => $rowUser['userlahir'],
                    'useralamat'        => $rowUser['useralamat'],
                    'userrt'            => $rowUser['userrt'],
                    'userrw'            => $rowUser['userrw'],
                    'useralamatid'      => $rowUser['useralamatid'],
                    'propinsi'          => $rowUser['propinsi'],
                    'kota_kabupaten'    => $rowUser['kota_kabupaten'],
                    'kecamatan'         => $rowUser['kecamatan'],
                    'kelurahan'         => $rowUser['kelurahan'],
                    'kodepos'           => $rowUser['kodepos'],
                    'usertelp'          => $rowUser['usertelp'],
                    'userfoto'          => $rowUser['userfoto'],
                    'usernote'           => $rowUser['usernote'],

                ];
            } else {
                $data = [
                    'peruid'            => 'Default',
                    'perunama'          => 'Default',
                    'perualamat'        => 'Default',
                    'perualamatlink'    => 'Default',
                    'peruwa'            => 'Default',
                    'perutelp'          => 'Default',
                    'perufax'           => 'Default',
                    'peruemail'         => 'Default',
                    'peruicon'          => '',
                    'perufoto'          => 'Default',
                    'databranch'        => 'Default',

                    'userid'            => 'Default',
                    'usernama'          => 'Default',
                    'userpassword'      => 'Default',
                    'userlevel'         => 'Default',
                    'usergender'        => 'Default',
                    'userlahir'         => 'Default',
                    'useralamat'        => 'Default',
                    'userrt'            => 'Default',
                    'userrw'            => 'Default',
                    'useralamatid'      => 'Default',
                    'propinsi'          => 'Default',
                    'kota_kabupaten'    => 'Default',
                    'kecamatan'         => 'Default',
                    'kelurahan'         => 'Default',
                    'kodepos'           => 'Default',
                    'usertelp'          => 'Default',
                    'userfoto'          => 'Default',
                    'usernote'           => 'Default',
                ];
            }
        }
        return view('profil/lihat', $data);
    }

    public function simpanprofil()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'usernama' => [
                    'rules'     => 'required',
                    'label'     => 'Nama Lengkap',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ],
                'usergender' => [
                    'rules'     => 'required',
                    'label'     => 'Jenis Kelamin',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ],
                'userlahir' => [
                    'rules'     => 'required',
                    'label'     => 'Tanggal Lahir',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ],
                'useralamatid' => [
                    'rules'     => 'required',
                    'label'     => 'Wilayah',
                    'errors'    => [
                        'required'  => '{field} harus dipilih'
                    ]
                ],
                'useralamat' => [
                    'rules'     => 'required',
                    'label'     => 'Alamat',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ],
                'userrt' => [
                    'rules'     => 'required',
                    'label'     => 'RT',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ],
                'userrw' => [
                    'rules'     => 'required',
                    'label'     => 'RW',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ],
                'usertelp' => [
                    'rules'     => 'required',
                    'label'     => 'RW',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ],
            ]);

            if (!$valid) {
                $json = [
                    'error' => [
                        'errUserNama'           => $validation->getError('usernama'),
                        'errUserGender'         => $validation->getError('usergender'),
                        'errUserLahir'          => $validation->getError('userlahir'),
                        'errUserAlamatId'       => $validation->getError('useralamatid'),
                        'errUserAlamat'         => $validation->getError('useralamat'),
                        'errUserRt'             => $validation->getError('userrt'),
                        'errUserRw'             => $validation->getError('userrw'),
                        'errUserTelp'           => $validation->getError('usertelp'),
                    ]
                ];
            } else {


                $userid          = $this->request->getVar('userid');
                $userfoto        = $this->request->getFile('userfoto');
                $usernama        = $this->request->getVar('usernama');
                $usergender      = $this->request->getVar('usergender');
                $userlahir       = $this->request->getVar('userlahir');
                $useralamatid    = $this->request->getVar('useralamatid');
                $useralamat      = $this->request->getVar('useralamat');
                $userrt          = $this->request->getVar('userrt');
                $userrw          = $this->request->getVar('userrw');
                $usertelp        = $this->request->getVar('usertelp');
                $usernote        = $this->request->getVar('usernote');

                $modelUser = new ModelUsers();

                $modelUser->update($userid, [
                    'usernama'      => $usernama,
                    'usergender'    => $usergender,
                    'userlahir'     => $userlahir,
                    'useralamat'    => $useralamat,
                    'userrt'        => $userrt,
                    'userrw'        => $userrw,
                    'useralamatid'  => $useralamatid,
                    'usertelp'      => $usertelp,
                    'usernote'      => $usernote,
                ]);

                $json = [
                    'sukses'        => 'Data berhasil disimpan'
                ];
            }

            echo json_encode($json);
        }
    }
}
