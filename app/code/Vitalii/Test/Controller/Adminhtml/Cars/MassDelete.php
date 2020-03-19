<?php

namespace Vitalii\Test\Controller\Adminhtml\Cars;

use Magento\Backend\App\Action as BackendAction;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Vitalii\Test\Api\Data\CarInterface;
use Vitalii\Test\Api\CarRepositoryInterface;
use Vitalii\Test\Model\ResourceModel\CarResource\Collection as CarCollection;
use Vitalii\Test\Model\ResourceModel\CarResource\CollectionFactory as CarResourceCollectionFactory;

/**
 * Class MassDelete
 */
class MassDelete extends BackendAction implements HttpPostActionInterface
{
    /**
     * {@inheritdoc}
     */
    const ADMIN_RESOURCE = 'Vitalii_Test::car_mass_delete';

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var CarRepositoryInterface
     */
    private $carRepository;

    /**
     * @var Filter
     */
    private $filter;

    /**
     * @var CarResourceCollectionFactory
     */
    private $collectionFactory;

    /**
     * @param Context $context
     * @param CarRepositoryInterface $carRepository
     * @param CarResourceCollectionFactory $collectionFactory
     * @param Filter $filter
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context $context,
        CarRepositoryInterface $carRepository,
        CarResourceCollectionFactory $collectionFactory,
        Filter $filter,
        DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->filter = $filter;
        $this->carRepository = $carRepository;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        try {
            /** @var CarCollection $collection */
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $count = 0;
            foreach ($collection as $car) {
                /** @var CarInterface $car */
                if ($this->carRepository->delete($car)) {
                    $count++;
                }
            }

            $message = __('A total of %1 record(s) have been deleted.', $count);
            $this->messageManager->addSuccessMessage($message);
            $this->dataPersistor->clear('car');
            return $resultRedirect->setPath('*/*/');
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while deleting cars.'));
        }

        return $resultRedirect->setPath('*/*/');
    }
}
