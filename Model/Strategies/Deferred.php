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
use Magento\Framework\MessageQueue\PublisherInterface;

class Deferred implements StrategyInterface
{
    const STRATEGY_KEY = 'deferred';
    const TOPIC_NAME = 'mavenbird.reindex';

    /** @var PublisherInterface */
    private $publisher;

    /**
     * Deferred constructor.
     * @param PublisherInterface $publisher
     */
    public function __construct(PublisherInterface $publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * Push the indexIDs to our message queue to processed by another process
     *
     * @param array|null $indexIds
     */
    public function process(array $indexIds = null) : void
    {
        $this->publisher->publish(self::TOPIC_NAME, $indexIds);
    }
}
