<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'cms_usuario';
    protected $primaryKey       = 'usu_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;

    protected $allowedFields = [
        'usu_nombre',
        'usu_apellido',
        'usu_email',
        'usu_password',
        'usu_rol',
        'usu_activo',
    ];

    protected $validationRules = [
        'usu_id'       => 'permit_empty|integer',
        'usu_nombre'   => 'required|max_length[100]',
        'usu_apellido' => 'required|max_length[100]',
        'usu_email'    => 'required|valid_email|is_unique[cms_usuario.usu_email,usu_id,{usu_id}]',
        'usu_rol'      => 'required|in_list[SUPERADMIN,ADMIN,EDITOR]',
    ];

    protected $beforeInsert = ['hashearPassword'];
    protected $beforeUpdate = ['hashearPassword'];

    protected function hashearPassword(array $datos): array
    {
        if (isset($datos['data']['usu_password']) && $datos['data']['usu_password'] !== '') {
            $datos['data']['usu_password'] = password_hash($datos['data']['usu_password'], PASSWORD_DEFAULT);
        } else {
            unset($datos['data']['usu_password']);
        }

        return $datos;
    }

    public function autenticar(string $email, string $password): ?array
    {
        $usuario = $this->where('usu_email', $email)
                        ->where('usu_activo', 1)
                        ->first();

        if ($usuario && password_verify($password, $usuario['usu_password'])) {
            return $usuario;
        }

        return null;
    }

    public function obtenerConSitios(int $id): ?array
    {
        $usuario = $this->find($id);

        if ($usuario) {
            $db = \Config\Database::connect();
            $usuario['sitios'] = $db->table('cms_usuario_sitio us')
                ->join('cms_sitio s', 's.sit_id = us.sit_id')
                ->where('us.usu_id', $id)
                ->get()
                ->getResultArray();
        }

        return $usuario;
    }
}
