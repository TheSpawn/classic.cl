<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearCmsAlianza extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ali_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'sit_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'ali_nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'ali_descripcion' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'ali_logo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'ali_ubicacion' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
            ],
            'ali_fechas' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
            ],
            'ali_tipo' => [
                'type'       => 'ENUM',
                'constraint' => ['PRINCIPAL', 'SECUNDARIA'],
                'default'    => 'PRINCIPAL',
            ],
            'ali_orden' => [
                'type'    => 'INT',
                'default' => 0,
            ],
            'ali_activo' => [
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
        $this->forge->addKey('ali_id', true);
        $this->forge->addForeignKey('sit_id', 'cms_sitio', 'sit_id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('cms_alianza');
    }

    public function down()
    {
        $this->forge->dropTable('cms_alianza');
    }
}
