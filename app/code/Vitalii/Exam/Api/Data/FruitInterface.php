<?php


namespace Vitalii\Exam\Api\Data;

/**
 * Interface FruitInterface
 */
interface FruitInterface
{
    const ENTITY_ID = 'entity_id';

    const FRUIT_NAME = 'fruit_name';

    const COLOR_ID = 'color_id';

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
     * Get color id
     *
     * @return string
     */
    public function getColorId();

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
     * @return string
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
     * Set fruit name
     *
     * @param string $fruitName
     * @return FruitInterface
     */
    public function setFruitName(string $fruitName): FruitInterface;

    /**
     * Set color id
     *
     * @param string $colorId
     * @return FruitInterface
     */
    public function setColorId(string $colorId): FruitInterface;

    /**
     * Set fruit description
     *
     * @param string $description
     * @return FruitInterface
     */
    public function setDescription(string $description): FruitInterface;

    /**
     * Set fruit weight
     *
     * @param int $weight
     * @return FruitInterface
     */
    public function setWeight(int $weight): FruitInterface;

    /**
     * Set fruit taste
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
