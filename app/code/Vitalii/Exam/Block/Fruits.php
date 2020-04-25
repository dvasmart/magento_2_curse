<?php

namespace Vitalii\Exam\Block;

use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\App\Request\Http;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Vitalii\Exam\Api\FruitRepositoryInterface;
use Vitalii\Exam\Api\Data\FruitInterface;

/**
 * Class Fruits
 */
class Fruits extends Template
{
    /**
     * @var FruitRepositoryInterface
     */
    private $fruitRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

    /**
     * @var FruitInterface[]|null
     */
    private $fruits;

    /**
     * @param Context $context
     * @param FruitRepositoryInterface $fruitRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SortOrderBuilder $sortOrderBuilder
     * @param array $data
     */
    public function __construct(
        Context $context,
        FruitRepositoryInterface $fruitRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->fruitRepository = $fruitRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    /**
     * {@inheritDoc}
     */
    protected function _prepareLayout()
    {
        /** @var Http $request */
        $request = $this->getRequest();
        $colorId = (string)$request->getParam(FruitInterface::COLOR_ID);
        if (!empty($colorId)) {
            $this->fruits = [];
            try {
                /** @var SortOrder $sortOrder */
                $sortOrder = $this->sortOrderBuilder
                    ->setField(FruitInterface::ENTITY_ID)
                    ->setDirection(SortOrder::SORT_ASC)
                    ->create();
                /** @var SearchCriteria|SearchCriteriaInterface $searchCriteria */
                $searchCriteria = $this->searchCriteriaBuilder
                    ->addFilter(FruitInterface::COLOR_ID, $colorId)
                    ->addSortOrder($sortOrder)
                    ->create();
                /** @var SearchResultsInterface $searchResults */
                $searchResults = $this->fruitRepository->getList($searchCriteria);
                if ($searchResults->getTotalCount() > 0) {
                    $this->fruits = $searchResults->getItems();
                }
            } catch (\Exception $exception) {
                $error = $exception->getMessage();
                $text = 'Fruits loading has failed: message "%s"';
                $message = sprintf($text, $error);
                $this->_logger->debug($message);
            }
        }

        return parent::_prepareLayout();
    }

    /**
     * @return FruitInterface[]
     */
    public function getFruits()
    {
        return $this->fruits;
    }
}
