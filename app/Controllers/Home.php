<?php

namespace App\Controllers;

use App\Models\ModelBaner;
use App\Models\ModelBranch;
use App\Models\ModelKategori;
use App\Models\ModelKeranjang;
use App\Models\ModelLevels;
use App\Models\ModelPerusahaan;
use App\Models\ModelProduct;
use App\Models\ModelProductDetail;
use App\Models\ModelUsers;
use App\Models\ModelUserValidasi;
use Config\Services;

class Home extends BaseController
{
    public function __construct()
    {
        $this->email = \Config\Services::email();
    }

    // menampilkan halaman utaman
    public function index()
    {
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
            ];
        }

        return view('dashboard', $data);
    }

    // menampilkan data baner
    function tampilBaner()
    {
        if ($this->request->isAJAX()) {
            $modelBaner = new ModelBaner();
            $dataBaner = $modelBaner->findAll();



            $data = [
                'indikator' => $dataBaner,
                'tampildata' => $dataBaner,
                'tombolindikator' => $dataBaner,
            ];

            $json = [
                'data' => view('tampilbaner', $data)
            ];

            echo json_encode($json);
        } else {
            exit('Maaf, gagal menampilkan data');
        }
    }

    // menampilkan halaman katalog
    public function katalog()
    {
        $keyword = $this->request->getVar('keyword');
        $keywordlink = $this->request->getVar('keywordlink');
        $keywordbranch = $this->request->getVar('keywordbranch');

        // menampilkan data perusahaan
        $modelPerusahaan = new ModelPerusahaan();
        $rowPeru = $modelPerusahaan->find(1);

        // menampilkan branch
        $modelBranch = new ModelBranch();
        $cekBranch = $modelBranch->findAll();

        // menampilkan kategori
        $modelKategori = new ModelKategori();

        // menampilkan product
        $modelProduct = new ModelProduct();


        if ($keyword) {
            $product = $modelProduct->search($keyword);
        } else if ($keywordlink) {
            $product = $modelProduct->searchlink($keywordlink);
        } else if ($keywordbranch) {
            $product = $modelProduct->searchbranch($keywordbranch);
        } else {
            $product = $modelProduct;
        }

        $dataProduct = $product->paginate(8, 'product');


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
                'tampilkatalog'     => $dataProduct,
                'pager'             => $product->pager,
                'kategori'          => $modelKategori->findAll(),
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
                'tampilkatalog'     => 'Default',
                'pager'             => 'Default',
                'kategori'          => 'Default',
            ];
        }


        return view('katalog', $data);
    }


    // katalog detail
    public function katalogdetail($id)
    {


        $kerbrgid = $id;
        $keruser = session()->iduser;

        $modelKeranjang = new ModelKeranjang();
        $rowKeranjang = $modelKeranjang->cekKeranjangDetail($kerbrgid, $keruser)->getRowArray();


        // menampilkan data perusahaan
        $modelPerusahaan = new ModelPerusahaan();
        $rowPeru = $modelPerusahaan->find(1);

        $modelProduct = new ModelProduct();
        $rowProduct = $modelProduct->cekProduct($id)->getRowArray();

        $modelProductDetail = new ModelProductDetail();

        $modelBranch = new ModelBranch();
        $rowBranch = $modelBranch->find($rowProduct['prodbranch']);


        $cekBranch = $modelBranch->findAll();




        if ($rowPeru > 0) {
            $data = [
                'peruid'                => $rowPeru['peruid'],
                'perunama'              => $rowPeru['perunama'],
                'perualamat'            => $rowPeru['perualamat'],
                'perualamatlink'        => $rowPeru['perualamatlink'],
                'peruwa'                => $rowPeru['peruwa'],
                'perutelp'              => $rowPeru['perutelp'],
                'perufax'               => $rowPeru['perufax'],
                'peruemail'             => $rowPeru['peruemail'],
                'peruicon'              => $rowPeru['peruicon'],
                'perufoto'              => $rowPeru['perufoto'],
                'databranch'            => $cekBranch,
                'prodid'                => $rowProduct['prodid'],
                'prodnama'              => $rowProduct['prodnama'],
                'prodtype'              => $rowProduct['prodtype'],
                'prodkat'               => $rowProduct['prodkat'],
                'prodbranch'            => $rowProduct['prodbranch'],
                'proddeskripsi'         => $rowProduct['proddeskripsi'],
                'prodharga'             => $rowProduct['prodharga'],
                'prodstock'             => $rowProduct['prodstock'],
                'prodgambar'            => $rowProduct['prodgambar'],
                'productDetail'         => $modelProductDetail->productDetail($rowProduct['prodid']),
                'branchnama'            => $rowBranch['branchnama'],
                'tampildatakeranjang'   => $rowKeranjang,
            ];
        } else {
            $data = [
                'peruid'                => 'Default',
                'perunama'              => 'Default',
                'perualamat'            => 'Default',
                'perualamatlink'        => 'Default',
                'peruwa'                => 'Default',
                'perutelp'              => 'Default',
                'perufax'               => 'Default',
                'peruemail'             => 'Default',
                'peruicon'              => '',
                'perufoto'              => 'Default',
                'databranch'            => 'Default',
                'prodid'                => 'Default',
                'prodnama'              => 'Default',
                'prodtype'              => 'Default',
                'prodkat'               => 'Default',
                'prodbranch'            => 'Default',
                'proddeskripsi'         => 'Default',
                'prodharga'             => 'Default',
                'prodstock'             => 'Default',
                'prodgambar'            => 'Default',
                'productDetail'         => 'Default',
                'branchnama'            => '',
                'tampildatakeranjang' => 'default',
            ];
        }

        return view('katalogdetail', $data);
    }

    // tentang kami
    public function about()
    {
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
            ];
        }

        return view('about', $data);
    }

    // hubungi kami
    public function contact()
    {
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
            ];
        }

        return view('contact', $data);
    }

    // modal tambah keranjang
    function modalTambahKeranjang()
    {
        if ($this->request->isAJAX()) {
            $kerbrgid = $this->request->getvar('id');
            $keruser = $this->request->getvar('iduser');

            $modelProduct = new ModelProduct();
            $dataProduct = $modelProduct->find($kerbrgid);

            $modelKeranjang = new ModelKeranjang();
            $rowKeranjang = $modelKeranjang->cekKeranjang($kerbrgid, $keruser)->getRowArray();



            $data = [
                'tampilproduct' => $dataProduct,
                'tampildatakeranjang' => $rowKeranjang
            ];

            $json = [
                'data' => view('modaltambahkeranjang', $data)
            ];

            echo json_encode($json);
        } else {
            exit('Maaf, gagal menampilkan data');
        }
    }

    // simpan keranjang
    function simpanKeranjang()
    {
        if ($this->request->isAJAX()) {
            $kertanggal = $this->request->getPost('kertanggal');
            $kerbrgid = $this->request->getPost('kerbrgid');
            $kerjml = $this->request->getPost('kerjml');
            $keruser = $this->request->getPost('keruser');

            $modelProduct = new ModelProduct();
            $rowProduct = $modelProduct->find($kerbrgid);


            $modelKeranjang = new ModelKeranjang();
            $cekKeranjang = $modelKeranjang->cekKeranjang($kerbrgid, $keruser)->getRowArray();


            if ($cekKeranjang > 0) {

                $kerid = $cekKeranjang['kerid'];


                if ($kerjml > $cekKeranjang['kerjml']) {
                    $jmlbaru = $cekKeranjang['kerjml'] + $kerjml;
                } else {
                    $jmlbaru = $kerjml;
                }


                if ($jmlbaru > $rowProduct['prodstock']) {
                    $totaljumlah = $rowProduct['prodstock'];
                } else {
                    $totaljumlah = $jmlbaru;
                }

                $modelKeranjang->update($kerid, [
                    'kertanggal'     => $kertanggal,
                    'kerbrgid'    => $kerbrgid,
                    'kerjml' => $totaljumlah,
                    'keruser'  => $keruser,
                ]);
            } else {
                $modelKeranjang->insert([
                    'kertanggal'     => $kertanggal,
                    'kerbrgid'    => $kerbrgid,
                    'kerjml' => $kerjml,
                    'keruser'  => $keruser,
                ]);
            }

            $json = [
                'sukses' => 'Produk berhasil ditambahkan ke Keranjang...'
            ];

            echo json_encode($json);
        }
    }

    // ambil total keranjang
    function ambilTotalKeranjang()
    {
        if ($this->request->isAJAX()) {
            $iduser = $this->request->getPost('iduser');

            $modelKeranjang = new ModelKeranjang();

            $totalKeranjang = $modelKeranjang->ambilTotalKeranjang($iduser);

            $json = [
                'totalkeranjang' => $totalKeranjang
            ];

            echo json_encode($json);
        }
    }


    // menampilkan halaman keranjang
    public function keranjang($user)
    {
        // menampilkan data perusahaan
        $modelPerusahaan = new ModelPerusahaan();
        $rowPeru = $modelPerusahaan->find(1);

        // menampilkan branch
        $modelBranch = new ModelBranch();
        $cekBranch = $modelBranch->findAll();

        // menampilakan user
        $modelUser = new ModelUsers();
        $rowUser = $modelUser->cekUser($user);


        // menampilakan keranjang
        $modelKeranjang = new ModelKeranjang();
        $rowKeranjang = $modelKeranjang->cekBelanja($user);



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
                'datauser'          => $rowUser,
                'datakeranjang'     => $rowKeranjang,
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
                'datauser'          => 'Default',
                'datakeranjang'     => 'Default',
            ];
        }

        return view('keranjang', $data);
    }

    //menghapus item keranjang
    public function hapusItemKeranjang($kerid)
    {
        if ($this->request->isAJAX()) {
            $modelKeranjang = new ModelKeranjang();
            $modelKeranjang->where(['sha1(kerid)' => $kerid]);
            $modelKeranjang->delete();


            $json = [
                'sukses'        => 'Item berhasil dihapus',
            ];

            echo json_encode($json);
        }
    }

    //menghapus semua keranjang
    public function hapusSemuaKeranjang($iduser)
    {
        if ($this->request->isAJAX()) {
            $modelKeranjang = new ModelKeranjang();
            $modelKeranjang->where(['sha1(keruser)' => $iduser]);
            $modelKeranjang->delete();


            $json = [
                'sukses'        => 'Item berhasil dikosongkan',
            ];

            echo json_encode($json);
        }
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
                } else {

                    $passwordUser = $cekUser['userpassword'];
                    if (sha1($password) == $passwordUser) {
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

            echo json_encode($json);
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

    // daftar
    public function daftarUser()
    {
        if ($this->request->isAJAX()) {
            $userid      = $this->request->getPost('userid');
            $usernama      = $this->request->getPost('usernama');
            $userpassword      = $this->request->getPost('userpassword');
            $userlevel      = $this->request->getPost('userlevel');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'userid' => [
                    'rules'     => 'required|valid_email',
                    'label'     => 'User ID',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong',
                        'valid_email' => '{field} harus berupa email',
                    ]
                ],
                'usernama' => [
                    'rules'     => 'required',
                    'label'     => 'Nama User',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ],
                'userpassword' => [
                    'rules'     => 'required',
                    'label'     => 'Kata Sandi',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ]
            ]);

            if (!$valid) {
                $json = [
                    'error' => [
                        'errUserID'         => $validation->getError('userid'),
                        'errUserNama'       => $validation->getError('usernama'),
                        'errUserPassword'   => $validation->getError('userpassword'),
                    ]
                ];
            } else {
                $modelUserValidasi = new ModelUserValidasi();

                $cekUser = $modelUserValidasi->find($userid);

                if ($cekUser > 0) {
                    $json = [
                        'error' => [
                            'errUserID'         => 'Email sudah terdaftar...',
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

            $isiemail = "<h1>HI " . $usernama . " ...</h1><p>Selamat! Kamu sebentar lagi akan mengikat alamat email ini dengan akun TokoAing kamu.<br><br>Kamu bisa klik tautan dibawah ini untuk memverifikasi alamat email ini: <br>
                        http://192.168.1.99/toko-online/public/home/verifikasi/" . $useranda . "</p>";


            $email = service('email');
            $email->setTo($userid);
            $email->setFrom('sutino.skom@gmail.com', 'Sutino');

            $email->setSubject('Verifikasi Akun');

            $email->setMessage($isiemail);


            if ($email->send()) {
                $json = [
                    'berhasil'        => 'Verifikasi berhasil dikirimkan ke email Anda, silahkan verifikasi email...'
                ];
            } else {
                $json = [
                    'gagal'        => 'Gagal mengirimkan verifikasi'
                ];
            }

            echo json_encode($json);
        }
    }



    // verifikasi email
    public function verifikasi($id)
    {
        $modelUserValidasi = new ModelUserValidasi();
        $rowUserValidasi = $modelUserValidasi->cekUser($id)->getRowArray();

        if ($rowUserValidasi > 0) {
            $userid = $rowUserValidasi['valuserid'];
            $usernama = $rowUserValidasi['valusernama'];
            $userpassword = $rowUserValidasi['valuserpassword'];
            $userlevel = $rowUserValidasi['valuserlevel'];
            $userstatus = 'Terverifikasi';

            $modelUpdateUser = new ModelUserValidasi();
            $modelUpdateUser->update($userid, [
                'valuserstatus' => $userstatus
            ]);

            if ($modelUpdateUser) {
                $modelUser = new ModelUsers();
                $modelUser->insert([
                    'userid'        => $userid,
                    'usernama'      => $usernama,
                    'userpassword'  => $userpassword,
                    'userlevel'     => $userlevel,
                    'usergender'     => '',
                    'userlahir'     => '',
                    'userlahir'     => '',
                    'userrt'     => '',
                    'userrw'     => '',
                    'useralamatid'     => '',
                    'usertelp'     => '',
                    'userfoto'     => '',
                    'usermap'     => '',
                ]);

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
                    ];
                }

                return view('dashboard', $data);
            }
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

                if ($cekUser['valuserstatus'] == "Progress") {
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
                        http://192.168.1.99/toko-online/public/home/ubahsandi/" . $useranda . "</p>";


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


        return view('gantisandi', $data);
    }

    // proses ubah sandi
    public function prosesubahsandi()
    {
        if ($this->request->isAJAX()) {
            $userid = $this->request->getPost('userid');
            $userpassword = $this->request->getPost('userpassword');
            $ulangpassword = $this->request->getPost('ulangpassword');

            $validation = \Config\Services::validation();



            $valid = $this->validate([
                'userpassword'    => [
                    'label'     => 'Sandi',
                    'rules'     => 'required',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ],
                'ulangpassword'    => [
                    'label'     => 'Konfirmasi Sandi',
                    'rules'     => 'required',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ]
            ]);

            if (!$valid) {
                $json = [
                    'error' => [
                        'errUserPassword'     => $validation->getError('userpassword'),
                        'errUserUlangPassword'   => $validation->getError('ulangpassword'),
                    ]
                ];
            } else if ($userpassword != $ulangpassword) {
                $json = [
                    'error' => [
                        'errUserUlangPassword'   => 'Sandi tidak sama',
                    ]
                ];
            } else {
                $modelUser  = new ModelUsers();

                $modelUser->update($userid, [
                    'userpassword' => sha1($userpassword)
                ]);

                $json = [
                    'sukses' => 'Anda berhasil merubah sandi Anda...'
                ];
            }

            echo json_encode($json);
        }
    }






    // 
    public function sendEmail()
    {
        $this->email->setFrom('sutino.skom@gmail.com', 'Sutino');
        $this->email->setTo('pujia808@gmail.com');

        $this->email->setSubject('Pengingat PP');

        $this->email->setMessage('<h1>Ka Puput</h1><p>jangan lupa PP yang di pak ratno</p>');

        if (!$this->email->send()) {
            return false;
        } else {
            return true;
        }
    }
}
