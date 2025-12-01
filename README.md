# Gestor de Tareas (Task Manager)

Aplicación web simple construida con Laravel 12 para la gestión de tareas (CRUD). La aplicación utiliza Blade para las vistas y jQuery/AJAX para interactuar con una API RESTful.

# Instalación
## Requisitos previos
Asegúrate de tener instalado el siguiente software en tu sistema operativo:
- Git: Para clonar el repositorio de la aplicación.
- Docker Desktop (o Docker Engine y Docker Compose): Esencial para construir y ejecutar los contenedores.
    - En Windows y macOS, se recomienda Docker Desktop.
    - En Linux, necesitarás Docker Engine y Docker Compose V2 (que a menudo viene como un complemento de docker).

## Instalación linux
### Clonar el repositorio.
Abre una terminal y clona el repositorio de tu aplicación.
``` bash
git clone https://github.com/Pukiretsu/API-TASKS.git
cd API-TASKS
```

### Configuración entorno
En el directorio raiz se encuentra un .env.example es necesario crear un .env a partir de este para que docker compose pueda hacer el build y generar todo lo necesario para correr el proyecto.
``` bash
cp .env.example .env
```

### Iniciar los contenedores
Utiliza el comando ```docker compose up``` para construir las imágenes (si no existen) y arrancar todos los servicios definidos en el archivo.
```docker-compose.yml.```

``` bash
docker compose up -d --build
```

### Verificación de estado de los contenedores
Comprueba que los tres servicios (**app**, **mysql**, **nginx**) se estén ejecutando correctamente:
``` bash
docker compose ps
```

### Realizar las migraciones del proyecto
Una vez que los contenedores estén levantados, debes ejecutar las migraciones de Laravel para crear las tablas en la base de datos MySQL. Esto se hace ejecutando el comando ```php artisan migrate``` dentro del contenedor del servicio de aplicación (app).
```bash
docker compose exec app php artisan migrate
```

### Acceder a la Aplicación
Una vez que los contenedores estén levantados y el servicio Nginx esté activo, podrás acceder a la aplicación desde tu navegador en http://localhost:8000

---
## Instalación Windows
### Clonar el repositorio.
Abre tu terminal preferida (ej. _Powershell_) (Asegúrate de que _git_ esté disponible) y clona el repositorio.
``` powershell
git clone https://github.com/Pukiretsu/API-TASKS.git
cd API-TASKS
```
### Configuración entorno
En el directorio raiz se encuentra un .env.example es necesario crear un .env a partir de este para que docker compose pueda hacer el build y generar todo lo necesario para correr el proyecto
``` powershell
# En powershell
Copy-Item .env.example .env
```
``` bash
# En git-bash o CMD
cp .env.example .env
```
### Iniciar los contenedores
Asegúrate de que **Docker Desktop** se esté ejecutando. Luego, utiliza el comando ```docker compose up``` para construir y arrancar los servicios.

``` powershell
docker compose up -d --build
```

### Verificación de estado de los contenedores
Comprueba desde **Docker Desktop** que tengas los servicios levantados.

### Realizar las migraciones del proyecto
Ejecuta las migraciones de Laravel dentro del contenedor del servicio de aplicación (app):
```bash
docker compose exec app php artisan migrate
```

### Acceder a la Aplicación
Una vez que los contenedores estén levantados y el servicio Nginx esté activo, podrás acceder a la aplicación desde tu navegador en http://localhost:8000

## Detener los servicios (Windows/Linux)
Para detener y eliminar los contenedores y redes:
``` bash
docker compose down
```

Para detener y eliminar **todos** los contenedores, redes y volúmenes (lo cual eliminaría los datos de la base de datos MySQL):
``` bash
docker compose down --volumes
```

# A continuación...
Te invito a leer la documentacion que se encuentra en ```./src/README.md```

---
### Nota.
No hay pasos de instalación para macOS porque no tengo ninguna maquina con ese sistema operativo, pero al estar basado en unix es posible seguir los pasos de ejecución de Linux y que funcione (¿creo?).