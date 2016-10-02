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

use MetaModelsOpenImmo\MetaModelsOpenImmo;
use MetaModelsOpenImmo\OpenImmo;

/**
 * Table tl_metamodels_openimmo
 */
$GLOBALS['TL_DCA']['tl_metamodels_openimmo'] = array
(
	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'cTable'					  =>'tl_metamodels_openimmo_fields'
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('name'),
			'flag'                    => 1
		),
		'label' => array
		(
			'fields'                  => array('name'),
			'format'                  => '%s'
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			),
			'fields' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['fields'],
				'href'                => 'table=tl_metamodels_openimmo_fields',
				'icon'                => 'tablewizard.gif',
				//'button_callback'     => array('tl_metamodels_openimmo', 'fieldsButton')
			),
			'syncMetaModel' => array
			(
				'label'				  => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['sync'],
				//'href'				  => 'table=tl_metamodels_openimmo_sync',
				'href'				  => 'key=syncMetaModel',
				'icon'				  => 'reload.gif',
				//'attributes'		  => "onclick='if (!confirm(\'". $GLOBALS['TL_LANG']['tl_metamodels_openimmo']['syncConfirm']."\')) return false; Backend.getScrollOffset();'"
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(''),
		'default'                     => 'name,oiVersion,uniqueIDField,language;metamodel,uniqueIDMetamodelAttribute,exportPath,filesPath;sortFilesBy,deleteFilesOlderThen,autoSync'
	),

	// Subpalettes
	'subpalettes' => array
	(
		''                            => ''
	),

	// Fields
	'fields' => array
	(
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['name'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64)
		),
		'oiVersion' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['oiVersion'],
			'exclude'				  => true,
			'inputType'				  => 'select',
			'options'				  => OpenImmo::getSupportedVersions(),
			''
		),
		'uniqueIDField' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['uniqueIDField'],
			'exclude'				  => true,
			'inputType'				  => 'select',
			'eval'					  => array('mandatory'=>true),
			'options_callback'		  => array('tl_metamodels_openimmo','getUniqueIDFieldOptions')
		),
		'uniqueIDMetamodelAttribute' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['uniqueIDMetamodelAttribute'],
			'exclude'				  => true,
			'inputType'				  => 'select',
			'eval'					  => array('mandatory'=>true),
			'options_callback'		  => array('tl_metamodels_openimmo','getUniqueIDMetamodelAttributeOptions')
		),
		'language' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['language'],
			'exclude'					=> true,
			'inputType'				=> 'text',
			'eval'						=> array('mandatory'=>true),
		),
		'metamodel' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['metamodel'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_metamodel.name',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'submitOnChange' => true)
		),
		'exportPath' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['exportPath'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('mandatory'=>true, 'multiple'=>false, 'files'=>false,'filesOnly'=>false, 'fieldType'=>'radio')
		),
    'deleteFilesOlderThen' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['deleteFilesOlderThen'],
        'exclude'                 => true,
        'inputType'               => 'select',
        'eval'                    => array('mandatory'=>false),
        'options_callback'        => array('tl_metamodels_openimmo', 'getDeleteFilesOlderThenOptions')
    ),
		'filesPath' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['filesPath'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('mandatory'=>true, 'multiple'=>false, 'files'=>false,'filesOnly'=>false, 'fieldType'=>'radio')
		),
    'autoSync' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['autoSync'],
        'exclude'                 => true,
        'inputType'               => 'select',
        'eval'                    => array('mandatory'=>false),
        'options_callback'        => array('tl_metamodels_openimmo', 'getAutoSyncOptions')
    ),
		'sortFilesBy'	=> array
		(
				'label'                 => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['sortFilesBy'],
				'exclude'               => true,
				'inputType'             => 'select',
				'eval'                  => array('mandatroy' => true),
				'options_callback'      => array('tl_metamodels_openimmo', 'getSortFilesByOptions')
		),
	)
);

class tl_metamodels_openimmo extends \Backend
{
	private function getOIVersion($id)
	{
		$version = $this->Database->execute("SELECT oiVersion FROM tl_metamodels_openimmo WHERE id='$id'")->fetchEach('oiVersion');
		return $version[0];
	}

	public function getUniqueIDFieldOptions(&$dc)
	{
		$flattenFields = OpenImmo::getFlattenedFields($this->getOIVersion($dc->id));
		return array_keys($flattenFields);
	}

	public function getUniqueIDMetamodelAttributeOptions(&$dc)
	{
		$_options = $this->Database->execute("SELECT id, name FROM tl_metamodel_attribute WHERE pid='" . $dc->activeRecord->metamodel . "' ORDER BY name")->fetchAllAssoc();
		$options = array();
		foreach($_options as $option) {
			$options[$option['id']] = $option['name'];
		}
		return $options;
	}

    public function getDeleteFilesOlderThenOptions(&$dc)
    {
        return array(
            '0'   => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['deleteFilesOlderThen_none'],
            '7'   => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['deleteFilesOlderThen_week'],
            '14'  => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['deleteFilesOlderThen_two_weeks'],
            '30'  => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['deleteFilesOlderThen_month'],
            '90'  => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['deleteFilesOlderThen_three_months'],
            '183' => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['deleteFilesOlderThen_half_year'],
            '365' => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['deleteFilesOlderThen_year'],
        );
    }

    public function getAutoSyncOptions(&$dc)
    {
        return array(
            'never'  => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['autoSync_never'],
            'hourly' => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['autoSync_hourly'],
            'daily'  => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['autoSync_daily'],
            'weekly' => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['autoSync_weekly'],
            'now'    => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['autoSync_now'],
        );
    }

	public function getSortFilesByOptions(&$dc)
	{
			return array(
    			'time'      => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['sortFilesBy_time'],
    			'name_asc'  => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['sortFilesBy_name_asc'],
    			'name_desc' => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo']['sortFilesBy_name_desc'],
			);
	}
}
?>
