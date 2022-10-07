<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class FilterUser implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->userlevel == '') {
            return redirect()->to('/home/index');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (session()->userlevel == 2) {
            return redirect()->to('/home/index');
        }
    }
}
