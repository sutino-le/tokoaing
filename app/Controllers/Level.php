<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelLevels;
use App\Models\ModelLevelsPagination;
use Config\Services;

class Level extends BaseController
{
    public function __construct()
    {
        $this->modelLevel = new ModelLevels();
    }

    public function index()
    {
        $data = [
            'title'      => 'Data Level',
            'menu'      => 'master',
            'submenu'    => 'level',
            'actmenu'       => '',
            'tampildata'    => $this->modelLevel->findAll()
        ];
        return view('level/viewdata', $data);
    }

    public function listData()
    {
        $request = Services::request();
        $datamodel = new ModelLevelsPagination($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $tombolEdit = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"edit('" . $list->levelid . "')\" title=\"Edit\"><i class='fas fa-edit'></i></button>";
                $tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"hapus('" . $list->levelid . "')\" title=\"Hapus\"><i class='fas fa-trash-alt'></i></button>";

                if ($list->userlevel == "") {
                    $tomboleditlevel = $tombolEdit;
                    $tombolhapuslevel = $tombolHapus;
                } else {
                    $tomboleditlevel = "";
                    $tombolhapuslevel = "";
                }

                $row[] = $no;
                $row[] = $list->levelid;
                $row[] = $list->levelnama;
                $row[] = $tomboleditlevel . ' ' . $tombolhapuslevel;
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
        $json = [
            'data' => view('level/modaltambah')
        ];

        echo json_encode($json);
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $levelnama      = $this->request->getPost('levelnama');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'levelnama' => [
                    'rules'     => 'required',
                    'label'     => 'Level Nama',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ]
            ]);


            if (!$valid) {
                $json = [
                    'error' => [
                        'errLevelNama'      => $validation->getError('levelnama'),
                    ]
                ];
            } else {

                $this->modelLevel->insert([
                    'levelid'         => '',
                    'levelnama'         => $levelnama
                ]);

                $json = [
                    'sukses'        => 'Data berhasil disimpan'
                ];
            }


            echo json_encode($json);
        }
    }


    public function formedit($levelid)
    {

        $cekData        = $this->modelLevel->find($levelid);
        if ($cekData) {
            $data = [
                'levelid'        => $cekData['levelid'],
                'levelnama'         => $cekData['levelnama']
            ];

            $json = [
                'data' => view('level/modaledit', $data)
            ];
        }
        echo json_encode($json);
    }


    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $levelidlama     = $this->request->getPost('levelidlama');
            $levelnama      = $this->request->getPost('levelnama');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'levelnama' => [
                    'rules'     => 'required',
                    'label'     => 'Level Nama',
                    'errors'    => [
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ]
            ]);

            if (!$valid) {
                $json = [
                    'error' => [
                        'errLevelNama'      => $validation->getError('levelnama')
                    ]
                ];
            } else {

                $this->modelLevel->update($levelidlama, [
                    'levelnama'         => $levelnama,
                ]);

                $json = [
                    'sukses'        => 'Data berhasil dirubah'
                ];
            }


            echo json_encode($json);
        }
    }

    public function hapus($levelid)
    {
        $this->modelLevel->delete($levelid);

        $json = [
            'sukses' => 'Data berhasil dihapus'
        ];


        echo json_encode($json);
    }
}
