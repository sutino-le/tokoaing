<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUsers extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'userid';
    protected $allowedFields    = [
        'userid', 'usernama', 'userpassword', 'userlevel', 'usergender', 'userlahir', 'useralamat', 'userrt', 'userrw', 'useralamatid', 'usertelp', 'userfoto', 'usernote'
    ];

    public function cekUser($user)
    {
        return $this->table('users')->join('wilayah', 'id_wilayah=useralamatid', 'left')->getWhere([
            'sha1(userid)' => $user
        ]);
    }
}
