<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelServis extends Model
{
    protected $table            = 'servis';
    protected $primaryKey       = 'serid';
    protected $allowedFields    = [
        'sernama', 'seremail', 'serdate', 'sersubject', 'serisi', 'serstatus'
    ];
    protected $updatedField     = 'updated_at';




    public function tampilMessage($status)
    {
        return $this->table('servis')->getWhere([
            'serstatus' => $status
        ]);
    }
}
