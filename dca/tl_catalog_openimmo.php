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
 * Table tl_catalog_openimmo 
 */
$GLOBALS['TL_DCA']['tl_catalog_openimmo'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'cTable'					  =>'tl_catalog_openimmo_fields'
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
				'label'               => &$GLOBALS['TL_LANG']['tl_catalog_openimmo']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_catalog_openimmo']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_catalog_openimmo']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_catalog_openimmo']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			),
			'fields' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_catalog_openimmo']['fields'],
				'href'                => 'table=tl_catalog_openimmo_fields',
				'icon'                => 'tablewizard.gif',
				//'button_callback'     => array('tl_catalog_openimmo', 'fieldsButton')
			),
			'sync' => array
			(
				'label'				  => &$GLOBALS['TL_LANG']['tl_catalog_openimmo']['sync'],
				'href'				  => 'act=sync_cat_oi',
				'icon'				  => 'reload.gif',
				'attributes'		  => 'onclick="if (!confirm(\''.$GLOBALS['TL_LANG']['tl_catalog_openimmo']['syncConfirm']. '\')) return false; Backend.getScrollOffset();"'
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(''),
		'default'                     => 'name,catalog,exportPath'
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
			'label'                   => &$GLOBALS['TL_LANG']['tl_catalog_openimmo']['name'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64)
		),
		'catalog' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_catalog_openimmo']['catalog'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options_callback'		  => array('tl_catalog_openimmo','getCatalogOptions'),
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64)
		),
		'exportPath' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_catalog_openimmo']['exportPath'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>1024,'files'=>false,'filesOnly'=>false,'fieldType'=>'radio')
		)
	)
);

class tl_catalog_openimmo extends Backend
{
	public function getCatalogOptions()
	{
		$options = $this->Database->prepare("SELECT tableName FROM tl_catalog_types")->execute()->fetchEach('tableName');
		return $options;
	}

	public function fieldsButton()
	{
		
	}
}
?>