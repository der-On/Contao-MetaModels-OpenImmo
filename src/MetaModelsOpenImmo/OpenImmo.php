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
 * Class OIFields
 *
 * @copyright  Ondrej Brinkel 2014
 * @author     Ondrej Brinkel
 * @package    Controller
 */
class OpenImmo
{

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
      '1.2.6' => array('path' => 'anbieter/immobilie/verwaltung_techn/aktion@aktionart', 'value' => 'DELETE'),
      '1.2.7' => array('path' => 'anbieter/immobilie/verwaltung_techn/aktion@aktionart', 'value' => 'DELETE'),
  );

  /**
   * Returns a list of supported openimmo versions
   * @return array
   */
  public static function getSupportedVersions()
  {
      return array(
        '1.2.1',
        '1.2.2',
        '1.2.3',
        '1.2.4',
        '1.2.5',
        '1.2.6',
        '1.2.7',
      );
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

          case '1.2.6':
              $fields = array_merge_recursive(self::getFields('1.2.4'), array(
                'anbieter/immobilie/preise' => array(
                    'kaufpreisnetto:float',
                    'kaufpreisnetto@kaufpreisust:float',
                    'kaufpreisbrutto:float',
                    'hauptmietzinsnetto:float',
                    'hauptmietzinsnetto@hauptmietzinsust:float',
                    'pauschalmiete:float',
                    'betriebskostennetto:float',
                    'betriebskostennetto@betriebskostenust:float',
                    'evbnetto:float',
                    'evbnetto@evbust:float',
                    'gesamtmietenetto:float',
                    'gesamtmietenetto@gesamtmieteust:float',
                    'gesamtmietebrutto:float',
                    'gesamtbelastungnetto:float',
                    'gesamtbelastungnetto@gesamtbelastungust:float',
                    'gesamtbelastungbrutto:float',
                    'gesamtkostenprom2von:float',
                    'gesamtkostenprom2von@gesamtkostenprom2bis:float',
                    'heizkostennetto:float',
                    'heizkostennetto@heizkostenust:float',
                    'monatlichekostennetto:float',
                    'monatlichekostennetto@monatlichekostenust:float',
                    'monatlichekostenbrutto:float',
                    'nebenkostenprom2von:float',
                    'nebenkostenprom2von@nebenkostenprom2bis:float',
                    'ruecklagenetto:float',
                    'ruecklagenetto@ruecklageust:float',
                    'sonstigekostennetto:float',
                    'sonstigekostennetto@sonstigekostenust:float',
                    'sonstigemietenetto:float',
                    'sonstigemietenetto@sonstigemieteust:float',
                    'summemietenetto:float',
                    'summemietenetto@summemieteust:float',
                    'nettomieteprom2von:float',
                    'nettomieteprom2von@nettomieteprom2bis:float',
                    'provisionnetto:float',
                    'provisionnetto@provisionust:float',
                    'provisionbrutto:float',
                    'richtpreis:float',
                    'richtpreisprom2:float',
                ),
                'anbieter/immobilie/versteigerung' => array(
                    'zwangsversteigerung:bool'
                ),
                'anbieter/immobilie/flaechen' => array(
                    'kubatur:float',
                    'ausnuetzungsziffer:float',
                    'flaechevon:float',
                    'flaechebis:float',
                ),
                'anbieter/immobilie/zustand_angaben' => array(
                    'bauzone:string',
                ),
                'anbieter/immobilie/ausstattung' => array(
                  'boden@GRANIT:bool',
                  'energietyp@MINERGIEBAUWEISE:bool',
                  'energietyp@MINERGIE_ZERTIFIZIERT:bool',
                ),
                'anbieter/immobilie/zustand_angaben' => array(
                  'bauzone:string',
                ),
              ));
              return $fields;
              break;

          case '1.2.7':
              $fields = array_merge_recursive(self::getFields('1.2.6'), array(
                'anbieter/immobilie/freitexte' => array(
                    'objekt_text:string',
                ),
                'anbieter/immobilie/ausstattung' => array(
                  'befeuerung@KOHLE:bool',
                  'befeuerung@HOLZ:bool',
                  'befeuerung@FLUESSIGGAS:bool',
                ),
                'anbieter/immobilie/zustand_angaben' => array(
                  'energiepass/primaerenergietraeger:string',
                  'energiepass/stromwert:string',
                  'energiepass/waermewert:string',
                  'energiepass/wertklasse:string',
                  'energiepass/baujahr:string',
                  'energiepass/ausstelldatum:string',
                  'energiepass/gebaeudeart:string',
                  'energiepass/epasstext:string',
                )
              ));
              return $fields;
              break;

          default:
              return self::getFields('1.2.1');
      }
  }

  /**
   * Returns a normalized group of field definitions as returned by getFields
   * @param string $oiVersion - openimmo version
   * @param string $group - group name e.g. 'anbieter'
   * @return array
   */
  public static function getFieldsByGroup($oiVersion, $group)
  {
      $groups = self::getFields($oiVersion);

      if (isset($groups[$group])) {
          $fields = self::parseFields($groups[$group]);
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
      $fields = self::getFields($oiVersion);
      foreach (array_keys($fields) as $group) {
          $groups[] = $group;
      }
      sort($groups);

      return $groups;
  }

  /**
   * Returns a flattened array containing xml field x-paths
   * @param string $oiVersion - openimmo version
   * @return array
   */
  public static function getFlattenedFields($oiVersion)
  {
      $fieldsFlat = array();
      $groups = self::getFields($oiVersion);
      foreach (array_keys($groups) as $group) {
          foreach ($groups[$group] as $field) {
              $_field = self::parseField($field);
              $fieldsFlat[$group . '/' . $_field['name']] = $_field['type'];
          }
      }
      return $fieldsFlat;
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
   * Parses/Normalizes a field definitions group as returned by getFields()
   * @param array $group
   * @see parseField
   * @return array
   */
  public static function parseFields(&$group)
  {
      $fields = array();
      foreach ($group as $field) {
          $fields[] = self::parseField($field);
      }
      return $fields;
  }
}
