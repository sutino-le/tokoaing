<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKeranjang extends Model
{
    protected $table            = 'keranjang';
    protected $primaryKey       = 'kerid';
    protected $allowedFields    = [
        'kertanggal', 'kerbrgid', 'kerjml', 'keruser'
    ];

    public function cekKeranjang($kerbrgid, $keruser)
    {
        return $this->table('keranjang')->getWhere([
            'kerbrgid' => $kerbrgid,
            'keruser' => $keruser
        ]);
    }

    function ambilTotalKeranjang($iduser)
    {
        $query = $this->table('keranjang')->getWhere([
            'keruser' => $iduser
        ]);

        $totalKeranjang = 0;
        foreach ($query->getResultArray() as $r) :
            $totalKeranjang += $r['kerjml'];
        endforeach;
        return $totalKeranjang;
    }



    public function cekBelanja($user)
    {
        return $this->table('users')->join('product', 'prodid=kerbrgid', 'left')->getWhere([
            'sha1(keruser)' => $user
        ]);
    }



    public function cekKeranjangDetail($kerbrgid, $keruser)
    {
        return $this->table('keranjang')->getWhere([
            'sha1(kerbrgid)' => $kerbrgid,
            'keruser' => $keruser
        ]);
    }
}
