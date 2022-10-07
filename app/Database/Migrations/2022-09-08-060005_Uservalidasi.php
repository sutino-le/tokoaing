<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Uservalidasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'userid' => [
                'type'           => 'VARCHAR',
                'constraint' => '50',
            ],
            'usernama' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'userpassword' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'userlevel' => [
                'type'       => 'INT',
                'constraint'     => 11,
            ],
            'userstatus' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
        ]);
        $this->forge->addKey('userid', true);
        $this->forge->createTable('uservalidasi');
    }

    public function down()
    {
        $this->forge->dropTable('uservalidasi');
    }
}
