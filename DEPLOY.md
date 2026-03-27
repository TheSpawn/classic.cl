# Guía de Deploy — Classic CMS (Producción)

## Arquitectura

```
classic.cl          → Portal corporativo (público)
cms.classic.cl      → CMS administración (session + auth)
api.classic.cl      → API REST JSON (Bearer token)
```

Los 3 subdominios corren sobre **una sola instalación CI4** con hostname routing.
Los frontends (cheerleaderclassic.cl, danceclassic.cl) consumen la API.

---

## 1. DNS

En el panel DNS del dominio classic.cl, crear 3 registros A apuntando a la IP del servidor FastPanel:

```
classic.cl          A    → IP_SERVIDOR
cms.classic.cl      A    → IP_SERVIDOR
api.classic.cl      A    → IP_SERVIDOR
```

---

## 2. FastPanel — Crear sitios

### 2.1 Sitio principal

- Crear sitio `classic.cl` en FastPanel
- PHP 8.2 o superior
- DocumentRoot: `/var/www/www-root/data/www/classic.cl/public`

### 2.2 Subdominios

- Crear subdominio `cms.classic.cl` en FastPanel
- Crear subdominio `api.classic.cl` en FastPanel
- FastPanel creará directorios independientes para cada uno

### 2.3 Symlinks (por SSH)

Los 3 deben apuntar al mismo código. Reemplazar los directorios de los subdominios por symlinks:

```bash
cd /var/www/www-root/data/www/

# Eliminar directorios vacíos que FastPanel creó
rm -rf cms.classic.cl
rm -rf api.classic.cl

# Crear symlinks al sitio principal
ln -s classic.cl cms.classic.cl
ln -s classic.cl api.classic.cl
```

Verificar:
```bash
ls -la | grep classic
# Debe mostrar:
# cms.classic.cl -> classic.cl
# api.classic.cl -> classic.cl
```

### 2.4 DocumentRoot

Confirmar en FastPanel que el DocumentRoot de cada sitio apunte a `/public`:

- classic.cl → `.../classic.cl/public`
- cms.classic.cl → `.../cms.classic.cl/public` (symlink resuelve a classic.cl/public)
- api.classic.cl → `.../api.classic.cl/public` (symlink resuelve a classic.cl/public)

---

## 3. SSL

Activar Let's Encrypt desde FastPanel para cada sitio:

1. classic.cl → Activar SSL
2. cms.classic.cl → Activar SSL
3. api.classic.cl → Activar SSL

FastPanel gestiona la renovación automática.

---

## 4. PHP — Configuración

En FastPanel → PHP Settings, verificar para los 3 sitios:

| Parámetro | Valor |
|---|---|
| PHP Version | 8.2+ |
| upload_max_filesize | 50M |
| post_max_size | 55M |
| max_execution_time | 120 |
| memory_limit | 256M |

### Extensiones requeridas

- curl
- mbstring
- mysqli
- intl
- json
- fileinfo

---

## 5. Base de datos

### 5.1 Crear BD desde FastPanel

- Panel → Bases de datos → Crear
- Nombre: `classic_cms_ddbb`
- Usuario: `classic_user`
- Contraseña: (generar una segura, anotarla para el .env)
- Charset: `utf8mb4`
- Collation: `utf8mb4_general_ci`

### 5.2 Ejecutar migraciones y seeder

```bash
cd /var/www/www-root/data/www/classic.cl
php spark migrate
php spark db:seed CmsSeeder
```

Esto crea:
- 20 tablas (15 base + 5 migraciones adicionales)
- Usuario admin: admin@classic.cl / Classic2025!
- 3 sitios: cheerleader, dance, gym

---

## 6. Subir código

### 6.1 Opción Git (recomendada)

```bash
cd /var/www/www-root/data/www/classic.cl
git clone https://github.com/TU_USUARIO/classic.cl.git .
composer install --no-dev --optimize-autoloader
```

### 6.2 Opción manual

