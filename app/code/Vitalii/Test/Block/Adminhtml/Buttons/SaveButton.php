<?php

namespace Vitalii\Test\Controller\Adminhtml\Cars;

use Magento\Backend\App\Action as BackendAction;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\Request\Http as HttpRequest;
//use Magento\Catalog\Model\ImageUploader;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Controller\ResultInterface;
use Vitalii\Test\Api\CarCustomerRepositoryInterface;
use Vitalii\Test\Api\CarRepositoryInterface;
use Vitalii\Test\Api\Data\CarCustomerInterface;
use Vitalii\Test\Api\Data\CarInterface;
use Vitalii\Test\Api\Data\CarInterfaceFactory;
use Vitalii\Test\Model\CarModel;

/**
 * Class Save
 */
class Save extends BackendAction implements HttpPostActionInterface
{
    /**
     * {@inheritdoc}
     */
    const ADMIN_RESOURCE = 'Vitalii_Test::car_save';

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var CarRepositoryInterface
     */
    private $carRepository;

    /**
     * @var CarCustomerRepositoryInterface
     */
    private $carCustomerRepository;

    /**
     * @var CarInterfaceFactory
     */
    private $carFactory;
//
//    /**
//     * @var ImageUploader
//     */
//    private $imageUploader;

    /**
     * @param Context $context
     * @param CarRepositoryInterface $carRepository
     * @param CarCustomerRepositoryInterface $carCustomerRepository
     * @param CarInterfaceFactory $carFactory
     * @param DataPersistorInterface $dataPersistor
    //     * @param ImageUploader $imageUploader
     */
    public function __construct(
        Context $context,
        CarRepositoryInterface $carRepository,
        CarCustomerRepositoryInterface $carCustomerRepository,
        CarInterfaceFactory $carFactory,
        DataPersistorInterface $dataPersistor
//        ImageUploader $imageUploader
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->carRepository = $carRepository;
        $this->carCustomerRepository = $carCustomerRepository;
        $this->carFactory = $carFactory;
//        $this->imageUploader = $imageUploader;
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        /** @var HttpRequest $request */
        $request = $this->getRequest();
        $data = $request->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam(CarInterface::ENTITY_ID);
            if (empty($data[CarInterface::ENTITY_ID])) {
                $data[CarInterface::ENTITY_ID] = null;
            }

            if ($id) {
                try {
                    /** @var CarInterface $model */
                    $model = $this->carRepository->getById($id);
                } catch (NoSuchEntityException $e) {
                    $this->messageManager->addErrorMessage(__($e->getMessage()));
                    /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                    $resultRedirect = $this->resultRedirectFactory->create();
                    return $resultRedirect->setPath('*/*/');
                }
            } else {
                /** @var CarModel $model */
                $model = $this->carFactory->create();
            }
//            $this->processImage($data);
            $model->setData($data);

            try {
                /**
                 * This chunk of code was added in order to check if car customer exists
                 * in the database by provided user_id from the form on admin edit page
                 */
                $carCustomerId = (int)$data[CarInterface::USER_ID];
                $this->carCustomerRepository->getById($carCustomerId);

                $this->carRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the car.'));
                $this->dataPersistor->clear('car');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', [CarInterface::ENTITY_ID => $model->getId()]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (CouldNotSaveException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the car.'));
            }

            $this->dataPersistor->set('car', $data);
            return $resultRedirect->setPath('*/*/edit', [CarInterface::ENTITY_ID => $id]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
