<?php

namespace App\Entity;

use App\Repository\FeaturesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FeaturesRepository::class)]
class Features
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $fk_user = null;

    #[ORM\ManyToMany(targetEntity: Accommodation::class)]
    private Collection $mytrip;

    #[ORM\ManyToMany(targetEntity: Restaurant::class)]
    private Collection $myrestaurants;

    #[ORM\ManyToMany(targetEntity: Activity::class)]
    private Collection $myactivities;

    public function __construct()
    {
        $this->mytrip = new ArrayCollection();
        $this->myrestaurants = new ArrayCollection();
        $this->myactivities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFkUser(): ?User
    {
        return $this->fk_user;
    }

    public function setFkUser(?User $fk_user): self
    {
        $this->fk_user = $fk_user;

        return $this;
    }

    /**
     * @return Collection<int, Accommodation>
     */
    public function getMytrip(): Collection
    {
        return $this->mytrip;
    }

    public function addMytrip(Accommodation $mytrip): self
    {
        if (!$this->mytrip->contains($mytrip)) {
            $this->mytrip->add($mytrip);
        }

        return $this;
    }

    public function removeMytrip(Accommodation $mytrip): self
    {
        $this->mytrip->removeElement($mytrip);

        return $this;
    }

    /**
     * @return Collection<int, Restaurant>
     */
    public function getMyrestaurants(): Collection
    {
        return $this->myrestaurants;
    }

    public function addMyrestaurant(Restaurant $myrestaurant): self
    {
        if (!$this->myrestaurants->contains($myrestaurant)) {
            $this->myrestaurants->add($myrestaurant);
        }

        return $this;
    }

    public function removeMyrestaurant(Restaurant $myrestaurant): self
    {
        $this->myrestaurants->removeElement($myrestaurant);

        return $this;
    }

    /**
     * @return Collection<int, Activity>
     */
    public function getMyactivities(): Collection
    {
        return $this->myactivities;
    }

    public function addMyactivity(Activity $myactivity): self
    {
        if (!$this->myactivities->contains($myactivity)) {
            $this->myactivities->add($myactivity);
        }

        return $this;
    }

    public function removeMyactivity(Activity $myactivity): self
    {
        $this->myactivities->removeElement($myactivity);

        return $this;
    }
}
