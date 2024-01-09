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
    private ?Deliveryman $deliveryman_id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToOne(mappedBy: 'delivery_id', cascade: ['persist', 'remove'])]
    private ?DeliveryComment $deliveryComment = null;

    #[ORM\OneToMany(mappedBy: 'Delivery', targetEntity: Order::class)]
    private Collection $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeliverymanId(): ?Deliveryman
    {
        return $this->deliveryman_id;
    }

    public function setDeliverymanId(?Deliveryman $deliveryman_id): static
    {
        $this->deliveryman_id = $deliveryman_id;

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
        if ($deliveryComment->getDeliveryId() !== $this) {
            $deliveryComment->setDeliveryId($this);
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
}
