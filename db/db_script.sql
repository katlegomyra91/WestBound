/* CREATE AND SELECT DATABLE */
CREATE DATABASE westbound_demo;
USE westbound;
/* INFORMATION TABLES */
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  CONSTRAINT pk_users_id PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `tbl_cinemas` (
  `id` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  CONSTRAINT pk_cinemas_id PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
INSERT INTO `tbl_cinemas`(`name`)
VALUES ("Centurion Ster-Kinekor"), ("iMax"), ("Movies @ Woodlands");

CREATE TABLE IF NOT EXISTS `tbl_movies` (
  `id` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  CONSTRAINT pk_contact_types_type_id PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
INSERT INTO `tbl_movies`(`name`)
VALUES ("Zootopia"), ("Hell or High Water"), ("Moonlight"), ("Arrival"), ("The Jungle Book"), ("La La Land"), ("Love & Friendship"), ("Finding Dory"), ("Manchester by the Sea"), ("Kubo and the Two Strings"), ("Things to Come"), ("Hunt for the Wilderpeople"), ("Moana"), ("Don't Think Twice"), ("Captain America: Civil War");

/* REFERENCE TABLES */
CREATE TABLE IF NOT EXISTS `tbl_showing` (
  `id` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `cinema_id` int(2) unsigned NOT NULL,
  `movie_id` int(2) unsigned NOT NULL,
  CONSTRAINT pk_showing_id PRIMARY KEY (`id`),
  CONSTRAINT fk_showing_cinema_id FOREIGN KEY (`cinema_id`) REFERENCES `tbl_cinemas`(`id`),
  CONSTRAINT fk_showing_movie_id FOREIGN KEY (`movie_id`) REFERENCES `tbl_movies`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `tbl_showing`(`cinema_id`, `movie_id`)
VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(2,8),(2,9),(2,10),(2,11),(2,12),(2,13),(3,14),(3,15),(3,1),(3,2),(3,3);