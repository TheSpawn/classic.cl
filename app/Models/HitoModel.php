<?php

namespace App\Models;

use CodeIgniter\Model;

class HitoModel extends Model
{
    protected $table            = 'cms_hito';
    protected $primaryKey       = 'hit_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;

    protected $allowedFields = [
        'sit_id',
        'hit_anio',
        'hit_titulo',
        'hit_descripcion',
        'hit_imagen',
        'hit_icono',
        'hit_orden',
        'hit_activo',
    ];

    protected $validationRules = [
        'sit_id'     => 'required|integer',
        'hit_anio'   => 'required|integer',
        'hit_titulo' => 'required|max_length[200]',
    ];

    public function obtenerPorSitio(int $sitioId)
    {
        return $this->where('sit_id', $sitioId)
                    ->where('hit_activo', 1)
                    ->orderBy('hit_orden')
                    ->findAll();
    }
}
