<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FiltroRol implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $rolUsuario = session()->get('usu_rol');
        $rolesPermitidos = $arguments ?? [];

        if (! in_array($rolUsuario, $rolesPermitidos, true)) {
            session()->setFlashdata('error', 'No tienes permisos para acceder a esta sección.');
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
