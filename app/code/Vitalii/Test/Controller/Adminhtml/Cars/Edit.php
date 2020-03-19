<?php

namespace Vitalii\Test\Controller\Adminhtml\Cars;

use Magento\Backend\App\Action as BackendAction;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Vitalii\Test\Api\Data\CarInterface;
use Vitalii\Test\Api\Data\CarInterfaceFactory;
use Vitalii\Test\Api\CarRepositoryInterface;

/**
 * Class Edit
 */
class Edit extends BackendAction implements HttpGetActionInterface
{
    /**
     * {@inheritdoc}
     */
    const ADMIN_RESOURCE = 'Vitalii_Test::car_edit';

    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @var CarRepositoryInterface
     */
    private $carRepository;

    /**
     * @var CarInterfaceFactory
     */
    private $carFactory;

    /**
     * @param Context $context
     * @param CarRepositoryInterface $carRepository
     * @param CarInterfaceFactory $carFactory
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        CarRepositoryInterface $carRepository,
        CarInterfaceFactory $carFactory,
        PageFactory $resultPageFactory
    ) {
        $this->carRepository = $carRepository;
        $this->carFactory = $carFactory;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        $id = (int)$this->getRequest()->getParam(CarInterface::ENTITY_ID);

        if ($id) {
            try {
                $model = $this->carRepository->getById($id);
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__($e->getMessage()));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        } else {
            $model = $this->carFactory->create();
        }

        /** @var ResultInterface $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Vitalii_Test::vitalii_manage_cars');

        $resultPage->getConfig()->getTitle()->prepend(__('Car'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getName() : __('New Car'));
        return $resultPage;
    }
}
