# TPE_2_WEB-2

Este archivo README.md  va a tener la descripcion de los endpoint , como se utilizan y ejemplos de estos

### Aclaracion sobre URL
*En mi URL la parte /TPE2/ indica el nombre de la carpeta donde guardo este trabajo dentro de htdocs*
*Dependiendo el nombre de la carpeta en el que se este guardando esa parte de la url se debe modificar*

[========]


## GET
#####  url = http://localhost/TPE2/api/canciones
Metodo= GET , Url=http://localhost/TPE2/api/canciones

- Con el metodo get y la url que se encuentra aca arriba vamos a listar la coleccion de entidades que se encuentran en mi tabla
- *Ejemplo* = http://localhost/TPE2/api/canciones


### Puntos opcionales:
#### Paginacion (punto 7)
##### -url = http://localhost/TPE2/api/canciones?pagina=NroDePagina
- Se debe generar un parametro GET de nombre **"pagina"** con signo ? al empezar, como lo indica en la url y luego se debe poner como valor la pagina a la que quiero acceder. En este caso hay un limite de 2 elementos de pagina y en mi tabla hay 4 de estos. En consecuencia hay dos paginas (pagina=1 y pagina=2). Si se agregan mas elementos este numero de paginas crecera.

- *Ejemplo* = http://localhost/TPE2/api/canciones?pagina=1

------------

#### Filtrado (punto 8)
##### -url = http://localhost/TPE2/api/canciones?anio=añoPorElQueQuieroFiltrar
- Se debe generar un parametro GET de nombre **"anio"** con signo ? al empezar, como lo indica en la url y luego se debe poner como valor el año de canciones que se quieren filtrar. Solo se traeran las canciones que tenan el año elegido. Los años que se pueden usar son **1969** , **1965** , **1996** y **1997** ya que son los años de los elementos que tiene mi tabla. En el caso de agregar mas elementos estos tambien se podran filtrar por el año que les pertenece.
- *Ejemplo* = http://localhost/TPE2/api/canciones?anio=1997
- *Ejemplo* = http://localhost/TPE2/api/canciones?anio=1965

------------

#### Ordenmiento (punto 9)
##### -url = http://localhost/TPE2/api/canciones?orden=columna&forma=formaEnQueSeOrdena
**El punto 3 se incluye en este punto opcional**
- Se debe generar un parametro GET de nombre **"orden"** con signo ? al empezar, como lo indica en la url y luego como valor se agrega la columna por la que se quiere ordenar. Luego de este se puede agregar **"&"** que indica otro que habra otro parametro y **"forma"** , en el que ira como valor si se quiere ordenar ascendentemente indicando "asc" y descendentemente "desc". Las columnas por las que se pueden ordenar son "id", "nombre", "genero", "anio", "comentario".
- *Ejemplo* = http://localhost/TPE2/api/canciones?orden="anio"
*En este caso se ordena ascendente por defecto*
- *Ejemplo* = http://localhost/TPE2/api/canciones?orden="nombre"&forma="desc"

[========]


## GET/:ID
#####  url = http://localhost/TPE2/api/canciones/ID
Metodo= GET , Url=http://localhost/TPE2/api/canciones/ID

- Con el metodo get y la url que se encuentra aca arriba vamos a traer el elemento de la tabla que tenga el id que mandamos.  Los elementos que la tabla tiene incluidos ahora tienen los siguientes **id** = **3** , **11** , **12** y **15**. En el caso de agregar mas elementos revisar tabla para ver que id tiene los nuevos.
- *Ejemplo* = http://localhost/TPE2/api/canciones/3
- *Ejemplo* = http://localhost/TPE2/api/canciones/15

[========]

## POST
#####  url = http://localhost/TPE2/api/canciones
Metodo= POST , Url=http://localhost/TPE2/api/canciones

- Con el metodo POST y la url que se encuentra aca arriba vamos a poder subir un elemento nuevo a la tabla. Para eso en el body de postman se debe introducir una estructura igual a esta, 
Ej:
- {
    "nombre":"ejemplo",
    "anio":2022,
    "genero":"rock",
    "artista_id":1  
}

- Se deben completar todos los campos que se muetran en este ejemplo para que agregar un elemento corretamente, tambien se puede agregar el campo **comentario** en el que su valor va a ser un comentario para la cancion, si no se agrega no pasa nada ya que su valor inicial es null.
- En el caso del campo **artista_id** solo se van a introducir los siguientes valores : **1** , **2** y **14**. Ya que estos son los id de los elementos de la tabla artista a la cual esta conectada. Si no se pone alguna de estas opciones no dejara agregar el elemento.

- *Ejemplo* = http://localhost/TPE2/api/canciones
- {
    "nombre":"ejemplo",
    "anio":ejemplo,
    "genero":"ejemplo",
    "artista_id":2  
}

[========]

## PUT
#####  url = http://localhost/TPE2/api/canciones/:ID
Metodo= PUT , Url=http://localhost/TPE2/api/canciones/:ID

- Con el metodo PUT y la url que se encuentra aca arriba vamos a poder editar el campo **comentario** del elemento que tenga el **ID** que le pasamos. Para eso en el body de postman se debe introducir una estructura igual a esta, 
Ej:
- {
    "comentario":"ejemplo de comentario"
}

- El campo **comentario** empieza con valor null. Se va a poder editar simulando un agregar comentario a la cancion seleccionada por su **ID** los valores de los id pueden ser **id** = **3** , **11** , **12** y **15**.En el caso de agregar mas elementos revisar tabla para ver que id tiene los nuevos.

- *Ejemplo* = http://localhost/TPE2/api/canciones/11
- {
    "comentario":"ejemplo"
}
