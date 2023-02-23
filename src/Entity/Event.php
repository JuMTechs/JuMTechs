<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $eventID = null;

    #[ORM\Column(length: 255)]
    private ?string $eventName = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $eventStartDay = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $eventEndDay = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $eventDetail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $eventImage = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $createDay = null;

    #[ORM\OneToMany(mappedBy: 'EventID', targetEntity: EventRegistration::class)]
    private Collection $eventRegistrations;

    #[ORM\ManyToOne(inversedBy: 'host')]
    #[ORM\JoinColumn(nullable: false)]
    private ?eventhostinfo $host = null;

    public function __construct()
    {
        $this->eventRegistrations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventID(): ?int
    {
        return $this->eventID;
    }

    public function setEventID(int $eventID): self
    {
        $this->eventID = $eventID;

        return $this;
    }

    public function getEventName(): ?string
    {
        return $this->eventName;
    }

    public function setEventName(string $eventName): self
    {
        $this->eventName = $eventName;

        return $this;
    }

    public function getEventStartDay(): ?\DateTimeInterface
    {
        return $this->eventStartDay;
    }

    public function setEventStartDay(\DateTimeInterface $eventStartDay): self
    {
        $this->eventStartDay = $eventStartDay;

        return $this;
    }

    public function getEventEndDay(): ?\DateTimeInterface
    {
        return $this->eventEndDay;
    }

    public function setEventEndDay(\DateTimeInterface $eventEndDay): self
    {
        $this->eventEndDay = $eventEndDay;

        return $this;
    }

    public function getEventDetail(): ?string
    {
        return $this->eventDetail;
    }

    public function setEventDetail(?string $eventDetail): self
    {
        $this->eventDetail = $eventDetail;

        return $this;
    }

    public function getEventImage(): ?string
    {
        return $this->eventImage;
    }

    public function setEventImage(?string $eventImage): self
    {
        $this->eventImage = $eventImage;

        return $this;
    }

    public function getCreateDay(): ?\DateTimeInterface
    {
        return $this->createDay;
    }

    public function setCreateDay(\DateTimeInterface $createDay): self
    {
        $this->createDay = $createDay;

        return $this;
    }

    /**
     * @return Collection<int, EventRegistration>
     */
    public function getEventRegistrations(): Collection
    {
        return $this->eventRegistrations;
    }

    public function addEventRegistration(EventRegistration $eventRegistration): self
    {
        if (!$this->eventRegistrations->contains($eventRegistration)) {
            $this->eventRegistrations->add($eventRegistration);
            $eventRegistration->setEventID($this);
        }

        return $this;
    }

    public function removeEventRegistration(EventRegistration $eventRegistration): self
    {
        if ($this->eventRegistrations->removeElement($eventRegistration)) {
            // set the owning side to null (unless already changed)
            if ($eventRegistration->getEventID() === $this) {
                $eventRegistration->setEventID(null);
            }
        }

        return $this;
    }

    public function getHost(): ?eventhostinfo
    {
        return $this->host;
    }

    public function setHost(?eventhostinfo $host): self
    {
        $this->host = $host;

        return $this;
    }
}
