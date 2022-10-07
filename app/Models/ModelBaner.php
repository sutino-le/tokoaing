<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBaner extends Model
{
    protected $table            = 'baner';
    protected $primaryKey       = 'banerid';
    protected $allowedFields    = [
        'banernama', 'banerjudul', 'banersubjudul', 'banerdeskripsi', 'banerfoto', 'banerbackground', 'banerclass'
    ];

    public function tampilDataBaner($tanggal)
    {
        return $this->table('baner')->where('banerakhir >=', $tanggal)->where('banerawal <=', $tanggal)->get();
    }
}
