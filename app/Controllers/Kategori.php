<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKategori;

class Kategori extends BaseController
{

    public function __construct()
    {
        $this->modelKategori = new ModelKategori();
    }


    public function index()
    {
        $data = [
            'title'      => 'Data Kategori',
            'menu'      => 'produk',
            'submenu'    => 'kategori',
            'actmenu'       => '',
            'tampildata'    => $this->modelKategori->findAll()
        ];
        return view('kategori/viewdata', $data);
    }
}
