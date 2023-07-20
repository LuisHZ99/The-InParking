CREATE DATABASE theinparking;
USE theinparking;

create table usuario(
id_usuario int auto_increment primary key,
nombre_u varchar(30),
ap_u varchar(30),
am_u varchar (30),
usuario varchar(30),
contraseña varchar(30)
);

INSERT INTO usuario (nombre_u,ap_u,am_u,usuario,contraseña) 
VALUES ('Luis Fernando','Hernandez','Zuñiga','Luis_HZ','luis2023');


create table vehiculos(
placa varchar(20) primary key,
color varchar(20),
modelo varchar(20),
marca varchar (20)
);

INSERT INTO vehiculos (placa,color,modelo,marca)
VALUES ('ALV-875-F','Rojo','Mazda 3','Mazda');
INSERT INTO vehiculos (placa,color,modelo,marca)
VALUES ('HH-34-FEA','Negro','Turbo','Bora');
INSERT INTO vehiculos (placa,color,modelo,marca)
VALUES ('IWP-2S-2S','Negro','Turbo','Jetta');
INSERT INTO vehiculos (placa,color,modelo,marca)
VALUES ('SUE-D34-F3','Negro','Frontier','Nissan');

create table alumnos(
foto_a varchar (30),
no_control int auto_increment primary key,
nombre varchar(30),
ap_a varchar(30),
am_a varchar (30),
carrera varchar(30),
telefono varchar (15),
placa_a varchar(20),
FOREIGN KEY (placa_a) references vehiculos (placa)
);


INSERT INTO alumnos (foto_a,no_control, nombre, ap_a, am_a, carrera, telefono, placa_a)
VALUES('imagenes/19200202.png',19200202, 'Luis', 'Hernandez', 'Zuñiga', 'Sistemas',7715672300,'ALV-875-F');
INSERT INTO alumnos (foto_a,no_control, nombre, ap_a, am_a, carrera, telefono, placa_a)
VALUES('imagenes/19200198.png',19200198, 'Omar', 'Hernandez', 'Baños', 'Sistemas',7715672300,'HH-34-FEA');
INSERT INTO alumnos (foto_a,no_control, nombre, ap_a, am_a, carrera, telefono, placa_a)
VALUES('imagenes/19200417.png',19200417, 'Sharon', 'Vera', 'Garcia', 'Sistemas',7715687208,'SUE-D34-F3');
INSERT INTO alumnos (foto_a,no_control, nombre, ap_a, am_a, carrera, telefono, placa_a)
VALUES('imagenes/17200737.png',17200737, 'Elbert', 'Ibarra', 'Lecona', 'Sistemas',7712057804,'IWP-2S-2S');


create table visitantes(
codigo_v int auto_increment primary key,
nombre_v varchar(30) not null,
ap_v varchar(30) not null,
am_v varchar(30) not null,
identificacion_v varchar (50) not null,
motivo varchar(50) not null,
destino_v varchar(50) not null,
placa_v varchar(20) not null,
modelo_v varchar(20) not null,
fecha_e_v datetime not null default current_timestamp
);

create table proveedores(
codigo_p int auto_increment primary key,
nombre_p varchar(30) not null,
ap_p varchar(30) not null,
am_p varchar(30) not null,
identificacion_p varchar(30) not null,
empresa varchar(30) not null,
placa_p varchar(20) not null,
modelo_p varchar(20) not null,
fecha_e_p datetime not null default current_timestamp
);


-- entrada y salida alumnos 
create table entradaalumnos(
identrada_a int auto_increment primary key,
fecha_i_a datetime not null default current_timestamp,
codigo_nc_ea int not null,
FOREIGN KEY (codigo_nc_ea) references alumnos (no_control)
);

create table salidaalumnos(
idsalida_a int auto_increment primary key,
identrada_sa int,
fecha_s_a datetime not null default current_timestamp,
codigo_nc_sa int not null,
FOREIGN KEY (codigo_nc_sa) references alumnos (no_control),
FOREIGN KEY (identrada_sa) references entradaalumnos (identrada_a)
);


-- PROCEDIMIENTO PARA INGRESAR SESION
DELIMITER $$
create procedure usu_acceso(
usuario varchar (30),
contraseña varchar (30)
) begin
	if exists(  select  u.nombre_u, u.ap_u, am_u, u.usuario
				from    usuario u 
				where   u.usuario = usuario
				and     u.contraseña = contraseña) then


					select  '1' as estatus,
                     concat(u.nombre_u, ' ', u.ap_u, ' ', u.am_u)
                     as nombre_completo_u, usuario
					from    usuario u
					where   u.usuario = usuario
					and     u.contraseña = contraseña;
	else
					select '0' as estatus;
	end if;
    
    
end $$
DELIMITER ;

DROP PROCEDURE usu_acceso;
call usu_acceso ('Luis_HZ','luis2023');


DELIMITER $$
create procedure ins_registrov(
nombre_v varchar(30),
ap_v varchar(30),
am_v varchar(30),
identificacion_v varchar (30),
motivo varchar(50),
destino_v varchar (30),
placa_v varchar(20),
modelo_v varchar(20)
)
begin
insert into visitantes values (codigo_v, nombre_v, ap_v, am_v, identificacion_v, motivo, destino_v, placa_v, modelo_v, CURRENT_TIMESTAMP);
end$$
DELIMITER $$


-- procedimiento proveedores
DELIMITER $$
create procedure ins_registrop(
nombre_p varchar(30),
ap_p varchar(30),
am_p varchar(30),
identificacion_p varchar(30),
empresa varchar(30),
placa_p varchar(20),
modelo_p varchar(20)
)
begin
insert into proveedores values (codigo_p, nombre_p, ap_p, am_p, identificacion_p, empresa, placa_p, modelo_p, CURRENT_TIMESTAMP);
end$$
DELIMITER $$


