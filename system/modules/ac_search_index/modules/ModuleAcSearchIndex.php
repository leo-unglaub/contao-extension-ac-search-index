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
		$objAc = new AutoCompleter();
		$objAc->formId = 'ctrl_keywords_' . $this->id;
		$objAc->minLength = $this->ac_si_minLength;
		$objAc->width = $this->ac_si_width;
		$objAc->maxChoices = $this->ac_si_maxChoices;
		$objAc->zIndex = $this->ac_si_zIndex;
		$objAc->delay = $this->ac_si_delay;
		$objAc->autoSubmit = $this->ac_si_autoSubmit;
		$objAc->selectFirst = $this->ac_si_selectFirst;
		$objAc->multiple = $this->ac_si_multiple;
		$objAc->separator = ($this->ac_si_separator == '') ? ' ' : $this->ac_si_separator;
		$objAc->autoTrim = $this->ac_si_autoTrim;
		$objAc->relative = $this->ac_si_relative;
		$objAc->generate();


		// add the jumpTo Url
		if ($this->jumpTo > 0)
		{
			$objJumpTo = PageModel::findPublishedById($this->jumpTo);
			$this->Template->action = $objJumpTo->getFrontendUrl();
		}


		// add some values to the template
		$this->Template->uniqueId = 'ctrl_keywords_' . $this->id;
		$this->Template->search = specialchars($GLOBALS['TL_LANG']['MSC']['searchLabel']);
		$this->Template->defaultValue = $this->ac_si_defaultValue;
		$this->Template->hideSubmitButton = $this->ac_si_hide_submit_button;
	}
}
