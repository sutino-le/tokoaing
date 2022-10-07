<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
            'usergender' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
            ],
            'userlahir' => [
                'type'       => 'DATE',
            ],
            'useralamat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'userrt' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
            ],
            'userrw' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
            ],
            'useralamatid' => [
                'type'       => 'INT',
                'constraint'     => 11,
            ],
            'usertelp' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'userfoto' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'usernote' => [
                'type'       => 'TEXT',
            ],
        ]);
        $this->forge->addKey('userid', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
