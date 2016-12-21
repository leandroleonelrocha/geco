drop database if exists geco;
create database geco;
use geco;

create table if not exists curso(
id			int not null auto_increment,
nombre		varchar(50) not null,
duracion 	varchar(50),
descripcion	varchar(300) default 'Sin Descripción.',
taller		boolean default false,
created_at	timestamp not null default '0000-00-00 00:00:00',
updated_at	timestamp not null default '0000-00-00 00:00:00',
primary key	(id)
);

create table if not exists carrera(
id			int not null auto_increment,
nombre		varchar(50) not null,
duracion 	varchar(50),
descripcion	varchar(300) default 'Sin Descripción.',
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

create table if not exists pais(
id 				int not null auto_increment,
pais  			varchar (50) not null,
lenguaje  		char (5) not null,
created_at  	timestamp not null default '0000-00-00 00:00:00',
updated_at  	timestamp not null default '0000-00-00 00:00:00',
primary key 	(id)
);

create table if not exists tipo_moneda(
id 			int not null auto_increment,
pais_id 	int not null,
nombre  	varchar (50) not null,
simbolo 	char(10) not null,
abreviacion char(10) not null,
created_at  timestamp not null default '0000-00-00 00:00:00',
updated_at  timestamp not null default '0000-00-00 00:00:00',
primary key 	(id),
foreign key		(pais_id) 	references pais (id)
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
id						int not null,
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
);

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

-- --------------------------------------------------------
-- ---------- Inserción de Datos

--
-- Cadenas
--

insert into cadena (`nombre`, `mail`, `telefono`, `created_at`, `updated_at`)
values  ('IGI', 'test@igi.com', '12345678', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('IAC', 'test@iac.com', '12345678', '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Pais
--
insert into pais (`pais`, `lenguaje`, `created_at`, `updated_at`)
values  ('Argentina', 'es', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		('Colombia' , 'es', '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Tipo Moneda
--
insert into tipo_moneda (`pais_id`, `nombre`, `simbolo`, `abreviacion`, `created_at`, `updated_at`)
values  (1, 'Peso Argentino',  '$', 'ARS', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(2, 'Peso Colombiano', '$', 'COP', '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Tipos de Documento
--

insert into tipo_documento (`tipo_documento`, `created_at`, `updated_at`)
values  ('DNI', '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Directores
--

insert into director (`tipo_documento_id`, `nro_documento`, `apellidos`, `nombres`,`mail`, `activo`, `created_at`, `updated_at`)
values  (1, 25123456, 'González', 'Santiago', 'director1@director.com', 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
    	(1, 24123456, 'Lopez'	, 'Mateo'	, 'director2@director.com', 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 23123456, 'Garcia'	, 'Diego'	, 'director3@director.com', 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 20123456, 'Romero'	, 'Camila'	, 'director4@director.com', 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 27123456, 'Torres'	, 'Valeria'	, 'director5@director.com', 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
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
        (5, '65874213', '2016-11-11 00:00:00', '2016-11-11 00:00:00');
     
--
-- Filiales
--

insert into filial (`cadena_id`, `pais_id`, `nombre`, `direccion`, `localidad`, `codigo_postal`, `director_id`, `mail`, `activo`, `created_at`, `updated_at`)
values  (1, 1, 'Filial 1' , 'Direccion', 'Localidad', 1736, 1, 'filial@filial.com'  , 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 2' , 'Direccion', 'Localidad', 1736, 1, 'filial2@filial.com' , 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 3' , 'Direccion', 'Localidad', 1736, 2, 'filial3@filial.com' , 	0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 4' , 'Direccion', 'Localidad', 1736, 2, 'filial4@filial.com' , 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 1, 'Filial 5' , 'Direccion', 'Localidad', 1736, 3, 'filial5@filial.com' , 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 1, 'Filial 6' , 'Direccion', 'Localidad', 1736, 3, 'filial6@filial.com' , 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 1, 'Filial 7' , 'Direccion', 'Localidad', 1736, 4, 'filial7@filial.com' , 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 1, 'Filial 8' , 'Direccion', 'Localidad', 1736, 4, 'filial8@filial.com' , 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 1, 'Filial 9' , 'Direccion', 'Localidad', 1736, 5, 'filial9@filial.com' , 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 1, 'Filial 10', 'Direccion', 'Localidad', 1736, 5, 'filial10@filial.com', 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Asesores
--

insert into asesor (`tipo_documento_id`, `nro_documento`, `apellidos`, `nombres`, `direccion`, `localidad`, `filial_id`, `activo`, `created_at`, `updated_at`)
values  (1, 30159752, 'Sosa'  , 'Victoria', 'Direccion', 'Localidad', 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 29159752, 'Ruiz'  , 'Matías'  , 'Direccion', 'Localidad', 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 28159752, 'Alonso', 'Gabriel' , 'Direccion', 'Localidad', 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 31159752, 'Ortiz' , 'Daniel'  , 'Direccion', 'Localidad', 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 32159752, 'Rojas' , 'Jazmin'  , 'Direccion', 'Localidad', 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 25159752, 'Blanco', 'Luciano' , 'Direccion', 'Localidad', 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 20159752, 'Paz'   , 'Emma'    , 'Direccion', 'Localidad', 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 22159752, 'Correa', 'Mario'   , 'Direccion', 'Localidad', 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 34159752, 'Vera'  , 'Valeria' , 'Direccion', 'Localidad', 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 21159752, 'Lucero', 'Jimena'  , 'Direccion', 'Localidad', 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Docentes
--

insert into docente (`tipo_documento_id`, `nro_documento`, `apellidos`, `nombres`, `descripcion`, `disponibilidad_manana`, `disponibilidad_tarde`, `disponibilidad_noche`, `disponibilidad_sabados`, `filial_id`, `activo`, `created_at`, `updated_at`)
values  (1, 2009090, 'Avala', 'Agustín' , 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2018181, 'Bravo', 'Eric'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2027272, 'Rivas', 'Felipe'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2036363, 'Costa', 'Hugo'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2045454, 'Otero', 'Pablo'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2054545, 'Russo', 'Julia'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2063636, 'Bruno', 'Zoe'		, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2072727, 'Funes', 'Carla'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2081818, 'Heras', 'Abril'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
		(1, 2090909, 'Oliva', 'Adriana'	, 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Personas
--

insert into persona (`nro_documento`, `tipo_documento_id`, `pais_id`, `apellidos`, `nombres`, `genero`, `fecha_nacimiento`, `domicilio`, `localidad`, `estado_civil`, `nivel_estudios`, `estudio_computacion`, `posee_computadora`, `disponibilidad_manana`, `disponibilidad_tarde`, `disponibilidad_noche`, `disponibilidad_sabados`, `aclaraciones`, `filial_id`, `activo`, `created_at`, `updated_at`)
values  (39670852, 1, 1, 'Bianchi'	 , 'Marcos'   , 'M', '1990-01-01', 'Direccion', 'Localidad', 'Soltero', 'Secundario Completo', 	1, 1, 1, 0, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (33856851, 1, 1, 'Palermo'  , 'Mariano'  , 'M', '1990-01-01', 'Direccion', 'Localidad', 'Soltero', 'Terciario'			 , 	1, 1, 1, 0, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (32856851, 1, 1, 'Quinteros', 'Ezequiel' , 'M', '1990-01-01', 'Direccion', 'Localidad', 'Soltero', 'Terciario'			 , 	1, 1, 1, 0, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (30856851, 1, 1, 'Montoya'  , 'Brenda'	  , 'F', '1990-01-01', 'Direccion', 'Localidad', 'Soltera', 'Universitario'		 , 	1, 1, 1, 0, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (40856851, 1, 1, 'Zarate'   , 'Sofía'	  , 'F', '1990-01-01', 'Direccion', 'Localidad', 'Soltera', 'Secundario Completo', 	1, 1, 1, 0, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (41856851, 1, 1, 'Prato'	 , 'Julían'	  , 'M', '1990-01-01', 'Direccion', 'Localidad', 'Soltero', 'Terciario'			 , 	1, 1, 1, 0, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (20856851, 1, 1, 'Barrera'	 , 'Franco'	  , 'M', '1990-01-01', 'Direccion', 'Localidad', 'Casado' , 'Universitario'		 , 	1, 1, 1, 0, 0, 0, null, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (25856851, 1, 1, 'Cisneros' , 'Jazmin'	  , 'F', '1990-01-01', 'Direccion', 'Localidad', 'Casada' , 'Universitario'		 , 	1, 1, 1, 0, 0, 0, null, 1, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (27856851, 1, 1, 'Nuñez'	 , 'Florencia', 'F', '1990-01-01', 'Direccion', 'Localidad', 'Casada' , 'Terciario'			 , 	1, 1, 1, 0, 0, 0, null, 1, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (23856851, 1, 1, 'Paint'	 , 'Daniela'  , 'F', '1990-01-01', 'Direccion', 'Localidad', 'Casada' , 'Secundario Completo', 	1, 1, 1, 0, 0, 0, null, 1, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Personas Mails
--

insert into persona_mail (`persona_id`, `mail`, `created_at`, `updated_at`)
values  (1 , 'magneto.alfonsin@gmail.com', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2 , 'gabrield75@hotmail.com' , '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3 , 'gabydonatognr@gmail.com', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (4 , 'persona4@persona.com'	  , '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (5 , 'persona5@persona.com'	  , '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (6 , 'persona6@persona.com'	  , '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7 , 'persona7@persona.com'	  , '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8 , 'persona8@persona.com'	  , '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9 , 'persona9@persona.com'	  , '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, 'persona10@persona.com'  , '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Cursos
--

insert into curso (`id`, `nombre`, `duracion`, `descripcion`, `taller`, `created_at`, `updated_at`)
values  (1 , 'Curso 1' , '50 Días', 'Sin Descripción.', 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2 , 'Curso 2' , '50 Días', 'Sin Descripción.', 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3 , 'Curso 3' , '50 Días', 'Sin Descripción.', 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (4 , 'Curso 4' , '50 Días', 'Sin Descripción.', 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (5 , 'Curso 5' , '50 Días', 'Sin Descripción.', 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (6 , 'Curso 6' , '50 Días', 'Sin Descripción.', 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7 , 'Curso 7' , '50 Días', 'Sin Descripción.', 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8 , 'Curso 8' , '50 Días', 'Sin Descripción.', 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9 , 'Curso 9' , '50 Días', 'Sin Descripción.', 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, 'Curso 10', '50 Días', 'Sin Descripción.', 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Carreras
--

insert into carrera (`id`, `nombre`, `duracion`, `descripcion`, `created_at`, `updated_at`)
values  (1 , 'Carrera 1' , '50 Días', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2 , 'Carrera 2' , '50 Días', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3 , 'Carrera 3' , '50 Días', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (4 , 'Carrera 4' , '50 Días', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (5 , 'Carrera 5' , '50 Días', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (6 , 'Carrera 6' , '50 Días', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7 , 'Carrera 7' , '50 Días', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8 , 'Carrera 8' , '50 Días', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9 , 'Carrera 9' , '50 Días', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, 'Carrera 10', '50 Días', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Materias
--

insert into materia (`carrera_id`, `nombre`, `descripcion`, `created_at`, `updated_at`)
values  (1 , 'Materia 1' , 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1 , 'Materia 2' , 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1 , 'Materia 3' , 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2 , 'Materia 4' , 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2 , 'Materia 5' , 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3 , 'Materia 6' , 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3 , 'Materia 7' , 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (4 , 'Materia 8' , 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (4 , 'Materia 9' , 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (5 , 'Materia 10', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (5 , 'Materia 11', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (6 , 'Materia 12', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (6 , 'Materia 13', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7 , 'Materia 14', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7 , 'Materia 15', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8 , 'Materia 16', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8 , 'Materia 17', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9 , 'Materia 18', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9 , 'Materia 19', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, 'Materia 20', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, 'Materia 21', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00');

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
        (1 , 3	 , null, 3, 5, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2 , 3	 , null, 3, 5, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3 , 3	 , null, 3, 5, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (4 , 3	 , null, 3, 5, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (5 , 3	 , null, 3, 5, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (6 , null, 3   , 3, 6, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (7 , null, 3   , 3, 6, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (8 , null, 3   , 1, 6, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (9 , null, 3   , 1, 6, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (10, null, 3   , 1, 6, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Pagos
--

insert into pago (`matricula_id`, `tipo_moneda_id`, `nro_pago`, `pago_individual`, `descripcion`, `terminado`, `vencimiento`, `monto_original`, `monto_actual`, `monto_pago`, `descuento`, `recargo`, `filial_id`, `created_at`, `updated_at`)
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
-- Grupos
--

-- insert into grupo (`curso_id`, `carrera_id`, `materia_id`, `descripcion`, `docente_id`, `nuevo`, `turno_manana`, `turno_tarde`, `turno_noche`, `sabados`, `color`, `fecha_inicio`, `fecha_fin`, `filial_id`, `activo`, `terminado`, `cancelado`, `created_at`, `updated_at`)
-- values  (1	 , null, null, 'Grupo 1', 1, 0, 1, 1, 1, 1, '#563d7c', '2017-01-02', '2017-03-01', 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
--   		(2	 , null, null, 'Grupo 2', 2, 0, 1, 1, 1, 1, '#b90000', '2017-01-02', '2017-03-01', 1, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
--   		(3	 , null, null, 'Grupo 3', 3, 0, 1, 1, 1, 1, '#8000ff', '2017-01-02', '2017-03-01', 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
--   		(null, 1   , 1   , 'Grupo 4', 4, 0, 1, 1, 1, 1, '#2d2d2d', '2017-01-02', '2017-03-01', 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
--   		(null, 1   , 2   , 'Grupo 5', 5, 0, 1, 1, 1, 1, '#892e2e', '2017-01-02', '2017-03-01', 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
--   		(null, 2   , 4   , 'Grupo 6', 6, 0, 1, 1, 1, 1, '#3f1afa', '2017-01-02', '2017-03-01', 1, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
--   		(null, 2   , 5   , 'Grupo 7', 7, 0, 1, 1, 1, 1, '#c6c752', '2017-01-02', '2017-03-01', 1, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
--   		(null, 3   , 6   , 'Grupo 8', 8, 0, 1, 1, 1, 1, '#39bc8c', '2017-01-02', '2017-03-01', 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Grupo Horarios
--

-- insert into grupo_horario (`grupo_id`, `dia`, `horario_desde`, `horario_hasta`, `created_at`, `updated_at`)
-- values (1, 'Lunes'	, '13:00:00', '17:00:00', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (2, 'Martes'	, '13:00:00', '17:00:00', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (3, 'Jueves'	, '13:00:00', '17:00:00', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (4, 'Viernes', '13:00:00', '17:00:00', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (5, 'Lunes'	, '13:00:00', '17:00:00', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (6, 'Viernes', '13:00:00', '17:00:00', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (7, 'Viernes', '13:00:00', '17:00:00', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (8, 'Jueves'	, '13:00:00', '17:00:00', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

--
-- Grupo Matrícula
--

-- insert into grupo_matricula (`grupo_id`, `matricula_id`, `created_at`, `updated_at`)
-- values (1, 1000, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (1, 1002, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (1, 1003, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (1, 1004, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (1, 1005, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (1, 1006, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (2, 1007, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (2, 1008, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (2, 1009, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (3, 1017, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (3, 1018, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (3, 1019, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (4, 1027, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (4, 1028, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (4, 1029, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (5, 1010, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (5, 1011, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (5, 1012, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (5, 1013, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (5, 1014, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (6, 1015, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (6, 1016, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (6, 1020, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (6, 1021, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (7, 1022, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (7, 1023, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (7, 1024, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (8, 1025, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
-- 	   (8, 1026, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

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

-- insert into clase (`clase_estado_id`, `grupo_id`, `fecha`, `docente_id`, `dia`, `horario_desde`, `horario_hasta`, `enviado`, `descripcion`, `created_at`, `updated_at`)
-- values 	(1, 1, '2017-01-02 00:00:00', 1, 0, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 1, '2017-01-09 00:00:00', 1, 0, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 1, '2017-01-16 00:00:00', 1, 0, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 1, '2017-01-23 00:00:00', 1, 0, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 1, '2017-01-30 00:00:00', 1, 0, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 1, '2017-02-06 00:00:00', 1, 0, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 1, '2017-02-13 00:00:00', 1, 0, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 1, '2017-02-20 00:00:00', 1, 0, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 1, '2017-02-27 00:00:00', 1, 0, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 2, '2017-01-03 00:00:00', 1, 1, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 2, '2017-01-10 00:00:00', 1, 1, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 2, '2017-01-17 00:00:00', 1, 1, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 2, '2017-01-24 00:00:00', 1, 1, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 2, '2017-01-31 00:00:00', 1, 1, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 2, '2017-02-07 00:00:00', 1, 1, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 2, '2017-02-14 00:00:00', 1, 1, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 2, '2017-02-21 00:00:00', 1, 1, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 2, '2017-02-28 00:00:00', 1, 1, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 3, '2017-01-05 00:00:00', 1, 3, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 3, '2017-01-12 00:00:00', 1, 3, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 3, '2017-01-19 00:00:00', 1, 3, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 3, '2017-01-26 00:00:00', 1, 3, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 3, '2017-02-02 00:00:00', 1, 3, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 3, '2017-02-09 00:00:00', 1, 3, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 3, '2017-02-16 00:00:00', 1, 3, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 3, '2017-02-23 00:00:00', 1, 3, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 4, '2017-01-06 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 4, '2017-01-13 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 4, '2017-01-20 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 4, '2017-01-27 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 4, '2017-02-03 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 4, '2017-02-10 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 4, '2017-02-17 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 4, '2017-02-24 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 5, '2017-01-02 00:00:00', 1, 0, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 5, '2017-01-09 00:00:00', 1, 0, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 5, '2017-01-16 00:00:00', 1, 0, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 5, '2017-01-23 00:00:00', 1, 0, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 5, '2017-01-30 00:00:00', 1, 0, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 5, '2017-02-06 00:00:00', 1, 0, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 5, '2017-02-13 00:00:00', 1, 0, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 5, '2017-02-20 00:00:00', 1, 0, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 5, '2017-02-27 00:00:00', 1, 0, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 6, '2017-01-06 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 6, '2017-01-13 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 6, '2017-01-20 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 6, '2017-01-27 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 6, '2017-02-03 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 6, '2017-02-10 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 6, '2017-02-17 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 6, '2017-02-24 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 7, '2017-01-06 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 7, '2017-01-13 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 7, '2017-01-20 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 7, '2017-01-27 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 7, '2017-02-03 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 7, '2017-02-10 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 7, '2017-02-17 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 7, '2017-02-24 00:00:00', 1, 4, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 8, '2017-01-05 00:00:00', 1, 3, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 8, '2017-01-12 00:00:00', 1, 3, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 8, '2017-01-19 00:00:00', 1, 3, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 8, '2017-01-26 00:00:00', 1, 3, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 8, '2017-02-02 00:00:00', 1, 3, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 8, '2017-02-09 00:00:00', 1, 3, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 8, '2017-02-16 00:00:00', 1, 3, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 		(1, 8, '2017-02-23 00:00:00', 1, 3, '13:00:00', '15:00:00', 0, '(La clase no tiene descripción)', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Clase Matricula
--

-- insert into clase_matricula (`clase_id`, `matricula_id`, `asistio`, `created_at`, `updated_at`)
-- values (1 , 1000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (1 , 1002, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (1 , 1003, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (1 , 1004, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (1 , 1005, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (1 , 1006, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (2 , 1000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (2 , 1002, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (2 , 1003, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (2 , 1004, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (2 , 1005, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (2 , 1006, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (3 , 1000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (3 , 1002, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (3 , 1003, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (3 , 1004, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (3 , 1005, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (3 , 1006, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (4 , 1000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (4 , 1002, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (4 , 1003, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (4 , 1004, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (4 , 1005, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (4 , 1006, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (5 , 1000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (5 , 1002, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (5 , 1003, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (5 , 1004, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (5 , 1005, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (5 , 1006, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (6 , 1000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (6 , 1002, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (6 , 1003, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (6 , 1004, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (6 , 1005, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (6 , 1006, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (7 , 1000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (7 , 1002, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (7 , 1003, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (7 , 1004, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (7 , 1005, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (7 , 1006, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (8 , 1000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (8 , 1002, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (8 , 1003, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (8 , 1004, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (8 , 1005, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (8 , 1006, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (9 , 1000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (9 , 1002, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (9 , 1003, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (9 , 1004, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (9 , 1005, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (9 , 1006, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (10, 1007, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (10, 1008, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (10, 1009, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (11, 1007, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (11, 1008, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (11, 1009, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (12, 1007, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (12, 1008, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (12, 1009, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (13, 1007, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (13, 1008, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (13, 1009, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (14, 1007, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (14, 1008, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (14, 1009, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (15, 1007, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (15, 1008, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (15, 1009, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (16, 1007, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (16, 1008, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (16, 1009, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (17, 1007, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (17, 1008, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (17, 1009, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (18, 1007, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (18, 1008, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (18, 1009, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (19, 1017, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (19, 1018, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (19, 1019, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (20, 1017, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (20, 1018, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (20, 1019, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (21, 1017, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (21, 1018, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (21, 1019, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (22, 1017, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (22, 1018, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (22, 1019, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (23, 1017, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (23, 1018, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (23, 1019, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (24, 1017, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (24, 1018, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (24, 1019, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (25, 1017, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (25, 1018, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (25, 1019, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (26, 1017, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (26, 1018, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (26, 1019, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (27, 1027, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (27, 1028, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (27, 1029, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (28, 1027, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (28, 1028, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (28, 1029, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (29, 1027, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (29, 1028, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (29, 1029, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (30, 1027, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (30, 1028, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (30, 1029, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (31, 1027, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (31, 1028, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (31, 1029, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (32, 1027, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (32, 1028, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (32, 1029, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (33, 1027, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (33, 1028, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (33, 1029, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (34, 1027, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (34, 1028, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (34, 1029, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (35, 1010, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (35, 1012, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (35, 1013, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (35, 1014, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (36, 1010, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (36, 1012, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (36, 1013, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (36, 1014, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (37, 1010, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (37, 1012, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (37, 1013, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (37, 1014, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (38, 1010, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (38, 1012, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (38, 1013, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (38, 1014, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (39, 1010, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (39, 1012, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (39, 1013, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (39, 1014, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (40, 1010, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (40, 1012, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (40, 1013, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (40, 1014, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (41, 1010, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (41, 1012, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (41, 1013, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (41, 1014, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (42, 1010, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (42, 1012, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (42, 1013, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (42, 1014, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (43, 1010, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (43, 1012, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (43, 1013, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (43, 1014, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (44, 1015, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (44, 1016, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (44, 1020, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (44, 1021, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (45, 1015, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (45, 1016, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (45, 1020, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (45, 1021, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (46, 1015, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (46, 1016, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (46, 1020, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (46, 1021, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (47, 1015, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (47, 1016, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (47, 1020, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (47, 1021, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (48, 1015, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (48, 1016, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (48, 1020, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (48, 1021, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (49, 1015, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (49, 1016, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (49, 1020, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (49, 1021, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (50, 1015, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (50, 1016, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (50, 1020, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (50, 1021, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (51, 1015, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (51, 1016, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (51, 1020, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (51, 1021, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (52, 1022, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (52, 1023, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (52, 1024, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (53, 1022, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (53, 1023, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (53, 1024, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (54, 1022, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (54, 1023, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (54, 1024, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (55, 1022, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (55, 1023, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (55, 1022, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (56, 1023, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (56, 1024, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (56, 1024, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (57, 1022, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (57, 1023, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (57, 1024, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (58, 1022, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (58, 1023, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (58, 1024, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (59, 1022, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (59, 1023, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (59, 1024, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (60, 1025, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (60, 1026, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (61, 1025, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (61, 1026, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (62, 1025, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (62, 1026, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (63, 1025, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (63, 1026, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (64, 1025, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (64, 1026, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (65, 1025, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (65, 1026, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (66, 1025, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (66, 1026, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (67, 1025, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- 	   (67, 1026, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');