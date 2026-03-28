# Classic CMS

Sistema de gestion de contenido multi-sitio para **Classic Producciones SpA**, construido sobre CodeIgniter 4.

Administra el contenido de todos los sitios del ecosistema Classic (cheerleaderclassic.cl, danceclassic.cl, gymclassic.cl, etc.) desde un solo panel, y lo expone via API REST para que los frontends lo consuman.

---

## Arquitectura

Una sola instalacion CI4 sirve 3 subdominios mediante hostname routing:

```
classic.cl          -> Portal corporativo (publico) + showcase de eventos
cms.classic.cl      -> Panel de administracion (sesion + auth)
api.classic.cl      -> API REST JSON (Bearer token)
```

El portal corporativo muestra un calendario con los proximos eventos de todas las marcas. Al hacer clic, se abre el sitio de la marca en una nueva ventana.

Los frontends son aplicaciones CI4 independientes que consumen la API:

```
cheerleaderclassic.cl  -> Campeonatos de cheerleading
danceclassic.cl        -> Campeonatos de dance
gymclassic.cl          -> Centro de entrenamiento
```

---

## Stack tecnologico

| Componente   | Tecnologia                        |
|--------------|-----------------------------------|
| Framework    | CodeIgniter 4.7+                  |
| PHP          | 8.2+                              |
| Base de datos| MySQL 8.4 (classic_cms_ddbb)      |
| Frontend CMS | Bootstrap 5 + Alpine.js           |
| Servidor     | FastPanel (produccion), Laragon (dev) |

---

## Requisitos

- PHP 8.2+ con extensiones: intl, mbstring, mysqli, json, fileinfo, curl
- MySQL 8.x
- Composer
- Apache con mod_rewrite

---

## Instalacion local

### 1. Clonar el repositorio

```bash
git clone git@github.com:TheSpawn/classic.cl.git
cd classic.cl
composer install
```

### 2. Configurar entorno

```bash
cp env .env
```

Editar `.env` con los valores locales:

```env
CI_ENVIRONMENT = development
app.baseURL = http://classic.cl.test/

PORTAL_HOST = classic.cl.test
CMS_HOST = cms.classic.cl.test
API_HOST = api.classic.cl.test

database.default.hostname = localhost
database.default.database = classic_cms_ddbb
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi

API_SECRET_KEY = <generar-clave-aleatoria>
```

### 3. Virtual hosts (Laragon)

Configurar 3 virtual hosts apuntando al directorio `public/`:

- `classic.cl.test`
- `cms.classic.cl.test`
- `api.classic.cl.test`

### 4. Base de datos

```bash
php spark migrate
php spark db:seed CmsSeeder
```

Esto crea las tablas (21 migraciones) y un usuario admin:
- **Email:** admin@classic.cl
- **Password:** Classic2025!

### 5. Verificar

- Portal: http://classic.cl.test
- CMS: http://cms.classic.cl.test
- API: http://api.classic.cl.test/v1/sitios (requiere Bearer token)

---

## Estructura del proyecto

```
classic.cl/
├── app/
│   ├── Config/
│   │   ├── Routes.php          # Hostname routing (portal, cms, api)
│   │   ├── Filters.php         # FiltroAuth + FiltroRol
│   │   └── Cors.php            # CORS para dominios del ecosistema
│   ├── Controllers/
│   │   ├── Admin/              # 12 controllers CRUD del CMS
│   │   ├── Api/                # 11 controllers REST (BaseApiController + modulos)
│   │   ├── Auth/               # LoginController
│   │   └── Portal/             # InicioController (sitio publico)
│   ├── Models/                 # 13 modelos con validacion y soft deletes
│   ├── Views/
│   │   ├── admin/              # Vistas CRUD por modulo
│   │   ├── auth/               # Login
│   │   ├── portal/             # Paginas publicas
│   │   └── plantillas/         # Layout admin (sidebar, topbar)
│   ├── Database/
│   │   ├── Migrations/         # 22 migraciones
│   │   └── Seeds/              # CmsSeeder
│   ├── Filters/                # FiltroAuth, FiltroRol
│   └── Helpers/                # cms_helper.php
├── public/
│   ├── assets/                 # CSS, JS, imagenes, favicons
│   ├── uploads/                # Archivos subidos desde el CMS
│   └── index.php               # Entry point
├── writable/                   # Logs, cache, sesiones
├── DEPLOY.md                   # Guia de deploy a produccion
├── database_schema.sql         # Dump del esquema SQL
└── .env                        # Variables de entorno (no versionado)
```

