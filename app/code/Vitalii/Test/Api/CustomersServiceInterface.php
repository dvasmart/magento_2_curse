<?php

namespace Vitalii\Test\Api;

/**
 * Interface CustomersServiceInterface
 */
interface CustomersServiceInterface
{
    /**
     * @return mixed
     */
    public function getCustomersList();

    /**
     * @param int $customerId
     * @return mixed
     */
    public function getCustomerById(int $customerId);

    /**
     * @param Data\CarCustomerInterface $customer
     * @return mixed
     */
    public function saveOrUpdate(Data\CarCustomerInterface $customer);

    /**
     * @param int $customerId
     * @return mixed
     */
    public function deleteById(int $customerId);
}
