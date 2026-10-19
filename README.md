# 🐇 RABBIT HOLE

Una web sencilla para dejarse llevar por la curiosidad. Pincha en el cuadrado, descubre una imagen totalmente aleatoria y escribe lo que te hace pensar. Tu curiosidad se guarda junto a la imagen en una base de datos.

Es mi **primer proyecto web completo**: del frontend al backend, pasando por la base de datos.

## ¿Qué hace?

1. Al abrir la página aparece un cuadrado con la pregunta **"¿Qué me dices de...?"**.
2. Al pincharlo, se muestra una **foto aleatoria** de [Picsum Photos](https://picsum.photos/). Ninguna está elegida por mí.
3. Debajo hay un cuadro de texto que **crece solo** (en ancho y en alto) a medida que escribes.
4. Al pulsar **Guardar**, la web comprueba que has elegido una imagen y escrito algo, y envía los datos al servidor.
5. El servidor descarga **la misma imagen** que estás viendo, la guarda en la carpeta `imagenes/` y almacena el texto y la ruta de la imagen en **MySQL**.

## Tecnologías

| Parte | Tecnología |
|---|---|
| Estructura y estilos | HTML5 y CSS3 |
| Interacción (DOM) | JavaScript (`fetch`, eventos) |
| Servidor | PHP (`mysqli`, sentencias preparadas) |
| Base de datos | MySQL (phpMyAdmin) |
| Entorno de desarrollo | XAMPP |
| Imágenes aleatorias | [Picsum Photos](https://picsum.photos/) |

## Cómo funciona cada archivo

| Archivo | Qué hace |
|---|---|
| `curio.html` | Página principal: título, cuadrado de imagen, cuadro de texto y botón Guardar. |
| `file.css` | Estilos: fondo, marcos dorados, tipografías (Playfair Display y Quicksand) y diseño centrado. |
| `fondo.jpg` | Imagen de fondo de la página. |
| `script.js` | Al pinchar el cuadrado genera una semilla con `Date.now()` y carga la imagen. Hace crecer el cuadro de texto. Al guardar, envía el texto y la semilla a `guardar.php` con `fetch`. |
| `guardar.php` | Recibe los datos en JSON, descarga la imagen con esa semilla, la guarda en `imagenes/` e inserta una fila en la tabla `curiosidades`. |
| `conexion.php` | Conexión a MySQL con `mysqli` (juego de caracteres `utf8mb4`). |
| `prueba.php` | Script de prueba: inserta una fila de ejemplo para comprobar que la conexión funciona. |
| `imagenes/` | Carpeta donde se guardan las imágenes descargadas. |

## Base de datos

Base de datos `rabbit_hole`, con una tabla `curiosidades`:

```sql
CREATE DATABASE rabbit_hole CHARACTER SET utf8mb4;
USE rabbit_hole;

CREATE TABLE curiosidades (
  id INT AUTO_INCREMENT PRIMARY KEY,
  texto TEXT NOT NULL,
  imagen VARCHAR(255) NOT NULL
  fecha DATETIME DEFAULT CURRENT_TIMESTAMP
);
```
La columna fecha se rellena automáticamente con el momento en que se guarda cada curiosidad.

## Cómo ejecutarlo en local

1. Instala [XAMPP](https://www.apachefriends.org/) y arranca **Apache** y **MySQL**.
2. Copia la carpeta del proyecto dentro de `htdocs`.
3. Abre **phpMyAdmin** y ejecuta el script SQL de arriba.
4. Comprueba que existe la carpeta `imagenes/` dentro del proyecto. Si no, créala.
5. Abre `http://localhost/<nombre-de-la-carpeta>/curio.html` en el navegador.
6. (Opcional) Abre `prueba.php` para comprobar que la conexión con la base de datos funciona.

> **Notas:**
> - Hace falta conexión a internet, porque las imágenes vienen de Picsum.
> - La parte visual (imagen aleatoria y cuadro de texto) funciona abriendo `curio.html` directamente. Guardar las curiosidades necesita PHP y MySQL, por eso hay que usar XAMPP.
> - `conexion.php` usa el usuario `root` sin contraseña, que es la configuración por defecto de XAMPP en local.

## Lo que he aprendido

- A manipular el **DOM** con JavaScript por primera vez: eventos, estilos y elementos de la página.
- A enviar datos desde el navegador al servidor con `fetch` y JSON.
- A conectar una página web con una **base de datos** usando PHP y `mysqli`.
- A usar **sentencias preparadas** para guardar datos en MySQL.
- A descargar y guardar archivos desde el servidor.

## Posibles mejoras

- Mostrar en la propia web las curiosidades ya guardadas (un `listar.php`).
- Validar la semilla en `guardar.php` (aceptar solo números) antes de usarla en la URL y en el nombre del archivo.
- Usar un usuario de MySQL propio, con contraseña, en lugar de `root`.
- Sustituir los `alert` por mensajes dentro de la propia página.

## Autora

**Claudia García Basilio**, estudiante de Desarrollo de Aplicaciones Multiplataforma (DAM).
[LinkedIn](https://www.linkedin.com/in/claudia-garc%C3%ADa-basilio-0898103a8)
