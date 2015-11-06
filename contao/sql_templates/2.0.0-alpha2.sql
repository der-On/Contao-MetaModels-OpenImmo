SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tl_metamodel`
--

DROP TABLE IF EXISTS `tl_metamodel`;
CREATE TABLE IF NOT EXISTS `tl_metamodel` (
  `tstamp` int(10) unsigned NOT NULL DEFAULT '0',
  `sorting` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `tableName` varchar(64) NOT NULL DEFAULT '',
  `translated` char(1) NOT NULL DEFAULT '',
  `languages` text,
  `varsupport` char(1) NOT NULL DEFAULT '',
`id` int(10) unsigned NOT NULL,
  `mode` int(1) unsigned NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tl_metamodel`
--

INSERT INTO `tl_metamodel` (`tstamp`, `sorting`, `name`, `tableName`, `translated`, `languages`, `varsupport`, `id`, `mode`) VALUES
(1409131636, 128, 'Immobilien', 'mm_immo', '', NULL, '', 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tl_metamodels_openimmo`
--

DROP TABLE IF EXISTS `tl_metamodels_openimmo`;
CREATE TABLE IF NOT EXISTS `tl_metamodels_openimmo` (
  `name` varchar(64) NOT NULL DEFAULT '',
  `oiVersion` varchar(32) NOT NULL DEFAULT '1.2.1',
  `uniqueIDField` varchar(1024) NOT NULL DEFAULT '',
  `metamodel` int(10) unsigned NOT NULL DEFAULT '0',
  `exportPath` blob,
  `filesPath` blob,
`id` int(10) unsigned NOT NULL,
  `sorting` int(10) unsigned NOT NULL DEFAULT '0',
  `tstamp` int(10) unsigned NOT NULL DEFAULT '0',
  `deleteFilesOlderThen` int(10) unsigned NOT NULL DEFAULT '0',
  `autoSync` varchar(16) NOT NULL DEFAULT 'never',
  `lastSync` int(32) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tl_metamodels_openimmo`
--

INSERT INTO `tl_metamodels_openimmo` (`name`, `oiVersion`, `uniqueIDField`, `metamodel`, `exportPath`, `filesPath`, `id`, `sorting`, `tstamp`, `deleteFilesOlderThen`, `autoSync`, `lastSync`) VALUES
('Immobilien', '1.2.5', 'anbieter/immobilie/verwaltung_techn/objektnr_extern', 1, 0xb4f0581b427f11e49f4e00266c4ef190, 0xb516aaee427f11e49f4e00266c4ef190, 1, 128, 1422024618, 365, 'hourly', 1425644396);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tl_metamodels_openimmo_fields`
--

DROP TABLE IF EXISTS `tl_metamodels_openimmo_fields`;
CREATE TABLE IF NOT EXISTS `tl_metamodels_openimmo_fields` (
  `name` varchar(64) NOT NULL DEFAULT '',
  `metamodelAttribute` int(10) unsigned NOT NULL DEFAULT '0',
  `oiFieldGroup` varchar(1024) NOT NULL DEFAULT '',
  `oiField` varchar(1024) NOT NULL DEFAULT '',
  `oiCallback` varchar(1024) NOT NULL DEFAULT '',
  `oiCustomField` varchar(1024) NOT NULL DEFAULT '',
  `oiDefaultValue` varchar(1024) NOT NULL DEFAULT '',
  `oiConditionField` varchar(1024) NOT NULL DEFAULT '',
  `oiConditionValue` varchar(1024) NOT NULL DEFAULT '',
`id` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `sorting` int(10) unsigned NOT NULL DEFAULT '0',
  `tstamp` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tl_metamodels_openimmo_fields`
--

INSERT INTO `tl_metamodels_openimmo_fields` (`name`, `metamodelAttribute`, `oiFieldGroup`, `oiField`, `oiCallback`, `oiCustomField`, `oiDefaultValue`, `oiConditionField`, `oiConditionValue`, `id`, `pid`, `sorting`, `tstamp`) VALUES
('Einzelhandeltyp', 51, 'anbieter/immobilie/objektkategorie', 'objektart/einzelhandel@handel_typ', '', '', '', '', '', 35, 1, 2048, 1409144949),
('Einbauküche', 61, 'anbieter/immobilie/ausstattung', 'kueche@EBK', '', '', '', '', '', 34, 1, 1920, 1409144905),
('Courtagetext', 15, 'anbieter/immobilie/preise', 'courtage_hinweis', '', '', '', '', '', 32, 1, 1664, 1409144829),
('Bürotyp', 49, 'anbieter/immobilie/objektkategorie', 'objektart/buero_praxen@buero_typ', '', '', '', '', '', 31, 1, 1536, 1409144771),
('Bilder', 31, 'anbieter/immobilie/anhaenge', 'anhang/daten/pfad', '', '', '', 'anbieter/immobilie/anhaenge/anhang@gruppe', 'BILD', 30, 1, 1408, 1411386754),
('Baujahr', 4, 'anbieter/immobilie/zustand_angaben', 'baujahr', '', '', '', '', '', 29, 1, 1280, 1409144683),
('Dusche', 25, 'anbieter/immobilie/ausstattung', 'bad@DUSCHE', '', '', '', '', '', 33, 1, 1792, 1409144870),
('Balkon', 22, 'anbieter/immobilie/flaechen', 'anzahl_balkone', '', '', '', '', '', 28, 1, 1152, 1409144839),
('Badfenster', 26, 'anbieter/immobilie/ausstattung', 'bad@FENSTER', '', '', '', '', '', 27, 1, 1024, 1409144597),
('Badewanne', 24, 'anbieter/immobilie/ausstattung', 'bad@WANNE', '', '', '', '', '', 26, 1, 896, 1409144582),
('Bad', 23, 'anbieter/immobilie/ausstattung', 'bad', '', '', '', '', '', 25, 1, 768, 1409144565),
('Ausstattung', 30, 'anbieter/immobilie/freitexte', 'ausstatt_beschr', '', '', '', '', '', 24, 1, 640, 1411386862),
('Anzahl Schlafzimmer', 19, 'anbieter/immobilie/flaechen', 'anzahl_schlafzimmer', '', '', '', '', '', 23, 1, 512, 1409144525),
('Anzahl Badezimmer', 20, 'anbieter/immobilie/flaechen', 'anzahl_badezimmer', '', '', '', '', '', 22, 1, 384, 1409144507),
('Anlage', 43, 'anbieter/immobilie/objektkategorie', 'nutzungsart@ANLAGE', '', '', '', '', '', 21, 1, 256, 1409144482),
('Alter', 55, 'anbieter/immobilie/zustand_angaben', 'alter@alter_attr', '', '', '', '', '', 20, 1, 128, 1409144470),
('Etage', 21, 'anbieter/immobilie/geo', 'etage', '', '', '', '', '', 36, 1, 2176, 1409144974),
('Exposé-Überschrift', 1, 'anbieter/immobilie/freitexte', 'objekttitel', '', '', '', '', '', 37, 1, 2304, 1409145004),
('Gastrotyp', 52, 'anbieter/immobilie/objektkategorie', 'objektart/gastgewerbe@gastgew_typ', '', '', '', '', '', 38, 1, 2432, 1409145039),
('Gesamtfläche', 8, 'anbieter/immobilie/flaechen', 'gesamtflaeche', '', '', '', '', '', 39, 1, 2560, 1409145055),
('Gewerbe', 42, 'anbieter/immobilie/objektkategorie', 'nutzungsart@GEWERBE', '', '', '', '', '', 40, 1, 2688, 1409145085),
('Grundrisse', 32, 'anbieter/immobilie/anhaenge', 'anhang/daten/pfad', '', '', '', 'anbieter/immobilie/anhaenge/anhang@gruppe', 'GRUNDRISS', 41, 1, 2816, 1409145168),
('Grundstücksfläche', 60, 'anbieter/immobilie/flaechen', 'grundstuecksflaeche', '', '', '', '', '', 42, 1, 2944, 1409145190),
('Grundstücktyp', 53, 'anbieter/immobilie/objektkategorie', 'objektart/grundstueck@grundst_typ', '', '', '', '', '', 43, 1, 3072, 1409145206),
('Hallentyp', 50, 'anbieter/immobilie/objektkategorie', 'objektart/hallen_lager_prod@hallen_typ', '', '', '', '', '', 44, 1, 3200, 1409145224),
('Haustyp', 47, 'anbieter/immobilie/objektkategorie', 'objektart/haus@haustyp', '', '', '', '', '', 45, 1, 3328, 1409145239),
('Kaufpreis', 39, 'anbieter/immobilie/preise', 'kaufpreis', '', '', '', '', '', 46, 1, 3456, 1409145254),
('Kaution', 18, 'anbieter/immobilie/preise', 'kaution', '', '', '', '', '', 47, 1, 3584, 1409145269),
('Lagebeschreibung', 28, 'anbieter/immobilie/freitexte', 'lage', '', '', '', '', '', 48, 1, 3712, 1409145286),
('Miete inkl. NK', 10, 'anbieter/immobilie/preise', 'warmmiete', '', '', '', '', '', 49, 1, 3840, 1409145312),
('Miete zzgl. NK', 9, 'anbieter/immobilie/preise', 'nettokaltmiete', '', '', '', '', '', 50, 1, 3968, 1409145329),
('Mieteinnahmen Faktor', 58, 'anbieter/immobilie/preise', 'x_fache', '', '', '', '', '', 51, 1, 4096, 1409145345),
('Mieteinnahmen IST', 56, 'anbieter/immobilie/preise', 'mieteinnahmen_ist', '', '', '', '', '', 52, 1, 4224, 1409145359),
('Mieteinnahmen SOLL', 57, 'anbieter/immobilie/preise', 'mieteinnahmen_soll', '', '', '', '', '', 53, 1, 4352, 1409145374),
('Nebenkosten', 17, 'anbieter/immobilie/preise', 'nebenkosten', '', '', '', '', '', 54, 1, 4480, 1409145391),
('Nutzfläche', 7, 'anbieter/immobilie/flaechen', 'nutzflaeche', '', '', '', '', '', 55, 1, 4608, 1409145409),
('Objekt-ID', 2, 'anbieter/immobilie/verwaltung_techn', 'objektnr_extern', '', '', '', '', '', 56, 1, 4736, 1409145428),
('Objektbeschreibung', 27, 'anbieter/immobilie/freitexte', 'objektbeschreibung', '', '', '', '', '', 57, 1, 4864, 1409145445),
('Ort', 13, 'anbieter/immobilie/geo', 'ort', '', '', '', '', '', 58, 1, 4992, 1409145460),
('Personenaufzug', 62, 'anbieter/immobilie/ausstattung', 'fahrstuhl@PERSONEN', '', '', '', '', '', 59, 1, 5120, 1409145490),
('Postleitzahl', 12, 'anbieter/immobilie/geo', 'plz', '', '', '', '', '', 60, 1, 5248, 1409145507),
('Provision', 59, 'anbieter/immobilie/preise', 'aussen_courtage', '', '', '', '', '', 61, 1, 5376, 1409145622),
('Seniorengerecht', 63, 'anbieter/immobilie/ausstattung', 'seniorengerecht', '', '', '', '', '', 62, 1, 5504, 1409145681),
('Sonstiges', 29, 'anbieter/immobilie/freitexte', 'sonstige_angaben', '', '', '', '', '', 63, 1, 5632, 1409145697),
('Stadtteil', 14, 'anbieter/immobilie/geo', 'regionaler_zusatz', '', '', '', '', '', 64, 1, 5760, 1409145736),
('Straße', 11, 'anbieter/immobilie/geo', 'strasse', '', '', '', '', '', 65, 1, 5888, 1411476649),
('Verfügbar ab', 16, 'anbieter/immobilie/verwaltung_objekt', 'verfuegbar_ab', '', '', '', '', '', 66, 1, 6016, 1409145785),
('Verkaufstyp', 54, 'anbieter/immobilie/objektkategorie', 'objektart/zinshaus_renditeobjekt@zins_typ', '', '', '', '', '', 67, 1, 6144, 1409145834),
('Verwalter E-Mail', 37, 'anbieter/immobilie/kontaktperson', 'email_direkt', '', '', '', '', '', 68, 1, 6272, 1409145870),
('Verwalter Mobil', 36, 'anbieter/immobilie/kontaktperson', 'tel_handy', '', '', '', '', '', 69, 1, 6400, 1409145895),
('Verwalter Name', 33, 'anbieter/immobilie/kontaktperson', 'name', '', '', '', '', '', 70, 1, 6528, 1409145929),
('Verwalter Telefax', 40, 'anbieter/immobilie/kontaktperson', 'tel_fax', '', '', '', '', '', 71, 1, 6656, 1409145947),
('Verwalter Telefon', 35, 'anbieter/immobilie/kontaktperson', 'tel_zentrale', '', '', '', '', '', 72, 1, 6784, 1409145965),
('Verwalter Vorname', 34, 'anbieter/immobilie/kontaktperson', 'vorname', '', '', '', '', '', 73, 1, 6464, 1411476567),
('Wohnfläche', 6, 'anbieter/immobilie/flaechen', 'wohnflaeche', '', '', '', '', '', 74, 1, 7040, 1409145994),
('Wohnung', 41, 'anbieter/immobilie/objektkategorie', 'nutzungsart@WOHNEN', '', '', '', '', '', 75, 1, 7168, 1409146015),
('Wohnungstyp', 46, 'anbieter/immobilie/objektkategorie', 'objektart/wohnung@wohnungtyp', '', '', '', '', '', 76, 1, 7296, 1409146035),
('Zimmer', 5, 'anbieter/immobilie/flaechen', 'anzahl_zimmer', '', '', '', '', '', 77, 1, 7424, 1409146052),
('Zimmertyp', 48, 'anbieter/immobilie/objektkategorie', 'objektart/zimmer@zimmertyp', '', '', '', '', '', 78, 1, 7552, 1409146073),
('Zum Kauf', 44, 'anbieter/immobilie/objektkategorie', 'vermarktungsart@KAUF', '', '', '', '', '', 79, 1, 7680, 1409146097),
('Zur Miete', 45, 'anbieter/immobilie/objektkategorie', 'vermarktungsart@MIETE_PACHT', '', '', '', '', '', 80, 1, 7808, 1409146111),
('Titelbild', 64, 'anbieter/immobilie/anhaenge', 'anhang/daten/pfad', '', '', '', 'anbieter/immobilie/anhaenge/anhang@gruppe', 'TITELBILD', 81, 1, 1472, 1411386910),
('Alias', 3, 'anbieter/immobilie/verwaltung_techn', 'objektnr_extern', '', '', '', '', '', 82, 1, 64, 1411412930),
('Kurzbeschreibung', 65, 'anbieter/immobilie/freitexte', 'dreizeiler', '', '', '', '', '', 83, 1, 3648, 1411415082),
('Zustand', 66, '', '', 'Blumenauer,oiFieldCallback', 'anbieter/immobilie/user_defined_anyfield/zustand_klartext', '', '', '', 84, 1, 7936, 1416498255),
('Keller', 67, 'anbieter/immobilie/ausstattung', 'unterkellert@keller', '', '', '', '', '', 85, 1, 3616, 1411461040),
('Objektart', 68, '', '', 'Blumenauer,oiFieldCallback', 'anbieter/immobilie/user_defined_anyfield/objektart_klartext', '', '', '', 86, 1, 4800, 1416497817),
('Gäste WC', 69, 'anbieter/immobilie/ausstattung', 'gaestewc', '', '', '', '', '', 87, 1, 2496, 1411464358),
('Verwalter E-Mail Zentrale', 70, 'anbieter/immobilie/kontaktperson', 'email_zentrale', '', '', '', '', '', 88, 1, 6976, 1411476467),
('Verwalter Firma', 71, 'anbieter/immobilie/kontaktperson', 'firma', '', '', '', '', '', 89, 1, 7008, 1411476500),
('Verwalter Strasse', 72, 'anbieter/immobilie/kontaktperson', 'strasse', '', '', '', '', '', 90, 1, 7024, 1411476528),
('Verwalter Hausnummer', 73, 'anbieter/immobilie/kontaktperson', 'hausnummer', '', '', '', '', '', 91, 1, 7032, 1411476593),
('Verwalter PLZ', 74, 'anbieter/immobilie/kontaktperson', 'plz', '', '', '', '', '', 92, 1, 7036, 1411476620),
('Verwalter Ort', 75, 'anbieter/immobilie/kontaktperson', 'ort', '', '', '', '', '', 93, 1, 7038, 1411476679),
('Hausnummer', 76, 'anbieter/immobilie/geo', 'hausnummer', '', '', '', '', '', 94, 1, 5952, 1411476750),
('Qualität der Austattung', 77, '', '', 'Blumenauer,oiFieldCallback', 'anbieter/immobilie/verwaltung_techn/user_defined_anyfield/qualitaet_der_ausstattung', '', '', '', 95, 1, 5984, 1413193109),
('Gewerbefläche', 78, 'anbieter/immobilie/flaechen', 'gastroflaeche', 'Blumenauer,oiFieldCallback', '', '', '', '', 96, 1, 2752, 1413884362),
('Etagenanzahl', 79, 'anbieter/immobilie/geo', 'anzahl_etagen', '', '', '', '', '', 97, 1, 2240, 1413884733),
('Letzte Modernisierung', 80, 'anbieter/immobilie/zustand_angaben', 'letzemodernisierung', '', '', '', '', '', 98, 1, 3776, 1413885314),
('Denkmalgeschützt', 81, 'anbieter/immobilie/verwaltung_objekt', 'denkmalgeschuetzt', '', '', '', '', '', 99, 1, 1856, 1413885422),
('Barrierefrei', 82, 'anbieter/immobilie/ausstattung', 'barrierefrei', '', '', '', '', '', 100, 1, 1344, 1413885614),
('Energieausweistyp', 83, 'anbieter/immobilie/zustand_angaben', 'energiepass/epart', '', '', '', '', '', 101, 1, 2272, 1413886280),
('Energiekennwert', 84, 'anbieter/immobilie/zustand_angaben', 'energiepass/energieverbrauchkennwert', '', '', '', '', '', 102, 1, 2288, 1413886408);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tl_metamodel_attribute`
--

DROP TABLE IF EXISTS `tl_metamodel_attribute`;
CREATE TABLE IF NOT EXISTS `tl_metamodel_attribute` (
  `tstamp` int(10) unsigned NOT NULL DEFAULT '0',
  `sorting` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(64) NOT NULL DEFAULT '',
  `name` text,
  `description` text,
  `colname` varchar(64) NOT NULL DEFAULT '',
  `isvariant` char(1) NOT NULL DEFAULT '',
  `isunique` char(1) NOT NULL DEFAULT '',
  `alias_fields` blob,
  `force_alias` char(1) NOT NULL DEFAULT '',
  `check_publish` char(1) NOT NULL DEFAULT '',
  `combinedvalues_fields` blob,
  `force_combinedvalues` char(1) NOT NULL DEFAULT '',
  `combinedvalues_format` text,
  `countries` text,
  `file_filePicker` char(1) NOT NULL DEFAULT '',
  `file_customFiletree` char(1) NOT NULL DEFAULT '',
  `file_multiple` char(1) NOT NULL DEFAULT '',
  `file_uploadFolder` blob,
  `file_validFileTypes` varchar(255) NOT NULL DEFAULT '',
  `file_filesOnly` char(1) NOT NULL DEFAULT '',
  `langcodes` text,
  `rating_max` int(10) NOT NULL DEFAULT '0',
  `rating_half` char(1) NOT NULL DEFAULT '',
  `rating_emtpy` blob,
  `rating_full` blob,
  `rating_hover` blob,
  `select_table` varchar(255) NOT NULL DEFAULT '',
  `select_column` varchar(255) NOT NULL DEFAULT '',
  `select_id` varchar(255) NOT NULL DEFAULT '',
  `select_alias` varchar(255) NOT NULL DEFAULT '',
  `select_sorting` varchar(255) NOT NULL DEFAULT '',
  `select_where` text,
  `tabletext_cols` blob,
  `tag_table` varchar(255) NOT NULL DEFAULT '',
  `tag_column` varchar(255) NOT NULL DEFAULT '',
  `tag_id` varchar(255) NOT NULL DEFAULT '',
  `tag_alias` varchar(255) NOT NULL DEFAULT '',
  `tag_sorting` varchar(255) NOT NULL DEFAULT '',
  `tag_where` text,
  `timetype` varchar(64) NOT NULL DEFAULT '',
  `talias_fields` blob,
  `force_talias` char(1) NOT NULL DEFAULT '',
  `select_langcolumn` varchar(255) NOT NULL DEFAULT '',
  `select_srctable` varchar(255) NOT NULL DEFAULT '',
  `select_srcsorting` varchar(255) NOT NULL DEFAULT '',
  `tabletext_quantity_cols` varchar(2) NOT NULL DEFAULT '',
  `translatedtabletext_cols` blob,
  `tag_langcolumn` varchar(255) NOT NULL DEFAULT '',
  `tag_srctable` varchar(255) NOT NULL DEFAULT '',
  `tag_srcsorting` varchar(255) NOT NULL DEFAULT '',
  `trim_title` char(1) NOT NULL DEFAULT '',
`id` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `check_listview` char(1) NOT NULL DEFAULT '',
  `check_listviewicon` blob,
  `check_listviewicondisabled` blob,
  `select_filter` int(11) unsigned NOT NULL DEFAULT '0',
  `select_filterparams` text,
  `tag_filter` int(11) unsigned NOT NULL DEFAULT '0',
  `tag_filterparams` text
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tl_metamodel_attribute`
--

INSERT INTO `tl_metamodel_attribute` (`tstamp`, `sorting`, `type`, `name`, `description`, `colname`, `isvariant`, `isunique`, `alias_fields`, `force_alias`, `check_publish`, `combinedvalues_fields`, `force_combinedvalues`, `combinedvalues_format`, `countries`, `file_filePicker`, `file_customFiletree`, `file_multiple`, `file_uploadFolder`, `file_validFileTypes`, `file_filesOnly`, `langcodes`, `rating_max`, `rating_half`, `rating_emtpy`, `rating_full`, `rating_hover`, `select_table`, `select_column`, `select_id`, `select_alias`, `select_sorting`, `select_where`, `tabletext_cols`, `tag_table`, `tag_column`, `tag_id`, `tag_alias`, `tag_sorting`, `tag_where`, `timetype`, `talias_fields`, `force_talias`, `select_langcolumn`, `select_srctable`, `select_srcsorting`, `tabletext_quantity_cols`, `translatedtabletext_cols`, `tag_langcolumn`, `tag_srctable`, `tag_srcsorting`, `trim_title`, `id`, `pid`, `check_listview`, `check_listviewicon`, `check_listviewicondisabled`, `select_filter`, `select_filterparams`, `tag_filter`, `tag_filterparams`) VALUES
(1409131702, 128, 'text', 'Exposé-Überschrift', '', 'title', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 1, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1412108958, 256, 'text', 'Objekt-ID', '', 'object_id', '', '1', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 2, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1409138430, 384, 'alias', 'Alias', '', 'alias', '', '1', 0x613a313a7b693a303b613a313a7b733a31353a226669656c645f617474726962757465223b733a393a226f626a6563745f6964223b7d7d, '1', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 3, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 768, 'decimal', 'Baujahr', '', 'baujahr', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 4, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 896, 'numeric', 'Zimmer', '', 'zimmer', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 5, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 1024, 'decimal', 'Wohnfläche', '', 'wohnflaeche', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 6, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 1152, 'decimal', 'Nutzfläche', '', 'nutzflaeche', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 7, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 1280, 'decimal', 'Gesamtfläche', '', 'gesamtflaeche', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 8, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 1792, 'decimal', 'Miete zzgl. NK', '', 'miete_zzgl_nk', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 9, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 1920, 'decimal', 'Miete inkl. NK', '', 'miete_inkl_nk', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 10, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 2944, 'text', 'Straße', '', 'strasse', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 11, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 3200, 'text', 'Postleitzahl', '', 'plz', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 12, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 3328, 'text', 'Ort', '', 'ort', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 13, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 3456, 'text', 'Stadtteil', '', 'stadtteil', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 14, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 3584, 'longtext', 'Courtagetext', '', 'courtage_text', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 15, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 3712, 'text', 'Verfügbar ab', '', 'verfuegbar_ab', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 16, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 2048, 'decimal', 'Nebenkosten', '', 'nebenkosten', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 17, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 2176, 'decimal', 'Kaution', '', 'kaution', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 18, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 3840, 'numeric', 'Anzahl Schlafzimmer', '', 'schlafzimmer', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 19, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 3968, 'numeric', 'Anzahl Badezimmer', '', 'badezimmer', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 20, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 4096, 'text', 'Etage', '', 'etage', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 21, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 4352, 'checkbox', 'Balkon', '', 'balkon', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 22, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 4480, 'checkbox', 'Bad', '', 'bad', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 23, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 4608, 'checkbox', 'Badewanne', '', 'badewanne', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 24, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 4736, 'checkbox', 'Dusche', '', 'dusche', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 25, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 4864, 'checkbox', 'Badfenster', '', 'bad_fenster', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 26, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 5888, 'longtext', 'Objektbeschreibung', '', 'beschreibung', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 27, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 6144, 'longtext', 'Lagebeschreibung', '', 'lagebeschreibung', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 28, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 6272, 'longtext', 'Sonstiges', '', 'sonstiges', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 29, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 6400, 'longtext', 'Ausstattung', '', 'ausstattung', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 30, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1422456198, 6656, 'file', 'Bilder', '', 'bilder', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '1', '1', 0xb516aaee427f11e49f4e00266c4ef190, 'jpg,JPG', '1', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 31, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1422456177, 6784, 'file', 'Grundrisse', '', 'grundrisse', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '1', '1', 0xb516aaee427f11e49f4e00266c4ef190, 'jpg,JPG', '1', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 32, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 6912, 'text', 'Verwalter Name', '', 'verwalter_name', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 33, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 7040, 'text', 'Verwalter Vorname', '', 'verwalter_vorname', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 34, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 7168, 'text', 'Verwalter Telefon', '', 'verwalter_tel', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 35, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 7424, 'text', 'Verwalter Mobil', '', 'verwalter_mobil', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 36, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 7552, 'text', 'Verwalter E-Mail', '', 'verwalter_email', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 37, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 11392, 'checkbox', 'Veröffentlicht', '', 'active', '', '', NULL, '', '1', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 38, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 2432, 'decimal', 'Kaufpreis', '', 'kaufpreis', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 39, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 7296, 'text', 'Verwalter Telefax', '', 'verwalter_fax', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 40, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 8448, 'checkbox', 'Wohnung', 'Ist diese Immobilie eine Wohnung', 'wohnung', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 41, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 8576, 'checkbox', 'Gewerbe', 'Ist diese Immobilie gewerblich nutzbar?', 'gewerbe', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 42, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 8704, 'checkbox', 'Anlage', 'Ist diese Immobilie eine Anlage?', 'anlage', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 43, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 8960, 'checkbox', 'Zum Kauf', 'Ist diese Immobilie käuflich?', 'kauf', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 44, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 9088, 'checkbox', 'Zur Miete', 'Kann diese Immobilie gemietet werden?', 'miete_pacht', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 45, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 9344, 'text', 'Wohnungstyp', '', 'wohnungstyp', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 46, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 9472, 'text', 'Haustyp', '', 'haustyp', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 47, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 9600, 'text', 'Zimmertyp', '', 'zimmertyp', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 48, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 9728, 'text', 'Bürotyp', '', 'buerotyp', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 49, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 9856, 'text', 'Hallentyp', '', 'hallentyp', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 50, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 9984, 'text', 'Einzelhandeltyp', '', 'einzelhandeltyp', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 51, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 10112, 'text', 'Gastrotyp', '', 'gastrotyp', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 52, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 10240, 'text', 'Grundstücktyp', '', 'grundstuecktyp', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 53, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 10368, 'text', 'Verkaufstyp', '', 'verkaufstyp', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 54, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 10496, 'text', 'Alter', 'Ob Alt- oder Neubau', 'objekt_alter', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 55, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 2560, 'decimal', 'Mieteinnahmen IST', '', 'mieteinnahmen_ist', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 56, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 2688, 'decimal', 'Mieteinnahmen SOLL', '', 'mieteinnahmen_soll', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 57, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 2816, 'decimal', 'Mieteinnahmen Faktor', '', 'mieteinnahmen_faktor', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 58, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1418892231, 2304, 'text', 'Provision', '', 'provision', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 59, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 1408, 'decimal', 'Grundstücksfläche', '', 'grundstuecksflaeche', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 60, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 4992, 'checkbox', 'Einbauküche', '', 'einbaukueche', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 61, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 5120, 'checkbox', 'Personenaufzug', '', 'aufzug', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 62, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 5248, 'checkbox', 'Seniorengerecht', '', 'senioren', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 63, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1422456140, 6528, 'file', 'Titelbild', '', 'titelbild', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '1', '', 0xb516aaee427f11e49f4e00266c4ef190, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 64, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 6016, 'longtext', 'Kurzbeschreibung', '', 'kurzbeschreibung', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 65, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 10624, 'text', 'Zustand', '', 'zustand', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 66, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 5376, 'checkbox', 'Keller', '', 'keller', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 67, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 10752, 'text', 'Objektart', '', 'objektart', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 68, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 5504, 'checkbox', 'Gäste WC', '', 'gaeste_wc', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 69, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 7680, 'text', 'Verwalter E-Mail Zentrale', '', 'verwalter_email_zentrale', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 70, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 7808, 'text', 'Verwalter Firma', '', 'verwalter_firma', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 71, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 7936, 'text', 'Verwalter Strasse', '', 'verwalter_strasse', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 72, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 8064, 'text', 'Verwalter Hausnummer', '', 'verwalter_hausnummer', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 73, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 8192, 'text', 'Verwalter PLZ', '', 'verwalter_plz', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 74, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 8320, 'text', 'Verwalter Ort', '', 'verwalter_ort', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 75, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 3072, 'text', 'Hausnummer', '', 'hausnummer', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 76, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 10880, 'text', 'Qualität der Austattung', '', 'qualitaet_der_austattung', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 77, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 1536, 'decimal', 'Gewerbefläche', '', 'gewerbeflaeche', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 78, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 4224, 'numeric', 'Etagenanzahl', '', 'anzahl_etagen', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 79, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 11008, 'text', 'Letzte Modernisierung', '', 'letzte_modernisierung', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 80, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 5632, 'checkbox', 'Denkmalgeschützt', '', 'denkmalgeschuetzt', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 81, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 5760, 'checkbox', 'Barrierefrei', '', 'barrierefrei', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 82, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 11136, 'text', 'Energieausweistyp', '', 'energiepass_art', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 83, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 11264, 'text', 'Energiekennwert', '', 'energiepass_kennwert', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 84, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1413895464, 512, 'checkbox', 'Top Angebot', '', 'top_angebot', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 85, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 1664, 'decimal', 'Fläche', 'Fläche, die für die Suche verwendet wird.', 'flaeche', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 86, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 9216, 'text', 'Vermarktungsart', 'Verkauf oder Vermietung', 'vermarktungsart', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 87, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416323583, 8832, 'text', 'Nutzungsart', '', 'nutzungsart', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, 'tl_blumenauer_variables', 'value', 'id', 'name', 'sorting', 'name=''immo_nutzungsart''', NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 88, 1, '', NULL, NULL, 0, NULL, 0, NULL),
(1416325206, 640, 'checkbox', 'Investment', 'Ist dieses Objekt ein Investmentangebot', 'investment', '', '', NULL, '', '', NULL, '', NULL, NULL, '', '', '', NULL, '', '', NULL, 0, '', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', '', NULL, '', NULL, '', '', '', '', '1', NULL, '', '', '', '', 89, 1, '', NULL, NULL, 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tl_metamodel_dca`
--

DROP TABLE IF EXISTS `tl_metamodel_dca`;
CREATE TABLE IF NOT EXISTS `tl_metamodel_dca` (
  `name` varchar(255) NOT NULL DEFAULT '',
  `isdefault` char(1) NOT NULL DEFAULT '',
  `rendertype` varchar(10) NOT NULL DEFAULT '',
  `ptable` varchar(64) NOT NULL DEFAULT '',
  `backendsection` varchar(255) NOT NULL DEFAULT '',
  `backendicon` blob,
  `backendcaption` text,
  `panelLayout` blob,
`id` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `sorting` int(10) unsigned NOT NULL DEFAULT '0',
  `tstamp` int(10) unsigned NOT NULL DEFAULT '0',
  `iseditable` char(1) NOT NULL DEFAULT '',
  `iscreatable` char(1) NOT NULL DEFAULT '',
  `isdeleteable` char(1) NOT NULL DEFAULT '',
  `rendermode` varchar(12) NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tl_metamodel_dca`
--

INSERT INTO `tl_metamodel_dca` (`name`, `isdefault`, `rendertype`, `ptable`, `backendsection`, `backendicon`, `backendcaption`, `panelLayout`, `id`, `pid`, `sorting`, `tstamp`, `iseditable`, `iscreatable`, `isdeleteable`, `rendermode`) VALUES
('Redaktion', '1', 'standalone', '', 'content', '', 'a:1:{i:0;a:3:{s:8:"langcode";s:2:"de";s:5:"label";s:10:"Immobilien";s:11:"description";s:20:"Immobilien verwalten";}}', 0x7365617263682c736f72742c66696c7465722c6c696d6974, 1, 1, 128, 1418823214, '1', '1', '1', 'flat');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tl_metamodel_dcasetting`
--

DROP TABLE IF EXISTS `tl_metamodel_dcasetting`;
CREATE TABLE IF NOT EXISTS `tl_metamodel_dcasetting` (
  `sorting` int(10) unsigned NOT NULL DEFAULT '0',
  `dcatype` varchar(10) NOT NULL DEFAULT '',
  `attr_id` int(10) unsigned NOT NULL DEFAULT '0',
  `tl_class` varchar(64) NOT NULL DEFAULT '',
  `legendhide` varchar(5) NOT NULL DEFAULT '',
  `legendtitle` varchar(255) NOT NULL DEFAULT '',
  `mandatory` char(1) NOT NULL DEFAULT '',
  `alwaysSave` char(1) NOT NULL DEFAULT '',
  `filterable` char(1) NOT NULL DEFAULT '',
  `sortable` char(1) NOT NULL DEFAULT '',
  `searchable` char(1) NOT NULL DEFAULT '',
  `flag` int(4) unsigned NOT NULL DEFAULT '0',
  `chosen` char(1) NOT NULL DEFAULT '',
  `allowHtml` char(1) NOT NULL DEFAULT '',
  `preserveTags` char(1) NOT NULL DEFAULT '',
  `decodeEntities` char(1) NOT NULL DEFAULT '',
  `rte` varchar(64) NOT NULL DEFAULT '',
  `rows` int(10) NOT NULL DEFAULT '0',
  `cols` int(10) NOT NULL DEFAULT '0',
  `trailingSlash` char(1) NOT NULL DEFAULT '2',
  `spaceToUnderscore` char(1) NOT NULL DEFAULT '',
  `includeBlankOption` char(1) NOT NULL DEFAULT '',
  `submitOnChange` char(1) NOT NULL DEFAULT '',
  `readonly` char(1) NOT NULL DEFAULT '',
  `select_as_radio` varchar(1) NOT NULL DEFAULT '0',
  `tag_as_wizard` varchar(1) NOT NULL DEFAULT '0',
`id` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `tstamp` int(10) unsigned NOT NULL DEFAULT '0',
  `published` char(1) NOT NULL DEFAULT '',
  `rgxp` varchar(10) NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tl_metamodel_dcasetting`
--

INSERT INTO `tl_metamodel_dcasetting` (`sorting`, `dcatype`, `attr_id`, `tl_class`, `legendhide`, `legendtitle`, `mandatory`, `alwaysSave`, `filterable`, `sortable`, `searchable`, `flag`, `chosen`, `allowHtml`, `preserveTags`, `decodeEntities`, `rte`, `rows`, `cols`, `trailingSlash`, `spaceToUnderscore`, `includeBlankOption`, `submitOnChange`, `readonly`, `select_as_radio`, `tag_as_wizard`, `id`, `pid`, `tstamp`, `published`, `rgxp`) VALUES
(896, 'legend', 0, '', '', 'Grunddaten', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 1, 1, 1416323716, '1', ''),
(3840, 'legend', 0, '', '1', 'Verwaltung', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 2, 1, 1416323716, '1', ''),
(5504, 'legend', 0, '', '1', 'Adresse', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 3, 1, 1416323716, '1', ''),
(6272, 'legend', 0, '', '1', 'Verfügbarkeit & Besichtigung', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 4, 1, 1416323716, '1', ''),
(6784, 'attribute', 19, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 36, 1, 1416323716, '1', ''),
(6528, 'legend', 0, '', '1', 'Weitere Daten', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 6, 1, 1416323716, '1', ''),
(8576, 'legend', 0, '', '1', 'Texte', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 7, 1, 1416323716, '1', ''),
(12416, 'legend', 0, '', '1', 'Bilder/Dokumente', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 8, 1, 1416323716, '1', ''),
(256, 'legend', 0, '', '', 'Websitedaten', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 9, 1, 1409134352, '1', ''),
(384, 'attribute', 3, '', '', '', '1', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 10, 1, 1409134361, '1', ''),
(512, 'attribute', 38, '', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 11, 1, 1409134383, '1', ''),
(1024, 'attribute', 1, 'w50', '', '', '1', '', '', '', '1', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 12, 1, 1416323716, '1', ''),
(1152, 'attribute', 2, 'w50', '', '', '1', '', '', '1', '1', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 13, 1, 1418823155, '1', ''),
(1280, 'attribute', 4, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 14, 1, 1416323716, '1', ''),
(6656, 'attribute', 5, '', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 15, 1, 1416323716, '1', ''),
(1664, 'attribute', 6, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 16, 1, 1416323716, '1', ''),
(1792, 'attribute', 7, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 17, 1, 1416323716, '1', ''),
(1920, 'attribute', 8, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 18, 1, 1416323716, '1', ''),
(2432, 'legend', 0, '', '1', 'Preise', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 19, 1, 1416323716, '1', ''),
(2560, 'attribute', 17, '', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 20, 1, 1416323716, '1', ''),
(2688, 'attribute', 39, '', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 21, 1, 1416323716, '1', ''),
(2816, 'attribute', 9, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 22, 1, 1416323716, '1', ''),
(2944, 'attribute', 10, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 23, 1, 1416323716, '1', ''),
(3072, 'attribute', 18, '', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 24, 1, 1416323716, '1', ''),
(3712, 'attribute', 15, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 2, 0, '2', '', '', '', '', '0', '0', 25, 1, 1416323716, '1', ''),
(4096, 'attribute', 33, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 26, 1, 1416323716, '1', ''),
(4224, 'attribute', 34, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 27, 1, 1416323716, '1', ''),
(4352, 'attribute', 35, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 28, 1, 1416323716, '1', ''),
(4608, 'attribute', 36, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 29, 1, 1416323716, '1', ''),
(4736, 'attribute', 37, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 30, 1, 1416323716, '1', ''),
(5632, 'attribute', 11, '', '', '', '', '', '', '', '1', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 31, 1, 1416323716, '1', ''),
(5888, 'attribute', 12, 'w50', '', '', '', '', '', '', '1', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 32, 1, 1416323716, '1', ''),
(6016, 'attribute', 13, 'w50', '', '', '', '', '1', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 33, 1, 1416323716, '1', ''),
(6144, 'attribute', 14, '', '', '', '', '', '1', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 34, 1, 1416323716, '1', ''),
(6400, 'attribute', 16, '', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 35, 1, 1416323716, '1', ''),
(6912, 'attribute', 20, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 37, 1, 1416323716, '1', ''),
(7040, 'attribute', 21, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 38, 1, 1416323716, '1', ''),
(7168, 'attribute', 22, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 39, 1, 1416323716, '1', ''),
(7296, 'attribute', 23, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 40, 1, 1416323716, '1', ''),
(7424, 'attribute', 24, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 41, 1, 1416323716, '1', ''),
(7552, 'attribute', 25, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 42, 1, 1416323716, '1', ''),
(7680, 'attribute', 26, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 43, 1, 1416323716, '1', ''),
(8704, 'attribute', 27, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 5, 0, '2', '', '', '', '', '0', '0', 44, 1, 1416323716, '1', ''),
(8960, 'attribute', 28, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 5, 0, '2', '', '', '', '', '0', '0', 45, 1, 1416323716, '1', ''),
(9088, 'attribute', 29, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 5, 0, '2', '', '', '', '', '0', '0', 46, 1, 1416323716, '1', ''),
(9344, 'attribute', 30, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 5, 0, '2', '', '', '', '', '0', '0', 47, 1, 1416323716, '1', ''),
(12672, 'attribute', 31, '', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 48, 1, 1416323716, '1', ''),
(12800, 'attribute', 32, '', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 49, 1, 1416323716, '1', ''),
(1536, 'legend', 0, '', '1', 'Flächen', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 50, 1, 1416323716, '1', ''),
(2048, 'attribute', 60, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 51, 1, 1416323716, '1', ''),
(3200, 'attribute', 59, '', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 52, 1, 1416323716, '1', ''),
(3328, 'attribute', 56, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 53, 1, 1416323716, '1', ''),
(3456, 'attribute', 57, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 54, 1, 1416323716, '1', ''),
(3584, 'attribute', 58, '', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 55, 1, 1416323716, '1', ''),
(4480, 'attribute', 40, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 56, 1, 1416323716, '1', ''),
(7808, 'attribute', 61, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 57, 1, 1416323716, '1', ''),
(7936, 'attribute', 62, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 58, 1, 1416323716, '1', ''),
(8064, 'attribute', 63, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 59, 1, 1416323716, '1', ''),
(1408, 'attribute', 55, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 60, 1, 1416323716, '1', ''),
(9856, 'legend', 0, '', '1', 'Immobilientyp', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 61, 1, 1416323716, '1', ''),
(10112, 'attribute', 41, '', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 62, 1, 1416323716, '1', ''),
(10240, 'attribute', 42, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 63, 1, 1416323716, '1', ''),
(10368, 'attribute', 43, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 64, 1, 1416323716, '1', ''),
(10624, 'attribute', 44, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 65, 1, 1416323716, '1', ''),
(10752, 'attribute', 45, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 66, 1, 1416323716, '1', ''),
(11264, 'attribute', 46, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 67, 1, 1416323716, '1', ''),
(11392, 'attribute', 47, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 68, 1, 1416323716, '1', ''),
(11520, 'attribute', 48, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 69, 1, 1416323716, '1', ''),
(11648, 'attribute', 49, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 70, 1, 1416323716, '1', ''),
(11776, 'attribute', 50, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 71, 1, 1416323716, '1', ''),
(11904, 'attribute', 51, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 72, 1, 1416323716, '1', ''),
(12032, 'attribute', 52, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 73, 1, 1416323716, '1', ''),
(12160, 'attribute', 53, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 74, 1, 1416323716, '1', ''),
(12288, 'attribute', 54, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 75, 1, 1416323716, '1', ''),
(12544, 'attribute', 64, '', '', '', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 76, 1, 1416323716, '1', ''),
(8832, 'attribute', 65, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 3, 0, '2', '', '', '', '', '0', '0', 77, 1, 1416323716, '1', ''),
(9216, 'attribute', 66, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 78, 1, 1416323716, '1', ''),
(8320, 'attribute', 67, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 79, 1, 1416323716, '1', ''),
(9984, 'attribute', 68, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 80, 1, 1416323716, '1', ''),
(8448, 'attribute', 69, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 81, 1, 1416323716, '1', ''),
(4864, 'attribute', 70, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 82, 1, 1416323716, '1', ''),
(3968, 'attribute', 71, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 83, 1, 1416323716, '1', ''),
(4992, 'attribute', 72, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 84, 1, 1416323716, '1', ''),
(5120, 'attribute', 73, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 85, 1, 1416323716, '1', ''),
(5248, 'attribute', 74, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 86, 1, 1416323716, '1', ''),
(5376, 'attribute', 75, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 87, 1, 1416323716, '1', ''),
(5760, 'attribute', 76, '', '', '', '', '', '', '', '1', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 88, 1, 1416323716, '1', ''),
(9600, 'attribute', 77, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 89, 1, 1416323716, '1', ''),
(2176, 'attribute', 78, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 90, 1, 1416323716, '1', ''),
(8192, 'attribute', 79, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 91, 1, 1416323716, '1', ''),
(9728, 'attribute', 80, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 92, 1, 1416323716, '1', ''),
(11136, 'attribute', 81, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 93, 1, 1416323716, '1', ''),
(11008, 'attribute', 82, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 94, 1, 1416323716, '1', ''),
(13056, 'attribute', 83, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 95, 1, 1416323716, '1', ''),
(13184, 'attribute', 84, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 96, 1, 1416323716, '1', ''),
(640, 'attribute', 85, '', '', '', '', '', '1', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 97, 1, 1413896230, '1', ''),
(12928, 'legend', 0, '', '', 'Energieausweis', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 98, 1, 1416323716, '1', ''),
(9472, 'legend', 0, '', '', 'Qualität', '', '', '', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 99, 1, 1416323716, '1', ''),
(2304, 'attribute', 86, 'w50', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 100, 1, 1416323716, '1', ''),
(10880, 'attribute', 87, '', '', '', '', '', '1', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 101, 1, 1416323716, '1', ''),
(10496, 'attribute', 88, '', '', '', '', '', '1', '', '', 0, '', '', '', '', '', 0, 0, '2', '', '', '', '', '0', '0', 102, 1, 1416323716, '1', ''),
(768, 'attribute', 89, '', '', '', '', '', '1', '', '', 0, '', '', '', '', 'tinyMCE', 0, 0, '2', '', '', '', '', '0', '0', 103, 1, 1416323733, '1', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tl_metamodel_dcasetting_condition`
--

DROP TABLE IF EXISTS `tl_metamodel_dcasetting_condition`;
CREATE TABLE IF NOT EXISTS `tl_metamodel_dcasetting_condition` (
  `settingId` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL DEFAULT '',
  `enabled` char(1) NOT NULL DEFAULT '',
  `comment` varchar(255) NOT NULL DEFAULT '',
  `attr_id` int(10) unsigned NOT NULL DEFAULT '0',
  `value` blob,
`id` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `sorting` int(10) unsigned NOT NULL DEFAULT '0',
  `tstamp` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tl_metamodel_dca_combine`
--

DROP TABLE IF EXISTS `tl_metamodel_dca_combine`;
CREATE TABLE IF NOT EXISTS `tl_metamodel_dca_combine` (
`id` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `tstamp` int(10) unsigned NOT NULL DEFAULT '0',
  `sorting` int(10) unsigned NOT NULL DEFAULT '0',
  `fe_group` int(10) unsigned NOT NULL DEFAULT '0',
  `be_group` int(10) NOT NULL DEFAULT '0',
  `dca_id` int(10) unsigned NOT NULL DEFAULT '0',
  `view_id` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tl_metamodel_dca_combine`
--

INSERT INTO `tl_metamodel_dca_combine` (`id`, `pid`, `tstamp`, `sorting`, `fe_group`, `be_group`, `dca_id`, `view_id`) VALUES
(1, 1, 1409134143, 0, 0, -1, 1, 1),
(2, 1, 1409134143, 128, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tl_metamodel_dca_sortgroup`
--

DROP TABLE IF EXISTS `tl_metamodel_dca_sortgroup`;
CREATE TABLE IF NOT EXISTS `tl_metamodel_dca_sortgroup` (
`id` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `sorting` int(10) unsigned NOT NULL DEFAULT '0',
  `tstamp` int(10) unsigned NOT NULL DEFAULT '0',
  `name` text,
  `isdefault` char(1) NOT NULL DEFAULT '',
  `ismanualsort` char(1) NOT NULL DEFAULT '',
  `rendergrouptype` varchar(10) NOT NULL DEFAULT 'none',
  `rendergrouplen` int(10) unsigned NOT NULL DEFAULT '1',
  `rendergroupattr` int(10) unsigned NOT NULL DEFAULT '0',
  `rendersort` varchar(10) NOT NULL DEFAULT 'asc',
  `rendersortattr` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tl_metamodel_dca_sortgroup`
--

INSERT INTO `tl_metamodel_dca_sortgroup` (`id`, `pid`, `sorting`, `tstamp`, `name`, `isdefault`, `ismanualsort`, `rendergrouptype`, `rendergrouplen`, `rendergroupattr`, `rendersort`, `rendersortattr`) VALUES
(1, 1, 128, 1425895235, NULL, '1', '1', 'digit', 0, 0, 'asc', 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tl_metamodel`
--
ALTER TABLE `tl_metamodel`
 ADD PRIMARY KEY (`id`), ADD KEY `tableName` (`tableName`);

--
-- Indizes für die Tabelle `tl_metamodels_openimmo`
--
ALTER TABLE `tl_metamodels_openimmo`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `tl_metamodels_openimmo_fields`
--
ALTER TABLE `tl_metamodels_openimmo_fields`
 ADD PRIMARY KEY (`id`), ADD KEY `pid` (`pid`);

--
-- Indizes für die Tabelle `tl_metamodel_attribute`
--
ALTER TABLE `tl_metamodel_attribute`
 ADD PRIMARY KEY (`id`), ADD KEY `pid` (`pid`), ADD KEY `colname` (`colname`);

--
-- Indizes für die Tabelle `tl_metamodel_dca`
--
ALTER TABLE `tl_metamodel_dca`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `tl_metamodel_dcasetting`
--
ALTER TABLE `tl_metamodel_dcasetting`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `tl_metamodel_dcasetting_condition`
--
ALTER TABLE `tl_metamodel_dcasetting_condition`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `tl_metamodel_dca_combine`
--
ALTER TABLE `tl_metamodel_dca_combine`
 ADD PRIMARY KEY (`id`), ADD KEY `pid` (`pid`), ADD KEY `fe_group` (`fe_group`), ADD KEY `be_group` (`be_group`);

--
-- Indizes für die Tabelle `tl_metamodel_dca_sortgroup`
--
ALTER TABLE `tl_metamodel_dca_sortgroup`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tl_metamodel`
--
ALTER TABLE `tl_metamodel`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `tl_metamodels_openimmo`
--
ALTER TABLE `tl_metamodels_openimmo`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `tl_metamodels_openimmo_fields`
--
ALTER TABLE `tl_metamodels_openimmo_fields`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT für Tabelle `tl_metamodel_attribute`
--
ALTER TABLE `tl_metamodel_attribute`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT für Tabelle `tl_metamodel_dca`
--
ALTER TABLE `tl_metamodel_dca`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `tl_metamodel_dcasetting`
--
ALTER TABLE `tl_metamodel_dcasetting`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT für Tabelle `tl_metamodel_dcasetting_condition`
--
ALTER TABLE `tl_metamodel_dcasetting_condition`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `tl_metamodel_dca_combine`
--
ALTER TABLE `tl_metamodel_dca_combine`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `tl_metamodel_dca_sortgroup`
--
ALTER TABLE `tl_metamodel_dca_sortgroup`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
