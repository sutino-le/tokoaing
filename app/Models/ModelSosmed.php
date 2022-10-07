<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSosmed extends Model
{
    protected $table            = 'sosmed';
    protected $primaryKey       = 'sosmedid';
    protected $allowedFields    = [
        'sosmedlink', 'sosmedicon', 'sosmedperuid'
    ];
}
