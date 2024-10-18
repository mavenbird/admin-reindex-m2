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

class Strategy implements StrategyInterface
{
    /** @var StrategyResolver */
    private $resolver;

    /**
     * Strategy constructor.
     * @param StrategyResolver $resolver
     */
    public function __construct(StrategyResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * Process
     *
     * @param array|null $indexIds
     * @return void
     */
    public function process(array $indexIds = null) : void
    {
        $this->resolver->resolveActive()->process($indexIds);
    }
}
