<?php

namespace App\DTO;

class ServiceRate
{
    private int $ordersTotal;
    private int $ordersDelivered;
    private int $rate;
    private array $perDays;

    /**
     * @return int
     */
    public function getOrdersTotal(): int
    {
        return $this->ordersTotal;
    }

    /**
     * @param int $ordersTotal
     */
    public function setOrdersTotal(int $ordersTotal): void
    {
        $this->ordersTotal = $ordersTotal;
    }

    /**
     * @return int
     */
    public function getOrdersDelivered(): int
    {
        return $this->ordersDelivered;
    }

    /**
     * @param int $ordersDelivered
     */
    public function setOrdersDelivered(int $ordersDelivered): void
    {
        $this->ordersDelivered = $ordersDelivered;
    }

    /**
     * @return int
     */
    public function getRate(): int
    {
        return $this->rate;
    }

    /**
     * @param int $rate
     */
    public function setRate(int $rate): void
    {
        $this->rate = $rate;
    }

    /**
     * @return array
     */
    public function getPerDays(): array
    {
        return $this->perDays;
    }

    /**
     * @param array $perDays
     */
    public function setPerDays(array $perDays): void
    {
        $this->perDays = $perDays;
    }
}