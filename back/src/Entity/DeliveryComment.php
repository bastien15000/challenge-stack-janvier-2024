<?php

namespace App\Entity;

use App\Repository\DeliveryCommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeliveryCommentRepository::class)]
class DeliveryComment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'deliveryComment', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Delivery $delivery = null;

    #[ORM\Column]
    private ?int $km_start = null;

    #[ORM\Column(nullable: true)]
    private ?int $km_end = null;

    #[ORM\Column(nullable: true)]
    private ?float $toll_rate = null;

    #[ORM\Column(nullable: true)]
    private ?float $fuel_bill = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDelivery(): ?Delivery
    {
        return $this->delivery;
    }

    public function setDelivery(Delivery $delivery): static
    {
        $this->delivery = $delivery;

        return $this;
    }

    public function getKmStart(): ?int
    {
        return $this->km_start;
    }

    public function setKmStart(int $km_start): static
    {
        $this->km_start = $km_start;

        return $this;
    }

    public function getKmEnd(): ?int
    {
        return $this->km_end;
    }

    public function setKmEnd(?int $km_end): static
    {
        $this->km_end = $km_end;

        return $this;
    }

    public function getTollRate(): ?float
    {
        return $this->toll_rate;
    }

    public function setTollRate(?float $toll_rate): static
    {
        $this->toll_rate = $toll_rate;

        return $this;
    }

    public function getFuelBill(): ?float
    {
        return $this->fuel_bill;
    }

    public function setFuelBill(?float $fuel_bill): static
    {
        $this->fuel_bill = $fuel_bill;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }
}
