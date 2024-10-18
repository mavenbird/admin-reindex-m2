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
namespace Mavenbird\Reindex\Controller\Adminhtml\Indexer;

use Exception;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Indexer\IndexerInterface;
use Magento\Indexer\Model\IndexerFactory;
use Mavenbird\Reindex\Controller\Adminhtml\Indexer;
use Mavenbird\Reindex\Api\StrategyInterface;

class ReindexOnTheFly extends Indexer
{

    /** @var IndexerInterface  */
    protected $indexerFactory;

    /** @var StrategyInterface */
    private $reindexStrategy;

    /**
     * Construct
     *
     * @param Context $context
     * @param IndexerFactory $indexerFactory
     * @param StrategyInterface $reindexStrategy
     */
    public function __construct(
        Context $context,
        IndexerFactory $indexerFactory,
        StrategyInterface $reindexStrategy
    ) {
        $this->indexerFactory = $indexerFactory;
        $this->reindexStrategy = $reindexStrategy;
        parent::__construct($context);
    }

    /**
     * Execute
     *
     * @return void
     */
    public function execute()
    {
        $indexerIds = $this->getRequest()->getParam('indexer_ids');
        if (!is_array($indexerIds)) {
            $this->messageManager->addErrorMessage(__('Please select indexers.'));
        } else {
            try {
                $this->reindexStrategy->process($indexerIds);
                $this->messageManager->addSuccessMessage(
                    __('Reindex triggered for %1 indexer(s).', count($indexerIds))
                );
            } catch (InputException | LocalizedException $e) {
                $this->messageManager->addExceptionMessage(
                    $e,
                    __("We couldn't reindex because of an error: {$e->getMessage()}")
                );
            } catch (Exception $e) {
                $this->messageManager->addExceptionMessage(
                    $e,
                    __("We couldn't reindex because of an error.")
                );
            }
        }

        $this->_redirect('*/*/list');
    }
}
