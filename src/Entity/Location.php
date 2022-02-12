<?php

namespace App\Entity;

class Location
{
	private $lat;
	private $lon;

	public function __construct($lat, $lon)
	{
		$this->lat = $lat;
		$this->lon = $lon;
	}

	public function getLat(): float
	{
		return $this->lat;
	}

	public function setLat(float $lat): void
	{
		$this->lat = $lat;
	}

	public function getLon(): float
	{
		return $this->lon;
	}

	public function setLon(float $lon): void
	{
		$this->lon = $lon;
	}
}