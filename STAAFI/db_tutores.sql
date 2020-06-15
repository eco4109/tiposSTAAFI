CREATE DATABASE IF NOT EXISTS tutores_db DEFAULT CHARACTER SET utf8 ;
USE tutores_db ;

CREATE TABLE IF NOT EXISTS tutores_db.actividad (
	clave_actividad VARCHAR(8) NOT NULL,
	descripcion_actividad VARCHAR(500) NOT NULL,
	PRIMARY KEY (clave_actividad)
);

CREATE TABLE IF NOT EXISTS tutores_db.perfil (
	nombre_perfil VARCHAR(8) NOT NULL,
	PRIMARY KEY (nombre_perfil)
);

CREATE TABLE IF NOT EXISTS tutores_db.catalogo_actividad (
	id_catalogo_actividad INT NOT NULL AUTO_INCREMENT,
	clave_actividad VARCHAR(8) NOT NULL,
	nombre_perfil VARCHAR(8) NOT NULL,
	PRIMARY KEY (id_catalogo_actividad),
	CONSTRAINT Perfil_Catalogos
		FOREIGN KEY (nombre_perfil)
		REFERENCES tutores_db.perfil (nombre_perfil)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION,
	CONSTRAINT Actividad_Catalogos
		FOREIGN KEY (clave_actividad)
		REFERENCES tutores_db.actividad (clave_actividad)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
);


CREATE TABLE IF NOT EXISTS tutores_db.tutor (
	clave_tutor VARCHAR(13) NOT NULL,
	nombre_tutor VARCHAR(40) NOT NULL,
	apellido_paterno_tutor VARCHAR(40) NOT NULL, 
	apellido_materno_tutor VARCHAR(40) NOT NULL,
	correo_tutor VARCHAR(45) NOT NULL,
	es_colaborativo TINYINT NOT NULL,
	credenciales_login_tutor VARCHAR(45) NOT NULL,
	credenciales_password_tutor VARCHAR(256) NOT NULL, 
	PRIMARY KEY (clave_tutor)
);  

CREATE TABLE IF NOT EXISTS tutores_db.rol (
	nombre_rol VARCHAR(20) NOT NULL,
	descripcion_rol VARCHAR(80) NOT NULL,
	PRIMARY KEY (nombre_rol)
);


CREATE TABLE IF NOT EXISTS tutores_db.rol_tutor (
	id_rol_tutor INT NOT NULL AUTO_INCREMENT,
	nombre_rol VARCHAR(20) NOT NULL,
	clave_tutor VARCHAR(13) NOT NULL,
	PRIMARY KEY (id_rol_tutor),
	CONSTRAINT Tutores_Roles
		FOREIGN KEY (clave_tutor)
		REFERENCES tutores_db.tutor (clave_tutor)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION,
	CONSTRAINT Rol_Roles
		FOREIGN KEY (nombre_rol)
		REFERENCES tutores_db.rol (nombre_rol)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION	
);  

