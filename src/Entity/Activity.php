<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
class Activity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 600, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $website = null;

    #[ORM\Column(nullable: true)]
    private ?int $capacity = null;

    #[ORM\Column(length: 600, nullable: true)]
    private ?string $review = null;

    #[ORM\ManyToOne(targetEntity: Location::class)]
    private ?Location $location = null;

    #[ORM\ManyToOne]
    private ?Type $fk_type = null;

    #[ORM\ManyToOne]
    private ?Preferences $fk_preferences = null;

    #[ORM\ManyToOne]
    private ?Budget $fk_budget = null;

    #[ORM\ManyToOne]
    private ?Season $fk_season = null;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(?int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getReview(): ?string
    {
        return $this->review;
    }

    public function setReview(?string $review): self
    {
        $this->review = $review;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

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

    public function getFkPreferences(): ?Preferences
    {
        return $this->fk_preferences;
    }

    public function setFkPreferences(?Preferences $fk_preferences): self
    {
        $this->fk_preferences = $fk_preferences;

        return $this;
    }

    public function getFkBudget(): ?Budget
    {
        return $this->fk_budget;
    }

    public function setFkBudget(?Budget $fk_budget): self
    {
        $this->fk_budget = $fk_budget;

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
