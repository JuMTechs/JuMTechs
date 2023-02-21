<?php

namespace App\Entity;

use App\Repository\CalenderManageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalenderManageRepository::class)]
class CalenderManage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $eve_id = null;

    #[ORM\Column(length: 255)]
    private ?string $eve_name = null;

    #[ORM\Column(length: 255)]
    private ?string $eve_startD = null;

    #[ORM\Column(length: 255)]
    private ?string $eve_endD = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEveId(): ?int
    {
        return $this->eve_id;
    }

    public function setEveId(int $eve_id): self
    {
        $this->eve_id = $eve_id;

        return $this;
    }

    public function getEveName(): ?string
    {
        return $this->eve_name;
    }

    public function setEveName(string $eve_name): self
    {
        $this->eve_name = $eve_name;

        return $this;
    }

    public function getEveStartD(): ?string
    {
        return $this->eve_startD;
    }

    public function setEveStartD(string $eve_startD): self
    {
        $this->eve_startD = $eve_startD;

        return $this;
    }

    public function getEveEndD(): ?string
    {
        return $this->eve_endD;
    }

    public function setEveEndD(string $eve_endD): self
    {
        $this->eve_endD = $eve_endD;

        return $this;
    }
}
