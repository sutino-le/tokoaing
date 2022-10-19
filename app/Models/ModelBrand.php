<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBrand extends Model
{
    protected $table            = 'brand';
    protected $primaryKey       = 'brandid';
    protected $allowedFields    = ['brandnama', 'brandgambar'];
}
