<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the MIT Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the MIT
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the MIT Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Ondrej Brinkel 2010
 * @author     Ondrej Brinkel
 * @package    MetaModelsOpenImmo
 * @license    MIT
 * @filesource
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['name'] = array('Name', 'Bezeichnung');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['oiVersion'] = array('OpenImmo-Version', 'Mit welcher Version des OpenImmo-Standards werden die Daten exportiert?');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['metamodel'] = array('MetaModel', 'MetaModel, welches mit OpenImmo-Daten verknüpft werden soll.');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['exportPath'] = array('OpenImmo Export-Verzeichnis', 'Verzeichnis in welchem sich die exportierten OpenImmo-Daten befinden.');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['filesPath'] = array('OpenImmo Anhangs-Verzeichnis', 'Verzeichnis in welches Anhänge(Bilder,PDFs etc.) der OpenImmo-Objekte beim Synchronisieren verschoben werden sollen.');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['uniqueIDField'] = array('OpenImmo-Feld für eindeutige ID.','Wählen Sie hier ein OpenImmo-Feld, dessen Wert für jede Immobilie eindeutig ist.');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['uniqueIDMetamodelAttribute'] = array('Attribut zum Speichern von eindeutiger ID.','Wählen Sie hier das Attribut aus, in welchem der Wert des obigen OpenImmo-Feldes für eine eindeutige ID gespeichert wird.');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['deleteFilesOlderThen'] = array('Dateien löschen, die älter sind als:', 'Dateien die älter sind als der angegebene Zeitraum, werden automatisch gelöscht.');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['deleteFilesOlderThen_none'] = 'keine Dateien löschen';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['deleteFilesOlderThen_week'] = 'eine Woche';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['deleteFilesOlderThen_two_weeks'] = 'zwei Wochen';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['deleteFilesOlderThen_month'] = 'einen Monat';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['deleteFilesOlderThen_three_months'] = 'drei Monate';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['deleteFilesOlderThen_half_year'] = 'ein halbes Jahr';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['deleteFilesOlderThen_year'] = 'ein Jahr';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['autoSync'] = array('Automatisch synchronisieren', 'Wählen Sie aus ob und wann die Daten automatisch synchronisiert werden sollen.');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['autoSync_never'] = 'niemals';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['autoSync_hourly'] = 'stündlich';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['autoSync_daily'] = 'täglich';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['autoSync_weekly'] = 'wöchentlich';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['autoSync_now'] = 'sofort';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['sortFilesBy'] = array('Dateien sortieren nach', 'Dateien werden hiernach sortiert und in dieser Reihenfolge synchronisiert.');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['sortFilesBy_time'] = 'Dateidatum (absteigend)';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['sortFilesBy_name_desc'] = 'Dateiname (absteigend)';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['sortFilesBy_name_asc'] = 'Dateiname (aufsteigend)';
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['language'] = array('Sprache', 'Sprache in welcher die Inhalte verfasst wurden.');

/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['fields'] = array('Feldverknüpfungen bearbeiten','Feldverknüpfungen für Eintrag mit ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['sync'] = array('Daten Synchronisieren','MetaModel des Eintrags mit der ID %s mit OpenImmo-Daten synchronisieren');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['syncConfirm'] = 'Wollen Sie das MetaModel mit den aktuellen OpenImmo-Daten synchronisieren? Diese Aktion kann nicht rückgangig gemacht werden.';
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
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['sync_file_select'] = "Wählen Sie die OpenImmo-Datei aus, mit welcher Sie den MetaModel synchronisieren möchten";
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['sync_file_auto'] = "Automatisch - aktuellste Datei";

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['new']    = array('Neue MetaModel-OpenImmo Verknüpfung','Neue MetaModel-OpenImmo Verknüpfung erstellen');
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
