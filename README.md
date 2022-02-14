# Tet mājasdarbs - pamatuzdevums
## Projekta uzstādīšana
Noklonē git repozitoriju
```
# http
https://github.com/GustyCrocodile/tet-pamatuzdevums.git
# ssh
git@github.com:GustyCrocodile/tet-pamatuzdevums.git
```
Instalējiet composer
```
cd tet-pamatuzdevums/
composer install
```
Ievadiet API atslēgas .env vai .env.local failā
```
GEOLOCATION_API_KEY=<ipstack.com-api-key>
WEATHER_API_KEY=<openweathermap.org-api-key>
```
Izmainiet datubāzes savienojumā lietotāju, paroli un datubāzes nosaukumu
```
DATABASE_URL="postgresql://db_user:db_password@127.0.0.1:5432/db_name?serverVersion=11&charset=utf8"
```
Izpildiet datubāzes izveidošanas komandu
```
php bin/console doctrine:database:create
```
Izpildiet datubāzes migrāciju komandu
```
php bin/console doctrine:migrations:migrate
```
Palaidiet symfony projektu
```
symfony server
```
### Ip atrašanās vietas testēšanai ip adrese tika iegūta no projekta koda 
```php
public function getIpAddress($request, $cache) 
{
	$ip = $cache->get('ip_address', function (ItemInterface $item) use ($request) {
	    $item->expiresAfter(3600);
		return new IpAddress($request->getClientIp());
		// random ip's for testing only
		// return new IpAddress('72.31.205.212');
		// return new IpAddress('111.21.205.212');
	});
	return $ip;
}
```