Subir por SFTP todos los archivos excepto:
- `vendor/` (se instala con composer en el servidor)
- `.env` (se crea manualmente en el servidor)
- `writable/` (se crea la estructura, no los archivos de cache/logs)

Luego por SSH:
```bash
cd /var/www/www-root/data/www/classic.cl
composer install --no-dev --optimize-autoloader
```

---

## 7. Archivo .env en producción

Crear el archivo `.env` en la raíz del proyecto:

```bash
nano /var/www/www-root/data/www/classic.cl/.env
```

Contenido:

```env
#--------------------------------------------------------------------
# ENVIRONMENT
#--------------------------------------------------------------------

CI_ENVIRONMENT = production

#--------------------------------------------------------------------
# APP
#--------------------------------------------------------------------

app.baseURL = 'https://classic.cl/'

#--------------------------------------------------------------------
# SUBDOMINIOS
#--------------------------------------------------------------------

PORTAL_HOST = classic.cl
CMS_HOST = cms.classic.cl
API_HOST = api.classic.cl

#--------------------------------------------------------------------
# DATABASE
#--------------------------------------------------------------------

database.default.hostname = localhost
database.default.database = classic_cms_ddbb
database.default.username = classic_user
database.default.password = CONTRASEÑA_DE_LA_BD
database.default.DBDriver = MySQLi
database.default.port = 3306

#--------------------------------------------------------------------
# API
#--------------------------------------------------------------------

API_SECRET_KEY = PEGAR_CLAVE_GENERADA

#--------------------------------------------------------------------
# SESSION
#--------------------------------------------------------------------

session.driver = 'CodeIgniter\Session\Handlers\FileHandler'
session.cookieName = classic_cms_session
```

### Generar API_SECRET_KEY

```bash
php -r "echo bin2hex(random_bytes(32)) . PHP_EOL;"
```

Copiar el resultado y pegarlo en `API_SECRET_KEY`. Esta misma clave se usa en los .env de los frontends.

---

## 8. Permisos

```bash
cd /var/www/www-root/data/www/classic.cl

# Permisos del directorio writable
chmod -R 775 writable/
chown -R www-data:www-data writable/

# Crear directorio de uploads
mkdir -p public/uploads
chmod -R 775 public/uploads
chown -R www-data:www-data public/uploads
```

---

## 9. Verificación

### 9.1 Portal corporativo

```bash
curl -s https://classic.cl/ | head -5
# Debe mostrar HTML del portal
```

### 9.2 API

```bash
curl -s -H "Authorization: Bearer TU_API_SECRET_KEY" https://api.classic.cl/v1/sitios
# Debe retornar JSON con los 3 sitios
```

### 9.3 CMS

Abrir en navegador: `https://cms.classic.cl/login`
- Email: admin@classic.cl
- Password: Classic2025!

**IMPORTANTE:** Cambiar la contraseña inmediatamente desde Mi Perfil.

### 9.4 Test completo

```bash
# Verificar que los 3 subdominios responden
curl -sI https://classic.cl/ | head -1
curl -sI https://cms.classic.cl/login | head -1
curl -s -H "Authorization: Bearer TU_KEY" https://api.classic.cl/v1/sitios | head -1
```

---

## 10. Configurar frontends

### cheerleaderclassic.cl

Actualizar el `.env` en el servidor de cheerleaderclassic.cl:

```env
CMS_BASE_URL = https://classic.cl
CMS_API_URL = https://api.classic.cl/v1
CMS_API_KEY = MISMA_API_SECRET_KEY
CMS_SITIO_SLUG = cheerleader
```

Cambiar caché a 5 minutos en `app/Libraries/ApiCms.php`:
```php
private int $cacheTtl = 300; // 5 minutos en producción
```

### danceclassic.cl

Actualizar el `.env` en el servidor de danceclassic.cl:

```env
CMS_BASE_URL = https://classic.cl
CMS_API_URL = https://api.classic.cl/v1
CMS_API_KEY = MISMA_API_SECRET_KEY
CMS_SITIO_SLUG = dance
```

