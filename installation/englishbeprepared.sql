-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-12-2012 a las 16:48:00
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `englishb_prepared`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(160) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `posicion` int(11) DEFAULT '0',
  `path` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `link` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ranking`
--

CREATE TABLE IF NOT EXISTS `ranking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mark` double NOT NULL,
  `correct` int(11) NOT NULL,
  `incorrect` int(11) NOT NULL,
  `blanks` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ranking`
--

INSERT INTO `ranking` (`id`, `mark`, `correct`, `incorrect`, `blanks`) VALUES
(1, 9.56, 29, 1, 0),
(2, 7.4, 24, 6, 0),
(3, 4.27, 14, 4, 12),
(4, 8.7, 27, 3, 0),
(5, 8.37, 26, 3, 1),
(6, 8.7, 27, 3, 0),
(7, 0.67, 2, 0, 28),
(8, 1, 3, 0, 27),
(9, 1, 3, 0, 27),
(10, -0.2, 0, 2, 28),
(11, -0.2, 0, 2, 28),
(12, 1.57, 5, 1, 24),
(13, 9.57, 29, 1, 0),
(14, 7.4, 24, 6, 0),
(15, 1.57, 5, 1, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testnivel`
--

CREATE TABLE IF NOT EXISTS `testnivel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text COLLATE utf8_spanish_ci NOT NULL,
  `answer` varchar(140) COLLATE utf8_spanish_ci NOT NULL,
  `answerList` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `testnivel`
--

INSERT INTO `testnivel` (`id`, `question`, `answer`, `answerList`) VALUES
(1, 'Are there_apples in the kitchen?', 'any', 'much;any;some'),
(2, 'He was wearing_riding boots', 'old red Spanish leather', 'red old Spanish leather;old leather red Spanish;old red Spanish leather;Spanish red old leather'),
(3, 'I went_church last Saturday', 'to', 'at;in;to'),
(4, 'I_a new car last month', 'bought', 'bought;have bought;buyed'),
(5, 'How_money do you have in your pocket?', 'much', 'many;much;few'),
(6, 'He came_home late last night', '--', '--;at;to'),
(7, 'Jack is a nice boy and I like_', 'him', '--;him;his'),
(8, '_he gets,_', 'The richer, the more friends he has', 'The richer, the more friends he has;Richer, more friends he has;The richer, the more he has friends;Richer, more he has friends'),
(9, 'I like_music', 'listening to', 'listen;listen to;listening to'),
(10, 'What_he like? He''s very friendly', 'is', 'does;did;is'),
(11, 'What_in your free time?', 'do you do', 'you do;do you do;are you doing'),
(12, 'My father_in a bank', 'is working', 'had worked;work;is working'),
(13, 'Would you like_coffe?', 'some', 'a;an;some'),
(14, 'He is a very_driver', 'careful', 'carefully;careful;care'),
(15, 'Her brother had an accident; She_visit him next week', 'is going to', 'is going to;will;is'),
(16, 'I''m going to Seattle_English', 'to learn', 'for learning;to learn;for to learn'),
(17, 'What_! Look at that mess!', 'are you doing', 'do you do;is you do;are you doing'),
(18, 'He enjoys_football', 'playing', 'to play;play;playing'),
(19, 'Paris is_city I have ever visited', 'the most beautiful', 'The beatifulest;the most beautiful;most beautiful'),
(20, 'Today is_than yesterday', 'hotter', 'hoter;more hot;hotter'),
(21, 'Jack is a_tennis player than Peter', 'better', 'gooder;better;badder'),
(22, 'I''m going home_it''s late', 'because', 'why;that;because'),
(23, '_"The Sting"?', 'have you ever seen', 'did you ever see;have you ever seen;have you ever see'),
(24, 'We watch a_TV last night', 'film war on', 'war film in;film of war on;film war on;film''s war in'),
(25, 'Nobody phoned, did_?', 'they', 'he;she;they;nobody'),
(26, 'My car was more expensive_his', 'than', 'as;so;than;that'),
(27, 'When_to her?', 'have you talked', 'you talked;have you talk;have you talked;did you say'),
(28, 'She_she wanted to come', 'said', 'told;said me;said;told to me'),
(29, 'We_a wonderful dinner yesterday evening', 'had', 'have had;has;had;didn''t had'),
(30, 'I_TV when the telephone rang', 'was watching', 'was watching;watched;have watched;watch'),
(31, '_your homework yet?', 'Have you finished', 'Were you finished;Did yoy finiched;Have you finished;Finished'),
(32, 'I''m hungry. Just a moment, I_make you a sandwich', '''ll', '''m going to;''ll;''m;should'),
(33, 'I enjoys his books because he writes so_', 'well', 'good;goodly;well;gooder'),
(34, '_he look like?', 'What does', 'How does;How is;What is;What does'),
(35, 'She asked him_her', 'to help', 'help;to help;helping;helped'),
(36, 'We_leave at seven o''clock', 'have to', 'must;have to;should to;need'),
(37, 'If you want to be healthy, you_smoke', 'shouldn''t', 'needn''t;couldn''t;shouldn''t;mustn''t to'),
(38, 'He''s_politics', 'interested in', 'interested;interresting;interesting to;interested in'),
(39, 'What will you do if he_?', 'doesn''t come', 'isn''t coming;won''t come;not come;doesn''t come'),
(40, 'Would you mind_me a hand?', 'giving', 'to give;give;giving;to giving'),
(41, 'I tried my best but I_do the exercise', 'couldn''t', 'not able to;couldn''t;didn''t could;could'),
(42, 'I miss the train so I_take the next one', 'had to', 'musted;must;had to;had'),
(43, 'I_them since we were children', 'have known', 'know;known;have known;has known'),
(44, 'He has_eaten', 'already', 'yet;already;still;until'),
(45, 'I''ve met the person_lives in that house', 'who', 'which;whose;who;where'),
(46, 'They''ve been to France,_they?', 'haven''t', 'isn''t;doesn''t;been;haven''t'),
(47, 'He Tom! I_you for a long time', 'haven''t seen', 'didn''t see;haven''t seen;don''t see;aren''t seeing'),
(48, '_jacket is this? It''s mine', 'whose', 'who;whose;which;what'),
(49, '_is the phase of flight in which an aircraft goes through a transition from movin along the ground to flying in the air', 'take off', 'take out;take off;take in;take over'),
(50, 'We have to put away all these papers in that', 'folder', 'folder;carpet;cabinet');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `textosinicio`
--

CREATE TABLE IF NOT EXISTS `textosinicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texto` varchar(140) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `textosinicio`
--

INSERT INTO `textosinicio` (`id`, `texto`, `categoria`) VALUES
(1, 'Tus clases de Inglés personalizadas, en casa o por grupos pequeños', 'Inglés Niños'),
(2, 'Clases de apoyo, refuerzo o perfeccionamiento según tu necesidad', 'Inglés Jóvenes y Adultos'),
(3, 'Inglés dirigido a trabajadores y empresarios', 'Inglés Empresas'),
(4, 'Clases a distancia con nuevas tecnologías', 'Inglés Internet');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `password`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
