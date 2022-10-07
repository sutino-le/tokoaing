<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelProductDetail extends Model
{
    protected $table            = 'productdetail';
    protected $primaryKey       = 'detid';
    protected $allowedFields    = ['detprodid', 'detprofoto'];

    public function productDetail($id)
    {
        return $this->table('productdetail')->where('detprodid', $id)->get();
    }
}
