<?php

namespace App\Entity;

use App\Repository\EventRegistrationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRegistrationRepository::class)]
class EventRegistration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $phonenumber = null;

    #[ORM\Column(length: 255)]
    private ?string $comment = null;

    #[ORM\ManyToOne(inversedBy: 'eventRegistrations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?event $Event = null;

    #[ORM\ManyToOne(inversedBy: 'eventRegistrations')]
    private ?User $User = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhonenumber(): ?string
    {
        return $this->phonenumber;
    }

    public function setPhonenumber(string $phonenumber): self
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getEventID(): ?event
    {
        return $this->Event;
    }

    public function setEventID(?event $EventID): self
    {
        $this->Event = $EventID;

        return $this;
    }

    public function getUserID(): ?user
    {
        return $this->User;
    }

    public function setUserID(?User $UserID): self
    {
        $this->User = $UserID;

        return $this;
    }
}
