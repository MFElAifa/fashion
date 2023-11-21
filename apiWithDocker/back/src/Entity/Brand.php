<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
#[ApiResource(
    itemOperations: ['get'],
    collectionOperations:[]
)]
class Brand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['look:item', 'look:list', 'user:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['look:item', 'look:list', 'user:item'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\OneToMany(mappedBy: 'brand', targetEntity: Look::class)]
    private Collection $looks;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'brand')]
    private Collection $users;

    public function __construct()
    {
        $this->looks = new ArrayCollection();
        $this->users = new ArrayCollection();
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
            $look->setBrand($this);
        }

        return $this;
    }

    public function removeLook(Look $look): static
    {
        if ($this->looks->removeElement($look)) {
            // set the owning side to null (unless already changed)
            if ($look->getBrand() === $this) {
                $look->setBrand(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addBrand($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeBrand($this);
        }

        return $this;
    }
}
