<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearCmsEventoMeta extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'met_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'eve_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'met_icono' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'met_texto' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'met_orden' => [
                'type'    => 'INT',
                'default' => 0,
            ],
        ]);
        $this->forge->addKey('met_id', true);
        $this->forge->addForeignKey('eve_id', 'cms_evento', 'eve_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('cms_evento_meta');
    }

    public function down()
    {
        $this->forge->dropTable('cms_evento_meta');
    }
}
