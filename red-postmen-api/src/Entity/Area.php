<?php

namespace App\Entity;

use App\Repository\AreaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AreaRepository::class)]
class Area
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['area:read', 'postman:read'])]
    private ?int $id = null;

    #[Groups(['area:read', 'postman:read'])]
    #[ORM\Column(length: 50)]
    private ?string $label = null;

    #[Groups(['area:read', 'postman:read'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[Groups(['area:read', 'postman:read'])]
    #[ORM\Column(nullable: true)]
    private ?array $delimitation = null;

    #[Groups(['area:read'])]
    #[ORM\ManyToOne(targetEntity: Postman::class, inversedBy: 'areas')]
    private ?Postman $postman = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDelimitation(): ?array
    {
        return $this->delimitation ?? [];
    }

    public function setDelimitation(?array $delimitation): static
    {
        $this->delimitation = $delimitation;

        return $this;
    }

    public function getPostman(): ?Postman
    {
        return $this->postman;
    }

    public function setPostman(?Postman $postman): static
    {
        $this->postman = $postman;

        return $this;
    }
}
