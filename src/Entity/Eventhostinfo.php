<?php

namespace App\Entity;

use App\Repository\EventhostinfoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventhostinfoRepository::class)]
class Eventhostinfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'host', targetEntity: Event::class)]
    private Collection $host;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function __construct()
    {
        $this->host = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getHost(): Collection
    {
        return $this->host;
    }

    public function setHost(int $host): self
    {
        $this->host = $host;

        return $this;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
