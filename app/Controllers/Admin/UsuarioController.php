<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use App\Models\SitioModel;

class UsuarioController extends BaseController
{
    protected UsuarioModel $modelo;

    public function __construct()
    {
        $this->modelo = new UsuarioModel();
        helper('cms');
    }

    public function index()
    {
        return view('admin/usuarios/listar', [
            'tituloPagina' => 'Usuarios',
            'usuarios'     => $this->modelo->orderBy('usu_nombre')->findAll(),
        ]);
    }

    public function crear()
    {
        $sitioModel = new SitioModel();
        return view('admin/usuarios/formulario', [
            'tituloPagina' => 'Nuevo Usuario',
            'usuario'      => null,
            'sitios'       => $sitioModel->obtenerActivos(),
            'sitiosAsignados' => [],
        ]);
    }

    public function guardar()
    {
        $datos = $this->request->getPost([
            'usu_nombre', 'usu_apellido', 'usu_email', 'usu_password', 'usu_rol', 'usu_activo',
        ]);

        if (empty($datos['usu_password'])) {
            return redirect()->back()->withInput()
                ->with('error', 'La contrasena es obligatoria para nuevos usuarios.');
        }

        if (! $this->modelo->insert($datos)) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->modelo->errors()));
        }

        $usuarioId = $this->modelo->getInsertID();
        $this->sincronizarSitios($usuarioId);

        return redirect()->to('/usuarios')->with('exito', 'Usuario creado correctamente.');
    }

    public function editar(int $id)
    {
        $usuario = $this->modelo->find($id);
        if (! $usuario) {
            return redirect()->to('/usuarios')->with('error', 'Usuario no encontrado.');
        }

        $db = \Config\Database::connect();
        $sitiosAsignados = $db->table('cms_usuario_sitio')
            ->where('usu_id', $id)
            ->get()->getResultArray();
        $sitiosIds = array_column($sitiosAsignados, 'sit_id');

        $sitioModel = new SitioModel();
        return view('admin/usuarios/formulario', [
            'tituloPagina'    => 'Editar Usuario',
            'usuario'         => $usuario,
            'sitios'          => $sitioModel->obtenerActivos(),
            'sitiosAsignados' => $sitiosIds,
        ]);
    }

    public function actualizar(int $id)
    {
        $datos = $this->request->getPost([
            'usu_nombre', 'usu_apellido', 'usu_email', 'usu_password', 'usu_rol', 'usu_activo',
        ]);
        $datos['usu_id'] = $id;

        if (! $this->modelo->update($id, $datos)) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->modelo->errors()));
        }

        $this->sincronizarSitios($id);

        return redirect()->to('/usuarios')->with('exito', 'Usuario actualizado correctamente.');
    }

    public function eliminar(int $id)
    {
        // No permitir auto-eliminación
        if ((int) session()->get('usu_id') === $id) {
            return redirect()->to('/usuarios')->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $this->modelo->delete($id);
        return redirect()->to('/usuarios')->with('exito', 'Usuario eliminado correctamente.');
    }

    private function sincronizarSitios(int $usuarioId): void
    {
        $db = \Config\Database::connect();
        $db->table('cms_usuario_sitio')->where('usu_id', $usuarioId)->delete();

        $sitiosIds = $this->request->getPost('sitios') ?? [];
        foreach ($sitiosIds as $sitId) {
            $db->table('cms_usuario_sitio')->insert([
                'usu_id' => $usuarioId,
                'sit_id' => (int) $sitId,
            ]);
        }
    }
}
