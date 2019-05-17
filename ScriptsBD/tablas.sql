USE gestiondepartes;


DROP TABLE IF EXISTS alumnos;
DROP TABLE IF EXISTS profesores;
DROP TABLE IF EXISTS partes;

-- Creación de tabla Alumnos
Create table alumnos(
alum_id int(4) not null primary key,
alum_nombre varchar(50) not null,
alum_apellidos varchar(100) not null,
alum_grupo varchar(10) not null
);


-- Creación de tabla Profesores
Create table profesores(
prof_id int(4) not null primary key,
prof_nombre varchar(50) not null,
prof_apellidos varchar(100) not null,
prof_grupo varchar(10) not null
);


-- Creacion de tabla Partes
Create table partes(
part_id int(10) not null primary key,
part_nivel varchar(10) not null,
part_observaciones varchar(250),
part_alumno int(4) not null,
part_profesor int(4) not null
);
