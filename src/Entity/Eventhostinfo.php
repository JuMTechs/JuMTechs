<?php

namespace App\Entity;

use App\Repository\EventHostInfoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventHostInfoRepository::class)]
class EventHostInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(length: 255)]
    private ?string $job = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\OneToMany(mappedBy: 'host', targetEntity: Event::class)]
    private Collection $host;

    public function __construct()
    {
        $this->host = new ArrayCollection();
    }

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

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getHost(): Collection
    {
        return $this->host;
    }

    public function addHost(Event $host): self
    {
        if (!$this->host->contains($host)) {
            $this->host->add($host);
            $host->setHost($this);
        }

        return $this;
    }

    public function removeHost(Event $host): self
    {
        if ($this->host->removeElement($host)) {
            // set the owning side to null (unless already changed)
            if ($host->getHost() === $this) {
                $host->setHost(null);
            }
        }

        return $this;
    }
}