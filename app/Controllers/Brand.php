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

                $tombolEdit = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"edit('" . sha1($list->brandid) . "')\" title=\"Edit\"><i class='fas fa-edit'></i></button>";
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
            ],
        ])) {

            $validation = \Config\Services::validation();
            return redirect()->to('brand/formtambah')->withInput()->with('validation', $validation);
        } else {
            $brandnama = $this->request->getPost('brandnama');
            $brandgambar = $this->request->getFile('brandgambar');

            $modelBrand = new ModelBrand();

            // update Foto
            if ($brandgambar == "") {
                $fileGambarFoto = $brandgambar->getRandomName();
            } else {
                $fileGambarFoto = $brandgambar->getRandomName();

                $brandgambar->move('upload', $fileGambarFoto);
            }

            $modelBrand->insert([
                'brandid'         => '',
                'brandnama'         => $brandnama,
                'brandgambar'           => $fileGambarFoto,
            ]);

            return redirect()->to('brand/index');
        }
    }


    public function formedit($brandid)
    {

        $modelBrand = new ModelBrand();
        $cekData = $modelBrand->cekBrand($brandid)->getRowArray();

        $data = [
            'title'         => 'Data Brand',
            'menu'          => 'produk',
            'submenu'       => 'brand',
            'actmenu'       => '',
            'validation'    => \Config\Services::validation(),
            'brandid'       => $cekData['brandid'],
            'brandnama'     => $cekData['brandnama'],
            'brandgambar'   => $cekData['brandgambar'],
        ];
        return view('brand/editdata', $data);
    }


    public function updatedata()
    {


        if (!$this->validate([
            'brandnama'     => [
                'rules'         => 'required',
                'label'         => 'Brand',
                'errors'        => [
                    'required'      => '{field} tidak boleh kosong'
                ]
            ],
        ])) {

            $validation = \Config\Services::validation();
            return redirect()->to('brand/formtambah')->withInput()->with('validation', $validation);
        } else {
            $brandid = $this->request->getPost('brandid');
            $brandnama = $this->request->getPost('brandnama');
            $brandgambar = $this->request->getFile('brandgambar');

            // update Foto
            if ($brandgambar == "") {

                $modelBrand = new ModelBrand();

                $modelBrand->update($brandid, [
                    'brandnama'         => $brandnama,
                ]);
            } else {
                $fileGambarFoto = $brandgambar->getRandomName();

                $brandgambar->move('upload', $fileGambarFoto);

                $modelBrand = new ModelBrand();
                $cekBrand = $modelBrand->find($brandid);

                if ($cekBrand['brandgambar'] != NULL) {
                    unlink('upload/' . $cekBrand['brandgambar']);
                }

                $modelBrand->update(
                    $brandid,
                    [
                        'brandnama'         => $brandnama,
                        'brandgambar'           => $fileGambarFoto,
                    ]
                );
            }

            return redirect()->to('brand/index');
        }
    }

    public function hapus($brandid)
    {
        $modelBrand = new ModelBrand();
        $cekBrand = $modelBrand->find($brandid);

        if ($cekBrand['brandgambar'] != NULL) {
            unlink('upload/' . $cekBrand['brandgambar']);
        }

        $this->modelBrand->delete($brandid);

        $json = [
            'sukses' => 'Data berhasil dihapus'
        ];


        echo json_encode($json);
    }
}
