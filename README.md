Privado
Este repositorio contendrá el código fuente del proyecto para exámen privado además de la documentación respecto a su 
creación.

Aspectos Técnicos:

PC:


Lenguajes:
- PHP
- JavaScript
- CSS3
- HTML5
- PL/SQL

Base de Datos

- Oracle 11g XE

Descripción de la arquitectura: El proyecto fue montando sobre una computadora física que utiliza como motor de 
virtualización VMWare WorkStation 11, se instalaron 2 máquinas virtuales, cada una con la distribución de 
Linux Mint 17.1 Rebecca, en uno de los servidores se ha instalado El servidor de bases de datos mientras que en 
el otro un servidor Apache y PHP, manteniendo de esta forma el desarrollo en capas solicitado.
El ambiente de desarrollo del mismo proyecto ha sido la computadora en físico, se ha conectado a través de carpetas 
compartidas utilizando Samba para la fácil edición de código. Además se ha utilizado GitHub como servidor de 
versionamiento utilizando Git de forma local en la VM que contiene la lógica del negocio, así pues todo el trabajo 
queda a salvo y diferentes copias del mismo para su posterior modificación por branches.

Diseño Responsivo Como parte de los requerimientos del sistema se ha solicitado que el mismo pueda ser accedido a 
través de dispositivos móviles, debido a esto se ha desarrollado una webapp con Bootstrap, de tal forma que toda 
la interfaz cuenta con diseño responsivo proporcionando así libertad de dispositivos, sean estos teléfonos móviles, 
tabletas o pc's.
