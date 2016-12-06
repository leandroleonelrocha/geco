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

create table if not exists director_mail(
director_id	int not null,
mail		varchar(50) not null,
created_at  timestamp not null default '0000-00-00 00:00:00',
updated_at  timestamp not null default '0000-00-00 00:00:00',
primary key	(director_id, mail),
foreign key	(director_id) 			references director	(id)
);

create table if not exists filial(
id				int not null auto_increment,
cadena_id		int not null,
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
foreign key		(cadena_id) 	references cadena (id),
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
activo				boolean not null default true,
created_at			timestamp not null default '0000-00-00 00:00:00',
updated_at			timestamp not null default '0000-00-00 00:00:00',
primary key 		(id),
unique key			(tipo_documento_id, nro_documento),
foreign key 		(tipo_documento_id)	references tipo_documento	(id)
);

create table if not exists asesor_filial(
asesor_id	int not null,
filial_id	int not null,
created_at	timestamp not null default '0000-00-00 00:00:00',
updated_at	timestamp not null default '0000-00-00 00:00:00',
primary key	(asesor_id, filial_id),
foreign key (asesor_id)				references asesor	(id),
foreign key (filial_id)				references filial	(id)
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
asesor_id				int not null,
activo					boolean not null default true,
created_at				timestamp not null default '0000-00-00 00:00:00',
updated_at				timestamp not null default '0000-00-00 00:00:00',	
primary key 			(id),
unique key				(tipo_documento_id, nro_documento),
foreign key 			(tipo_documento_id)					references tipo_documento	(id),
foreign key 			(filial_id)							references filial 			(id),
foreign key 			(asesor_id)							references asesor 			(id)
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
materia_id 		int,
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
foreign key 	(materia_id)					references materia		(id),
foreign key 	(docente_id)					references docente		(id),
foreign key 	(filial_id)						references filial		(id)
);

