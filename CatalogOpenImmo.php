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


/*
 * TODO:
 *	- allow partly updates recognizing also deleted entries (if possible)
 *	- allow mapping of multiple tags with same name to different catalog fields or array fields
 *	- add type check when mapping catalog field to openImmo field
 *	- add support for other openImmo versions
 */

/**
 * Class CatalogOpenImmo 
 *
 * @copyright  Ondrej Brinkel 2010 
 * @author     Ondrej Brinkel 
 * @package    Controller
 */
class CatalogOpenImmo extends BackendModule
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = '';

	/*
	 * Compatible with OpenImmo 1.2.1
	 */
	public static $fields = array(
		'anbieter' => array(
			'anbieternr:string',
			'firma:string',
			'openimmo_anid:string',
			'impressum:string',
			'impressum_strukt:string'
		),
		'anbieter/anhang' => array(
			'anhangtitel:{string}',
			'format:{string}',
			'daten/pfad:{string}'
		),
		'anbieter/immobilie/objektkategorie'	=> array(
			'nutzungsart@WOHNEN:bool',
			'nutzungsart@GEWERBE:bool',
			'nutzungsart@ANLAGE:bool',
			'nutzungsart@WAZ:bool',
			'vermarktungsart@KAUF:bool',
			'vermarktungsart@MIETE_PACHT:bool',
			'vermarktungsart@ERBPACHT:bool',
			'vermarktungsart@LEASING:bool',
			'objektart/zimmer@zimmertyp:string',
			'objektart/objektart_zusatz:string',
			'objektart/objektart_zusatz:string',
		),
		'anbieter/immobilie/geo' => array(
			'plz:string',
			'ort:string',
			'geokoordinaten@breitengrad:string',
			'geokoordinaten@laengengrad:string',
			'strasse:string',
			'hausnummer:string',
			'bundesland:string',
			'land@iso_land:string',
			'gemeindecode:string',
			'flur:string',
			'flurstueck:string',
			'gemarkung:string',
			'etage:int',
			'anzahl_etagen:int',
			'lage_im_bau@LINKS:bool',
			'lage_im_bau@RECHTS:bool',
			'lage_im_bau@VORNE:bool',
			'lage_im_bau@HINTEN:bool',
			'wohnungsnr:string',
			'lage_gebiet@gebiete:string',
			'regionaler_zusatz:string',
		),
		'anbieter/immobilie/kontaktperson' => array(
			'email_zentrale:string',
			'email_direkt:string',
			'tel_zentrale:string',
			'tel_durchw:string',
			'tel_fax:string',
			'tel_handly:string',
			'name:string',
			'vorname:string',
			'titel:string',
			'anrede:string',
			'anrede_brief:string',
			'firma:string',
			'zusatzfeld:string',
			'strasse:string',
			'hausnummer:string',
			'plz:string',
			'ort:string',
			'postfach:string',
			'postf_plz:string',
			'postf_ort:string',
			'land@iso_land:string',
			'email_privat:string',
			'email_sonstige:string',
			'email_sonstige@emailart:string',
			'email_sonstige@bemerkung:string',
			'tel_privat:string',
			'tel_sonstige:string',
			'tel_sonstige@telefonart:string',
			'tel_sonstige@bemerkung:string',
			'url:string',
			'adressfreigabe:bool',
			'personennummer:string',
			'freitextfeld:string',
		),
		'anbieter/immobilie/weitere_adresse' => array(
			'@adressart:string',
			'vorname:string',
			'name:string',
			'title:string',
			'anrede:string',
			'anrede_brief:string',
			'firma:string',
			'zusatzfeld:string',
			'strasse:string',
			'hausnummer:string',
			'plz:string',
			'ort:string',
			'postfach:string',
			'postf_plz:string',
			'postf_ort:string',
			'land@iso_land:string',
			'email_zentrale:string',
			'email_direkt:string',
			'email_privat:string',
			'email_sonstige:string',
			'email_sosntige@emailart:string',
			'email_sosntige@bemerkung:string',
			'tel_durchw:string',
			'tel_zentrale:string',
			'tel_handy:string',
			'tel_fax:string',
			'tel_privat:string',
			'tel_sonstige:string',
			'tel_sonstige@telefonart:string',
			'tel_sonstige@bemerkung:string',
			'url:string',
			'adressfreigabe:bool',
			'personennummer:string',
			'freitextfeld:string',
		),
		'anbieter/immobilie/preise' => array(
			'kaufpreis:string',
			'nettokaltmiete:string',
			'kaltmiete:string',
			'warmmiete:string',
			'nebenkosten:string',
			'heizkosten_enthalten:bool',
			'heizkosten:string',
			'zzg_mehrwertsteuer:bool',
			'mietzuschlaege:string',
			'pacht:string',
			'erbpacht:string',
			'hausgeld:string',
			'abstand:string',
			'preis_zeitraum_von:string',
			'preis_zeitraum_bis:string',
			'preis_zeiteinheit@zeiteinheit:string',
			'mietpreis_pro_qm:string',
			'kaufpreis_pro_qm:string',
			'innen_courtage@mit_mwst:bool',
			'aussen_courtage@mit_mwst:bool',
			'waehrung@iso_waehrung:string',
			'mwst_satz:string',
			'freitext_preis:string',
			'x_fache:string',
			'nettorendite:string',
			'mieteinnahmen_ist:string',
			'mieteinnahmen_ist@periode:string',
			'mieteinnahmen_soll:string',
			'mieteinnahmen_soll@periode:string',
			'erschliessungskosten:string',
			'kaution:string',
			'geschaefstguthaben:string',
			'stp_carport@stellplatzmiete:string',
			'stp_carport@stellplatkaufpreis:string',
			'stp_carport@anzahl:int',
			'stp_duplex@stellplatzmiete:string',
			'stp_duplex@stellplatkaufpreis:string',
			'stp_duplex@anzahl:int',
			'stp_freiplatz@stellplatzmiete:string',
			'stp_freiplatz@stellplatkaufpreis:string',
			'stp_freiplatz@anzahl:int',
			'stp_garage@stellplatzmiete:string',
			'stp_garage@stellplatkaufpreis:string',
			'stp_garage@anzahl:int',
			'stp_parkhaus@stellplatzmiete:string',
			'stp_parkhaus@stellplatkaufpreis:string',
			'stp_parkhaus@anzahl:int',
			'stp_tiefgarage@stellplatzmiete:string',
			'stp_tiefgarage@stellplatkaufpreis:string',
			'stp_tiefgarage@anzahl:int',
			'stp_sonstige@stellplatzmiete:string',
			'stp_sonstige@stellplatkaufpreis:string',
			'stp_sonstige@anzahl:int',
			'stp_sonstige@platzart:string',
			'stp_sonstige@bemerkung:string',
		),
		'anbieter/immobilie/bieterverfahren' => array(
			'beginn_angebotsphase:string',
			'besichtigungstermin:string',
			'besichtigungstermin_2:string',
			'beginn_bietzeit:string',
			'ende_bietzeit:string',
			'hoechstgebot_zeigen:bool',
			'mindestpreis:string'
		),
		'anbieter/immobilie/flaechen' => array(
			'wohnflaeche:string',
			'nutzflaeche:string',
			'gesamtflaech:string',
			'ladenflaeche:string',
			'lagerflaeche:string',
			'verkaufsflaeche:string',
			'freiflaeche:string',
			'bueroflaeche:string',
			'bueroteilflaeche:string',
			'fensterfront:string',
			'verwaltungsflaeche:string',
			'gastroflaeche:string',
			'grz:string',
			'gfz:string',
			'bmz:string',
			'bgf:string',
			'grundstuecksflaeche:string',
			'sonstflaeche:string',
			'anzahl_zimmer:int',
			'anzahl_schlafzimmer:int',
			'anzahl_badezimmer:int',
			'anzahl_sep_wc:int',
			'anzahl_balkon_terrassen:int',
			'balkon_terrasse_flaeche:string',
			'anzahl_wohn_schlafzimmer:int',
			'gartenflaeche:string',
			'kellerflaeche:string',
			'fensterfront_qm:int',
			'grundstuecksfront:string',
			'dachbodenflaeche:string',
			'teilbar_ab:string',
			'beheizbare_flaeche:string',
			'anzahl_stellplaetze:int',
			'plaetze_gastraum:int',
			'anzahl_betten:int',
			'anzahl_tagungsraeume:int',
			'vermietbare_flaeche:string',
			'anzahl_wohneinheiten:string',
			'anzahl_gewerbeeinheiten:int',
			'einliegerwohnung:string'
		),
		'anbieter/immobilie/ausstattung' => array(
			'wg_geeignet:bool',
			'raeume_veraenderbar:bool',
			'bad@DUSCHE:bool',
			'bad@WANNE:bool',
			'bad@FENSTER:bool',
			'kueche@EBK:bool',
			'kueche@OFFEN:bool',
			'boden@FLIESEN:bool',
			'boden@STEIN:bool',
			'boden@TEPPICH:bool',
			'boden@PARKETT:bool',
			'boden@DIELEN:bool',
			'boden@KUNSTSTOFF:bool',
			'boden@ESTRICH:bool',
			'boden@DOPPELBODEN:bool',
			'kamin:bool',
			'heizungsart@OFEN:bool',
			'heizungsart@ETAGE:bool',
			'heizungsart@ZENTRAL:bool',
			'heizungsart@FERN:bool',
			'heizungsart qFUSSBODEN:bool',
			'befeuerung@OEL:bool',
			'befeuerung@GAS:bool',
			'befeuerung@ELEKTRO:bool',
			'befeuerung@ALTERNATIV:bool',
			'befeuerung@SOLAR:bool',
			'befeuerung@ERDWAERME:bool',
			'klimatisiert:bool',
			'fahrstuhl@PERSONEN:bool',
			'fahrstuhl@LASTEN:bool',
			'stellplatzart@GARAGE:bool',
			'stellplatz@TIEFGARAGE:bool',
			'stellplatz@CARPORT:bool',
			'stellplatz@FREIPLATZ:bool',
			'stellplatz@PARKHAUS:bool',
			'stellplatz@DUPLEX:bool',
			'gartennutzung:bool',
			'ausricht_balkon_terrasse@NORD:bool',
			'ausricht_balkon_terrasse@OST:bool',
			'ausricht_balkon_terrasse@SUED:bool',
			'ausricht_balkon_terrasse@WEST:bool',
			'moebliert moeb:bool',
			'rollstuhlgerecht:bool',
			'kabel_sat_tv:bool',
			'barrierefrei:bool',
			'sauna:bool',
			'swimmingpool:bool',
			'wasch_trockenraum:bool',
			'dv_verkabelung:bool',
			'rampe:bool',
			'hebebuehne:bool',
			'kran:bool',
			'gastterrasse:bool',
			'stromanschlusswert:bool',
			'kantine_cafeteria:bool',
			'teekueche:bool',
			'hallenhoehe:bool',
			'angeschl_gastronomie@HOTELRESTAURANT:bool',
			'angeschl_gastronomie@BAR:bool',
			'brauereibindung:bool',
			'sporteinrichtungen:bool',
			'wellnessbereich:bool',
			'serviceleistungen@BETREUTES_WOHNEN:bool',
			'serviceleistungen@CATERING:bool',
			'serviceleistungen@REINIGUNG:bool',
			'serviceleistungen@EINKAUF:bool',
			'serviceleistungen@WACHDIENST:bool',
			'telefon_ferienimmobilie:bool',
			'sicherheitstechnik@ALARMANLAGE:bool',
			'sicherheitstechnik@KAMERA:bool',
			'sicherheitstechnik@POLIZEIRUF:bool',
			'unterkellert@keller:bool',
			'abstellraum:bool',
			'fahrradraum:bool',
			'rolladen:bool'
		),
		'anbieter/immobilie/zustand_angaben' => array(
			'baujahr:int',
			'zustand@zustand_art:string',
			'alter@alter_attr:string',
			'bebaubar_nach@bebaubar_attr:string',
			'erschliessung@erschl_attr:string',
			'altlasten:string',
			'energiepass/art:string',
			'energiepass/gueltig_bis:string',
			'energiepass/energieverbrauchkennwert:string',
			'energiepass/mitwarmwasser:string',
			'energiepass/endenergiebedarf:string'
		),
		'anbieter/immobilie/bewertung' => array(
			'feld:string'
		),
		'anbieter/immobilie/infrastruktur' => array(
			'zulieferung:string',
			'ausblick@blick:string',
			'distanzen@distanz_zu:string',
			'distanzen_sport@distanz_zu_sport:string',
		),
		'anbieter/immobilie/freitexte' => array(
			'objekttitel:string',
			'dreizeiler:string',
			'lage:string',
			'ausstatt_beschr:string',
			'objektbeschreibung:string',
			'sonstige_angaben:string'
		),
		'anbieter/immobilie/anhaenge' => array(
			'anhang@location:string',
			'anhang@gruppe:string',
			'anhang/anhangtitel:string',
			'anhang/format:string',
			'anhang/daten/pfad:string'
		),
		'anbieter/immobilie/verwaltung_objekt' => array(
			'objektadresse_freigeben:bool',
			'verfuegbar_ab:string',
			'abdatum:string',
			'bisdatum:string',
			'min_mietdauer@min_dauer:string',
			'max_mietdauer@max_dauer:string',
			'versteigerungstermin:string',
			'wbs_sozialwohnung:string',
			'vermietet:bool',
			'gruppennummer:string',
			'zugang:string',
			'laufzeit:string',
			'max_personen:int',
			'nichtraucher:bool',
			'haustiere:bool',
			'geschlecht@geschl_attr:string',
			'denkmalgeschuetzt:bool',
			'als_ferien:bool',
			'gewerbliche_nutzung:bool',
			'branchen:string',
			'hochhaus:bool'
		),
		'anbieter/immobilie/verwaltung_techn' => array(
			'objektnr_intern:string',
			'objektnr_extern:string',
			'aktion@aktionart:string',
			'aktiv_von:string',
			'aktiv_bis:string',
			'openimmo_obid:string',
			'kennung_ursprung:string',
			'stand_vom:string',
			'weitergabe_generell:string',
			'weitergabe_positiv:string',
			'weitergabe_negativ:string'
		)
	);

	/**
	 * Generate module
	 */
	protected function compile()
	{
		
	}
	
	public function sync($dc)
	{
		$success = false;
		$send = false;
		if ($this->Input->post('FORM_SUBMIT') == 'tl_catalog_openimmo_sync')
		{
			$obj = $this->getCatalogObject($dc->id);
			$exportPath = $obj['exportPath'];
			$catalog = $obj['catalog'];
			
			$file = $this->getSyncFile($exportPath);
			
			if($file) {
				$data = $this->loadData($file);
				
				if($data) {
					$syncFields = $this->getSyncFields($obj['id']);
					if($syncFields) {
						if($this->syncDataWithCatalog($data, $obj, $syncFields)) {
							$success = true;
						} else $error = 3;
					} else $error = 2;
				} else $error = 1;
			} else $error = 0;

			$send = true;
		}
		
		// Return form
		$output = '
	<div id="tl_buttons">
		<a href="'.$this->getReferer(ENCODE_AMPERSANDS).'" class="header_back" title="'.specialchars($GLOBALS['TL_LANG']['MSC']['backBT']).'">'.$GLOBALS['TL_LANG']['MSC']['backBT'].'</a>
		</div>
	<h2 class="sub_headline">'.$GLOBALS['TL_LANG']['tl_catalog_openimmo']['sync'][0].'</h2>
		
	<form action="'.ampersand($this->Environment->request, ENCODE_AMPERSANDS).'" id="tl_catalog_openimmo_sync" class="tl_form" method="post">
	<div class="tl_formbody_edit">
	<input type="hidden" name="FORM_SUBMIT" value="tl_catalog_openimmo_sync" />
	<div class="tl_tbox">
	<p style="line-height:16px; padding-top:6px;">'.$GLOBALS['TL_LANG']['tl_catalog_openimmo']['syncConfirm'].'</p>';
		if($send) {
			$output.=($success ? '<p class="tl_confirm">'.$GLOBALS['TL_LANG']['tl_catalog_openimmo']['syncSuccess'].'</p>' : '<p class="tl_error">'.$GLOBALS['TL_LANG']['tl_catalog_openimmo']['syncErrors'][$error].'</p>');
		}
		$output.='</div>
	</div>

	<div class="tl_formbody_submit">

	<div class="tl_submit_container">
	<input type="submit" name="save" id="save" class="tl_submit" alt="regenerate dca" accesskey="s" value="'.specialchars($GLOBALS['TL_LANG']['tl_catalog_openimmo']['sync'][0]).'" />
	</div>

	</div>
	</form>';
		return $output;
	}

	public static function parseFields(&$group)
	{
		$fields = array();
		foreach($group as $field) {
			$fields[] = CatalogOpenImmo::parseField($field);
		}
		return $fields;
	}

	public static function parseField($value)
	{
		$field = array("name"=>"","type"=>"");
		$parts = explode(':',$value);
		$field["name"] = $parts[0];
		if(count($parts)>1)	$field["type"] = $parts[1];
		
		return $field;
	}

	public static function getFieldsByGroup($group)
	{
		$groups = CatalogOpenImmo::$fields;
		if(isset($groups[$group])) {
			return CatalogOpenImmo::parseFields($groups[$group]);
		} else return array();
	}

	public static function getFieldGroups()
	{
		$groups = array();
		$fields = CatalogOpenImmo::$fields;
		foreach(array_keys($fields) as $group) {
			$groups[] = $group;
		}

		return $groups;
	}

	private function getCatalogObject($id)
	{
		return $this->Database->execute("SELECT co.id AS id,co.catalog AS catalog, co.exportPath AS exportPath, ct.id AS catalogID ".
										"FROM tl_catalog_openimmo co ".
										"LEFT JOIN tl_catalog_types ct ON ct.tableName=co.catalog ".
										"WHERE co.id='$id'")->fetchAssoc();
	}

	private function getSyncFile($exportPath,$canBeZip = true)
	{
		$folder = new Folder($exportPath);
		$currentFile = null;
		$currentTime = 0;
		
		if(!$folder->isEmpty()) {
			//get latest file
			foreach(FilesHelper::scandirByExt($exportPath,($canBeZip)?array('zip','xml'):array('xml')) as $file) {
				if(FilesHelper::fileModTime($exportPath.'/'.$file)>$currentTime) {
					$currentFile = $exportPath.'/'.$file;
				}
			}
			
			//check if it is a zip, and if so unpack it
			if($canBeZip && FilesHelper::fileExt($currentFile,true,true)=='ZIP') $currentFile = $this->unpackSyncFile($currentFile);
			return $currentFile;
		} else return false;
	}

	private function unpackSyncFile($path)
	{
		$tmpFolder = new Folder(FilesHelper::fileDirPath($path).'tmp');
		//clear tmp folder if not empty
		if(!$tmpFolder->isEmpty()) $tmpFolder->clear();
		
		$tmpPath = $tmpFolder->__get('value');
		
		//extract zip to tmp folder
		$zip = new ZipArchive();
		$zip->open(TL_ROOT.'/'.$path);
		$zip->extractTo(TL_ROOT.'/'.$tmpPath);
		$zip->close();

		//return path to unpacked xml
		return $this->getSyncFile($tmpPath);
	}

	private function loadData($file)
	{
		return simplexml_load_file(TL_ROOT.'/'.$file);
	}

	private function getSyncFields($id)
	{
		$fields = array();
		$_fields = $this->Database->execute("SELECT catField,oiField,oiFieldGroup FROM tl_catalog_openimmo_fields WHERE pid='".$id."'")->fetchAllAssoc();

		foreach($_fields as $field) {
			$fields[$field['catField']] = $field['oiFieldGroup'].'/'.$field['oiField'];
		}
		return $fields;
	}

	private function syncDataWithCatalog(&$data,&$catalogObj,&$syncFields)
	{
		if($this->dataIsValid($data)) {
			$anbieter = $this->getAnbieter($data);
			if(count($anbieter)) {
				$xpath = 'anbieter';
				$immo_id = 0;
				$sorting = 0;

				$immos = array();

				foreach($anbieter as $_anbieter) {
					$immo_anbieter = array();
					
					$this->setImmoFields($_anbieter,$immo_anbieter,$syncFields,$xpath);

					$immobilien = $this->getImmobilien($_anbieter);

					$xpath = 'anbieter/immobilie';
					
					foreach($immobilien as $immobilie)
					{
						$immo_id++; //generate immo id
						$sorting++;
						
						//add anbieter info to immo
						$immo = array_merge($immo_anbieter,array("id"=>$immo_id,"pid"=>$catalogObj['catalogID'],"tstamp"=>time(),"sorting"=>$sorting));

						//immo info
						$this->setImmoFields($immobilie,$immo,$syncFields,$xpath);

						$immos[] = $immo;
					}
				}
				
				return $this->updateCatalog($immos,$catalogObj['catalog']);
			} else return false;
		} else return false;
	}

	private function dataIsValid(&$data)
	{
		if($data->getName()=='openimmo') {
			$uebertragung = $data->xpath('uebertragung');
			if(count($uebertragung)) {
				return true;
			} else return false;
		} else return false;
	}

	private function setImmoFields(&$xml,&$immo,&$fields,$xpath)
	{
		foreach(array_keys($fields) as $catField) {
			$value = $this->getFieldData($xml,$fields[$catField],$xpath);
			if($value) $immo[$catField] = $value;
		}
	}

	private function getFieldData(&$xml,$fieldPath,$xpath)
	{
		$attr_pos = strpos($fieldPath,'@');
		if($attr_pos!=FALSE) {
			$attr = substr($fieldPath,$attr_pos+1);
			$fieldPath = substr($fieldPath,0,$attr_pos);
		}
		$xpath_part = str_replace($xpath.'/','',$fieldPath);

		$result = $xml->xpath($xpath_part);
		
		if(count($result)) {
			$result = $result[0];
			if($attr) {
				$attributes = $result->attributes();
				$result = $attributes[$attr];
			}
			
			return $result.'';
		} else return false;
	}

	private function getAnbieter(&$xml)
	{
		return $xml->xpath('anbieter');
	}

	private function getImmobilien(&$xml)
	{
		return $xml->xpath('immobilie');
	}

	private function convertDataValues(&$data)
	{
		foreach(array_keys($data) as $key) {
			switch($data[$key]) {
				case 'true':
					$data[$key] = 1;
					break;

				case 'false':
					$data[$key] = 0;
					break;

				default:

			}
		}
	}

	private function updateCatalog(&$items,$catalog)
	{
		foreach($items as &$item) {
			//check if entry already exists
			$exists = $this->Database->execute("SELECT COUNT(id) FROM $catalog WHERE id='".$item['id']."'")->fetchAssoc();
			
			if(intval($exists['COUNT(id)'])>0) {
				//remove old entry if one exists
				$this->Database->execute("DELETE FROM $catalog WHERE id='".$item['id']."'");
			}

			$this->convertDataValues($item);
			
			//add entry again
			$this->Database->prepare("INSERT INTO $catalog %s")->set($item)->execute();
		}
		return true;
	}
}

?>