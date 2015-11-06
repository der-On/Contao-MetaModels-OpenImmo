-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 06. Nov 2015 um 16:30
-- Server Version: 5.5.46-0+deb8u1
-- PHP-Version: 5.6.14-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mm_immo`
--

DROP TABLE IF EXISTS `mm_immo`;
CREATE TABLE IF NOT EXISTS `mm_immo` (
`id` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  `sorting` int(10) unsigned NOT NULL DEFAULT '0',
  `tstamp` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `baujahr` double DEFAULT NULL,
  `zimmer` int(10) DEFAULT NULL,
  `nutzflaeche` double DEFAULT NULL,
  `gesamtflaeche` double DEFAULT NULL,
  `miete_zzgl_nk` double DEFAULT NULL,
  `miete_inkl_nk` double DEFAULT NULL,
  `plz` varchar(255) NOT NULL DEFAULT '',
  `ort` varchar(255) NOT NULL DEFAULT '',
  `stadtteil` varchar(255) NOT NULL DEFAULT '',
  `courtage_text` text,
  `verfuegbar_ab` varchar(255) NOT NULL DEFAULT '',
  `nebenkosten` double DEFAULT NULL,
  `kaution` double DEFAULT NULL,
  `schlafzimmer` int(10) DEFAULT NULL,
  `badezimmer` int(10) DEFAULT NULL,
  `etage` varchar(255) NOT NULL DEFAULT '',
  `balkon` char(1) NOT NULL DEFAULT '',
  `bad` char(1) NOT NULL DEFAULT '',
  `badewanne` char(1) NOT NULL DEFAULT '',
  `dusche` char(1) NOT NULL DEFAULT '',
  `bad_fenster` char(1) NOT NULL DEFAULT '',
  `beschreibung` text,
  `lagebeschreibung` text,
  `sonstiges` text,
  `ausstattung` text,
  `bilder` blob,
  `grundrisse` blob,
  `verwalter_name` varchar(255) NOT NULL DEFAULT '',
  `verwalter_vorname` varchar(255) NOT NULL DEFAULT '',
  `verwalter_tel` varchar(255) NOT NULL DEFAULT '',
  `verwalter_mobil` varchar(255) NOT NULL DEFAULT '',
  `verwalter_email` varchar(255) NOT NULL DEFAULT '',
  `active` char(1) NOT NULL DEFAULT '',
  `kaufpreis` double DEFAULT NULL,
  `verwalter_fax` varchar(255) NOT NULL DEFAULT '',
  `wohnung` char(1) NOT NULL DEFAULT '',
  `gewerbe` char(1) NOT NULL DEFAULT '',
  `anlage` char(1) NOT NULL DEFAULT '',
  `kauf` char(1) NOT NULL DEFAULT '',
  `haustyp` varchar(255) NOT NULL DEFAULT '',
  `zimmertyp` varchar(255) NOT NULL DEFAULT '',
  `buerotyp` varchar(255) NOT NULL DEFAULT '',
  `hallentyp` varchar(255) NOT NULL DEFAULT '',
  `einzelhandeltyp` varchar(255) NOT NULL DEFAULT '',
  `gastrotyp` varchar(255) NOT NULL DEFAULT '',
  `grundstuecktyp` varchar(255) NOT NULL DEFAULT '',
  `verkaufstyp` varchar(255) NOT NULL DEFAULT '',
  `objekt_alter` varchar(255) NOT NULL DEFAULT '',
  `mieteinnahmen_soll` double DEFAULT NULL,
  `mieteinnahmen_faktor` double DEFAULT NULL,
  `grundstuecksflaeche` double DEFAULT NULL,
  `einbaukueche` char(1) NOT NULL DEFAULT '',
  `aufzug` char(1) NOT NULL DEFAULT '',
  `senioren` char(1) NOT NULL DEFAULT '',
  `wohnungstyp` varchar(255) NOT NULL DEFAULT '',
  `wohnflaeche` double DEFAULT NULL,
  `titelbild` blob,
  `kurzbeschreibung` text,
  `zustand` varchar(255) NOT NULL DEFAULT '',
  `keller` char(1) NOT NULL DEFAULT '',
  `objektart` varchar(255) NOT NULL DEFAULT '',
  `gaeste_wc` char(1) NOT NULL DEFAULT '',
  `verwalter_email_zentrale` varchar(255) NOT NULL DEFAULT '',
  `verwalter_firma` varchar(255) NOT NULL DEFAULT '',
  `verwalter_strasse` varchar(255) NOT NULL DEFAULT '',
  `verwalter_hausnummer` varchar(255) NOT NULL DEFAULT '',
  `verwalter_plz` varchar(255) NOT NULL DEFAULT '',
  `verwalter_ort` varchar(255) NOT NULL DEFAULT '',
  `strasse` varchar(255) NOT NULL DEFAULT '',
  `hausnummer` varchar(255) NOT NULL DEFAULT '',
  `object_id` varchar(255) NOT NULL DEFAULT '',
  `qualitaet_der_austattung` varchar(255) NOT NULL DEFAULT '',
  `gewerbeflaeche` double DEFAULT NULL,
  `anzahl_etagen` int(10) DEFAULT NULL,
  `letzte_modernisierung` varchar(255) NOT NULL DEFAULT '',
  `denkmalgeschuetzt` char(1) NOT NULL DEFAULT '',
  `barrierefrei` char(1) NOT NULL DEFAULT '',
  `energiepass_art` varchar(255) NOT NULL DEFAULT '',
  `energiepass_kennwert` varchar(255) NOT NULL DEFAULT '',
  `mieteinnahmen_ist` double DEFAULT NULL,
  `top_angebot` char(1) NOT NULL DEFAULT '',
  `flaeche` double DEFAULT NULL,
  `miete_pacht` char(1) NOT NULL DEFAULT '',
  `vermarktungsart` varchar(255) NOT NULL DEFAULT '',
  `nutzungsart` varchar(255) NOT NULL DEFAULT '',
  `investment` char(1) NOT NULL DEFAULT '',
  `provision` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=5565 DEFAULT CHARSET=utf8;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `mm_immo`
--
ALTER TABLE `mm_immo`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `mm_immo`
--
ALTER TABLE `mm_immo`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5565;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
