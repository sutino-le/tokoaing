<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelLevels;
use App\Models\ModelUsers;
use App\Models\ModelUsersPagination;
use App\Models\ModelUserValidasi;
use Config\Services;

class User extends BaseController
{
    public function __construct()
    {
        $this->modelUser            = new ModelUsers();
        $this->modelUserValidasi    = new ModelUserValidasi();
    }

    public function index()
    {
        $data = [
            'title'      => 'User Data',
            'menu'      => 'master',
            'submenu'    => 'user',
            'actmenu'       => '',
            'tampildata'    => $this->modelUser->findAll()
        ];
        return view('user/viewdata', $data);
    }



    public function listData()
    {
        $request = Services::request();
        $datamodel = new ModelUsersPagination($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $tombolEdit = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"edit('" . $list->valuserid . "')\" title=\"Edit\"><i class='fas fa-edit'></i></button>";
                $tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"hapus('" . $list->valuserid . "')\" title=\"Delete\"><i class='fas fa-trash-alt'></i></button>";

                if ($list->valuserstatus == "Progress") {
                    $tombolEditUser = "";
                    $tombolHapusUser = "";
                } else if ($list->valuserid == session()->iduser) {
                    $tombolEditUser = "";
                    $tombolHapusUser = "";
                } else {
                    $tombolHapusUser = $tombolHapus;
                    $tombolEditUser = $tombolEdit;
                }

                $row[] = $no;
                $row[] = $list->valuserid;
                $row[] = $list->valusernama;
                $row[] = $list->levelnama;
                $row[] = $list->valuserstatus;
                $row[] = $tombolEditUser . " " . $tombolHapusUser;
                $data[] = $row;
            }
            $output = [
                "draw" => $request->getPost('draw'),
                "recordsTotal" => $datamodel->count_all(),
                "recordsFiltered" => $datamodel->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }

    public function formtambah()
    {
        $modelLevel = new ModelLevels();
        $data = [
            'datalevel' => $modelLevel->findAll()
        ];

        $json = [
            'data' => view('user/modaltambah', $data)
        ];

        echo json_encode($json);
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $userid         = $this->request->getPost('userid');
            $usernama       = $this->request->getPost('usernama');
            $userpassword   = $this->request->getPost('userpassword');
            $userlevel      = $this->request->getPost('userlevel');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'userid' => [
                    'rules'     => 'required',
                    'label'     => 'User ID',
                    'errors'    => [
                        'required'  => '{field} can not be empty'
                    ]
                ],
                'usernama' => [
                    'rules'     => 'required',
                    'label'     => 'Username',
                    'errors'    => [
                        'required'  => '{field} can not be empty'
                    ]
                ],
                'userpassword' => [
                    'rules'     => 'required',
                    'label'     => 'Password',
                    'errors'    => [
                        'required'  => '{field} can not be empty'
                    ]
                ],
                'userlevel' => [
                    'rules'     => 'required',
                    'label'     => 'Level',
                    'errors'    => [
                        'required'  => '{field} can not be empty'
                    ]
                ]
            ]);


            if (!$valid) {
                $json = [
                    'error' => [
                        'errUserId'         => $validation->getError('userid'),
                        'errUserNama'       => $validation->getError('usernama'),
                        'errUserPassword'   => $validation->getError('userpassword'),
                        'errUserLevel'      => $validation->getError('userlevel'),
                    ]
                ];
            } else {
                $modelUserValidasi = new ModelUserValidasi();

                $cekUser = $modelUserValidasi->find($userid);

                if ($cekUser > 0) {
                    $json = [
                        'error' => [
                            'errUserId'         => 'Email already registered...',
                        ]
                    ];
                } else {
                    $inputUserValidasi = new ModelUserValidasi();
                    $inputUserValidasi->insert([
                        'valuserid'            => $userid,
                        'valusernama'          => $usernama,
                        'valuserpassword'      => sha1($userpassword),
                        'valuserlevel'         => $userlevel,
                        'valuserstatus'        => 'Progress',
                    ]);

                    $data = [
                        'userid'        => $userid,
                        'usernama'      => $usernama
                    ];

                    $json = [
                        'sukses' => $data
                    ];
                }
            }


            echo json_encode($json);
        }
    }

    // untuk verifikasi akun
    public function kirimverifikasi()
    {
        if ($this->request->isAJAX()) {

            $userid      = $this->request->getPost('userid');
            $usernama      = $this->request->getPost('usernama');

            $useranda = sha1($userid);

            $isiemail = "<h1>HI " . $usernama . " ...</h1><p>Congratulations! You will soon be binding this email address with your TokoAing account.<br><br>You can click the link below to verify this email address: <br>
                        http://192.168.1.99/toko-online/public/home/verifikasi/" . $useranda . "</p>";


            $email = service('email');
            $email->setTo($userid);
            $email->setFrom('sutino.skom@gmail.com', 'Sutino');

            $email->setSubject('Account Verification');

            $email->setMessage($isiemail);


            if ($email->send()) {
                $json = [
                    'berhasil'        => 'Verification was successfully sent to your email, please verify your email...'
                ];
            } else {
                $json = [
                    'gagal'        => 'Failed to send verification'
                ];
            }

            echo json_encode($json);
        }
    }


    public function formedit($userid)
    {

        $modelLevel = new ModelLevels();
        $modelUser = new ModelUsers();
        $cekData        = $modelUser->find($userid);
        if ($cekData) {
            $data = [
                'userid'        => $cekData['userid'],
                'usernama'      => $cekData['usernama'],
                'userlevel'     => $cekData['userlevel'],
                'datalevel'     => $modelLevel->findAll()
            ];

            $json = [
                'data' => view('user/modaledit', $data)
            ];
        }
        echo json_encode($json);
    }


    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $useridlama     = $this->request->getPost('useridlama');
            $userlevel      = $this->request->getPost('userlevel');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'userlevel' => [
                    'rules'     => 'required',
                    'label'     => 'Level',
                    'errors'    => [
                        'required'  => '{field} can not be empty'
                    ]
                ]
            ]);

            if (!$valid) {
                $json = [
                    'error' => [
                        'errUserLevel'      => $validation->getError('userlevel')
                    ]
                ];
            } else {

                // update tabel user
                $modelUser = new ModelUsers();
                $modelUser->update($useridlama, [
                    'userlevel'         => $userlevel,
                ]);

                // update tabel user validasi
                $modelUserValidasi = new ModelUserValidasi();
                $modelUserValidasi->update($useridlama, [
                    'valuserlevel'         => $userlevel,
                ]);

                $json = [
                    'sukses'        => 'Data changed successfully...'
                ];
            }


            echo json_encode($json);
        }
    }


    public function hapus($userid)
    {
        $this->modelUser->delete($userid);
        $this->modelUserValidasi->delete($userid);

        $json = [
            'sukses' => 'Data deleted successfully...'
        ];


        echo json_encode($json);
    }
}
