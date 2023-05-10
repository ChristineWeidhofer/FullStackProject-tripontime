<?php

namespace App\Entity;

use App\Repository\PackinglistRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PackinglistRepository::class)]
class Packinglist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 55)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $icon = null;

    #[ORM\ManyToOne]
    public ?Type $fk_type = null;

    #[ORM\ManyToOne(targetEntity: Preferences::class)]
    public ?Preferences $fk_preferences = null;

    #[ORM\ManyToOne]
    public ?Season $fk_season = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getFkType(): ?Type
    {
        return $this->fk_type;
    }

    public function setFkType(?Type $fk_type): self
    {
        $this->fk_type = $fk_type;

        return $this;
    }

    public function getPreferences(): ?Preferences
    {
        return $this->fk_preferences;
    }

    public function setPreferences(?Preferences $fk_preferences): self
    {
        $this->fk_preferences = $fk_preferences;

        return $this;
    }

    public function getFkSeason(): ?Season
    {
        return $this->fk_season;
    }

    public function setFkSeason(?Season $fk_season): self
    {
        $this->fk_season = $fk_season;

        return $this;
    }
}
