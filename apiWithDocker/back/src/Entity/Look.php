<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LookRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

#[ORM\Entity(repositoryClass: LookRepository::class)]
#[ApiResource(
    collectionOperations: ['get' => ['normalization_context' => ['groups' => 'look:list']]],
    itemOperations: ['get' => ['normalization_context' => ['groups' => 'look:item']]]
)]
#[ApiFilter(
    SearchFilter::class, 
    properties: ['tags' => 'partial']
)]
class Look
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['look:item', 'look:list'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['look:item', 'look:list'])]
    private ?string $picture = null;

    #[ORM\ManyToOne(inversedBy: 'looks')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['look:item', 'look:list'])]
    private ?Brand $brand = null;

    #[ORM\ManyToOne(inversedBy: 'looks')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['look:item', 'look:list'])]
    private ?Season $season = null;

    #[ORM\Column(length: 255)]
    #[Groups(['look:item', 'look:list'])]
    private ?string $tags = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getSeason(): ?Season
    {
        return $this->season;
    }

    public function setSeason(?Season $season): static
    {
        $this->season = $season;

        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(string $tags): static
    {
        $this->tags = $tags;

        return $this;
    }
}
