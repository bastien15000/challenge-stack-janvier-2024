<?php

namespace App\Services;

use App\Entity\Customer;
use App\Repository\CustomerRepository;

class CustomerService
{
    public function __construct (
        private readonly CustomerRepository $customerRepository
    ) {}

    public function getCustomers(): array
    {
        return $this->customerRepository->findAll();
    }

    public function getCustomer(string $id): ?Customer
    {
        return $this->customerRepository->findOneBy(['id' => $id]);
    }
}