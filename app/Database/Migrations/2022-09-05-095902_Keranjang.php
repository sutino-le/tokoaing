<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Keranjang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kerid' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kertanggal' => [
                'type'       => 'DATE',
            ],
            'kerbrgid' => [
                'type'       => 'INT',
                'constraint'     => 11,
            ],
            'kerjml' => [
                'type'       => 'INT',
                'constraint'     => 11,
            ],
            'keruser' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
        ]);
        $this->forge->addKey('kerid', true);
        $this->forge->createTable('keranjang');
    }

    public function down()
    {
        $this->forge->dropTable('keranjang');
    }
}
