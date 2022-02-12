<?php

namespace App\Entity;

class Weather
{
	private $temp;
	private $feelsLike;
	private $tempMin;
	private $tempMax;
	private $pressure;
	private $humidity;

	public function __construct(float $temp, float $feelsLike, float $tempMin, float $tempMax, float $pressure, float $humidity)
	{
		$this->temp = $temp;
		$this->feelsLike = $feelsLike;
		$this->tempMin = $tempMin;
		$this->tempMax = $tempMax;
		$this->pressure = $pressure;
		$this->humidity = $humidity;
	}

	public function getTemp(): float
	{
		return $this->temp;
	}

	public function setTemp(float $temp): void
	{
		$this->temp = $temp;
	}

	public function getFeelsLike(): float
	{
		return $this->feelsLike;
	}

	public function setFeelsLike(float $feelsLike): void
	{
		$this->feelsLike = $feelsLike;
	}

	public function getTemMin(): float
	{
		return $this->tempMin;
	}

	public function setTempMin(float $tempMin): void
	{
		$this->tempMin = $tempMin;
	}

	public function getTemMax(): float
	{
		return $this->tempMax;
	}

	public function setTempMax(float $tempMax): void
	{
		$this->tempMax = $tempMax;
	}

	public function getHumidity(): float
	{
		return $this->humidity;
	}

	public function setHumidity(float $humidity): void
	{
		$this->humidity = $humidity;
	}

	public function getPressure(): float
	{
		return $this->pressure;
	}

	public function setPressure(float $pressure): void
	{
		$this->pressure = $pressure;
	}

}