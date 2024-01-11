<?php

namespace App\Entity;

use App\Repository\DeliveryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeliveryRepository::class)]
class Delivery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'deliveries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Deliveryman $deliveryman = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToOne(mappedBy: 'delivery', cascade: ['persist', 'remove'])]
    private ?DeliveryComment $deliveryComment = null;

    #[ORM\OneToMany(mappedBy: 'delivery', targetEntity: Order::class)]
    private Collection $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeliveryman(): ?Deliveryman
    {
        return $this->deliveryman;
    }

    public function setDeliveryman(?Deliveryman $deliveryman): static
    {
        $this->deliveryman = $deliveryman;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getDeliveryComment(): ?DeliveryComment
    {
        return $this->deliveryComment;
    }

    public function setDeliveryComment(DeliveryComment $deliveryComment): static
    {
        // set the owning side of the relation if necessary
        if ($deliveryComment->getDelivery() !== $this) {
            $deliveryComment->setDelivery($this);
        }

        $this->deliveryComment = $deliveryComment;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setDelivery($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getDelivery() === $this) {
                $order->setDelivery(null);
            }
        }

        return $this;
    }

    public function resetOrders(): static
    {
        $this->orders = new ArrayCollection();

        return $this;
    }
}
