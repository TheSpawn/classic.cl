<?php

namespace App\Models;

use CodeIgniter\Model;

class EventoModel extends Model
{
    protected $table            = 'cms_evento';
    protected $primaryKey       = 'eve_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;

    protected $allowedFields = [
        'sit_id',
        'eve_titulo',
        'eve_slug',
        'eve_fecha',
        'eve_hora',
        'eve_ubicacion',
        'eve_venue',
        'eve_estado',
        'eve_descripcion_corta',
        'eve_descripcion',
        'eve_icono',
        'eve_imagen',
        'eve_video',
        'eve_orden',
        'eve_activo',
    ];

    protected $validationRules = [
        'eve_id'     => 'permit_empty|integer',
        'sit_id'     => 'required|integer',
        'eve_titulo' => 'required|max_length[200]',
        'eve_slug'   => 'required|max_length[200]|is_unique[cms_evento.eve_slug,eve_id,{eve_id}]',
    ];

    public function obtenerPorSitio(int $sitioId)
    {
        return $this->where('sit_id', $sitioId)
                    ->where('eve_activo', 1)
                    ->orderBy('eve_orden')
                    ->findAll();
    }

    public function obtenerConRelaciones(int $id): ?array
    {
        $evento = $this->find($id);

        if ($evento) {
            $db = \Config\Database::connect();
            $evento['meta'] = $db->table('cms_evento_meta')
                ->where('eve_id', $id)
                ->orderBy('met_orden')
                ->get()->getResultArray();

            $evento['highlights'] = $db->table('cms_evento_highlight')
                ->where('eve_id', $id)
                ->orderBy('hig_orden')
                ->get()->getResultArray();
        }

        return $evento;
    }
}
