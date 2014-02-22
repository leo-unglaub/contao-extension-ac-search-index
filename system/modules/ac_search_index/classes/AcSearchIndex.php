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
 * Class AcSearchIndex
 * Provide methods to get auto completer choices
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
		$objDb = Database::getInstance();
		$intAcid = str_replace('ctrl_keywords_', '', Input::get('acid'));


		// try loading all settings from tl_module
		$objAcModule = $objDb->prepare('SELECT ac_si_language,ac_si_root_sites,ac_si_blacklist,ac_si_maxChoices FROM tl_module WHERE type="ac_search_index" AND id=?')
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
			$arrValues[] = '%' . strtolower(Input::post('value')) . '%';

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
			$objKeyword = $objDb->prepare('SELECT DISTINCT word FROM tl_search_index WHERE ' . implode(' AND ', $arrWhere) . ' ORDER BY relevance DESC')
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
