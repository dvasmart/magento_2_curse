<?php


namespace Vitalii\Exam\Block;

use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Vitalii\Exam\Api\Data\FruitInterface;
use Vitalii\Exam\Api\FruitRepositoryInterface;

/**
 * Class Fruits
 */
class Fruits extends Template
{

    /**
     * @var FruitInterface[]|null
     */
    private $fruits;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var FruitRepositoryInterface
     */
    private $fruitRepository;

    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

    /**
     * @param Context $context
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FruitRepositoryInterface $fruitRepository
     * @param SortOrderBuilder $sortOrderBuilder
     * @param array $data
     */
    public function __construct(
        Context $context,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FruitRepositoryInterface $fruitRepository,
        SortOrderBuilder $sortOrderBuilder,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->fruitRepository = $fruitRepository;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    /**
     * {@inheritDoc}
     */
    protected function _prepareLayout()
    {
        if ($this->fruits === null) {
            $this->fruits = [];
            try {
                /** @var SortOrder $sortOrder */
                $sortOrder = $this->sortOrderBuilder
                    ->setField(FruitInterface::FRUIT_NAME)
                    ->setDirection(SortOrder::SORT_ASC)
                    ->create();
                /** @var SearchCriteria|SearchCriteriaInterface $searchCriteria */
                $searchCriteria = $this->searchCriteriaBuilder
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
     * @return FruitInterface[]|null
     */
    public function getFruits()
    {
        return $this->fruits;
    }
}
