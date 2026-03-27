<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearCmsPrecio extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pre_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'sit_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'pre_nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'pre_monto' => [
                'type' => 'INT',
            ],
            'pre_moneda' => [
                'type'       => 'VARCHAR',
                'constraint' => 3,
                'default'    => 'CLP',
            ],
            'pre_fecha_inicio' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'pre_fecha_fin' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'pre_activo' => [
                'type'    => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('pre_id', true);
        $this->forge->addForeignKey('sit_id', 'cms_sitio', 'sit_id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('cms_precio');
    }

    public function down()
    {
        $this->forge->dropTable('cms_precio');
    }
}
