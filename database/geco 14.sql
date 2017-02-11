drop database if exists geco;
create database geco;
use geco;

create table if not exists curso(
id			int not null auto_increment,
nombre		varchar(50) not null,
duracion 	varchar(50),
descripcion	varchar(300) default 'Sin Descripción.',
taller		boolean default false,
lenguaje  	char (5) not null,
created_at	timestamp not null default '0000-00-00 00:00:00',
updated_at	timestamp not null default '0000-00-00 00:00:00',
primary key	(id)
);

create table if not exists carrera(
id			int not null auto_increment,
nombre		varchar(50) not null,
duracion 	varchar(50),
descripcion	varchar(300) default 'Sin Descripción.',
lenguaje  	char (5) not null,
created_at	timestamp not null default '0000-00-00 00:00:00',
updated_at	timestamp not null default '0000-00-00 00:00:00',
primary key	(id)
);

create table if not exists materia(
id			int not null auto_increment,
carrera_id	int not null,
nombre		varchar(50) not null,
descripcion	varchar(300) default 'Sin Descripción.',
created_at	timestamp not null default '0000-00-00 00:00:00',
updated_at	timestamp not null default '0000-00-00 00:00:00',
primary key (id, carrera_id),
foreign key (carrera_id)				references carrera	(id)
);

create table if not exists cadena(
id					int not null auto_increment,
nombre				varchar(50) not null,
mail				varchar(50) not null,
telefono			varchar(50) not null,
created_at  		timestamp not null default '0000-00-00 00:00:00',
updated_at  		timestamp not null default '0000-00-00 00:00:00',
primary key 		(id)
);

create table if not exists tipo_documento(
id					int not null auto_increment,
tipo_documento		varchar(50) not null,
created_at  		timestamp not null default '0000-00-00 00:00:00',
updated_at  		timestamp not null default '0000-00-00 00:00:00',
primary key 		(id)
);

create table if not exists director(
id					int not null auto_increment,
tipo_documento_id 	int,
nro_documento		varchar(50),
apellidos			varchar(50) not null,
nombres				varchar(50) not null,
mail				varchar(50) not null,
activo				boolean not null default true,
created_at  		timestamp not null default '0000-00-00 00:00:00',
updated_at  		timestamp not null default '0000-00-00 00:00:00',
primary key			(id),
unique key			(tipo_documento_id, nro_documento)
);

create table if not exists director_telefono(
director_id	int not null,
telefono	varchar(50) not null,
created_at  timestamp not null default '0000-00-00 00:00:00',
updated_at  timestamp not null default '0000-00-00 00:00:00',
primary key	(director_id, telefono),
foreign key	(director_id) 				references director	(id)
);



create table if not exists tipo_moneda(
id 			int not null auto_increment,
nombre  	varchar (50) not null,
simbolo 	char(10) not null,
abreviacion char(10) not null,
created_at  timestamp not null default '0000-00-00 00:00:00',
updated_at  timestamp not null default '0000-00-00 00:00:00',
primary key 	(id)
);

create table if not exists pais(
id 				int not null auto_increment,
pais  			varchar (50) not null,
lenguaje  		char (5) not null,
tipo_moneda_id	int not null,
created_at  	timestamp not null default '0000-00-00 00:00:00',
updated_at  	timestamp not null default '0000-00-00 00:00:00',
primary key 	(id),
foreign key		(tipo_moneda_id) 	references tipo_moneda(id)
);

create table if not exists filial(
id				int not null auto_increment,
cadena_id		int not null,
pais_id 		int not null,
nombre			varchar(50) not null,
direccion		varchar(50),
localidad		varchar(50),
codigo_postal	int,
director_id		int not null,
mail			varchar(50),
activo			boolean not null default true,
created_at		timestamp not null default '0000-00-00 00:00:00',
updated_at		timestamp not null default '0000-00-00 00:00:00',
primary key 	(id),
foreign key		(cadena_id) 	references cadena 	(id),
foreign key		(pais_id) 		references pais 	(id),
foreign key		(director_id) 	references director (id)
);

create table if not exists filial_telefono(
filial_id	int not null,
telefono	varchar(50) not null,
created_at	timestamp not null default '0000-00-00 00:00:00',
updated_at	timestamp not null default '0000-00-00 00:00:00',
primary key	(filial_id, telefono),
foreign key	(filial_id) 			references filial (id)
);

create table if not exists asesor(
id					int not null auto_increment,
tipo_documento_id 	int,
nro_documento		varchar(50),	
apellidos			varchar(50) not null,
nombres				varchar(50) not null,
direccion			varchar(50),
localidad			varchar(50),
filial_id 			int,
activo				boolean not null default true,
created_at			timestamp not null default '0000-00-00 00:00:00',
updated_at			timestamp not null default '0000-00-00 00:00:00',
primary key 		(id),
unique key			(tipo_documento_id, nro_documento),
foreign key 		(tipo_documento_id)	references tipo_documento	(id),
foreign key 		(filial_id)	references filial (id)
);

create table if not exists asesor_telefono(
asesor_id	int not null,
telefono	varchar(50) not null,
created_at	timestamp not null default '0000-00-00 00:00:00',
updated_at	timestamp not null default '0000-00-00 00:00:00',
primary key	(asesor_id, telefono),
foreign key	(asesor_id) 			references asesor	(id)
);

create table if not exists asesor_mail(
asesor_id	int not null,
mail		varchar(50) not null,
created_at	timestamp not null default '0000-00-00 00:00:00',
updated_at	timestamp not null default '0000-00-00 00:00:00',
primary key	(asesor_id, mail),
foreign key	(asesor_id) 		references asesor	(id)
);

create table if not exists persona(
id						int not null auto_increment,	
tipo_documento_id 		int,
pais_id 				int not null,
nro_documento			varchar(50),			
apellidos				varchar(50) not null,
nombres					varchar(50) not null,
genero					char(1),
fecha_nacimiento		date,
domicilio				varchar(50),
localidad				varchar(50),
estado_civil			varchar(50),
nivel_estudios			varchar(50),
estudio_computacion		boolean,
posee_computadora		boolean,
disponibilidad_manana	boolean,
disponibilidad_tarde	boolean,
disponibilidad_noche	boolean,
disponibilidad_sabados	boolean,
aclaraciones			varchar(300),
filial_id				int not null,
activo					boolean not null default true,
created_at				timestamp not null default '0000-00-00 00:00:00',
updated_at				timestamp not null default '0000-00-00 00:00:00',	
primary key 			(id),
unique key				(tipo_documento_id, nro_documento),
foreign key 			(tipo_documento_id)					references tipo_documento	(id),
foreign key				(pais_id) 							references pais 			(id),
foreign key 			(filial_id)							references filial 			(id)
);

create table if not exists persona_telefono(
persona_id	int not null,
telefono	varchar(50) not null,
created_at	timestamp not null default '0000-00-00 00:00:00',
updated_at	timestamp not null default '0000-00-00 00:00:00',
primary key	(persona_id, telefono),
foreign key	(persona_id) 			references persona	(id)
);

create table if not exists persona_mail(
persona_id	int not null,
mail		varchar(50) not null,
created_at	timestamp not null default '0000-00-00 00:00:00',
updated_at	timestamp not null default '0000-00-00 00:00:00',
primary key	(persona_id, mail),
foreign key	(persona_id) 		references persona	(id)
);

create table if not exists preinforme(
id				int not null auto_increment,
persona_id		int not null,
asesor_id		int not null,
descripcion		varchar(300),
medio			varchar(50),
como_encontro	varchar(50),
filial_id		int not null,
created_at		timestamp not null default '0000-00-00 00:00:00',
updated_at		timestamp not null default '0000-00-00 00:00:00',
primary key 	(id),
foreign key 	(persona_id)				references persona	(id),
foreign key 	(asesor_id)					references asesor	(id),
foreign key 	(filial_id)					references filial	(id)
);

create table if not exists persona_interes(
id 				int not null auto_increment,
preinforme_id	int,	
persona_id		int not null,
carrera_id		int,
curso_id		int(50),
descripcion		varchar (300),
created_at		timestamp not null default '0000-00-00 00:00:00',
updated_at		timestamp not null default '0000-00-00 00:00:00',
primary key 	(id),
foreign key 	(persona_id)			references persona		(id),
foreign key 	(preinforme_id)			references preinforme 	(id),
foreign key 	(carrera_id)			references carrera		(id),
foreign key 	(curso_id)				references curso		(id)
);

create table if not exists matricula(
id						int not null auto_increment,
persona_id				int not null,
curso_id				int,
carrera_id				int,
filial_id				int,
asesor_id				int,
activo					boolean not null default true,
terminado				boolean not null default false,
cancelado				boolean not null default false,
ultimo_mail_enviado		date default '0000-00-00',
created_at  			timestamp not null default '0000-00-00 00:00:00',
updated_at  			timestamp not null default '0000-00-00 00:00:00',
primary key 	(id),	
foreign key 	(persona_id)		references persona	(id),
foreign key 	(curso_id)			references curso	(id),
foreign key 	(carrera_id)		references carrera	(id),
foreign key 	(filial_id)			references filial	(id),
foreign key 	(asesor_id)			references asesor	(id)
)AUTO_INCREMENT=1000;

create table if not exists matricula_permisos(
id				int not null auto_increment,
matricula_id	int not null,
filial_id		int not null,
confirmar		boolean not null default false,
created_at		timestamp not null default '0000-00-00 00:00:00',
updated_at		timestamp not null default '0000-00-00 00:00:00',
primary key 	(id),
foreign key 	(matricula_id)				references matricula	(id),
foreign key 	(filial_id)					references filial		(id)
);

create table if not exists pago(
id 				int not null auto_increment,
matricula_id	int not null,
tipo_moneda_id 	int not null,
nro_pago		int not null,
pago_individual	boolean default false,
descripcion		varchar(50) default 'Sin Descripción.',
terminado		boolean not null default false,
vencimiento		date,
fecha_recargo	date,
monto_original	float not null,
monto_actual	float,
monto_pago		float,
descuento		float not null,
recargo			float not null,
filial_id		int not null,
created_at  	timestamp not null default '0000-00-00 00:00:00',
updated_at  	timestamp not null default '0000-00-00 00:00:00',
primary key 	(id),
foreign key 	(matricula_id)				references matricula	(id),
foreign key 	(tipo_moneda_id)			references tipo_moneda	(id),
foreign key 	(filial_id)					references filial		(id)
);

create table if not exists recibo_tipo(
id				int not null auto_increment,
recibo_tipo		char(1),
created_at		timestamp not null default '0000-00-00 00:00:00',
updated_at		timestamp not null default '0000-00-00 00:00:00',
primary key 	(id)
);

create table if not exists recibo_concepto_pago(
id						int not null auto_increment,
concepto_pago			varchar(50),
abreviacion				char(3),
created_at				timestamp not null default '0000-00-00 00:00:00',
updated_at				timestamp not null default '0000-00-00 00:00:00',
primary key 			(id)
);

create table if not exists recibo(
id						int not null auto_increment,
recibo_tipo_id			int not null,
tipo_moneda_id 			int not null,
pago_id					int not null,		
monto					float not null,
fecha					datetime not null,
recibo_concepto_pago_id	int not null,
descripcion				varchar(50),
filial_id				int not null,
created_at				timestamp not null default '0000-00-00 00:00:00',
updated_at				timestamp not null default '0000-00-00 00:00:00',
primary key 			(id),
foreign key 			(recibo_tipo_id)			references recibo_tipo			(id),
foreign key 			(tipo_moneda_id)			references tipo_moneda			(id),
foreign key 			(pago_id)					references pago					(id),
foreign key				(recibo_concepto_pago_id)	references recibo_concepto_pago	(id),
foreign key 			(filial_id)					references filial				(id)
)AUTO_INCREMENT=100;

