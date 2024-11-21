DROP DATABASE IF EXISTS `ducan`;

CREATE DATABASE IF NOT EXISTS `ducan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pekara`;

CREATE TABLE IF NOT EXISTS `proizvodi` (
   `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
   `naziv` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
   `kolicina` int UNSIGNED NOT NULL,
   PRIMARY KEY (`id`)
);

INSERT INTO `proizvodi` (`naziv`, `kolicina`) VALUES
   ('mlijeko', 1000),
   ('kruh', 500),
   ('sunka', 200),
   ('sladoled', 200),
   ('pepsi', 2000);

DROP PROCEDURE IF EXISTS `izmjena_kolicine`;

DELIMITER //

CREATE PROCEDURE IF NOT EXISTS `izmjena_kolicine`(
   IN prodan_proizvod_id INT UNSIGNED,
   IN prodana_kolicina INT UNSIGNED
)

BEGIN
   DECLARE stara_kolicina INT UNSIGNED;

   START TRANSACTION;

   IF prodana_kolicina = 0 THEN
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Izmjena nije potrebna';
   END IF;

   IF NOT EXISTS (SELECT 1 FROM proizvodi WHERE id = prodan_proizvod_id) THEN
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Proizvod ne postoji';
   ELSE
       SELECT kolicina
           INTO stara_kolicina
           FROM proizvodi
           WHERE id = prodan_proizvod_id
           FOR UPDATE;
   END IF;

   IF (stara_kolicina - prodana_kolicina) >= 0 THEN
       UPDATE proizvodi
           SET kolicina = (stara_kolicina - prodana_kolicina)
           WHERE id = prodan_proizvod_id;

       COMMIT;
   ELSE
       ROLLBACK;
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Nema dovoljno na zalihi';
   END IF;

END //

DELIMITER ;

-- poziv procedure
CALL izmjena_kolicine(4, 25);