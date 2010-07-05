<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Ondrej Brinkel 2010 
 * @author     Ondrej Brinkel 
 * @package    CatalogOpenImmo 
 * @license    GNU 
 * @filesource
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_catalog_openimmo']['name'] = array('Name', 'Bezeichnung');
$GLOBALS['TL_LANG']['tl_catalog_openimmo']['oiVersion'] = array('OpenImmo-Version', 'Mit welcher Version des OpenImmo-Standards werden die Daten exportiert?');
$GLOBALS['TL_LANG']['tl_catalog_openimmo']['catalog'] = array('Katalog', 'Katalog, welcher mit OpenImmo-Daten verknüpft werden soll.');
$GLOBALS['TL_LANG']['tl_catalog_openimmo']['exportPath'] = array('OpenImmo Export-Verzeichnis', 'Verzeichnis in welchem sich die exportierten OpenImmo-Daten befinden.');

/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_catalog_openimmo']['fields'] = array('Feldverknüpfungen bearbeiten','Feldverknüpfungen für Eintrag mit ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_catalog_openimmo']['sync'] = array('Daten Synchronisieren','Katalog des Eintrags mit der ID %s mit OpenImmo-Daten synchronisieren');
$GLOBALS['TL_LANG']['tl_catalog_openimmo']['syncConfirm'] = 'Wollen Sie den Katalog mit den aktuellen OpenImmo-Daten synchronisieren? Diese Aktion kann nicht rückgangig gemacht werden.';
$GLOBALS['TL_LANG']['tl_catalog_openimmo']['syncSuccess'] = 'Die Synchronisierung wurde erfolgreich durchgeführt.';
$GLOBALS['TL_LANG']['tl_catalog_openimmo']['syncErrors'] = array(
	'Fehler: Die OpenImmo-Datei konnte nicht gefunden oder gelesen werden.',
	'Fehler: Die OpenImmo-Daten konnte nicht geladen werden.',
	'Fehler: Die Feldverknüpfungen konnten nicht geladen werden.',
	'Fehler: Die Daten konnten nicht synchronisiert werden.'
);

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_catalog_openimmo']['new']    = array('Neue Katalog-OpenImmo Verknüpfung','Neue Katalog-OpenImmo Verknüpfung erstellen');
$GLOBALS['TL_LANG']['tl_catalog_openimmo']['edit']   = array('Eintrag bearbeiten', 'Eintrag mit ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_catalog_openimmo']['copy']   = array('Eintrag kopieren', 'Eintrag mit ID %s kopieren');
$GLOBALS['TL_LANG']['tl_catalog_openimmo']['delete'] = array('Eintrag löschen', 'Eintrag mit ID %s löschen');
$GLOBALS['TL_LANG']['tl_catalog_openimmo']['show']   = array('Eintrag anzeigen', 'Eintrag mit ID %s anzeigen');

?>