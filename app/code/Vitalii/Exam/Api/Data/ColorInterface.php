<?php

namespace Vitalii\Exam\Api\Data;

/**
 * Interface ColorInterface
 */
interface ColorInterface
{
    const ENTITY_ID = 'entity_id';

    const COLOR_NAME = 'color_name';

    const DESCRIPTION = 'description';

    const CREATED_AT = 'created_at';

    const SORT_DIRECTION = 'sort_direction';

    /**
     * Get entity id
     *
     * @return int
     */
    public function getId();

    /**
     * Get color name
     *
     * @return string
     */
    public function getColorName();

    /**
     * Get color description
     *
     * @return string
     */
    public function getDescription();

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
     * Set color name
     *
     * @param string $colorName
     * @return ColorInterface
     */
    public function setColorName(string $colorName): ColorInterface;

    /**
     * Set color description
     *
     * @param string $description
     * @return ColorInterface
     */
    public function setDescription(string $description): ColorInterface;

    /**
     * Set created at date
     *
     * @param string $createdAt
     * @return ColorInterface
     */
    public function setCreatedAt(string $createdAt): ColorInterface;
}
