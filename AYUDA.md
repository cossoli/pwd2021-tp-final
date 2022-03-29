# Configuración del entorno y comandos útiles

> Volver al [**Documento inicial**](README.md).

## Configurar como ejecutables los archivos de sincronización de repo

```sh
chmod 755 configs/*.sh
```

1. (Por única vez) Ejecutar el archivo de configuración del repo padre:

```sh
./configs/config_repo_padre
```

2. Ejecutar el comando de rebase:

```sh
./configs/rebase
```

## Comandos útiles

Todos deben correrse en una consola en la carpeta raíz de este proyecto.

- `composer run migrar` para recrear las tablas.
- `composer run hidratar` para llenar de datos las tablas.
- `./scripts/listar-rutas` para listar las rutas con los verbos HTTP asociados.
- `yarn dev` para levantar el servidor de desarrollo.

## Uso del comando cURL

- **AYUDA**: para conceptos de HTTP pueden buscar el **Apunte: Arquitectura cliente-servidor** que hay en la plataforma PEDCO en la unidad 1.

## Comando para leer datos del servidor

Ejemplo utilizando la operación de listado de jugadores:

> NOTA: si no tienen instalado el comando `jq`, instálenlo.
>
> - Windows: `scoop install jq`
> - Ubuntu: `sudo apt install jq`
>
> JQ Es un visualizador de JSON en la consola.

```sh
curl --request GET http://localhost:8080/api/jugadores | jq .
```

- `--request`: describe el verbo HTTP a utilizar en la operación. En este ejemplo es `GET`.

### Comando para enviar datos al servidor

Ejemplo utilizando la operación de creación de un nuevo jugador:

```sh
curl --header "Content-Type: application/json" --request POST --data "{\"nombre\":\"Olis\"}" http://localhost:8080/api/jugadores
```

- `--header`: describe una cabecera para la operación. En este caso le estamos notificando que el contenido que le vamos a enviar al servidor es del tipo JSON.
- `--request`: describe el verbo HTTP a utilizar en la operación. En este ejemplo es `POST`.
- `--data`: describe el contenido a enviar al servidor. En este caso es un string JSON válido. Si quieren transformar rápido un arreglo asociativo de PHP a un string JSON válido, acá les dejo un script rápido: https://3v4l.org/9bPrs.

## Operaciones útiles de SQL

### Formatear una fecha para que sea ISO-8601 válida

Esto es necesario porque sino la clase `Brick\DateTime\LocalDateTime`, al intentar parsear el dato de la fecha, fallará.

```sql
DATE_FORMAT(ingreso, '%Y-%m-%dT%T') t.col
```

Ejemplo:

```sql
SELECT t.*, DATE_FORMAT(ingreso, '%Y-%m-%dT%T') col
FROM mi_tabla t
WHERE
```

## Cómo correr los tests

Recuerden que para ejecutar los tests, al menos en VSCode, deben:

1. Ir al ícono del "bichito + el de play".
2. Seleccionar cualquiera de las dos opciones ("Test archivo actual" o "Todos los tests").
3. Abrir el archivo de tests que quieran ejecutar.
4. Darle clic al botón verde de play o apretar F5.

## Configuración inicial

Antes de poder programar cualquier cosa, necesitaremos inicializar las distintas herramientas. Para ello se debe hacer lo siguiente:

#### Inicializar composer y yarn

1. Acceder a la terminal.
2. Ir a la carpeta del proyecto.
3. Ejecutar `composer install`. Este comando se encargará de instalar todas las dependencias definidas en el archivo `composer.json`. Sin este paso, nada funcionará.
4. Ejecutar `yarn install`.

#### Crear archivo de variables de entorno

1. Copiar el archivo `.env.ejemplo` y renombrarlo a `.env`.
2. Acceder al archivo `.env` y editar los valores de las variables `DB_USER` y `DB_PASS`. Estas dos variables serán utilizadas en la aplicación para conectarse a la Base de Datos.
   - `DB_USER` deberá tener asignado el nombre del usuario con el que se conectan a la Base de Datos.
   - `DB_PASS` deberá tener la contraseña que utilizan para conectarse a la BD con el usuario anterior. Si no configuraron contraseña, dejarla como string vacío.

#### Crear la base de datos

1. Acceder a la consola de MariaDB desde la terminal. Para ello deben ejecutar el siguiente comando:
   - Si tienen un usuario con contraseña:
     ```sh
     mysql -u nombre_del_usuario -p
     ```
   - Si tienen un usuario sin contraseña:
     ```sh
     mysql -u nombre_del_usuario
     ```
   - Si no crearon un usuario específico, pueden utilizar el usuario **root**.
2. Crear la base de datos. Para ello, pueden copiar el código SQL que hay en el archivo `creacion-db.sql`, pegarlo en la consola SQL y ejecutarlo.

#### Crear las tablas y los datos

1. Acceder a la terminal.
2. Ir a la carpeta del proyecto.
3. Ejecutar `composer run migrar`. Este comando se de crear todas las tablas.
4. Ejecutar `composer run hidratar`. Este comando se de crear todos los datos iniciales.

#### Crear una migración

> NOTA: ante la duda de qué o cómo resolver la migración, consultar en el canal **#dudas-tp-final** del discord.

1. Ejecutar `composer run crear:migracion <nombre_de_la_migracion>`, donde `<nombre_de_la_migracion>` debe estar en minúsculas y separado por guiones bajos. Debe describir la acción de la migración. Ejemplos:
   - **agrega_tabla_competencias**
   - **modifica_tabla_jugadores**
   - **actualiza_columna_XXXXXXX_en_jugadores**
2. Acceder al nuevo archivo y escribir el código SQL para la operción de hacer (**up**) y deshacer (**down**) la migración.

## Nota de interés

Este esqueleto está construido con las siguientes tecnologías:

- Diseño MVC.
- [Slim framework](https://www.slimframework.com/): es responsable de manejar la comunicación HTTP: rutas, middlewares para proceso de JSON y de los verbos HTTP para cada ruta.
- [Brick\DateTime](https://github.com/brick/date-time): librería para manejo de fechas inmutables. Lo de inmutabilidad es super importante porque significa que las instancias no cambian su contenido interno al realizar una operación sobre ellas, sino que crean una nueva instancia.
- [Dotenv](https://github.com/vlucas/phpdotenv): librería para leer archivos `.env` y similares y cargar los datos en las variables globales.
- [EndyJasmi\Cuid](https://github.com/endyjasmi/cuid): es una librería generar ids únicos a nivel profesional/global. Esta librería permite que la BD delegue el trabajo de generar IDs únicos al servidor o hasta al cliente. Se utilizó para mantener el diseño orientado a objetos lo más correcto posible. Esto se debe a que son los objetos realmente los responsables de generar su código de identificación único.
- [VueJS](https://v3.vuejs.org/): framework de vistas basado en el paradigma de componentes. Este paradigma define que todo elemento de la web puede considerarse un componente, es decir, un elemento aislado que contiene HTML, CSS y JS propio y exclusivo. VueJS tienen un enfoque de "**un componente por archivo**" (_Single File Component_, o **SFC**).
- [Vite](https://vitejs.dev/): herramienta de desarrollo y buildeo de aplicaciones web. Se usa para integrar la aplicación web con el servidor, poder levantar el servidor de desarrollo.
- [Typescript](https://www.typescriptlang.org/): lenguaje tipado que compila a JS. Es JS válido con aditivo de tipado. Facilita tanto el desarrollo como la confianza en el código.

Todas estas librerías son herramientas profesionales que podrían llegar a utilizar en algún desarrollo personal o laboral.
