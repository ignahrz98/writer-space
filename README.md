# WriterSpace

WriterSpace es un sistema donde se puede redactar y publicar artículos de todo tipo.

## ¿Cómo instalar y configurar?

La instalación se realiza copiando todo el contenido de la carpeta **"writer-space"** en la raiz de su servidor. 

Posteriormente, deberá cargar el archivo de la base de datos "**writer-space.sql**", no necesita crear la base de datos manualmente, ya que el archivo **.sql** lo crea automáticamente.

## Personalizar la configuración de la base de datos.

Si usted desea cambiarle el nombre a la base de datos, o tiene la configuración de  usuario de la base de datos diferente a la de por defecto, proceda a realizar lo siguiente:

El archivo **.php** que contiene la información para conectar y operar la base de datos se encuentra en "**core/controller/datos-de-la-bd.php**". Usted debe cambiar los valores que retornan los métodos estáticos por los que correspondan en su instalación localhost o servidor online.

## Primer uso.
	
El archivo **.sql** contiene solamente las tablas que hacen posible a WriterSpace, por lo tanto, lo primero que se debe realizar es registrar un nuevo usuario y empezar a usar el sistema normalmente.