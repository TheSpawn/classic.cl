<?php

namespace App\Models;

use CodeIgniter\Model;

class AlianzaModel extends Model
{
    protected $table            = 'cms_alianza';
    protected $primaryKey       = 'ali_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;

    protected $allowedFields = [
        'sit_id',
        'ali_nombre',
        'ali_descripcion',
        'ali_logo',
        'ali_ubicacion',
        'ali_fechas',
        'ali_tipo',
        'ali_invitaciones',
        'ali_stats',
        'ali_orden',
        'ali_activo',
    ];

    protected $validationRules = [
        'sit_id'     => 'required|integer',
        'ali_nombre' => 'required|max_length[100]',
    ];

    public function obtenerPorSitio(int $sitioId)
    {
        return $this->where('sit_id', $sitioId)
                    ->where('ali_activo', 1)
                    ->orderBy('ali_tipo')
                    ->orderBy('ali_orden')
                    ->findAll();
    }
}
