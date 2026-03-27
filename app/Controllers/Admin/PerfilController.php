<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class PerfilController extends BaseController
{
    public function index()
    {
        helper('cms');
        $modelo = new UsuarioModel();
        $usuario = $modelo->find(session()->get('usu_id'));

        return view('admin/perfil', [
            'tituloPagina' => 'Mi Perfil',
            'usuario'      => $usuario,
        ]);
    }

    public function cambiarPassword()
    {
        helper('cms');
        $actual = $this->request->getPost('password_actual');
        $nueva  = $this->request->getPost('password_nueva');
        $confirmar = $this->request->getPost('password_confirmar');

        if ($nueva !== $confirmar) {
            return redirect()->to('/perfil')->with('error', 'Las contraseñas nuevas no coinciden.');
        }

        if (strlen($nueva) < 6) {
            return redirect()->to('/perfil')->with('error', 'La contraseña debe tener al menos 6 caracteres.');
        }

        $modelo = new UsuarioModel();
        $usuario = $modelo->find(session()->get('usu_id'));

        if (! password_verify($actual, $usuario['usu_password'])) {
            return redirect()->to('/perfil')->with('error', 'La contraseña actual es incorrecta.');
        }

        $modelo->update($usuario['usu_id'], ['usu_password' => $nueva]);

        return redirect()->to('/perfil')->with('exito', 'Contraseña actualizada correctamente.');
    }
}
