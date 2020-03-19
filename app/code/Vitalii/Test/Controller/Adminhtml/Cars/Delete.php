<?php

namespace Vitalii\Test\Controller\Adminhtml\Cars;

use Magento\Backend\App\Action as BackendAction;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Vitalii\Test\Api\Data\CarInterface;
use Vitalii\Test\Api\CarRepositoryInterface;

/**
 * Class Delete
 */
class Delete extends BackendAction implements HttpGetActionInterface
{
    /**
     * {@inheritdoc}
     */
    const ADMIN_RESOURCE = 'Vitalii_Test::car_delete';

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var CarRepositoryInterface
     */
    private $carRepository;

    /**
     * @param Context $context
     * @param CarRepositoryInterface $carRepository
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context $context,
        CarRepositoryInterface $carRepository,
        DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->carRepository = $carRepository;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = (int)$this->getRequest()->getParam(CarInterface::ENTITY_ID);

        try {
            $this->carRepository->deleteById($id);
            $this->messageManager->addSuccessMessage(__('You deleted the car'));
            $this->dataPersistor->clear('car');
            return $resultRedirect->setPath('*/*/');
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while deleting the car.'));
        }

        return $resultRedirect->setPath('*/*/');
    }
}
