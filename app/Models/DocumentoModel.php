<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentoModel extends Model
{
    protected $table            = 'cms_documento';
    protected $primaryKey       = 'doc_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;

    protected $allowedFields = [
        'sit_id',
        'doc_titulo',
        'doc_categoria',
        'doc_archivo',
        'doc_descripcion',
        'doc_orden',
        'doc_activo',
    ];

    protected $validationRules = [
        'sit_id'      => 'required|integer',
        'doc_titulo'  => 'required|max_length[200]',
        'doc_archivo' => 'required|max_length[255]',
    ];

    public function obtenerPorSitio(int $sitioId)
    {
        return $this->where('sit_id', $sitioId)
                    ->where('doc_activo', 1)
                    ->orderBy('doc_categoria')
                    ->orderBy('doc_orden')
                    ->findAll();
    }
}
