# API REST para el recurso de productos
Una API REST sencilla para manejar un CRUD de productos

## Importar la base de datos
- importar desde PHPMyAdmin (o cualquiera) database/db_tasks.php


## Prueba los servicios con POSTMAN
El endpoint de la API es: http://localhost/tucarpetalocal/tpe_web2/api/products


## Probar el servicio GET para obtener todos los productos:

1. Selecciona el método a probar, en este caso probaremos el GET.
2. Teclea la URL a probar http://localhost/tucarpetalocal/tpe_web2/api/products.
3. Da clic en el botón SEND.
4. Abajo en la pestaña de Body vemos los arreglos JSON con todos los productos.

## Probar el servicio GET para obtener un producto por ID:

1. Seleccionar el método GET.
2. Teclear la URL http://localhost/tucarpetalocal/tpe_web2/api/products/1 donde 1 es el ID del registro que deseas consultar.
3. Dar clic en el botón SEND.
4. Abajo puedes ver el Status en este caso fue 200 OK y regresa la categoría con el ID 1.

## Probar el servicio POST para agregar un registro:

1. Seleccionar el método POST.
2. Teclear la URL http://localhost/tucarpetalocal/tpe_web2/api/products.
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
2. Teclear la URL http://localhost/tucarpetalocal/tpe_web2/api/products/1 donde 1 es el ID del registro que deseas modificar.
3. Seleccionar la pestaña Body.
4. Seleccionar la opción raw.
5. Seleccionar el tipo JSON (application/json).
6. Teclear el objeto JSON a modificar.
7. Dar clic en el botón SEND.
8. Abajo puedes ver el Status en este caso fue 200 OK y regresa un mensaje que se realizó con éxito y también el registro 
modificado.

## Probar el servicio DELETE:

1. Seleccionar el método DELETE.
2. Teclear la URL http://localhost/tucarpetalocal/tpe_web2/api/products/1 donde 1 es el ID del registro que deseas borrar.
3. Dar clic en el botón SEND.
4. Abajo puedes ver el Status en este caso fue 200 OK y regresa un mensaje de que se eliminó con éxito.

## RECORDAR QUE PARA REALIZAR EL SERVICIO POST Y PUT SE DEBE TENER UN TOKEN DE AUTHORIZATION.

Para ello, se deben seguir los siguientes pasos:

1. Selecciona el método GET.
2. Teclea la URL para realizar TOKEN http://localhost/tucarpetalocal/tpe_web2/api/auth/token.
3. Abajo en la pestaña de Authorization ingresaremos el Type "Basic Auth".
4. Luego ingresaremos el Username y Password.
# Si esto es válido:
1. Da clic en el botón SEND.
2. Abajo en la pestaña de Body veremos el TOKEN.
3. Copiar el TOKEN.
4. Seleccionar el método POST / PUT.
5. Redirigirse a la URL http://localhost/tucarpetalocal/tpe_web2/api/products (POST) / http://localhost/tucarpetalocal/tpe_web2/api/products/1 (PUT).
6. Abajo en la pestaña de Authorization ingresaremos el Type "Bearer Token".
7. Pegar el TOKEN.
8. Seguir las indicaciones del Servicio POST / PUT.
# Si esto es incorrecto:
1. Abajo en la pestaña de Body veremos un mensaje de que lo escrito no coincide con lo registrado.
