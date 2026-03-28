<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ── Hosts desde .env ──
$portalHost = env('PORTAL_HOST', 'classic.cl.test');
$cmsHost    = env('CMS_HOST', 'cms.classic.cl.test');
$apiHost    = env('API_HOST', 'api.classic.cl.test');

// ═══════════════════════════════════════════════════════════════
// PORTAL CORPORATIVO — classic.cl
// ═══════════════════════════════════════════════════════════════
$portalRoutes = static function ($routes) {
    $routes->get('/', 'Portal\InicioController::index');
    $routes->get('v2', 'Portal\InicioController::v2');
};
$routes->group('', ['hostname' => $portalHost], $portalRoutes);
$routes->group('', ['hostname' => 'www.' . $portalHost], $portalRoutes);

// ═══════════════════════════════════════════════════════════════
// CMS — cms.classic.cl (Login público, resto protegido)
// ═══════════════════════════════════════════════════════════════

// Login (sin filtro auth)
$routes->group('', ['hostname' => $cmsHost], static function ($routes) {
    $routes->get('login', 'Auth\LoginController::index');
    $routes->post('login', 'Auth\LoginController::autenticar');
    $routes->get('logout', 'Auth\LoginController::logout');
});

// Panel CMS (con filtro auth)
$routes->group('', ['hostname' => $cmsHost, 'filter' => 'filtroAuth'], static function ($routes) {

    $routes->get('/', 'Admin\DashboardController::index');

    // Sitios
    $routes->get('sitios', 'Admin\SitioController::index');
    $routes->get('sitios/crear', 'Admin\SitioController::crear');
    $routes->post('sitios/guardar', 'Admin\SitioController::guardar');
    $routes->get('sitios/editar/(:num)', 'Admin\SitioController::editar/$1');
    $routes->post('sitios/actualizar/(:num)', 'Admin\SitioController::actualizar/$1');
    $routes->post('sitios/eliminar/(:num)', 'Admin\SitioController::eliminar/$1');

    // Usuarios (solo SUPERADMIN)
    $routes->group('usuarios', ['filter' => 'filtroRol:SUPERADMIN'], static function ($routes) {
        $routes->get('/', 'Admin\UsuarioController::index');
        $routes->get('crear', 'Admin\UsuarioController::crear');
        $routes->post('guardar', 'Admin\UsuarioController::guardar');
        $routes->get('editar/(:num)', 'Admin\UsuarioController::editar/$1');
        $routes->post('actualizar/(:num)', 'Admin\UsuarioController::actualizar/$1');
        $routes->post('eliminar/(:num)', 'Admin\UsuarioController::eliminar/$1');
    });

    // Cambiar sitio activo
    $routes->post('cambiar-sitio', 'Admin\DashboardController::cambiarSitio');

    // Perfil / Cambiar contraseña
    $routes->get('perfil', 'Admin\PerfilController::index');
    $routes->post('perfil/cambiar-password', 'Admin\PerfilController::cambiarPassword');

    // --- CRUDs con sitio activo (Sprint 2) ---
    // Eventos
    $routes->get('eventos', 'Admin\EventoController::index');
    $routes->get('eventos/crear', 'Admin\EventoController::crear');
    $routes->post('eventos/guardar', 'Admin\EventoController::guardar');
    $routes->get('eventos/editar/(:num)', 'Admin\EventoController::editar/$1');
    $routes->post('eventos/actualizar/(:num)', 'Admin\EventoController::actualizar/$1');
    $routes->post('eventos/eliminar/(:num)', 'Admin\EventoController::eliminar/$1');

    // Galeria
    $routes->get('galeria', 'Admin\GaleriaController::index');
    $routes->get('galeria/crear', 'Admin\GaleriaController::crear');
    $routes->post('galeria/guardar', 'Admin\GaleriaController::guardar');
    $routes->get('galeria/editar/(:num)', 'Admin\GaleriaController::editar/$1');
    $routes->post('galeria/actualizar/(:num)', 'Admin\GaleriaController::actualizar/$1');
    $routes->post('galeria/eliminar/(:num)', 'Admin\GaleriaController::eliminar/$1');
    $routes->get('galeria/(:num)/imagenes', 'Admin\GaleriaController::imagenes/$1');
    $routes->post('galeria/(:num)/subir-imagen', 'Admin\GaleriaController::subirImagen/$1');
    $routes->post('galeria/eliminar-imagen/(:num)', 'Admin\GaleriaController::eliminarImagen/$1');

    // Alianzas
    $routes->get('alianzas', 'Admin\AlianzaController::index');
    $routes->get('alianzas/crear', 'Admin\AlianzaController::crear');
    $routes->post('alianzas/guardar', 'Admin\AlianzaController::guardar');
    $routes->get('alianzas/editar/(:num)', 'Admin\AlianzaController::editar/$1');
    $routes->post('alianzas/actualizar/(:num)', 'Admin\AlianzaController::actualizar/$1');
    $routes->post('alianzas/eliminar/(:num)', 'Admin\AlianzaController::eliminar/$1');

    // Documentos
    $routes->get('documentos', 'Admin\DocumentoController::index');
    $routes->get('documentos/crear', 'Admin\DocumentoController::crear');
    $routes->post('documentos/guardar', 'Admin\DocumentoController::guardar');
    $routes->get('documentos/editar/(:num)', 'Admin\DocumentoController::editar/$1');
    $routes->post('documentos/actualizar/(:num)', 'Admin\DocumentoController::actualizar/$1');
    $routes->post('documentos/eliminar/(:num)', 'Admin\DocumentoController::eliminar/$1');

    // Partners
    $routes->get('partners', 'Admin\PartnerController::index');
    $routes->get('partners/crear', 'Admin\PartnerController::crear');
    $routes->post('partners/guardar', 'Admin\PartnerController::guardar');
    $routes->get('partners/editar/(:num)', 'Admin\PartnerController::editar/$1');
    $routes->post('partners/actualizar/(:num)', 'Admin\PartnerController::actualizar/$1');
    $routes->post('partners/eliminar/(:num)', 'Admin\PartnerController::eliminar/$1');

    // Precios
    $routes->get('precios', 'Admin\PrecioController::index');
    $routes->get('precios/crear', 'Admin\PrecioController::crear');
    $routes->post('precios/guardar', 'Admin\PrecioController::guardar');
    $routes->get('precios/editar/(:num)', 'Admin\PrecioController::editar/$1');
    $routes->post('precios/actualizar/(:num)', 'Admin\PrecioController::actualizar/$1');
    $routes->post('precios/eliminar/(:num)', 'Admin\PrecioController::eliminar/$1');

    // Contenido
    $routes->get('contenido', 'Admin\ContenidoController::index');
    $routes->get('contenido/crear', 'Admin\ContenidoController::crear');
    $routes->post('contenido/guardar', 'Admin\ContenidoController::guardar');
    $routes->get('contenido/editar/(:num)', 'Admin\ContenidoController::editar/$1');
    $routes->post('contenido/actualizar/(:num)', 'Admin\ContenidoController::actualizar/$1');
    $routes->post('contenido/eliminar/(:num)', 'Admin\ContenidoController::eliminar/$1');

    // Hitos
    $routes->get('hitos', 'Admin\HitoController::index');
    $routes->get('hitos/crear', 'Admin\HitoController::crear');
    $routes->post('hitos/guardar', 'Admin\HitoController::guardar');
    $routes->get('hitos/editar/(:num)', 'Admin\HitoController::editar/$1');
    $routes->post('hitos/actualizar/(:num)', 'Admin\HitoController::actualizar/$1');
    $routes->post('hitos/eliminar/(:num)', 'Admin\HitoController::eliminar/$1');
});

