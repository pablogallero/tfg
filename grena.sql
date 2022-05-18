
--
-- DAMOS PERMISO USO Y BORRAMOS EL USUARIO QUE QUEREMOS CREAR POR SI EXISTE
--
GRANT USAGE ON * . * TO `grena`@`localhost`;
DROP USER `grena`@`localhost`;

	

--
-- CREAMOS EL USUARIO Y LE DAMOS PASSWORD,DAMOS PERMISO DE USO Y DAMOS PERMISOS SOBRE LA BASE DE DATOS.
--
CREATE USER IF NOT EXISTS `grena`@`localhost` IDENTIFIED BY 'grena21';
GRANT USAGE ON *.* TO `grena`@`localhost` REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `GRENA`.* TO `grena`@`localhost` WITH GRANT OPTION;
/*CREACIÓN DE TABLAS*/
DROP DATABASE IF EXISTS `GRENA`;
CREATE DATABASE `GRENA` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
--
-- SELECCIONAMOS PARA USAR
--
USE `GRENA`;
--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE IF NOT EXISTS USUARIO(
	ID_USUARIO INT(10) AUTO_INCREMENT,
	USERNAME VARCHAR(255) NOT NULL UNIQUE,
	DNI VARCHAR(255) NOT NULL UNIQUE,
	TELEFONO VARCHAR(11) NOT NULL UNIQUE, 
	EMAIL VARCHAR(255) NOT NULL UNIQUE,
	DIRECCION VARCHAR(255) NOT NULL,
	GENERO ENUM("mujer","hombre") ,
	PASSWD VARCHAR(255) NOT NULL,
	ROL ENUM("usuario","administrador") DEFAULT "usuario",
	
	CONSTRAINT PK_USUARIO PRIMARY KEY(ID_USUARIO)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("administrador","12345678Z","988123455","admin@gmail.com","ClubPadel","mujer","holahola","administrador");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Noelia","44488043V","608473560","nghervella@esei.uvigo.es","Celanova","mujer","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Ines","32768072H","666666660","ines@gmail.com","Celanova","mujer","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Tania","18053301A","666666661","tania@gmail.com","Celanova","mujer","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Rocio","44625726E","666666662","rocio@gmail.com","Celanova","mujer","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Ainoa","91497816K","666666663","ainoa@gmail.com","Celanova","mujer","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Antia","47524280R","666666664","antia@gmail.com","Celanova","mujer","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Maria","75342221V","666666665","maria@gmail.com","Celanova","mujer","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Blanca","89236173Z","666666666","blanca@gmail.com","Celanova","mujer","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Miriam","14431247N","666666667","miriam@gmail.com","Celanova","mujer","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Iria","43747460B","666666668","iria@gmail.com","Celanova","mujer","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Lara","18095369G","666666669","lara@gmail.com","Celanova","mujer","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Angela","82870047N","666666600","angela@gmail.com","Celanova","mujer","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Alba","57515199L","666666601","alba@gmail.com","Celanova","mujer","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Isabel","73108502N","666666602","isabel@gmail.com","Celanova","mujer","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("May","34248961Y","666666603","may@gmail.com","Celanova","mujer","holahola","usuario");



INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Albovy","92802589G","655555550","albovy@gmail.com","Celanova","hombre","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Alejandro","10614506Y","655555551","alejandro@gmail.com","Celanova","hombre","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Ignacio","81172032H","655555552","nacho@gmail.com","Celanova","hombre","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("JaviZabo","03579056A","655555553","zabo@gmail.com","Celanova","hombre","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Gallero","95752404T","655555554","gallero@gmail.com","Celanova","hombre","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("JorgeRuiz","27175418K","655555555","jorgeRuiz@gmail.com","Celanova","hombre","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("JorgePerez","84520948L","655555556","jorgePerez@gmail.com","Celanova","hombre","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Pitichixo","67402532C","655555557","piti@gmail.com","Celanova","hombre","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("IvanDD","01534329E","655555558","ivan@gmail.com","Celanova","hombre","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("YerayLage","99327885Q","655555559","yeray@gmail.com","Celanova","hombre","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Nowi","23002028G","655555510","nowi@gmail.com","Celanova","hombre","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Gonzalo","46714719V","655555511","gonza@gmail.com","Celanova","hombre","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("LuisRo","70988980D","655555512","luis@gmail.com","Celanova","hombre","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Jacobo","11343110Q","655555513","jaco@gmail.com","Celanova","hombre","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Abel","71666111C","655555514","abel@gmail.com","Celanova","hombre","holahola","usuario");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Miguelon","78960771T","655555515","miguelon@gmail.com","Celanova","hombre","holahola","usuario");


CREATE TABLE IF NOT EXISTS PROYECTO(
	ID_PROYECTO INT(10) AUTO_INCREMENT,
	IMAGEN VARCHAR(255) NOT NULL,
	TITULO VARCHAR(255) NOT NULL,
	INTRODUCCION VARCHAR(7000) NOT NULL,
	OBJETIVOS VARCHAR(7000) NOT NULL,
    METODOLOGIA VARCHAR(7000) NOT NULL,
	CONCLUSIONES VARCHAR(7000) NOT NULL,
	CONSTRAINT PK_PROYECTO PRIMARY KEY(ID_PROYECTO)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO PROYECTO(TITULO,IMAGEN,INTRODUCCION,OBJETIVOS,METODOLOGIA,CONCLUSIONES) values ("Titulo de proyecto estandar","vistasallago.jpg","Desarrollamos un diálogo activo sobre la Agenda 2030 de Desarrollo Sostenible a través de consultas regionales y globales, en particular sobre: los Objetivos de Desarrollo Sostenible (ODS), los indicadores regionales y mundiales, y el seguimiento de los marcos para el desarrollo sostenible. La red moviliza a sus miembros y colaboradores en España para contribuir al discurso global en torno a la Agenda 2030. Cada año, nuestra red publica el informe Sustainable Development Report, con un ranking que muestra el grado de cumplimiento de los ODS en todos los países del mundo.",
"Compromiso estratégico con la formulación y ejecución de políticas nacionales, regionales y locales para fomentar y poner en práctica la Agenda 2030. REDS centra su actividad en la incidencia política, a través de la participación en órganos consultivos como el Consejo de Desarrollo Sostenible (comisión permanente) o el Consejo 2030 de Barcelona, entre otros. Con el fin de dar apoyo a los gobiernos locales, REDS publica el informe Los ODS en 100 ciudades españolas con carácter bienal y organiza debates alrededor de sus resultados. También acompaña a las corporaciones municipales en la realización de diagnósticos ODS.

Herramientas para la implementación y medición de los ODS en",
"REDS ha puesto en marcha el uso de herramientas que apoyen a las universidades en la implementación de los ODS: tres informes sobre medición, buenas prácticas y cómo acelerar la educación en los ODS en las universidades españolas. En el sector del turismo, cabe destacar el lanzamiento de la Guía para un turismo responsable en inglés, en colaboración con Instituto Turismo Responsable, y otros actores turísticos. Actualmente, REDS prepara una Guía para aplicar los ODS al sector cultural y lanzará próximamente en español el manual Accelerating SDG in Universities. Todos los informes publicados por REDS y SDSN puedes descargarse aquí.

Educación para el Desarrollo Sostenible",
"Participamos en diferentes iniciativas que promueven el aprendizaje conjunto y la educación para el desarrollo sostenible. A través de nuestra universidad online  la Academia de los ODS (The SDG Academy)  ofrecemos cursos on-line masivos y abiertos. Además, se ha llevado a cabo formación sobre la Agenda 2030 para distintas instituciones, entre las que destaca la impartida en el Instituto Nacional de Administraciones Públicas (INAP),  Instituto Nacional de Tecnologías Educativas y de Formación al Profesorado (INTEF), ESNE y otros posgrados. REDS ha publicado De la educación ambiental a la educación para la sostenibilidad, documento base del Plan de acción nacional de educación ambiental.");

CREATE TABLE IF NOT EXISTS VIDEOTUTORIAL(
	ID_VIDEOTUTORIAL INT(10) AUTO_INCREMENT,
	FECHA DATE NOT NULL,
	TITULO VARCHAR(255) NOT NULL,
	ENLACE VARCHAR(255) NOT NULL,
	DESCRIPCION VARCHAR(2550) NOT NULL,
	CONSTRAINT PK_VIDEOTUTORIAL PRIMARY KEY(ID_VIDEOTUTORIAL)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO VIDEOTUTORIAL(FECHA,TITULO,ENLACE,DESCRIPCION) values("2021-10-24","Cuidados sobre amapolas","https://www.youtube.com/embed/Y9GmJfxVNCM","Dentro de la familia de las Papaveraceae se halla el género Papaver, formado por unas 100 especies de plantas anuales y perennes originarias del Hemisferio Norte y de Australia. Las principales especies son: Papaver glaucum (Amapola tulipán), Papaver rhoeas (Amapola común), Papaver somniferum (Amapola de Opio, Adormidera), Papaver alpinum, Papaver pilosum, Papaver nudicaule (Amapola de Islandia), Papaver orientale (Amapola de Levante), Papaver bracteatum.

Se conoce por los nombres vulgares de Amapola, Adormidera, Opio, Ababol, Anapola, Cascojo y Amapol.

Son plantas herbáceas de porte matoso o empenachado que miden entre 40 cm y 1 metro de altura. Las hojas son pilosas, muy lobuladas y de color verde azulado o verde vivo. Las vistosas flores se presentan al final del tallo y suelen tener 4 pétalos (el doble en algunas variedades) muy frágiles y pueden ser de color rojo, amarillo, blanco, lila o violeta. Florecen en primavera o en verano, según la especie. Producen un fruto en forma de cápsula donde se alojan las semillas que caen a tierra una vez que el fruto madura y se abre.");
INSERT INTO VIDEOTUTORIAL(FECHA,TITULO,ENLACE,DESCRIPCION) values("2021-10-25","Cuidados sobre margaritas","https://www.youtube.com/embed/fQm4c_6vpJ8","Me quiere, no me quiere, me quiere… Las margaritas son las flores de los enamorados por excelencia (con permiso de las rosas, claro), plantas de aspecto rústico, resistentes y sencillas que, sin embargo, consiguen dar el toque perfecto a cualquier espacio y son, en muchas ocasiones, el regalo ideal. Aprende con nosotros cuidados de las margaritas en una nueva entrega de nuestras fichas de jardinería.");
INSERT INTO VIDEOTUTORIAL(FECHA,TITULO,ENLACE,DESCRIPCION) values("2021-10-26","Cuidados sobre geranios","https://www.youtube.com/embed/BLievbIUQj4","El Geranio es una de las plantas por excelencia del verano y la absoluta protagonista de terrazas o balcones en este tiempo. Si queremos que estas matas luzcan sanas y bonitas en los meses de estío debemos poner especial atención en los cuidados de su crecimiento. De esta forma obtendremos esa floración tan característica, sea en el color que sea, reinando sobre las hojas de un verde intenso.

Pues bien: si deseamos disfrutar de esa eclosión de preciosa naturaleza que se respira al ver un Geranio en flor, es importante que ayudemos a la planta a florecer correctamente. Algo sencillo si sabemos cómo, pero que es absolutamente necesario si tenemos en cuenta que la floración supone un desgaste importante para el vegetal, que tendremos que paliar si queremos disfrutar de ella hasta los últimos coletazos del verano.");






CREATE TABLE IF NOT EXISTS NOTICIA(
	ID_NOTICIA INT(10) AUTO_INCREMENT,
    FECHA DATE NOT NULL,
    IMAGEN_RUTA VARCHAR(255) NOT NULL,
	TITULO VARCHAR(255) NOT NULL,
	CUERPO_NOTICIA VARCHAR(2550) NOT NULL,
    
	CONSTRAINT PK_NOTICIA PRIMARY KEY(ID_NOTICIA)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO NOTICIA(FECHA,IMAGEN_RUTA,TITULO,CUERPO_NOTICIA) values ("2021-10-24","noticiachulesca.jpg","noticia1","notiisia1");
INSERT INTO NOTICIA(FECHA,IMAGEN_RUTA,TITULO,CUERPO_NOTICIA) values ("2021-10-24","noticiasostenible2.jpg","noticia2","notiisia2");
INSERT INTO NOTICIA(FECHA,IMAGEN_RUTA,TITULO,CUERPO_NOTICIA) values ("2021-10-24","noticiasostenible3.jpg","noticia3","notiisia3");
INSERT INTO NOTICIA(FECHA,IMAGEN_RUTA,TITULO,CUERPO_NOTICIA) values ("2021-10-24","noticiasostenible4.jpg","noticia4","notiisia4");
INSERT INTO NOTICIA(FECHA,IMAGEN_RUTA,TITULO,CUERPO_NOTICIA) values ("2021-10-24","catastrofediaria.jpg","Sufriremos más de una catástrofe diaria si no reducimos el riesgo","El coste más elevado lo soporta la región de Asia y el Pacífico, que pierde una media del 1,6% del PIB al año por las catástrofes, mientras que los más pobres también son los que más sufren dentro de los países en desarrollo.

La falta de seguros que ayuden a la recuperación se suma a los efectos a largo plazo de las catástrofes. Desde 1980, solo el 40% de las pérdidas relacionadas con las catástrofes estaban aseguradas, mientras que los índices de cobertura de los seguros en los países en desarrollo eran a menudo inferiores al 10%, y a veces cercanos a cero, según el documento.

''Las catástrofes pueden prevenirse, pero solo si los países invierten el tiempo y los recursos necesarios para comprender y reducir sus riesgos'', dijo Mami Mizutori, representante especial del Secretario General para la Reducción del Riesgo de Desastres y directora de la agencia de la ONU autora del informe.");


CREATE TABLE IF NOT EXISTS COMENTARIOS(
	ID_COMENTARIO INT(10) AUTO_INCREMENT,
    FECHA DATE NOT NULL,
	USUARIOID INT(10) NOT NULL,
	CUERPO_COMENTARIO VARCHAR(255) NOT NULL,
    NOTICIAID INT(10) NOT NULL,
	
	FOREIGN KEY(NOTICIAID) REFERENCES NOTICIA(ID_NOTICIA),
	FOREIGN KEY(USUARIOID) REFERENCES USUARIO(ID_USUARIO),
	CONSTRAINT PK_COMENTARIOS PRIMARY KEY(ID_COMENTARIO)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO COMENTARIOS(FECHA,USUARIOID,CUERPO_COMENTARIO,NOTICIAID) values ("2021-10-24","2","notiisia1","1");
INSERT INTO COMENTARIOS(FECHA,USUARIOID,CUERPO_COMENTARIO,NOTICIAID) values ("2021-10-24","1","notiisia2","2");
INSERT INTO COMENTARIOS(FECHA,USUARIOID,CUERPO_COMENTARIO,NOTICIAID) values ("2021-10-24","1","notiisia22","2");
INSERT INTO COMENTARIOS(FECHA,USUARIOID,CUERPO_COMENTARIO,NOTICIAID) values ("2021-10-24","2","notiisia3","3");

CREATE TABLE IF NOT EXISTS GALERIA(
	ID_IMAGEN INT(10) AUTO_INCREMENT,
	FECHA DATE NOT NULL,
	TITULO VARCHAR(255) NOT NULL,
	RUTA VARCHAR(255) NOT NULL,
	CONSTRAINT PK_GALERIA PRIMARY KEY(ID_IMAGEN)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO GALERIA(FECHA,TITULO,RUTA) values("2019-10-24","titulo1","cards1.png");
INSERT INTO GALERIA(FECHA,TITULO,RUTA) values("2019-10-24","titulo2","noticiasostenible2.jpg");
INSERT INTO GALERIA(FECHA,TITULO,RUTA) values("2019-10-24","titulo3","noticiachulesca.jpg");
INSERT INTO GALERIA(FECHA,TITULO,RUTA) values("2019-10-24","titulo4","noticiasostenible3.jpg");
INSERT INTO GALERIA(FECHA,TITULO,RUTA) values("2019-10-24","titulo5","campingairelibre.jpg");
INSERT INTO GALERIA(FECHA,TITULO,RUTA) values("2019-10-24","titulo6","noticiasostenible4.jpg");
INSERT INTO GALERIA(FECHA,TITULO,RUTA) values("2019-10-24","titulo7","vistasallago.jpg");


CREATE TABLE IF NOT EXISTS EVENTOS(
	ID_EVENTO INT(10) AUTO_INCREMENT,
	COLOR VARCHAR(10) NOT NULL,
	TITULO VARCHAR(255) NOT NULL,
	INICIO DATETIME NOT NULL,
	FIN DATETIME NOT NULL,
	CONSTRAINT PK_EVENTOS PRIMARY KEY(ID_EVENTO)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO EVENTOS(COLOR,TITULO,INICIO,FIN) values(' #0071c5', 'Reunion Colegio', '2022-05-24 09:00:00', '2022-05-25 11:00:00');
INSERT INTO EVENTOS(COLOR,TITULO,INICIO,FIN) values(' #5fc500', 'Reunion Colegio', '2022-05-26 09:00:00', '2022-05-27 11:00:00');
INSERT INTO EVENTOS(COLOR,TITULO,INICIO,FIN) values(' #c5b800', 'Reunion Colegio', '2022-05-28 09:00:00', '2022-05-29 11:00:00');

CREATE TABLE IF NOT EXISTS COMOCOLABORAR(
	ID_COMOCOL INT(10) AUTO_INCREMENT,
	TITULO VARCHAR(255) NOT NULL,
	DESCRIPCION VARCHAR(2550) NOT NULL,
	CONSTRAINT PK_COMOCOLABORAR PRIMARY KEY(ID_COMOCOL)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO COMOCOLABORAR(TITULO,DESCRIPCION) values('¿Cómo podemos contribuir con la Sostenibilidad?', 'A menudo nos encontramos ante la duda de cómo podemos con nuestro comportamiento influir positivamente en el desarrollo sostenible, es preciso entender que los problemas que afectan la sostenibilidad no están  restringidos a las grandes empresas, de una forma u otra todos contribuimos con nuestro granito de arena.
 
Las soluciones a los problemas que afectan el  desarrollo sostenible  no debe limitarse únicamente a las  políticas, estrategias y estándares diseñados y establecidas en las empresas.
 
Aunque parezcan insignificantes, nuestras acciones individuales pueden contribuir considerablemente   y de manera positiva en la sostenibilidad, es preciso nuestro compromiso y concientización para lograr un desarrollo verdaderamente sostenible.
 
A continuación les presento un conjunto de medidas que debemos contemplar para contribuir con esta importantísima causa.');

CREATE TABLE IF NOT EXISTS ESTRUCTURA(
	ID_ESTRUCTURA INT(10) AUTO_INCREMENT,
	TITULO VARCHAR(255) NOT NULL,
	DESCRIPCION VARCHAR(2550) NOT NULL,
	ORGANIGRAMA VARCHAR(255) NOT NULL,
	
	CONSTRAINT PK_ESTRUCTURA PRIMARY KEY(ID_ESTRUCTURA)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO ESTRUCTURA(TITULO,DESCRIPCION,ORGANIGRAMA) values("Conócenos un poco más","Aquí hablaremos un poco sobre la estructura de Grena, sus cargos, así como alguno de sus datos.","organigrama.jpg");


CREATE TABLE IF NOT EXISTS CONTACTOS(
	ID_CONTACTO INT(10) AUTO_INCREMENT,
	NOMBRE VARCHAR(255) NOT NULL,
	APELLIDOS VARCHAR(255) NOT NULL,
	EMAIL VARCHAR(255) NOT NULL,
	CARGO VARCHAR(255) NOT NULL,
	TELEFONO VARCHAR(255) NOT NULL,
	RUTAFOTO VARCHAR(255) NOT NULL,
	RUTATWITTER VARCHAR(255) NOT NULL,
	CONSTRAINT PK_CONTACTOS PRIMARY KEY(ID_CONTACTO)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO CONTACTOS(NOMBRE,APELLIDOS,EMAIL,CARGO,TELEFONO,RUTAFOTO,RUTATWITTER) values("Julito","Barreira Barreira ","pablogallero@gmail.com","Admin","985986886","cards1.png","BarryDiego");
INSERT INTO CONTACTOS(NOMBRE,APELLIDOS,EMAIL,CARGO,TELEFONO,RUTAFOTO,RUTATWITTER) values("Jose Luis","Gonzalez Marquez","pablogallero@gmail.com","Admin","985986886","cards1.png","BarryDiego");
INSERT INTO CONTACTOS(NOMBRE,APELLIDOS,EMAIL,CARGO,TELEFONO,RUTAFOTO,RUTATWITTER) values("Jose Luis","Gonzalez Marquez","pablogallero@gmail.com","Admin","985986886","cards1.png","BarryDiego");
INSERT INTO CONTACTOS(NOMBRE,APELLIDOS,EMAIL,CARGO,TELEFONO,RUTAFOTO,RUTATWITTER) values("Jose Luis","Gonzalez Marquez","pablogallero@gmail.com","Admin","985986886","cards1.png","BarryDiego");
INSERT INTO CONTACTOS(NOMBRE,APELLIDOS,EMAIL,CARGO,TELEFONO,RUTAFOTO,RUTATWITTER) values("Jose Luis","Gonzalez Marquez","pablogallero@gmail.com","Admin","985986886","cards1.png","BarryDiego");


CREATE TABLE IF NOT EXISTS CATEGORIAS(
	ID_CATEGORIA INT(10) AUTO_INCREMENT,
	NOMBRE VARCHAR(255) NOT NULL,
	COLOR VARCHAR(255) NOT NULL,
	
	
	CONSTRAINT PK_CATEGORIAS PRIMARY KEY(ID_CATEGORIA)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO CATEGORIAS(NOMBRE,COLOR) values("Oro","#F1EFAE");
INSERT INTO CATEGORIAS(NOMBRE,COLOR) values("Plata","#DCDCDC");

CREATE TABLE IF NOT EXISTS PATROCINADORES(
	ID_PATROCINADOR INT(10) AUTO_INCREMENT,
	NOMBRE VARCHAR(255) NOT NULL,
	IMAGEN VARCHAR(255) NOT NULL,
	CATEGORIA INT(10) NOT NULL,
	
	FOREIGN KEY(CATEGORIA) REFERENCES CATEGORIAS(ID_CATEGORIA),
	CONSTRAINT PK_PATROCINADORES PRIMARY KEY(ID_PATROCINADOR)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO PATROCINADORES(NOMBRE,IMAGEN,CATEGORIA) values("Nivea","cards1.png","1");
INSERT INTO PATROCINADORES(NOMBRE,IMAGEN,CATEGORIA) values("Colgate","cards2.png","1");
INSERT INTO PATROCINADORES(NOMBRE,IMAGEN,CATEGORIA) values("Colgate","cards2.png","1");
INSERT INTO PATROCINADORES(NOMBRE,IMAGEN,CATEGORIA) values("Colgate","cards2.png","1");
INSERT INTO PATROCINADORES(NOMBRE,IMAGEN,CATEGORIA) values("Colgate","cards2.png","1");
INSERT INTO PATROCINADORES(NOMBRE,IMAGEN,CATEGORIA) values("Colgate","cards2.png","1");
INSERT INTO PATROCINADORES(NOMBRE,IMAGEN,CATEGORIA) values("Colgate","cards2.png","1");
INSERT INTO PATROCINADORES(NOMBRE,IMAGEN,CATEGORIA) values("Kiss FM","cards3.png","2");

