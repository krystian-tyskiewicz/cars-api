## Getting Started

Build and run docker containers:

```bash
docker-compose build
docker-compose up -d
```

Run migrations:

```bash
docker exec cars-api-php php bin/console doctrine:migrations:migrate
```

Load fixtures:

```bash
docker exec cars-api-php php bin/console doctrine:fixtures:load --quiet
```

## Available API endpoints

Fetch cars list:

```bash
curl 'localhost/api/cars'
```

```bash
[{"id":1,"vin":"JHMWD5523DS022721","make":"Porsche","model":"Cayenne","color":null,"yearOfProduction":2023},{"id":2,"vin":"JT2SV12E8G0417278","make":"Audi","model":"S5","color":"Black","yearOfProduction":null},{"id":3,"vin":"2C4GM68475R667819","make":"Fiat","model":"Tipo","color":null,"yearOfProduction":null},{"id":4,"vin":"1B3HB48B67D562726","make":"Nissan","model":"Qashqai","color":null,"yearOfProduction":null},{"id":5,"vin":"JNKCV51E03M018631","make":"Seat","model":"Leon","color":"White","yearOfProduction":2020},{"id":6,"vin":"2HGES15252H603204","make":"Mazda","model":"6","color":null,"yearOfProduction":null},{"id":7,"vin":"WAUAC48H55K008231","make":"Ford","model":"Mondeo","color":null,"yearOfProduction":null},{"id":8,"vin":"JH4KA8150MC012098","make":"Kia","model":"Sportage","color":null,"yearOfProduction":2015}]
```

Fetch a single car:

```bash
curl 'localhost/api/cars/4'
```

```bash
{"id":4,"vin":"1B3HB48B67D562726","make":"Nissan","model":"Qashqai","color":null,"yearOfProduction":null}
```

Add a car:

```bash
curl 'http://localhost/api/cars' --data-raw '{"vin":"3GYFK62817G278819","make":"Lamborghini","model":"Aventador","color":"Yellow","yearOfProduction":2022}'
```

```bash
{"id":9,"vin":"3GYFK62817G278819","make":"Lamborghini","model":"Aventador","color":"Yellow","yearOfProduction":2022}
```

Update a car:

```bash
curl 'http://localhost/api/cars/9' -X 'PATCH' --data-raw '{"model":"Huracan","color":"Gold"}' 
```

```bash
{"id":9,"vin":"3GYFK62817G278819","make":"Lamborghini","model":"Huracan","color":"Gold","yearOfProduction":2022}
```

Delete a car:

```bash
curl 'http://localhost/api/cars/9' -X 'DELETE'
```

```bash
{"id":9}
```
