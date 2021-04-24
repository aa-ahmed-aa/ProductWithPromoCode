## Description
This is a simple explanation for a product and promocode demo

## Description
We have two tables one for Products and PromoCodes and we will join the two tables to get the product prices according to promocode woth the high weight

## Milestones
- Endpoint to generate products with `limit` and `page`.
- Join between the table of products and promocode.
- Dockerizing the app to run on multiple machines.
- Unit tests for the `Trait/`, `Repository/` and `Service/`
- EXTRA : generating code coverage for the written test cases

## Requirements
- docker

## Install With Docker
```shell script
$ docker-compose up --build
$ docker exec -it mythresa_php bash
   > composer install
   > php bin/console doctrine:database:create --env=dev
   > php bin/console doctrine:schema:update --force --env=dev
   > php bin/console doctrine:fixture:load --env=dev --no-interaction
```

Endpoint

> http://localhost:8001/products?page=1&limit=10

To Test the speed of the fetching increase the limit  


## Testing
Before you start
```shell script
// You have sf alias you can use instead of php bin/console but to keep everything clear
$ docker-compose up --build
$ docker exec -it mythresa_php bash
   > php bin/console doctrine:database:create --env=test
   > php bin/console doctrine:schema:update --force --env=test
   > php bin/console doctrine:fixture:load --env=test --no-interaction
   > php ./vendor/bin/phpunit
```

## Coverage
<p align="center">
    <img src="https://github.com/aa-ahmed-aa/ProductWithPromoCode/blob/master/symfony/1.png" alt="Coverage is awesome"/>
</p>

To generate coverage inside the mythresa_php image run this command
```shell script
$ php ./vendor/bin/phpunit --coverage-html coverage/html
```
