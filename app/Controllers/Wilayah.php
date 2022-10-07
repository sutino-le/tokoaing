<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelWilayah;
use App\Models\ModelWilayahPagination;
use Config\Services;

class Wilayah extends BaseController
{
    public function index()
    {
        //
    }

    public function modalData()
    {
        if ($this->request->isAJAX()) {
            $json = [
                'data' => view('wilayah/modaldatawilayah')
            ];

            echo json_encode($json);
        } else {
            exit('Maaf, gagal menampilkan data');
        }
    }


    public function listDataModal()
    {
        $request = Services::request();
        $datamodel = new ModelWilayahPagination($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                if ($list->id_wilayah == 0) {
                    $id_wilayah = "";
                } else {
                    $id_wilayah = $list->id_wilayah;
                }

                $tombolPilih = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"pilih('" . $id_wilayah . "', '" . $list->kelurahan . "', '" . $list->kecamatan . "', '" . $list->kota_kabupaten . "', '" . $list->propinsi . "', '" . $list->kodepos . "')\" title=\"Pilih\"><i class='fas fa-hand-point-up'></i></button>";

                $row[] = $no;
                $row[] = $list->kelurahan;
                $row[] = $list->kecamatan;
                $row[] = $list->kota_kabupaten;
                $row[] = $list->propinsi;
                $row[] = $list->kodepos;
                $row[] = $tombolPilih;
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
