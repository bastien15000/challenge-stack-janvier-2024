<?php

namespace App\Entity;

use App\Repository\FeedbackRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FeedbackRepository::class)]
class Feedback
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $mark = null;

    #[ORM\Column]
    private ?int $broken_items = null;

    #[ORM\Column]
    private ?bool $fullfilled = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $deliveryman_mark = null;

    #[ORM\Column]
    private ?bool $late = null;

    #[ORM\OneToOne(inversedBy: 'feedback', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $order_ = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMark(): ?int
    {
        return $this->mark;
    }

    public function setMark(int $mark): static
    {
        $this->mark = $mark;

        return $this;
    }

    public function getBrokenItems(): ?int
    {
        return $this->broken_items;
    }

    public function setBrokenItems(int $broken_items): static
    {
        $this->broken_items = $broken_items;

        return $this;
    }

    public function isFullfilled(): ?bool
    {
        return $this->fullfilled;
    }

    public function setFullfilled(bool $fullfilled): static
    {
        $this->fullfilled = $fullfilled;

        return $this;
    }

    public function getDeliverymanMark(): ?int
    {
        return $this->deliveryman_mark;
    }

    public function setDeliverymanMark(int $deliveryman_mark): static
    {
        $this->deliveryman_mark = $deliveryman_mark;

        return $this;
    }

    public function isLate(): ?bool
    {
        return $this->late;
    }

    public function setLate(bool $late): static
    {
        $this->late = $late;

        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order_;
    }

    public function setOrder(Order $order_): static
    {
        $this->order_ = $order_;

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
