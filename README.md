# StackOverflow Test App

Este proyecto es una API REST desarrollada con Laravel 11 que consume información de la API de StackOverflow. El endpoint principal de la API es `/api` con el método `GET`. Esta aplicación restringe el acceso a otras rutas devolviendo un código de error `400`.

## Tabla de Contenidos
- [Características](#características)
- [Instalación](#instalación)
- [Configuración](#configuración)
- [Ejecutar la Aplicación](#ejecutar-la-aplicación)
- [Endpoints de la API](#endpoints-de-la-api)
- [Modelos](#modelos)
- [Validación de Solicitudes](#validación-de-solicitudes)
- [Lógica del Controlador](#lógica-del-controlador)
- [Capa de Servicio](#capa-de-servicio)

## Características
- Restringe todas las rutas excepto `/api` con un código de error `400`.
- Acepta los siguientes parámetros:
  - `tagged`: (obligatorio) string
  - `fromdate`: (opcional) timestamp Unix
  - `todate`: (opcional) timestamp Unix
- Verifica en la base de datos solicitudes existentes antes de consultar la API de StackOverflow.
- Almacena las solicitudes y respuestas de la API en la base de datos.

## Instalación
Clona el repositorio:

```bash
gh repo clone frangirona86/stackoverflow-test-app
cd stackoverflow-test-app
```
Instala las dependencias:

```bash
composer install
npm install
npm run dev
```
## Configuración

Copia el archivo de entorno de ejemplo y configura las variables de entorno:

```bash
cp .env.example .env
```

Actualiza las siguientes variables en el archivo .env:

```makefile
DB_CONNECTION=DB_CONNECTION
DB_HOST=DB_HOST
DB_PORT=DB_PORT
DB_DATABASE=DB_DATABASE
DB_USERNAME=DB_USERNAME
DB_PASSWORD=DB_PASSWORD
```
Genera la clave de la aplicación:

```bash
php artisan key:generate
```

Ejecuta las migraciones de la base de datos:

```bash
Copiar código
php artisan migrate
Ejecutar la Aplicación
```

Para iniciar el servidor de desarrollo de Laravel, ejecuta:

```bash
Copiar código
php artisan serve
```

La aplicación estará disponible en http://localhost:8000.

## Endpoints de la API

### `GET /api`

<ul>
    <li>Descripción: Obtiene información de la API de StackOverflow.</li>
    <li>
        <ul>
            <li>Parámetros:</li>
            <li>
                <ul>
                    <li>`tagged`: (obligatorio) string</li>
                    <li>`fromdate`: (opcional) timestamp Unix</li>
                    <li>`todate`: (opcional) timestamp Unix</li>
                </ul>
            </li>
            <li><strog>Respuesta</strog>: Respuesta en formato JSON de la API de StackOverflow o datos de la base de datos.</li>
        </ul> 
    </li>
</ul>

## Modelos

### `ApiRequest`

El modelo <strong>`ApiRequest`</strong> representa un registro de una solicitud de API realizada a la API de StackOverflow.

## Validación de Solicitudes

### `BaseRequest`
La clase <strong>`BaseRequest`</strong> maneja la validación de los parámetros de la solicitud. Garantiza que se proporcione el parámetro <strong>`tagged`</strong> y ajusta los parámetros opcionales para cumplir con los requisitos de la API de StackOverflow.

## Lógica del Controlador

## `ApiRequestController`
El <strong>`ApiRequestController`</strong> maneja las solicitudes entrantes al endpoint /api.

Realiza los siguientes pasos:
<ul>
    <li>Valida la solicitud utilizando BaseRequest.</li>
    <li>Verifica en la base de datos si existe una solicitud coincidente con los parámetros.</li>
    <li>Si la solicitud existe, devuelve la respuesta.</li>
    <li>Si la solicitud no existe, llama al ApiService para obtener datos de la API de StackOverflow.</li>
    <li>Guarda la nueva solicitud y la respuesta en la tabla api_requests.</li>
    <li>Devuelve la respuesta al cliente.</li>
</ul>

## Capa de Servicio
### `ApiService`
El <strong>`ApiService`</strong> es responsable de realizar solicitudes a la API de StackOverflow. Toma los parámetros validados y construye la consulta adecuada para obtener datos de StackOverflow.

