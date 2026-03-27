<?php

namespace App\Models;

use CodeIgniter\Model;

class EventoHighlightModel extends Model
{
    protected $table            = 'cms_evento_highlight';
    protected $primaryKey       = 'hig_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = false;

    protected $allowedFields = [
        'eve_id',
        'hig_texto',
        'hig_orden',
    ];
}
