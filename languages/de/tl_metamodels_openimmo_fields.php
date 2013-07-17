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
 * @package    MetaModelsOpenImmo
 * @license    GNU 
 * @filesource
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['name'] = array('Bezeichnung','Bezeichnung der MetaModel-OpenImmo-Verknüpfung.');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['metamodelAttribute'] = array('MetaModel-Attribut', 'Attribut des MetaModels welches mit dem OpenImmo-Datenfeld verknüpft werden soll.');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['oiFieldGroup'] = array('OpenImmo-Datenfeldgruppe', 'OpenImmo Datenfeldgruppe, aus welcher ein OpenImmo-Datenfeld ausgewählt werden soll.');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['oiField'] = array('OpenImmo-Datenfeld', 'OpenImmo Datenfeld, welches mit dem MetaModelfeld verknüpft werden soll.');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['oiCustomField'] = array('Eigenes OpenImmo-Datenfeld', 'Geben Sie den XML-Pfad zu einem eigenen OpenImmo Datenfeld an, welches mit dem MetaModelfeld verknüpft werden soll. Setzen Sie ein "@" vor XML-Attribute. Bsp.: "anbieter/immobilie/user_defined_anyfield/mein_feld@mein_attribut"');


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['fields'] = '%s: %s/%s';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['new']    = array('Neue Feldverknüpfung', 'Neue Feldverknüpfung erstellen');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['edit']   = array('Feldverknüpfung bearbeiten', 'Feldverknüpfung mit ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['copy']   = array('Feldverknüpfung kopieren', 'Feldverknüpfung mit ID %s kopieren');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['delete'] = array('Feldverknüpfung löschen', 'Feldverknüpfung mit ID %s löschen');
$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['show']   = array('Feldverknüpfung anzeigen', 'Feldverknüpfung mit ID %s anzeigen');

?>