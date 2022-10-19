<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBrand;
use App\Models\ModelBrandPagination;
use config\Services;

class Brand extends BaseController
{

    public function __construct()
    {
        $this->modelBrand = new ModelBrand();
        helper('form');
    }


    public function index()
    {
        $data = [
            'title'      => 'Data Brand',
            'menu'      => 'produk',
            'submenu'    => 'brand',
            'actmenu'       => '',
            'tampildata'    => $this->modelBrand->findAll()
        ];
        return view('brand/viewdata', $data);
    }



    public function listData()
    {
        $request = Services::request();
        $datamodel = new ModelBrandPagination($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $tombolEdit = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"edit('" . $list->brandid . "')\" title=\"Edit\"><i class='fas fa-edit'></i></button>";
                $tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"hapus('" . $list->brandid . "')\" title=\"Hapus\"><i class='fas fa-trash-alt'></i></button>";

                if ($list->prodbrand == "") {
                    $tomboleditbrand = $tombolEdit;
                    $tombolhapusbrand = $tombolHapus;
                } else {
                    $tomboleditbrand = "";
                    $tombolhapusbrand = "";
                }

                $row[] = $no;
                $row[] = $list->brandid;
                $row[] = $list->brandnama;
                $row[] = $list->brandgambar;
                $row[] = $tomboleditbrand . ' ' . $tombolhapusbrand;
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
        $data = [
            'title'         => 'Data Brand',
            'menu'          => 'produk',
            'submenu'       => 'brand',
            'actmenu'       => '',
            'validation'    => \Config\Services::validation(),
            'tampildata'    => $this->modelBrand->findAll()
        ];
        return view('brand/tambahdata', $data);
    }

    public function simpan()
    {

        if (!$this->validate([
            'brandnama'     => [
                'rules'         => 'required',
                'label'         => 'Brand',
                'errors'        => [
                    'required'      => '{field} tidak boleh kosong'
                ]
            ]
        ]));


        $validation = \Config\Services::validation();
        return redirect()->to('brand/formtambah')->withInput()->with('validation', $validation);


        // if (!$valid) {
        //     $json = [
        //         'error' => [
        //             'errBrandNama'      => $validation->getError('brandnama'),
        //         ]
        //     ];
        // } else {

        //     $modelBrand = new ModelBrand();

        //     // update Foto
        //     if ($brandgambar == "") {
        //         // jika kosong
        //     } else {
        //         $fileGambarFoto = $brandgambar->getRandomName();

        //         $brandgambar->move('upload', $fileGambarFoto);
        //     }

        //     $this->modelBrand->insert([
        //         'brandid'         => '',
        //         'brandnama'         => $brandnama,
        //         'brandgambar'           => $fileGambarFoto,
        //     ]);
    }


    public function formedit($brandid)
    {

        $cekData        = $this->modelbrand->find($brandid);
        if ($cekData) {
            $data = [
                'brandid'        => $cekData['brandid'],
                'brandnama'         => $cekData['brandnama']
            ];

            $json = [
                'data' => view('brand/modaledit', $data)
            ];
        }
        echo json_encode($json);
    }


    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $brandidlama     = $this->request->getPost('brandidlama');
            $brandnama      = $this->request->getPost('brandnama');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'brandnama' => [
                    'rules'     => 'required',
                    'label'     => 'Brand',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ]
            ]);

            if (!$valid) {
                $json = [
                    'error' => [
                        'errBrandNama'      => $validation->getError('brandnama')
                    ]
                ];
            } else {

                $this->modelBrand->update($brandidlama, [
                    'brandnama'         => $brandnama,
                ]);

                $json = [
                    'sukses'        => 'Data berhasil dirubah'
                ];
            }


            echo json_encode($json);
        }
    }

    public function hapus($brandid)
    {
        $this->modelBrand->delete($brandid);

        $json = [
            'sukses' => 'Data berhasil dihapus'
        ];


        echo json_encode($json);
    }
}
