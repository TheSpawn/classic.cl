<?php

/**
 * Obtiene el sitio activo en sesión.
 */
function sitio_activo(): ?array
{
    return session()->get('sitio_activo');
}

/**
 * Obtiene el ID del sitio activo.
 */
function sitio_activo_id(): ?int
{
    $sitio = session()->get('sitio_activo');
    return $sitio ? (int) $sitio['sit_id'] : null;
}

/**
 * Genera clase CSS para badge de estado.
 */
function estado_badge_class(string $estado): string
{
    return match ($estado) {
        'PRONTO'  => 'bg-warning text-dark',
        'ABIERTO' => 'bg-success',
        'CERRADO' => 'bg-secondary',
        'PRINCIPAL'  => 'bg-primary',
        'SECUNDARIA' => 'bg-info',
        default => 'bg-secondary',
    };
}

/**
 * Formatea monto en CLP.
 */
function formato_clp(int $monto): string
{
    return '$' . number_format($monto, 0, ',', '.');
}

/**
 * Sube un archivo y retorna la ruta relativa, o null si no hay archivo válido.
 * Elimina el archivo anterior si se proporciona.
 */
function cms_subir_archivo(string $campo, string $carpeta, ?string $archivoAnterior = null): ?string
{
    $request = \Config\Services::request();
    $archivo = $request->getFile($campo);

    if (! $archivo || ! $archivo->isValid() || $archivo->hasMoved()) {
        return null;
    }

    $sitio = session()->get('sitio_activo');
    $slug  = $sitio['sit_slug'] ?? 'general';
    $ruta  = "uploads/{$slug}/{$carpeta}";
    $rutaCompleta = FCPATH . $ruta;

    if (! is_dir($rutaCompleta)) {
        mkdir($rutaCompleta, 0755, true);
    }

    $nuevoNombre = $archivo->getRandomName();
    $archivo->move($rutaCompleta, $nuevoNombre);

    // Eliminar archivo anterior
    if ($archivoAnterior && is_file(FCPATH . $archivoAnterior)) {
        unlink(FCPATH . $archivoAnterior);
    }

    return $ruta . '/' . $nuevoNombre;
}

/**
 * Sube un archivo sin depender del sitio activo (para Sitios que no tienen slug aún).
 */
/**
 * Limpia la caché de la API para forzar que los frontends obtengan datos frescos.
 * Borra todos los items con prefijo api_cms_ del cache del frontend.
 * Para el CMS, simplemente limpia el cache local de CI4.
 */
function cms_limpiar_cache(): void
{
    $cache = \Config\Services::cache();
    // CI4 FileHandler: limpiar todo el cache
    $cache->clean();
}

function cms_subir_archivo_global(string $campo, string $carpeta, ?string $archivoAnterior = null): ?string
{
    $request = \Config\Services::request();
    $archivo = $request->getFile($campo);

    if (! $archivo || ! $archivo->isValid() || $archivo->hasMoved()) {
        return null;
    }

    $ruta = "uploads/{$carpeta}";
    $rutaCompleta = FCPATH . $ruta;

    if (! is_dir($rutaCompleta)) {
        mkdir($rutaCompleta, 0755, true);
    }

    $nuevoNombre = $archivo->getRandomName();
    $archivo->move($rutaCompleta, $nuevoNombre);

    if ($archivoAnterior && is_file(FCPATH . $archivoAnterior)) {
        unlink(FCPATH . $archivoAnterior);
    }

    return $ruta . '/' . $nuevoNombre;
}
