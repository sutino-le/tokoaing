<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBrand extends Model
{
    protected $table            = 'brand';
    protected $primaryKey       = 'brandid';
    protected $allowedFields    = ['brandnama', 'brandgambar'];

    public function cekBrand($brandid)
    {
        return $this->table('brand')->getWhere([
            'sha1(brandid)' => $brandid
        ]);
    }
}
