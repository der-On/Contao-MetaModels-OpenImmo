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
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['name'] = array('Name', 'Bezeichnung');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['oiVersion'] = array('OpenImmo-Version', 'Mit welcher Version des OpenImmo-Standards werden die Daten exportiert?');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['catalog'] = array('Katalog', 'Katalog, welcher mit OpenImmo-Daten verknüpft werden soll.');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['exportPath'] = array('OpenImmo Export-Verzeichnis', 'Verzeichnis in welchem sich die exportierten OpenImmo-Daten befinden.');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['filesPath'] = array('OpenImmo Anhangs-Verzeichnis', 'Verzeichnis in welches Anhänge(Bilder,PDFs etc.) der OpenImmo-Objekte beim Synchronisieren verschoben werden sollen.');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['uniqueIDField'] = array('OpenImmo-Feld für eindeutige ID.','Wählen Sie hier ein nummerisches OpenImmo-Feld, dessen Wert für jede Immobilie eindeutig ist.');

/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['fields'] = array('Feldverknüpfungen bearbeiten','Feldverknüpfungen für Eintrag mit ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['sync'] = array('Daten Synchronisieren','Katalog des Eintrags mit der ID %s mit OpenImmo-Daten synchronisieren');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['syncConfirm'] = 'Wollen Sie den Katalog mit den aktuellen OpenImmo-Daten synchronisieren? Diese Aktion kann nicht rückgangig gemacht werden.';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['syncSuccess'] = 'Die Synchronisierung wurde erfolgreich durchgeführt.';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['syncErrors'] = array(
	'Fehler: Die OpenImmo-Datei konnte nicht gefunden oder gelesen werden.',
	'Fehler: Die OpenImmo-Daten konnte nicht geladen werden.',
	'Fehler: Die Feldverknüpfungen konnten nicht geladen werden.',
	'Fehler: Die Daten konnten nicht synchronisiert werden.',
	'Fehler: Die Anhänge konnten nicht verschoben werden.'
);
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['noSyncFile'] = "Bitte wählen Sie eine Datei zur Synchronisierung aus.";
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['syncFileUnpacked'] = "Das Archiv wurde erfolgreich entpackt. Bitte klicken Sie zum Abschließen erneut auf 'Daten Synchronisieren'";
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['no_sync_files_found'] = "Keine Dateien für Synchronisation gefunden.";
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['sync_file_select'] = "Wählen Sie die OpenImmo-Datei aus, mit welcher Sie den Katalog synchronisieren möchten";
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['sync_file_auto'] = "Automatisch - aktuellste Datei";

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['new']    = array('Neue Katalog-OpenImmo Verknüpfung','Neue Katalog-OpenImmo Verknüpfung erstellen');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['edit']   = array('Eintrag bearbeiten', 'Eintrag mit ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['copy']   = array('Eintrag kopieren', 'Eintrag mit ID %s kopieren');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['delete'] = array('Eintrag löschen', 'Eintrag mit ID %s löschen');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['show']   = array('Eintrag anzeigen', 'Eintrag mit ID %s anzeigen');

/**
 * Table
 */
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['syncSelect']  = 'Auswahl';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['syncFile']    = 'Exportdatei';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['syncTime']    = 'synchronisiert am';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['syncUser']    = 'synchronisiert von';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['fileTime']    = 'Dateidatum';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['fileSize']    = 'Dateigröße';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['syncStatus']  = 'Status';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['syncStates'] = array(
	0 => "nicht synchronisiert",
	1 => "synchronisiert",
	2 => "fehlerhaft synchronisiert"
);
?>