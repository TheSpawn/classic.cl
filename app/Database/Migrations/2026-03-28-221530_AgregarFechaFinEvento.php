<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarFechaFinEvento extends Migration
{
    public function up()
    {
        $this->forge->addColumn('cms_evento', [
            'eve_fecha_fin' => [
                'type'  => 'DATE',
                'null'  => true,
                'after' => 'eve_fecha',
            ],
            'eve_hora_fin' => [
                'type'       => 'TIME',
                'null'       => true,
                'after'      => 'eve_hora',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('cms_evento', ['eve_fecha_fin', 'eve_hora_fin']);
    }
}
