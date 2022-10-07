<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenjualan extends Model
{
    protected $table            = 'penjualan';
    protected $primaryKey       = 'penid';
    protected $allowedFields    = [
        'pennomor', 'pentanggal', 'penbrgid', 'penjml', 'pensubtotal', 'penuser'
    ];
}