---

## Modulos del CMS

| Modulo      | Descripcion                                    | Tabla(s)                              |
|-------------|------------------------------------------------|---------------------------------------|
| Sitios      | Gestion de sitios web del ecosistema           | cms_sitio                             |
| Usuarios    | Cuentas de administradores (SUPERADMIN/ADMIN)  | cms_usuario, cms_usuario_sitio        |
| Eventos     | Competencias y capacitaciones con rango de fechas, horarios, meta, highlights, video y control de venta de entradas | cms_evento, cms_evento_meta, cms_evento_highlight |
| Galeria     | Galerias fotograficas con imagenes             | cms_galeria, cms_imagen               |
| Alianzas    | Partners internacionales (principal/secundaria)| cms_alianza                           |
| Documentos  | Archivos descargables por categoria            | cms_documento                         |
| Partners    | Sponsors globales (cross-site)                 | cms_partner, cms_partner_sitio        |
| Precios     | Planes de inscripcion vinculados a eventos     | cms_precio                            |
| Contenido   | Bloques dinamicos (texto, HTML, JSON)          | cms_contenido                         |
| Hitos       | Timeline historico por anio                    | cms_hito                              |

---

## API REST

Base URL: `https://api.classic.cl/v1`

Autenticacion via header: `Authorization: Bearer {API_SECRET_KEY}`

### Endpoints

```
GET  /sitios                         # Listar sitios
GET  /sitios/:slug                   # Detalle de sitio
GET  /:sitio/eventos                 # Eventos del sitio
GET  /:sitio/eventos/:slug           # Detalle de evento (+ precios)
GET  /:sitio/galeria                 # Galerias
GET  /:sitio/galeria/:id             # Detalle galeria (+ imagenes)
GET  /:sitio/alianzas                # Alianzas
GET  /:sitio/documentos              # Documentos
GET  /:sitio/partners                # Partners
GET  /:sitio/precios                 # Precios
GET  /:sitio/contenido               # Todo el contenido
GET  /:sitio/contenido/:seccion      # Contenido por seccion
GET  /:sitio/hitos                   # Hitos/timeline
POST /cache/purgar                   # Limpiar cache
```

---

## Autenticacion

### CMS (sesion)
- Login con email + password
- Sesion basada en archivos (`writable/session/`)
- Filtros: `FiltroAuth` (requiere login), `FiltroRol` (requiere SUPERADMIN)

### API (token)
- Bearer token definido en `.env` (`API_SECRET_KEY`)
- Validacion via `hash_equals` en `BaseApiController`

---

## Base de datos

- **Nombre:** classic_cms_ddbb
- **Collation:** utf8mb4_general_ci
- **Convenciones:** tablas con prefijo `cms_`, campos con prefijo de 3 letras (sit_, usu_, eve_, etc.)
- **Soft deletes:** Todas las tablas principales
- **Timestamps:** created_at, updated_at automaticos

Ver `database_schema.sql` para el esquema completo.

---

## Deploy a produccion

Ver [DEPLOY.md](DEPLOY.md) para la guia completa de deploy en FastPanel.

Resumen:
1. DNS: 3 registros A (classic.cl, cms.classic.cl, api.classic.cl)
2. Symlinks: subdominios apuntan al mismo directorio
3. SSL: Let's Encrypt con auto-renovacion
4. `.env.production` con credenciales de produccion
5. Migraciones y seed en el servidor

---

## Portal corporativo

El portal en classic.cl incluye una seccion "Proximos Eventos" que muestra automaticamente los eventos de todos los sitios activos (cheerleader, dance, gym, etc.). Cada card enlaza al sitio de destino en una nueva ventana. La seccion solo aparece si hay eventos cargados en el CMS.

Existe en dos versiones: v1 (`/`) y v2 (`/v2`).

---

## Modo mantenimiento

Implementado en `public/index.php`. Muestra `maintenance.html` en el portal publico.
- CMS y API quedan excluidos (siempre accesibles)
- Preview bypass: `?preview=classic2026` (cookie de 24 horas)

---

## Empresa

**Classic Producciones SpA** (antes Classic Eventos Limitada)
- 20 anios de trayectoria (desde 2006)
- Direccion: Puma #1417, Recoleta, Santiago, Chile
- Telefono: +56 9 9249 2827
- Email: cheer@classic.cl
