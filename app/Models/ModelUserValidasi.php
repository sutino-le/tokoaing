<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUserValidasi extends Model
{
    protected $table            = 'uservalidasi';
    protected $primaryKey       = 'valuserid';
    protected $allowedFields    = [
        'valuserid', 'valusernama', 'valuserpassword', 'valuserlevel', 'valuserstatus'
    ];

    public function cekUser($id)
    {
        return $this->table('uservalidasi')->getWhere([
            'sha1(valuserid)' => $id
        ]);
    }
}
