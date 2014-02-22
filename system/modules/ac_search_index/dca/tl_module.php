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
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['ac_search_index'] = '
{title_legend},name,headline,type;
{ac_search_index_legend},ac_si_language,ac_si_root_sites,ac_si_blacklist,ac_si_minLength,ac_si_width,ac_si_maxChoices,ac_si_zIndex,ac_si_delay,ac_si_separator,ac_si_defaultValue,ac_si_autoSubmit,ac_si_selectFirst,ac_si_multiple,ac_si_autoTrim,ac_si_hide_submit_button,ac_si_relative;
{redirect_legend},jumpTo;
{protected_legend:hide},protected;
{expert_legend:hide},guests,cssID,space';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['ac_si_language'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_module']['ac_si_language'],
	'exclude'			=> true,
	'inputType'			=> 'checkbox',
	'options_callback'	=> array('AcSearchIndexHelper', 'getSiteLanguages'),
	'eval'				=> array('tl_class'=>'long clr', 'multiple'=>true)
);

$GLOBALS['TL_DCA']['tl_module']['fields']['ac_si_root_sites'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_module']['ac_si_root_sites'],
	'exclude'			=> true,
	'inputType'			=> 'checkbox',
	'options_callback'	=> array('AcSearchIndexHelper', 'getRootSites'),
	'eval'				=> array('tl_class'=>'long clr', 'multiple'=>true)
);

$GLOBALS['TL_DCA']['tl_module']['fields']['ac_si_blacklist'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_module']['ac_si_blacklist'],
	'exclude'			=> true,
	'inputType'			=> 'textarea',
	'load_callback'		=> array(array('AcSearchIndexHelper', 'loadIgnoreWords')),
	'save_callback'		=> array(array('AcSearchIndexHelper', 'saveIgnoreWords')),
	'eval'				=> array('tl_class'=>'clr long', 'style'=>'height:100px;')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['ac_si_minLength'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_module']['ac_si_minLength'],
	'exclude'			=> true,
	'inputType'			=> 'text',
	'default'			=> 2,
	'eval'				=> array('tl_class'=>'w50', 'rgxp'=>'digit')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['ac_si_width'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_module']['ac_si_width'],
	'exclude'			=> true,
	'inputType'			=> 'text',
	'default'			=> 'inherit',
	'eval'				=> array('tl_class'=>'w50', 'rgxp'=>'alnum')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['ac_si_maxChoices'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_module']['ac_si_maxChoices'],
	'exclude'			=> true,
	'inputType'			=> 'text',
	'default'			=> 10,
	'eval'				=> array('tl_class'=>'w50', 'rgxp'=>'digit')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['ac_si_zIndex'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_module']['ac_si_zIndex'],
	'exclude'			=> true,
	'inputType'			=> 'text',
	'default'			=> 42,
	'eval'				=> array('tl_class'=>'w50', 'rgxp'=>'alnum')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['ac_si_delay'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_module']['ac_si_delay'],
	'exclude'			=> true,
	'inputType'			=> 'text',
	'default'			=> 400,
	'eval'				=> array('tl_class'=>'w50', 'rgxp'=>'alnum')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['ac_si_autoSubmit'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_module']['ac_si_autoSubmit'],
	'exclude'			=> true,
	'inputType'			=> 'checkbox',
	'default'			=> 0,
	'eval'				=> array('tl_class'=>'w50 m12 clr')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['ac_si_selectFirst'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_module']['ac_si_selectFirst'],
	'exclude'			=> true,
	'inputType'			=> 'checkbox',
	'default'			=> 0,
	'eval'				=> array('tl_class'=>'w50 m12')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['ac_si_multiple'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_module']['ac_si_multiple'],
	'exclude'			=> true,
	'inputType'			=> 'checkbox',
	'default'			=> 0,
	'eval'				=> array('tl_class'=>'w50 m12')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['ac_si_separator'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_module']['ac_si_separator'],
	'exclude'			=> true,
	'inputType'			=> 'text',
	'default'			=> ' ',
	'eval'				=> array('tl_class'=>'w50', 'rgxp'=>'alnum', 'maxlength'=>250)
);

$GLOBALS['TL_DCA']['tl_module']['fields']['ac_si_autoTrim'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_module']['ac_si_autoTrim'],
	'exclude'			=> true,
	'inputType'			=> 'checkbox',
	'default'			=> 0,
	'eval'				=> array('tl_class'=>'w50 m12')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['ac_si_defaultValue'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_module']['ac_si_defaultValue'],
	'exclude'			=> true,
	'inputType'			=> 'text',
	'eval'				=> array('tl_class'=>'w50', 'rgxp'=>'alnum', 'maxlength'=>250)
);

$GLOBALS['TL_DCA']['tl_module']['fields']['ac_si_hide_submit_button'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_module']['ac_si_hide_submit_button'],
	'exclude'			=> true,
	'inputType'			=> 'checkbox',
	'default'			=> 0,
	'eval'				=> array('tl_class'=>'w50 m12')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['ac_si_relative'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_module']['ac_si_relative'],
	'exclude'			=> true,
	'inputType'			=> 'checkbox',
	'default'			=> 0,
	'eval'				=> array('tl_class'=>'w50 m12')
);
