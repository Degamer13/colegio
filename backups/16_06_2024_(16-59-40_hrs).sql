SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS colegio;

USE colegio;

DROP TABLE IF EXISTS degrees;

CREATE TABLE `degrees` (
  `id_degree` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_degree`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO degrees VALUES("1","1er Grado");
INSERT INTO degrees VALUES("2","2do Grado");
INSERT INTO degrees VALUES("3","3er Grado");
INSERT INTO degrees VALUES("4","4to Grado");
INSERT INTO degrees VALUES("5","5to Grado");
INSERT INTO degrees VALUES("6","6to Grado");



DROP TABLE IF EXISTS report_card;

CREATE TABLE `report_card` (
  `id_report` int NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `lapse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `year_educ` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `qualification` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `promovide` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `degree_id2` int NOT NULL,
  `description2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_report`),
  KEY `student_id` (`student_id`),
  KEY `degree_id2` (`degree_id2`),
  KEY `student_id_2` (`student_id`),
  KEY `degree_id2_2` (`degree_id2`),
  KEY `student_id_3` (`student_id`),
  CONSTRAINT `report_card_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `report_card_ibfk_2` FOREIGN KEY (`degree_id2`) REFERENCES `degrees` (`id_degree`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO report_card VALUES("16","20","Primer Lapso","2023-2024","A","3er Grado","3","bien");
INSERT INTO report_card VALUES("17","20","Segundo Lapso","2023-2024","A","3er Grado","3","bien");
INSERT INTO report_card VALUES("18","20","Tercer Lapso","2023-2024","A","4to Grado","3","bien");



DROP TABLE IF EXISTS representatives;

CREATE TABLE `representatives` (
  `id_representative` int NOT NULL AUTO_INCREMENT,
  `mother` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_card_mother` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `year_mother` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `address_mother` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `status_mother` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `profession_mother` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `workplace_mother` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `room_phone_mother` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mobile_phone_mother` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `work_phone_mother` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `father` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_card_father` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `year_father` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `address_father` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `status_father` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `profession_father` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `workplace_father` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `room_phone_father` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mobile_phone_father` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `work_phone_father` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `student_id` int NOT NULL,
  PRIMARY KEY (`id_representative`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `representatives_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO representatives VALUES("14","daniela castillo","12360136","50","los proceres","Casado(a)","secretaria","isp","","04143869692","","daniel","11730667","50","los proceres","Casado(a)","docente","fe y alegria","","04128726538","","20");
INSERT INTO representatives VALUES("15","","","","","","","","","","","","","","","","","","","","","21");
INSERT INTO representatives VALUES("16","","","","","","","","","","","","","","","","","","","","","22");
INSERT INTO representatives VALUES("17","","","","","","","","","","","","","","","","","","","","","23");



DROP TABLE IF EXISTS responsibles;

CREATE TABLE `responsibles` (
  `id_responsible` int NOT NULL AUTO_INCREMENT,
  `responsible` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_card_responsible` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `year_responsible` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `address_responsible` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `profession_responsible` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `workplace_responsible` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `student_id2` int NOT NULL,
  PRIMARY KEY (`id_responsible`),
  KEY `student_id` (`student_id2`),
  CONSTRAINT `responsibles_ibfk_1` FOREIGN KEY (`student_id2`) REFERENCES `students` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO responsibles VALUES("13","jesus perez","27663222","24","los proceres","estudiante","universidad","20");
INSERT INTO responsibles VALUES("14","afsafs","423423","23","afss","safsaf","","21");
INSERT INTO responsibles VALUES("15","saffs","23423333","666","gasgsag","agfags","sagsafgs","22");
INSERT INTO responsibles VALUES("16","AFA","33333333","33","33333333333","AFSAFS","AFSSAF","23");



DROP TABLE IF EXISTS role;

CREATE TABLE `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO role VALUES("1","Administrador");
INSERT INTO role VALUES("2","Secretaria");



DROP TABLE IF EXISTS security_questions;

CREATE TABLE `security_questions` (
  `id_security` int NOT NULL AUTO_INCREMENT,
  `ask1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ask2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ask3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `answer1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `answer2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `answer3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_security`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `security_questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO security_questions VALUES("3","color favorito","animal favorito","comida favorita","morado","tortuga","sopa","8");



DROP TABLE IF EXISTS students;

CREATE TABLE `students` (
  `id_student` int NOT NULL AUTO_INCREMENT,
  `name1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_name1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_name2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_card` int NOT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `birthdate` date NOT NULL,
  `year` int NOT NULL,
  `birthplace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nationality` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `another_squad` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `repeat_student` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `student_illness` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `student_lives_with` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `medical_assistance` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `currently_vaccinated` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `academic_activity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `degree_id` int NOT NULL,
  PRIMARY KEY (`id_student`),
  KEY `degree_id` (`degree_id`),
  CONSTRAINT `students_ibfk_1` FOREIGN KEY (`degree_id`) REFERENCES `degrees` (`id_degree`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO students VALUES("20","daniela","jose","perez ","castillo","12345678","Femenino","2015-02-12","9","ciudad bolivar","bolivar","venezuela","Venezolano","los proceres","no","No","no","mama y papa","no","Si","No","3");
INSERT INTO students VALUES("21","sdfsaf","asf","asf","afsf","23423233","Masculino","2015-05-15","9","sagsg","safdasf","asfasg","Venezolano","safsfa","fas","No","afs","asf","fas","No","No","3");
INSERT INTO students VALUES("22","asfsf","asfsffsd","safsfa","asfasf","43525423","Masculino","2015-12-15","8","gjhgj","gf","ghgjg","Venezolano","fsgfg","affsg","No","fsadfs","sf","saf","No","No","2");
INSERT INTO students VALUES("23","sfdddddddddddddddd","sfaafssf","safsfa","safsfa","22222222","Masculino","2020-12-12","3","sfAS","SFA","FSAS","Venezolano","ASF","AF","No","SAF","FSA","SAF","No","No","4");



DROP TABLE IF EXISTS teachers;

CREATE TABLE `teachers` (
  `id_teacher` int NOT NULL AUTO_INCREMENT,
  `name1_teacher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name2_teacher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_name1_teacher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_name2_teacher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_card_teacher` int NOT NULL,
  `email_teacher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone_teacher` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `degree_id` int NOT NULL,
  PRIMARY KEY (`id_teacher`),
  KEY `degrees_id` (`degree_id`),
  CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`degree_id`) REFERENCES `degrees` (`id_degree`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO teachers VALUES("9","jose","daniel","torres","castillo","11111111","jose@gmail.com","33333333333","3");



DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rol` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO users VALUES("8","admin","admin@gmail.com","$2y$10$mbRESKxrR.O9CcBXjPbj9.2V6MieWXoo5ttwRP9lznKeFo.nlFpvC","1");
INSERT INTO users VALUES("12","secretaria","secretaria@gmail.com","$2y$10$dCpfPoWiGj609Lau7N77E.6DL9Vdi8E/SlCpIsZoACzRbYQfvWnpS","2");



SET FOREIGN_KEY_CHECKS=1;