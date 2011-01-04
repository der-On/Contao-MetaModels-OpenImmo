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
 *	- anbieter/ should not be parsed for each immo again
 *	- anbieter/immobilie/ should not be parsed when getting anbieter/
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
	protected $strTemplate = 'mod_catalog_openimmo';
	

	public static $allowedAttachments = 'png,jpg,gif,pdf';

	public static $deleteActionField = array(
		'1.0' => array('path'=>'anbieter/immobilie/verwaltung_techn/aktion@aktionart','value'=>'DELETE'),
		'1.2.1' => array('path'=>'anbieter/immobilie/verwaltung_techn/aktion@aktionart','value'=>'DELETE'),
		'1.2.2' => array('path'=>'anbieter/immobilie/verwaltung_techn/aktion@aktionart','value'=>'DELETE'),
	);

	/*
	 * Compatible with OpenImmo 1.2.1
	 */
	public static $fields = array(
		'1.0' => array(),
		'1.2.1' => array(
			'anbieter' => array(
				'anbieternr:string',
				'firma:string',
				'openimmo_anid:string',
				'impressum:string',
				'impressum_strukt:string'
			),
			'anbieter/anhang' => array(
				'anhangtitel:string',
				'format:string',
				'daten/pfad:path'
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
				'objektart/wohnung@wohnungtyp:string',
				'objektart/haus@haustyp:string',
				'objektart/grundstueck@grundst_typ:string',
				'objektart/buero_praxen@buero_typ:string',
				'objektart/einzelhandel@handel_typ:string',
				'objektart/gastgewerbe@gastgew_typ:string',
				'objektart/hallen_lager_prod@hallen_typ:string',
				'objektart/land_und_forstwirtschaft@land_typ:string',
				'objektart/sonstige@sonstige_typ:string',
				'objektart/freizeitimmobilie_gewerblich@freizeit_typ:string',
				'objektart/zinshaus_renditeobjekt@zins_typ:string',
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
				'etage:string',
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
				'innen_courtage:string',
				'innen_courtage@mit_mwst:bool',
				'aussen_courtage:string',
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
				'gesamtflaeche:string',
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
				'heizungsart@FUSSBODEN:bool',
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
				'anhang/daten/pfad:path'
			),
			'anbieter/immobilie/verwaltung_objekt' => array(
				'objektadresse_freigeben:bool',
				'verfuegbar_ab:string',
				'abdatum:string',
				'bisdatum:string',
				'min_mietdauer@min_dauer:string',
				'max_mietdauer@max_dauer:string',
				'versteigerungstermin:string',
				'wbs_sozialwohnung:bool',
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
		),
		'1.2.2' => array()
	);

	protected $messages = array();
	protected $zip_unpacked = 0;

	public $fieldsFlat;
	
	/**
	 * Generate module
	 */
	protected function compile()
	{
		
	}

	protected function sync($dc)
	{
		$success = false;
		$send = false;
		$obj = $this->getCatalogObject($dc->id);
		$exportPath = $obj['exportPath'];
		$catalog = $obj['catalog'];
			
		if ($this->Input->post('FORM_SUBMIT') == 'tl_catalog_openimmo_sync')
		{
			$unpacked = $this->Input->post('tl_catalog_openimmo_zip_unpacked');
			if($this->Input->post('tl_catalog_openimmo_sync_file')!="") {
				if($unpacked=="2") {
					$this->zip_unpacked = 2;
				} else $sync_file = $this->Input->post('tl_catalog_openimmo_sync_file');

				$file = $this->getSyncFile($exportPath);

				if($file) {
					if ($this->Input->post("tl_catalog_openimmo_sync_file")) {
						$sync_file = $this->Input->post('tl_catalog_openimmo_sync_file');
					}
					$this->addMessage('OpenImmo file: '.$file);
					$data = $this->loadData($file);

					if($data) {
						$this->addMessage('OpenImmo data loaded');
						$syncFields = $this->getSyncFields($obj['id'],$obj['uniqueIDField']);
						if($syncFields) {
							$this->addMessage('loaded synchronization data');
							if($this->syncDataWithCatalog($data, $obj, $syncFields)) {
								$this->addMessage('data synced');
								if($this->syncDataFiles($obj,$file)) {
									$this->addMessage('files synced');
									$success = true;
								} else $error = 4;
							} else $error = 3;
						} else $error = 2;
					} else $error = 1;
					if($error) {
						$this->addFileToHistory($exportPath,$sync_file,2);
					} else $this->addFileToHistory($exportPath,$sync_file,1);
				} else $error = 0;

				$send = true;
			} else $this->addMessage($GLOBALS['TL_LANG']['tl_catalog_openimmo']['noSyncFile']);
		}
		
		$this->Template = new BackendTemplate($this->strTemplate);

		$this->Template->setData(array(
			'send' => $send,
			'messages' => $this->getMessages(),
			'files' => (!$send)?$this->getSyncFiles($exportPath):null,
			'zip_unpacked' => $this->zip_unpacked,
			'success' => $success,
			'error' => $error,
			"sync_file" => $sync_file
		));
		// Return form
		/*$output = '
		<div id="tl_buttons">
			<a href="'.$this->getReferer(ENCODE_AMPERSANDS).'" class="header_back" title="'.specialchars($GLOBALS['TL_LANG']['MSC']['backBT']).'">'.$GLOBALS['TL_LANG']['MSC']['backBT'].'</a>
			</div>
		<h2 class="sub_headline">'.$GLOBALS['TL_LANG']['tl_catalog_openimmo']['sync'][0].'</h2>

		<form action="'.ampersand($this->Environment->request, ENCODE_AMPERSANDS).'" id="tl_catalog_openimmo_sync" class="tl_form" method="post">
		<div class="tl_formbody_edit">
		<input type="hidden" name="FORM_SUBMIT" value="tl_catalog_openimmo_sync" />
		<div class="tl_tbox">
		<p style="line-height:16px; padding-top:6px;">'.$GLOBALS['TL_LANG']['tl_catalog_openimmo']['syncConfirm'].'</p>';
		$output.='<p>'.$this->getMessages().'</p>';
		if(!$send) $output.=$this->getSyncFileSelect($exportPath);
		if($send) {
			if($this->zip_unpacked==1) {
				$output.='<p class="tl_confirm">'.$GLOBALS['TL_LANG']['tl_catalog_openimmo']['syncFileUnpacked'].'</p>'.
				'<input type="hidden" name="tl_catalog_openimmo_zip_unpacked" value="2">';
			} else $output.=($success ? '<p class="tl_confirm">'.$GLOBALS['TL_LANG']['tl_catalog_openimmo']['syncSuccess'].'</p>' : '<p class="tl_error">'.$GLOBALS['TL_LANG']['tl_catalog_openimmo']['syncErrors'][$error].'</p>');
		}
		$output.='</div>
		</div>';
		if(!$send || $this->zip_unpacked==1) {
			$output.='
			<div class="tl_formbody_submit">

			<div class="tl_submit_container">
			<input type="submit" name="save" id="save" class="tl_submit" alt="regenerate dca" accesskey="s" value="'.specialchars($GLOBALS['TL_LANG']['tl_catalog_openimmo']['sync'][0]).'" />
			</div>

			</div>';
		}
		$output.='</form>';
		return $output;*/
		return $this->Template->parse();
	}

	private function getSyncFileSelect($exportPath)
	{
		$files = $this->getSyncFiles($exportPath);
		if($files) {
			$output = "<label for='tl_catalog_openimmo_sync_files'>".$GLOBALS['TL_LANG']['tl_catalog_openimmo']['sync_file_select']."</label><br/>";
			$output.="<select id='tl_catalog_openimmo_sync_files' name='tl_catalog_openimmo_sync_file'>";
			$output.="<option value=''>".$GLOBALS['TL_LANG']['tl_catalog_openimmo']['sync_file_auto']."</option>";
			foreach($files as &$file) {
				if($file['size']<1024) {
					$size = $file['size'].' Bytes';
				} elseif($file['size']>1024 && $file['size']<(1048576)) {
					$size = (round(($file['size']/1024)*10)/10)." KB";
				} elseif($file['size']>(1048576)) {
					$size = (round(($file['size']/1048576)*10)/10)." MB";
				}
				$output.="<option value='$file[file]'>$file[file] - ".date('H:i:s d.m.Y',$file['modtime'])." (".$size.")</option>";
			}
			$output.="</select>";
			return $output;
		} else return "<p class='tl_error'>".$GLOBALS['TL_LANG']['tl_catalog_openimmo']['no_sync_files_found']."</p>";
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

	private function parseFieldType($xpath,$value,$catalogObj)
	{
		//if($this->fieldsFlat!=null) {
			if(isset($this->fieldsFlat[$xpath]) && $this->fieldsFlat[$xpath]=='path') {
				return $catalogObj['filesPath'].'/'.$value;
			} else return $value;
		//} else return $value;
	}

	public static function getFieldsByGroup($oiVersion,$group)
	{
		$groups = CatalogOpenImmo::$fields;
		if(isset($groups[$oiVersion][$group])) {
			return CatalogOpenImmo::parseFields($groups[$oiVersion][$group]);
		} else return array();
	}

	public static function getFieldGroups($oiVersion)
	{
		$groups = array();
		$fields = CatalogOpenImmo::$fields;
		foreach(array_keys($fields[$oiVersion]) as $group) {
			$groups[] = $group;
		}

		return $groups;
	}

	private function getCatalogObject($id)
	{
		return $this->Database->execute("SELECT co.id AS id,co.catalog AS catalogID, co.exportPath AS exportPath, co.filesPath AS filesPath, ct.tableName AS catalog, co.oiVersion AS oiVersion, co.uniqueIDField AS uniqueIDField ".
										"FROM tl_catalog_openimmo co ".
										"LEFT JOIN tl_catalog_types ct ON ct.id=co.catalog ".
										"WHERE co.id='$id'")->fetchAssoc();
	}

	private function getSyncFiles($exportPath,$canBeZip = true)
	{
		$folder = new Folder($exportPath);

		$synced = array();

		$history = $this->Database->execute("SELECT * FROM tl_catalog_openimmo_history")->fetchAllAssoc();
		
		foreach($history as $entry) {
			$synced[$entry['file']] = array(
				"filetime" => $entry['filetime'],
				"synctime" => $entry['synctime'],
				"user" => $entry['user'],
				"status" => $entry['status']
			);
		}

		if(!$folder->isEmpty()) {
			$files = array();
			$lasttime = time();
			$checked = -1;

			//get latest file
			foreach(FilesHelper::scandirByExt($exportPath,($canBeZip)?array('zip','xml'):array('xml')) as $i => $file) {
				$mtime = FilesHelper::fileModTime($exportPath.'/'.$file);
				$size = FilesHelper::fileSize($exportPath.'/'.$file);

				if(array_key_exists($file,$synced)) {
					$mtime = intval($synced[$file]['filetime']);
					$user = $synced[$file]['user'];
					$status = intval($synced[$file]['status']);
					$synctime = intval($synced[$file]['synctime']);
				} else {
					$user = '';
					$status = 0;
					$synctime = 0;
					if($lasttime>$mtime) {
						$lasttime = $mtime;
						$checked = $i;
					}
				}

				$files[] = array(
					"file"=>$file,
					"time"=>$mtime,
					"size"=>$size,
					"user"=>$user,
					"status"=>$status,
					"synctime"=>$synctime,
					"checked"=>false
				);
			}

			if ($checked!=-1) $files[$checked]['checked'] = true;

			usort($files,create_function('$a,$b','
				if ($a == $b) return 0;
				return ($a["time"]>$b["time"])?-1:1;')
			);

			return $files;
		} else return false;
	}

	private function getSyncFile($exportPath,$canBeZip = true,$use_post = true)
	{
		$folder = new Folder($exportPath);
		$currentFile = null;
		$currentTime = 0;
		
		if(!$folder->isEmpty()) {
			$sync_file = $this->Input->post('tl_catalog_openimmo_sync_file');
			
			if(!$use_post || ($use_post && ($sync_file==null || $sync_file==''))) {
				//get latest file
				foreach(FilesHelper::scandirByExt($exportPath,($canBeZip)?array('zip','xml'):array('xml')) as $file) {
					$mtime = FilesHelper::fileModTime($exportPath.'/'.$file);
					if($mtime>$currentTime) {
						$currentTime = $mtime;
						$currentFile = $exportPath.'/'.$file;
					}
				}
			} else $currentFile = $exportPath.'/'.$sync_file;
			
			if(file_exists(TL_ROOT.'/'.$currentFile)) {
				//check if it is a zip, and if so unpack it
				if($canBeZip && $this->zip_unpacked==0 && FilesHelper::fileExt($currentFile,true,true)=='ZIP') {
					$this->unpackSyncFile($currentFile);
					$currentFile = false;
					$this->zip_unpacked = 1;
				} elseif($this->zip_unpacked==2) {
					$this->zip_unpacked = 3;
					$currentFile = $this->getSyncFile($exportPath.'/tmp',false,false);
				}
				return $currentFile;
			} else return false;
		} else return false;
	}

	private function unpackSyncFile($path)
	{
		$tmpFolder = new Folder(FilesHelper::fileDirPath($path).'tmp');
		//clear tmp folder if not empty
		if(!$tmpFolder->isEmpty()) $tmpFolder->clear();
		
		$tmpPath = $tmpFolder->__get('value');
		
		//extract zip to tmp folder
		$zip = new ZipReader($path);
		$files = $zip->getFileList();
		$zip->first();
		foreach($files as $file) {
			$content = $zip->unzip();
			file_put_contents(TL_ROOT.'/'.$tmpPath.'/'.$file,$content);
			$zip->next();
		}
		//return $this->getSyncFile($tmpPath,false,false);
	}

	private function addFileToHistory($exportPath,$file,$status) {
		$filetime = FilesHelper::fileModTime($exportPath.'/'.$file);
		$item = array(
			"file" => $file,
			"filetime" => $filetime,
			"synctime" => time(),
			"status" => $status,
			"user" => $GLOBALS['TL_USERNAME']
		);
		$exists = $this->Database->execute("SELECT id,filetime FROM tl_catalog_openimmo_history WHERE file = '$item[file]'")->fetchAssoc();
		if($exists!=false && count($exists)>0) {
			$item["filetime"] = $exists["filetime"];
			$this->Database->prepare("UPDATE tl_catalog_openimmo_history %s WHERE id='$exists[id]'")->set($item)->execute();
		} else $this->Database->prepare("INSERT INTO tl_catalog_openimmo_history %s")->set($item)->execute();

	}

	private function loadData($file)
	{
		$data = file_get_contents(TL_ROOT.'/'.$file);
		
		//remove all namespace stuff as simplexml cannot handle it reliably
		$oi_open_pos = strpos($data,'<openimmo');
		$oi_close_pos = strpos(substr($data,$oi_open_pos),'>');
		$data = substr($data,0,$oi_open_pos).'<openimmo>'.substr($data,$oi_close_pos+$oi_open_pos+1);
		return simplexml_load_string($data);
	}

	private function getSyncFields($id,$uniqueIDField)
	{
		$fields = array();
		$_fields = $this->Database->execute("SELECT cf.colName as catField, cof.catField AS catFieldID , cof.oiField AS oiField, cof.oiFieldGroup as oiFieldGroup, cof.oiCustomField as oiCustomField ".
											"FROM tl_catalog_openimmo_fields cof ".
											"LEFT JOIN tl_catalog_fields cf ON cf.id=cof.catField ".
											"WHERE cof.pid='".$id."'")->fetchAllAssoc();

		foreach($_fields as $field) {
			//prevent loading missing catalog fields
			if($field['catField']!='') {
				if(!isset($fields[$field['catField']])) $fields[$field['catField']] = array();
				if($field['oiCustomField']!='') {
					$fields[$field['catField']][] = $field['oiCustomField'];
				} else $fields[$field['catField']][] = $field['oiFieldGroup'].'/'.$field['oiField'];
			}
		}

		//add uniqueIDField
		if($uniqueIDField!='') $fields['id'] = array($uniqueIDField);

		return $fields;
	}
	
	public static function getFlattenedFields($oiVersion)
	{
		$fieldsFlat = array();
		$groups = CatalogOpenImmo::$fields;
		foreach(array_keys($groups[$oiVersion]) as $group) {
			foreach($groups[$oiVersion][$group] as $field) {
				$_field = CatalogOpenImmo::parseField($field);
				$fieldsFlat[$group.'/'.$_field['name']] = $_field['type'];
			}
		}
		return $fieldsFlat;
	}
	
	private function flattenFields($oiVersion)
	{
		$this->fieldsFlat = CatalogOpenImmo::getFlattenedFields($oiVersion);
	}
	
	private function syncDataWithCatalog(&$data,&$catalogObj,&$syncFields)
	{
		if($this->dataIsValid($data)) {

			//flatten fields array temporally
			$this->flattenFields($catalogObj['oiVersion']);
			
			$anbieter = $this->getAnbieter($data);
			
			if(count($anbieter)) {
				$xpath = 'anbieter';
				$immo_id = 0;
				$sorting = 0;

				$immos = array();

				foreach($anbieter as $_anbieter) {
					//$immo_anbieter = array();
					
					//$this->setImmoFields($_anbieter,$immo_anbieter,$syncFields,$xpath,$catalogObj);

					$immobilien = $this->getImmobilien($_anbieter);

					$xpath = 'anbieter/immobilie';
					
					foreach($immobilien as $immobilie)
					{
						$immo_id++; //generate immo id
						$sorting++;
						
						//add anbieter info to immo
						//$immo = array_merge($immo_anbieter,array("id"=>$immo_id,"pid"=>$catalogObj['catalogID'],"tstamp"=>time(),"sorting"=>$sorting));
						$immo = array("id"=>$immo_id,"pid"=>$catalogObj['catalogID'],"tstamp"=>time(),"sorting"=>$sorting);

						//immo info
						$this->setImmoFields($immobilie,$immo,$syncFields,$xpath,$catalogObj);

						//store reference to xml-node
						$immo['_xml_'] = $immobilie;

						$immos[] = $immo;
					}
				}
				$this->addMessage("found ".count($immos)." objects");
				
				return $this->updateCatalog($immos,$catalogObj);
			} else return false;
		} else {
			$this->addMessage('invalid OpenImmo data');
			return false;
		}
	}

	private function dataIsValid(&$data)
	{
		if($data->getName()=='openimmo') {
			$anbieter = $data->xpath('anbieter');
			if(count($anbieter)) {
				return true;
			} else return false;
		} else return false;
	}

	private function setImmoFields(&$xml,&$immo,&$fields,$xpath,&$catalogObj)
	{
		foreach(array_keys($fields) as $catField) {
			foreach($fields[$catField] as $fieldPath) {
				$value = $this->getFieldData($xml,$fieldPath,$xpath,$catalogObj);
				if($value!=null) $immo[$catField] = $value;
			}
		}
	}

	private function getFieldData(&$xml,$fieldPath,$xpath,&$catalogObj)
	{
		$attr_pos = strpos($fieldPath,'@');
		if($attr_pos!=FALSE) {
			$attr = substr($fieldPath,$attr_pos+1);
			$fieldPath = substr($fieldPath,0,$attr_pos);
		}
		
		$xpath_part = str_replace($xpath.'/','',$fieldPath);

		$results = $xml->xpath($xpath_part);

		$count = count($results);

		if($count) {
			for($i = 0; $i<$count; $i++) {
				if($attr) {
					$attributes = $results[$i]->attributes();
					$results[$i] = $attributes[$attr];
				}
				$results[$i] = $this->parseFieldType($fieldPath,$results[$i].'',$catalogObj);
			}
			
			if($count==1) {
				return $results[0];
			} elseif($count>1) {
				return serialize($results);
			}
			
		} else return null;
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

	private function updateCatalog(&$items,$catalogObj)
	{
		//TODO: generate ID from uniqueIDField

		$catalog = $catalogObj['catalog'];
		
		foreach($items as &$item) {
			//check if entry already exists
			$exists = $this->Database->execute("SELECT COUNT(id) FROM $catalog WHERE id='".$item['id']."'")->fetchAssoc();

			//remove if deleteAction is in use
			$deleted = $this->getFieldData($item['_xml_'],CatalogOpenImmo::$deleteActionField[$catalogObj['oiVersion']]['path'],'anbieter/immobilie',$catalogObj);
			$deleted = ($deleted == CatalogOpenImmo::$deleteActionField[$catalogObj['oiVersion']]['value'])?true:false;

			$this->convertDataValues($item);
			
			if(intval($exists['COUNT(id)'])>0) {
				//remove old entry if one exists and this should be deleted
				if($deleted) {
					$this->Database->execute("DELETE FROM $catalog WHERE id='".$item['id']."'");
					$this->addMessage("deleted object: ".$item['id']);
				} else {
					$id = $item['id'];
					unset($item['id']);
					unset($item['_xml_']);
					$this->Database->prepare("UPDATE $catalog %s WHERE id='$id'")->set($item)->execute();
				}
			} elseif(!$deleted) {
				unset($item['_xml_']);
				$this->Database->prepare("INSERT INTO $catalog %s")->set($item)->execute();
			}
		}
		return true;
	}

	private function syncDataFiles(&$catalogObj,$dataFile)
	{
		$dataPath = FilesHelper::fileDirPath($dataFile);
		
		//get attachments in the data folder
		$files = FilesHelper::scandirByExt($dataPath, explode(',',CatalogOpenImmo::$allowedAttachments));

		$filesFolder = new Folder($catalogObj['filesPath']);

		if(FilesHelper::isWritable($catalogObj['filesPath'])) {

			//remove old files
			//$filesFolder->clear();

			$filesObj = Files::getInstance();

			foreach($files as $file) {
				$filesObj->copy($dataPath.$file,$catalogObj['filesPath'].'/'.$file);
			}
			$this->addMessage('copied '.count($files).' files from temporary directory to: '.$catalogObj['filesPath']);
		} else $this->addMessage('cannot copy temporary files: '.$catalogObj['filesPath'].' not writable');
		
		//empty the data directory if it is the temp directory so we do not have files doubled
		if(substr($dataPath,-4)=='tmp/') {
			$dataFolder = new Folder($dataPath);
			$dataFolder->clear();
			$this->addMessage('emptied temporary directory: '.$dataPath);
		}
		
		return true;
	}

	private function addMessage($msg)
	{
		$this->messages[] = $msg;
	}

	protected function getMessages()
	{
		$strMsg = '';
		
		foreach($this->messages as $msg)
		{
			$strMsg.=$msg."<br/>\n";
		}
		return $strMsg;
	}
}

?>