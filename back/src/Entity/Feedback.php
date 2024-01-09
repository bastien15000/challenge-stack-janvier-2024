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
    private ?bool $is_fullfilled = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $deliveryman_mark = null;

    #[ORM\Column]
    private ?bool $is_late = null;

    #[ORM\OneToOne(inversedBy: 'feedback', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $Order_ = null;

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

    public function isIsFullfilled(): ?bool
    {
        return $this->is_fullfilled;
    }

    public function setIsFullfilled(bool $is_fullfilled): static
    {
        $this->is_fullfilled = $is_fullfilled;

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

    public function isIsLate(): ?bool
    {
        return $this->is_late;
    }

    public function setIsLate(bool $is_late): static
    {
        $this->is_late = $is_late;

        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->Order_;
    }

    public function setOrder(Order $Order_): static
    {
        $this->Order_ = $Order_;

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
