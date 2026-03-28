<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarVendeEntradasEvento extends Migration
{
    public function up()
    {
        $this->forge->addColumn('cms_evento', [
            'eve_vende_entradas' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
                'null'       => false,
                'after'      => 'eve_video',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('cms_evento', 'eve_vende_entradas');
    }
}
