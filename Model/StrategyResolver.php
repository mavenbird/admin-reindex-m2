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

use Mavenbird\Reindex\Api\StrategyInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\InputException;

class StrategyResolver
{
    const XML_STRATEGY_PATH = 'mavenbird_reindex/about/strategy';

    /** @var ScopeConfigInterface */
    private $scopeConfig;

    /** @var array */
    private $strategies;

    /**
     * StrategyResolver constructor.
     * @param ScopeConfigInterface $scopeConfigInterface
     * @param array $strategies
     */
    public function __construct(
        ScopeConfigInterface $scopeConfigInterface,
        array $strategies
    ) {
        $this->scopeConfig = $scopeConfigInterface;
        $this->strategies = $strategies;
    }

    /**
     * Resolve a strategy key to its correct class
     *
     * @param string $strategy
     * @return StrategyInterface
     * @throws InputException
     */
    public function resolve(string $strategy) : StrategyInterface
    {
        if (!array_key_exists($strategy, $this->strategies)) {
            throw new InputException(__("Invalid Strategy Key: $strategy"));
        }

        return $this->strategies[$strategy];
    }

    /**
     * Handle resolving the current active strategy from system config to a class
     *
     * @return StrategyInterface
     * @throws InputException
     */
    public function resolveActive() : StrategyInterface
    {
        return $this->resolve($this->getActiveStrategy());
    }

    /**
     * Get the active indexation strategy key from the backend
     *
     * @return string
     */
    public function getActiveStrategy() : string
    {
        return $this->scopeConfig->getValue(self::XML_STRATEGY_PATH);
    }
}
