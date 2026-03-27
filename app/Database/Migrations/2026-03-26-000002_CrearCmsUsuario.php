<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearCmsUsuario extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'usu_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'usu_nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'usu_apellido' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'usu_email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'usu_password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'usu_rol' => [
                'type'       => 'ENUM',
                'constraint' => ['SUPERADMIN', 'ADMIN', 'EDITOR'],
                'default'    => 'EDITOR',
            ],
            'usu_activo' => [
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
        $this->forge->addKey('usu_id', true);
        $this->forge->addUniqueKey('usu_email');
        $this->forge->createTable('cms_usuario');
    }

    public function down()
    {
        $this->forge->dropTable('cms_usuario');
    }
}
