<?php

namespace Vitalii\Test\Api\Data;

/**
 * Interface CarCustomerInterface
 */
interface CarCustomerInterface
{
    const ENTITY_ID = 'entity_id';

    const EMAIL = 'email';

    const SOME_ID = 'some_id';

    const NAME = 'name';

    const CREATED_AT = 'created_at';

    /**
     * Get entity id
     *
     * @return int
     */
    public function getId();

    /**
     * Get car customer email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Get some id
     *
     * @return int
     */
    public function getSomeId();

    /**
     * Get car customer name
     *
     * @return string
     */
    public function getName();

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
     * Set car customer email
     *
     * @param string $email
     * @return CarCustomerInterface
     */
    public function setEmail(string $email): CarCustomerInterface;

    /**
     * Set some id
     *
     * @param int $someId
     * @return CarCustomerInterface
     */
    public function setSomeId(int $someId): CarCustomerInterface;

    /**
     * Set car customer name
     *
     * @param string $name
     * @return CarCustomerInterface
     */
    public function setName(string $name): CarCustomerInterface;

    /**
     * Set created at date
     *
     * @param string $createdAt
     * @return CarCustomerInterface
     */
    public function setCreatedAt(string $createdAt): CarCustomerInterface;
}
