<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AccessLevelsMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'lid' => [
                'type' => 'INT',
                'constraint' => 15,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'level_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ]
            
        ]);
        $this->forge->addKey('lid', true);
        $this->forge->createTable('access_level');
    }

    public function down()
    {
        $this->forge->dropTable('access_level');
    }
}
