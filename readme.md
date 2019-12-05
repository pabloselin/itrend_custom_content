# ITREND Custom Content

Interfaz de administración para actores de Itrend

## Instalación

Este plugin de WordPress depende de los siguientes plugins:
	- CMB2
	- CMB2 Conditional Logic
	- CMB2 Field Type: Attached Posts
	- CMB2 Taxonomy
	- Enter Title Here Changer

Deben estar instalados y activados para tener la funcionalidad completa
En la activación del plugin se crean automáticamente los términos para la taxonomía de Alcance Territorial

## Uso

El plugin crea una serie de custom posts, taxonomías y campos personalizados (custom_fields) que pueden ser llamados con funciones estándar de WordPress.

### Tipo de Contenido

El tipo de contenido para actores es:

actor

### Taxonomías

Se crean además las siguientes taxonomías:

sector
alcance_territorial
tareas
acciones_grrd

Todas las taxonomías son jerárquicas


### Campos personalizados

La lista de los campos es la siguiente:

'codigo', //Texto unico

'mision', // Texto con formato

'institucion_depende', // Array de IDS

'contactopersona_nombre', //Texto unico

'contactopersona_cargo', //Texto unico

'contactopersona_correo', //Texto multiple

'contactopersona_telefono', //Texto multiple

'contacto_nombre', //Texto unico

'contacto_cargo', //Texto unico

'contacto_telefono', //Texto multiple

'contacto_region',//Valor de select input,

'contacto_comuna', //Valor de select input,

'contacto_direccion', //Texto unico,

'contacto_correo', // Texto multiple,

'contacto_web', // Texto unico

Los campos tienen un prefijo para mayor diferenciación, el prefijo está creado en la constante ITREND_PREFIX

### Campos personalizados dinámicos

El plugin crea además campos personalizados dinámicos para añadir descriptores a las tareas y acciones GRRRD asociadas a cada actor. El nombre de los campos personalizados dinámicos tiene la siguiente estructura:

En Tareas:

[prefijo]descripcion_relacion_tarea_[term_slug]

En Acciones GRRD:

[prefijo]descripcion_relacion_accion_[term_slug]

## Funciones utilitarias

De momento se proporcionan dos funciones utilitarias para obtener los campos personalizados

*itrend_get_actor_fields()*
Devuelve los nombres de todos los campos personalizados

*itrend_get_actor_metadata( $actorid, $field )*

Devuelve los campos o campo asociado a un actor basado en su ID

*itrend_actor_fields_shortcode()* - incompleta
Muestra toda la información de los campos personalizados en el frontend mediante un shortcode 

IMPORTANTE: Las funciones aún no han sido probadas.



## Autores

* **Pablo Selín Carrasco Armijo** - *Desarrollo* - [APie](https://github.com/pabloselin)
* **Jorge Loayza Charad** - *Estructura y revisión de interfaz* - [APie](https://apie.cl)