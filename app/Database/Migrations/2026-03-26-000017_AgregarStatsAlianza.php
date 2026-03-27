<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarStatsAlianza extends Migration
{
    public function up()
    {
        $this->forge->addColumn('cms_alianza', [
            'ali_stats' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'ali_tipo',
            ],
            'ali_invitaciones' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'after' => 'ali_tipo',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('cms_alianza', ['ali_stats', 'ali_invitaciones']);
    }
}
