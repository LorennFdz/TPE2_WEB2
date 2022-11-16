# API REST para el recurso de productos
Una API REST sencilla para manejar un CRUD de productos

## Importar la base de datos
- importar desde PHPMyAdmin (o cualquiera) database/db_tpe.sql


## Prueba los servicios con POSTMAN
El endpoint de la API es: http://localhost/tucarpetalocal/tpe2_web2/api/products


## Probar el servicio GET para obtener todos los productos:

1. Selecciona el método a probar, en este caso probaremos el GET.
2. Teclea la URL a probar http://localhost/tucarpetalocal/tpe2_web2/api/products.
3. Da clic en el botón SEND.
4. Abajo en la pestaña de Body vemos los arreglos JSON con todos los productos.

## Probar el servicio GET para obtener un producto por ID:

1. Seleccionar el método GET.
2. Teclear la URL http://localhost/tucarpetalocal/tpe2_web2/api/products/1 donde 1 es el ID del registro que deseas consultar.
3. Dar clic en el botón SEND.
4. Abajo puedes ver el Status en este caso fue 200 OK y regresa la categoría con el ID 1.

## Probar el servicio POST para agregar un registro:

1. Seleccionar el método POST.
2. Teclear la URL http://localhost/tucarpetalocal/tpe2_web2/api/products.
3. Seleccionar la pestaña Body.
4. Seleccionar la opción raw.
5. Seleccionar el tipo JSON (application/json).
6. Teclear el objeto JSON a agregar.
7. Dar clic en el botón SEND.
8. Abajo puedes ver el Status en este caso fue 201 Created y en el Body te regresa el JSON del producto insertado. Si vuelves a
probar el servicio GET, obtendrás el producto recién creada. Del lado izquierdo en la pestaña History se va guardando la lista de
servicios llamados por sí lo deseas volver a llamar.

## Probar el servicio PUT para modificar un registro:

1. Seleccionar el método PUT.
2. Teclear la URL http://localhost/tucarpetalocal/tpe2_web2/api/products/1 donde 1 es el ID del registro que deseas modificar.
3. Seleccionar la pestaña Body.
4. Seleccionar la opción raw.
5. Seleccionar el tipo JSON (application/json).
6. Teclear el objeto JSON a modificar.
7. Dar clic en el botón SEND.
8. Abajo puedes ver el Status en este caso fue 200 OK y regresa un mensaje que se realizó con éxito y también el registro 
modificado.

## Probar el servicio DELETE:

1. Seleccionar el método DELETE.
2. Teclear la URL http://localhost/tucarpetalocal/tpe2_web2/api/products/1 donde 1 es el ID del registro que deseas borrar.
3. Dar clic en el botón SEND.
4. Abajo puedes ver el Status en este caso fue 200 OK y regresa un mensaje de que se eliminó con éxito.

## RECORDAR QUE PARA REALIZAR EL SERVICIO POST Y PUT SE DEBE TENER UN TOKEN DE AUTHORIZATION.

Para ello, se deben seguir los siguientes pasos:

1. Selecciona el método GET.
2. Teclear la URL para realizar TOKEN http://localhost/tucarpetalocal/tpe2_web2/api/auth/token.
3. Abajo en la pestaña de Authorization ingresaremos el Type "Basic Auth".
4. Luego ingresaremos el Username y Password.
# Si esto es válido:
1. Da clic en el botón SEND.
2. Abajo en la pestaña de Body veremos el TOKEN.
3. Copiar el TOKEN.
4. Seleccionar el método POST / PUT.
5. Redirigirse a la URL http://localhost/tucarpetalocal/tpe2_web2/api/products (POST) / http://localhost/tucarpetalocal/tpe2_web2/api/products/1 (PUT).
6. Abajo en la pestaña de Authorization ingresaremos el Type "Bearer Token".
7. Pegar el TOKEN.
8. Seguir las indicaciones del Servicio POST / PUT.
# Si esto es incorrecto:
1. Abajo en la pestaña de Body veremos un mensaje de que lo escrito no coincide con lo registrado.

## Probar el servicio GET para obtener todos los productos paginado:

1. Selecciona el método GET.
2. Teclear la URL http://localhost/web2/tpe2_web2/api/products
3. Abajo en la pestaña de Params escribir en KEY: 'page' y en VALUE: 1, además escribir en KEY: 'limit' y en VALUE: 5.
4. Se va a generar automáticamente esta URL http://localhost/web2/tpe2_web2/api/products?page=1&limit=5 donde se indican los Query
Params 'page' con valor 1 y 'limit' con valor 5.
5. Dar click en el botón SEND.
6. Abajo en la pestaña Body se visualizarán los primeros 5 productos.

## Probar el servicio GET para obtener todos los productos ordenados:

1. Selecciona el método GET.
2. Teclear la URL http://localhost/web2/tpe2_web2/api/products
3. Abajo en la pestaña de Params escribir en KEY: 'sort' y en VALUE: 'id', además escribir en KEY: 'order' y en VALUE: 'asc' ó 
'desc'.
4. Se va a generar automáticamente esta URL http://localhost/web2/tpe2_web2/api/products?sort=id&order=asc donde se indican los 
Query Params 'sort' con valor 'id' y 'order' con valor 'asc'.
5. Dar click en el botón SEND.
6. Abajo en la pestaña Body se visualizarán los productos ordenados por 'id' 'ascendentemente'.

## Probar el servicio GET para obtener todos los productos filtrados por un campo:

1. Selecciona el método GET.
2. Teclear la URL http://localhost/web2/tpe2_web2/api/products
3. Abajo en la pestaña de Params escribir en KEY: 'column' y en VALUE: 'brand', además escribir en KEY: 'filter' y en VALUE: 
'apple'.
4. Se va a generar automáticamente esta URL http://localhost/web2/tpe2_web2/api/products?column=brand&filter=apple donde se indican los Query Params 'column' con valor 'brand' y 'filter' con valor 'apple'.
5. Dar click en el botón SEND.
6. Abajo en la pestaña Body se visualizarán los productos filtrados por columna 'brand' 'apple'.

## Probar el servicio GET para obtener todos los productos paginados, ordenados y filtrados:

1. Selecciona el método GET.
2. Teclear la URL http://localhost/web2/tpe2_web2/api/products
3. Abajo en la pestaña de Params escribir en KEY: 'page' y en VALUE: '1', además escribir en KEY: 'limit' y en VALUE: '5'.
Tambien escribir en KEY: 'sort' y en VALUE: 'id', además escribir en KEY: 'order' y en VALUE: 'asc' ó 'desc'.
Nuevamente escribir en KEY: 'column' y en VALUE: 'brand', además escribir en KEY: 'filter' y en VALUE: 'apple'.
4. Se va a generar automáticamente esta URL
http://localhost/web2/tpe2_web2/api/products?page=1&limit=5&sort=id&order=asc&column=brand&filter=apple donde se indican los Query Params KEY: 'page', 'limit', 'sort', 'order', 'column' y 'filter' con sus respectivos VALUE: '1', '5', 'id', 'asc', 'brand' y 'apple'.
5. Dar click en el botón SEND.
6. Abajo en la pestaña Body se visualizarán los productos paginados, ordenados y filtrados.