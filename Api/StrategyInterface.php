<?php
/**
 * Mavenbird Technologies Private Limited
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://mavenbird.com/Mavenbird-Module-License.txt
 *
 * =================================================================
 *
 * @category   Mavenbird
 * @package    Mavenbird_Reindex
 * @author     Mavenbird Team
 * @copyright  Copyright (c) 2018-2024 Mavenbird Technologies Private Limited ( http://mavenbird.com )
 * @license    http://mavenbird.com/Mavenbird-Module-License.txt
 */

namespace Mavenbird\Reindex\Api;

/**
 * Handles strategy for reindexing from backend. Process now, defer to message queue etc.
 *
 * @api
 */
interface StrategyInterface
{
    /**
     * Process
     *
     * @param array|null $indexIds
     * @return void
     */
    public function process(?array $indexIds = null) : void;
}
