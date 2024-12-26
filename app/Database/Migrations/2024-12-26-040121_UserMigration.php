<?php

namespace App\Database\Migrations;

class UserMigration extends \CodeIgniter\Database\Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 15,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                // 'null' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                // 'null' => true,
            ],
            'date_of_birth' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                // 'null' => true,
            ],
            'role' => [
                'type' => 'INT',
                // 'default' => 'agent',
                // 'null' => false
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
