<?php

namespace App\Entity;

use App\Repository\PromocodeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromocodeRepository::class)
 */
class Promocode
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $percentage;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $rule = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPercentage(): ?int
    {
        return $this->percentage;
    }

    public function setPercentage(?int $percentage): self
    {
        $this->percentage = $percentage;

        return $this;
    }

    public function getRule(): ?array
    {
        return $this->rule;
    }

    public function setRule(?array $rule): self
    {
        $this->rule = $rule;

        return $this;
    }
}
