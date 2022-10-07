<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Levels extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'levelid' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'levelnama' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
        ]);
        $this->forge->addKey('levelid', true);
        $this->forge->createTable('levels');
    }

    public function down()
    {
        $this->forge->dropTable('levels');
    }
}