create table if not exists grupo_horario(
grupo_id		int not null,
dia				ENUM('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'),
horario_desde	time not null,
horario_hasta	time not null,
created_at  	timestamp not null default '0000-00-00 00:00:00',
updated_at  	timestamp not null default '0000-00-00 00:00:00',
primary key		(grupo_id, dia, horario_desde, horario_hasta),
foreign key		(grupo_id)										references grupo	(id)
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
enviado 		boolean not null default false,
descripcion		varchar(300),
created_at  	timestamp not null default '0000-00-00 00:00:00',
updated_at  	timestamp not null default '0000-00-00 00:00:00',
primary key		(id),
foreign key		(clase_estado_id)	references clase_estado	(id),
foreign key		(grupo_id)			references grupo		(id),
foreign key		(docente_id)		references docente		(id)
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
nro_acta				int not null,
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
foreign key 			(recuperatorio_nro_acta)	references examen	  (id),
foreign key				(grupo_id)								              references grupo	  (id),
foreign key 			(carrera_id, materia_id)				        references materia	(carrera_id, id),
foreign key 			(docente_id)							              references docente	(id)
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
-- Tipos de Documento
--

insert into tipo_documento (`tipo_documento`, `created_at`, `updated_at`)
values  ('DNI', '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Directores
--

insert into director (`tipo_documento_id`, `nro_documento`, `apellidos`, `nombres`,`mail`, `activo`, `created_at`, `updated_at`)
values  (1, 23456789, 'Apellido 2', 'Nombres 2','director1@prueba.com', 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
    	(1, 23456785, 'Apellido 2', 'Nombres 2','director2@prueba.com', 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 12345678, 'Apellido 1', 'Nombres 1','crisdabruno@hotmail.com', 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Directores Tel
--

insert into director_telefono(`director_id`, `telefono`, `created_at`, `updated_at`) 
values  (1, '2222','2016-11-11 00:00:00', '2016-11-11 00:00:00'),
    	(1,  '5555', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, '222', '2016-11-11 00:00:00', '2016-11-11 00:00:00');
       
--
-- Filiales
--

insert into filial (`cadena_id`, `nombre`, `direccion`, `localidad`, `codigo_postal`, `director_id`, `mail`, `activo`, `created_at`, `updated_at`)
values  (1, 'Filial 1', 'Direccion 1', 'Localidad', 1234, 1, 'filial@test.com', 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 'Filial 2', 'Direccion 2', 'Localidad', 1234, 1, 'filial1@test.com', 	1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 'Filial 3', 'Direccion 3', 'Localidad', 1234, 1, 'test@test.com', 		1, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Asesores
--

insert into asesor (`tipo_documento_id`, `nro_documento`, `apellidos`, `nombres`, `direccion`, `localidad`, `activo`, `created_at`, `updated_at`)
values  (1, 12345678, 'Apellido 1', 'Nombres 1', 'Guateico 4323', 'Catan', 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
  		(1, 23456789, 'Apellido 2', 'Nombres 2', 'Guateico 4323', 'Catan', 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Docentes
--

insert into docente (`tipo_documento_id`, `nro_documento`, `apellidos`, `nombres`, `descripcion`, `disponibilidad_manana`, `disponibilidad_tarde`, `disponibilidad_noche`, `disponibilidad_sabados`, `filial_id`, `activo`, `created_at`, `updated_at`)
values  (1, 1234567, 'Apellido 1', 'Nombres 1', 'Sin Descripción.', 1, 1, 1, 1, 3, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Personas
--

insert into persona (`nro_documento`, `tipo_documento_id`, `apellidos`, `nombres`, `genero`, `fecha_nacimiento`, `domicilio`, `localidad`, `estado_civil`, `nivel_estudios`, `estudio_computacion`, `posee_computadora`, `disponibilidad_manana`, `disponibilidad_tarde`, `disponibilidad_noche`, `disponibilidad_sabados`, `aclaraciones`, `filial_id`, `asesor_id`, `activo`, `created_at`, `updated_at`)
values  (12345678, 1, 'Apellido 1', 'Nombres 1', 'M', '1990-01-01', 'Direccion 1', 'Localidad', 'Soltero', 	'Secundario Completo', 	1, 1, 1, 0, 0, 0, null, 3, 1, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (12345679, 1, 'Apellido 2', 'Nombres 2', 'M', '1990-01-01', 'Direccion 2', 'Localidad', 'Casado', 	'Terciario', 			1, 1, 1, 0, 0, 0, null, 3, 1, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (12345670, 1, 'Apellido 3', 'Nombres 3', 'F', '1990-01-01', 'Direccion 3', 'Localidad', 'Soltera', 	'Universitario', 		1, 1, 1, 0, 0, 0, null, 3, 1, 1, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Personas Mails
--

insert into persona_mail (`persona_id`, `mail`, `created_at`, `updated_at`)
values  (1, 'magneto.alfonsin@gmail.com', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 'gabrield75@hotmail.com', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3, 'gabydonatognr@gmail.com', '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Cursos
--

insert into curso (`id`, `nombre`, `duracion`, `descripcion`, `taller`, `created_at`, `updated_at`)
values  (1, 'Curso 1', '50 Días', 'Sin Descripción.', 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 'Curso 2', '50 Días', 'Sin Descripción.', 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3, 'Curso 3', '50 Días', 'Sin Descripción.', 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Carreras
--

insert into carrera (`id`, `nombre`, `duracion`, `descripcion`, `created_at`, `updated_at`)
values  (1, 'Carrera 1', '50 Días', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 'Carrera 2', '50 Días', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3, 'Carrera 3', '50 Días', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Materias
--

insert into materia (`carrera_id`, `nombre`, `descripcion`, `created_at`, `updated_at`)
values  (1, 'Materia 1', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 'Materia 2', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1, 'Materia 3', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 'Materia 4', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 'Materia 5', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3, 'Materia 6', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3, 'Materia 7', 'Sin Descripción.', '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Matrículas
--

insert into matricula (`persona_id`, `curso_id`, `carrera_id`, `filial_id`, `asesor_id`, `activo`, `terminado`, `cancelado`, `created_at`, `updated_at`)
values  (1, null, 1, 3, 1, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (2, 1, null, 3, 2, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (3, null, 1, 3, 1, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Pagos
--

insert into pago (`matricula_id`, `nro_pago`, `pago_individual`, `descripcion`, `terminado`, `vencimiento`, `monto_original`, `monto_actual`, `monto_pago`, `descuento`, `recargo`, `filial_id`, `created_at`, `updated_at`)
values  (1000, 0, 0, 'Sin Descripción.', 0, '2015-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1000, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1000, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1001, 0, 0, 'Sin Descripción.', 0, '2015-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1001, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1001, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1002, 0, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1002, 1, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00'),
        (1002, 2, 0, 'Sin Descripción.', 0, '2017-12-10', 5000, 5000, 0, 100, 15, 3, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Grupos
--

insert into grupo (`curso_id`, `carrera_id`, `materia_id`, `descripcion`, `docente_id`, `nuevo`, `turno_manana`, `turno_tarde`, `turno_noche`, `sabados`, `fecha_inicio`, `fecha_fin`, `filial_id`, `activo`, `terminado`, `cancelado`, `created_at`, `updated_at`)
values  (1, null, null, 'Grupo 1', 1, 0, 1, 1, 1, 1, '2016-12-01', '2017-06-22', 3, 1, 0, 0, '2016-11-11 00:00:00', '2016-11-11 00:00:00');

--
-- Clase Estado
--

insert into clase_estado (`estado`, `created_at`, `updated_at`)
values  ('Pendiente', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
        ('Cancelada', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
        ('Finalizada', '0000-00-00 00:00:00', '0000-00-00 00:00:00');