SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS colegio;

USE colegio;

DROP TABLE IF EXISTS consigned_documents;

CREATE TABLE `consigned_documents` (
  `id_document` int NOT NULL AUTO_INCREMENT,
  `responsible_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_card_mother_document` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_card_father_document` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `birth_certificate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `student_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_card_student` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `vaccine_slip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `promotion_ticket` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `newsletter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `good_conduct_letter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `medical_report` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `activity_letter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `student_id3` int NOT NULL,
  PRIMARY KEY (`id_document`),
  KEY `student_id` (`student_id3`),
  CONSTRAINT `consigned_documents_ibfk_1` FOREIGN KEY (`student_id3`) REFERENCES `students` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;




DROP TABLE IF EXISTS degrees;

CREATE TABLE `degrees` (
  `id_degree` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_degree`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

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
  `lapse` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `year_educ` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `qualification` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `promovide` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `degree_id2` int NOT NULL,
  `description2` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_report`),
  KEY `student_id` (`student_id`),
  KEY `degree_id2` (`degree_id2`),
  KEY `student_id_2` (`student_id`),
  KEY `degree_id2_2` (`degree_id2`),
  KEY `student_id_3` (`student_id`),
  CONSTRAINT `report_card_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `report_card_ibfk_2` FOREIGN KEY (`degree_id2`) REFERENCES `degrees` (`id_degree`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO report_card VALUES("9","3","Primer Lapso","2023-2024","A","6to Grado","6","muy bueno");
INSERT INTO report_card VALUES("10","3","Tercer Lapso","2023-2024","A","6to Grado","6","bueno");
INSERT INTO report_card VALUES("11","3","Tercer Lapso","2023-2024","A","1er Año","6","excelente");



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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO representatives VALUES("2","verus","12360136","50","los proceres","Casado(a)","secretaria","isp","0","0","0","deivys","11730667","50","agua salada","Casado(a)","docente","idebol","0","0","0","3");
INSERT INTO representatives VALUES("4","manuela","2344","32","fsd","Soltero(a)","secretaria","isp","2","04143869692","1","nose","0","0","nose","Soltero(a)","nose","nose","0","0","0","5");
INSERT INTO representatives VALUES("5","","","","","","","","","","","","","","","","","","","","","11");
INSERT INTO representatives VALUES("6","quirar afanador","55577744","50","casco historico","Divorsiado(a)","docente","upteb","0","0","0","","","","","","","","","","","12");
INSERT INTO representatives VALUES("7","asdf","234324","23","fdgdsf","Casado(a)","dfgfds","sgf","0","0","0","afdg","245","43","sfdgd","Casado(a)","dfsg","sdgf","0","0","0","13");
INSERT INTO representatives VALUES("9","hkjhkjhkjhk","656565","45","gkjhikjhkjh","","gjgjh","gjhgjhgjh","564","65","654","hgjgjhgj","5465","65","jlkjlkjlk","Casado(a)","gjgjh","hkjhkj","56656","65","64654","15");
INSERT INTO representatives VALUES("11","","","","","","","","","","","","","","","","","","","","","17");



DROP TABLE IF EXISTS responsibles;

CREATE TABLE `responsibles` (
  `id_responsible` int NOT NULL AUTO_INCREMENT,
  `responsible` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_card_responsible` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `year_responsible` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `address_responsible` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `profession_responsible` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `workplace_responsible` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `student_id2` int NOT NULL,
  PRIMARY KEY (`id_responsible`),
  KEY `student_id` (`student_id2`),
  CONSTRAINT `responsibles_ibfk_1` FOREIGN KEY (`student_id2`) REFERENCES `students` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO responsibles VALUES("2","andres","28731968","22","los proceres","estudiante","universidad","3");
INSERT INTO responsibles VALUES("4","vegueta","122","22","manolo","carajos","ni puta","5");
INSERT INTO responsibles VALUES("5","fgdfg","434","4","fdg","df","fdsg","11");
INSERT INTO responsibles VALUES("6","luisa","66677788","70","casco historico","costurera","hogar","12");
INSERT INTO responsibles VALUES("7","fdsg","345","34","dfsgfg","sdfg","sdfg","13");
INSERT INTO responsibles VALUES("9","kjhkjhk","64564","88","gjgjhgjh","jljljl","jlkjlkj","15");
INSERT INTO responsibles VALUES("10","","","","","","","17");



DROP TABLE IF EXISTS role;

CREATE TABLE `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO security_questions VALUES("3","color favorito","animal favorito","comida favorita","morado","tortuga","sopa","8");
INSERT INTO security_questions VALUES("4","goku","vegueta","picoro","1","2","3","13");



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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO students VALUES("3","deivys","francisco","gamarra","nuñez","28731970","Niño","2000-09-13","23","ciudad bolivar","bolivar","venezuela","Venezolano","los proceres","no","No","no","mama y papa","no","No","No","6");
INSERT INTO students VALUES("5","daniela","virginia","torrez","guzman","12345678","Niña","2015-12-12","8","ciudad bolivar","bolivar","venezuela","Extrajero","paseo orinoco","no","Si","si pero es normal","mama","no","Si","Si","1");
INSERT INTO students VALUES("11","fdgfs","dgsfdg","gsdfs","gfsdf","434","Niño","2012-12-12","11","dfsg","sdg","dfsg","Venezolano","dfsg","dfs","No","dfsg","sgdf","dfg","No","No","5");
INSERT INTO students VALUES("12","luis","alfredo","silva","afanador","27256772","Niño","2012-12-12","11","ciudad bolivar","bolivar","venezuela","Venezolano","el casco historico","no","No","no","mama y abuelos","no","Si","No","5");
INSERT INTO students VALUES("13","dani","fds","sdf","sdf","324324","Niño","2012-12-12","11","afd","dfas","adfs","Extrajero","afsd","asdffds","No","goku","asdf","sadfsaf","No","No","4");
INSERT INTO students VALUES("15","jose","jhgjhgjh","khkjhkj","hjgjhg","546546","Niño","2012-12-12","11","hgkjhk","tuytuytuy","ghkjhkjh","Venezolano","gjhgjhg","gjhgjhg","No","gjhgjhgjh","hkjhkjh","hkjhkjhk","No","No","6");
INSERT INTO students VALUES("17","fsg","sf","fsdg","sfdg","4343","Niña","2012-12-12","11","sdfg","sdfg","fdsg","Venezolano","sdg","sfdg","No","sdg","fdsg","dfsg","No","No","3");



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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO teachers VALUES("3","deivys","francisco de jesus","gamarra","nuñez","28731970","gamarraynunezd@gmail.com","04128726538","4");



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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO users VALUES("8","admin","admin@gmail.com","$2y$10$4grxHXNsQm/OK1cPJFe8eOFFzDkqFfcOeGssNA1hLqRgODtCy2ule","1");
INSERT INTO users VALUES("12","secretaria","secretaria@gmail.com","$2y$10$dCpfPoWiGj609Lau7N77E.6DL9Vdi8E/SlCpIsZoACzRbYQfvWnpS","2");
INSERT INTO users VALUES("13","vegueta","goku@gmail.com","$2y$10$WIc/77.MhjHxtrHJvm6KFestScymAdd6ABG9iKAqsV.PhksR1x6oq","2");



SET FOREIGN_KEY_CHECKS=1;