create table if not exists docente(
id							int not null auto_increment,
tipo_documento_id 			int,
nro_documento				varchar(50),
apellidos					varchar(50) not null,
nombres						varchar(50) not null,
descripcion					varchar(300),
disponibilidad_manana		boolean,
disponibilidad_tarde		boolean,
disponibilidad_noche		boolean,
disponibilidad_sabados		boolean,
filial_id					int not null,
activo						boolean not null default true,
created_at  				timestamp not null default '0000-00-00 00:00:00',
updated_at  				timestamp not null default '0000-00-00 00:00:00',
primary key 				(id),
unique key					(tipo_documento_id, nro_documento),
foreign key 				(tipo_documento_id)						references tipo_documento	(id),
foreign key 				(filial_id)							    references filial			(id)
);

create table if not exists aula(
id 			int not null auto_increment,
nombre 		varchar(50) not null,
filial_id 	int not null,
created_at 	timestamp not null default '0000-00-00 00:00:00',
updated_at 	timestamp not null default '0000-00-00 00:00:00',
primary key (id),
unique key	(nombre),
foreign key (filial_id) references filial (id)
);

create table if not exists grupo_color(
id 			int not null auto_increment,
color 		varchar(50) not null,
created_at 	timestamp not null default '0000-00-00 00:00:00',
updated_at 	timestamp not null default '0000-00-00 00:00:00',
primary key	(id)
);

create table if not exists grupo(
id				int not null auto_increment,
curso_id		int,
carrera_id		int,
descripcion		varchar(300),
docente_id		int not null,
nuevo			boolean not null default true,
turno_manana	boolean,
turno_tarde		boolean,
turno_noche		boolean,
sabados			boolean,
color           varchar(45),
fecha_inicio	date not null,
fecha_fin		date not null,
filial_id		int not null,
activo			boolean not null default true,
terminado		boolean not null default false,
cancelado		boolean not null default false,
created_at  	timestamp not null default '0000-00-00 00:00:00',
updated_at  	timestamp not null default '0000-00-00 00:00:00',
primary key 	(id),
foreign key 	(curso_id)						references curso		(id),
foreign key 	(carrera_id)					references carrera		(id),
foreign key 	(docente_id)					references docente		(id),
foreign key 	(filial_id)						references filial		(id)
);

create table if not exists grupo_horario(
grupo_id		int not null,
dia				ENUM('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'),
horario_desde	time not null,
horario_hasta	time not null,
materia_id		int,
aula_id			int not null,
created_at  	timestamp not null default '0000-00-00 00:00:00',
updated_at  	timestamp not null default '0000-00-00 00:00:00',
primary key		(grupo_id, dia, horario_desde, horario_hasta),
foreign key		(grupo_id)		references grupo		(id),
foreign key 	(materia_id) 	references materia	    (id),
foreign key		(aula_id)		references aula			(id)
);

create table if not exists grupo_matricula(
grupo_id		int not null,
matricula_id	int not null,
created_at  	timestamp not null default '0000-00-00 00:00:00',
updated_at  	timestamp not null default '0000-00-00 00:00:00',
primary key 	(grupo_id, matricula_id),
foreign key 	(grupo_id)					  references grupo		(id),
foreign key 	(matricula_id)				references matricula	(id)
);

create table if not exists clase_estado(
id 				int(11) not null auto_increment,
estado			varchar(20) not null,
created_at  	timestamp not null default '0000-00-00 00:00:00',
updated_at  	timestamp not null default '0000-00-00 00:00:00',
primary key 	(id)
);

create table if not exists clase(
id 				int(11) not null auto_increment,
clase_estado_id	int not null,
grupo_id		int not null,
fecha			datetime not null,
docente_id		int not null,
dia				int(1) not null,
horario_desde	time not null,
horario_hasta	time not null,
materia_id		int,
aula_id			int  not null,
enviado 		boolean not null default false,
descripcion		varchar(300),
created_at  	timestamp not null default '0000-00-00 00:00:00',
updated_at  	timestamp not null default '0000-00-00 00:00:00',
primary key		(id),
foreign key		(clase_estado_id)	references clase_estado	(id),
foreign key		(grupo_id)			references grupo		(id),
foreign key		(docente_id)		references docente		(id),
foreign key 	(materia_id) 		references materia	    (id),
foreign key		(aula_id)			references aula			(id)
);

create table if not exists clase_matricula(
id 				int(11) not null auto_increment,
clase_id		int(11) not null,
matricula_id	int not null,
asistio			boolean not null,
created_at  	timestamp not null default '0000-00-00 00:00:00',
updated_at  	timestamp not null default '0000-00-00 00:00:00',
primary key 	(id),	
foreign key 	(clase_id)							  references clase		(id),
foreign key 	(matricula_id)						references matricula	(id)
);

create table if not exists examen(
id  					int not null auto_increment,	
nro_acta				int,
recuperatorio_nro_acta	int,
matricula_id			int not null,
grupo_id				int,
nota					int(2) not null,
carrera_id				int,
materia_id				int,
docente_id				int not null,
created_at  			timestamp not null default '0000-00-00 00:00:00',
updated_at  			timestamp not null default '0000-00-00 00:00:00',
primary key 			(id),
foreign key 			(recuperatorio_nro_acta)	references examen	  	(id),
foreign key				(grupo_id)					references grupo	  	(id),
foreign key 			(carrera_id, materia_id)	references materia		(carrera_id, id),
foreign key 			(docente_id)				references docente		(id)
);

create table if not exists mailing(
id 					int(11) not null auto_increment,
persona_id			int(11) not null,
filial_id			int(11) not null,
pago_id 			int(11),
moroso 				boolean default 0,
enviado 			boolean not null,
vencimiento_pago	date not null,
fecha_envio 		datetime not null,
created_at			timestamp not null default '0000-00-00 00:00:00',
updated_at			timestamp not null default '0000-00-00 00:00:00',
primary key			(id),
foreign key			(persona_id) 	references persona 	(id),
foreign key			(filial_id) 	references filial	  (id),
foreign key			(pago_id)     	references pago     (id)
);

create table if not exists rol(
id int(11) NOT NULL,
rol varchar(45) DEFAULT NULL,
created_at			timestamp not null default '0000-00-00 00:00:00',
updated_at			timestamp not null default '0000-00-00 00:00:00',
primary key			(id)
);

create table if not exists cuenta(
id int(11) not null auto_increment,
usuario varchar(255) DEFAULT NULL,
contrasena varchar(255) DEFAULT NULL,
habilitado tinyint(1) DEFAULT NULL,
rol_id int(11) NOT NULL,
entidad_id int(11) NOT NULL,
activo tinyint(1) not null default true,
created_at			timestamp not null default '0000-00-00 00:00:00',
updated_at			timestamp not null default '0000-00-00 00:00:00',
primary key			(id),
foreign key			(rol_id) 	references rol 	(id)
);


-- --------------------------------------------------------
-- ---------- Inserción de Datos

