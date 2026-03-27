<?php
/**
 * Componente reutilizable de selector de iconos con guía visual.
 *
 * Variables esperadas en scope:
 * - El campo se determina automáticamente según el contexto (hit_icono, eve_icono, met_icono)
 *
 * Uso: <?= $this->include('admin/_icono_picker') ?>
 */

// Detectar qué campo usar según el contexto
$campoIcono = 'hit_icono';
$valorIcono = old('hit_icono', $hito['hit_icono'] ?? '');

if (isset($evento)) {
    $campoIcono = 'eve_icono';
    $valorIcono = old('eve_icono', $evento['eve_icono'] ?? '');
}
?>

<label class="form-label">
    Icono
    <button type="button" class="btn btn-link btn-sm p-0 ms-1" data-bs-toggle="modal" data-bs-target="#modalIconos" title="Ver iconos disponibles">
        <i class="bi bi-question-circle"></i>
    </button>
</label>
<div class="input-group">
    <span class="input-group-text" id="preview-icono">
        <i class="<?= esc($valorIcono ?: 'bi bi-star') ?>"></i>
    </span>
    <input type="text" class="form-control" name="<?= $campoIcono ?>" id="input-icono"
           value="<?= esc($valorIcono) ?>"
           placeholder="bi-trophy"
           oninput="document.getElementById('preview-icono').innerHTML='<i class=&quot;'+this.value+'&quot;></i>'">
</div>

<!-- Modal guía de iconos -->
<div class="modal fade" id="modalIconos" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-grid-3x3-gap"></i> Guía de Iconos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted small mb-3">Haz clic en un icono para seleccionarlo. Usa el prefijo <code>bi-</code> para Bootstrap Icons.</p>

                <input type="text" class="form-control form-control-sm mb-3" id="buscarIcono" placeholder="Buscar icono..." oninput="filtrarIconos(this.value)">

                <?php
                $categorias = [
                    'Eventos y Deportes' => [
                        'bi-trophy' => 'Trofeo',
                        'bi-trophy-fill' => 'Trofeo lleno',
                        'bi-award' => 'Premio',
                        'bi-award-fill' => 'Premio lleno',
                        'bi-star' => 'Estrella',
                        'bi-star-fill' => 'Estrella llena',
                        'bi-lightning' => 'Rayo',
                        'bi-lightning-fill' => 'Rayo lleno',
                        'bi-fire' => 'Fuego',
                        'bi-megaphone' => 'Megáfono',
                        'bi-megaphone-fill' => 'Megáfono lleno',
                        'bi-flag' => 'Bandera',
                        'bi-flag-fill' => 'Bandera llena',
                        'bi-stopwatch' => 'Cronómetro',
                        'bi-heart' => 'Corazón',
                        'bi-heart-fill' => 'Corazón lleno',
                    ],
                    'Calendario y Tiempo' => [
                        'bi-calendar-event' => 'Evento',
                        'bi-calendar-event-fill' => 'Evento lleno',
                        'bi-calendar-check' => 'Calendario check',
                        'bi-calendar-star' => 'Calendario estrella',
                        'bi-clock' => 'Reloj',
                        'bi-clock-fill' => 'Reloj lleno',
                        'bi-clock-history' => 'Historial',
                        'bi-hourglass-split' => 'Reloj arena',
                        'bi-alarm' => 'Alarma',
                    ],
                    'Personas y Educación' => [
                        'bi-people' => 'Personas',
                        'bi-people-fill' => 'Personas lleno',
                        'bi-person' => 'Persona',
                        'bi-person-fill' => 'Persona llena',
                        'bi-person-arms-up' => 'Persona brazos arriba',
                        'bi-mortarboard' => 'Graduación',
                        'bi-mortarboard-fill' => 'Graduación lleno',
                        'bi-book' => 'Libro',
                        'bi-journal-text' => 'Cuaderno',
                    ],
                    'Ubicación y Mundo' => [
                        'bi-geo-alt' => 'Ubicación',
                        'bi-geo-alt-fill' => 'Ubicación lleno',
                        'bi-globe2' => 'Globo',
                        'bi-globe-americas' => 'Americas',
                        'bi-map' => 'Mapa',
                        'bi-pin-map' => 'Pin mapa',
                        'bi-building' => 'Edificio',
                        'bi-house' => 'Casa',
                    ],
                    'Multimedia' => [
                        'bi-camera' => 'Cámara',
                        'bi-camera-fill' => 'Cámara llena',
                        'bi-image' => 'Imagen',
                        'bi-images' => 'Imágenes',
                        'bi-play-circle' => 'Play',
                        'bi-music-note-beamed' => 'Música',
                        'bi-mic' => 'Micrófono',
                        'bi-film' => 'Video',
                    ],
                    'Comunicación' => [
                        'bi-chat-dots' => 'Chat',
                        'bi-envelope' => 'Email',
                        'bi-telephone' => 'Teléfono',
                        'bi-send' => 'Enviar',
                        'bi-share' => 'Compartir',
                        'bi-link-45deg' => 'Enlace',
                        'bi-broadcast' => 'Broadcast',
                    ],
                    'General' => [
                        'bi-check-circle' => 'Check',
                        'bi-check-circle-fill' => 'Check lleno',
                        'bi-info-circle' => 'Info',
                        'bi-exclamation-triangle' => 'Alerta',
                        'bi-shield-check' => 'Seguridad',
                        'bi-gear' => 'Configuración',
                        'bi-rocket' => 'Cohete',
                        'bi-graph-up-arrow' => 'Gráfico',
                        'bi-currency-dollar' => 'Dólar',
                        'bi-ticket-perforated' => 'Ticket',
                        'bi-hand-thumbs-up' => 'Pulgar arriba',
                        'bi-emoji-smile' => 'Sonrisa',
                        'bi-puzzle' => 'Puzzle',
                        'bi-diagram-3' => 'Diagrama',
                    ],
                ];
                ?>

                <?php foreach ($categorias as $cat => $iconos): ?>
                <h6 class="fw-bold mt-3 mb-2"><?= $cat ?></h6>
                <div class="row g-1 icono-grupo">
                    <?php foreach ($iconos as $clase => $nombre): ?>
                    <div class="col-auto icono-item" data-nombre="<?= strtolower($nombre . ' ' . $clase) ?>">
                        <button type="button" class="btn btn-outline-secondary btn-sm px-2 py-1"
                                onclick="seleccionarIcono('<?= $clase ?>')" title="<?= $nombre ?> — <?= $clase ?>">
                            <i class="<?= $clase ?>"></i>
                            <small class="d-none d-md-inline ms-1 text-muted"><?= $nombre ?></small>
                        </button>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
function seleccionarIcono(clase) {
    const input = document.getElementById('input-icono');
    input.value = clase;
    document.getElementById('preview-icono').innerHTML = '<i class="' + clase + '"></i>';
    bootstrap.Modal.getInstance(document.getElementById('modalIconos')).hide();
}

function filtrarIconos(texto) {
    texto = texto.toLowerCase();
    document.querySelectorAll('.icono-item').forEach(el => {
        el.style.display = el.dataset.nombre.includes(texto) ? '' : 'none';
    });
}
</script>
