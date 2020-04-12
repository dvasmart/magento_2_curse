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
use Vitalii\Exam\Api\ColorRepositoryInterface;
use Vitalii\Exam\Api\Data\ColorInterface;
use Vitalii\Exam\Api\Data\FruitInterface;
use Vitalii\Exam\Model\ColorModel;

/**
 * Class Colors
 */
class Colors extends Template
{
    const FRUITS_ACTION_ROUTE = 'exam_route/color/fruits';

    /**
     * @var ColorInterface[]|null
     */
    private $colors;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var ColorRepositoryInterface
     */
    private $colorRepository;

    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

    /**
     * @param Context $context
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param ColorRepositoryInterface $colorRepository
     * @param SortOrderBuilder $sortOrderBuilder
     * @param array $data
     */
    public function __construct(
        Context $context,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        ColorRepositoryInterface $colorRepository,
        SortOrderBuilder $sortOrderBuilder,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->colorRepository = $colorRepository;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    /**
     * {@inheritDoc}
     */
    protected function _prepareLayout()
    {
        $sortDirection = (int)$this->getRequest()
            ->getParam(ColorModel::SORT_DIRECTION);
        if ($this->colors === null) {
            $this->colors = [];
            try {
                /** @var SortOrder $sortOrder */
                if($sortDirection !== 1) {
                    $sortOrder = $this->sortOrderBuilder
                        ->setField(ColorInterface::COLOR_NAME)
                        ->setDirection(SortOrder::SORT_ASC)
                        ->create();
                }
                else{
                    $sortOrder = $this->sortOrderBuilder
                        ->setField(ColorInterface::COLOR_NAME)
                        ->setDirection(SortOrder::SORT_DESC)
                        ->create();
                }
                /** @var SearchCriteria|SearchCriteriaInterface $searchCriteria */
                $searchCriteria = $this->searchCriteriaBuilder
                    ->addSortOrder($sortOrder)
                    ->create();
                /** @var SearchResultsInterface $searchResults */
                $searchResults = $this->colorRepository
                    ->getList($searchCriteria);
                if ($searchResults->getTotalCount() > 0) {
                    $this->colors = $searchResults->getItems();
                }
            } catch (\Exception $exception) {
                $error = $exception->getMessage();
                $text = 'Colors loading has failed: message "%s"';
                $message = sprintf($text, $error);
                $this->_logger->debug($message);
            }
        }
        return parent::_prepareLayout();
    }

    /**
     * @return ColorInterface[]|null
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * @return int
     */
    public function getSortDirection()
    {
        $direction = (int)$this->getRequest()
            ->getParam(ColorModel::SORT_DIRECTION);
        if ($direction === 1)
        {
            return 0;
        }
        else return 1;
    }

    /**
     * @param string $colorId
     * @return string
     */
    public function getFruitsUrl($colorId)
    {
        return $this->getUrl(
            self::FRUITS_ACTION_ROUTE,
            [
                FruitInterface::COLOR_ID => $colorId
            ]
        );
    }
}
