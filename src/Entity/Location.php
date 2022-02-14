<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    private $lat;

    #[ORM\Column(type: 'float')]
    private $lon;

    #[ORM\OneToOne(inversedBy: 'location', targetEntity: IpAddress::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $ip;

    public function __construct($lat, $lon) 
    {
        $this->lat = $lat;
        $this->lon = $lon;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLon(): ?float
    {
        return $this->lon;
    }

    public function setLon(float $lon): self
    {
        $this->lon = $lon;

        return $this;
    }

    public function isEmpty(): bool
    {
        if ($this->lat === null || $this->lon === null) {
            return true;
        }
        return false;
    }

    public function getIp(): ?IpAddress
    {
        return $this->ip;
    }

    public function setIp(IpAddress $ip): self
    {
        $this->ip = $ip;

        return $this;
    }
}
