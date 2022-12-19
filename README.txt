@titulo: WriterSpace
@a�o: 2021
@autor: Ignacio Hern�ndez

- 1. �Qu� es WriterSpace?

	R: WriterSpace es un sistema donde se puede redactar y publicar art�culos de todo tipo.

- 2. �C�mo instalar y configurar?

	R: La instalaci�n se realiza copiando todo el contenido de la carpeta "writer-space" en la raiz de su servidor. 

	Posteriormente, deber� cargar el archivo de la base de datos "writer-space.sql", no necesita crear la base de datos manualmente, ya que el archivo .sql lo crea autom�ticamente.

- 3. Personalizar la configuraci�n de la base de datos.

	R: Si usted desea cambiarle el nombre a la base de datos, o tiene la configuraci�n de  usuario de la base de datos diferente a la de por defecto, proceda a realizar lo siguiente:

	El archivo .php que contiene la informaci�n para conectar y operar la base de datos se encuentra en "core/controller/datos-de-la-bd.php". Usted debe cambiar los valores que retornan los m�todos est�ticos por los que correspondan en su instalaci�n localhost o servidor online.

- 4. Primer uso.
	
	R: El archivo .sql contiene solamente las tablas que hacen posible a WriterSpace, por lo tanto, lo primero que se debe realizar es registrar un nuevo usuario y empezar a usar el sistema normalmente.