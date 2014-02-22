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
 * Class AcSearchIndexHelper
 * Provide helper methods for the auto completer
 */
class AcSearchIndexHelper extends Controller
{
	/**
	 * save_callback
	 * Prepare the ignore words for the database storage.
	 *
	 * @param	string 			$varValue	The value that needs cleaning.
	 * @param	DataContainer	$dc			The current data container object.
	 * @return	string						The cleaned value for the database.
	 */
	public function saveIgnoreWords($varValue, DataContainer $dc)
	{
		$arrTmp = trimsplit(',', $varValue);
		$arrTmp = array_unique($arrTmp);
		$arrTmp = array_diff($arrTmp, array(''));

		sort($arrTmp);

		$strReturn = implode(',', $arrTmp);
		$strReturn = strtolower($strReturn);

		return $strReturn;
	}


	/**
	 * load_callback
	 * Prepare the ignore words for the text field.
	 *
	 * @param	string 			$varValue	The original value.
	 * @param	DataContainer	$dc			The current data container object.
	 * @return	string						The modified value.
	 */
	public function loadIgnoreWords($varValue, DataContainer $dc)
	{
		return str_replace(',', ', ', $varValue);
	}


	/**
	 * Return all used languages in the search index.
	 *
	 * @param	void
	 * @return	array	A translated array with all languages.
	 */
	public function getSiteLanguages()
	{
		// get all languages for the translation
		$this->loadLanguageFile('languages');

		// define some variables
		$arrReturn = array();
		$objDb = Database::getInstance();


		// get all used languages from the search index
		$objLanguages = $objDb->query('SELECT DISTINCT language FROM tl_search_index');

		// get the translation for all languages
		while ($objLanguages->next())
		{
			$arrReturn[$objLanguages->language] = $GLOBALS['TL_LANG']['LNG'][$objLanguages->language];
		}

		return $arrReturn;
	}


	/**
	 * Return all root pages.
	 *
	 * @param	void
	 * @return	array	An array with all root pages
	 */
	public function getRootSites()
	{
		// define some variables
		$objDb = Database::getInstance();
		$arrReturn = array();


		$objRootSites = $objDb->query('SELECT id,title,dns FROM tl_page WHERE type="root"');

		// prepare the root sites
		while ($objRootSites->next())
		{
			$strValue = $objRootSites->title;

			// add the url as a link to the template
			if ($objRootSites->dns != '')
			{
				$strValue .= ' (<a href="http://' . $objRootSites->dns . '" title="' . $objRootSites->title . '">' . $objRootSites->dns . '</a>)';
			}

			$arrReturn[$objRootSites->id] = $strValue;
		}

		return $arrReturn;
	}
}