Cambiar caché a 5 minutos en `app/Libraries/ApiCms.php`:
```php
private int $cacheTtl = 300; // 5 minutos en producción
```

---

## 11. Seguridad post-deploy

| Tarea | Comando/Acción |
|---|---|
| Cambiar contraseña admin | Desde cms.classic.cl → Mi Perfil |
| Verificar CI_ENVIRONMENT | Debe ser `production` (oculta errores) |
| Verificar .env no es accesible | `curl https://classic.cl/.env` debe dar 403/404 |
| Verificar app/ no es accesible | `curl https://classic.cl/app/` debe dar 403 |
| Generar API_SECRET_KEY nueva | No reusar la de desarrollo |

---

## 12. Deploy de actualizaciones futuras

```bash
cd /var/www/www-root/data/www/classic.cl

# Actualizar código
git pull origin main

# Instalar dependencias nuevas (si hay)
composer install --no-dev --optimize-autoloader

# Ejecutar migraciones nuevas (si hay)
php spark migrate

# Limpiar caché
php spark cache:clear
```

---

## 13. Estructura final en servidor

```
/var/www/www-root/data/www/
├── classic.cl/                  ← Código CI4 (CMS + API + Portal)
│   ├── app/
│   │   ├── Config/
│   │   ├── Controllers/
│   │   │   ├── Admin/           (11 controllers CMS)
│   │   │   ├── Api/             (11 controllers API)
│   │   │   ├── Auth/            (LoginController)
│   │   │   └── Portal/          (InicioController)
│   │   ├── Database/
│   │   │   ├── Migrations/      (20 migraciones)
│   │   │   └── Seeds/
│   │   ├── Filters/             (FiltroAuth, FiltroRol)
│   │   ├── Helpers/             (cms_helper)
│   │   ├── Models/              (13 modelos)
│   │   └── Views/
│   │       ├── admin/           (vistas CMS)
│   │       ├── auth/            (login)
│   │       ├── plantillas/      (layout admin)
│   │       └── portal/          (landing corporativa)
│   ├── public/                  ← DocumentRoot
│   │   ├── assets/img/          (logos, favicon)
│   │   ├── uploads/             (archivos subidos desde CMS)
│   │   ├── index.php
│   │   └── .htaccess
│   ├── vendor/
│   ├── writable/
│   └── .env
├── cms.classic.cl -> classic.cl  ← SYMLINK
├── api.classic.cl -> classic.cl  ← SYMLINK
├── cheerleaderclassic.cl/        ← Frontend Cheer (independiente)
└── danceclassic.cl/              ← Frontend Dance (independiente)
```

---

## 14. Troubleshooting

### Error 500

```bash
# Ver logs de CI4
tail -50 /var/www/www-root/data/www/classic.cl/writable/logs/log-$(date +%Y-%m-%d).log

# Ver logs de Apache
tail -50 /var/log/apache2/error.log
```

### Rutas no funcionan (404)

Verificar que mod_rewrite está habilitado y .htaccess funciona:
```bash
a2enmod rewrite
systemctl restart apache2
```

### API retorna HTML en vez de JSON

El hostname no coincide. Verificar que los symlinks están correctos y que el DNS apunta al servidor.

### Imágenes del CMS no cargan en frontends

Verificar que `public/uploads/` tiene permisos 775 y que CORS está configurado en `app/Config/Cors.php` (ya incluye los dominios del ecosistema).

### Symlinks no funcionan

Verificar que Apache tiene `Options +FollowSymLinks` en la configuración del sitio. En FastPanel esto suele estar habilitado por defecto.

---

## Credenciales a recordar

| Qué | Dónde |
|---|---|
| Admin CMS | admin@classic.cl / Classic2025! (CAMBIAR en producción) |
| BD | classic_user / (contraseña del .env) |
| API Key | (valor de API_SECRET_KEY en .env) |
| SSH | (credenciales de FastPanel) |

---

*Documento generado el 27 de marzo de 2026 para el deploy del CMS Classic Eventos.*