INSERT INTO tutores_db.actividad(clave_actividad, descripcion_actividad) VALUES ('1.4.1.1','1.4.1.1 - Capacitar a los alumnos en habilidades de lectura y escritura, así como en procesos de comunicación oral y escrita, y de aprendizaje.'); 
INSERT INTO tutores_db.actividad(clave_actividad, descripcion_actividad) VALUES ('1.4.1.2','1.4.1.2 - Realizar las actividades para desarrollar la creatividad, toma de decisiones y solución de problemas.'); 
INSERT INTO tutores_db.actividad(clave_actividad, descripcion_actividad) VALUES ('1.4.1.3','1.4.1.3 - Desarrollar e instrumentar estrategias de aprendizaje y técnicas de estudios para favorecer el aprendizaje significativo de los alumnos.'); 
INSERT INTO tutores_db.actividad(clave_actividad, descripcion_actividad) VALUES ('1.4.1.4','1.4.1.4 - Organizar actividades en las cuales los estudiantes fortalezcan actitudes encaminadas a la prácticas de estilos de vida saludable, al desarrollo sustentable, la cultura cívica, la responsabilidad social, el humanismo y el bienestar común.'); 
INSERT INTO tutores_db.actividad(clave_actividad, descripcion_actividad) VALUES ('1.4.1.5','1.4.1.5 - Involucrar a los alumnos en actividades que desarrollen su sentido de responsabilidad individual y colectiva, de autoestima, autocontrol y sociabilidad.'); 
INSERT INTO tutores_db.actividad(clave_actividad, descripcion_actividad) VALUES ('1.4.1.6','1.4.1.6 - Impulsar la participación de los alumnos en actividades artísticas y culturales como complemento de su formación integral.'); 
INSERT INTO tutores_db.actividad(clave_actividad, descripcion_actividad) VALUES ('1.4.2.1','1.4.2.1 - Reforzar la capacidad de los estudiantes para planificar y administrar el tiempo y los recursos humanos y materiales.'); 
INSERT INTO tutores_db.actividad(clave_actividad, descripcion_actividad) VALUES ('1.4.2.2','1.4.2.2 - Conducir a los alumnos al desarrollo de habilidades, destrezas y actitudes para el trabajo en equipo, promoviendo la vocación de servicio, liderazgo, negociación y cumplimiento de metas en los distintos ámbitos del desempeño profesional.'); 
INSERT INTO tutores_db.actividad(clave_actividad, descripcion_actividad) VALUES ('1.4.2.3','1.4.2.3 - Habilitar a los estudiantes en el uso de las TIC para la búsqueda, análisis y sistematización de la información, que les permita la adquisición de nuevos conocimientos y que favorezca una empleabilidad pertinente.'); 
INSERT INTO tutores_db.actividad(clave_actividad, descripcion_actividad) VALUES ('1.4.3.1','1.4.3.1 - Asesorar la inscripción oportuna, con carga acdémica viable, equilibrada y pertinente.'); 
INSERT INTO tutores_db.actividad(clave_actividad, descripcion_actividad) VALUES ('1.4.3.2','1.4.3.2 - Apoyar la solución de problemas académico-administrativos para facilitar la inscripción.'); 
INSERT INTO tutores_db.actividad(clave_actividad, descripcion_actividad) VALUES ('1.4.3.3','1.4.3.3 - Guiar la opción e inscripción de cursos en periodos intensivos.'); 
INSERT INTO tutores_db.actividad(clave_actividad, descripcion_actividad) VALUES ('1.4.4.1','1.4.4.1 - Identificar alumnos en condición vulnerable y facilitar participación en programas de apoyo institucional.'); 
INSERT INTO tutores_db.actividad(clave_actividad, descripcion_actividad) VALUES ('1.4.4.2','1.4.4.2 - Divulgar la normatividad relativa a la permanencia académica.'); 
INSERT INTO tutores_db.actividad(clave_actividad, descripcion_actividad) VALUES ('1.4.4.3','1.4.4.3 - Brindar información sobre procesos y trámites de las dependencias de apoyo al estudiante.'); 

INSERT INTO tutores_db.tutor(clave_tutor,nombre_tutor,apellido_paterno_tutor,apellido_materno_tutor,correo_tutor,es_colaborativo,credenciales_login_tutor,credenciales_password_tutor) VALUES ('admin','admin','admin','admin','sistema.tutores.apoyo.fiuaemex@gmail.com',1,'admin','$2y$10$THGKqcSVZ8FwKUqquxpFQup9cVY6xb.fk.wlcJlMwF/KGdgH5NS5q');
 
INSERT INTO tutores_db.rol(nombre_rol,descripcion_rol) VALUES ('Administrador','Acceso a todos los módulos. Jerarquía más alta del sistema'); 
INSERT INTO tutores_db.rol(nombre_rol,descripcion_rol) VALUES ('Tutor Administrador','Acceso a todos los módulos con excepción del Módulo de Tutores y el de Actividades.'); 
INSERT INTO tutores_db.rol(nombre_rol,descripcion_rol) VALUES ('Tutor','Acceso a todos los módulos de Tutorados, Actividad de Tutorado y el de Catalogos Actividades'); 
