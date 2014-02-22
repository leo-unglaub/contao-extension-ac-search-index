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
 * Provide methods to build the search index
 *
 * @copyright  Leo Unglaub 2012
 * @author     Leo Unglaub <leo@leo-unglaub.net>
 * @package    ac_search_index
 * @license    LGPL
 */
class AcSearchIndexCron extends Controller
{
	/**
	 * Update all keywords in the search index where the root id is missing
	 *
	 * @param int $intLimit
	 * @return void
	 */
	public function setMissingRootIds($intLimit=50)
	{
		$this->import('Database');

		// get all entry's witch have no rootId
		$objSearchIndex = $this->Database->query('SELECT DISTINCT s.pid as pageId FROM tl_search s JOIN tl_search_index i ON i.pid=s.id WHERE i.rootPage=0 LIMIT ' . $intLimit);

		while ($objSearchIndex->next())
		{
			// get the root id of the current site
			$intRootId = $this->getPageDetails($objSearchIndex->pageId)->rootId;

			// store the root id in the search index
			$this->Database->prepare('UPDATE tl_search_index i JOIN tl_search s ON i.pid=s.id SET i.rootPage=? WHERE s.pid=?')
						   ->execute($intRootId, $objSearchIndex->pageId);
		}
	}
}
