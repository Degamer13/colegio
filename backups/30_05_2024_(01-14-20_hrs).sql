SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS colegio;

USE colegio;

DROP TABLE IF EXISTS consigned_documents;

CREATE TABLE `consigned_documents` (
  `id_document` int NOT NULL AUTO_INCREMENT,
  `responsible_photo` varchar(255) NOT NULL,
  `id_card_mother_document` varchar(255) NOT NULL,
  `id_card_father_document` varchar(255) NOT NULL,
  `birth_certificate` varchar(255) NOT NULL,
  `student_photo` varchar(255) NOT NULL,
  `id_card_student` varchar(255) NOT NULL,
  `vaccine_slip` varchar(255) NOT NULL,
  `promotion_ticket` varchar(255) NOT NULL,
  `newsletter` varchar(255) NOT NULL,
  `good_conduct_letter` varchar(255) NOT NULL,
  `medical_report` varchar(255) NOT NULL,
  `activity_letter` varchar(255) NOT NULL,
  `student_id3` int NOT NULL,
  PRIMARY KEY (`id_document`),
  KEY `student_id` (`student_id3`),
  CONSTRAINT `consigned_documents_ibfk_1` FOREIGN KEY (`student_id3`) REFERENCES `students` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;




DROP TABLE IF EXISTS degrees;

CREATE TABLE `degrees` (
  `id_degree` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id_degree`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO degrees VALUES("1","1er Grado");
INSERT INTO degrees VALUES("2","2do Grado");
INSERT INTO degrees VALUES("3","3er Grado");
INSERT INTO degrees VALUES("4","4to Grado");
INSERT INTO degrees VALUES("5","5to Grado");
INSERT INTO degrees VALUES("6","6to Grado");



DROP TABLE IF EXISTS representatives;

CREATE TABLE `representatives` (
  `id_representative` int NOT NULL AUTO_INCREMENT,
  `mother` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_card_mother` varchar(11) DEFAULT NULL,
  `year_mother` varchar(11) DEFAULT NULL,
  `address_mother` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `status_mother` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `profession_mother` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `workplace_mother` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `room_phone_mother` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mobile_phone_mother` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `work_phone_mother` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `father` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_card_father` varchar(11) DEFAULT NULL,
  `year_father` varchar(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO representatives VALUES("2","verus","12360136","50","los proceres","Casado(a)","secretaria","isp","0","0","0","deivys","11730667","50","agua salada","Casado(a)","docente","idebol","0","0","0","3");
INSERT INTO representatives VALUES("4","manuela","2344","32","fsd","Soltero(a)","secretaria","isp","2","04143869692","1","nose","0","0","nose","Soltero(a)","nose","nose","0","0","0","5");



DROP TABLE IF EXISTS responsibles;

CREATE TABLE `responsibles` (
  `id_responsible` int NOT NULL AUTO_INCREMENT,
  `responsible` varchar(255) NOT NULL,
  `id_card_responsible` int NOT NULL,
  `year_responsible` int NOT NULL,
  `address_responsible` text NOT NULL,
  `profession_responsible` varchar(255) NOT NULL,
  `workplace_responsible` varchar(255) NOT NULL,
  `student_id2` int NOT NULL,
  PRIMARY KEY (`id_responsible`),
  KEY `student_id` (`student_id2`),
  CONSTRAINT `responsibles_ibfk_1` FOREIGN KEY (`student_id2`) REFERENCES `students` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO responsibles VALUES("2","andres","28731968","22","los proceres","estudiante","universidad","3");
INSERT INTO responsibles VALUES("4","vegueta","122","22","manolo","carajos","ni puta","5");



DROP TABLE IF EXISTS role;

CREATE TABLE `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO role VALUES("1","Administrador");
INSERT INTO role VALUES("2","Secretaria");



DROP TABLE IF EXISTS security_questions;

CREATE TABLE `security_questions` (
  `id_security` int NOT NULL AUTO_INCREMENT,
  `ask1` varchar(255) NOT NULL,
  `ask2` varchar(255) NOT NULL,
  `ask3` varchar(255) NOT NULL,
  `answer1` varchar(255) NOT NULL,
  `answer2` varchar(255) NOT NULL,
  `answer3` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_security`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `security_questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO security_questions VALUES("3","color favorito","animal favorito","comida favorita","morado","tortuga","sopa","8");
INSERT INTO security_questions VALUES("4","goku","vegueta","picoro","1","2","3","13");



DROP TABLE IF EXISTS students;

CREATE TABLE `students` (
  `id_student` int NOT NULL AUTO_INCREMENT,
  `name1` varchar(255) NOT NULL,
  `name2` varchar(255) NOT NULL,
  `last_name1` varchar(255) NOT NULL,
  `last_name2` varchar(255) NOT NULL,
  `id_card` int NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `year` int NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `country` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `another_squad` varchar(255) NOT NULL,
  `repeat_student` varchar(255) NOT NULL,
  `student_illness` varchar(255) NOT NULL,
  `student_lives_with` varchar(255) NOT NULL,
  `medical_assistance` varchar(255) NOT NULL,
  `currently_vaccinated` varchar(255) NOT NULL,
  `academic_activity` varchar(255) NOT NULL,
  `degree_id` int NOT NULL,
  PRIMARY KEY (`id_student`),
  KEY `degree_id` (`degree_id`),
  CONSTRAINT `students_ibfk_1` FOREIGN KEY (`degree_id`) REFERENCES `degrees` (`id_degree`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO students VALUES("3","deivys","francisco","gamarra","nuñez","28731970","Niño","2000-09-13","23","ciudad bolivar","bolivar","venezuela","Venezolano","los proceres","no","No","no","mama y papa","no","No","No","6");
INSERT INTO students VALUES("5","daniela","virginia","torrez","guzman","12345678","Niña","2015-12-12","8","ciudad bolivar","bolivar","venezuela","Extrajero","paseo orinoco","no","Si","si pero es normal","mama","no","Si","Si","1");



DROP TABLE IF EXISTS teachers;

CREATE TABLE `teachers` (
  `id_teacher` int NOT NULL AUTO_INCREMENT,
  `name1_teacher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name2_teacher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_name1_teacher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_name2_teacher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_card_teacher` int NOT NULL,
  `email_teacher` varchar(255) NOT NULL,
  `phone_teacher` varchar(11) NOT NULL,
  `degree_id` int NOT NULL,
  PRIMARY KEY (`id_teacher`),
  KEY `degrees_id` (`degree_id`),
  CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`degree_id`) REFERENCES `degrees` (`id_degree`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO teachers VALUES("3","deivys","francisco de jesus","gamarra","nuñez","28731970","gamarraynunezd@gmail.com","04128726538","4");



DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rol` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO users VALUES("8","admin","admin@gmail.com","$2y$10$4grxHXNsQm/OK1cPJFe8eOFFzDkqFfcOeGssNA1hLqRgODtCy2ule","1");
INSERT INTO users VALUES("12","secretaria","secretaria@gmail.com","$2y$10$dCpfPoWiGj609Lau7N77E.6DL9Vdi8E/SlCpIsZoACzRbYQfvWnpS","2");
INSERT INTO users VALUES("13","vegueta","goku@gmail.com","$2y$10$WIc/77.MhjHxtrHJvm6KFestScymAdd6ABG9iKAqsV.PhksR1x6oq","2");



SET FOREIGN_KEY_CHECKS=1;