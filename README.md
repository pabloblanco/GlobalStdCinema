# GlobalStdCinema

Desarrollo de evaluación para la empresa Global Standard

El ejercicio debe de cubrir los siguientes puntos:
                                                                               
    - Se debe desarrollar los apis de los cruds de películas y sus turnos. Se adjunta mockups a modo de guía de los campos que debería tener ambas entidades.
    - Se debe realizar la maquetación de un administrador en base a lo propuesto en el mockup adjunto (Películas y Turnos).
    - La sección asignar turnos a películas queda a tu criterio.
    - Para el desarrollo del backend se debe utilizar Laravel.
    - Para el caso de la BD utilizar postgres.
    - El desarrollo del frontend debe realizarse usando Vue.
    - Se debe incluir inicio de sesión.
    - Para el caso de css no hay ninguna restricción respecto a las librerías a utilizar.
    - Se debe validar campos de entrada.
    - Añadir capa de seguridad para el consumo de los servicios, así como la seguridad de acceso a los módulos.
    - Se evaluará el orden en el código y buenas prácticas de programación.
    - Pruebas unitarias (opcional). 

-------------------------------------------------------------------------------------------------------------------------------------------
# Detalles tecnológicos de la solución y estándares aplicados

La estrategia que se utilizó para diseñar la aplicación se basó en el uso de contenedores con Sail de Laravel, para facilitar el despliegue. También se utilizó Inertia con el fin de integrar aún más las aplicaciones Vue, aprovechando las ventajas que este trae para mejorar la productividad, y minimizar los tiempos de desarrollo, facilitando la mantenibilidad a largo plazo, ya que estos son aspectos valorados por la emprea.

También se potenció la aplicación con Octane y un servidor Swoole. Se instaló Octane para administrar peticiones paralelas en función de los núcleos del procesador, ya que este genera un worker por cada núcleo del procesador, capaz de procesar las peticiones de forma paralela. Y se implementa Swoole para servir la solución, ya que con esta tecnología, disponible a partir de la versión 8 de PHP, se obtiene mayor rendimiento que utilizando Nginx o Apache, esto se debe a que el framework se inicia una sola vez y queda disponible para las siguientes solicitudes. Lo mismo pasa con Vite pero en el frontend de Vue, ya que proporciona un entorno de desarrollo más rápido y agrupando el código para la producción.

Para el desarrollo a nivel de código no se utilizaron recursos de sobre ingeniería, que por un lado hacen economía de código, pero por otro dificultan la lectura y posterior mantenimiento de la solución. Por lo anterior se buscó mantener el estándar PSR-2 con el fin de darle un orden estandarizado a la lectura del código.

No se usaron abreviaciones en nombres de variables, propiedades, métodos o clases, que dificultaran la lectura y entendimiento de su función dentro de la aplicación. Y para no sobre documentar el código, se usaron nombres de variables, métodos y clases que van acompañando la narrativa de las funciones que cada componente desempeña.

La aplicación sigue las recomendaciones de Laravel en cuanto a distribución de archivos, nomenclaturas de variables, métodos, clases, rutas, modelos y sus campos, así como el mantenimiento de sus principios S.O.L.I.D.

Se desarrollaron pruebas funcionales y unitarias, para permitir revisar su cobertura, por medio de Xdebug, incluso permitirían probar los beneficios de Octane, por medio de la gestión de pruebas paralelas.

La configuración del entorno de la BD está lista para ser configurada con el patrón CQRS que permite realizar la escritura y la lectura de manera independiente, con el fin de poder escalar la infraestructura de servidores de forma separada, ya sea del servidor de lectura o del de escritura.

Los aspectos de seguridad se desarrollaron mediante la implementación de una estructura básica de autenticación por medio del middleware proporcionado por el paquete de Laravel Breeze.

-------------------------------------------------------------------------------------------------------------------------------------------
# Como ejecutar el proyecto

1.- Baja o clona el proyecto desde el repositorio a la carpeta que destinarás para el mismo.

![ScreenHunter 3636](https://github.com/pabloblanco/GlobalStdCinema/assets/11873645/2027a8b8-9aec-4e75-ba85-658a8d5b9a34)

2.- Verifica que docker este corriendo

    sudo systemctl status docker

    ***Colocar captura de pantalla de consola

3.- Levanta la imagen desde la carpeta raiz del proyecto

    En Linux ==> ./vendor/bin/sail up
    En Windows desde la consola de WSL ==> vendor\bin\sail up

    ***Colocar captura de pantalla de consola

    Puedes verificar que la imagen esta corriendo correctamente en el Docker Desktop
    
4.- Abre la aplicacion en el navegador

    url ==> localhost

    ***Colocar captura de pantalla del browser
    
5.- Registra un usuario

    ***Colocar captura de pantalla del browser
    
6.- Inicia sesión

    ***Colocar captura de pantalla del browser
    
7.- Crea un registro para película

    ***Colocar captura de pantalla del browser
    
8.- Crea un registro para turno

    ***Colocar captura de pantalla del browser
    
9.- Asigna un turno a la película

    ***Colocar captura de pantalla del browser
    
10.- Edita la información de la película

    ***Colocar captura de pantalla del browser
    
11.- Edita la información de un turno

    ***Colocar captura de pantalla del browser
    
12.- Edita el turno de una película

13.- Borra la asiganción del turno a la película.

    ***Colocar captura de pantalla del browser
    
14.- Elimina la información del turno

    ***Colocar captura de pantalla del browser
    
15.- Elimina la información de la película

    ***Colocar captura de pantalla del browser
    
---------------------------------------------------------------------------------------------------------------------------------------------------------------------
# Pruebas del desarrollo

## Análisis estático del código

Para realizar el análisis estático del código de la aplicación se configura la variable level, dentro del archivo phpstan.neon, en niveles de 1 a 9, siendo este último el de más alto nivel, como se muestra a continuación:

        includes:
            - ./vendor/nunomaduro/larastan/extension.neon

        parameters:

            paths:
                - app/

            # Level 9 is the highest level
            level: 9

        #    ignoreErrors:
        #        - '#PHPDoc tag @var#'
        #
        #    excludePaths:
        #        - ./*/*/FileToBeExcluded.php
        #
        #    checkMissingIterableValueType: false

Luego desde la terminal, en el directorio o carpeta raiz del proyecto, se ejecuta el siguiente comando que muestra los errores a depurar, en caso de que haya.

        Para Linux ==> ./vendor/bin/phpstan analyse

        Para Windows ==> vendor\bin\phpstan analyse

***Colocar captura de pantalla de resultados

## Pruebas unitarias y funcionales

Para correr las pruebas, tanto funcionales como unitarias, ejecute el siguiente comando artisan desde la terminal:

    php artisan test 

***Colocar captura de pantalla de resultados

Es importante destacar que la primera vez que se ejecuta, la respuesta de Time es mucho mayor a la que refleja la segunda ejecución, ya que en la segunda entra en juego la estrategia Octane-Swoole, y se refleja inmediatamente el aumento de la performance de la aplicación, ya que, como se comentó al principio, el framawork queda disponible para las siguientes solicitudes.

## Pruebas en la base de datos

Para revisar que si la información se esta guardando de forma correcta en la BD, abre la consola de Postgres en el navegador:

    url              ==> localhost:5050
    email address    ==> pa_blanco@hotmail.com
    Password         ==> password

----------------------------------------------------------------------------------------------------------------------------------------------------------------------
# Recursos externos

Colección de pruebas para Postman:

----------------------------------------------------------------------------------------------------------------------------------------------------------------------
