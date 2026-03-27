<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearCmsEvento extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'eve_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'sit_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'eve_titulo' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'eve_slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'eve_fecha' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'eve_hora' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'eve_ubicacion' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
            ],
            'eve_venue' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
            ],
            'eve_estado' => [
                'type'       => 'ENUM',
                'constraint' => ['PRONTO', 'ABIERTO', 'CERRADO'],
                'default'    => 'PRONTO',
            ],
            'eve_precio' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'eve_descripcion_corta' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'eve_descripcion' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'eve_icono' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'eve_imagen' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'eve_orden' => [
                'type'    => 'INT',
                'default' => 0,
            ],
            'eve_activo' => [
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
        $this->forge->addKey('eve_id', true);
        $this->forge->addUniqueKey('eve_slug');
        $this->forge->addForeignKey('sit_id', 'cms_sitio', 'sit_id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('cms_evento');
    }

    public function down()
    {
        $this->forge->dropTable('cms_evento');
    }
}
