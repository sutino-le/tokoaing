<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBrand;
use App\Models\ModelKategori;
use App\Models\ModelProduct;
use App\Models\ModelProductDetail;
use App\Models\ModelProductDetailPagination;
use App\Models\ModelProductPagination;
use config\Services;


class Product extends BaseController
{

    public function __construct()
    {
        $this->modelBrand = new ModelBrand();
        $this->modelKategori = new ModelKategori();
        $this->modelProduct = new ModelProduct();
        helper('form');
    }


    public function index()
    {
        $data = [
            'title'      => 'Product Data',
            'menu'      => 'produk',
            'submenu'    => 'product',
            'actmenu'       => '',
            'tampildata'    => $this->modelProduct->findAll()
        ];
        return view('product/viewdata', $data);
    }



    public function listData()
    {
        $request = Services::request();
        $datamodel = new ModelProductPagination($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $tombolEdit = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"edit('" . sha1($list->prodid) . "')\" title=\"Edit\"><i class='fas fa-edit'></i></button>";
                $tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"hapus('" . $list->prodid . "')\" title=\"Delete\"><i class='fas fa-trash-alt'></i></button>";
                $tambahDetail = "<button type=\"button\" class=\"btn btn-sm btn-primary\" onclick=\"tambahdetail('" . $list->prodid . "')\" title=\"Add Details Image\"><i class='fas fa-plus'></i></button>";

                $id = $list->prodid;

                $modelDetail = new ModelProductDetail();
                $cekRow = $modelDetail->hitungJumlahRow($id)->getNumRows();

                $row[] = $no;
                $row[] = $list->prodnama;
                $row[] = $list->prodtype;
                $row[] = $list->katnama;
                $row[] = $list->brandnama;
                $row[] = $list->prodharga;
                $row[] = $list->prodstock;
                $row[] = $tombolEdit . ' ' . $tombolHapus . ' ' . $tambahDetail;
                $row[] = $cekRow;
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

    public function hapus($prodid)
    {
        $modelProduct = new ModelProduct();
        $cekprod = $modelProduct->find($prodid);

        if ($cekprod['prodgambar'] != NULL) {
            unlink('upload/' . $cekprod['prodgambar']);
        }

        $this->modelProduct->delete($prodid);

        $json = [
            'sukses' => 'Data deleted successfully...'
        ];


        echo json_encode($json);
    }

    public function formtambah()
    {
        $data = [
            'title'             => 'Product Data',
            'menu'              => 'produk',
            'submenu'           => 'product',
            'actmenu'           => '',
            'validation'        => \Config\Services::validation(),
            'tampildata'        => $this->modelProduct->findAll(),
            'tampilbrand'       => $this->modelBrand->findAll(),
            'tampilkategori'    => $this->modelKategori->findAll()
        ];
        return view('product/tambahdata', $data);
    }

    public function simpan()
    {

        if (!$this->validate([
            'prodnama'     => [
                'rules'         => 'required',
                'label'         => 'Product',
                'errors'        => [
                    'required'      => '{field} can not be empty'
                ]
            ],
            'prodtype'     => [
                'rules'         => 'required',
                'label'         => 'Type',
                'errors'        => [
                    'required'      => '{field} can not be empty'
                ]
            ],
            'prodkat'     => [
                'rules'         => 'required',
                'label'         => 'Category',
                'errors'        => [
                    'required'      => '{field} can not be empty'
                ]
            ],
            'prodbrand'     => [
                'rules'         => 'required',
                'label'         => 'Brand',
                'errors'        => [
                    'required'      => '{field} can not be empty'
                ]
            ],
            'proddeskripsi'     => [
                'rules'         => 'required',
                'label'         => 'Description',
                'errors'        => [
                    'required'      => '{field} can not be empty'
                ]
            ],
            'prodharga'     => [
                'rules'         => 'required',
                'label'         => 'Price',
                'errors'        => [
                    'required'      => '{field} can not be empty'
                ]
            ],
            'prodstock'     => [
                'rules'         => 'required',
                'label'         => 'Stock',
                'errors'        => [
                    'required'      => '{field} can not be empty'
                ]
            ],
        ])) {

            $validation = \Config\Services::validation();
            return redirect()->to('product/formtambah')->withInput()->with('validation', $validation);
        } else {
            $prodnama       = $this->request->getPost('prodnama');
            $prodtype       = $this->request->getPost('prodtype');
            $prodkat        = $this->request->getPost('prodkat');
            $prodbrand      = $this->request->getPost('prodbrand');
            $proddeskripsi  = $this->request->getPost('proddeskripsi');
            $prodharga      = $this->request->getPost('prodharga');
            $prodstock      = $this->request->getPost('prodstock');
            $prodgambar     = $this->request->getFile('prodgambar');

            $modelProduct = new ModelProduct();

            // update Foto
            if ($prodgambar == "") {
                $fileGambarFoto = $prodgambar->getRandomName();
            } else {
                $fileGambarFoto = $prodgambar->getRandomName();

                $prodgambar->move('upload', $fileGambarFoto);
            }

            $modelProduct->insert([
                'brandid'           => '',
                'prodnama'          => $prodnama,
                'prodtype'          => $prodtype,
                'prodkat'           => $prodkat,
                'prodbrand'         => $prodbrand,
                'proddeskripsi'     => $proddeskripsi,
                'prodharga'         => $prodharga,
                'prodstock'         => $prodstock,
                'prodgambar'        => $fileGambarFoto,
            ]);

            return redirect()->to('product/index');
        }
    }


    public function formedit($prodid)
    {

        $modelProduct = new ModelProduct();
        $cekData = $modelProduct->cekProduct($prodid)->getRowArray();

        $data = [
            'title'             => 'Product Data',
            'menu'              => 'produk',
            'submenu'           => 'product',
            'actmenu'           => '',
            'validation'        => \Config\Services::validation(),
            'prodid'            => $cekData['prodid'],
            'prodnama'          => $cekData['prodnama'],
            'prodtype'          => $cekData['prodtype'],
            'prodkat'           => $cekData['prodkat'],
            'prodbrand'         => $cekData['prodbrand'],
            'proddeskripsi'     => $cekData['proddeskripsi'],
            'prodharga'         => $cekData['prodharga'],
            'prodstock'         => $cekData['prodstock'],
            'prodgambar'        => $cekData['prodgambar'],
            'tampilbrand'       => $this->modelBrand->findAll(),
            'tampilkategori'    => $this->modelKategori->findAll()
        ];
        return view('product/editdata', $data);
    }

    public function update()
    {

        if (!$this->validate([
            'prodnama'     => [
                'rules'         => 'required',
                'label'         => 'Product',
                'errors'        => [
                    'required'      => '{field} can not be empty'
                ]
            ],
            'prodtype'     => [
                'rules'         => 'required',
                'label'         => 'Type',
                'errors'        => [
                    'required'      => '{field} can not be empty'
                ]
            ],
            'prodkat'     => [
                'rules'         => 'required',
                'label'         => 'Category',
                'errors'        => [
                    'required'      => '{field} can not be empty'
                ]
            ],
            'prodbrand'     => [
                'rules'         => 'required',
                'label'         => 'Brand',
                'errors'        => [
                    'required'      => '{field} can not be empty'
                ]
            ],
            'proddeskripsi'     => [
                'rules'         => 'required',
                'label'         => 'Description',
                'errors'        => [
                    'required'      => '{field} can not be empty'
                ]
            ],
            'prodharga'     => [
                'rules'         => 'required',
                'label'         => 'Price',
                'errors'        => [
                    'required'      => '{field} can not be empty'
                ]
            ],
            'prodstock'     => [
                'rules'         => 'required',
                'label'         => 'Stock',
                'errors'        => [
                    'required'      => '{field} can not be empty'
                ]
            ],
        ])) {

            $validation = \Config\Services::validation();
            return redirect()->to('product/formtambah')->withInput()->with('validation', $validation);
        } else {
            $prodid         = $this->request->getPost('prodid');
            $prodnama       = $this->request->getPost('prodnama');
            $prodtype       = $this->request->getPost('prodtype');
            $prodkat        = $this->request->getPost('prodkat');
            $prodbrand      = $this->request->getPost('prodbrand');
            $proddeskripsi  = $this->request->getPost('proddeskripsi');
            $prodharga      = $this->request->getPost('prodharga');
            $prodstock      = $this->request->getPost('prodstock');
            $prodgambar     = $this->request->getFile('prodgambar');

            $modelProduct = new ModelProduct();

            $cekProLama = $modelProduct->find($prodid);

            // update Foto
            if ($prodgambar == "") {
                $modelProduct->update($prodid, [
                    'prodnama'          => $prodnama,
                    'prodtype'          => $prodtype,
                    'prodkat'           => $prodkat,
                    'prodbrand'         => $prodbrand,
                    'proddeskripsi'     => $proddeskripsi,
                    'prodharga'         => $prodharga,
                    'prodstock'         => $prodstock,
                ]);
            } else {

                $fileGambarFoto = $prodgambar->getRandomName();

                $prodgambar->move('upload', $fileGambarFoto);


                $modelProduct->update($prodid, [
                    'prodnama'          => $prodnama,
                    'prodtype'          => $prodtype,
                    'prodkat'           => $prodkat,
                    'prodbrand'         => $prodbrand,
                    'proddeskripsi'     => $proddeskripsi,
                    'prodharga'         => $prodharga,
                    'prodstock'         => $prodstock,
                    'prodgambar'        => $fileGambarFoto,
                ]);



                unlink('upload/' . $cekProLama['brandgambar']);
            }



            return redirect()->to('product/index');
        }
    }

    public function detail()
    {
        $data = [
            'title'         => 'Product Data',
            'menu'          => 'produk',
            'submenu'       => 'productdet',
            'actmenu'       => '',
            'tampildata'    => $this->modelProduct->findAll()
        ];
        return view('product/detail', $data);
    }



    public function listDetail()
    {
        $request = Services::request();
        $datamodel = new ModelProductDetailPagination($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $tombolEdit = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"edit('" . sha1($list->detid) . "')\" title=\"Edit\"><i class='fas fa-edit'></i></button>";
                $tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"hapus('" . $list->detid . "')\" title=\"Delete\"><i class='fas fa-trash-alt'></i></button>";



                $row[] = $no;
                $row[] = $list->prodnama;
                $row[] = $list->detprofoto;
                $row[] = $tombolEdit . ' ' . $tombolHapus;
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
}
