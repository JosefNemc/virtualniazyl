SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
                         `id` int NOT NULL AUTO_INCREMENT,
                         `user_name` varchar(255) COLLATE utf8mb4_czech_ci NOT NULL,
                         `first_name` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
                         `last_name` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
                         `email` varchar(255) COLLATE utf8mb4_czech_ci NOT NULL,
                         `role` varchar(16) COLLATE utf8mb4_czech_ci NOT NULL,
                         `password` varchar(512) COLLATE utf8mb4_czech_ci NOT NULL,
                         `created_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
                         `created_by` int DEFAULT '0',
                         `updated_at` datetime NOT NULL,
                         `updated_by` int DEFAULT '0',
                         `verified` varchar(255) COLLATE utf8mb4_czech_ci NOT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

INSERT INTO `users` (`id`, `user_name`, `first_name`, `last_name`, `email`, `role`, `password`, `created_at`, `created_by`, `updated_at`, `updated_by`, `verified`) VALUES
                     (1,	'noro',	'Josef',	'Němec',	'foto@josefnemec.cz',	'superadmin',	'$2y$12$gIgCUWXAX8.P5n0JvgNkUeBi4O4YbucB0QC.VCjdw.N6U3Yconyra',	'2024-01-15 20:51:42',	1,	'2024-01-15 20:51:42',	1,	'0');