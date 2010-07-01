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
 * Table tl_catalog_openimmo_fields 
 */
$GLOBALS['TL_DCA']['tl_catalog_openimmo_fields'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'ptable'                      => 'tl_catalog_openimmo',
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('catField','oiField'),
			'flag'                    => 1
		),
		'label' => array
		(
			'fields'                  => array('catField'),
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
				'label'               => &$GLOBALS['TL_LANG']['tl_catalog_openimmo_fields']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_catalog_openimmo_fields']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_catalog_openimmo_fields']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_catalog_openimmo_fields']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(''),
		'default'                     => 'catField,oiField'
	),

	// Subpalettes
	'subpalettes' => array
	(
		''                            => ''
	),

	// Fields
	'fields' => array
	(
		'catField' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_catalog_openimmo_fields']['catField'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64),
			'options_callback'		  => array('tl_catalog_openimmo_fields','getCatFieldOptions')
		),
		'oiField' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_catalog_openimmo_fields']['oiField'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64),
			'options_callback'		  => array('tl_catalog_openimmo_fields','getOIFieldOptions')
		)
	)
);


class tl_catalog_openimmo_fields extends Backend
{
	public function getCatFieldOptions(&$table)
	{
		$pid = $this->Database->prepare("SELECT pid FROM tl_catalog_openimmo_fields WHERE id='".$table->id."'")->execute()->fetchRow();
		$pid = $pid[0];

		$catalog = $this->Database->prepare("SELECT catalog FROM tl_catalog_openimmo WHERE id='$pid'")->execute()->fetchRow();
		$catalog = $catalog[0];

		$catalogID = $this->Database->prepare("SELECT id FROM tl_catalog_types WHERE tableName='$catalog'")->execute()->fetchRow();
		$catalogID = $catalogID[0];

		$options = $this->Database->prepare("SELECT colName FROM tl_catalog_fields WHERE pid='$catalogID'")->execute()->fetchEach('colName');

		return $options;
	}

	public function getOIFieldOptions(&$table)
	{
		return array("1");
	}
}
?>