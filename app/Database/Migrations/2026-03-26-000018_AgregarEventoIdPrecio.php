<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarEventoIdPrecio extends Migration
{
    public function up()
    {
        $this->forge->addColumn('cms_precio', [
            'eve_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
                'after'    => 'sit_id',
            ],
        ]);

        $this->db->query('ALTER TABLE cms_precio ADD CONSTRAINT fk_precio_evento FOREIGN KEY (eve_id) REFERENCES cms_evento(eve_id) ON DELETE SET NULL');
    }

    public function down()
    {
        $this->db->query('ALTER TABLE cms_precio DROP FOREIGN KEY fk_precio_evento');
        $this->forge->dropColumn('cms_precio', 'eve_id');
    }
}
