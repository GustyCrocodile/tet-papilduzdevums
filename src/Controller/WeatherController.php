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
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class WeatherController extends AbstractController
{
	#[Route('/', name: 'app')]
	#[Cache(maxage: 60)]
	public function index(Request $request, CacheInterface $cache)
	{
		$ip = $this->getIpAddress($request, $cache);
		$location = $this->getLocation($ip, $cache);
		
		$form = $this->createFormBuilder()
			->add('save', SubmitType::class, ['label' => 'Refresh Location'])
			->getForm();
      
        $form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$ip = $this->resetIpAddress($request, $cache);
			$location = $this->resetLocation($ip, $cache);
		}

		$weather = null;
		if (!$location->isEmpty()) {
			$weather = $this->getWeather($location);
		}

		return $this->render('app.html.twig', [
			'weather' => $weather,
			'locationEmpty' => $location->isEmpty(),
			'form' => $form->createView(),
		]);
	}

	public function resetLocation($ip, $cache) 
	{
		$cache->delete('location');
		return $this->getLocation($ip, $cache);
	}

	public function resetIpAddress($request, $cache)
	{
		$cache->delete('ip_address');
		return $this->getIpAddress($request, $cache);
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
		$serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
		$weatherJson = $serializer->serialize($weather, 'json');
		return $weatherJson;
	}

	public function getIpAddress($request, $cache) 
	{
		$ip = $cache->get('ip_address', function (ItemInterface $item) use ($request) {
		    $item->expiresAfter(3600);
			// return new IpAddress($request->getClientIp());
			// testing only
			// return new IpAddress('72.31.205.212');
			return new IpAddress('111.21.205.212');
		});
		return $ip;
	}

	public function getLocation($ip, $cache) 
	{
		$location = $cache->get('location', function (ItemInterface $item) use ($ip) {
		    $item->expiresAfter(3600);
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