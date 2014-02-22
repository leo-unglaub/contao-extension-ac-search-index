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
 * Hooks
 */
$GLOBALS['TL_HOOKS']['getAutoCompleterChoices'][] = array('AcSearchIndex', 'getChoices');


/**
 * Cron
 */
$GLOBALS['TL_CRON']['hourly'][] = array('AcSearchIndexCron', 'setMissingRootIds');


/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['application']['ac_search_index'] = 'ModuleAcSearchIndex';
