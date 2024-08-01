# Sistema de Votación

Prueba de diagnostico de la empresa Facturación.com para el puesto de Desarrollador de Software. El proyecto fue desarrollado con Javascript, PHP y MySQL

## Prerrequisitos

Asegúrate de tener instalados los siguientes software en tu máquina:

1. **PHP** (versión 7.4 o superior, puedes instalarlo usando Homebrew)
2. **MySQL** (puedes instalarlo usando Homebrew)
3. **Git** (para clonar el repositorio)

### Instalación de PHP y MySQL usando Homebrew

Si no tienes Homebrew instalado, puedes instalarlo usando el siguiente comando en tu terminal:

```sh
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

Luego, instala PHP y MySQL:

```sh
brew install php
brew install mysql
```

### Clonar el Repositorio

Clona el repositorio del proyecto desde GitHub:

```sh
git clone https://github.com/rolandomarzano/facturacion-sistema-votacion.git
cd facturacion-sistema-votacion
```

### Configuración de la Base de Datos

Inicia el servicio de MySQL:

```sh
brew services start mysql
```

Accede a MySQL desde la terminal:

```sh
mysql -u root -p
```

Crear la base de datos, tablas e inserción de datos que se encuentran en el archivo **database.sql**

### Ejecutar el proyecto

Para iniciar el servidor web nativo de PHP, navega al directorio del proyecto y ejecuta:

```sh
php -S localhost:8000
```

Abre tu navegador y ve a **http://localhost:8000** para ver la aplicación en funcionamiento.

#### Versiones utilizadas

- PHP: 8.3.9
- MySQL: 8.3.0
