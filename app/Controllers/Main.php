<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelLevels;
use App\Models\ModelUsers;
use Config\Services;


class Main extends BaseController
{

    public function index()
    {
        $data = [
            'title'         => '',
            'menu'          => '',
            'submenu'       => '',
            'actmenu'       => '',
        ];
        return view('template/layout', $data);
    }
}
