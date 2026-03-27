<?php

namespace App\Models;

use CodeIgniter\Model;

class ContenidoModel extends Model
{
    protected $table            = 'cms_contenido';
    protected $primaryKey       = 'con_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;

    protected $allowedFields = [
        'sit_id',
        'con_seccion',
        'con_clave',
        'con_valor',
        'con_tipo',
    ];

    protected $validationRules = [
        'sit_id'      => 'required|integer',
        'con_seccion' => 'required|max_length[50]',
        'con_clave'   => 'required|max_length[50]',
    ];

    public function obtenerPorSitio(int $sitioId)
    {
        return $this->where('sit_id', $sitioId)
                    ->orderBy('con_seccion')
                    ->findAll();
    }

    public function obtenerPorSeccion(int $sitioId, string $seccion)
    {
        return $this->where('sit_id', $sitioId)
                    ->where('con_seccion', $seccion)
                    ->findAll();
    }
}
