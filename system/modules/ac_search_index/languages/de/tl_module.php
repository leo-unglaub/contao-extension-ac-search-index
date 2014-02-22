<?php

/**
 * Contao Open Source CMS
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @copyright	Leo Unglaub 2014
 * @author		Leo Unglaub <leo@leo-unglaub.net>
 * @package		ac_search_index
 * @license		GPL
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_module']['ac_si_language']		= array('Sprachen', 'Bitte wählen Sie alle Sprachen aus die Verwendet werden sollen.');
$GLOBALS['TL_LANG']['tl_module']['ac_si_root_sites']	= array('Root-Seiten', 'Bitte wählen Sie alle Webseitenstartpunkte aus welche für die Such-Vorschläge verwendet werden sollen. Wenn Sie keine Seiten auswählen werden alle verfügbaren Seiten verwendet.');
$GLOBALS['TL_LANG']['tl_module']['ac_si_blacklist']		= array('Sperrliste', 'Hier können Sie eine komma getrennte Liste von Wörtern eingeben welche nicht vervollständigt werden sollen.');
$GLOBALS['TL_LANG']['tl_module']['ac_si_minLength']		= array('Mindestlänge', 'Bitte geben Sie eine Mindestlänge ein. Erst wenn diese Anzahl von Buchstaben überschritten wird, werdne Such-Vorschläge angezeigt.');
$GLOBALS['TL_LANG']['tl_module']['ac_si_width']			= array('Breite', 'Bitte geben Sie eine Breite der Suchvorschläge ein.');
$GLOBALS['TL_LANG']['tl_module']['ac_si_maxChoices']	= array('Maximale Vorschläge', 'Bitte geben Sie an wie viele Suchvorschläge auf einmal angezeigt werden sollen.');
$GLOBALS['TL_LANG']['tl_module']['ac_si_zIndex']		= array('zIndex', 'Bitte geben Sie einen zIndex für die Vorschläge an.');
$GLOBALS['TL_LANG']['tl_module']['ac_si_delay']			= array('Verzögerung', 'Bitte geben Sie die Verzögerung (in Milisekunden) an. Erst wenn keine neuen Buchstaben mehr eingegeben werden wird nach Ablauf der Verzögerung der Ajax Request gestartet.');
$GLOBALS['TL_LANG']['tl_module']['ac_si_autoSubmit']	= array('automatisch Abschicken', 'Aktivieren Sie diese Option um das Suchformular automatisch nach der Auswahl eines Treffers abzuschicken.');
$GLOBALS['TL_LANG']['tl_module']['ac_si_selectFirst']	= array('ersten Treffer markieren', 'Aktivieren Sie diese Option um den ersten Treffer automatisch zu markieren.');
$GLOBALS['TL_LANG']['tl_module']['ac_si_multiple']		= array('mehrere Wörter erlauben', 'Aktivieren Sie diese Option um mehrere Wörter zu erlauben. Das Trennzeichen können Sie weiter oben definieren.');
$GLOBALS['TL_LANG']['tl_module']['ac_si_separator']		= array('Trennzeichen', 'Bitte geben Sie das Trennzeichen ein, dass verwendet werden soll wenn mehrere Wörter erlaubt sind.');
$GLOBALS['TL_LANG']['tl_module']['ac_si_autoTrim']		= array('Leerzeichen entfernen', 'Aktivieren Sie diese Option um Leerzeichen vor und am ende eines Wortes automatisch zu entfernen.');
$GLOBALS['TL_LANG']['tl_module']['ac_si_defaultValue']	= array('Standardwert', 'Bitte geben Sie einen Standard-Wert für das Suchformular ein. Dieser Wert wird automatisch entfernt sobald das Feld den "fokus" bekommt.');
$GLOBALS['TL_LANG']['tl_module']['ac_si_hide_submit_button'] = array('Absendebutton entfernen', 'Aktivieren Sie diese Option um den Absendebutton aus dem Template zu entfernen.');
$GLOBALS['TL_LANG']['tl_module']['ac_si_relative']		= array('Vorschläge relativ hinzufügen', 'Aktivieren Sie diese Option um die Vorschläge relativ zum Such-Feld in den DOM einzufügen. Andernfalls werden die Ergebnisse am Ende der Seite eingefügt und absolut positioniert.');


/**
 * Palettes
 */
$GLOBALS['TL_LANG']['tl_module']['ac_search_index_legend'] = 'Auto Vervollständigung';