--
-- Cadenas
--
insert into rol (`id`, `rol`,  `created_at`, `updated_at`)
values  ('2', 'dueno', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('3', 'director', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('4', 'filial', '2016-11-11 00:00:00', '2016-11-11 00:00:00');

insert into cuenta (`id`, `usuario`,`contrasena`,  `habilitado`, `rol_id`, `entidad_id`, `created_at`, `updated_at`)
values  ('1', 'mferrari@igionline.com.ar', '$2y$10$0PsN63XTqAdphh3onJ7dZOcC1JOfPwCTk66jHpPbX5yYNAlmrzt.i','1','2','1','2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('3', 'filial@filial.com', '$2y$10$0PsN63XTqAdphh3onJ7dZOcC1JOfPwCTk66jHpPbX5yYNAlmrzt.i','1','4','3','2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('4', 'flores@filial.com','$2y$10$0PsN63XTqAdphh3onJ7dZOcC1JOfPwCTk66jHpPbX5yYNAlmrzt.i','1','4','4','2016-11-11 00:00:00', '2016-11-11 00:00:00');

insert into cadena (`nombre`, `mail`, `telefono`, `created_at`, `updated_at`)
values  ('IGI', 'test@igi.com', '12345678', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('IAC', 'test@iac.com', '12345678', '2016-11-11 00:00:00', '2016-11-11 00:00:00');


--
-- Tipo Moneda
--
insert into tipo_moneda (`nombre`, `simbolo`, `abreviacion`, `created_at`, `updated_at`)
values  ('Peso Argentino'	, '$'	, 'ARS'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('Peso Colombiano'	, '$'	, 'COP'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('Peso Boliviano'	, 'Bs'	, 'BOB'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('Peso Chileno'		, '$'	, 'CLP'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('Peso Uruguayo'	, 'UYU'	, 'UYU'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('Guarani Paraguayo', '--'	, 'PEN'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('Nuevo Sol peruano', 'S/'	, 'PYG'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('Real Brasileño'	, 'R$'	, 'BRL'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('Dolar Americano'	, '$'	, 'USD'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('Peso Mexicano'	, 'R$'	, 'MXN'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('Dólar Canadiense'	, 'C$'	, 'CAD'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Pais
--
insert into pais (`pais`, `lenguaje`, `tipo_moneda_id`, `created_at`, `updated_at`)
values  ('Argentina', 'es',1, '2016-11-11 00:00:00'	, '2016-11-11 00:00:00'),
		('Colombia' , 'es',2, '2016-11-11 00:00:00'	, '2016-11-11 00:00:00'),
		('Bolivia' 	, 'es',3, '2016-11-11 00:00:00'	, '2016-11-11 00:00:00'),
		('Chile' 	, 'es',4, '2016-11-11 00:00:00'	, '2016-11-11 00:00:00'),
		('Uruguay' 	, 'es',5, '2016-11-11 00:00:00'	, '2016-11-11 00:00:00'),
		('Paraguay' , 'es',6, '2016-11-11 00:00:00'	, '2016-11-11 00:00:00'),
		('Perú' 	, 'es',7, '2016-11-11 00:00:00'	, '2016-11-11 00:00:00'),
		('Brasil' 	, 'pt',8, '2016-11-11 00:00:00'	, '2016-11-11 00:00:00'),
		('EE UU' 	, 'en',9, '2016-11-11 00:00:00'	, '2016-11-11 00:00:00'),
		('México' 	, 'es',10, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('Canada' 	, 'en',11, '2016-11-11 00:00:00', '2016-11-11 00:00:00');


--
-- Tipo Recibo
--
insert into recibo_tipo (`recibo_tipo`, `created_at`, `updated_at`)
values 	('A', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('B', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('C', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('R', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('X', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('E', '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Concepto pago
--
insert into recibo_concepto_pago (`concepto_pago`,`abreviacion`, `created_at`, `updated_at`)
values 	('Contado', 'CON', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('Cheque', 'CHE', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('Tranferencia', 'TRA', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('Tarjeta Crédito', 'TAR', '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Tipos de Documento
--

insert into tipo_documento (`tipo_documento`, `created_at`, `updated_at`)
values  ('DNI'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('LE'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('CI'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		('LC'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('PAS'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Directores
--

insert into director (`tipo_documento_id`, `nro_documento`, `apellidos`, `nombres`,`mail`, `activo`, `created_at`, `updated_at`)
values  (1, 11123456, 'González'	, 'Santiago', 'director@director.com'	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
    	(1, 10123456, 'Lopez'		, 'Mateo'	, 'director2@director.com'	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 23453456, 'Garcia'		, 'Diego'	, 'director3@director.com'  , 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 20123456, 'Romero'		, 'Camila'	, 'director4@director.com'  , 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 12123456, 'Mendez'		, 'yamila'	, 'director5@director.com'	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 22234567, 'Hosuy'		, 'Camilo'	, 'director6@director.com'  , 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 20134111, 'Montero'		, 'Elena'	, 'director7@director.com'	, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 23455489, 'Di Mario'	, 'Anibal'	, 'director8@director.com'	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 20114441, 'Di Caprio'	, 'Leonel'	, 'director9@director.com'	, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 23456789, 'Campillay'	, 'Walter'	, 'director10@director.com'	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 10422284, 'Lopez'		, 'Mateo'	, 'director11@director.com'	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 23123456, 'Suerez'		, 'Alfonso'	, 'director12@director.com' , 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 20685756, 'Molinari'	, 'Juan'	, 'director13@director.com' , 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 13111246, 'Perez'		, 'Emiliano', 'director14@director.com'	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 22533467, 'Royers'		, 'Anibal'	, 'director15director.com'  , 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 20133357, 'petro'		, 'Eduardo'	, 'director16@director.com'	, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 23434344, 'Ruiz'		, 'José'	, 'director17@director.com'	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 20155541, 'Orellana'	, 'Ramiro'	, 'director18@director.com'	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 23990089, 'Tomaselli'	, 'Rubén'	, 'director19@director.com'	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 11143436, 'Juiz'		, 'Mariano'	, 'director20@director.com'	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00');


-- Directores Tel
--

insert into director_telefono(`director_id`, `telefono`, `created_at`, `updated_at`) 
values  (1, '12345678',	'2016-11-11 00:00:00', '2016-11-11 00:00:00'),
    	(1, '87654321', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, '15975365', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, '25875369', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, '95874125', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3, '35698751', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (4, '45875321', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (5, '65874213', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (6, '34343434', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7, '45454545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8, '23456747', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9, '234343434', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, '977878788', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (11, '95874125', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (12, '35698751', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (13, '45875321', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (14, '65874213', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (15, '34343434', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (16, '45454545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (17, '23456747', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (18, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (19, '234343434', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (20, '977878788', '2016-11-11 00:00:00', '2016-11-11 00:00:00');
     
--
-- Filiales
--

insert into filial (`cadena_id`, `pais_id`, `nombre`, `direccion`, `localidad`, `codigo_postal`, `director_id`, `mail`, `activo`, `created_at`, `updated_at`)
values  (1, 1, 'Filial 1' 	, 'Av de Mayo 546'		, 'Ramos Mejia'	, 1456, 1, 'filial2@filial.com' , 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 2' 	, 'Av Diaz Velez 678'	, 'Ciudadela'	, 1702, 1, 'filial3@filial.com' , 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 3' 	, 'Av Rivadavia 14567'	, 'Haedo'		, 1730, 2, 'filial@filial.com' 	, 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 4' 	, 'Av Mitre 2345'		, 'Munro'		, 1736, 8, 'filial4@filial.com' , 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 5' 	, 'Estrada 456'			, 'Villa Luro'	, 1666, 3, 'filial5@filial.com' , 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 1, 'Filial 6' 	, 'Cerrito 765'			, 'Flores'		, 1736, 3, 'filial6@filial.com' , 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 1, 'Filial 7' 	, 'Ruta 8 km 44'		, 'San Miguel'	, 1234, 4, 'filial7@filial.com' , 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 8' 	, 'Artigas 6754'		, 'Florida'		, 1456, 4, 'filial8@filial.com' , 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 1, 'Filial 9' 	, 'Av Santa Fe 456'		, 'Olivos'		, 1000, 5, 'filial9@filial.com' , 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 1, 'Filial 10'	, 'San Martin 675'		, 'San Isidro'	, 1755, 5, 'filial10@filial.com', 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 11' 	, '9 de Julio 651'		, 'Morón'		, 1736, 3, 'filial11@filial.com',	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 12' 	, 'Av Rivadavia 11234'	, 'Liniers'		, 1333, 4, 'filial12@filial.com', 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 1, 'Filial 13' 	, 'Av Rivadavia 2345'	, 'Once'		, 1798, 4, 'filial13@filial.com', 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 14' 	, 'El Cano 6543'		, 'Caballito'	, 1765, 6, 'filial14@filial.com',	0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 1, 'Filial 15'	, 'Moreno 6785'			, 'Caseros'		, 1736, 5, 'filial15@filial.com', 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 16' 	, 'Cabral 456'			, 'Castelar'	, 1736, 3, 'filial16@filial.com',	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 17' 	, 'America 2321'		, 'Saez Peña'	, 1453, 4, 'filial17@filial.com', 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 1, 'Filial 18' 	, 'Peron 4567'			, 'Burzaco'		, 1798, 4, 'filial18@filial.com', 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 19' 	, 'Olavarria 2342'		, 'Quilmes'		, 1011, 6, 'filial19@filial.com',	0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 1, 'Filial 20'	, 'Mitre 6785'			, 'Caseros'		, 1736, 5, 'filial20@filial.com', 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 21' 	, 'Urquiza 2345'		, 'Caseros'		, 1736, 3, 'filial21@filial.com',	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 22' 	, 'Sucre 4546'			, 'Florida'		, 1333, 4, 'filial22@filial.com', 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 1, 'Filial 23' 	, 'Calle 8 3456'		, 'La Plata'	, 1798, 4, 'filial23@filial.com', 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 24' 	, 'Av J M Justo 321'	, 'P Madero'	, 1765, 6, 'filial24@filial.com',	0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 1, 'Filial 25'	, 'Bilingurt 433'		, 'Almagro'		, 1736, 5, 'filial25@filial.com', 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 26' 	, 'Cabral 456'			, 'Haedo'		, 1736, 3, 'filial26@filial.com',	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 27' 	, 'Freiman 4531'		, 'Boedo'		, 1453, 4, 'filial27@filial.com', 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 1, 'Filial 28' 	, 'Roca 3434'			, 'V Lugano'	, 1798, 4, 'filial28@filial.com', 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 29' 	, 'Comesaña 2342'		, 'j Ingenieros', 1011, 6, 'filial29@filial.com',	0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 1, 'Filial 30'	, 'Av San Martin 543'	, 'Paternal'	, 1736, 5, 'filial30@filial.com', 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00');


-- Filiales Tel
--

insert into filial_telefono(`filial_id`, `telefono`, `created_at`, `updated_at`) 
values  (1, '12345678'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
    	(1, '87654321'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, '15975365'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, '25875369'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, '95874125'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3, '35698751'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (4, '45875321'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (5, '65874213'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (6, '34343434'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7, '45454545'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8, '23456747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8, '988766545'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9, '45454545'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, '23456747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (11, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (12, '45454545'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (13, '23456747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (14, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
      	(15, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (16, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (17, '45454545'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (18, '23456747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (19, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
      	(20, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (21, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (22, '45454545'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (23, '23456747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (24, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
      	(25, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (26, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (27, '45454545'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (28, '23456747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (29, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
      	(30, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Asesores
--

insert into asesor (`tipo_documento_id`, `nro_documento`, `apellidos`, `nombres`, `direccion`, `localidad`, `filial_id`, `activo`, `created_at`, `updated_at`)
values  (1, 11159752, 'Sosa'  	, 'Victoria', 'Acazuso 897'	, 'Isidro Casanova'	, 3	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 29456789, 'Ruiz'  	, 'Matías'  , 'Castelli 543', 'Ramos Mejia'		, 3	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 15159752, 'Alonso'	, 'Gabriel' , 'Peralta 321'	, 'La Boca'			, 3	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 31876545, 'Ortiz' 	, 'Daniel'  , 'Pola 562'	, 'Flores'			, 3	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 32159752, 'Rojas' 	, 'Jazmin'  , 'Yerbal 2134'	, 'Flores'			, 2	, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 20111123, 'Blanco'	, 'Luciano' , 'Langeri 987'	, 'Santos Lugares'	, 3	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 20159752, 'Paz'   	, 'Emma'    , 'Pizurno 908'	, 'Quilmes'			, 3	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 22008642, 'Correa'	, 'Mario'   , 'Castillo 431', 'Boulogne'		, 1	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 34159752, 'Vera'  	, 'Valeria' , 'El Ombu 653'	, 'San Isidro'		, 3	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 22159752, 'Lucero'	, 'Jimena'  , 'Marconi 764'	, 'R Castillo'		, 1	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 29134568, 'Bruno' 	, 'Alfonso'	, 'Haiti 10987'	, 'Villa Luro'		, 3	, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 32159700, 'Acosta'	, 'Gabriela', 'Chubut 4367'	, 'Villa del Parque', 3	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 31112752, 'Ortega'	, 'Daniela' , 'Villegas 567', 'San Justo'		, 3	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 34133752, 'Romay' 	, 'Luis'  	, 'Honduras 111', 'Palermo'			, 1	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 25156789, 'Perez' 	, 'Luciana' , 'Montiel 567'	, 'Quilmes'			, 2	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 14159752, 'Suarez'	, 'Emanuel' , 'Rafaela 3457', 'Ciudadela'		, 3	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 22154375, 'Genovali', 'Mariela' , 'Alvear 6783'	, 'Villa Sarmiento'	, 2	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 34179045, 'Torres'  , 'Sabrina' , 'Moreno 8765'	, 'El Palomar'		, 11, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 21567932, 'Bianchi'	, 'Pablo'	, 'Cali 5678'	, 'Liniers'			, 3	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 23545632, 'Tiani'	, 'Matias'	, 'Paso 5678'	, 'Ramos Mejia'		, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 29131118, 'Bruno' 	, 'Alfonso'	, 'Maipu 109'	, 'Congreso'		, 3	, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 32111100, 'Acosta'	, 'Gabriela', 'Chubut 4367'	, 'Ramos Mejia'		, 2	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 31444452, 'Ortega'	, 'Daniela' , 'Tolosa 567'	, 'V Soldati'		, 3	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 34111152, 'Romay' 	, 'Luis'  	, 'EL Cedro 111', 'Ciudad vita'		, 1	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 25156189, 'Perez' 	, 'Luciana' , 'Montiel 567'	, 'Liniers'			, 12, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 12159752, 'Suarez'	, 'Emanuel' , 'Beiro 9865'	, 'Devoto'			, 3	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 22444475, 'Genovali', 'Mariela' , 'Rosas 123'	, 'Castelar'		, 2	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 34555545, 'Torres'  , 'Sabrina' , 'Belgrano 434', 'San Martin'		, 3	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 21555552, 'Bianchi'	, 'Pablo'	, 'El rosal 567', 'Merlo'			, 17, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 23555532, 'Tiani'	, 'Matias'	, 'Charcas 3443', 'Once'			, 3	, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00');


-- Asesores Tel
--

insert into asesor_telefono(`asesor_id`, `telefono`, `created_at`, `updated_at`) 
values  (1, '12345678'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
    	(2, '87654321'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3, '15975365'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (4, '25567869'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (5, '95874125'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (6, '35434751'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7, '45875321'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8, '65874213'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9, '34343434'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, '45454545'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (11, '23432747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (12, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (13, '45454545'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (14, '23567747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (15, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (16, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (17, '455555545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (18, '23456747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (19, '98212245'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
      	(20, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (21, '23432747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (22, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (23, '45454545'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (24, '23567747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (25, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (26, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (27, '455555545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (28, '23456747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (29, '98212245'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
      	(30, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00');


-- Asesores mail
--

insert into asesor_mail(`asesor_id`, `mail`, `created_at`, `updated_at`) 
values  (1, 'asesor1@asesor.com.ar'		, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
    	(2, 'asesor2@asesor.com.ar'		, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3, 'asesor3@asesor.com.ar'		, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (4, 'asesor4@asesor.com.ar'		, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (5, 'asesor5@asesor.com.ar'		, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (6, 'asesor6@asesor.com.ar'		, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7, 'asesor7@asesor.com.ar'		, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8, 'asesor8@asesor.com.ar'		, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9, 'asesor9@asesor.com.ar'		, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, 'asesor10@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (11, 'asesor11@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (12, 'asesor12@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (13, 'asesor13@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (14, 'asesor14@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (15, 'asesor15@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (16, 'asesor16@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (17, 'asesor17@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (18, 'asesor18@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (19, 'asesor19@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
      	(20, 'asesor20@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (21, 'asesor21@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (22, 'asesor12@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (23, 'asesor23@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (24, 'asesor24@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (25, 'asesor25@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (26, 'asesor26@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (27, 'asesor27@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (28, 'asesor28@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (29, 'asesor29@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
      	(30, 'asesor30@asesor.com.ar'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Docentes
--

insert into docente (`tipo_documento_id`, `nro_documento`, `apellidos`, `nombres`, `descripcion`, `disponibilidad_manana`, `disponibilidad_tarde`, `disponibilidad_noche`, `disponibilidad_sabados`, `filial_id`, `activo`, `created_at`, `updated_at`)
values  (1, 1076543, 'Avala'		, 'Agustín' , 'Sin Descripción.', 1, 1, 0, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2018187, 'Bravo'		, 'Eric'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2027272, 'Rivas'		, 'Felipe'	, 'Sin Descripción.', 1, 0, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2036363, 'Costa'		, 'Hugo'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2345454, 'Otero'		, 'Pablo'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2054545, 'Russo'		, 'Julia'	, 'Sin Descripción.', 1, 1, 0, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2063636, 'Bruno'		, 'Zoe'		, 'Sin Descripción.', 1, 1, 1, 1, 1, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2073446, 'Funes'		, 'Carla'	, 'Sin Descripción.', 1, 0, 0, 1, 3, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2081818, 'Heras'		, 'Abril'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 1690909, 'Oliva'		, 'Adriana'	, 'Sin Descripción.', 1, 1, 0, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 1318181, 'Fontana'		, 'Roberto'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2023372, 'Torres'		, 'Susana'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 1336363, 'Sicicilo'		, 'Graciela', 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2045454, 'Faber'		, 'Juan'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 3254545, 'Gomez'		, 'Antonio'	, 'Sin Descripción.', 1, 0, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2013136, 'Castiglione'	, 'Carmen'	, 'Sin Descripción.', 1, 1, 1, 1, 2, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2076627, 'Cano'			, 'Carlos'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2000818, 'Requelme'		, 'Mario'	, 'Sin Descripción.', 1, 1, 1, 1, 7, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 0964457, 'Quiroga'		, 'Marcelo'	, 'Sin Descripción.', 1, 0, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2018181, 'Pascrella'	, 'Agusto'	, 'Sin Descripción.', 1, 1, 0, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 3223231, 'Nogues'		, 'Alicia'	, 'Sin Descripción.', 0, 1, 1, 1, 5, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2636363, 'Freile'		, 'Ricardo'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 0945454, 'Oreiro'		, 'Daniel'	, 'Sin Descripción.', 0, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 1754545, 'Macri'		, 'Pablo'	, 'Sin Descripción.', 1, 1, 0, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2263636, 'Medina'		, 'Luis'	, 'Sin Descripción.', 0, 1, 1, 1, 6, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2072727, 'Walker'		, 'Felix'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2001818, 'Baez'			, 'Aldo'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2034567, 'Fernandez'	, 'Pedro'	, 'Sin Descripción.', 1, 0, 1, 1, 6, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2044318, 'Cuniolo'		, 'Lucas'	, 'Sin Descripción.', 1, 0, 1, 0, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2090909, 'Rocha'		, 'Nora'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 3222231, 'Migues'		, 'Raul'	, 'Sin Descripción.', 0, 1, 1, 1, 5, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2222263, 'Figueroa'		, 'Alex'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 0945154, 'Bruno'		, 'Daniela'	, 'Sin Descripción.', 0, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 1888845, 'Oviedo'		, 'Miguel'	, 'Sin Descripción.', 1, 1, 0, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2288636, 'Brignolo'		, 'Oscar'	, 'Sin Descripción.', 0, 1, 1, 1, 6, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2088887, 'Lez'			, 'Cristian', 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2000018, 'Pan'			, 'Pedro'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2034507, 'Vallejo'		, 'Eduardo'	, 'Sin Descripción.', 1, 0, 1, 1, 6, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2066618, 'Rochas'		, 'Karen'	, 'Sin Descripción.', 1, 0, 1, 0, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2066669, 'La Porta'		, 'Ana'		, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Personas
--

insert into persona (`nro_documento`, `tipo_documento_id`, `pais_id`, `apellidos`, `nombres`, `genero`, `fecha_nacimiento`, `domicilio`, `localidad`, `estado_civil`, `nivel_estudios`, `estudio_computacion`, `posee_computadora`, `disponibilidad_manana`, `disponibilidad_tarde`, `disponibilidad_noche`, `disponibilidad_sabados`, `aclaraciones`, `filial_id`, `activo`, `created_at`, `updated_at`)
values  (11670852, 1, 1, 'Bianchi'	 	, 'Marcos'		, 'M', '1050-07-01', 'Av J B Justo 123', 'Caballito', 'Soltero', 'Secundario Completo'	, 	1, 1, 1, 0, 1, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (33856858, 1, 1, 'Palermo'  	, 'Mariano'  	, 'M', '1987-01-22', 'Hilton 432', 'Villa Crespo', 'Soltero', 'Terciario'			 	, 	1, 0, 1, 1, 0, 1, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (32822221, 1, 1, 'Quinteros'	, 'Ezequiel' 	, 'M', '1986-01-14', 'Nolting 435', 'Ciudadela', 'Soltero', 'Terciario'			 		, 	0, 1, 1, 0, 1, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (30844448, 1, 1, 'Montoya'  	, 'Brenda'		, 'F', '1984-12-01', 'Belgrano 567', 'Haedo', 'Soltera', 'Universitario'		 		, 	1, 0, 1, 0, 0, 1, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (20856851, 1, 1, 'Zarate'   	, 'Sofía'	  	, 'F', '1970-06-01', 'Espora 543', 'Haedo', 'Soltera', 'Secundario Completo'			, 	1, 1, 1, 1, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (34854568, 1, 1, 'Prato'	 	, 'Julían'	  	, 'M', '1988-09-01', 'Bs As 4567', 'Ezeiza', 'Soltero', 'Terciario'			 			, 	0, 1, 1, 0, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (20256851, 1, 1, 'Barrera'	 	, 'Franco'	  	, 'M', '1971-02-01', 'Av de Mayo 567', 'Ramos Mejia', 'Casado' , 'Universitario'		, 	1, 1, 1, 0, 1, 1, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (35758856, 1, 1, 'Cisneros' 	, 'Jazmin'	  	, 'F', '1990-01-01', 'Colon 5432', 'Mataderos', 'Casada' , 'Universitario'		 		, 	1, 1, 1, 0, 0, 0, null, 1, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (27856851, 1, 1, 'Nuñez'	 	, 'Florencia'	, 'F', '1975-11-12', 'Jujuy 347', 'Once', 'Casada' , 'Terciario'			 			, 	1, 0, 1, 0, 0, 0, null, 1, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (30877759, 1, 1, 'Puyt'	 		, 'Daniela'  	, 'F', '1984-01-12', 'Ombu 5467', 'San Justo', 'Casada' , 'Secundario Completo'			, 	1, 1, 1, 0, 0, 0, null, 1, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (25876558, 1, 1, 'Luna'  		, 'Santiago'  	, 'M', '1980-01-09', 'Cabral 3456', 'Morón', 'Viudo', 'Terciario'			 			, 	1, 1, 1, 0, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (32832571, 1, 1, 'Marquez'		, 'Diego' 	  	, 'M', '1986-09-15', 'Nicaragua 456', 'Olivos', 'Soltero', 'Terciario'			 		, 	1, 0, 1, 0, 1, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (30856851, 1, 1, 'Montel'  		, 'Sofia'	  	, 'F', '1984-01-01', 'Balbin 1234', 'San Martin', 'Soltera', 'Universitario'		 	, 	0, 1, 1, 0, 0, 1, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10856858, 1, 1, 'Mendez'   	, 'Fernando'	, 'M', '1950-01-16', 'Yerbal 6543', 'Flores', 'Soltero', 'Secundario Completo'			, 	1, 1, 1, 1, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (20834581, 1, 1, 'Fernandez'	, 'Julio'	  	, 'M', '1970-06-01', 'Cuevas 4567', 'Villa Luro', 'Soltero', 'Terciario'			 	, 	1, 1, 1, 0, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (20856857, 1, 1, 'Gutierrez'	, 'Camilo'	  	, 'M', '1971-01-01', 'Av Cordoba 5643', 'Palermo', 'Casado' , 'Universitario'		 	, 	1, 0, 1, 1, 1, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (25856851, 1, 1, 'Cervatte' 	, 'Cristina'	, 'F', '1976-01-08', 'Vieytes 643', 'Ciudadela', 'Casada' , 'Universitario'		 		, 	0, 1, 1, 0, 0, 0, null, 1, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (30647891, 1, 1, 'Kuz'	 		, 'Gerardo'		, 'M', '1984-08-01', 'Hornos 3214', 'Castelar', 'Casado' , 'Terciario'			 		, 	1, 0, 1, 1, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (33438952, 1, 1, 'Kawalina'		, 'Jorge'  		, 'M', '1987-01-08', 'Chacabuco 325', 'Merlo', 'Casado' , 'Secundario Completo'			, 	0, 1, 1, 0, 1, 0, null, 1, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
    	(33000764, 1, 1, 'Fariñas'		, 'Laura'  		, 'F', '1987-05-06', 'Artigas 675', 'Floresta', 'Casada' , 'Secundario Completo'		, 	1, 1, 1, 1, 0, 0, null, 1, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (30432129, 1, 1, 'Paint'	 	, 'Daniela'  	, 'F', '1984-01-12', 'Yapeyu 5467', 'San Martin', 'Casada' , 'Secundario Completo'		, 	1, 1, 1, 0, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (25434342, 1, 1, 'Ruiz'  		, 'Oscar'  		, 'M', '1980-02-05', 'Calle 54 3545', 'La Plata', 'Viudo', 'Terciario'			 		, 	1, 1, 1, 0, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (32877751, 1, 1, 'Giaconni'		, 'Silvia' 	  	, 'F', '1986-09-01', 'Cuba 456', 'Belgrano', 'Soltera', 'Terciario'			 			, 	1, 0, 1, 0, 1, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (30232344, 1, 1, 'Zalazar'  	, 'Matias'	  	, 'M', '1984-01-01', 'San Ramón 1234', 'Villa Bosh', 'Soltero', 'Universitario'		 	, 	0, 1, 1, 0, 0, 1, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10811122, 1, 1, 'Gimenez'   	, 'Susana'		, 'F', '1950-07-06', 'Caseros 6543', 'Villa Ballester', 'Soltero', 'Secundario Completo', 	1, 1, 1, 1, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (20243443, 1, 1, 'Civilla'		, 'Federico'	, 'M', '1970-06-01', 'Maipu 4567', 'Ciudadela', 'Soltero', 'Terciario'			 		, 	1, 1, 1, 0, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (20800857, 1, 1, 'Gonzalez'		, 'Ariel'	  	, 'M', '1971-10-01', 'Suipacha 345', 'Ramo Mejia', 'Casado' , 'Universitario'		 	, 	1, 0, 1, 1, 1, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (25676762, 1, 1, 'Davalos' 		, 'Brian'		, 'M', '1976-08-08', 'Av La plata 643', 'Boedo', 'Casado' , 'Universitario'		 		, 	0, 1, 1, 0, 0, 0, null, 1, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (30434641, 1, 1, 'Ponce'	 	, 'Karina'		, 'F', '1984-08-01', 'Hornos 4673', 'Caseros', 'Casada' , 'Terciario'			 		, 	1, 0, 1, 1, 0, 0, null, 1, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (33467565, 1, 1, 'Garcia'		, 'Laura'  		, 'F', '1987-01-08', 'Chacabuco 325', 'Ciudadela', 'Casada' , 'Secundario Completo'		, 	0, 1, 1, 0, 1, 0, null, 1, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (30434129, 1, 1, 'Leguizar'		, 'Esteban'  	, 'M', '1984-01-12', 'Jaguel 1234', 'San Isidro', 'Casada' , 'Secundario Completo'		, 	1, 1, 1, 0, 0, 0, null, 1, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (25600002, 1, 1, 'Aguirre'  	, 'Rocio'  		, 'F', '1980-11-22', 'Perón 3545', 'Belgrano', 'Viudo', 'Terciario'			 			, 	1, 1, 1, 0, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (32812751, 1, 1, 'Porcel'		, 'Claudio' 	, 'M', '1986-09-01', 'Cuba 300', 'Belgrano', 'Soltera', 'Terciario'			 			, 	1, 0, 1, 0, 1, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (30232399, 1, 1, 'Quiñones'  	, 'Gastón'	  	, 'M', '1984-11-06', 'Av Rivadavia 11111', 'Liniers', 'Soltero', 'Universitario'		, 	0, 1, 1, 0, 0, 1, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10899992, 1, 1, 'Rodriguez'   	, 'Erica'		, 'F', '1950-01-06', 'Montero 6522', 'Florida', 'Soltero', 'Secundario Completo'		, 	1, 1, 1, 1, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (20255543, 1, 1, 'Gatica'		, 'Daniel'		, 'M', '1970-12-02', 'El Tabu 567', 'Ciudad Evita', 'Soltero', 'Terciario'			 	, 	1, 1, 1, 0, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (20864657, 1, 1, 'Dadamo'		, 'Diego'	  	, 'M', '1971-09-10', 'Colón 1345', 'Ramo Mejia', 'Casado' , 'Universitario'		 		, 	1, 0, 1, 1, 1, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (21111762, 1, 1, 'Figueroa' 	, 'Saul'		, 'M', '1976-01-08', 'Jujuy 1643', 'Once', 'Casado' , 'Universitario'		 			, 	0, 1, 1, 0, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (30222221, 1, 1, 'Nieva'	 	, 'Luciana'		, 'F', '1984-08-01', 'Sabatini 3673', 'Caseros', 'Casada' , 'Terciario'			 		, 	1, 0, 1, 1, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (33333333, 1, 1, 'Torres'		, 'Camila'  	, 'F', '1987-09-08', 'Av g Paz 325', 'Mataderos', 'Casada' , 'Secundario Completo'		, 	0, 1, 1, 0, 1, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (30224422, 1, 1, 'Sosa'			, 'Anibal'  	, 'M', '1984-01-12', 'Alvear 1234', 'La Boca', 'Casada' , 'Secundario Completo'			, 	1, 1, 1, 0, 0, 0, null, 1, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (25444402, 1, 1, 'Medina'  		, 'Marcela'  	, 'M', '1980-11-22', 'Belgrano 3545', 'Villa Crespo', 'Viudo', 'Terciario'			 	, 	1, 1, 1, 0, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (32812750, 1, 1, 'Mendez'		, 'Lucas' 		, 'M', '1986-09-01', 'Salta 300', 'San Justo', 'Soltera', 'Terciario'			 		, 	1, 0, 1, 0, 1, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (30266699, 1, 1, 'Segovia'  	, 'Jonathan'	, 'M', '1984-11-09', 'Donofrio 345', 'Liniers', 'Soltero', 'Universitario'				, 	0, 1, 1, 0, 0, 1, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10111992, 1, 1, 'Bruno'   		, 'Soledad'		, 'F', '1950-01-06', 'Sarmiento 6522', 'Olivos', 'Soltero', 'Secundario Completo'		, 	1, 1, 1, 1, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (20221543, 1, 1, 'Silvio'		, 'Leonel'		, 'M', '1970-12-13', 'Rafaela 2567', 'Ciudadela', 'Soltero', 'Terciario'			 	, 	1, 1, 1, 0, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (20864457, 1, 1, 'Gomez'		, 'Hernán'	  	, 'M', '1971-09-10', 'Paso 2245', 'Ramo Mejia', 'Casado' , 'Universitario'		 		, 	1, 0, 1, 1, 1, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (21000062, 1, 1, 'Roque' 		, 'Cristian'	, 'M', '1976-02-11', 'Tejedor 1443', 'Caseros', 'Casado' , 'Universitario'		 		, 	0, 1, 1, 0, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (30272221, 1, 1, 'Codutti'	 	, 'Daniela'		, 'F', '1984-12-01', 'Suipacha 343', 'Mataderos', 'Casada' , 'Terciario'			 	, 	1, 0, 1, 1, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (33367633, 1, 1, 'Paldino'		, 'Sandra'  	, 'F', '1987-11-08', 'Directorio 1325', 'Mataderos', 'Casada' , 'Secundario Completo'	, 	0, 1, 1, 0, 1, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00');


-- Personas Tel
--

insert into persona_telefono(`persona_id`, `telefono`, `created_at`, `updated_at`) 
values  (1, '12345678'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
    	(2, '87654321'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3, '15975365'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (4, '25567869'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (5, '95874125'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (6, '35434751'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7, '45875321'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8, '65874213'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9, '34343434'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, '45454545'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (11, '23432747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (12, '98876654'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (13, '45454545'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (14, '23567747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (15, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (16, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (17, '455555545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (18, '23456747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (19, '98212245'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
      	(20, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (21, '23432747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (22, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (23, '45454545'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (24, '23567747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (25, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (26, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (27, '455555545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (28, '23456747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (29, '98212245'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
      	(30, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (31, '23432747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (32, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (33, '45454545'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (34, '23567747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (35, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (36, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (37, '455555545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (38, '23456747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (39, '98212245'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
      	(40, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (41, '23432747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (42, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (43, '45454545'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (44, '23567747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (45, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (46, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (47, '455555545', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (48, '23456747'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (49, '98212245'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
      	(50, '988766545', '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Personas Mails
--

insert into persona_mail (`persona_id`, `mail`, `created_at`, `updated_at`)
values  (1 , 'persona1@persona.com'		, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2 , 'persona2@persona.com' 	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3 , 'persona3@persona.com'		, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (4 , 'persona4@persona.com'		, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (5 , 'persona5@persona.com'		, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (6 , 'persona6@persona.com'		, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7 , 'persona7@persona.com'		, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8 , 'persona8@persona.com'		, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9 , 'persona9@persona.com'		, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, 'persona10@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (11, 'persona11@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (12, 'persona12@persona.com' 	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (13, 'persona13@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (14, 'persona14@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (15, 'persona15@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (16, 'persona16@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (17, 'persona17@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (18, 'persona18@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (19, 'persona19@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (20, 'persona20@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (21, 'persona21@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (22, 'persona22@persona.com' 	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (23, 'persona23@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (24, 'persona24@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (25, 'persona25@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (26, 'persona26@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (27, 'persona27@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (28, 'persona28@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (29, 'persona29@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (30, 'persona30@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (31, 'persona31@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (32, 'persona32@persona.com' 	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (33, 'persona33@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (34, 'persona34@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (35, 'persona35@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (36, 'persona36@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (37, 'persona37@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (38, 'persona38@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (39, 'persona39@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (40, 'persona40@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (41, 'persona41@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (42, 'persona42@persona.com' 	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (43, 'persona43@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (44, 'persona44@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (45, 'persona45@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (46, 'persona46@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (47, 'persona47@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (48, 'persona48@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (49, 'persona49@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (50, 'persona50@persona.com'	, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Preeinformes
--
insert into preinforme (`persona_id`, `asesor_id`, `descripcion`, `medio`, `como_encontro`, `filial_id`, `created_at`, `updated_at`) 
values 	(1,		4, 'Interesado'		, 'publicidad'	, 'TV'			, 3, '2016-11-11 00:00:00.000000', '2016-11-11 00:00:00.000000'),
		(2,		4, 'Vuelve dps'		, 'publicidad'	, 'Internet'	, 3, '2016-11-11 00:00:00.000000', '2016-11-11 00:00:00.000000'),
 		(3,		8, 'Se com por tel'	, 'publicidad'	, 'Revista'		, 3, '2016-11-11 00:00:00.000000', '2016-11-11 00:00:00.000000'),
 		(4, 	4, 'Nada'			, 'publicidad'	, 'Universidad'	, 3, '2016-11-11 00:00:00.000000', '2016-11-11 00:00:00.000000'),
		(8, 	4, 'Se anota'		, 'publicidad'	, 'Publicidad'	, 3, '2016-11-11 00:00:00.000000', '2016-11-11 00:00:00.000000'),
 		(10, 	2, 'Muy convencido'	, 'publicidad'	, 'Internet'	, 3, '2016-11-11 00:00:00.000000', '2016-11-11 00:00:00.000000'),
 		(13, 	4, 'Sospechoso'		, 'publicidad'	, 'Radio'		, 2, '2016-11-11 00:00:00.000000', '2016-11-11 00:00:00.000000'),
		(14, 	1, 'Vuelve dps'		, 'publicidad'	, 'Comentario'	, 3, '2016-11-11 00:00:00.000000', '2016-11-11 00:00:00.000000'),
 		(20, 	3, 'Se com por tel'	, 'publicidad'	, 'Trabajo'		, 3, '2016-11-11 00:00:00.000000', '2016-11-11 00:00:00.000000'),
 		(24, 	4, 'Nada'			, 'publicidad'	, 'Transporte'	, 3, '2016-11-11 00:00:00.000000', '2016-11-11 00:00:00.000000'),
		(26, 	2, 'Se anota'		, 'publicidad'	, 'Diario'		, 3, '2016-11-11 00:00:00.000000', '2016-11-11 00:00:00.000000'),
 		(27,	1, 'Muy convencido'	, 'publicidad'	, 'Internet'	, 3, '2016-11-11 00:00:00.000000', '2016-11-11 00:00:00.000000'),
 		(28, 	4, 'Sospechoso'		, 'publicidad'	, 'TV'			, 1, '2016-11-11 00:00:00.000000', '2016-11-11 00:00:00.000000'),
 		(14, 	1, 'No Cocina'		, 'publicidad'	, 'Anuncio'		, 3, '2016-11-11 00:00:00.000000', '2016-11-11 00:00:00.000000'),
 		(20, 	3, 'Se com por tel'	, 'publicidad'	, 'Trabajo'		, 3, '2016-11-11 00:00:00.000000', '2016-11-11 00:00:00.000000'),
 		(24, 	4, 'Nada'			, 'publicidad'	, 'Internet'	, 1, '2016-11-11 00:00:00.000000', '2016-11-11 00:00:00.000000'),
		(26, 	2, 'Nada'			, 'publicidad'	, 'TV'			, 3, '2016-11-11 00:00:00.000000', '2016-11-11 00:00:00.000000'),
 		(27,	1, 'Llama dps'		, 'publicidad'	, 'Filial'		, 1, '2016-11-11 00:00:00.000000', '2016-11-11 00:00:00.000000'),
 		(28, 	4, 'Interesado'		, 'publicidad'	, 'Radio'		, 3, '2016-11-11 00:00:00.000000', '2016-11-11 00:00:00.000000'),
 		(35, 	4, 'No sabe'		, 'publicidad'	, 'TV'			, 3, '2016-11-11 00:00:00.000000', '2016-11-11 00:00:00.000000');

--
-- Cursos
--

insert into curso (`id`, `nombre`, `duracion`, `descripcion`, `taller`,`lenguaje`, `created_at`, `updated_at`)
values  (1 , 'Introducción a la cocina'			, '1 Año'	, 'Sin Descripción.', 0,'es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2 , 'Panaderia Artesanal'				, '4 Meses'	, 'Sin Descripción.', 0,'es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3 , 'Pasteleria Artesanal' 			, '4 Meses'	, 'Sin Descripción.', 0,'es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (4 , 'Reposteria Artesanal' 			, '1 Año'	, 'Sin Descripción.', 1,'es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (5 , 'Servicio de salón' 				, '50 Días'	, 'Sin Descripción.', 0,'es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (6 , 'Cocina Internacional' 			, '20 Días'	, 'Sin Descripción.', 0,'es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7 , 'Enología y Maridaje' 				, '15 Días'	, 'Sin Descripción.', 0,'es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8 , 'Barman y Tragos' 					, '50 Días'	, 'Sin Descripción.', 1,'es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9 , 'Conservas y Destilados' 			, '50 Días'	, 'Sin Descripción.', 0,'es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, 'Cocin y beffet'					, '50 Días'	, 'Sin Descripción.', 0,'es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
    	(11, 'Pasteleria'						, '50 Días'	, 'Sin Descripción.', 0,'es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (12, 'Bebidas y Servicios'				, '50 Días'	, 'Sin Descripción.', 0,'es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (13, 'Admin y Marketing Gastronómico'	, '60 Días'	, 'Sin Descripción.', 0,'es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (14, 'Intensivos'						, '15 Días'	, 'Sin Descripción.', 1,'es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (15, 'Admin de cocina'					, '60 Días'	, 'Sin Descripción.', 1,'es', '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Carreras
--

insert into carrera (`id`, `nombre`, `duracion`, `descripcion`,`lenguaje`, `created_at`, `updated_at`)
values  (1 , 'Profesional Gastronómico'			, '1 Año'	, 'Sin Descripción.','es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2 , 'Técnico Superior Gastronómico'	, '3 Años'	, 'Sin Descripción.','es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3 , 'Licenciatura en Gastronomía' 		, '4 Años'	, 'Sin Descripción.','es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (4 , 'Pastelero Profesional' 			, '6 Meses'	, 'Sin Descripción.','es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (5 , 'Sommelier Profesional' 			, '2 Años'	, 'Sin Descripción.','es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (6 , 'Profesional Bartender' 			, '5 Años'	, 'Sin Descripción.','es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7 , 'Esp en direccion de rest.' 		, '6 Meses'	, 'Sin Descripción.','es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8 , 'Crítico gastronómico' 			, '2 años'	, 'Sin Descripción.','es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9 , 'Gerenciamiento gastronómico' 		, '3 Años'	, 'Sin Descripción.','es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, 'Tec superior en admin hotelera'	, '3 Años'	, 'Sin Descripción.','es', '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Materias
--

insert into materia (`carrera_id`, `nombre`, `descripcion`, `created_at`, `updated_at`)
values  (1 , 'Cocina Básica y Servicio'						, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1 , 'Panadería' 									, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1 , 'Pastelería' 									, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2 , 'Cocina Argentina y Latinoamericana'			, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2 , 'Cocina Internacional' 						, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3 , 'Enología y Maridaje' 							, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3 , 'Repostería' 									, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1 , 'Barman' 										, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (4 , 'Repostería Inicial y Repostería Avanzada' 	, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (5 , 'Legislación y Admin de personal'				, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (5 , 'Comercialización'								, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1 , 'Relaciones públicas y congresos'				, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (6 , 'Arte Culinario'								, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7 , 'Gestión de la calidad gastronómica'			, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7 , 'Gestión de alimentos y bebidas'				, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8 , 'Cocina Industrial'							, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1 , 'Cocina Básica y Servicio'						, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9 , 'Prácticas en Eventos'							, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9 , 'Planificación y organización del servicio'	, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 'Organización de eventos'						, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, 'Materias Primas y Nutrición'					, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7 , 'Elaboración del Menú'							, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7 , 'Diseño y Ambientación de Restaurantes'		, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1 , 'Cultura y Crítica Gastronómica'				, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8 , 'Prácticas para la Elaboración de Alimentos'	, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1 , 'Instalación y Equipamientos Gastronómicos'	, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9 , 'Costos y Compras'								, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 'Informática General y Aplicada'				, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, 'Francés Gastronómico'							, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1 , 'Cocina I'										, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9 , 'Cocina fría'									, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 'Pastas y Salsas'								, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, 'Cocina asiatica'								, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1 , 'Cocina II'									, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9 , 'Nutrición I'									, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 'Contabilidad y costos'							, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (6, 'Gestión de personal'							, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 'Inglés técnico'								, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (6, 'Nutrición II'									, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1 , 'Tecnología alimentaria'						, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (5 , 'Cocina dietoterápica'							, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 'Historia de la cultura'						, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, 'Diseño, equipamiento y seguridad'				, 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--	
-- Matrículas
--

insert into matricula (`persona_id`, `curso_id`, `carrera_id`, `filial_id`, `asesor_id`, `activo`, `terminado`, `cancelado`, `created_at`, `updated_at`)
values  (1 , 1	 , null, 3, 1, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2 , 1	 , null, 3, 1, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3 , 1	 , null, 3, 1, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (4 , 1	 , null, 3, 1, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (5 , 1	 , null, 3, 1, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (6 , null, 1   , 3, 2, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7 , null, 1   , 3, 2, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8 , null, 1   , 1, 2, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9 , null, 1   , 1, 2, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, null, 1   , 1, 2, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1 , 2	 , null, 3, 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2 , 2	 , null, 3, 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3 , 2	 , null, 3, 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (4 , 2	 , null, 3, 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (5 , 2	 , null, 3, 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (6 , null, 2   , 3, 4, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7 , null, 2   , 3, 4, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8 , null, 2   , 1, 4, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9 , null, 2   , 1, 4, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, null, 2   , 1, 4, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (14 , 3	 , null, 3, 5, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (11 , 3	 , null, 3, 5, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (17 , 4	 , null, 3, 5, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (19 , 3	 , null, 3, 5, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (20 , 4	 , null, 3, 5, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (11 , null, 3   , 3, 6, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7 , null, 3   , 3, 6, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8 , null, 3   , 1, 6, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9 , null, 3   , 1, 6, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, null, 3   , 1, 6, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00');


--
-- Pagos
--

insert into pago (`matricula_id`, `tipo_moneda_id`, `nro_pago`, `pago_individual`, `descripcion`, `terminado`, `vencimiento`,`monto_original`, `monto_actual`, `monto_pago`, `descuento`, `recargo`, `filial_id`, `created_at`, `updated_at`)
values  (1000, 1,  0, 0, 'Sin Descripción.', 0, '2015-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1000, 1,  1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1000, 1,  2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1001, 1,  0, 0, 'Sin Descripción.', 0, '2015-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1001, 1,  1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1001, 1,  2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1002, 1,  0, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1002, 1,  1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1002, 1,  2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1003, 1,  0, 0, 'Sin Descripción.', 0, '2015-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1003, 1,  1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1003, 1,  2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1004, 1,  0, 0, 'Sin Descripción.', 0, '2015-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1004, 1,  1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1004, 1,  2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1005, 1,  0, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1005, 1,  1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1005, 1,  2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1006, 1,  0, 0, 'Sin Descripción.', 0, '2015-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1006, 1,  1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1006, 1,  2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1007, 1,  0, 0, 'Sin Descripción.', 0, '2015-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1007, 1,  1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1007, 1,  2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1008, 1,  0, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1008, 1,  1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1008, 1,  2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1009, 1,  0, 0, 'Sin Descripción.', 0, '2015-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1009, 1,  1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1009, 1,  2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1010, 1, 0, 0, 'Sin Descripción.', 0, '2015-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1010, 1, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1010, 1, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1011, 1, 0, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1011, 1, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1011, 1, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1012, 1, 0, 0, 'Sin Descripción.', 0, '2015-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1012, 1, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1012, 1, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1013, 1, 0, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1013, 1, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1013, 1, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1014, 1, 0, 0, 'Sin Descripción.', 0, '2015-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1014, 1, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1014, 1, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1015, 1, 0, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1015, 1, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1015, 1, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1016, 1, 0, 0, 'Sin Descripción.', 0, '2015-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1016, 1, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1016, 1, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1017, 1, 0, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1017, 1, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1017, 1, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1018, 1, 0, 0, 'Sin Descripción.', 0, '2015-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1018, 1, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1018, 1, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1019, 1, 0, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1019, 1, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1019, 1, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1020, 1, 0, 0, 'Sin Descripción.', 0, '2015-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1020, 1, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1020, 1, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1021, 1, 0, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1021, 1, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1021, 1, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1022, 1, 0, 0, 'Sin Descripción.', 0, '2015-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1022, 1, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1022, 1, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1023, 1, 0, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1023, 1, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1023, 1, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1024, 1, 0, 0, 'Sin Descripción.', 0, '2015-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1024, 1, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1024, 1, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1025, 1, 0, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1025, 1, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1025, 1, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1026, 1, 0, 0, 'Sin Descripción.', 0, '2015-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1026, 1, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1026, 1, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1027, 1, 0, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1027, 1, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1027, 1, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1028, 1, 0, 0, 'Sin Descripción.', 0, '2015-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1028, 1, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1028, 1, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1029, 1, 0, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1029, 1, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1029, 1, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Aulas
--

insert into aula (`nombre`, `filial_id`, `created_at`, `updated_at`) 
values 	('AA123'	, '3', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
		('AA124'	, '3', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('AA125'	, '3', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
		('AA10'		, '3', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('AA11'		, '3', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('AA12'		, '3', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('AA90'		, '3', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('AA96'		, '3', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('1'		, '1', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('2'		, '1', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
		('3'		, '1', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('4'		, '1', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('5'		, '1', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('6'		, '1', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('XX14'		, '5', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('XX15'		, '5', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('XX16'		, '5', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('XX17'		, '5', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('1001'		, '8', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('1002'		, '8', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('1003'		, '8', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('1004'		, '8', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('AA200'	, '3', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
		('AA201'	, '3', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('AA202'	, '3', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('AA203'	, '3', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('AA204'	, '3', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('AA205'	, '3', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('111'		, '2', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('112'		, '2', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
		('113'		, '2', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('114'		, '2', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('115'		, '2', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('116'		, '2', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('SS14'		, '7', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('SS15'		, '7', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('SS16'		, '7', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('SS17'		, '7', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('A1001'	, '10', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('A1002'	, '10', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('A1003'	, '10', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	 	('A1004'	, '10', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');


--
-- Grupos
--

insert into grupo (`curso_id`, `carrera_id`, `descripcion`, `docente_id`, `nuevo`, `turno_manana`, `turno_tarde`, `turno_noche`, `sabados`, `color`, `fecha_inicio`, `fecha_fin`, `filial_id`, `activo`, `terminado`, `cancelado`, `created_at`, `updated_at`)
values  (1	 , null,  'Grupo 1'	, 1, 0, 1, 1, 1, 1, '#563d7c', '2017-01-02', '2017-03-01', 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(2	 , null,  'Grupo 2'	, 2, 0, 1, 1, 1, 1, '#b90000', '2017-01-02', '2017-03-01', 1, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(3	 , null,  'Grupo 3'	, 3, 0, 1, 1, 1, 1, '#8000ff', '2017-01-02', '2017-03-01', 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(null, 2    , 'Grupo 4'	, 4, 0, 1, 1, 1, 1, '#2d2d2d', '2017-01-02', '2017-03-01', 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(null, 3    , 'Grupo 5'	, 5, 0, 1, 1, 1, 1, '#892e2e', '2017-01-02', '2017-03-01', 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(null, 1    , 'Grupo 6'	, 6, 0, 1, 1, 1, 1, '#3f1afa', '2017-01-02', '2017-03-01', 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(null, 5    , 'Grupo 7'	, 7, 0, 1, 1, 1, 1, '#c6c752', '2017-01-02', '2017-03-01', 1, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(null, 7   	, 'Grupo 8'	, 8, 0, 1, 1, 1, 1, '#39bc8c', '2017-01-02', '2017-03-01', 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(null, 1    , 'Grupo 9'	, 4, 0, 1, 1, 1, 1, '#2d2d2d', '2016-12-01', '2017-01-01', 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(null, 9    , 'Grupo 10', 5, 0, 1, 1, 1, 1,	'#892e2e', '2016-12-01', '2017-01-01', 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(null, 9    , 'Grupo 11', 8, 0, 1, 1, 1, 1,	'#3f1afa', '2016-12-01', '2017-01-01', 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(null, 1    , 'Grupo 12', 9, 0, 1, 1, 1, 1,	'#c6c752', '2016-12-01', '2017-01-01', 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(null, 7   	, 'Grupo 13', 9, 0, 1, 1, 1, 1,	'#39bc8c', '2016-12-01', '2017-01-01', 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(null, 8    , 'Grupo 14', 11,0, 1, 1, 1 ,1,	'#c6c752', '2016-12-01', '2017-01-01', 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(null, 9   	, 'Grupo 15', 2, 0, 1, 1, 1, 1, '#39bc8c', '2016-12-01', '2017-01-01', 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00');
--	
-- Grupo Horarios
--

insert into grupo_horario (`grupo_id`, `dia`, `horario_desde`, `horario_hasta`, `materia_id`, `aula_id`, `created_at`, `updated_at`)
values (1,	'Lunes'		, '13:00:00', '17:00:00',1	,1, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (2, 	'Martes'	, '13:00:00', '17:00:00',4	,5, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (3, 	'Jueves'	, '13:00:00', '17:00:00',7	,2,'0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (4, 	'Viernes'	, '13:00:00', '17:00:00',5	,3, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (5, 	'Lunes'		, '13:00:00', '17:00:00',6	,25, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (6, 	'Viernes'	, '13:00:00', '17:00:00',8	,6, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (7, 	'Viernes'	, '13:00:00', '17:00:00',10	,24, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (8, 	'Jueves'	, '13:00:00', '17:00:00',15	,7, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
   	   (9, 	'Lunes'		, '12:00:00', '18:00:00',17	,5, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (10, 'Martes'	, '12:00:00', '18:00:00',18	,2,'0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (11, 'Miercoles'	, '12:00:00', '18:00:00',19	,3, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (12, 'Jueves'	, '12:00:00', '18:00:00',20	,25, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (13, 'Viernes'	, '12:00:00', '18:00:00',22	,6, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (14, 'Jueves'	, '12:00:00', '18:00:00',25	,24, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (15, 'Viernes'	, '12:00:00', '18:00:00',27	,7, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');
--
-- Grupo Matrícula
--

insert into grupo_matricula (`grupo_id`, `matricula_id`, `created_at`, `updated_at`)
values (1, 1000, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (1, 1002, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (1, 1003, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (1, 1004, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (1, 1005, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (1, 1006, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (2, 1007, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (2, 1008, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (2, 1009, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (3, 1017, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (3, 1018, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (3, 1019, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (4, 1027, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (4, 1028, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (4, 1029, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (5, 1010, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (5, 1011, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (5, 1012, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (5, 1013, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (5, 1014, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (6, 1015, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (6, 1016, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (6, 1020, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (6, 1021, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (7, 1022, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (7, 1023, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (7, 1024, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (8, 1025, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
	   (8, 1026, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

--
-- Clase Estado
--

insert into clase_estado (`estado`, `created_at`, `updated_at`)
values  ('Pendiente', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
        ('Cancelada', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
        ('Finalizada', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Clase
--

insert into clase (`clase_estado_id`, `grupo_id`, `fecha`, `docente_id`, `dia`, `horario_desde`, `horario_hasta`, `materia_id`, `aula_id`, `enviado`, `descripcion`, `created_at`, `updated_at`)
values 	(1, 1, '2017-01-02 00:00:00', 1, 0, '13:00:00', '15:00:00',4,1, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 1, '2017-01-09 00:00:00', 1, 0, '13:00:00', '15:00:00',4,1, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 1, '2017-01-16 00:00:00', 1, 0, '13:00:00', '15:00:00',4,1, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 1, '2017-01-23 00:00:00', 1, 0, '13:00:00', '15:00:00',4,1, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 1, '2017-01-30 00:00:00', 1, 0, '13:00:00', '15:00:00',4,1, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 1, '2017-02-06 00:00:00', 1, 0, '13:00:00', '15:00:00',4,1, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 1, '2017-02-13 00:00:00', 1, 0, '13:00:00', '15:00:00',4,1, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 1, '2017-02-20 00:00:00', 1, 0, '13:00:00', '15:00:00',4,1, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 1, '2017-02-27 00:00:00', 1, 0, '13:00:00', '15:00:00',4,1, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 2, '2017-01-03 00:00:00', 1, 1, '13:00:00', '15:00:00',5,5, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 2, '2017-01-10 00:00:00', 1, 1, '13:00:00', '15:00:00',5,5, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 2, '2017-01-17 00:00:00', 1, 1, '13:00:00', '15:00:00',5,5, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 2, '2017-01-24 00:00:00', 1, 1, '13:00:00', '15:00:00',5,5, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 2, '2017-01-31 00:00:00', 1, 1, '13:00:00', '15:00:00',5,5, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 2, '2017-02-07 00:00:00', 1, 1, '13:00:00', '15:00:00',5,5, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 2, '2017-02-14 00:00:00', 1, 1, '13:00:00', '15:00:00',5,5, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 2, '2017-02-21 00:00:00', 1, 1, '13:00:00', '15:00:00',5,5, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 2, '2017-02-28 00:00:00', 1, 1, '13:00:00', '15:00:00',5,5, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 3, '2017-01-05 00:00:00', 1, 3, '13:00:00', '15:00:00',10,2, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 3, '2017-01-12 00:00:00', 1, 3, '13:00:00', '15:00:00',10,2, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 3, '2017-01-19 00:00:00', 1, 3, '13:00:00', '15:00:00',10,2, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 3, '2017-01-26 00:00:00', 1, 3, '13:00:00', '15:00:00',10,2, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 3, '2017-02-02 00:00:00', 1, 3, '13:00:00', '15:00:00',10,2, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 3, '2017-02-09 00:00:00', 1, 3, '13:00:00', '15:00:00',10,2, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 3, '2017-02-16 00:00:00', 1, 3, '13:00:00', '15:00:00',10,2, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 3, '2017-02-23 00:00:00', 1, 3, '13:00:00', '15:00:00',10,2, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 4, '2017-01-06 00:00:00', 1, 4, '13:00:00', '15:00:00',2,7, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 4, '2017-01-13 00:00:00', 1, 4, '13:00:00', '15:00:00',2,7, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 4, '2017-01-20 00:00:00', 1, 4, '13:00:00', '15:00:00',2,7, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 4, '2017-01-27 00:00:00', 1, 4, '13:00:00', '15:00:00',2,7, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 4, '2017-02-03 00:00:00', 1, 4, '13:00:00', '15:00:00',2,7, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 4, '2017-02-10 00:00:00', 1, 4, '13:00:00', '15:00:00',2,7, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 4, '2017-02-17 00:00:00', 1, 4, '13:00:00', '15:00:00',2,7, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 4, '2017-02-24 00:00:00', 1, 4, '13:00:00', '15:00:00',2,7, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 5, '2017-01-02 00:00:00', 1, 0, '13:00:00', '15:00:00',1,9, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 5, '2017-01-09 00:00:00', 1, 0, '13:00:00', '15:00:00',1,9, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 5, '2017-01-16 00:00:00', 1, 0, '13:00:00', '15:00:00',1,9, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 5, '2017-01-23 00:00:00', 1, 0, '13:00:00', '15:00:00',1,9, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 5, '2017-01-30 00:00:00', 1, 0, '13:00:00', '15:00:00',1,9, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 5, '2017-02-06 00:00:00', 1, 0, '13:00:00', '15:00:00',1,9, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 5, '2017-02-13 00:00:00', 1, 0, '13:00:00', '15:00:00',1,9, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 5, '2017-02-20 00:00:00', 1, 0, '13:00:00', '15:00:00',1,9, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 5, '2017-02-27 00:00:00', 1, 0, '13:00:00', '15:00:00',1,9, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 6, '2017-01-06 00:00:00', 1, 4, '13:00:00', '15:00:00',4,3, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 6, '2017-01-13 00:00:00', 1, 4, '13:00:00', '15:00:00',4,3, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 6, '2017-01-20 00:00:00', 1, 4, '13:00:00', '15:00:00',4,3, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 6, '2017-01-27 00:00:00', 1, 4, '13:00:00', '15:00:00',4,3, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 6, '2017-02-03 00:00:00', 1, 4, '13:00:00', '15:00:00',4,3, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 6, '2017-02-10 00:00:00', 1, 4, '13:00:00', '15:00:00',4,3, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 6, '2017-02-17 00:00:00', 1, 4, '13:00:00', '15:00:00',4,3, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 6, '2017-02-24 00:00:00', 1, 4, '13:00:00', '15:00:00',4,3, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 7, '2017-01-06 00:00:00', 1, 4, '13:00:00', '15:00:00',8,7, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 7, '2017-01-13 00:00:00', 1, 4, '13:00:00', '15:00:00',8,7, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 7, '2017-01-20 00:00:00', 1, 4, '13:00:00', '15:00:00',8,7, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 7, '2017-01-27 00:00:00', 1, 4, '13:00:00', '15:00:00',8,7, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 7, '2017-02-03 00:00:00', 1, 4, '13:00:00', '15:00:00',8,7, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 7, '2017-02-10 00:00:00', 1, 4, '13:00:00', '15:00:00',8,7, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 7, '2017-02-17 00:00:00', 1, 4, '13:00:00', '15:00:00',8,7, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 7, '2017-02-24 00:00:00', 1, 4, '13:00:00', '15:00:00',8,7, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 8, '2017-01-05 00:00:00', 1, 3, '13:00:00', '15:00:00',9,3, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 8, '2017-01-12 00:00:00', 1, 3, '13:00:00', '15:00:00',9,3, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 8, '2017-01-19 00:00:00', 1, 3, '13:00:00', '15:00:00',9,3, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 8, '2017-01-26 00:00:00', 1, 3, '13:00:00', '15:00:00',9,3, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 8, '2017-02-02 00:00:00', 1, 3, '13:00:00', '15:00:00',9,3, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 8, '2017-02-09 00:00:00', 1, 3, '13:00:00', '15:00:00',9,3, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 8, '2017-02-16 00:00:00', 1, 3, '13:00:00', '15:00:00',9,3, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 8, '2017-02-23 00:00:00', 1, 3, '13:00:00', '15:00:00',9,3, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),

		(1, 9, '2016-12-05 00:00:00', 4, 0, '12:00:00', '18:00:00',17,5, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 9, '2016-12-12 00:00:00', 4, 0, '12:00:00', '18:00:00',17,5, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 9, '2016-12-19 00:00:00', 4, 0, '12:00:00', '18:00:00',17,5, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 9, '2016-12-26 00:00:00', 4, 0, '12:00:00', '18:00:00',17,5, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),

		(1, 10, '2016-12-06 00:00:00', 5, 0, '12:00:00', '18:00:00',18,2, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 10, '2016-12-13 00:00:00', 5, 0, '12:00:00', '18:00:00',18,2, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 10, '2016-12-20 00:00:00', 5, 0, '12:00:00', '18:00:00',18,2, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 10, '2016-12-27 00:00:00', 5, 0, '12:00:00', '18:00:00',18,2, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),

		(1, 11, '2016-12-07 00:00:00', 8, 0, '12:00:00', '18:00:00',19,3, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 11, '2016-12-14 00:00:00', 8, 0, '12:00:00', '18:00:00',19,3, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 11, '2016-12-21 00:00:00', 8, 0, '12:00:00', '18:00:00',19,3, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 11, '2016-12-28 00:00:00', 8, 0, '12:00:00', '18:00:00',19,3, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),

		(1, 12, '2016-12-08 00:00:00', 9, 0, '12:00:00', '18:00:00',20,25, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 12, '2016-12-15 00:00:00', 9, 0, '12:00:00', '18:00:00',20,25, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 12, '2016-12-22 00:00:00', 9, 0, '12:00:00', '18:00:00',20,25, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 12, '2016-12-29 00:00:00', 9, 0, '12:00:00', '18:00:00',20,25, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),

		(1, 13, '2016-12-09 00:00:00', 9, 0, '12:00:00', '18:00:00',22,6, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 13, '2016-12-16 00:00:00', 9, 0, '12:00:00', '18:00:00',22,6, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 13, '2016-12-23 00:00:00', 9, 0, '12:00:00', '18:00:00',22,6, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 13, '2016-12-30 00:00:00', 9, 0, '12:00:00', '18:00:00',22,6, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),

		(1, 14, '2016-01-08 00:00:00', 11, 0, '12:00:00', '18:00:00',25,4, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 14, '2016-01-15 00:00:00', 11, 0, '12:00:00', '18:00:00',25,4, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 14, '2016-01-22 00:00:00', 11, 0, '12:00:00', '18:00:00',25,4, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 14, '2016-01-29 00:00:00', 11, 0, '12:00:00', '18:00:00',25,4, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),

		(1, 14, '2016-01-09 00:00:00', 2, 0, '12:00:00', '18:00:00',27,7, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 14, '2016-01-16 00:00:00', 2, 0, '12:00:00', '18:00:00',27,7, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 14, '2016-01-23 00:00:00', 2, 0, '12:00:00', '18:00:00',27,7, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
		(1, 14, '2016-01-30 00:00:00', 2, 0, '12:00:00', '18:00:00',27,7, 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
--
-- Clase Matricula
--

insert into clase_matricula (`clase_id`, `matricula_id`, `asistio`, `created_at`, `updated_at`)
values (1 , 1000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (1 , 1002, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (1 , 1003, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (1 , 1004, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (1 , 1005, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (1 , 1006, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (2 , 1000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (2 , 1002, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (2 , 1003, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (2 , 1004, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (2 , 1005, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (2 , 1006, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (3 , 1000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (3 , 1002, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (3 , 1003, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (3 , 1004, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (3 , 1005, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (3 , 1006, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (4 , 1000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (4 , 1002, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (4 , 1003, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (4 , 1004, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (4 , 1005, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (4 , 1006, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (5 , 1000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (5 , 1002, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (5 , 1003, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (5 , 1004, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (5 , 1005, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (5 , 1006, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (6 , 1000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (6 , 1002, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (6 , 1003, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (6 , 1004, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (6 , 1005, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (6 , 1006, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (7 , 1000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (7 , 1002, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (7 , 1003, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (7 , 1004, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (7 , 1005, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (7 , 1006, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (8 , 1000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (8 , 1002, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (8 , 1003, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (8 , 1004, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (8 , 1005, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (8 , 1006, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (9 , 1000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (9 , 1002, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (9 , 1003, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (9 , 1004, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (9 , 1005, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (9 , 1006, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (10, 1007, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (10, 1008, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (10, 1009, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (11, 1007, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (11, 1008, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (11, 1009, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (12, 1007, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (12, 1008, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (12, 1009, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (13, 1007, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (13, 1008, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (13, 1009, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (14, 1007, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (14, 1008, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (14, 1009, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (15, 1007, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (15, 1008, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (15, 1009, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (16, 1007, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (16, 1008, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (16, 1009, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (17, 1007, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (17, 1008, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (17, 1009, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (18, 1007, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (18, 1008, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (18, 1009, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (19, 1017, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (19, 1018, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (19, 1019, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (20, 1017, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (20, 1018, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (20, 1019, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (21, 1017, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (21, 1018, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (21, 1019, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (22, 1017, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (22, 1018, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (22, 1019, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (23, 1017, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (23, 1018, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (23, 1019, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (24, 1017, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (24, 1018, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (24, 1019, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (25, 1017, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (25, 1018, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (25, 1019, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (26, 1017, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (26, 1018, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (26, 1019, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (27, 1027, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (27, 1028, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (27, 1029, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (28, 1027, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (28, 1028, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (28, 1029, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (29, 1027, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (29, 1028, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (29, 1029, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (30, 1027, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (30, 1028, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (30, 1029, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (31, 1027, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (31, 1028, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (31, 1029, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (32, 1027, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (32, 1028, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (32, 1029, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (33, 1027, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (33, 1028, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (33, 1029, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (34, 1027, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (34, 1028, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (34, 1029, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (35, 1010, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (35, 1012, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (35, 1013, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (35, 1014, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (36, 1010, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (36, 1012, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (36, 1013, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (36, 1014, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (37, 1010, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (37, 1012, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (37, 1013, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (37, 1014, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (38, 1010, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (38, 1012, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (38, 1013, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (38, 1014, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (39, 1010, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (39, 1012, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (39, 1013, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (39, 1014, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (40, 1010, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (40, 1012, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (40, 1013, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (40, 1014, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (41, 1010, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (41, 1012, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (41, 1013, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (41, 1014, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (42, 1010, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (42, 1012, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (42, 1013, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (42, 1014, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (43, 1010, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (43, 1012, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (43, 1013, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (43, 1014, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (44, 1015, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (44, 1016, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (44, 1020, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (44, 1021, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (45, 1015, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (45, 1016, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (45, 1020, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (45, 1021, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (46, 1015, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (46, 1016, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (46, 1020, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (46, 1021, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (47, 1015, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (47, 1016, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (47, 1020, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (47, 1021, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (48, 1015, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (48, 1016, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (48, 1020, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (48, 1021, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (49, 1015, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (49, 1016, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (49, 1020, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (49, 1021, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (50, 1015, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (50, 1016, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (50, 1020, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (50, 1021, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (51, 1015, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (51, 1016, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (51, 1020, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (51, 1021, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (52, 1022, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (52, 1023, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (52, 1024, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (53, 1022, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (53, 1023, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (53, 1024, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (54, 1022, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (54, 1023, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (54, 1024, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (55, 1022, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (55, 1023, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (55, 1022, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (56, 1023, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (56, 1024, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (56, 1024, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (57, 1022, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (57, 1023, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (57, 1024, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (58, 1022, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (58, 1023, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (58, 1024, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (59, 1022, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (59, 1023, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (59, 1024, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (60, 1025, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (60, 1026, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (61, 1025, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (61, 1026, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (62, 1025, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (62, 1026, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (63, 1025, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (63, 1026, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (64, 1025, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (64, 1026, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (65, 1025, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (65, 1026, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (66, 1025, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (66, 1026, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (67, 1025, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	   (67, 1026, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Recibos
--
insert into recibo (`id`, `recibo_tipo_id`,`tipo_moneda_id`,`pago_id`,`monto`,`fecha`,`recibo_concepto_pago_id`,`descripcion`, `filial_id`, `created_at`, `updated_at`)
values 	(100, 1, 1,	1,	5000,'2016-12-22',1,'Recibo 1',	3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(101, 1, 1,	2, 	5000,'2016-12-22',1,'Recibo 2',	3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(102, 1, 1, 3, 	5000,'2016-12-22',1,'Recibo 3',	3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(103, 1, 1, 4, 	5000,'2016-12-22',1,'Recibo 4',	3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(104, 1, 1, 5, 	5000,'2016-12-22',1,'Recibo 5',	3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(105, 1, 1, 6, 	5000,'2016-12-22',1,'Recibo 6',	3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(106, 1, 1, 7, 	5000,'2016-12-22',1,'Recibo 7',	3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(107, 1, 1, 8, 	5000,'2016-12-22',1,'Recibo 8',	3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(108, 1, 1, 9, 	5000,'2016-12-22',1,'Recibo 9',	3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(109, 1, 1,	10, 5000,'2016-12-22',1,'Recibo 10',3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(110, 1, 1, 11, 5000,'2016-12-22',1,'Recibo 11',3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(111, 1, 1, 12, 5000,'2016-12-22',1,'Recibo 12',3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(112, 1, 1, 13, 5000,'2016-12-22',1,'Recibo 13',3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(113, 1, 1, 14, 5000,'2016-12-22',1,'Recibo 14',3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(114, 1, 1, 15, 5000,'2016-12-22',1,'Recibo 15',3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(115, 1, 1, 16, 5000,'2016-12-22',1,'Recibo 16',3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(116, 1, 1, 17, 5000,'2016-12-22',1,'Recibo 17',3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(117, 1, 1, 18, 5000,'2016-12-22',1,'Recibo 18',3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(118, 1, 1, 19, 5000,'2016-12-22',1,'Recibo 19',3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(119, 1, 1, 20, 5000,'2016-12-22',1,'Recibo 20',3, '2016-11-11 00:00:00', '2016-11-11 00:00:00');
--		
-- Examenes
--

insert into examen (`nro_acta`, `recuperatorio_nro_acta`, `matricula_id`, `grupo_id`, `nota`, `carrera_id`, `materia_id`, `docente_id`, `created_at`, `updated_at`) 
values 	(100, NULL, 1000, 	1, 6, 1, 1	, 1, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
		(101, NULL, 1002, 	1, 5, 1, 1	, 1, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
		(102, NULL, 1003, 	1, 9, 1, 1	, 1, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
		(103, NULL, 1004, 	1, 7, 1, 1	, 1, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
		(104, NULL, 1007,	2, 9, 2, 4	, 2, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
		(105, NULL, 1008,	2, 3, 2, 4	, 2, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
		(106, NULL, 1009,	2, 1, 2, 4	, 2, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
 		(107, NULL, 1017, 	3, 4, 3, 7	, 3, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
		(108, NULL, 1018, 	3, 7, 3, 7	, 3, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
		(109, NULL, 1019, 	3, 5, 3, 7	, 3, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
 		(110, NULL, 1027, 	4, 3, 2, 5	, 4, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
 		(111, NULL, 1028, 	4, 7, 2, 5	, 4, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
		(112, NULL, 1010, 	5, 8, 3, 6	, 5, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
		(113, NULL, 1011, 	5, 8, 3, 6	, 5, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
 		(114, NULL, 1016, 	6, 9, 1, 8	, 6, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
 		(115, NULL, 1022, 	7, 6, 5, 10	, 7, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
 		(116, NULL, 1025, 	8, 2, 7, 15	, 8, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'); 		