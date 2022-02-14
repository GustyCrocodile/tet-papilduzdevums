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
Palaidiet symfony projektu
```
symfony server
```