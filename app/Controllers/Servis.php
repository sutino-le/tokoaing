<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBaner;
use App\Models\ModelServis;
use App\Models\ModelServisPagination;
use Config\Services;

class Servis extends BaseController
{
    public function __construct()
    {
        $this->modelServis = new ModelServis();
    }

    public function index()
    {
        $data = [
            'title'         => 'Message Data',
            'menu'          => 'servis',
            'submenu'       => 'message',
            'actmenu'       => '',
            'tampildata'    => $this->modelServis->findAll()
        ];
        return view('servis/viewdata', $data);
    }

    public function listData()
    {
        $request = Services::request();
        $datamodel = new ModelServisPagination($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $tombolEdit = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"edit('" . $list->serid . "')\" title=\"Edit\"><i class='fas fa-edit'></i></button>";
                $tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"hapus('" . $list->serid . "')\" title=\"Delete\"><i class='fas fa-trash-alt'></i></button>";


                $row[] = $no;
                $row[] = $list->seremail;
                $row[] = date('d-M-Y', strtotime($list->serdate)) . ' ' . date('H:i:s', strtotime($list->serdate));
                $row[] = $list->sersubject;
                $row[] = substr($list->serisi, 0, 50) . ' ...';
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



    // menampilkan data baner
    function tampilMessage()
    {
        if ($this->request->isAJAX()) {
            $modelServis = new ModelServis();
            $dataServis = $modelServis->findAll();



            $data = [
                'tampildata' => $dataServis,
            ];

            $json = [
                'data' => view('servis/tampilmessage', $data)
            ];

            echo json_encode($json);
        } else {
            exit('Maaf, gagal menampilkan data');
        }
    }
}
