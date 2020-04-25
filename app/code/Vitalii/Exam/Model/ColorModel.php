<?php

namespace Vitalii\Exam\Model;

use Magento\Framework\Model\AbstractModel;
use Vitalii\Exam\Api\Data\ColorInterface;
use Vitalii\Exam\Model\ResourceModel\ColorResource as ColorResourceModel;

/**
 * Class ColorModel
 */
class ColorModel extends AbstractModel implements ColorInterface
{
    /**
     * {@inheritdoc}
     */
    public function _construct()
    {
        $this->_init(ColorResourceModel::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function getColorName()
    {
        return (string)$this->getData(self::COLOR_NAME);
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return (string)$this->getData(self::DESCRIPTION);
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return (string)$this->getData(self::CREATED_AT);
    }

    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function setColorName(string $colorName): ColorInterface
    {
        return $this->setData(self::COLOR_NAME, $colorName);
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription(string $description): ColorInterface
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * В даному методі може бути викинуте виключення, рекомендації:
     *
     * 1. Або добавити @throws (а тут тип виключення) в опис до інтерфейсу;
     * 2. Або огорнути в try/catch при цьому дотримуючись повернення правильного
     * типу даних
     *
     * {@inheritdoc}
     */
    public function setCreatedAt(string $createdAt): ColorInterface
    {
        $createdAtObject = new \DateTime($createdAt);
        return $this->setData(self::CREATED_AT, $createdAtObject->format('Y-m-d H:i:s'));
    }
}
