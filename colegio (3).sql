-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 14-06-2024 a las 20:17:26
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `colegio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `degrees`
--

CREATE TABLE `degrees` (
  `id_degree` int NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `degrees`
--

INSERT INTO `degrees` (`id_degree`, `description`) VALUES
(1, '1er Grado'),
(2, '2do Grado'),
(3, '3er Grado'),
(4, '4to Grado'),
(5, '5to Grado'),
(6, '6to Grado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `report_card`
--

CREATE TABLE `report_card` (
  `id_report` int NOT NULL,
  `student_id` int NOT NULL,
  `lapse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `year_educ` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `qualification` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `promovide` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `degree_id2` int NOT NULL,
  `description2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representatives`
--

CREATE TABLE `representatives` (
  `id_representative` int NOT NULL,
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
  `student_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsibles`
--

CREATE TABLE `responsibles` (
  `id_responsible` int NOT NULL,
  `responsible` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_card_responsible` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `year_responsible` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `address_responsible` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `profession_responsible` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `workplace_responsible` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `student_id2` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `id_role` int NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`id_role`, `description`) VALUES
(1, 'Administrador'),
(2, 'Secretaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `security_questions`
--

CREATE TABLE `security_questions` (
  `id_security` int NOT NULL,
  `ask1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ask2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ask3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `answer1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `answer2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `answer3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `security_questions`
--

INSERT INTO `security_questions` (`id_security`, `ask1`, `ask2`, `ask3`, `answer1`, `answer2`, `answer3`, `user_id`) VALUES
(3, 'color favorito', 'animal favorito', 'comida favorita', 'morado', 'tortuga', 'sopa', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `students`
--

CREATE TABLE `students` (
  `id_student` int NOT NULL,
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
  `degree_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teachers`
--

CREATE TABLE `teachers` (
  `id_teacher` int NOT NULL,
  `name1_teacher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name2_teacher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_name1_teacher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_name2_teacher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_card_teacher` int NOT NULL,
  `email_teacher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone_teacher` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `degree_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role_id`) VALUES
(8, 'admin', 'admin@gmail.com', '$2y$10$4grxHXNsQm/OK1cPJFe8eOFFzDkqFfcOeGssNA1hLqRgODtCy2ule', 1),
(12, 'secretaria', 'secretaria@gmail.com', '$2y$10$dCpfPoWiGj609Lau7N77E.6DL9Vdi8E/SlCpIsZoACzRbYQfvWnpS', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `degrees`
--
ALTER TABLE `degrees`
  ADD PRIMARY KEY (`id_degree`);

--
-- Indices de la tabla `report_card`
--
ALTER TABLE `report_card`
  ADD PRIMARY KEY (`id_report`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `degree_id2` (`degree_id2`),
  ADD KEY `student_id_2` (`student_id`),
  ADD KEY `degree_id2_2` (`degree_id2`),
  ADD KEY `student_id_3` (`student_id`);

--
-- Indices de la tabla `representatives`
--
ALTER TABLE `representatives`
  ADD PRIMARY KEY (`id_representative`),
  ADD KEY `student_id` (`student_id`);

--
-- Indices de la tabla `responsibles`
--
ALTER TABLE `responsibles`
  ADD PRIMARY KEY (`id_responsible`),
  ADD KEY `student_id` (`student_id2`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indices de la tabla `security_questions`
--
ALTER TABLE `security_questions`
  ADD PRIMARY KEY (`id_security`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id_student`),
  ADD KEY `degree_id` (`degree_id`);

--
-- Indices de la tabla `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id_teacher`),
  ADD KEY `degrees_id` (`degree_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol` (`role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `degrees`
--
ALTER TABLE `degrees`
  MODIFY `id_degree` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `report_card`
--
ALTER TABLE `report_card`
  MODIFY `id_report` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `representatives`
--
ALTER TABLE `representatives`
  MODIFY `id_representative` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `responsibles`
--
ALTER TABLE `responsibles`
  MODIFY `id_responsible` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `security_questions`
--
ALTER TABLE `security_questions`
  MODIFY `id_security` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `students`
--
ALTER TABLE `students`
  MODIFY `id_student` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id_teacher` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `report_card`
--
ALTER TABLE `report_card`
  ADD CONSTRAINT `report_card_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `report_card_ibfk_2` FOREIGN KEY (`degree_id2`) REFERENCES `degrees` (`id_degree`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `representatives`
--
ALTER TABLE `representatives`
  ADD CONSTRAINT `representatives_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `responsibles`
--
ALTER TABLE `responsibles`
  ADD CONSTRAINT `responsibles_ibfk_1` FOREIGN KEY (`student_id2`) REFERENCES `students` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `security_questions`
--
ALTER TABLE `security_questions`
  ADD CONSTRAINT `security_questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`degree_id`) REFERENCES `degrees` (`id_degree`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`degree_id`) REFERENCES `degrees` (`id_degree`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
