<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Servis extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'serid' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'sernama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'seremail' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'sersubject' => [
                'type'       => 'VARCHAR',
                'constraint'     => '100',
            ],
            'serisi' => [
                'type'       => 'TEXT',
                'constraint' => '225',
            ],
            'serstatus' => [
                'type'       => 'VARCHAR',
                'constraint'     => '50',
            ],
        ]);
        $this->forge->addKey('serid', true);
        $this->forge->createTable('servis');
    }

    public function down()
    {
        $this->forge->dropTable('servis');
    }
}
