<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PartnerModel;

class PartnerController extends BaseController
{
    protected PartnerModel $modelo;

    public function __construct()
    {
        $this->modelo = new PartnerModel();
        helper('cms');
    }

    public function index()
    {
        $sitId = sitio_activo_id();
        if (! $sitId) {
            return redirect()->to('/')->with('error', 'Selecciona un sitio primero.');
        }

        $partners = $this->modelo->obtenerPorSitio($sitId);

        return view('admin/partners/listar', [
            'tituloPagina' => 'Partners',
            'partners'     => $partners,
        ]);
    }

    public function crear()
    {
        return view('admin/partners/formulario', [
            'tituloPagina' => 'Nuevo Partner',
            'partner'      => null,
        ]);
    }

    public function guardar()
    {
        $datos = $this->request->getPost([
            'par_nombre', 'par_url', 'par_orden', 'par_activo',
        ]);

        $logo = cms_subir_archivo('par_logo', 'partners');
        if ($logo) {
            $datos['par_logo'] = $logo;
        }

        if (! $this->modelo->insert($datos)) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->modelo->errors()));
        }

        $partnerId = $this->modelo->getInsertID();
        $db = \Config\Database::connect();
        $db->table('cms_partner_sitio')->insert([
            'par_id' => $partnerId,
            'sit_id' => sitio_activo_id(),
        ]);

        return redirect()->to('/partners')->with('exito', 'Partner creado correctamente.');
    }

    public function editar(int $id)
    {
        $partner = $this->modelo->find($id);
        if (! $partner) {
            return redirect()->to('/partners')->with('error', 'Partner no encontrado.');
        }

        return view('admin/partners/formulario', [
            'tituloPagina' => 'Editar Partner',
            'partner'      => $partner,
        ]);
    }

    public function actualizar(int $id)
    {
        $datos = $this->request->getPost([
            'par_nombre', 'par_url', 'par_orden', 'par_activo',
        ]);

        $actual = $this->modelo->find($id);
        $logo = cms_subir_archivo('par_logo', 'partners', $actual['par_logo'] ?? null);
        if ($logo) {
            $datos['par_logo'] = $logo;
        }

        if (! $this->modelo->update($id, $datos)) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->modelo->errors()));
        }

        return redirect()->to('/partners')->with('exito', 'Partner actualizado correctamente.');
    }

    public function eliminar(int $id)
    {
        $this->modelo->delete($id);
        return redirect()->to('/partners')->with('exito', 'Partner eliminado correctamente.');
    }
}
