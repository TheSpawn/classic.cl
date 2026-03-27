<?php

namespace App\Models;

use CodeIgniter\Model;

class SitioModel extends Model
{
    protected $table            = 'cms_sitio';
    protected $primaryKey       = 'sit_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;

    protected $allowedFields = [
        'sit_nombre',
        'sit_slug',
        'sit_dominio',
        'sit_logo',
        'sit_email',
        'sit_color_primario',
        'sit_activo',
    ];

    protected $validationRules = [
        'sit_id'      => 'permit_empty|integer',
        'sit_nombre'  => 'required|max_length[100]',
        'sit_slug'    => 'required|max_length[50]|is_unique[cms_sitio.sit_slug,sit_id,{sit_id}]',
        'sit_dominio' => 'required|max_length[100]',
    ];

    public function obtenerActivos()
    {
        return $this->where('sit_activo', 1)->orderBy('sit_nombre')->findAll();
    }
}
