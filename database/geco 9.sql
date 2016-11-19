drop database if exists geco;
create database geco;
use geco;

create table if not exists curso(
id			varchar(50) not null,
nombre		varchar(50) not null,
duracion 	varchar(50),
descripcion	varchar(300) default 'Sin Descripción.',
taller		boolean default false,
created_at	timestamp not null default '0000-00-00 00:00:00',
updated_at	timestamp not null default '0000-00-00 00:00:00',
primary key	(id)
);

create table if not exists carrera(
id			varchar(50) not null,
nombre		varchar(50) not null,
duracion 	varchar(50),
descripcion	varchar(300) default 'Sin Descripción.',
created_at	timestamp not null default '0000-00-00 00:00:00',
updated_at	timestamp not null default '0000-00-00 00:00:00',
primary key	(id)
);

create table if not exists materia(
id			varchar(50) not null,
carrera_id	varchar(50) not null,
nombre		varchar(50) not null,
descripcion	varchar(300) default 'Sin Descripción.',
created_at	timestamp not null default '0000-00-00 00:00:00',
updated_at	timestamp not null default '0000-00-00 00:00:00',
primary key (id, carrera_id),
foreign key (carrera_id)				references carrera	(id)
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
foreign key		(director_id) references director (id)
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
id 						int not null auto_increment,
preinforme_id			int,	
persona_id				int not null,
carrera_id				varchar(50),
curso_id				varchar(50),
descripcion				varchar (300),
created_at				timestamp not null default '0000-00-00 00:00:00',
updated_at				timestamp not null default '0000-00-00 00:00:00',
primary key 			(id),
foreign key 			(persona_id)			references persona		(id),
foreign key 			(preinforme_id)			references preinforme 	(id),
foreign key 			(carrera_id)			references carrera		(id),
foreign key 			(curso_id)				references curso		(id)
);

create table if not exists matricula(
id				int not null auto_increment,
persona_id		int not null,
curso_id		varchar(50),
carrera_id		varchar(50),
filial_id		int,
asesor_id		int,
activo			boolean not null default true,
terminado		boolean not null default false,
cancelado		boolean not null default false,
created_at  	timestamp not null default '0000-00-00 00:00:00',
updated_at  	timestamp not null default '0000-00-00 00:00:00',
primary key 	(id),	
foreign key 	(persona_id)		references persona	(id),
foreign key 	(curso_id)			references curso	(id),
foreign key 	(carrera_id)		references carrera	(id),
foreign key 	(filial_id)			references filial	(id),
foreign key 	(asesor_id)			references asesor	(id)
)AUTO_INCREMENT=1000;

create table if not exists matricula_permisos(
matricula_id	int not null,
filial_id		int not null,
created_at		timestamp not null default '0000-00-00 00:00:00',
updated_at		timestamp not null default '0000-00-00 00:00:00',
primary key 	(matricula_id, filial_id),
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
id						int not null auto_increment,
tipo_documento_id 		int,
nro_documento			varchar(50),
apellidos				varchar(50) not null,
nombres					varchar(50) not null,
descripcion				varchar(300),
disponibilidad_manana	boolean,
disponibilidad_tarde	boolean,
disponibilidad_noche	boolean,
disponibilidad_sabados	boolean,
filial_id				int not null,
activo					boolean not null default true,
created_at  			timestamp not null default '0000-00-00 00:00:00',
updated_at  			timestamp not null default '0000-00-00 00:00:00',
primary key 			(id),
unique key				(tipo_documento_id, nro_documento),
foreign key 			(tipo_documento_id)					references tipo_documento	(id),
foreign key 			(filial_id)							references filial			(id)
);

create table if not exists grupo(
id				varchar(50) not null,
curso_id		varchar(50),
carrera_id		varchar(50),
materia_id 		varchar(50),
descripcion		varchar(300),
docente_id		int not null,
turno_manana	boolean,
turno_tarde		boolean,
turno_noche		boolean,
sabados			boolean,
color 			varchar(45),
fecha_inicio	datetime not null,
fecha_fin		datetime,
filial_id		int not null,
activo			boolean not null default true,
terminado		boolean not null default false,
cancelado		boolean not null default false,
created_at  	timestamp not null default '0000-00-00 00:00:00',
updated_at  	timestamp not null default '0000-00-00 00:00:00',
primary key 	(id),
foreign key 	(curso_id)					references curso	(id),
foreign key 	(carrera_id, materia_id)	references materia	(carrera_id, id),
foreign key 	(docente_id)				references docente	(id),
foreign key 	(filial_id)					references filial	(id)
);

create table if not exists grupo_horario(
grupo_id		varchar(50) not null,
dia				int(1) not null,
horario_desde	time not null,
horario_hasta	time not null,
created_at  	timestamp not null default '0000-00-00 00:00:00',
updated_at  	timestamp not null default '0000-00-00 00:00:00',
primary key		(grupo_id, dia, horario_desde, horario_hasta),
foreign key		(grupo_id)										references grupo	(id)
);

create table if not exists grupo_matricula(
grupo_id		varchar(50) not null,
matricula_id	int not null,
created_at  	timestamp not null default '0000-00-00 00:00:00',
updated_at  	timestamp not null default '0000-00-00 00:00:00',
primary key 	(grupo_id, matricula_id),
foreign key 	(grupo_id)					references grupo		(id),
foreign key 	(matricula_id)				references matricula	(id)
);

create table if not exists clase(
id 				int(11) not null auto_increment,
grupo_id		varchar(50) not null,
fecha			datetime not null,
docente_id		int not null,
dia				int(1) not null,
horario_desde	time not null,
horario_hasta	time not null,
estado 			boolean not null default true,
descripcion		varchar(300),
created_at  	timestamp not null default '0000-00-00 00:00:00',
updated_at  	timestamp not null default '0000-00-00 00:00:00',
primary key	(id),
foreign key	(grupo_id)			references grupo	(id),
foreign key	(docente_id)		references docente	(id)
);

create table if not exists clase_matricula(
id 				int(11) not null,
clase_id		int(11) not null,
fecha			datetime not null,
matricula_id	int not null,
asistio			boolean not null,
created_at  	timestamp not null default '0000-00-00 00:00:00',
updated_at  	timestamp not null default '0000-00-00 00:00:00',
primary key 	(id),	
foreign key 	(clase_id)							references clase		(id),
foreign key 	(matricula_id)						references matricula	(id)
);

create table if not exists examen(
nro_acta				int not null auto_increment,
recuperatorio_nro_acta	int,
matricula_id			int not null,
grupo_id				varchar(50),
nota					int(2) not null,
carrera_id				varchar(50) not null,
materia_id				varchar(50) not null,
docente_id				int not null,
created_at  			timestamp not null default '0000-00-00 00:00:00',
updated_at  			timestamp not null default '0000-00-00 00:00:00',
primary key 			(nro_acta, matricula_id),
foreign key 			(recuperatorio_nro_acta, matricula_id)	references examen	(nro_acta, matricula_id),
foreign key				(grupo_id)								references grupo	(id),
foreign key 			(carrera_id, materia_id)				references materia	(carrera_id, id),
foreign key 			(docente_id)							references docente	(id)
);