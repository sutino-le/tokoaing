<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sosmed extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'sosmedid' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'sosmedlink' => [
                'type'       => 'TEXT',
            ],
            'sosmedicon' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'sosmedperuid' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
        ]);
        $this->forge->addKey('sosmedid', true);
        $this->forge->createTable('sosmed');
    }

    public function down()
    {
        $this->forge->dropTable('sosmed');
    }
}
