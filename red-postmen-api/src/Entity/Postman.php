<?php

namespace App\Entity;

use App\Repository\PostmanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PostmanRepository::class)]
class Postman
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['postman:read', 'area:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['postman:read', 'area:read'])]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    #[Groups(['postman:read', 'area:read'])]
    private ?string $city = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'postmen')]
    private Collection $users;

    /**
     * @var Collection<int, Area>
     */
    #[Groups(['postman:read'])]
    #[ORM\OneToMany(targetEntity: Area::class, mappedBy: 'postman')]
    private Collection $areas;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->areas = new ArrayCollection();
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

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
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
            $user->addPostman($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removePostman($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Area>
     */
    public function getAreas(): Collection
    {
        return $this->areas;
    }

    public function addArea(Area $area): static
    {
        if (!$this->areas->contains($area)) {
            $this->areas->add($area);
            $area->setPostman($this);
        }

        return $this;
    }

    public function removeArea(Area $area): static
    {
        if ($this->areas->removeElement($area)) {
            // set the owning side to null (unless already changed)
            if ($area->getPostman() === $this) {
                $area->setPostman(null);
            }
        }

        return $this;
    }
}
