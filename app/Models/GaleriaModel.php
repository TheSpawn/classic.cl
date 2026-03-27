<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriaModel extends Model
{
    protected $table            = 'cms_galeria';
    protected $primaryKey       = 'gal_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;

    protected $allowedFields = [
        'sit_id',
        'gal_titulo',
        'gal_descripcion',
        'gal_imagen_portada',
        'gal_orden',
        'gal_activo',
    ];

    protected $validationRules = [
        'sit_id'     => 'required|integer',
        'gal_titulo' => 'required|max_length[200]',
    ];

    public function obtenerPorSitio(int $sitioId)
    {
        return $this->where('sit_id', $sitioId)
                    ->where('gal_activo', 1)
                    ->orderBy('gal_orden')
                    ->findAll();
    }
}
