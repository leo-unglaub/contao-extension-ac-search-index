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
 * Class AcSearchIndex
 * Provide methods to get auto completer choices
 * 
 * @copyright  Leo Unglaub 2012
 * @author     Leo Unglaub <leo@leo-unglaub.net>
 * @package    ac_search_index
 * @license    LGPL
 */
class AcSearchIndex extends System
{
	/**
	 * Return all search index choices based on the requested modul
	 * 
	 * @param void
	 * @return array
	 */
	public function getChoices()
	{
		$this->import('Database');
		$intAcid = str_replace('ctrl_keywords_', '', $this->Input->get('acid'));

		// try loading all settings from tl_module
		$objAcModule = $this->Database->prepare('SELECT ac_si_language,ac_si_root_sites,ac_si_blacklist,ac_si_maxChoices FROM tl_module WHERE type="ac_search_index" AND id=?')
									  ->limit(1)
									  ->executeUncached($intAcid);

		// check if we found the module
		if ($objAcModule->numRows == 1)
		{
			$arrWhere = array();
			$arrValues = array();

			$arrLanguages = (array) deserialize($objAcModule->ac_si_language);
			$arrRootPages = (array) deserialize($objAcModule->ac_si_root_sites);


			// the main condition
			$arrWhere[] = 'word LIKE ?';
			$arrValues[] = '%' . strtolower($this->Input->post('value')) . '%';

			// the blacklist
			if (strlen($objAcModule->ac_si_blacklist) > 0)
			{
				$arrWhere[] = 'word NOT IN(?)';
				$arrValues[] = $objAcModule->ac_si_blacklist;
			}

			// the language check
			if ($arrLanguages[0] != '')
			{
				$arrWhere[] = 'language IN(?)';
				$arrValues[] = implode(',', $arrLanguages);
			}

			// the root site check
			if ($arrRootPages[0] != '')
			{
				$arrWhere[] = 'rootPage IN(?)';
				$arrValues[] = implode(',', $arrRootPages);
			}


			// get all keywords from the database
			$objKeyword = $this->Database->prepare('SELECT DISTINCT word FROM tl_search_index WHERE ' . implode(' AND ', $arrWhere) . ' ORDER BY relevance DESC')
										 ->limit($objAcModule->ac_si_maxChoices)
										 ->executeUncached($arrValues);

			// if we found some choices, return them
			if ($objKeyword->numRows > 0)
			{
				return $objKeyword->fetchEach('word');
			}
		}
	}
}

?>
