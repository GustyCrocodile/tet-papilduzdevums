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

	public function getLat()
	{
		return $this->lat;
	}

	public function setLat(float $lat): void
	{
		$this->lat = $lat;
	}

	public function getLon()
	{
		return $this->lon;
	}

	public function setLon(float $lon): void
	{
		$this->lon = $lon;
	}

	public function isEmpty(): bool
	{
		if ($this->lat === null || $this->lon === null) {
			return true;
		}
		return false;
	}
}