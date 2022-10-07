<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penjualan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'penid' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'pennomor' => [
                'type'       => 'CHAR',
                'constraint' => '50',
            ],
            'pentanggal' => [
                'type'       => 'DATE',
            ],
            'penbrgid' => [
                'type'       => 'INT',
                'constraint'     => 11,
            ],
            'penjml' => [
                'type'       => 'INT',
                'constraint'     => 11,
            ],
            'pensubtotal' => [
                'type'       => 'DOUBLE',
            ],
            'penuser' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
        ]);
        $this->forge->addKey('penid', true);
        $this->forge->createTable('penjualan');
    }

    public function down()
    {
        $this->forge->dropTable('penjualan');
    }
}
