<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class LoginController extends BaseController
{
    public function index()
    {
        if (session()->get('autenticado')) {
            return redirect()->to('/');
        }

        return view('auth/login');
    }

    public function autenticar()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $modelo  = new UsuarioModel();
        $usuario = $modelo->autenticar($email, $password);

        if (! $usuario) {
            return redirect()->back()
                ->with('error', 'Credenciales incorrectas.')
                ->withInput();
        }

        // Obtener sitios asignados
        $db = \Config\Database::connect();
        $sitios = $db->table('cms_usuario_sitio us')
            ->join('cms_sitio s', 's.sit_id = us.sit_id')
            ->where('us.usu_id', $usuario['usu_id'])
            ->where('s.sit_activo', 1)
            ->get()
            ->getResultArray();

        // Si es SUPERADMIN, tiene acceso a todos los sitios
        if ($usuario['usu_rol'] === 'SUPERADMIN') {
            $sitioModel = new \App\Models\SitioModel();
            $sitios = $sitioModel->obtenerActivos();
        }

        session()->set([
            'usu_id'     => $usuario['usu_id'],
            'usu_nombre' => $usuario['usu_nombre'] . ' ' . $usuario['usu_apellido'],
            'usu_email'  => $usuario['usu_email'],
            'usu_rol'    => $usuario['usu_rol'],
            'autenticado' => true,
            'sitios_usuario' => $sitios,
            'sitio_activo'   => $sitios[0] ?? null,
        ]);

        return redirect()->to('/');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
