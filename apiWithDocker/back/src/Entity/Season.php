<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SeasonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SeasonRepository::class)]
#[ApiResource(
    itemOperations:['get'],
    collectionOperations:[]
)]
class Season
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['look:item', 'look:list'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\OneToMany(mappedBy: 'season', targetEntity: Look::class)]
    private Collection $looks;

    public function __construct()
    {
        $this->looks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, Look>
     */
    public function getLooks(): Collection
    {
        return $this->looks;
    }

    public function addLook(Look $look): static
    {
        if (!$this->looks->contains($look)) {
            $this->looks->add($look);
            $look->setSeason($this);
        }

        return $this;
    }

    public function removeLook(Look $look): static
    {
        if ($this->looks->removeElement($look)) {
            // set the owning side to null (unless already changed)
            if ($look->getSeason() === $this) {
                $look->setSeason(null);
            }
        }

        return $this;
    }

    
}
