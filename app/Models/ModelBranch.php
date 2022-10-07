<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBranch extends Model
{
    protected $table            = 'branch';
    protected $primaryKey       = 'branchid';
    protected $allowedFields    = ['branchnama'];
}
