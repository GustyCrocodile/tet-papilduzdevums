<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController
{

	// function getIp()
	// get value from cache
	// if cache is empty -> call getClientIp() method to request
	// create new IpAddress as setIp($ip)
	// return IpAddress obj

	// getLocation($ip)
	// get location coords from cache
	// if cache is empty 
	// call locationApiRequest
	// make new Location obj
	// set setLat() and setLon()
	// return Location

	// getWeather($location)
	// make weatherApiRequest
	// if method returns an error
	// return null / error message in json format
	// else return json request response 

	// locationApiRequest($ip)
	// make new httpclient 
	// make a api request 

	// weatherApiRequest($location)
	// make new httpclient 
	// make a api request 

}