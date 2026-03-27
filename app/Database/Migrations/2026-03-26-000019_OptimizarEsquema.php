<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OptimizarEsquema extends Migration
{
    public function up()
    {
        // 1. Eliminar eve_precio de cms_evento (precios se gestionan en cms_precio)
        $this->forge->dropColumn('cms_evento', 'eve_precio');

        // 2. Índice compuesto en cms_contenido para consultas por sección
        $this->db->query('CREATE INDEX idx_contenido_sitio_seccion ON cms_contenido (sit_id, con_seccion)');

        // 3. Índice en cms_evento para consultas frecuentes por sitio + activo
        $this->db->query('CREATE INDEX idx_evento_sitio_activo ON cms_evento (sit_id, eve_activo, eve_orden)');

        // 4. Índice en cms_alianza para consultas por sitio + tipo
        $this->db->query('CREATE INDEX idx_alianza_sitio_tipo ON cms_alianza (sit_id, ali_tipo, ali_orden)');

        // 5. Índice en cms_documento para consultas por sitio + categoría
        $this->db->query('CREATE INDEX idx_documento_sitio_cat ON cms_documento (sit_id, doc_categoria, doc_orden)');

        // 6. Índice en cms_hito para consultas por sitio + orden
        $this->db->query('CREATE INDEX idx_hito_sitio_orden ON cms_hito (sit_id, hit_orden)');

        // 7. Índice en cms_precio para consultas por evento
        $this->db->query('CREATE INDEX idx_precio_evento ON cms_precio (eve_id, pre_activo, pre_fecha_inicio)');
    }

    public function down()
    {
        $this->forge->addColumn('cms_evento', [
            'eve_precio' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'after'      => 'eve_estado',
            ],
        ]);

        $this->db->query('DROP INDEX idx_contenido_sitio_seccion ON cms_contenido');
        $this->db->query('DROP INDEX idx_evento_sitio_activo ON cms_evento');
        $this->db->query('DROP INDEX idx_alianza_sitio_tipo ON cms_alianza');
        $this->db->query('DROP INDEX idx_documento_sitio_cat ON cms_documento');
        $this->db->query('DROP INDEX idx_hito_sitio_orden ON cms_hito');
        $this->db->query('DROP INDEX idx_precio_evento ON cms_precio');
    }
}
