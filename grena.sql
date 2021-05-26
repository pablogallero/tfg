/*CREACIÓN DE TABLAS*/

DROP DATABASE IF EXISTS `GRENA`;
CREATE DATABASE `GRENA` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
--
-- SELECCIONAMOS PARA USAR
--
USE `GRENA`;
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
--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE IF NOT EXISTS USUARIO(
	ID_USUARIO INT(10) AUTO_INCREMENT,
	USERNAME VARCHAR(255) NOT NULL,
	DNI VARCHAR(255) NOT NULL UNIQUE,
	TELEFONO VARCHAR(11) NOT NULL UNIQUE, 
	EMAIL VARCHAR(255) NOT NULL UNIQUE,
	DIRECCION VARCHAR(255) NOT NULL,
	GENERO ENUM("mujer","hombre") ,
	PASSWD VARCHAR(255) NOT NULL,
	ROL ENUM("deportista","administrador") DEFAULT "deportista",
	
	CONSTRAINT PK_USUARIO PRIMARY KEY(ID_USUARIO)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("administrador","12345678Z","988123455","admin@gmail.com","ClubPadel","mujer","holahola","administrador");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Noelia","44488043V","608473560","nghervella@esei.uvigo.es","Celanova","mujer","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Ines","32768072H","666666660","ines@gmail.com","Celanova","mujer","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Tania","18053301A","666666661","tania@gmail.com","Celanova","mujer","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Rocio","44625726E","666666662","rocio@gmail.com","Celanova","mujer","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Ainoa","91497816K","666666663","ainoa@gmail.com","Celanova","mujer","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Antia","47524280R","666666664","antia@gmail.com","Celanova","mujer","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Maria","75342221V","666666665","maria@gmail.com","Celanova","mujer","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Blanca","89236173Z","666666666","blanca@gmail.com","Celanova","mujer","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Miriam","14431247N","666666667","miriam@gmail.com","Celanova","mujer","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Iria","43747460B","666666668","iria@gmail.com","Celanova","mujer","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Lara","18095369G","666666669","lara@gmail.com","Celanova","mujer","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Angela","82870047N","666666600","angela@gmail.com","Celanova","mujer","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Alba","57515199L","666666601","alba@gmail.com","Celanova","mujer","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Isabel","73108502N","666666602","isabel@gmail.com","Celanova","mujer","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("May","34248961Y","666666603","may@gmail.com","Celanova","mujer","holahola","deportista");



INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Albovy","92802589G","655555550","albovy@gmail.com","Celanova","hombre","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Alejandro","10614506Y","655555551","alejandro@gmail.com","Celanova","hombre","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Ignacio","81172032H","655555552","nacho@gmail.com","Celanova","hombre","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("JaviZabo","03579056A","655555553","zabo@gmail.com","Celanova","hombre","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Gallero","95752404T","655555554","gallero@gmail.com","Celanova","hombre","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("JorgeRuiz","27175418K","655555555","jorgeRuiz@gmail.com","Celanova","hombre","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("JorgePerez","84520948L","655555556","jorgePerez@gmail.com","Celanova","hombre","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Pitichixo","67402532C","655555557","piti@gmail.com","Celanova","hombre","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("IvanDD","01534329E","655555558","ivan@gmail.com","Celanova","hombre","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("YerayLage","99327885Q","655555559","yeray@gmail.com","Celanova","hombre","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Nowi","23002028G","655555510","nowi@gmail.com","Celanova","hombre","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Gonzalo","46714719V","655555511","gonza@gmail.com","Celanova","hombre","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("LuisRo","70988980D","655555512","luis@gmail.com","Celanova","hombre","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Jacobo","11343110Q","655555513","jaco@gmail.com","Celanova","hombre","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Abel","71666111C","655555514","abel@gmail.com","Celanova","hombre","holahola","deportista");
INSERT INTO USUARIO(USERNAME, DNI, TELEFONO, EMAIL, DIRECCION, GENERO, PASSWD, ROL) values ("Miguelon","78960771T","655555515","miguelon@gmail.com","Celanova","hombre","holahola","deportista");


CREATE TABLE IF NOT EXISTS PROYECTO(
	ID_PROYECTO INT(10) AUTO_INCREMENT,
	NAMEPROYECTO VARCHAR(255) NOT NULL,
	NAMEORGANIZADOR VARCHAR(255) NOT NULL,
	NUMPLAZAS INT(10) NOT NULL,
    FECHA DATE NOT NULL,
	CONSTRAINT PK_PROYECTO PRIMARY KEY(ID_PROYECTO)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
INSERT INTO PROYECTO(NAMEPROYECTO,NAMEORGANIZADOR,NUMPLAZAS,FECHA) values ("Proyecto1","Hard",200,"2021-10-25");

CREATE TABLE IF NOT EXISTS VIDEOTUTORIAL(
	ID_VIDEOTUTORIAL INT(10) AUTO_INCREMENT,
	FECHA DATE NOT NULL,
	TITULO VARCHAR(255) NOT NULL,
	ENLACE VARCHAR(255) NOT NULL,
	DESCRIPCION VARCHAR(255) NOT NULL,
	CONSTRAINT PK_VIDEOTUTORIAL PRIMARY KEY(ID_VIDEOTUTORIAL)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO VIDEOTUTORIAL(FECHA,TITULO,ENLACE,DESCRIPCION) values("2021-10-24","titulo1","https://www.youtube.com/embed/aHDCrf2WwbY","este video trata sobre cuidados caseros para amapolas");
INSERT INTO VIDEOTUTORIAL(FECHA,TITULO,ENLACE,DESCRIPCION) values("2021-10-25","titulo2","https://www.youtube.com/embed/hh1sY-h9N5E","este video trata sobre cuidados caseros para margaritas");
INSERT INTO VIDEOTUTORIAL(FECHA,TITULO,ENLACE,DESCRIPCION) values("2021-10-26","titulo3","https://www.youtube.com/embed/J1z3Q92qrJk","este video trata sobre cuidados caseros para geranios");






CREATE TABLE IF NOT EXISTS NOTICIA(
	ID_NOTICIA INT(10) AUTO_INCREMENT,
    FECHA DATE NOT NULL,
    IMAGEN_RUTA VARCHAR(255) NOT NULL,
	TITULO VARCHAR(255) NOT NULL,
	CUERPO_NOTICIA VARCHAR(255) NOT NULL,
    COMENTARIOS VARCHAR(255) NOT NULL,
	CONSTRAINT PK_NOTICIA PRIMARY KEY(ID_NOTICIA)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO NOTICIA(FECHA,IMAGEN_RUTA,TITULO,CUERPO_NOTICIA,COMENTARIOS) values ("2021-10-24","noticiachulesca.jpg","noticia1","notiisia1","comentario1");
INSERT INTO NOTICIA(FECHA,IMAGEN_RUTA,TITULO,CUERPO_NOTICIA,COMENTARIOS) values ("2021-10-24","noticiarealmentechulesca2.jpg","noticia2","notiisia2","comentario2");
INSERT INTO NOTICIA(FECHA,IMAGEN_RUTA,TITULO,CUERPO_NOTICIA,COMENTARIOS) values ("2021-10-24","noticiarealmentechulesca3.jpg","noticia3","notiisia3","comentario3");
INSERT INTO NOTICIA(FECHA,IMAGEN_RUTA,TITULO,CUERPO_NOTICIA,COMENTARIOS) values ("2021-10-24","noticiarealmentechulesca4.jpg","noticia4","notiisia4","comentario4");

CREATE TABLE IF NOT EXISTS GALERIA(
	ID_IMAGEN INT(10) AUTO_INCREMENT,
	FECHA DATE NOT NULL,
	TITULO VARCHAR(255) NOT NULL,
	RUTA VARCHAR(255) NOT NULL,
	CONSTRAINT PK_GALERIA PRIMARY KEY(ID_IMAGEN)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO GALERIA(FECHA,TITULO,RUTA) values("2019-10-24","titulo1","cards1.png");
INSERT INTO GALERIA(FECHA,TITULO,RUTA) values("2019-10-24","titulo2","cards1.png");
INSERT INTO GALERIA(FECHA,TITULO,RUTA) values("2019-10-24","titulo3","cards1.png");
INSERT INTO GALERIA(FECHA,TITULO,RUTA) values("2019-10-24","titulo4","cards1.png");
INSERT INTO GALERIA(FECHA,TITULO,RUTA) values("2019-10-24","titulo5","cards1.png");
INSERT INTO GALERIA(FECHA,TITULO,RUTA) values("2019-10-24","titulo6","cards1.png");
INSERT INTO GALERIA(FECHA,TITULO,RUTA) values("2019-10-24","titulo7","cards1.png");


CREATE TABLE IF NOT EXISTS EVENTOS(
	ID_EVENTO INT(10) AUTO_INCREMENT,
	HORA TIME NOT NULL,
	TITULO VARCHAR(255) NOT NULL,
	DESCRIPCION VARCHAR(255) NOT NULL,
	CONSTRAINT PK_EVENTOS PRIMARY KEY(ID_EVENTO)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO EVENTOS(HORA,TITULO,DESCRIPCION) values("18:00:00","titulo1","Descripcion de evento 1");
INSERT INTO EVENTOS(HORA,TITULO,DESCRIPCION) values("19:00:00","titulo2","Descripcion de evento 2");
INSERT INTO EVENTOS(HORA,TITULO,DESCRIPCION) values("20:00:00","titulo3","Descripcion de evento 3");
INSERT INTO EVENTOS(HORA,TITULO,DESCRIPCION) values("21:00:00","titulo4","Descripcion de evento 4");
INSERT INTO EVENTOS(HORA,TITULO,DESCRIPCION) values("22:00:00","titulo5","Descripcion de evento 5");



