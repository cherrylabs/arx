-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 25 Juin 2012 à 15:01
-- Version du serveur: 5.5.9
-- Version de PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `arxmin`
--

-- --------------------------------------------------------

--
-- Structure de la table `a_categories`
--

CREATE TABLE `a_categories` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `uniquename` text NOT NULL,
  `context` text NOT NULL,
  `template` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `a_categories`
--

--
-- Structure de la table `t_labels`
--

CREATE TABLE `t_labels` (
  `id` varchar(255) NOT NULL,
  `uniquename` text NOT NULL,
  `value` text NOT NULL,
  `isocode` text NOT NULL,
  `context` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='t_labels arx';

--
-- Contenu de la table `t_labels`
--

INSERT INTO `t_labels` VALUES('hello_world', 'Hello world !', 'en', '');
INSERT INTO `t_labels` VALUES('hello_world', 'Salut le monde !', 'fr', '');
INSERT INTO `t_labels` VALUES('hello_world', '¡Hola, mundo', 'es', '');
INSERT INTO `t_labels` VALUES('hello_world', 'Hallo Welt', 'al', '');

-- --------------------------------------------------------

--
-- Structure de la table `a_perms`
--

CREATE TABLE `a_perms` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `general_perm` text NOT NULL,
  `extended_perm` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `a_perms`
--


-- --------------------------------------------------------

--
-- Structure de la table `a_roles`
--

CREATE TABLE `a_roles` (
  `ID` bigint(20) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `roleName` varchar(20) NOT NULL,
  `perm_id` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `roleName` (`roleName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `a_roles`
--

INSERT INTO `a_roles` VALUES(00000000000000000001, 'Administrators', 0);
INSERT INTO `a_roles` VALUES(00000000000000000002, 'All Users', 0);
INSERT INTO `a_roles` VALUES(00000000000000000003, 'Authors', 0);
INSERT INTO `a_roles` VALUES(00000000000000000004, 'Premium Members', 0);

-- --------------------------------------------------------

--
-- Structure de la table `a_users`
--

CREATE TABLE `a_users` (
  `ID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `facebook_id` text COLLATE utf8_unicode_ci NOT NULL,
  `twitter_id` text COLLATE utf8_unicode_ci NOT NULL,
  `firstname` text COLLATE utf8_unicode_ci NOT NULL,
  `lastname` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `authorization` text COLLATE utf8_unicode_ci NOT NULL,
  `extendedInfo` text COLLATE utf8_unicode_ci NOT NULL,
  `context` text COLLATE utf8_unicode_ci NOT NULL,
  `categories` text COLLATE utf8_unicode_ci NOT NULL,
  `language` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `a_users`
--

INSERT INTO `a_users` VALUES(0000000005, 'admin', 'dd94709528bb1c83d08f3088d4043f4742891f4f', '', '', 'John', 'Doe', 'info@lacerisenumerique.be', '', '', '', '', '');
