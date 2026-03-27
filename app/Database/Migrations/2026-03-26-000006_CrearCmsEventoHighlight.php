<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearCmsEventoHighlight extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'hig_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'eve_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'hig_texto' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'hig_orden' => [
                'type'    => 'INT',
                'default' => 0,
            ],
        ]);
        $this->forge->addKey('hig_id', true);
        $this->forge->addForeignKey('eve_id', 'cms_evento', 'eve_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('cms_evento_highlight');
    }

    public function down()
    {
        $this->forge->dropTable('cms_evento_highlight');
    }
}
