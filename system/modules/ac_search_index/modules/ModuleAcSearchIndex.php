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
 * Class ModuleAcSearchIndex
 * Provide helper methods for the auto completer
 *
 * @copyright  Leo Unglaub 2012
 * @author     Leo Unglaub <leo@leo-unglaub.net>
 * @package    ac_search_index
 * @license    LGPL
 */
class ModuleAcSearchIndex extends Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_ac_search_index';


	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### WEBSITE SEARCH - AUTO COMPLETER ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{
		// create the new Auto Completer object
		$objAutoCompleter = new AutoCompleter();
		$objAutoCompleter->formId = 'ctrl_keywords_' . $this->id;
		$objAutoCompleter->minLength = $this->ac_si_minLength;
		$objAutoCompleter->width = $this->ac_si_width;
		$objAutoCompleter->maxChoices = $this->ac_si_maxChoices;
		$objAutoCompleter->zIndex = $this->ac_si_zIndex;
		$objAutoCompleter->delay = $this->ac_si_delay;
		$objAutoCompleter->autoSubmit = $this->ac_si_autoSubmit;
		$objAutoCompleter->selectFirst = $this->ac_si_selectFirst;
		$objAutoCompleter->multiple = $this->ac_si_multiple;
		$objAutoCompleter->separator = ($this->ac_si_separator == '') ? ' ' : $this->ac_si_separator;
		$objAutoCompleter->autoTrim = $this->ac_si_autoTrim;
		$objAutoCompleter->relative = $this->ac_si_relative;
		$objAutoCompleter->generate();


		// get the "jump to" page
		$objJumpTo = $this->Database->prepare('SELECT id,alias FROM tl_page WHERE id=?')
									->limit(1)
									->execute($this->jumpTo);

		// add the jumpTo Url
		if ($objJumpTo->numRows == 1)
		{
			$arrJumpTo = (array) $objJumpTo->fetchAssoc();
			$this->Template->action = $this->generateFrontendUrl($arrJumpTo);
		}

		// add some values to the template
		$this->Template->uniqueId = 'ctrl_keywords_' . $this->id;
		$this->Template->search = specialchars($GLOBALS['TL_LANG']['MSC']['searchLabel']);
		$this->Template->defaultValue = $this->ac_si_defaultValue;
		$this->Template->hideSubmitButton = $this->ac_si_hide_submit_button;
	}
}
