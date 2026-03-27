<?php

namespace App\Models;

use CodeIgniter\Model;

class PartnerModel extends Model
{
    protected $table            = 'cms_partner';
    protected $primaryKey       = 'par_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;

    protected $allowedFields = [
        'par_nombre',
        'par_logo',
        'par_url',
        'par_orden',
        'par_activo',
    ];

    protected $validationRules = [
        'par_nombre' => 'required|max_length[100]',
    ];

    public function obtenerPorSitio(int $sitioId)
    {
        return $this->join('cms_partner_sitio ps', 'ps.par_id = cms_partner.par_id')
                    ->where('ps.sit_id', $sitioId)
                    ->where('par_activo', 1)
                    ->orderBy('par_orden')
                    ->findAll();
    }
}
