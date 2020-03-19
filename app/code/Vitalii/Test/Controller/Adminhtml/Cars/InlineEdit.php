<?php

namespace Vitalii\Test\Controller\Adminhtml\Cars;

use Magento\Backend\App\Action as BackendAction;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Vitalii\Test\Api\Data\CarInterface;
use Vitalii\Test\Api\CarRepositoryInterface;

/**
 * Class InlineEdit
 */
class InlineEdit extends BackendAction implements HttpPostActionInterface
{
    /**
     * {@inheritdoc}
     */
    const ADMIN_RESOURCE = 'Vitalii_Test::car_inline_edit';

    /**
     * @var JsonFactory
     */
    private $jsonFactory;

    /**
     * @var CarRepositoryInterface
     */
    private $carRepository;

    /**
     * @param Context $context
     * @param CarRepositoryInterface $carRepository
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        CarRepositoryInterface $carRepository,
        JsonFactory $jsonFactory
    ) {
        $this->carRepository = $carRepository;
        $this->jsonFactory = $jsonFactory;
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (empty($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $id) {
                    try {
                        /** @var CarInterface $model */
                        $model = $this->carRepository->getById($id);
                        $model->setData(array_merge($model->getData(), $postItems[$id]));
                        $this->carRepository->save($model);
                    } catch (NoSuchEntityException $e) {
                        $messages[] = $e->getMessage();
                        $error = true;
                    } catch (CouldNotSaveException $e) {
                        $messages[] = $e->getMessage();
                        $error = true;
                    } catch (\Exception $e) {
                        $messages[] = $e->getMessage();
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
