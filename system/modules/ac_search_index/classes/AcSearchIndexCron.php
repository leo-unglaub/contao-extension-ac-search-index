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
 * Class AcSearchIndexCron
 * Provide methods to manipulate the search index
 */
class AcSearchIndexCron extends Controller
{
	/**
	 * Update all keywords in the search index where the root id is
	 * missing.
	 *
	 * @param	int		$intLimit	The max amount of entries per run.
	 * @return	void
	 */
	public function setMissingRootIds($intLimit=50)
	{
		$objDb = Database::getInstance();

		// get all entry's witch have no rootId
		$objSearchIndex = $objDb->prepare('SELECT DISTINCT s.pid as pageId FROM tl_search s JOIN tl_search_index i ON i.pid=s.id WHERE i.rootPage=0')
								->limit($intLimit)
								->execute();

		while ($objSearchIndex->next())
		{
			// get the root id of the current site
			$objPage = PageModel::findWithDetails($objSearchIndex->pageId);

			// store the root id in the search index
			$objDb->prepare('UPDATE tl_search_index i JOIN tl_search s ON i.pid=s.id SET i.rootPage=? WHERE s.pid=?')
				  ->execute($objPage->rootId, $objSearchIndex->pageId);
		}
	}
}
