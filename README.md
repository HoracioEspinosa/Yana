## Yana

### Instalar base de datos y servidor nginx
```
docker-compose up -d --remove-orphans --force-recreate
```


### Instalar dependencias

```
docker-compose run --rm --interactive --tty composer install
```

### Importar colección de Postman
```
Yana.postman_collection.json
```

En el endpoint vienen definidos todos los endpoints principalmente el de /conversations que es el default que viene en
el task, pero igual

* Primero, ejecutar el login con las credenciales default
  * Default user: horacioespinosa94@gmail.com
  * Default password: secret
* Segundo:
  * Ejecutar cualquier endpoint que se requiera, desde el crud de usuarios hasta el crud de actividades
  * Se agregó un endpoint (similar al default), para mostrar el funcionamiento por interfaces y servicios
    * /users/:idUser/activities
    * /users/:idUser/activities/:idActivity


### Nota
Verificar la imagen "Variables.png" para poder configurar las variables en postman en caso de que no funcione
el importador correctamente
