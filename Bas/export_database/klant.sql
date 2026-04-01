SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE `klant` (
  `klantId` int(11) NOT NULL,
  `klantNaam` varchar(45) DEFAULT NULL,
  `klantEmail` varchar(45) NOT NULL,
  `klantAdres` varchar(45) NOT NULL,
  `klantPostcode` varchar(6) DEFAULT NULL,
  `klantWoonplaats` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `klant` (`klantId`, `klantNaam`, `klantEmail`, `klantAdres`, `klantPostcode`, `klantWoonplaats`) VALUES
(1, 'Win', 'win@gmail.com', 'Slige', '1234 W', 'Rotterdam'),
(2, 'Hiiii', 'Hi@gmail.com', 'Latte', '4321', 'Rotterdam'),
(3, 'bbb', 'bbb', '', NULL, NULL),
(4, 'eee', 'eee', '', NULL, NULL),
(5, 'eee', 'eee', '', NULL, NULL);


ALTER TABLE `klant`
  ADD PRIMARY KEY (`klantId`),
  ADD UNIQUE KEY `KlantenId_UNIQUE` (`klantId`);


ALTER TABLE `klant`
  MODIFY `klantId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;
