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
namespace Mavenbird\Reindex\Model;

use Magento\Indexer\Model\IndexerFactory;
use Mavenbird\Reindex\Api\ReindexInterface;

class Reindex implements ReindexInterface
{
    /** @var IndexerFactory */
    private $indexerFactory;

    /**
     * Reindex constructor.
     * @param IndexerFactory $indexerFactory
     */
    public function __construct(IndexerFactory $indexerFactory)
    {
        $this->indexerFactory = $indexerFactory;
    }

    /**
     * Implements synchronous reindexing
     *
     * @param array|null $indexIds
     */
    public function reindex(array $indexIds = null) : void
    {
        foreach ($indexIds as $index) {
            $indexer = $this->indexerFactory->create();
            $indexer->load($index)->reindexAll();
        }
    }
}
