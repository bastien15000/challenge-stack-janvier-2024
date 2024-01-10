<?php

namespace App\Entity;

use App\Repository\NotifRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

enum Type: string {
    case Info = "info";
    case Warning = "attention";
    case Alert = "alerte";
}

#[ORM\Entity(repositoryClass: NotifRepository::class)]
class Notif
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'notifs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\ManyToOne(inversedBy: 'notifs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $order_ = null;

    #[ORM\Column(type: 'string', enumType: Type::class)]
    private ?Type $type = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $value = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order_;
    }

    public function setOrder(?Order $order_): static
    {
        $this->order_ = $order_;

        return $this;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function setType(Type $type): void
    {
        $this->type = $type;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }
}
