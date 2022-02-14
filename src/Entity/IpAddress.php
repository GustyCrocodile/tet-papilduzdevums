<?php

namespace App\Entity;

use App\Repository\IpAddressRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IpAddressRepository::class)]
class IpAddress
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 16)]
    private $ip;

    #[ORM\OneToOne(mappedBy: 'ip', targetEntity: Location::class, cascade: ['persist', 'remove'])]
    private $location;

    public function __construct(string $ip)
    {
        $this->ip = $ip;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(Location $location): self
    {
        // set the owning side of the relation if necessary
        if ($location->getIp() !== $this) {
            $location->setIp($this);
        }

        $this->location = $location;

        return $this;
    }
}
