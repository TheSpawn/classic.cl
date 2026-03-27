<?php

namespace App\Models;

use CodeIgniter\Model;

class EventoMetaModel extends Model
{
    protected $table            = 'cms_evento_meta';
    protected $primaryKey       = 'met_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = false;

    protected $allowedFields = [
        'eve_id',
        'met_icono',
        'met_texto',
        'met_orden',
    ];
}
