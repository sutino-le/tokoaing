<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Perusahaan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'peruid' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'perunama' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'perualamat' => [
                'type'       => 'text',
            ],
            'perualamatlink' => [
                'type'       => 'text',
            ],
            'perutelp' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'peruwa' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'perufax' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'peruemail' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'peruicon' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'perufoto' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
        ]);
        $this->forge->addKey('peruid', true);
        $this->forge->createTable('perusahaan');
    }

    public function down()
    {
        $this->forge->dropTable('perusahaan');
    }
}
