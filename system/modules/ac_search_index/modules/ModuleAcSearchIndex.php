<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
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
 * @copyright  Leo Unglaub 2012
 * @author     Leo Unglaub <leo@leo-unglaub.net>
 * @package    ac_search_index
 * @license    LGPL
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

?>
