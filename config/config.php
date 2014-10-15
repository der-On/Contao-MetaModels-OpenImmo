<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 *
 * PHP version 5
 * @copyright  Ondrej Brinkel 2014
 * @author     Ondrej Brinkel 
 * @package    MetaModelsOpenImmo
 * @license    MIT
 * @filesource
 */


/**
 * -------------------------------------------------------------------------
 * BACK END MODULES
 * -------------------------------------------------------------------------
 *
 * Back end modules are stored in a global array called "BE_MOD". Each module 
 * has certain properties like an icon, an optional callback function and one 
 * or more tables. Each module belongs to a particular group.
 * 
 *   $GLOBALS['BE_MOD'] = array
 *   (
 *       'group_1' => array
 *       (
 *           'module_1' => array
 *           (
 *               'tables'       => array('table_1', 'table_2'),
 *               'key'          => array('Class', 'method'),
 *               'callback'     => 'ClassName',
 *               'icon'         => 'path/to/icon.gif',
 *               'stylesheet'   => 'path/to/stylesheet.css',
 *               'javascript'   => 'path/to/javascript.js'
 *           )
 *       )
 *   );
 * 
 * Use function array_insert() to modify an existing modules array.
 */

$GLOBALS['BE_MOD']['content']['metamodels_openimmo'] = array(
	'tables' => array('tl_metamodels_openimmo','tl_metamodels_openimmo_fields'),
	'syncMetaModel' => array('MetaModelsOpenImmo\MetaModelsOpenImmo','sync'),
	'icon' => 'system/modules/metamodels_openimmo/assets/icon.gif'
);

$GLOBALS['TL_CSS'][] = 'system/modules/metamodels_openimmo/assets/metamodels_openimmo.css';

$GLOBALS['TL_CRON']['hourly'][] = array('MetaModelsOpenImmo\\MetaModelsOpenImmoCron', 'run');

?>