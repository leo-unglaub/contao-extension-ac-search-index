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

?>