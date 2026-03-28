# Guia de Desarrollo — Classic CMS

Guia de referencia para el desarrollo presente y futuro del ecosistema Classic.

---

## Estado actual (Marzo 2026)

### Completado

- **CMS completo** con 10 modulos CRUD (Sitios, Usuarios, Eventos, Galeria, Alianzas, Documentos, Partners, Precios, Contenido, Hitos)
- **API REST v1** con 11 endpoints por sitio + cache purge
- **Portal corporativo** en classic.cl con contenido dinamico desde BD
- **Showcase de eventos en portal** — muestra proximos eventos de todas las marcas, abre sitio destino en nueva ventana (v1 y v2)
- **Integracion cheerleaderclassic.cl** — consume API, 100% dinamico
- **Integracion danceclassic.cl** — consume API, detalle de evento 100% dinamico (meta, video, precios, highlights, compartir)
- **Toggle venta de entradas** — campo `eve_vende_entradas` para diferenciar competencias de capacitaciones
- **Rango de fechas y horarios** — campos `eve_fecha_fin` y `eve_hora_fin` para eventos multi-dia. Frontends formatean automaticamente ("17 y 18 de Octubre")
- **CORS con variantes www** — todos los dominios del ecosistema incluyendo www
- **Deploy en produccion** con FastPanel, SSL, modo mantenimiento
- **Manual de usuario** del CMS (public/manual.html)

### En uso

| Sitio                  | Estado      | BD              |
|------------------------|-------------|-----------------|
| classic.cl (CMS+API)  | Produccion  | classic_cms_ddbb |
| cheerleaderclassic.cl  | Produccion  | consume API      |
| danceclassic.cl        | Produccion  | consume API      |
| mi.classic.cl          | Pendiente   | classic_main_ddbb |
| gymclassic.cl          | Pendiente   | consume API      |

---

## Convenciones del proyecto

### Codigo

- **Idioma:** Todo en espaniol (controladores, modelos, vistas, rutas, BD)
- **Patron CRUD:** migracion -> modelo -> controller Admin -> vistas -> controller Api
- **Naming BD:** tablas `cms_`, campos con prefijo de 3 letras (`sit_`, `usu_`, `eve_`, `gal_`, `img_`, `ali_`, `doc_`, `par_`, `pre_`, `con_`, `hit_`)
- **Uploads:** Siempre archivos fisicos (no URLs externas), via `cms_subir_archivo()` del helper
- **Soft deletes:** En todas las tablas principales
- **Validacion:** En los modelos, con `permit_empty|integer` en PKs e `is_unique` con placeholders

### Frontend CMS

- **Layout:** Bootstrap 5 + Alpine.js
- **Campos dinamicos:** Alpine.js para arrays (meta, highlights, stats, caracteristicas)
- **Iconos:** `_icono_picker.php` como componente reutilizable

### API

- **Versionado:** `/v1/` en todas las rutas
- **Auth:** Bearer token via `API_SECRET_KEY` en `.env`
- **Respuesta:** JSON con HTTP status codes estandar
- **Cache:** Los frontends cachean respuestas (30seg en dev). Purgar desde CMS o via POST `/v1/cache/purgar`

### Eventos

- **Tipos:** Competencias (vende entradas) y capacitaciones (solo inscripcion)
- **Campo `eve_vende_entradas`:** 1 = Si (default), 0 = No. Los frontends usan este campo para mostrar/ocultar "Comprar Entradas"
- **Rango de fechas:** `eve_fecha` (inicio) + `eve_fecha_fin` (fin, opcional). Si no hay fecha fin, es evento de un dia
- **Rango de horarios:** `eve_hora` (inicio) + `eve_hora_fin` (aprox, opcional)
- **API:** Expone `vende_entradas`, `fecha_fin` y `hora_fin` en la respuesta JSON de eventos
- **Frontends:** Formatean automaticamente: "17 de Octubre" (1 dia), "17 y 18 de Octubre" (mismo mes), "30 Sept al 2 Oct" (distinto mes). Horario: "09:00 a 20:00 hrs"

### Frontends (cheerleaderclassic.cl, danceclassic.cl, etc.)

- **Library:** `ApiCms.php` en `app/Libraries/` — cliente HTTP que consume la API
- **Variables .env:** `CMS_BASE_URL`, `CMS_API_URL`, `CMS_API_KEY`, `CMS_SITIO_SLUG`
- **URLs de archivos:** Resolver con `cmsBaseUrl` para que uploads apunten al CMS
- **Fallback:** Datos hardcodeados como respaldo si la API falla
- **No duplicar logica:** Toda logica de negocio va en el CMS, los frontends solo presentan
- **Detalle de evento:** Dinamico desde API — highlights ("Que Incluye"), meta datos, video embed, precios, otros eventos, compartir

---

## Roadmap de desarrollo

### Prioridad alta

#### 1. Integracion gymclassic.cl
- Mismo patron que cheerleader/dance: crear `ApiCms.php`, configurar `.env`
- Cargar contenido del gym en el CMS (sitio ya existe como seed)

#### 2. mi.classic.cl — Portal de usuarios
- **Instalacion CI4 independiente** (no es parte de este repo)
- BD: `classic_main_ddbb` (tablas `glo_` existentes)
- Funcionalidad: registro, login, dashboard para entrenadores, atletas, instituciones, equipos
- Nuevas tablas: `reg_` (registro), `pag_` (pagos), etc.
- **No mezclar** con classic_cms_ddbb

#### 3. Tickets Classic — Sistema de ticketera
- Sistema propio de venta de entradas (reemplaza Passline)
- Integrar links de compra en los frontends
- Posiblemente subdominio: tickets.classic.cl

