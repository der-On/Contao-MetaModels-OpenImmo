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
 * Table tl_metamodels_openimmo_fields
 */
$GLOBALS['TL_DCA']['tl_metamodels_openimmo_fields'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'ptable'                      => 'tl_metamodels_openimmo',
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('sorting'),
			'flag'                    => 1,
			'panelLayout'			  => 'filter,limit',
			'headerFields'			  => array('name','oiVersion','catalog','exportPath'),
			'child_record_callback'   => array('tl_metamodels_openimmo_fields', 'renderField')
		),
		'label' => array
		(
			'fields'                  => array('name','oiFieldGroup','oiField'),
			'format'                  => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['fields']
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
				'label'               => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(''),
		'default'                     => 'name,metamodelAttribute;oiFieldGroup,oiField,oiCustomField;oiDefaultValue;oiConditionField,oiConditionValue;'
	),

	// Subpalettes
	'subpalettes' => array
	(
		''                => ''
	),

	// Fields
	'fields' => array
	(
		'name' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['name'],
			'exclude'				  => true,
			'inputType'				  => 'text',
			'eval'					  => array('mandatory'=>true,'maxlength'=>64,'unique'=>true)
		),
		'metamodelAttribute' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['metamodelAttribute'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64),
			'options_callback'		  => array('tl_metamodels_openimmo_fields','getMetamodelAttributeOptions')
		),
		'oiFieldGroup' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['oiFieldGroup'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'eval'                    => array('mandatory'=>false, 'maxlength'=>64,'submitOnChange'=>true,'includeBlankOption'=>true),
			'options_callback'		  => array('tl_metamodels_openimmo_fields','getOIFieldGroupOptions')
		),
		'oiField' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['oiField'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'eval'                    => array('mandatory'=>false, 'maxlength'=>64),
			'options_callback'		  => array('tl_metamodels_openimmo_fields','getOIFieldOptions')
		),
		'oiCustomField' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['oiCustomField'],
			'exclude'				  => true,
			'inputType'				  => 'text',
			'eval'					  => array('mandatory'=>false, 'maxlength'=>1024)
		),
        'oiDefaultValue' =>  array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['oiDefaultField'],
            'exclude'				  => true,
            'inputType'				  => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>1024)
        ),
        'oiConditionField' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['oiConditionField'],
            'exclude'				  => true,
            'inputType'				  => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>1024)
        ),
        'oiConditionValue' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_metamodels_openimmo_fields']['oiConditionValue'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>1024),
        ),
	),
);


class tl_metamodels_openimmo_fields extends Backend
{
	private function getMetaModelTypeID($id)
	{
		$metamodelID = $this->Database->execute("SELECT mmo.metamodel AS metamodel FROM tl_metamodels_openimmo mmo ".
											"LEFT JOIN tl_metamodels_openimmo_fields mmof ON mmof.id='$id' ".
											"WHERE mmo.id=mmof.pid")->fetchEach('metamodel');
		return $metamodelID[0];
	}

	private function getOIVersion($id)
	{
		$version = $this->Database->execute("SELECT mmo.oiVersion AS oiVersion FROM tl_metamodels_openimmo mmo ".
											"LEFT JOIN tl_metamodels_openimmo_fields mmof ON mmof.id='$id' ".
											"WHERE mmo.id=mmof.pid")->fetchEach('oiVersion');
		return $version[0];
	}

	public function getMetaModelAttributeOptions(&$dc)
	{
		$_options = $this->Database->execute("SELECT id, name FROM tl_metamodel_attribute WHERE pid='".$this->getMetaModelTypeID($dc->id)."' ORDER BY name")->fetchAllAssoc();
		$options = array();
		foreach($_options as $option) {
			$options[$option['id']] = $option['name'];
		}
		return $options;
	}

	public function getOIFieldGroupOptions(&$dc)
	{
		return MetaModelsOpenImmo::getFieldGroups($this->getOIVersion($dc->id));
	}

	public function getOIFieldOptions(&$dc)
	{
		$group = $this->Database->execute("SELECT oiFieldGroup FROM tl_metamodels_openimmo_fields WHERE id='".$dc->id."'")->fetchEach('oiFieldGroup');
		$group = $group[0];

		$fields = MetaModelsOpenImmo::getFieldsByGroup($this->getOIVersion($dc->id),$group);

		$_fields = array();
		foreach($fields as &$field) {
			$_fields[] = $field["name"];
		}
		return $_fields;
	}

	/**
	 * Add the type of input field
	 * @param array
	 * @return string
	 */
	public function renderField($arrRow)
	{
		$titleField = $arrRow['name'] ? ' published' : '';
		if($arrRow['oiCustomField']!='') $field = $arrRow['oiCustomField']; else $field = $arrRow['oiFieldGroup'].'/'.$arrRow['oiField'];
		return '<div class="field_type block"><strong>' . $arrRow['name'] . '</strong> <em>['.$field.']</em></div>';

	}
}
?>