<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelProduct;
use App\Models\ModelProductPagination;
use config\Services;


class Product extends BaseController
{

    public function __construct()
    {
        $this->modelProduct = new ModelProduct();
        helper('form');
    }


    public function index()
    {
        $data = [
            'title'      => 'Data Product',
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
                $tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"hapus('" . $list->prodid . "')\" title=\"Hapus\"><i class='fas fa-trash-alt'></i></button>";

                $row[] = $no;
                $row[] = $list->prodnama;
                $row[] = $list->prodtype;
                $row[] = $list->katnama;
                $row[] = $list->brandnama;
                $row[] = $list->prodharga;
                $row[] = $list->prodstock;
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
