<?php

namespace App\Entity;

use App\Repository\DeliverymanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeliverymanRepository::class)]
class Deliveryman extends User
{
    #[ORM\Column]
    private ?float $salary = null;

    #[ORM\Column(nullable: true)]
    private ?float $average_mark = null;

    #[ORM\Column]
    private ?int $nb_marks = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Vehicle $vehicle_id = null;

    #[ORM\OneToMany(mappedBy: 'deliveryman_id', targetEntity: Delivery::class)]
    private Collection $deliveries;

    public function __construct()
    {
        $this->deliveries = new ArrayCollection();
    }

    public function getSalary(): ?float
    {
        return $this->salary;
    }

    public function setSalary(float $salary): static
    {
        $this->salary = $salary;

        return $this;
    }

    public function getAverageMark(): ?float
    {
        return $this->average_mark;
    }

    public function setAverageMark(?float $average_mark): static
    {
        $this->average_mark = $average_mark;

        return $this;
    }

    public function getNbMarks(): ?int
    {
        return $this->nb_marks;
    }

    public function setNbMarks(int $nb_marks): static
    {
        $this->nb_marks = $nb_marks;

        return $this;
    }

    public function getVehicleId(): ?Vehicle
    {
        return $this->vehicle_id;
    }

    public function setVehicleId(?Vehicle $vehicle_id): static
    {
        $this->vehicle_id = $vehicle_id;

        return $this;
    }

    /**
     * @return Collection<int, Delivery>
     */
    public function getDeliveries(): Collection
    {
        return $this->deliveries;
    }

    public function addDelivery(Delivery $delivery): static
    {
        if (!$this->deliveries->contains($delivery)) {
            $this->deliveries->add($delivery);
            $delivery->setDeliverymanId($this);
        }

        return $this;
    }

    public function removeDelivery(Delivery $delivery): static
    {
        if ($this->deliveries->removeElement($delivery)) {
            // set the owning side to null (unless already changed)
            if ($delivery->getDeliverymanId() === $this) {
                $delivery->setDeliverymanId(null);
            }
        }

        return $this;
    }

}
