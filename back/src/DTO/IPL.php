<?php

namespace App\DTO;

class IPL
{

    private int $customerStatisfactionRate;

    private int $averageDeliveryCost;

    private int $energyEfficiency; // (( fuel_bill / 1.75) / (km_end - km_start)) * 100

    private array $perDays;

    public function __construct() {
        $this->customerStatisfactionRate = 0;

        $this->averageDeliveryCost = 0;

        $this->energyEfficiency = 0; // (( fuel_bill / 1.75) / (km_end - km_start)) * 100

        $this->perDays = [];
    }

    /**
     * @return int
     */
    public function getCustomerStatisfactionRate(): int
    {
        return $this->customerStatisfactionRate;
    }

    /**
     * @param int $customerStatisfactionRate
     */
    public function setCustomerStatisfactionRate(int $customerStatisfactionRate): void
    {
        $this->customerStatisfactionRate = $customerStatisfactionRate;
    }

    /**
     * @return int
     */
    public function getAverageDeliveryCost(): int
    {
        return $this->averageDeliveryCost;
    }

    /**
     * @param int $averageDeliveryCost
     */
    public function setAverageDeliveryCost(int $averageDeliveryCost): void
    {
        $this->averageDeliveryCost = $averageDeliveryCost;
    }

    /**
     * @return int
     */
    public function getEnergyEfficiency(): int
    {
        return $this->energyEfficiency;
    }

    /**
     * @param int $energyEfficiency
     */
    public function setEnergyEfficiency(int $energyEfficiency): void
    {
        $this->energyEfficiency = $energyEfficiency;
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