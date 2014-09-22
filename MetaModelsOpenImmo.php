<?php

/**
 *
 * PHP version 5
 * @copyright  Ondrej Brinkel 2014
 * @author     Ondrej Brinkel
 * @package    MetaModelsOpenImmo
 * @license    MIT
 * @filesource
 */

namespace MetaModelsOpenImmo;

/**
 * Class MetaModelsOpenImmo
 *
 * @copyright  Ondrej Brinkel 2014
 * @author     Ondrej Brinkel
 * @package    Controller
 */
class MetaModelsOpenImmo extends \BackendModule
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_metamodels_openimmo';

    /**
     * Allowed file types for attachments
     * @var string
     */
    public static $allowedAttachments = 'png,jpg,gif,pdf';

    /**
     * List of xml fields/x-paths that trigger a object deletion
     * @var array(openimmo-version => array('path' => '...', 'value' => '...'))
     */
    public static $deleteActionField = array(
        '1.2.1' => array('path' => 'anbieter/immobilie/verwaltung_techn/aktion@aktionart', 'value' => 'DELETE'),
        '1.2.2' => array('path' => 'anbieter/immobilie/verwaltung_techn/aktion@aktionart', 'value' => 'DELETE'),
        '1.2.3' => array('path' => 'anbieter/immobilie/verwaltung_techn/aktion@aktionart', 'value' => 'DELETE'),
        '1.2.4' => array('path' => 'anbieter/immobilie/verwaltung_techn/aktion@aktionart', 'value' => 'DELETE'),
        '1.2.5' => array('path' => 'anbieter/immobilie/verwaltung_techn/aktion@aktionart', 'value' => 'DELETE'),
    );

    /**
     * Flash messages presented to the user
     * @var array
     */
    protected $messages = array();

    /**
     * Flag if exported zip file was already unpacked
     * @var int
     */
    protected $zip_unpacked = 0;

    /**
     * Will be filled with flattened field paths
     * @var array
     */
    public $fieldsFlat;

    /**
     * Generate module
     */
    protected function compile()
    {

    }

    /**
     * Returns all openimmo xml fields for a given openimmo version
     * @param string $oiVersion - (default = '1.2.1') openimmo version
     * @return array
     */
    public static function getFields($oiVersion = '1.2.1')
    {
        switch ($oiVersion) {
            case '1.2.1':
                return array(
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
                    'anbieter/immobilie/objektkategorie' => array(
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
                        'tel_handy:string',
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
                        'bad',
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
                );
                break;

            case '1.2.2':
                $fields = array_merge_recursive(self::getFields('1.2.1'), array(
                    'anbieter/immobilie/versteigerung' => array(
                        'aktenzeichen:string',
                        'zvtermin:string',
                        'zusatztermin:string',
                        'amtsgericht:string',
                    ),
                    'anbieter/immobilie/preise' => array(
                        'provisionspflichtig:bool',
                    ),
                    'anbieter/immobilie/ausstattung' => array(
                        'ausstatt_kategorie:string',
                        'dachform@KRUEPPELWALMDACH:bool',
                        'dachform@MANSARDDACH:bool',
                        'dachform@PULTDACH:bool',
                        'dachform@SATTELDACH:bool',
                        'dachform@WALMDACH:bool',
                        'bauweise@MASSIV:bool',
                        'bauweise@FERTIGTEILE:bool',
                        'bauweise@HOLZ:bool',
                        'ausbaustufe@BAUSATZHAUS:bool',
                        'ausbaustufe@AUSBAUHAUS:bool',
                        'ausbaustufe@SCHLUESSELFERTIGMITKELLER:bool',
                        'ausbaustufe@SCHLUESSELFERTIGOHNEBODENPLATTE:bool',
                        'ausbaustufe@SCHLUESSELFERTIGMITBODENPLATTE:bool',
                        'boden@FERTIGPARKETT:bool',
                        'boden@LAMINAT:bool',
                        'boden@LINOLEUM:bool',
                        'befeuerung@LUFTWP:bool',
                        'ausricht_balkon_terrasse@NORDOST:bool',
                        'ausricht_balkon_terrasse@NORDWEST:bool',
                        'ausricht_balkon_terrasse@SUEDOST:bool',
                        'ausricht_balkon_terrasse@SUEDWEST:bool',
                    ),
                ));
                // 'energiepass/art' changed to 'energiepass/epart'
                $fields['anbieter/immobilie/zustand_angaben'][6] = 'energiepass/epart:string';
                return $fields;
                break;

            case '1.2.3':
                $fields = array_merge_recursive(self::getFields('1.2.2'), array(
                    'anbieter/immobilie/preise' => array(
                        'courtage_hinweis:string',
                        'nettorendite_soll:float',
                        'nettorendite_ist:float',
                    ),
                    'anbieter/immobilie/kontaktperson' => array(
                        'email_feedback:string',
                    ),
                    'anbieter/immobilie/flaechen' => array(
                        'anzahl_balkone:int',
                        'anzahl_terrassen:int',
                    ),
                    'anbieter/immobilie/ausstattung' => array(
                        'bibliothek:bool',
                        'dachboden:bool',
                        'gaestewc:bool',
                        'kabelkanaele:bool',
                        'seniorengerecht:bool',
                        'bad@BIDET:bool',
                        'bad@PISSIOR:bool',
                        'boden@MARMOR:bool',
                        'boden@TERRAKOTTA:bool',
                        'befeuerung@PELLET:bool',
                        'kueche@PANTRY:bool',
                        'dachform@FLACHDACH:bool',
                        'dachform@PYRAMIDENDACH:bool',
                        'energietyp@PASSIVHAUS:bool',
                        'energietyp@NIEDRIGENERGIE:bool',
                        'energietyp@NEUBAUSTANDARD:bool',
                        'energietyp@KFW40:bool',
                        'energietyp@KFW60:bool',
                    ),
                    'anbieter/immobilie/zustand_angaben' => array(
                        'letzemodernisierung:string'
                    ),
                    'anbieter/immobilie/freitexte' => array(
                        'user_defined_extend:string',
                    ),
                    'anbieter/immobilie/anhaenge' => array(
                        'user_defined_extend:string'
                    ),
                    'anbieter/immobilie/objektart' => array(
                        'parken:string',
                    )
                ));
                return $fields;
                break;

            case '1.2.4':
                return self::getFields('1.2.3');
                break;

            case '1.2.5':
                return self::getFields('1.2.4');
                break;

            default:
                return self::getFields('1.2.1');
        }
    }

    /**
     * Returns a list of supported openimmo versions
     * @return array
     */
    public static function getSupportedVersions()
    {
        return array('1.2.1', '1.2.2', '1.2.3', '1.2.4', '1.2.5');
    }

    /**
     * Syncs openimmo export data with database
     * @param object $dc - DataContainer
     * @return string
     */
    protected function sync($dc)
    {
        $success = false;
        $send = false;
        $obj = $this->getMetaModelObject($dc->id);
        $exportPath = $obj['exportPath'];
        $metamodel = $obj['metamodel'];

        if ($this->Input->post('FORM_SUBMIT') == 'tl_metamodels_openimmo_sync') {
            $unpacked = $this->Input->post('tl_metamodels_openimmo_zip_unpacked');
            if ($this->Input->post('tl_metamodels_openimmo_sync_file') != "") {
                if ($unpacked == "2") {
                    $this->zip_unpacked = 2;
                } else $sync_file = $this->Input->post('tl_metamodels_openimmo_sync_file');

                $file = $this->getSyncFile($exportPath);

                if ($file) {
                    if ($this->Input->post("tl_metamodels_openimmo_sync_file")) {
                        $sync_file = $this->Input->post('tl_metamodels_openimmo_sync_file');
                    }
                    $this->addMessage('OpenImmo file: ' . $file);
                    $data = $this->loadData($file);

                    if ($data) {
                        $this->addMessage('OpenImmo data loaded');
                        $syncFields = $this->getSyncFields($obj['id'], $obj['uniqueIDField']);
                        if ($syncFields) {
                            $this->addMessage('loaded synchronization data');
                            if ($this->syncDataFiles($obj, $file)) {
                                $this->addMessage('data synced');
                                if ($this->syncDataWithCatalog($data, $obj, $syncFields)) {
                                    $this->addMessage('files synced');
                                    $mm_id = $dc->id;
                                    $now = time();
                                    $this->Database->execute("UPDATE tl_metamodels_openimmo SET lastSync='$now' WHERE id='$mm_id'");
                                    $success = true;
                                } else $error = 4;
                            } else $error = 3;
                        } else $error = 2;
                    } else $error = 1;
                    if ($error) {
                        $this->addFileToHistory($exportPath, $sync_file, 2);
                    } else $this->addFileToHistory($exportPath, $sync_file, 1);
                } else $error = 0;

                $send = true;
            } else $this->addMessage($GLOBALS['TL_LANG']['tl_metamodels_openimmo']['noSyncFile']);
        }

        $this->Template = new \BackendTemplate($this->strTemplate);

        $this->Template->setData(array(
            'send' => $send,
            'messages' => $this->getMessages(),
            'files' => (!$send) ? $this->getSyncFiles($exportPath) : null,
            'zip_unpacked' => $this->zip_unpacked,
            'success' => $success,
            'error' => $error,
            "sync_file" => $sync_file
        ));

        return $this->Template->parse();
    }

    /**
     * Returns the <select> input for the files available for syncing
     * @deprecated
     * @param string $exportPath
     * @return string
     */
    private function getSyncFileSelect($exportPath)
    {
        $files = $this->getSyncFiles($exportPath);
        if ($files) {
            $output = "<label for='tl_metamodels_openimmo_sync_files'>" . $GLOBALS['TL_LANG']['tl_metamodels_openimmo']['sync_file_select'] . "</label><br/>";
            $output .= "<select id='tl_metamodels_openimmo_sync_files' name='tl_metamodels_openimmo_sync_file'>";
            $output .= "<option value=''>" . $GLOBALS['TL_LANG']['tl_metamodels_openimmo']['sync_file_auto'] . "</option>";
            foreach ($files as &$file) {
                if ($file['size'] < 1024) {
                    $size = $file['size'] . ' Bytes';
                } elseif ($file['size'] > 1024 && $file['size'] < (1048576)) {
                    $size = (round(($file['size'] / 1024) * 10) / 10) . " KB";
                } elseif ($file['size'] > (1048576)) {
                    $size = (round(($file['size'] / 1048576) * 10) / 10) . " MB";
                }
                $output .= "<option value='$file[file]'>$file[file] - " . date('H:i:s d.m.Y', $file['modtime']) . " (" . $size . ")</option>";
            }
            $output .= "</select>";
            return $output;
        } else return "<p class='tl_error'>" . $GLOBALS['TL_LANG']['tl_metamodels_openimmo']['no_sync_files_found'] . "</p>";
    }

    /**
     * Parses/Normalizes a field definitions group as returned by getFields()
     * @param array $group
     * @see parseField
     * @return array
     */
    public static function parseFields(&$group)
    {
        $fields = array();
        foreach ($group as $field) {
            $fields[] = MetaModelsOpenImmo::parseField($field);
        }
        return $fields;
    }

    /**
     * Parses/Normalizes a single field definition as returned by getFields()
     * @param string $value
     * @return array("name"=>"{field name}", "type"=>"{data-type}")
     */
    public static function parseField($value)
    {
        $field = array("name" => "", "type" => "");
        $parts = explode(':', $value);
        $field["name"] = $parts[0];
        if (count($parts) > 1) $field["type"] = $parts[1];

        return $field;
    }

    /**
     * Will resolve special field data types
     * @param string $xpath - absolute x-path for this field in the openimmo xml
     * @param string $value - field value as retrieved from the openimmo xml
     * @param object $metamodelObj
     * @return string
     */
    private function parseFieldType($xpath, $value, $metamodelObj)
    {
        //if($this->fieldsFlat!=null) {
        if (isset($this->fieldsFlat[$xpath]) && $this->fieldsFlat[$xpath] == 'path') {
            return $metamodelObj['filesPath'] . '/' . $value;
        } else return $value;
        //} else return $value;
    }

    /**
     * Returns a normalized group of field definitions as returned by getFields
     * @param string $oiVersion - openimmo version
     * @param string $group - group name e.g. 'anbieter'
     * @return array
     */
    public static function getFieldsByGroup($oiVersion, $group)
    {
        $groups = MetaModelsOpenImmo::getFields($oiVersion);

        if (isset($groups[$group])) {
            $fields = MetaModelsOpenImmo::parseFields($groups[$group]);
            sort($fields);
            return $fields;
        } else return array();
    }

    /**
     * Returns all normalized field definition groups as returned by getFields
     * @param string $oiVersion - openimmo version
     * @return array
     */
    public static function getFieldGroups($oiVersion)
    {
        $groups = array();
        $fields = MetaModelsOpenImmo::getFields($oiVersion);
        foreach (array_keys($fields) as $group) {
            $groups[] = $group;
        }
        sort($groups);

        return $groups;
    }

    /**
     * Returns a metamodels object by id
     * @param string|int $id
     * @return mixed
     */
    public function getMetaModelObject($id)
    {
        $obj = $this->Database->execute("SELECT mmo.id AS id,mmo.metamodel AS metamodelID, mmo.exportPath AS exportPath, mmo.filesPath AS filesPath, mmt.tableName AS metamodel, mmo.oiVersion AS oiVersion, mmo.uniqueIDField AS uniqueIDField, mmo.deleteFilesOlderThen AS deleteFilesOlderThen, mmo.autoSync AS autoSync, mmo.lastSync AS lastSync " .
            "FROM tl_metamodels_openimmo mmo " .
            "LEFT JOIN tl_metamodel mmt ON mmt.id=mmo.metamodel " .
            "WHERE mmo.id='$id'")->fetchAssoc();

        // Contao 3 stores files in database using uuids
        if (VERSION > '2') {
            $obj['filesPath'] = \FilesModel::findByUuid($obj['filesPath']);
            $obj['exportPath'] = \FilesModel::findByUuid($obj['exportPath']);
            $obj['filesPath'] = $obj['filesPath']->path;
            $obj['exportPath'] = $obj['exportPath']->path;
        }
        return $obj;
    }

    /**
     * Returns a list of syncable files
     * @param string $exportPath - path where files are stored
     * @param bool $canBeZip
     * @return array|bool - false of no files have been found
     */
    public function getSyncFiles($exportPath, $canBeZip = true)
    {
        $folder = new \Folder($exportPath);

        $synced = array();

        $history = $this->Database->execute("SELECT * FROM tl_metamodels_openimmo_history")->fetchAllAssoc();

        foreach ($history as $entry) {
            $synced[$entry['file']] = array(
                "filetime" => $entry['filetime'],
                "synctime" => $entry['synctime'],
                "user" => $entry['user'],
                "status" => $entry['status']
            );
        }

        if (!$folder->isEmpty()) {
            $files = array();
            $lasttime = time();
            $checked = -1;

            //get latest file
            foreach (FilesHelper::scandirByExt($exportPath, ($canBeZip) ? array('zip', 'xml') : array('xml')) as $i => $file) {
                $mtime = FilesHelper::fileModTime($exportPath . '/' . $file);
                $size = FilesHelper::fileSize($exportPath . '/' . $file);

                if (array_key_exists($file, $synced)) {
                    $mtime = intval($synced[$file]['filetime']);
                    $user = $synced[$file]['user'];
                    $status = intval($synced[$file]['status']);
                    $synctime = intval($synced[$file]['synctime']);
                } else {
                    $user = '';
                    $status = 0;
                    $synctime = 0;
                    if ($lasttime > $mtime) {
                        $lasttime = $mtime;
                        $checked = $i;
                    }
                }

                $files[] = array(
                    "file" => $file,
                    "time" => $mtime,
                    "size" => $size,
                    "user" => $user,
                    "status" => $status,
                    "synctime" => $synctime,
                    "checked" => false
                );
            }

            if ($checked != -1) $files[$checked]['checked'] = true;

            usort($files, create_function('$a,$b', '
				if ($a == $b) return 0;
				return ($a["time"]>$b["time"])?-1:1;')
            );

            return $files;
        } else return false;
    }

    /**
     * Returns
     * @param string $exportPath - path to the exported openimmo files
     * @param bool $canBeZip - if true, files can be zip archives
     * @param bool $use_post - if true the sync file from the post data will be used, else the latest unsynced file will be used
     * @return bool|null|string
     */
    public function getSyncFile($exportPath, $canBeZip = true, $use_post = true)
    {
        $folder = new \Folder($exportPath);
        $currentFile = null;
        $currentTime = 0;

        if (!$folder->isEmpty()) {
            $sync_file = $this->Input->post('tl_metamodels_openimmo_sync_file');

            if (!$use_post || ($use_post && ($sync_file == null || $sync_file == ''))) {
                //get latest file
                foreach (FilesHelper::scandirByExt($exportPath, ($canBeZip) ? array('zip', 'xml') : array('xml')) as $file) {
                    $mtime = FilesHelper::fileModTime($exportPath . '/' . $file);
                    if ($mtime > $currentTime) {
                        $currentTime = $mtime;
                        $currentFile = $exportPath . '/' . $file;
                    }
                }
            } else $currentFile = $exportPath . '/' . $sync_file;

            if (file_exists(TL_ROOT . '/' . $currentFile)) {
                //check if it is a zip, and if so unpack it
                if ($canBeZip && $this->zip_unpacked == 0 && FilesHelper::fileExt($currentFile, true, true) == 'ZIP') {
                    $this->unpackSyncFile($currentFile);
                    $currentFile = false;
                    $this->zip_unpacked = 1;
                } elseif ($this->zip_unpacked == 2) {
                    $this->zip_unpacked = 3;
                    $currentFile = $this->getSyncFile($exportPath . '/tmp', false, false);
                }
                return $currentFile;
            } else return false;
        } else return false;
    }

    /**
     * Will unpack a zip archive
     * @param string $path - path to file to unpack
     * @throws \Exception
     */
    public function unpackSyncFile($path)
    {
        $tmpFolder = new \Folder(FilesHelper::fileDirPath($path) . 'tmp');
        //clear tmp folder if not empty
        if (!$tmpFolder->isEmpty()) $tmpFolder->clear();

        $tmpPath = $tmpFolder->__get('value');

        //extract zip to tmp folder
        $zip = new \ZipReader($path);
        $files = $zip->getFileList();
        $zip->first();
        foreach ($files as $file) {
            $content = $zip->unzip();
            file_put_contents(TL_ROOT . '/' . $tmpPath . '/' . $file, $content);
            $zip->next();
        }
        //return $this->getSyncFile($tmpPath,false,false);
    }

    /**
     * Will store sync file in the history (database)
     * @param string $exportPath
     * @param array $file
     * @param string $status - status to attach to this file
     * @param string $user - (optional) username, if not set current user will be used
     */
    public function addFileToHistory($exportPath, $file, $status, $user = null)
    {
        $filetime = FilesHelper::fileModTime($exportPath . '/' . $file);
        $item = array(
            "file" => $file,
            "filetime" => $filetime,
            "synctime" => time(),
            "status" => $status,
            "user" => ($user) ? $user : $GLOBALS['TL_USERNAME']
        );
        $exists = $this->Database->execute("SELECT id,filetime FROM tl_metamodels_openimmo_history WHERE file = '$item[file]'")->fetchAssoc();
        if ($exists != false && count($exists) > 0) {
            $item["filetime"] = $exists["filetime"];
            $this->Database->prepare("UPDATE tl_metamodels_openimmo_history %s WHERE id='$exists[id]'")->set($item)->execute();
        } else $this->Database->prepare("INSERT INTO tl_metamodels_openimmo_history %s")->set($item)->execute();

    }

    /**
     * Loads the xml in a sync file
     * @param array $file
     * @return \SimpleXMLElement
     */
    public function loadData($file)
    {
        $data = file_get_contents(TL_ROOT . '/' . $file);

        // FlowFact 2014 uses 'imo:' namespace, so remove it to
        $data = str_replace('<imo:', '<', $data);
        $data = str_replace('</imo:', '</', $data);

        //remove all namespace stuff as simplexml cannot handle it reliably
        $oi_open_pos = strpos($data, '<openimmo');
        $oi_close_pos = strpos(substr($data, $oi_open_pos), '>');
        $data = substr($data, 0, $oi_open_pos) . '<openimmo>' . substr($data, $oi_close_pos + $oi_open_pos + 1);
        return simplexml_load_string($data);
    }

    /**
     * Returns all fields that need to be synced from the openimmo xml to the metamodel
     * @param string|int $id - metamodel openimmo field collection id
     * @param string $uniqueIDField - name of the xml field containing the unique ID
     * @return array
     */
    public function getSyncFields($id, $uniqueIDField)
    {
        $fields = array();
        $_fields = $this->Database->execute("SELECT mma.colname as metamodelAttribute, mmof.metamodelAttribute AS metamodelAttributeID , mmof.oiField AS oiField, mmof.oiFieldGroup as oiFieldGroup, mmof.oiDefaultValue as oiDefaultValue, mmof.oiCustomField as oiCustomField, mmof.oiConditionField as oiConditionField, mmof.oiConditionValue as oiConditionValue, mmof.oiCallback as oiCallback " .
            "FROM tl_metamodels_openimmo_fields mmof " .
            "LEFT JOIN tl_metamodel_attribute mma ON mma.id=mmof.metamodelAttribute " .
            "WHERE mmof.pid='" . $id . "'")->fetchAllAssoc();

        foreach ($_fields as $field) {
            //prevent loading missing metamodel fields
            if ($field['metamodelAttribute'] != '') {
                if (!isset($fields[$field['metamodelAttribute']])) {
                    $fields[$field['metamodelAttribute']] = array();
                }
                if ($field['oiCustomField'] != '') {
                    $field_obj = new MetaModelsOpenImmoField($field['metamodelAttribute'], $field['oiCustomField'], $field['oiDefaultValue']);

                } else {
                    $field_obj = new MetaModelsOpenImmoField($field['metamodelAttribute'], $field['oiFieldGroup'] . '/' . $field['oiField'], $field['oiDefaultValue']);
                }
                if (!empty($field['oiConditionField'])) {
                    $field_obj->setConditionField($field['oiConditionField']);
                    $field_obj->setConditionValue($field['oiConditionValue']);
                }
                if (!empty($field['oiCallback'])) {
                    $field_obj->setCallback(explode(',', $field['oiCallback'], 2));
                }
                $fields[$field['metamodelAttribute']][] = $field_obj;
            }
        }

        //add uniqueIDField
        if ($uniqueIDField != '') $fields['id'] = array(new MetaModelsOpenImmoField('id', $uniqueIDField));

        return $fields;
    }

    /**
     * Returns a flattened array containing xml field x-paths
     * @param string $oiVersion - openimmo version
     * @return array
     */
    public static function getFlattenedFields($oiVersion)
    {
        $fieldsFlat = array();
        $groups = MetaModelsOpenImmo::getFields($oiVersion);
        foreach (array_keys($groups) as $group) {
            foreach ($groups[$group] as $field) {
                $_field = MetaModelsOpenImmo::parseField($field);
                $fieldsFlat[$group . '/' . $_field['name']] = $_field['type'];
            }
        }
        return $fieldsFlat;
    }

    /**
     * Adds flattened fields to $this->fieldsFlat
     * @param string $oiVersion - openimmo version
     */
    private function flattenFields($oiVersion)
    {
        $this->fieldsFlat = MetaModelsOpenImmo::getFlattenedFields($oiVersion);
    }

    /**
     * Will sync xml-data with for metamodels object
     * @param array $data
     * @param object $metamodelObj
     * @param array $syncFields - list of fields to sync
     * @return bool - true if sync was successfull, else false
     */
    public function syncDataWithCatalog(&$data, &$metamodelObj, &$syncFields)
    {
        if ($this->dataIsValid($data)) {

            //flatten fields array temporally
            $this->flattenFields($metamodelObj['oiVersion']);

            $anbieter = $this->getAnbieter($data);

            if (count($anbieter)) {
                $xpath = 'anbieter';
                $immo_id = 0;
                $sorting = 0;

                $immos = array();

                foreach ($anbieter as $_anbieter) {
                    $immo_anbieter = array();
                    $xpath = 'anbieter';
                    $this->setImmoFields($_anbieter, $immo_anbieter, $syncFields, $xpath, $metamodelObj);

                    $immobilien = $this->getImmobilien($_anbieter);

                    $xpath = 'anbieter/immobilie';

                    foreach ($immobilien as $immobilie) {
                        $immo_id++; //generate immo id
                        $sorting++;

                        //add anbieter info to immo
                        $immo = array("id" => $immo_id, "pid" => $metamodelObj['metamodelID'], "tstamp" => time(), "sorting" => $sorting);
                        $immo = array_merge($immo_anbieter, $immo);

                        //immo info
                        $this->setImmoFields($immobilie, $immo, $syncFields, $xpath, $metamodelObj);

                        //store reference to xml-node
                        $immo['_xml_'] = $immobilie;

                        // execute
                        if (isset($GLOBALS['TL_HOOKS']['metaModelsOpenImmoSync'])) {
                            foreach ($GLOBALS['TL_HOOKS']['metaModelsOpenImmoSync'] as $callback)
                            {
                                $this->import($callback[0]);
                                $immo = $this->$callback[0]->$callback[1]($immo);
                            }
                        }

                        $immos[] = $immo;
                    }
                }
                $this->addMessage("found " . count($immos) . " objects");

                return $this->updateCatalog($immos, $metamodelObj);
            } else return false;
        } else {
            $this->addMessage('invalid OpenImmo data');
            return false;
        }
    }

    /**
     * Checks if xml data is valid
     * @param SimpleXml $data
     * @return bool
     */
    private function dataIsValid(&$data)
    {
        if ($data->getName() == 'openimmo') {
            $anbieter = $data->xpath('anbieter');
            if (count($anbieter)) {
                return true;
            } else return false;
        } else return false;
    }

    /**
     * Sets fields from the openimmo xml to the $immo array based on the $metamodelObj
     * @param SimpleXml $xml
     * @param array $immo
     * @param array $fields
     * @param string $xpath - base x-path to use
     * @param object $metamodelObj
     */
    private function setImmoFields(&$xml, &$immo, &$fields, $xpath, &$metamodelObj)
    {
        foreach (array_keys($fields) as $metamodelAttribute) {
            foreach ($fields[$metamodelAttribute] as $field_obj) {
                // prevent setting immo fields to anbieter
                if ($xpath === 'anbieter' && strpos($field_obj->getField(), 'anbieter/immobilie') === 0) {
                    continue;
                }

                $value = $this->getFieldData($xml, $field_obj->getField(), $xpath, $metamodelObj, false);

                if ($field_obj->hasCondition()) {
                    $condition_value = $this->getFieldData($xml, $field_obj->getConditionField(), $xpath, $metamodelObj, false);

                    // both value and condition value are not arrays
                    if (!is_array($condition_value)) {
                        // if not equal set value to null
                        if ($condition_value != $field_obj->getConditionValue()) {
                            $value = null;
                        }
                    } // value and condition are arrays, so we have to compare each value item against the corresponding condition value item
                    elseif (is_array($value) && is_array($condition_value)) {
                        foreach ($value as $i => $value_item) {
                            // if not equal we have to remove the value item
                            if (isset($condition_value[$i]) && $condition_value[$i] != $field_obj->getConditionValue()) {
                                unset($value[$i]);
                            }
                        }
                        // reindex array
                        $_value = array();
                        foreach ($value as $value_item) {
                            $_value[] = $value_item;
                        }
                        $value = $_value;
                    }
                }

                if ($field_obj->hasCallback()) {

                    $return_value = call_user_func_array($field_obj->getCallback(), array($value, $field_obj, &$immo, &$xml, $xpath, $metamodelAttribute));

                    // prevent setting value to false when call_user_func_array produced an error
                    if ($return_value) {
                        $value = $return_value;
                    }
                }

                if ($value != null) {
                    if (is_array($value)) {
                        $value = serialize($value);
                    }
                } // set default as fallback if any
                elseif (empty($value) && $field_obj->hasDefaultValue()) {
                    $value = $field_obj->getDefaultValue();
                } // no default an not existing in import, set to empty string
                else {
                    $value = '';
                }

                $immo[$metamodelAttribute] = $value;
            }
        }
    }

    /**
     * Returns data for an openimmo xml field
     * @param SimpleXml $xml
     * @param string $fieldPath - relative field x-path
     * @param string $xpath - base x-path
     * @param object $metamodelObj
     * @param bool $serialize
     * @return null|string
     */
    private function getFieldData(&$xml, $fieldPath, $xpath, &$metamodelObj, $serialize = true)
    {
        $attr_pos = strpos($fieldPath, '@');
        if ($attr_pos != FALSE) {
            $attr = substr($fieldPath, $attr_pos + 1);
            $fieldPath = substr($fieldPath, 0, $attr_pos);
        }

        $xpath_part = str_replace($xpath . '/', '', $fieldPath);

        $results = $xml->xpath($xpath_part);

        $count = count($results);

        if ($count) {
            for ($i = 0; $i < $count; $i++) {
                if ($attr) {
                    $attributes = $results[$i]->attributes();
                    $results[$i] = $attributes[$attr];
                }
                $results[$i] = $this->parseFieldType($fieldPath, $results[$i] . '', $metamodelObj);
            }

            // Contao 3 has FileModels
            if (VERSION > 2) {
                if (isset($this->fieldsFlat[$fieldPath]) && $this->fieldsFlat[$fieldPath] == 'path') {
                    $files = \FilesModel::findMultipleByPaths($results);
                    $results = array();

                    if ($files) {
                        foreach($files->getModels() as $i => $file) {
                            //var_dump($file);
                            $results[] = $file->uuid;
                        }
                    }

                    return serialize($results);
                }
            }

            if ($count == 1) {
                return $results[0];
            } elseif ($count > 1) {
                if ($serialize) {
                    return serialize($results);
                } else {
                    return $results;
                }
            }
        }

        return null;
    }

    /**
     * Returns the <anbieter> Xml object
     * @param SimpleXml $xml
     * @return mixed
     */
    private function getAnbieter(&$xml)
    {
        return $xml->xpath('anbieter');
    }

    /**
     * Returns all <immobilie> Xml objects
     * @param SimpleXml $xml
     * @return mixed
     */
    private function getImmobilien(&$xml)
    {
        return $xml->xpath('immobilie');
    }

    /**
     * Converts XML string values to real data types in place
     * @param array $data
     */
    private function convertDataValues(&$data)
    {
        foreach (array_keys($data) as $key) {
            switch ($data[$key]) {
                case 'true':
                    $data[$key] = 1;
                    break;

                case 'false':
                    $data[$key] = 0;
                    break;
            }
        }
    }

    /**
     * Updates the database with items retrieved from an openimmo xml
     * @param array $items
     * @param object $metamodelObj
     * @return bool - true if update was successfull else false
     */
    private function updateCatalog(&$items, $metamodelObj)
    {
        $metamodel = $metamodelObj['metamodel'];

        foreach ($items as &$item) {
            //check if entry already exists
            $exists = $this->Database->execute("SELECT COUNT(id) FROM $metamodel WHERE id='" . $item['id'] . "'")->fetchAssoc();

            //remove if deleteAction is in use
            $deleted = $this->getFieldData($item['_xml_'], MetaModelsOpenImmo::$deleteActionField[$metamodelObj['oiVersion']]['path'], 'anbieter/immobilie', $metamodelObj);
            $deleted = ($deleted == MetaModelsOpenImmo::$deleteActionField[$metamodelObj['oiVersion']]['value']) ? true : false;

            $this->convertDataValues($item);

            if (intval($exists['COUNT(id)']) > 0) {
                //remove old entry if one exists and this should be deleted
                if ($deleted) {
                    $this->Database->execute("DELETE FROM $metamodel WHERE id='" . $item['id'] . "'");
                    $this->addMessage("deleted object: " . $item['id']);
                } else {
                    $id = $item['id'];
                    unset($item['id']);
                    unset($item['_xml_']);
                    $this->Database->prepare("UPDATE $metamodel %s WHERE id='$id'")->set($item)->execute();
                }
            } elseif (!$deleted) {
                unset($item['_xml_']);
                $this->Database->prepare("INSERT INTO $metamodel %s")->set($item)->execute();
            }
        }
        return true;
    }

    /**
     * Syncs a openimmo xml with the database
     * @param object $metamodelObj
     * @param string $dataFile
     * @return bool - true if sync was successful else false
     */
    public function syncDataFiles(&$metamodelObj, $dataFile)
    {
        $dataPath = FilesHelper::fileDirPath($dataFile);

        //get attachments in the data folder
        $files = FilesHelper::scandirByExt($dataPath, explode(',', MetaModelsOpenImmo::$allowedAttachments));

        $filesFolder = new \Folder($metamodelObj['filesPath']);

        if (FilesHelper::isWritable($metamodelObj['filesPath'])) {

            //remove old files
            //$filesFolder->clear();

            $filesObj = \Files::getInstance();

            foreach ($files as $file) {
                $filesObj->copy($dataPath . $file, $metamodelObj['filesPath'] . '/' . $file);
            }
            $this->addMessage('copied ' . count($files) . ' files from temporary directory to: ' . $metamodelObj['filesPath']);
        } else $this->addMessage('cannot copy temporary files: ' . $metamodelObj['filesPath'] . ' not writable');

        //empty the data directory if it is the temp directory so we do not have files doubled
        if (substr($dataPath, -4) == 'tmp/') {
            $dataFolder = new \Folder($dataPath);
            if (VERSION > 2) {
                $dataFolder->purge();
            }
            else {
                $dataFolder->clear();
            }
            $this->addMessage('emptied temporary directory: ' . $dataPath);
        }

        // Since Contao 3 files must be synced with database
        if (VERSION > 2) {
            $updater = new \Contao\Database\Updater();
            $updater->scanUploadFolder();
        }

        return true;
    }

    /**
     * Adds a flash message, which will be displayed to the user
     * @param string $msg
     * @param string $strType - (default = TL_INFO)
     */
    protected function addMessage($msg, $strType = TL_INFO)
    {
        $this->messages[] = $msg;
    }

    /**
     * Returns all flash messages
     * @param bool $blnDcLayout
     * @param bool $blnNoWrapper
     * @return string
     */
    protected function getMessages($blnDcLayout = false, $blnNoWrapper = false)
    {
        $strMsg = '';

        foreach ($this->messages as $msg) {
            $strMsg .= $msg . "<br/>\n";
        }
        return $strMsg;
    }
}

?>