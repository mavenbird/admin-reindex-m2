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
namespace Mavenbird\Reindex\Block\Adminhtml\System\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Strategy implements OptionSourceInterface
{
    /** @var array */
    private $strategies;

    /**
     * Strategy constructor.
     * @param array $strategies
     */
    public function __construct(array $strategies)
    {
        $this->strategies = $strategies;
    }

    /**
     * Option Array
     *
     * @return array
     */
    public function toOptionArray() : array
    {
        $options = [];
        foreach ($this->strategies as $key => $label) {
            $options[] = ['value' => $key, 'label' => __($label)];
        }
        return $options;
    }
}