// ═══════════════════════════════════════════════════════════════
// API REST — api.classic.cl
// ═══════════════════════════════════════════════════════════════
$routes->group('v1', ['hostname' => $apiHost, 'namespace' => 'App\Controllers\Api'], static function ($routes) {
    $routes->post('cache/purgar', 'CacheApiController::purgar');
    $routes->get('sitios', 'SitioApiController::index');
    $routes->get('sitios/(:segment)', 'SitioApiController::mostrar/$1');

    $routes->get('(:segment)/eventos', 'EventoApiController::index/$1');
    $routes->get('(:segment)/eventos/(:segment)', 'EventoApiController::mostrar/$1/$2');
    $routes->get('(:segment)/galeria', 'GaleriaApiController::index/$1');
    $routes->get('(:segment)/galeria/(:num)', 'GaleriaApiController::mostrar/$1/$2');
    $routes->get('(:segment)/alianzas', 'AlianzaApiController::index/$1');
    $routes->get('(:segment)/documentos', 'DocumentoApiController::index/$1');
    $routes->get('(:segment)/partners', 'PartnerApiController::index/$1');
    $routes->get('(:segment)/precios', 'PrecioApiController::index/$1');
    $routes->get('(:segment)/contenido', 'ContenidoApiController::index/$1');
    $routes->get('(:segment)/contenido/(:segment)', 'ContenidoApiController::porSeccion/$1/$2');
    $routes->get('(:segment)/hitos', 'HitoApiController::index/$1');
});
