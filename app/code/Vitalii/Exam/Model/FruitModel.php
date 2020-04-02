<?php


namespace Vitalii\Exam\Model;

use Magento\Framework\Model\AbstractModel;
use Vitalii\Exam\Api\Data\FruitInterface;
use Vitalii\Exam\Model\ResourceModel\FruitResource as FruitResourceModel;

/**
 * Class FruitModel
 */
class FruitModel extends AbstractModel implements FruitInterface
{
    /**
     * {@inheritdoc}
     */
    public function _construct()
    {
        $this->_init(FruitResourceModel::class);
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
    public function getFruitName()
    {
        return (string)$this->getData(self::FRUIT_NAME);
    }

    /**
     * {@inheritdoc}
     */
    public function getColorId()
    {
        return (string)$this->getData(self::COLOR_ID);
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
    public function getWeight()
    {
        return (int)$this->getData(self::WEIGHT);
    }

    /**
     * {@inheritdoc}
     */
    public function getTaste()
    {
        return (string)$this->getData(self::TASTE);
    }

    /**
     * {@inheritdoc}
     */
    public function getPrice()
    {
        return (float)$this->getData(self::PRICE);
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
    public function setFruitName(string $fruitName): FruitInterface
    {
        return $this->setData(self::FRUIT_NAME, $fruitName);
    }

    /**
     * {@inheritdoc}
     */
    public function setColorId(string $colorId): FruitInterface
    {
        return $this->setData(self::COLOR_ID, $colorId);
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription(string $description): FruitInterface
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * {@inheritdoc}
     */
    public function setWeight(int $weight): FruitInterface
    {
        return $this->setData(self::WEIGHT, $weight);
    }

    /**
     * {@inheritdoc}
     */
    public function setTaste(string $taste): FruitInterface
    {
        return $this->setData(self::TASTE, $taste);
    }

    /**
     * {@inheritdoc}
     */
    public function setPrice(float $price): FruitInterface
    {
        return $this->setData(self::PRICE, $price);
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(string $createdAt): FruitInterface
    {
        $createdAtObject = new \DateTime($createdAt);
        return $this->setData(self::CREATED_AT, $createdAtObject->format('Y-m-d H:i:s'));
    }
}
