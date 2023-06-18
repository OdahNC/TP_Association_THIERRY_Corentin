-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.33 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage de la structure de table tp_association. emprunt
CREATE TABLE IF NOT EXISTS `emprunt` (
  `emprunt_id` int NOT NULL AUTO_INCREMENT,
  `membre_id` int NOT NULL,
  `ouvrage_id` int NOT NULL,
  `emprunt_date` date NOT NULL,
  PRIMARY KEY (`emprunt_id`),
  KEY `FK__membre` (`membre_id`),
  KEY `FK__ouvrage` (`ouvrage_id`),
  CONSTRAINT `FK__membre` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`),
  CONSTRAINT `FK__ouvrage` FOREIGN KEY (`ouvrage_id`) REFERENCES `ouvrage` (`ouvrage_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Les différents emprunts réalisés par les membres';

-- Listage des données de la table tp_association.emprunt : ~1 rows (environ)

-- Listage de la structure de table tp_association. membre
CREATE TABLE IF NOT EXISTS `membre` (
  `membre_id` int NOT NULL AUTO_INCREMENT,
  `membre_nom` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `membre_prenom` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `membre_tel` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `membre_mail` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `membre_mdp` varchar(255) NOT NULL,
  `membre_administrateur` tinyint(1) NOT NULL DEFAULT '0',
  `membre_session_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`membre_id`),
  UNIQUE KEY `membre_mail` (`membre_mail`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Table répertoriant tous les membres faisant partie de l''association';

-- Listage des données de la table tp_association.membre : ~3 rows (environ)
INSERT INTO `membre` (`membre_id`, `membre_nom`, `membre_prenom`, `membre_tel`, `membre_mail`, `membre_mdp`, `membre_administrateur`, `membre_session_id`) VALUES
	(1, 'Administrateur', 'Administrateur', '00.00.00', 'administrateur@administrateur.nc', '$2y$10$2L/YLTy0vYniIzVK6ru7WuYF0V17R1PjmHZbqPHwpry3.ZT0ek4ES', 1, 'Jahf3JuDQKGsbaYQwpy0gXeZI46sQXr9'),
	(3, 'Ophélie', 'Lassy', '75.36.94', 'ophelie.lassy@librairiesocialclub.nc', '$2y$10$LMHiSr2cpb1w92mjo2kbIOjOc8ihgc9Y0w.y87RVsUmN88QL7rWf2', 0, 'JYQ8HaiczMGcbp4mVhZMMkil3QLWyrrF'),
	(4, 'Mark', 'Lechevalier', '56.25.89', 'mark.lavoine@librairiesocialclub.nc', '$2y$10$9FQZuUNhEW4GBUktgMUHpOQpqQ62dhZazVdgTTo4cM7oFZXCfZcAe', 0, 'sonUzgLP1k2BLBUKmWsg3un9hzCwp7gx');

-- Listage de la structure de table tp_association. ouvrage
CREATE TABLE IF NOT EXISTS `ouvrage` (
  `ouvrage_id` int NOT NULL AUTO_INCREMENT,
  `ouvrage_nom` varchar(80) NOT NULL,
  `ouvrage_type` varchar(50) NOT NULL,
  `ouvrage_auteur` varchar(50) NOT NULL,
  `ouvrage_descriptif` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ouvrage_date_parution` year NOT NULL DEFAULT '0000',
  `ouvrage_etat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ouvrage_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Liste de tous les ouvrages que possèdent l''association';

-- Listage des données de la table tp_association.ouvrage : ~9 rows (environ)
INSERT INTO `ouvrage` (`ouvrage_id`, `ouvrage_nom`, `ouvrage_type`, `ouvrage_auteur`, `ouvrage_descriptif`, `ouvrage_date_parution`, `ouvrage_etat`) VALUES
	(2, 'La planète des singes', 'Science-Fiction', 'Pierre Boulle', 'Imaginez-vous, explorateur audacieux, embarqué à bord d\'un vaisseau spatial en compagnie d\'une équipe de scientifiques déterminés. Votre destination : Soror, une planète lointaine aux mystères insoupçonnés. Mais le destin en a décidé autrement, et vous voilà échoué sur ce monde étrange, à l\'apparence paisible, mais dont les secrets sont bien plus sombres que vous ne l\'imaginiez.', '1963', 0),
	(3, 'Ravage', 'Science-Fiction', 'René Barjavel', 'Imaginez-vous, citoyen contemporain, vivant une existence paisible dans une métropole moderne. Mais un jour, une catastrophe inimaginable frappe soudainement, plongeant le monde dans l\'obscurité et le désespoir. Un mystérieux cataclysme s\'abat sur la planète, détruisant les infrastructures, anéantissant les systèmes de communication et plongeant la société dans un état de confusion totale.', '1943', 0),
	(6, 'Un été avec Jankélévitch', 'Philosophie', 'Cynthia Fleuri', 'Né en 1903, mort en 1985, Jankélévitch connu les succès au crépuscule de sa vie et fut l’un des philosophes alors les plus médiatiques. Il est aujourd’hui le penseur qui convient pour conjurer la désespérance et le pessimisme. Jankélévitch nous apprend le charme de l’instant, les joies de l’action, nous met en garde contre les conformismes de la pensée et les mondes enrégimentés. C’est le pianiste de la philosophie, il joue sur les concepts comme sur un clavier. Ne manquons pas notre unique matinée de printemps. Jankélévitch disciple d’Alain nous montre que c’est l’heure, que cette heure ne dure qu’un instant. Le vent se lève, c’est maintenant ou jamais. Cynthia Fleury, philosophe, psychanalyste, auteur à succès d’ouvrages sur la fin du courage, le soin ou le ressentiment nous offre un été avec Jankélévitch allègre plein de paradoxes sur le temps et son irréversibilité. Un dialogue sur la jeunesse d’esprit qui est le meilleur remède contre les passions tristes qui nous menacent.', '2023', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
