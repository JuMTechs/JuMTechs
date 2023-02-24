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
    private ?\DateTimeInterface $created = null;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: EventRegistration::class)]
    private Collection $eventRegistrations;

    #[ORM\ManyToOne(inversedBy: 'host')]
    private ?EventHostInfo $host = null;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: EventRegistration::class)]
    private Collection $event;

  
    public function __construct()
    {
        $this->eventRegistrations = new ArrayCollection();
        $this->event = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, EventRegistration>
     */
    public function getEventRegistrations(): Collection
    {
        return $this->eventRegistrations;
    }

    public function getHost(): ?EventHostInfo
    {
        return $this->host;
    }

    public function setHost(?EventHostInfo $host): self
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @return Collection<int, EventRegistration>
     */
    public function getEvent(): Collection
    {
        return $this->event;
    }

    public function addEvent(EventRegistration $event): self
    {
        if (!$this->event->contains($event)) {
            $this->event->add($event);
            $event->setEvent($this);
        }

        return $this;
    }

    public function removeEvent(EventRegistration $event): self
    {
        if ($this->event->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getEvent() === $this) {
                $event->setEvent(null);
            }
        }
        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

}