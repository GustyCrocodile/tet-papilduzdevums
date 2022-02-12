<?php 

namespace App\Entity;

class IpAddress
{
	private $ip;

	public function __construct(string $ip)
	{
		$this->ip = $ip;
	}

	public function getIp(): string
	{
		return $this->ip;
	}

	public function setIp(string $ip): void
	{
		$this->ip = $ip;
	}
}