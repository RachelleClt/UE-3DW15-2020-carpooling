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

CREATE TABLE `cars` (
  `id` int AUTO_INCREMENT NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `nbrSlots` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `cars` (`id`, `brand`, `model`, `color`, `nbrSlots`) VALUES
(1, 'Skoda', 'Fabia', 'Noire', 5),
(2, 'Huandai', 'Getz', 'Rouge', 5),
(3, 'Mercedes', 'Classe C', 'Noire', 4),
(4, 'Renaut', 'Zoé', 'Bleu', 2);

CREATE TABLE users_cars (
	user_id INT NOT NULL, 
	car_id INT NOT NULL, 
	PRIMARY KEY(user_id, car_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users_cars` (`user_id`, `car_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 4);

CREATE TABLE `annonces` (
  `id` int AUTO_INCREMENT NOT NULL,
  `titre` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `jour` datetime NOT NULL,
  `depart` varchar(255) NOT NULL,
  `arrive` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `annonces` (`id`, `titre`, `lastname`, `date`, `depart`, `arrive`) VALUES
(1, 'Carpool depart de Marseille', 'Godé', '2020-11-28', 'Marseille', 'Nice'),
(2, 'Carpool depart de Troyes', 'Dupond', '2020-11-28', 'Troyes', 'Paris'),
(3, 'Carpool depart de Reims', 'Dumoulin', '2020-11-29', 'Reims', 'Troyes');



CREATE TABLE users_annonces (
	user_id INT NOT NULL,
	annonces_id INT NOT NULL,
	PRIMARY KEY(user_id, annonces_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users_annonces` (`user_id`, `annonces_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 4);

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

CREATE TABLE users_reservation (
	user_id INT NOT NULL,
	reservation_id INT NOT NULL,
	PRIMARY KEY(user_id, reservation_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users_reservation` (`user_id`, `reservation_id`) VALUES
(1, 2),
(1,3),
(2, 3),
(2, 4);

CREATE TABLE `comment` (
  `id` int AUTO_INCREMENT NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `comment` (`id`, `firstname`, `titre`, `commentaire`) VALUES
(1, 'Vincent', 'Super conducteur', 'Voyage agréable,je recommande.'),
(2, 'Paul', 'Cool', 'Chauffeur très sérieux.'),
(3, 'Ben', 'Moyen', 'Musique trop forte, conduite trop sportive.');

CREATE TABLE users_comment (
	user_id INT NOT NULL,
	comment_id INT NOT NULL,
	PRIMARY KEY(user_id, comment_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users_comment` (`user_id`, `comment_id`) VALUES
(1, 2),
(1,3),
(2, 3),
(2, 4);

CREATE TABLE annonce_comment (
	annonce_id INT NOT NULL, 
	comment_id INT NOT NULL, 
	PRIMARY KEY(annonce_id, comment_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `annonce_comment` (`annonce_id`, `comment_id`) VALUES
(1, 1),
(2, 2),
(3, 3);


CREATE TABLE annonce_voitures (
	annonce_id INT NOT NULL, 
	voitures_id INT NOT NULL, 
	PRIMARY KEY(annonce_id, voiture_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `annonce_voitures` (`annonce_id`, `voitures_id`) VALUES
(1, 1),
(2, 2),
(3, 3);


CREATE TABLE annonce_reservation (
	annonce_id INT NOT NULL, 
	reservation_id INT NOT NULL, 
	PRIMARY KEY(annonce_id, reservation_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `annonce_reservation` (`annonce_id`, `reservation_id`) VALUES
(1, 1),
(2, 2),
(3, 3);


