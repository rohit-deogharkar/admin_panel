<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProcessMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pid' => [
                'type' => 'INT',
                'constraint' => 15,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'process_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'team_leader_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'team_leader_id' => [
                'type' => 'INT',
                'null' => false
            ]
        ]);
        $this->forge->addKey('pid', true);
        $this->forge->createTable('process');
    }

    public function down()
    {
        $this->forge->dropTable('process');
    }
}
