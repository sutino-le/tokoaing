<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Branch extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'branchid' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'branchnama' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
        ]);
        $this->forge->addKey('branchid', true);
        $this->forge->createTable('branch');
    }

    public function down()
    {
        $this->forge->dropTable('branch');
    }
}
