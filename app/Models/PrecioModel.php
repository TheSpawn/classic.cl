<?php

namespace App\Models;

use CodeIgniter\Model;

class PrecioModel extends Model
{
    protected $table            = 'cms_precio';
    protected $primaryKey       = 'pre_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;

    protected $allowedFields = [
        'sit_id',
        'eve_id',
        'pre_nombre',
        'pre_monto',
        'pre_moneda',
        'pre_fecha_inicio',
        'pre_fecha_fin',
        'pre_caracteristicas',
        'pre_activo',
    ];

    protected $validationRules = [
        'sit_id'     => 'required|integer',
        'eve_id'     => 'permit_empty|integer',
        'pre_nombre' => 'required|max_length[100]',
        'pre_monto'  => 'required|integer',
    ];

    public function obtenerPorSitio(int $sitioId)
    {
        return $this->where('sit_id', $sitioId)
                    ->where('pre_activo', 1)
                    ->orderBy('pre_fecha_inicio')
                    ->findAll();
    }

    public function obtenerPorEvento(int $eventoId)
    {
        return $this->where('eve_id', $eventoId)
                    ->where('pre_activo', 1)
                    ->orderBy('pre_fecha_inicio')
                    ->findAll();
    }
}
