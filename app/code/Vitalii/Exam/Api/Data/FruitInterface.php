<?php


namespace Vitalii\Exam\Api\Data;

/**
 * Interface FruitInterface
 */
interface FruitInterface
{
    const ENTITY_ID = 'entity_id';

    const FRUIT_NAME = 'fruit_name';

    const DESCRIPTION = 'description';

    const WEIGHT = 'weight';

    const TASTE = 'taste';

    const PRICE = 'price';

    const CREATED_AT = 'created_at';

    /**
     * Get entity id
     *
     * @return int
     */
    public function getId();

    /**
     * Get fruit name
     *
     * @return string
     */
    public function getFruitName();

    /**
     * Get fruit description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get fruit weight
     *
     * @return int
     */
    public function getWeight();

    /**
     * Get fruit taste
     *
     * @return string
     */
    public function getTaste();

    /**
     * Get fruit price
     *
     * @return float
     */
    public function getPrice();

    /**
     * Get created at date
     *
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * Set entity id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set user id
     *
     * @param string $fruitName
     * @return FruitInterface
     */
    public function setFruitName(string $fruitName): FruitInterface;

    /**
     * Set fruit id
     *
     * @param string $description
     * @return FruitInterface
     */
    public function setDescription(string $description): FruitInterface;

    /**
     * Set fruit description
     *
     * @param int $weight
     * @return FruitInterface
     */
    public function setWeight(int $weight): FruitInterface;

    /**
     * Set fruit description
     *
     * @param string $taste
     * @return FruitInterface
     */
    public function setTaste(string $taste): FruitInterface;

    /**
     * Set fruit price
     *
     * @param float $price
     * @return FruitInterface
     */
    public function setPrice(float $price): FruitInterface;

    /**
     * Set created at date
     *
     * @param string $createdAt
     * @return FruitInterface
     */
    public function setCreatedAt(string $createdAt): FruitInterface;
}
