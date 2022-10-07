<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Product extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'prodid' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'prodnama' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'prodtype' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'prodkat' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'prodbranch' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'proddeskripsi' => [
                'type'       => 'TEXT',
            ],
            'prodharga' => [
                'type'       => 'DOUBLE',
            ],
            'prodstock' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'prodgambar' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('prodid', true);
        $this->forge->createTable('product');
    }

    public function down()
    {
        $this->forge->dropTable('product');
    }
}