### Prioridad media

#### 4. Galeria desde API
- Actualmente cheerleaderclassic.cl lee filesystem local para algunas galerias
- Migrar a consumo 100% via API del CMS

#### 5. Hero slider dinamico
- El hero/slider del home en los frontends esta hardcodeado
- Crear modulo en el CMS para gestionar slides (imagen, titulo, CTA, link)
- Nuevo modulo: `cms_slide` o extender `cms_contenido`

#### 6. Contacto dinamico
- Direccion, telefono, email estan hardcodeados en las vistas de los frontends
- Gestionar desde `cms_contenido` con seccion "contacto" o crear configuracion por sitio

#### 7. Emails transaccionales
- SMTP configurado con Gmail (no-reply@classic.cl)
- Implementar notificaciones: registro, confirmacion, recordatorios
- CI4 Email library ya disponible

### Prioridad baja

#### 8. Print CSS
- Estilos de impresion para vistas del CMS (reportes, listados)

#### 9. education.classic.cl / app.classic.cl
- Formacion y certificacion (education)
- Dashboard/App general (app)
- Definir alcance antes de desarrollar

#### 10. Classic Patagonia
- Evento regional
- Nuevo sitio o seccion dentro del ecosistema
- Cargar contenido en CMS (sitio patagonia)

---

## Decisiones arquitectonicas

### Separacion CMS vs Portal de usuarios

```
classic.cl (CMS)        -> Contenido web       -> classic_cms_ddbb
mi.classic.cl (Portal)  -> Operaciones/usuarios -> classic_main_ddbb
```

El CMS es para editores de contenido (pocos usuarios).
mi.classic.cl es para usuarios finales (miles de usuarios).
Son instalaciones CI4 independientes con BDs separadas.

### Una app, tres subdominios

El CMS usa hostname routing en `Routes.php` para servir portal, admin y API desde la misma instalacion. Esto simplifica el deploy y evita duplicar codigo.

### Frontends independientes

Cada frontend (cheerleader, dance, gym) es una app CI4 separada con su propio diseno. Consumen la API del CMS para obtener datos. Esto permite:
- Disenos completamente distintos por marca
- Deploys independientes
- Cambiar el frontend sin afectar la API ni el CMS

### www.classic.cl (scoring) va a desaparecer

El sistema de scoring actual se rediseniara a futuro. Las tablas `sec_` de `classic_main_ddbb` se redeseniaran.

---

## Como agregar un nuevo modulo al CMS

Seguir este orden:

### 1. Migracion
```bash
php spark make:migration CrearCmsNuevoModulo
```
- Tabla: `cms_nuevo_modulo`
- Campos con prefijo de 3 letras (`nue_`)
- Incluir: sit_id (FK), activo, orden, timestamps, soft delete

### 2. Modelo
```bash
php spark make:model NuevoModuloModel
```
- Tabla, primaryKey, allowedFields
- Validacion en `$validationRules`
- `$useSoftDeletes = true`, `$useTimestamps = true`

### 3. Controller Admin
- Crear en `app/Controllers/Admin/NuevoModuloController.php`
- Metodos: index, crear, guardar, editar, actualizar, eliminar
- Filtrar por `session('sitio_activo_id')` en todas las queries

### 4. Vistas
- Crear en `app/Views/admin/nuevo_modulo/`
- Archivos: `index.php`, `formulario.php`
- Usar layout `plantillas/admin.php`
- Alpine.js para campos dinamicos si aplica

### 5. Controller API
- Crear en `app/Controllers/Api/NuevoModuloApiController.php`
- Extender `BaseApiController`
- Metodo `index($sitioSlug)` que retorna JSON

### 6. Rutas
- Agregar rutas admin en el grupo CMS de `Routes.php`
- Agregar endpoint API en el grupo API de `Routes.php`
- Agregar link en el sidebar de `plantillas/admin.php`

### 7. Migracion y prueba
```bash
php spark migrate
```
- Probar CRUD en cms.classic.cl.test
- Probar endpoint en api.classic.cl.test
- Verificar que los frontends pueden consumir el nuevo endpoint

---

## Como integrar un nuevo frontend

### 1. Crear proyecto CI4

```bash
composer create-project codeigniter4/appstarter nuevo-sitio
```

### 2. Crear ApiCms Library

Copiar `app/Libraries/ApiCms.php` de cheerleaderclassic.cl o danceclassic.cl y adaptar:
- Metodos de transformacion segun la estructura de vistas del nuevo sitio
- Cache: 30seg en dev, 5min+ en produccion

### 3. Configurar .env

```env
CMS_BASE_URL = https://classic.cl
CMS_API_URL = https://api.classic.cl/v1
CMS_API_KEY = <api-secret-key>
CMS_SITIO_SLUG = <slug-del-sitio>
```

### 4. Consumir API en controllers

```php
$api = new \App\Libraries\ApiCms();
$eventos = $api->getEventos();
```

### 5. Fallback

Siempre mantener datos hardcodeados como respaldo por si la API no responde.

---

## Notas importantes

- **No inventar clases CSS ni estructuras sin verificar el codigo existente primero.** Siempre revisar las vistas actuales antes de agregar estilos.
- **No duplicar logica de negocio en los frontends.** Si necesitas calcular algo, agregalo a la API.
- **Los uploads van al CMS**, no a los frontends. Las URLs de archivos se resuelven con `cmsBaseUrl`.
- **Cambios en la BD siempre via migraciones**, nunca SQL directo en produccion.
- **Probar en los 3 subdominios** despues de cada cambio en Routes.php o Filters.php.
