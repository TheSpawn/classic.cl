<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarCaracteristicasPrecio extends Migration
{
    public function up()
    {
        $this->forge->addColumn('cms_precio', [
            'pre_caracteristicas' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'pre_fecha_fin',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('cms_precio', 'pre_caracteristicas');
    }
}
