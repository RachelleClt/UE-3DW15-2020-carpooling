CREATE TABLE `users` (
  `id` int AUTO_INCREMENT NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `birthday`) VALUES
(1, 'Vincent', 'Godé', 'hello@vincentgo.fr', '1990-11-08'),
(2, 'Albert', 'Dupond', 'sonemail@gmail.com', '1985-11-08'),
(3, 'Thomas', 'Dumoulin', 'sonemail2@gmail.com', '1985-10-08');

CREATE TABLE `annonces` (
  `id` int AUTO_INCREMENT NOT NULL,
  `titre` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `depart` varchar(255) NOT NULL,
  `arrive` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `annonces` (`id`, `titre`, `lastname`, `date`, `depart`, `arrive`) VALUES
(1, 'Carpool depart de Marseille', 'Godé', '2020-11-28', 'Marseille', 'Nice'),
(2, 'Carpool depart de Troyes', 'Dupond', '2020-11-28', 'Troyes', 'Paris'),
(3, 'Carpool depart de Reims', 'Dumoulin', '2020-11-29', 'Reims', 'Troyes');

CREATE TABLE `voitures` (
  `id` int AUTO_INCREMENT NOT NULL,
  `marque` varchar(255) NOT NULL,
  `modele` varchar(255) NOT NULL,
  `couleur` varchar(255) NOT NULL,
  `proprietaire` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `voitures` (`id`, `marque`, `modele`, `couleur`, `proprietaire`) VALUES
(1, 'Peugeot', '208', 'Gris', 'Godé'),
(2, 'Peugeot', '3008', 'Noir', 'Dupond'),
(3, 'Citroen', 'C3', 'Blanc', 'Dumoulin');

CREATE TABLE `reservation` (
  `id` int AUTO_INCREMENT NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `lieu_depart` varchar(255) NOT NULL,
  `lieu_arrivee` varchar(255) NOT NULL,
  `date_reservation` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `reservation` (id, firstname, lastname, email, lieu_depart, lieu_arrivee, date_reservation) VALUES
(1, 'Alexandre', 'TOPSI', 'alexandretospi@gmail.com', 'Montpellier', 'Marseille', '2020-11-25'),
(2, 'Vincent', 'GODE', 'vincentgode@gmail.com', 'Limoges', 'Paris', '2020-11-26'),
(3, 'Rachelle', 'COLAT', 'rachellecolat@gmail.com', 'Paris', 'Toulouse', '2020-11-28');

CREATE TABLE `commentaire` (
  `id` int AUTO_INCREMENT NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `commentaire` (`id`, `firstname`, `titre`, `commentaire`) VALUES
(1, 'Vincent', 'Super conducteur', 'Voyage agréable,je recommande.'),
(2, 'Paul', 'Cool', 'Chauffeur très sérieux.'),
(3, 'Ben', 'Moyen', 'Musique trop forte, conduite trop sportive.');
