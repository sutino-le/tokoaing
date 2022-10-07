<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Baner extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'banerid' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'banernama' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'banerjudul' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'banersubjudul' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'banerdeskripsi' => [
                'type'       => 'TEXT',
            ],
            'banerfoto' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'banerbackground' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'banerclass' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
        ]);
        $this->forge->addKey('banerid', true);
        $this->forge->createTable('baner');
    }

    public function down()
    {
        $this->forge->dropTable('baner');
    }
}
