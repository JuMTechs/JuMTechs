<?php

namespace App\Entity;

use App\Repository\RegistrationStoreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegistrationStoreRepository::class)]
class RegistrationStore
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'registrationStores')]
    #[ORM\JoinColumn(nullable: false)]
    private ?event $event = null;

    #[ORM\Column]
    private ?int $student = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvent(): ?event
    {
        return $this->event;
    }

    public function setEvent(?event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getStudent(): ?int
    {
        return $this->student;
    }

    public function setStudent(int $student): self
    {
        $this->student = $student;

        return $this;
    }
}
