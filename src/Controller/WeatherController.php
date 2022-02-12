<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\IpAddress;
use App\Entity\Location;
use App\Entity\Weather;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class WeatherController extends AbstractController
{
	#[Route('/', name: 'app')]
	public function show(Request $request, CacheInterface $cache)
	{
		// $cache->delete('ip_address');
		$ip = $this->getIpAddress($request, $cache);

		// $cache->delete('location');
		$location = $this->getLocation($ip, $cache);

		$weather = $this->getWeather($location);
		$serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
		$weatherJson = $serializer->serialize($weather, 'json');

		return $this->render('app.html.twig', [
			'weather' => $weatherJson,
		]);
	}

	public function getWeather($location)
	{
		$weatherContent = json_decode($this->requestWeather($location)->getContent());
		$weather = new Weather(
			$weatherContent->main->temp,
			$weatherContent->main->feels_like,
			$weatherContent->main->temp_min,
			$weatherContent->main->temp_max,
			$weatherContent->main->pressure,
			$weatherContent->main->humidity
		);
		return $weather;
	}

	public function getIpAddress($request, $cache) 
	{
		$ip = $cache->get('ip_address', function ($request) {
			// return new IpAddress($request->getClientIp());
			// testing only
			// return new IpAddress('72.31.205.212'); // 
			return new IpAddress('78.84.205.212');
		});
		return $ip;
	}

	public function getLocation($ip, $cache) 
	{
		$location = $cache->get('location', function () use ($ip) {
			$client = HttpClient::create();
			$response = $client->request(
				'GET', 
				"http://api.ipstack.com/{$ip->getIp()}?access_key={$this->getParameter('app.geolocation_api_key')}" 
			);
			$result = json_decode($response->getContent());
			return new Location($result->latitude, $result->longitude);
		});
		return $location;
	}
	
	public function requestWeather(Location $location) 
	{
		$client = HttpClient::create();
		$response = $client->request(
			'GET', 
			"http://api.openweathermap.org/data/2.5/weather?lat={$location->getLat()}&lon={$location->getLon()}&appid={$this->getParameter('app.weather_api_key')}&units=metric"
		);
		return $response;
	}
}