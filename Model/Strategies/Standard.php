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
namespace Mavenbird\Reindex\Model\Strategies;

use Mavenbird\Reindex\Api\StrategyInterface;
use Mavenbird\Reindex\Model\Reindex;

class Standard implements StrategyInterface
{
    public const STRATEGY_KEY = 'standard';

    /** @var Reindex */
    private $reindexService;

    /**
     * Standard constructor.
     * @param Reindex $reindexService
     */
    public function __construct(Reindex $reindexService)
    {
        $this->reindexService = $reindexService;
    }

    /**
     * Handle the reindex within the current process
     *
     * @param array|null $indexIds
     */
    public function process(array $indexIds = null) : void
    {
        $this->reindexService->reindex($indexIds);
    }
}
