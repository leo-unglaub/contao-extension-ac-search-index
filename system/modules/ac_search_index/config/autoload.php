<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Ac_search_index
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'ModuleAcSearchIndex' => 'system/modules/ac_search_index/modules/ModuleAcSearchIndex.php',

	// Classes
	'AcSearchIndex'       => 'system/modules/ac_search_index/classes/AcSearchIndex.php',
	'AcSearchIndexCron'   => 'system/modules/ac_search_index/classes/AcSearchIndexCron.php',
	'AcSearchIndexHelper' => 'system/modules/ac_search_index/classes/AcSearchIndexHelper.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_ac_search_index' => 'system/modules/ac_search_index/templates',
));
