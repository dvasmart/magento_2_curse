<?php


namespace Vitalii\Exam\Model;

use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Vitalii\Exam\Api\ColorRepositoryInterface;
use Vitalii\Exam\Api\Data\ColorInterface;
use Vitalii\Exam\Model\ColorModelFactory;
use Vitalii\Exam\Model\ResourceModel\ColorResource\Collection;
use Vitalii\Exam\Model\ResourceModel\ColorResource\CollectionFactory as ColorCollectionFactory;
use Vitalii\Exam\Model\ResourceModel\ColorResource;

/**
 * Class ColorRepository
 */
class ColorRepository implements ColorRepositoryInterface
{
    /**
     * @var ColorModelFactory
     */
    private $colorFactory;

    /**
     * @var ColorCollectionFactory
     */
    private $colorCollectionFactory;

    /**
     * @var ColorResource
     */
    private $resource;

    /**
     * @type SearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @type CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param ColorModelFactory $colorFactory
     * @param ColorCollectionFactory $colorCollectionFactory
     * @param ColorResource $resource
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ColorModelFactory $colorFactory,
        ColorCollectionFactory $colorCollectionFactory,
        ColorResource $resource,
        SearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->colorFactory = $colorFactory;
        $this->colorCollectionFactory = $colorCollectionFactory;
        $this->resource = $resource;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function save(ColorInterface $color): ColorInterface
    {
        try {
            /** @var ColorModel|ColorInterface $color */
            $this->resource->save($color);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $color;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $colorId): ColorInterface
    {
        /** @var ColorModel|ColorInterface $color */
        $color = $this->colorFactory->create();
        $color->load($colorId);
        if (!$color->getId()) {
            throw new NoSuchEntityException(__('Color entity with id `%1` does not exist.', $colorId));
        }

        return $color;
    }

    /**
     * {@inheritDoc}
     */
    public function getList(SearchCriteriaInterface $criteria): SearchResults
    {
        /** @var Collection $collection */
        $collection = $this->colorCollectionFactory->create();
        $this->collectionProcessor->process($criteria, $collection);

        /** @var SearchResults $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritDoc}
     */
    public function delete(ColorInterface $color): bool
    {
        try {
            /** @var ColorModel $color */
            $this->resource->delete($color);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function deleteById(int $colorId): bool
    {
        return $this->delete($this->getById($colorId));
    }
}
