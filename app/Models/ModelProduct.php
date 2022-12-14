<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelProduct extends Model
{
    protected $table            = 'product';
    protected $primaryKey       = 'prodid';
    protected $allowedFields    = [
        'prodnama', 'prodtype', 'prodkat', 'prodbrand', 'proddeskripsi', 'prodharga', 'prodstock', 'prodgambar'
    ];

    public function cekProduct($id)
    {
        return $this->table('product')->getWhere([
            'sha1(prodid)' => $id
        ]);
    }

    public function search($keyword)
    {
        return $this->table('product')->like('prodnama', $keyword)->orLike('prodtype', $keyword)->orLike('proddeskripsi', $keyword);
    }

    public function searchlink($keywordlink)
    {
        return $this->table('product')->like('prodkat', $keywordlink);
    }

    public function searchbrand($keywordbranch)
    {
        return $this->table('product')->like('prodbrand', $keywordbranch);
    }



    public function cekProductFoto($fileGambarFoto)
    {
        return $this->table('product')->getWhere([
            'prodgambar' => $fileGambarFoto
        ]);
    }
}
