<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PrecioModel;
use App\Models\EventoModel;

class PrecioController extends BaseController
{
    protected PrecioModel $modelo;

    public function __construct()
    {
        $this->modelo = new PrecioModel();
        helper('cms');
    }

    public function index()
    {
        $sitId = sitio_activo_id();
        if (! $sitId) {
            return redirect()->to('/')->with('error', 'Selecciona un sitio primero.');
        }

        $precios = $this->modelo
            ->select('cms_precio.*, cms_evento.eve_titulo')
            ->join('cms_evento', 'cms_evento.eve_id = cms_precio.eve_id', 'left')
            ->where('cms_precio.sit_id', $sitId)
            ->orderBy('cms_evento.eve_titulo')
            ->orderBy('pre_fecha_inicio')
            ->findAll();

        return view('admin/precios/listar', [
            'tituloPagina' => 'Precios',
            'precios'      => $precios,
        ]);
    }

    public function crear()
    {
        $eventoModel = new EventoModel();

        return view('admin/precios/formulario', [
            'tituloPagina' => 'Nuevo Precio',
            'precio'       => null,
            'eventos'      => $eventoModel->where('sit_id', sitio_activo_id())->orderBy('eve_titulo')->findAll(),
        ]);
    }

    public function guardar()
    {
        $datos = $this->request->getPost([
            'eve_id', 'pre_nombre', 'pre_monto', 'pre_moneda', 'pre_fecha_inicio', 'pre_fecha_fin', 'pre_activo',
        ]);
        $datos['sit_id'] = sitio_activo_id();
        $datos['eve_id'] = ! empty($datos['eve_id']) ? (int) $datos['eve_id'] : null;
        $datos['pre_caracteristicas'] = $this->procesarCaracteristicas();

        if (! $this->modelo->insert($datos)) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->modelo->errors()));
        }

        return redirect()->to('/precios')->with('exito', 'Precio creado correctamente.');
    }

    public function editar(int $id)
    {
        $precio = $this->modelo->find($id);
        if (! $precio) {
            return redirect()->to('/precios')->with('error', 'Precio no encontrado.');
        }

        $eventoModel = new EventoModel();

        return view('admin/precios/formulario', [
            'tituloPagina' => 'Editar Precio',
            'precio'       => $precio,
            'eventos'      => $eventoModel->where('sit_id', sitio_activo_id())->orderBy('eve_titulo')->findAll(),
        ]);
    }

    public function actualizar(int $id)
    {
        $datos = $this->request->getPost([
            'eve_id', 'pre_nombre', 'pre_monto', 'pre_moneda', 'pre_fecha_inicio', 'pre_fecha_fin', 'pre_activo',
        ]);
        $datos['eve_id'] = ! empty($datos['eve_id']) ? (int) $datos['eve_id'] : null;
        $datos['pre_caracteristicas'] = $this->procesarCaracteristicas();

        if (! $this->modelo->update($id, $datos)) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->modelo->errors()));
        }

        return redirect()->to('/precios')->with('exito', 'Precio actualizado correctamente.');
    }

    public function eliminar(int $id)
    {
        $this->modelo->delete($id);
        return redirect()->to('/precios')->with('exito', 'Precio eliminado correctamente.');
    }

    private function procesarCaracteristicas(): string
    {
        $items = $this->request->getPost('caracteristica') ?? [];
        $filtrados = array_values(array_filter($items, fn($v) => trim($v) !== ''));
        return json_encode($filtrados, JSON_UNESCAPED_UNICODE);
    }
}
