<?php

namespace App\Entity;

use App\Repository\CalendarManagementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalendarManagementRepository::class)]
class CalendarManagement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column (nullable: true)]
    private ?int $eve_id = null;

    #[ORM\Column(length: 255)]
    private ?string $eve_name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $eve_start_day = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $eve_end_day = null;

    #[ORM\Column(length: 255)]
    private ?string $eve_detail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $eve_img = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $created = null;

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

    public function getEveStartDay(): ?\DateTimeInterface
    {
        return $this->eve_start_day;
    }

    public function setEveStartDay(\DateTimeInterface $eve_start_day): self
    {
        $this->eve_start_day = $eve_start_day;

        return $this;
    }

    public function getEveEndDay(): ?\DateTimeInterface
    {
        return $this->eve_end_day;
    }

    public function setEveEndDay(\DateTimeInterface $eve_end_day): self
    {
        $this->eve_end_day = $eve_end_day;

        return $this;
    }

    public function getEveDetail(): ?string
    {
        return $this->eve_detail;
    }

    public function setEveDetail(string $eve_detail): self
    {
        $this->eve_detail = $eve_detail;

        return $this;
    }

    public function getEveImg(): ?string
    {
        return $this->eve_img;
    }

    public function setEveImg(?string $eve_img): self
    {
        $this->eve_img = $eve_img;

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
