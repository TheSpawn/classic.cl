<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarVideoEvento extends Migration
{
    public function up()
    {
        $this->forge->addColumn('cms_evento', [
            'eve_video' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'eve_imagen',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('cms_evento', 'eve_video');
    }
}
