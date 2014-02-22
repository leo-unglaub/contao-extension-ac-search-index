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
 * Class AcSearchIndexHelper
 * Provide helper methods for the auto completer
 * 
 * @copyright  Leo Unglaub 2012
 * @author     Leo Unglaub <leo@leo-unglaub.net>
 * @package    ac_search_index
 * @license    LGPL
 */
class AcSearchIndexHelper extends Controller
{
	/**
	 * save_callback
	 * prepare the ignore words for the database storage
	 * 
	 * @param string $varValue
	 * @param DataContainer $dc
	 * @return string
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
	 * prepare the ignore words for the text field
	 * 
	 * @param string $varValue
	 * @param DataContainer $dc
	 * @return string
	 */
	public function loadIgnoreWords($varValue, DataContainer $dc)
	{
		return str_replace(',', ', ', $varValue);
	}


	/**
	 * Return all used languages in the search index
	 * 
	 * @param void
	 * @return array
	 */
	public function getSiteLanguages()
	{
		$this->import('Database');
		$this->loadLanguageFile('languages');

		$arrReturn = array();

		$objLanguages = $this->Database->query('SELECT DISTINCT language FROM tl_search_index');
		while ($objLanguages->next())
		{
			// get the translated language name
			$arrReturn[$objLanguages->language] = $GLOBALS['TL_LANG']['LNG'][$objLanguages->language];
		}

		return $arrReturn;
	}


	/**
	 * Return all root pages
	 * 
	 * @param void
	 * @return array
	 */
	public function getRootSites()
	{
		$this->import('Database');

		$arrReturn = array();
		$objRootSites = $this->Database->query('SELECT id,title,dns FROM tl_page WHERE type="root"');

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

?>