<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Productdetail extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'detid' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'detprodid' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'detprofoto' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('detid', true);
        $this->forge->createTable('productdetail');
    }

    public function down()
    {
        $this->forge->dropTable('productdetail');
    }
}
