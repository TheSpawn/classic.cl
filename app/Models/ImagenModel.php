<?php

namespace App\Models;

use CodeIgniter\Model;

class ImagenModel extends Model
{
    protected $table            = 'cms_imagen';
    protected $primaryKey       = 'ima_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;

    protected $allowedFields = [
        'gal_id',
        'ima_archivo',
        'ima_titulo',
        'ima_alt',
        'ima_orden',
        'ima_activo',
    ];

    protected $validationRules = [
        'gal_id'      => 'required|integer',
        'ima_archivo' => 'required|max_length[255]',
    ];

    public function obtenerPorGaleria(int $galeriaId)
    {
        return $this->where('gal_id', $galeriaId)
                    ->where('ima_activo', 1)
                    ->orderBy('ima_orden')
                    ->findAll();
    }
}
