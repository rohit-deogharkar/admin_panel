<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProcessMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'cid' => [
                'type' => 'INT',
                'constraint' => 15,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'campaign_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'campaign_description' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'supervisor_id' => [
                'type' => 'INT',
                'null' => false
            ]
        ]);
        $this->forge->addKey('cid', true);
        $this->forge->createTable('campaign');
    }

    public function down()
    {
        $this->forge->dropTable('campaign');
    }
}
